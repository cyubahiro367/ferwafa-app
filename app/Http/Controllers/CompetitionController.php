<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Division;
use App\Models\Group;
use App\Models\Season;
use App\Models\Team;
use App\Models\TeamCategory;
use App\Models\TeamStatistic;
use App\Models\TopScore;
use App\Support\GroupFilter;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CompetitionController extends Controller
{
    public function listDays()
    {
        $days = Day::all();

        if (is_null($days)) {
            return redirect("/")->with('error', 'No days Found');
        }

        return view('competition-menus', [
            'days' => $days
        ]);
    }

    public function show(Request $request, int $seasonID, int $divisionID, int $categoryID, int $id, ?int $groupID = null)
    {
        $season = $this->resolveSeason($request, $seasonID);

        if (is_null($season)) {
            return redirect('/')
                ->with('error', 'Season not found');
        }

        $division = Division::where('id', $divisionID)->first();

        if (is_null($division)) {
            return redirect('/')
                ->with('error', 'Division not found');
        }

        $teamCategory = TeamCategory::where('id', $categoryID)->first();

        if (is_null($teamCategory)) {
            return redirect('/')
                ->with('error', 'Team category not found');
        }

        $effectiveGroupId = GroupFilter::resolveGroupId($request, $groupID, $season, $divisionID);
        $showGroupFilter = GroupFilter::applies($divisionID, $season);
        $groups = $divisionID === 2 ? Group::orderBy('name')->get() : collect();

        $days = Day::where('seasonID', $season->id)->orderBy('id')->get();
        $teams = Team::where('categoryID', $categoryID)->pluck('id')->toArray();

        $day = $this->resolveDay(
            $request,
            $season,
            $divisionID,
            $categoryID,
            $effectiveGroupId,
            $days,
            $id
        );

        $games = collect();

        if ($day) {
            $gamesQuery = DB::table('Game')
                ->select(
                    'homeTeam.name AS homeTeam',
                    'awayTeam.name AS awayTeam',
                    'Game.stadeName AS stadium',
                    'Game.date',
                    'Game.homeTeamGoals',
                    'Game.awayTeamGoals',
                    'Game.isPlayed',
                )
                ->join('Team as homeTeam', 'Game.homeTeamID', '=', 'homeTeam.id')
                ->join('Team as awayTeam', 'Game.awayTeamID', '=', 'awayTeam.id')
                ->join('Day', 'Game.dayID', '=', 'Day.id')
                ->where('Game.seasonID', $season->id)
                ->where('Day.id', $day->id)
                ->where('homeTeam.categoryID', $categoryID)
                ->where('awayTeam.categoryID', $categoryID)
                ->where('homeTeam.divisionID', $divisionID)
                ->where('awayTeam.divisionID', $divisionID);

            if ($effectiveGroupId) {
                $gamesQuery->where('Game.groupID', $effectiveGroupId);
            }

            $games = $gamesQuery->orderBy('Game.id', 'DESC')->get();
        }

        $seasons = $this->formattedSeasons();

        if (empty($seasons)) {
            return redirect("/")->with('error', 'No Season Found');
        }

        $playerSuspendeds = collect();

        if ($day) {
            $playerSuspendeds = DB::table('PlayerSuspended AS a')
                ->join('Team AS b', 'a.teamID', '=', 'b.id')
                ->where([['a.seasonID', $season->id], ['a.dayID', $day->id]])
                ->get(['a.name', 'a.reason', 'b.name as teamName']);
        }

        return view('fixtures', [
            'day' => $day,
            'days' => $days,
            'games' => $games,
            'categoryID' => (int) $categoryID,
            'divisionID' => $divisionID,
            'seasons' => $seasons,
            'seasonID' => $season->id,
            'showGroupFilter' => $showGroupFilter,
            'groups' => $groups,
            'groupID' => $effectiveGroupId,
            'playerSuspendeds' => $playerSuspendeds,
        ]);
    }

    public function menFirstDivisionTable(Request $request, int $seasonID, int $divisionID, int $categoryID, ?int $groupID = null)
    {
        $division = Division::where('id', $divisionID)->first();

        if (is_null($division)) {
            return redirect('/')
                ->with('error', 'Division not found');
        }

        $season = $this->resolveSeason($request, $seasonID);

        if (is_null($season)) {
            return redirect('/')
                ->with('error', 'Season not found');
        }

        $teamCategory = TeamCategory::where('id', $categoryID)->first();

        if (is_null($teamCategory)) {
            return redirect('/')
                ->with('error', 'Team category not found');
        }

        $effectiveGroupId = GroupFilter::resolveGroupId($request, $groupID, $season, $divisionID);
        $showGroupFilter = GroupFilter::applies($divisionID, $season);
        $groups = $divisionID === 2 ? Group::orderBy('name')->get() : collect();
        $days = Day::where('seasonID', $season->id)->orderBy('id')->get();

        $teams = Team::where([['divisionID', $divisionID], ['categoryID', $categoryID]])->get()->toArray();

        $day = $this->resolveDay(
            $request,
            $season,
            $divisionID,
            $categoryID,
            $effectiveGroupId,
            $days,
            null
        );

        $navDayId = $day?->id ?? 1;

        if ($effectiveGroupId) {
            $teamStatistics = DB::select("SELECT a.name AS name,
                                            SUM(b.goalWin) AS goalWin,
                                            SUM(b.goalLoss) AS goalLoss,
                                            SUM(b.goalWin) - SUM(b.goalLoss) AS goalDifference,
                                            SUM(b.score) AS score,
                                            SUM(
                                                    CASE
                                                        WHEN c.isPlayed = true
                                                    THEN 1
                                                        ELSE 0
                                                    END
                                            ) AS matchPlayed
                                        FROM Team AS a
                                        INNER JOIN TeamStatistic AS b
                                        ON b.teamID = a.id
                                        INNER JOIN Game AS c
                                        ON c.id = b. gameID
                                        WHERE a.categoryID = ? AND a.divisionID = ? AND c.groupID = ? AND c.seasonID = ?
                                        GROUP BY a.id
                                        ORDER BY SUM(b.score) DESC, (SUM(b.goalWin) - SUM(b.goalLoss)) DESC, SUM(b.goalWin) DESC, a.name ASC
                                        ", [$categoryID, $divisionID, $effectiveGroupId, $season->id]);
        } else {
            $teamStatistics = DB::select("SELECT a.name AS name,
                                            SUM(b.goalWin) AS goalWin,
                                            SUM(b.goalLoss) AS goalLoss,
                                            SUM(b.goalWin) - SUM(b.goalLoss) AS goalDifference,
                                            SUM(b.score) AS score,
                                            SUM(
                                                    CASE
                                                        WHEN c.isPlayed = true
                                                    THEN 1
                                                        ELSE 0
                                                    END
                                            ) AS matchPlayed
                                        FROM Team AS a
                                        INNER JOIN TeamStatistic AS b
                                        ON b.teamID = a.id
                                        INNER JOIN Game AS c
                                        ON c.id = b. gameID
                                        WHERE a.categoryID = ? AND a.divisionID = ?AND c.seasonID = ?
                                        GROUP BY a.id
                                        ORDER BY SUM(b.score) DESC, (SUM(b.goalWin) - SUM(b.goalLoss)) DESC, SUM(b.goalWin) DESC, a.name ASC
                                        ", [$categoryID, $divisionID, $season->id]);
        }

        $topScores = TopScore::where('seasonID', $season->id)->orderBy('goals', 'DESC')->orderBy('name', 'ASC')->take(10)->get();

        $finalTopScores = [];

        foreach ($topScores as $value) {
            foreach ($teams as $team) {
                if ($team["name"] === $value->teamName) {
                    $topScore = [
                        "id" => $value->id,
                        "name" => $value->name,
                        "goals" => $value->goals,
                        "teamName" => $value->teamName
                    ];
                    array_push($finalTopScores, $topScore);
                }
            }
        }

        $seasons = $this->formattedSeasons();

        return view('menFirstDivisionTable', [
            'day' => $day,
            'days' => $days,
            'navDayId' => $navDayId,
            'teamStatistics' => $teamStatistics,
            'topScores' => $finalTopScores,
            'categoryID' => (int) $categoryID,
            'categoryName' => $teamCategory->name,
            'divisionID' => $divisionID,
            'seasons' => $seasons,
            'seasonID' => $season->id,
            'showGroupFilter' => $showGroupFilter,
            'groups' => $groups,
            'groupID' => $effectiveGroupId,
        ]);
    }

    public function standing()
    {
        $teams = TeamStatistic::all();

        return view('', [
            'teams' => $teams
        ]);
    }

    private function resolveSeason(Request $request, int $routeSeasonId): ?Season
    {
        if ($request->filled('seasonID')) {
            return Season::find($request->integer('seasonID'));
        }

        return Season::orderByDesc('created_at')->first()
            ?? Season::find($routeSeasonId);
    }

    private function resolveDay(
        Request $request,
        Season $season,
        int $divisionID,
        int $categoryID,
        ?int $groupID,
        Collection $days,
        ?int $routeDayId
    ): ?Day {
        if ($request->filled('dayID')) {
            return Day::find($request->integer('dayID')) ?? $days->first();
        }

        $latestFixtureDay = $this->latestDayWithFixtures(
            $season->id,
            $divisionID,
            $categoryID,
            $groupID
        );

        if ($latestFixtureDay) {
            return $latestFixtureDay;
        }

        if ($routeDayId) {
            return Day::find($routeDayId) ?? $days->first();
        }

        return $days->first();
    }

    private function latestDayWithFixtures(
        int $seasonId,
        int $divisionID,
        int $categoryID,
        ?int $groupID
    ): ?Day {
        $query = DB::table('Game')
            ->join('Day', 'Day.id', '=', 'Game.dayID')
            ->join('Team as homeTeam', 'Game.homeTeamID', '=', 'homeTeam.id')
            ->join('Team as awayTeam', 'Game.awayTeamID', '=', 'awayTeam.id')
            ->where('Game.seasonID', $seasonId)
            ->where('homeTeam.categoryID', $categoryID)
            ->where('awayTeam.categoryID', $categoryID)
            ->where('homeTeam.divisionID', $divisionID)
            ->where('awayTeam.divisionID', $divisionID);

        if ($groupID) {
            $query->where('Game.groupID', $groupID);
        }

        $row = $query->orderByDesc('Day.id')->first(['Day.id']);

        return $row ? Day::find($row->id) : null;
    }

    private function formattedSeasons(): array
    {
        $seasons = Season::orderByDesc('created_at')->get()->toArray();

        return array_map(function ($item) {
            $item['from'] = Carbon::createFromTimestamp((int) $item['from'])->format('Y');
            $item['to'] = Carbon::createFromTimestamp((int) $item['to'])->format('Y');
            $item['playsInGroups'] = (bool) ($item['playsInGroups'] ?? true);

            return $item;
        }, $seasons);
    }
}
