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

        $users = User::orderBy('name')->get(['id', 'name', 'email']);
        $userId = $request->integer('userID') ?: null;
        $type = $request->string('type')->toString() ?: null;

        $counts = [];
        $sections = [];
        $selectedUser = null;

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
                $query = $meta['model']::where('userID', $userId);
                $counts[$key] = (clone $query)->count();

                if ($type && $type !== $key) {
                    continue;
                }

                $items = $query->orderByDesc('id')->limit(15)->get()->map(function ($row) use ($meta) {
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
                });

                $sections[$key] = [
                    'label' => $meta['label'],
                    'items' => $items,
                ];
            }
        }

        return view('admin.creator-report', [
            'users' => $users,
            'userId' => $userId,
            'type' => $type,
            'selectedUser' => $selectedUser,
            'counts' => $counts,
            'sections' => $sections,
        ]);
    }
}
