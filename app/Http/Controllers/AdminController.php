<?php

namespace App\Http\Controllers;

use App\Models\Committe;
use App\Models\Document;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Game;
use App\Models\News;
use App\Models\NewsType;
use App\Models\Partner;
use App\Models\PlayerSuspended;
use App\Models\Season;
use App\Models\Status;
use App\Models\Team;
use App\Models\TopScore;
use App\Models\User;
use App\Support\FilteredExport;
use App\Support\ListFilters;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createNewsView()
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        return view('admin.create-news', [
            'statuses' => Status::all(),
            'newsTypes' => NewsType::all(),
        ]);
    }

    public function adminView()
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm') && !Gate::allows('is-competition-manager')) {
            Auth::logout();
            return redirect('/');
        }

        $recentNews = DB::table('News as a')
            ->leftJoin('users as u', 'u.id', '=', 'a.userID')
            ->select('a.id', 'a.title', 'a.created_at', 'u.name as creator_name')
            ->orderByDesc('a.id')
            ->limit(5)
            ->get();

        $recentGames = DB::table('Game as g')
            ->leftJoin('Team as ht', 'ht.id', '=', 'g.homeTeamID')
            ->leftJoin('Team as at', 'at.id', '=', 'g.awayTeamID')
            ->leftJoin('users as u', 'u.id', '=', 'g.userID')
            ->select(
                'g.id',
                'g.date',
                'g.created_at',
                'ht.name as home_team',
                'at.name as away_team',
                'u.name as creator_name'
            )
            ->orderByDesc('g.id')
            ->limit(5)
            ->get();

        return view('admin.admin', [
            'userName' => Auth::user()->name,
            'stats' => [
                'news' => News::count(),
                'events' => Event::count(),
                'documents' => Document::count(),
                'gallery' => Gallery::count(),
                'partners' => Partner::count(),
                'committee' => Committe::count(),
                'users' => User::count(),
                'seasons' => Season::count(),
                'teams' => Team::count(),
                'games' => Game::count(),
                'topScores' => TopScore::count(),
                'suspensions' => PlayerSuspended::count(),
            ],
            'recentNews' => $recentNews,
            'recentGames' => $recentGames,
        ]);
    }

    public function getNewsForAdmin(Request $request)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        $filters = ListFilters::fromRequest($request);

        $paginator = DB::table('News as a')
            ->join('NewsUrl as b', 'b.news_id', '=', 'a.id')
            ->join('Status as c', 'a.statusID', '=', 'c.id')
            ->leftJoin('users as u', 'u.id', '=', 'a.userID')
            ->select(
                'a.id',
                'a.title',
                'a.caption',
                'a.description',
                'a.is_top',
                'a.created_at',
                'a.updated_at',
                'b.id as image_id',
                'b.image_url',
                'c.name as status',
                'u.name as creator_name'
            );

        ListFilters::apply($paginator, $filters, 'a.userID', 'a.created_at');
        $paginator->orderByDesc('a.id');

        if (FilteredExport::requested($request)) {
            $rows = $paginator->get()->map(function ($value) {
                return [
                    $value->title,
                    Carbon::parse($value->created_at)->format('Y-m-d'),
                    $value->is_top == 1 ? 'Yes' : 'No',
                    $value->status,
                    $value->creator_name ?? '—',
                ];
            })->all();

            $topFilter = 'All';
            if ($request->filled('top')) {
                $rawTop = strtolower((string) $request->input('top'));
                $topFilter = in_array($rawTop, ['1', 'yes', 'true'], true)
                    ? 'Yes'
                    : (in_array($rawTop, ['0', 'no', 'false'], true) ? 'No' : (string) $request->input('top'));
            }

            return FilteredExport::download(
                'News',
                $filters,
                ['Title', 'Created', 'Top', 'Status', 'Created by'],
                $rows,
                $request->input('format'),
                [
                    'extraFilters' => [
                        'Status' => $request->filled('status') ? (string) $request->input('status') : 'All',
                        'Top news' => $topFilter,
                    ],
                    'columnWidths' => [
                        'A' => 60,
                        'B' => 14,
                        'C' => 8,
                        'D' => 14,
                        'E' => 26,
                    ],
                    'wrapColumns' => ['A'],
                ]
            );
        }

        $paginator = $paginator->paginate(10);

        $paginator->getCollection()->transform(function ($value) {
            $parts = explode('/', $value->image_url);
            return [
                'id' => $value->id,
                'title' => $value->title,
                'caption' => $value->caption,
                'description' => $value->description,
                'is_top' => $value->is_top == 1 ? 'True' : 'False',
                'status' => $value->status,
                'created_at' => Carbon::parse($value->created_at)->format('Y-m-d'),
                'updated_at' => Carbon::parse($value->updated_at)->format('Y-m-d'),
                'image_id' => $value->image_id,
                'image_url' => $parts[1] ?? $value->image_url,
                'creator_name' => $value->creator_name,
            ];
        });

        return view('admin.newslist', array_merge(ListFilters::viewData($request), [
            'news' => $paginator,
        ]));
    }

    public function getEventsForAdmin(Request $request)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        $filters = ListFilters::fromRequest($request);

        $paginator = DB::table('Event as a')
            ->join('EventUrl as b', 'b.event_id', '=', 'a.id')
            ->join('Status as c', 'a.statusID', '=', 'c.id')
            ->leftJoin('users as u', 'u.id', '=', 'a.userID')
            ->select(
                'a.id',
                'a.name',
                'a.event_date',
                'a.description',
                'a.created_at',
                'a.updated_at',
                'b.id as image_id',
                'b.image_url',
                'c.name as statusName',
                'u.name as creator_name'
            );

        ListFilters::apply($paginator, $filters, 'a.userID', 'a.created_at');
        $paginator->orderByDesc('a.id');

        if (FilteredExport::requested($request)) {
            $rows = $paginator->get()->map(function ($value) {
                return [
                    $value->name,
                    Carbon::parse($value->created_at)->format('d-m-Y'),
                    $value->statusName,
                    $value->creator_name ?? '—',
                ];
            })->all();

            return FilteredExport::download(
                'Events',
                $filters,
                ['Event', 'Date', 'Status', 'Created by'],
                $rows,
                $request->input('format')
            );
        }

        $paginator = $paginator->paginate(10);

        $paginator->getCollection()->transform(function ($value) {
            $parts = explode('/', $value->image_url);
            return [
                'id' => $value->id,
                'name' => $value->name,
                'date' => $value->event_date,
                'description' => $value->description,
                'status' => $value->statusName,
                'created_at' => Carbon::parse($value->created_at)->format('d-m-Y'),
                'updated_at' => Carbon::parse($value->updated_at)->format('d-m-Y'),
                'image_id' => $value->image_id,
                'image_url' => $parts[1] ?? $value->image_url,
                'creator_name' => $value->creator_name,
            ];
        });

        return view('admin.eventlist', array_merge(ListFilters::viewData($request), [
            'events' => $paginator,
        ]));
    }

    public function createEventsView()
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        return view('admin.create-events');
    }
}
