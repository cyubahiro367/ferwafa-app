<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Division;
use App\Models\Game;
use App\Models\Group;
use App\Models\Season;
use App\Models\Team;
use App\Models\TeamCategory;
use App\Models\TeamStatistic;
use App\Models\TopScore;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
        
        $season = empty($request->all()) ? Season::orderBy('created_at', 'DESC')->first() : Season::where('id', $request->seasonID)->first();
        
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

        $days = Day::all();

        $day = empty($request->all()) ? Day::where('id', $id)->first() : Day::where('id', $request->dayID)->first();
        
        if(!is_null($groupID)){

            $group = Group::where('id', $groupID)->first();

            if (is_null($group)) {
                return redirect('/')
                    ->with('error', 'Group not found');
            }
        
            $games = DB::table('Game')
                ->select(
                    'homeTeam.name AS homeTeam',
                    'awayTeam.name AS awayTeam',
                    'Game.stadeName AS stadium',
                    'Game.date',
                    'Game.seasonID',
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
                ->where('awayTeam.divisionID', $divisionID)
                ->where('Game.groupID', $group->id)
                ->orderBy('Game.id', 'DESC')
                ->get();
        }

        if(is_null($groupID)){
            $games = DB::table('Game')
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
            ->where('awayTeam.divisionID', $divisionID)
            ->orderBy('Game.id', 'DESC')
            ->get();
        }

        $seasons = Season::all()->toArray();

        if (empty($seasons)) {
            return redirect("/")->with('error', 'No Season Found');
        }

        $seasons = array_map(function($item){
            $item['from'] = Carbon::createFromTimestamp($item['from'])->format('Y');
            $item['to'] = Carbon::createFromTimestamp($item['to'])->format('Y');

            return $item;
        }, $seasons);
        
        return view('fixtures', [
            'day' => $day,
            'days' => $days,
            'games' => $games,
            "categoryID" => (int)$categoryID,
            'seasons' => $seasons,
            'seasonID' => $season->id
        ]);
    }
    public function menFirstDivisionTable($seasonID, $divisionID, $categoryID, ?int $groupID = null)
    {
        $division = Division::where('id', $divisionID)->first();
        
        if (is_null($division)) {
            return redirect('/')
                ->with('error', 'Division not found');
        }

        $season = Season::where('id', $seasonID)->first();
        
        if (is_null($season)) {
            return redirect('/')
                ->with('error', 'Season not found');
        }

        $teamCategory = TeamCategory::where('id', $categoryID)->first();
        
        if (is_null($teamCategory)) {
            return redirect('/')
                ->with('error', 'Team category not found');
        }

        $teams = Team::where([['divisionID', $divisionID], ['categoryID', $categoryID]])->get()->toArray();

        $daysPlayed = DB::table('Game')
            ->join('Day', 'Day.id', '=', 'Game.dayID')
            ->join('Team','Team.id', '=', 'homeTeamID')
            ->join('TeamCategory', 'Team.categoryID', '=','TeamCategory.id')
            ->where([['Game.isPlayed', 1], ['Game.seasonID', $seasonID]])
            ->where('TeamCategory.id',$categoryID)
            ->orderBy('Day.id', 'DESC')
            ->first(['Game.dayID']);
                
        if($daysPlayed){
            $days = $daysPlayed;
        } else {
            $days = (object) [
                "dayID" => 1
            ];
        }

        if(!is_null($groupID)){
            $group = Group::where('id', $groupID)->first();
        
            if (is_null($group)) {
                return redirect('/')
                    ->with('error', 'Group not found');
            }

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
                                        WHERE a.categoryID = ? AND a.divisionID = ? AND c.groupID = ?
                                        GROUP BY a.id
                                        ORDER BY SUM(b.score) DESC, (SUM(b.goalWin) - SUM(b.goalLoss)) DESC, SUM(b.goalWin) DESC, a.name ASC
                                        ",[$categoryID, $divisionID, $groupID]);
        }

        if(is_null($groupID)){
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
                                        WHERE a.categoryID = ? AND a.divisionID = ?
                                        GROUP BY a.id
                                        ORDER BY SUM(b.score) DESC, (SUM(b.goalWin) - SUM(b.goalLoss)) DESC, SUM(b.goalWin) DESC, a.name ASC
                                        ",[$categoryID, $divisionID]);
        }
        

        $topScores = TopScore::orderBy('goals', 'DESC')->orderBy('name', 'ASC')->take(10)->get();

        $finalTopScores = [];

        foreach ($topScores as $value) {
            foreach($teams as $team){
                if($team["name"] === $value->teamName){
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

        return view('menFirstDivisionTable', [
            'days' => $days,
            'teamStatistics' => $teamStatistics,
            "topScores" => $finalTopScores,
            "categoryID" => (int)$categoryID,
            "categoryName" => $teamCategory->name
        ]);
    }

    public function standing()
    {
        $teams = TeamStatistic::all();

        return view('', [
            'teams' => $teams
        ]);
    }
}
