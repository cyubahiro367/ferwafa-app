<?php

namespace App\Http\Controllers;

use App\Models\Committe;
use App\Models\Day;
use App\Models\Document;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Game;
use App\Models\News;
use App\Models\Partner;
use App\Models\PlayerSuspended;
use App\Models\Season;
use App\Models\Team;
use App\Models\TeamCategory;
use App\Models\TopScore;
use App\Models\User;
use App\Support\FilteredExport;
use App\Support\ListFilters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CreatorReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if (!Gate::allows('is-admin')) {
            Auth::logout();
            return redirect('/');
        }

        $filters = ListFilters::fromRequest($request, true);
        $users = ListFilters::users();
        $userId = $filters['userId'];
        $type = $request->string('type')->toString() ?: null;

        $counts = [];
        $sections = [];
        $selectedUser = null;
        $exportRows = [];

        if ($userId) {
            $selectedUser = User::find($userId);

            $map = [
                'news' => ['label' => 'News', 'model' => News::class, 'title' => 'title'],
                'events' => ['label' => 'Events', 'model' => Event::class, 'title' => 'name'],
                'documents' => ['label' => 'Documents', 'model' => Document::class, 'title' => 'title'],
                'gallery' => ['label' => 'Gallery', 'model' => Gallery::class, 'title' => 'name'],
                'partners' => ['label' => 'Partners', 'model' => Partner::class, 'title' => 'link'],
                'committee' => ['label' => 'Committee', 'model' => Committe::class, 'title' => 'name'],
                'seasons' => ['label' => 'Seasons', 'model' => Season::class, 'title' => null],
                'days' => ['label' => 'Days', 'model' => Day::class, 'title' => 'name'],
                'team_categories' => ['label' => 'Team Categories', 'model' => TeamCategory::class, 'title' => 'name'],
                'teams' => ['label' => 'Teams', 'model' => Team::class, 'title' => 'name'],
                'games' => ['label' => 'Fixtures', 'model' => Game::class, 'title' => null],
                'top_scores' => ['label' => 'Top Scores', 'model' => TopScore::class, 'title' => 'name'],
                'suspensions' => ['label' => 'Suspensions', 'model' => PlayerSuspended::class, 'title' => 'name'],
            ];

            foreach ($map as $key => $meta) {
                $query = ListFilters::apply(
                    $meta['model']::where('userID', $userId),
                    $filters
                );
                $counts[$key] = (clone $query)->count();

                if ($type && $type !== $key) {
                    continue;
                }

                $mapItem = function ($row) use ($meta) {
                    if ($meta['title'] === null && $row instanceof Season) {
                        $title = date('Y', (int) $row->from) . ' – ' . date('Y', (int) $row->to);
                    } elseif ($row instanceof Game) {
                        $title = 'Fixture #' . $row->id . ' · ' . ($row->date ?? '');
                    } else {
                        $field = $meta['title'];
                        $title = $field ? ($row->{$field} ?? ('#' . $row->id)) : ('#' . $row->id);
                    }

                    return [
                        'id' => $row->id,
                        'title' => $title,
                        'created_at' => optional($row->created_at)->format('Y-m-d H:i'),
                    ];
                };

                if (FilteredExport::requested($request)) {
                    $query->orderByDesc('id')->get()->each(function ($row) use ($meta, $mapItem, &$exportRows) {
                        $item = $mapItem($row);
                        $exportRows[] = [
                            $meta['label'],
                            $item['title'],
                            $item['created_at'] ?? '—',
                        ];
                    });
                    continue;
                }

                $items = $query->orderByDesc('id')->limit(15)->get()->map($mapItem);

                $sections[$key] = [
                    'label' => $meta['label'],
                    'items' => $items,
                ];
            }
        }

        if (FilteredExport::requested($request) && $userId && $selectedUser) {
            return FilteredExport::download(
                'Creator Report',
                $filters,
                ['Type', 'Title', 'Created at'],
                $exportRows,
                $request->input('format')
            );
        }

        return view('admin.creator-report', [
            'users' => $users,
            'userId' => $userId,
            'from' => $filters['from'],
            'to' => $filters['to'],
            'type' => $type,
            'selectedUser' => $selectedUser,
            'counts' => $counts,
            'sections' => $sections,
        ]);
    }
}
