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
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class GameController extends Controller
{
    public function listGames(Request $request, int $divisionID, int $categoryID)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-competition-manager')) {
            Auth::logout();
            return redirect("/games/$divisionID/$categoryID");
        }

        $season = empty($request->all()) ? Season::orderBy('created_at', 'DESC')->first() : Season::where('id', $request->seasonID)->first();

        if (is_null($season)) {
            return redirect("/games/$divisionID/$categoryID")->with('error', 'create season first');
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

        $games = DB::table('Game')
            ->select(
                'Game.id',
                'homeTeam.name AS homeTeam',
                'awayTeam.name AS awayTeam',
                'Game.stadeName AS stadium',
                'Game.date',
                'Game.groupID',
                'Game.homeTeamGoals',
                'Game.awayTeamGoals',
                'Game.isPlayed',
                'Day.id AS dayID',
                'Day.name AS dayName',
                'users.name as creator_name'
            )
            ->join('Team as homeTeam', 'Game.homeTeamID', '=', 'homeTeam.id')
            ->join('Team as awayTeam', 'Game.awayTeamID', '=', 'awayTeam.id')
            ->join('Day', 'Game.dayID', '=', 'Day.id')
            ->leftJoin('users', 'users.id', '=', 'Game.userID')
            ->where('homeTeam.categoryID', $categoryID)
            ->where('awayTeam.categoryID', $categoryID)
            ->where('homeTeam.divisionID', $divisionID)
            ->where('awayTeam.divisionID', $divisionID)
            ->where('Game.seasonID', $season->id)
            ->orderBy('Day.id', 'DESC')
            ->orderBy('Game.id', 'DESC')
            ->paginate(10);

        $groupedGames = collect($games->items())->map(fn ($item) => (array) $item)
            ->groupBy('dayID')
            ->values()
            ->toArray();

        $seasons = Season::all()->toArray();

        $seasons = array_map(function ($item) {
            $item['from'] = Carbon::createFromTimestamp($item['from'])->format('Y');
            $item['to'] = Carbon::createFromTimestamp($item['to'])->format('Y');

            return $item;
        }, $seasons);

        return view('admin.games', [
            'games' => $groupedGames,
            'gamesPaginator' => $games,
            'seasonID' => $season->id,
            'seasons' => $seasons,
            'divisionID' => $divisionID,
            'categoryID' => $categoryID,
        ]);
    }

    public function addGame(int $divisionID, int $categoryID)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-competition-manager')) {
            Auth::logout();
            return redirect('/');
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

        $seasonID = Season::orderBy('created_at', 'DESC')->first();

        if (is_null($seasonID)) {
            return redirect("/games/$divisionID/$categoryID")->with('error', 'create season first');
        }

        $teams = Team::where([['divisionID', $divisionID], ['categoryID', $categoryID]])->get()->toArray();

        if (empty($teams)) {
            return redirect("/games/$divisionID/$categoryID")->with('error', 'create teams first');
        }

        $days = Day::all();

        if (is_null($days)) {
            return redirect("/games/$divisionID/$categoryID")->with('error', 'create day first');
        }

        $groups = Group::all();

        if (is_null($groups)) {
            return redirect("/games/$divisionID/$categoryID")->with('error', 'No Group Found');
        }

        $seasons = Season::all()->toArray();

        if (empty($seasons)) {
            return redirect("/games/$divisionID/$categoryID")->with('error', 'No Season Found');
        }

        $seasons = array_map(function($item){
            $item['from'] = Carbon::createFromTimestamp($item['from'])->format('Y');
            $item['to'] = Carbon::createFromTimestamp($item['to'])->format('Y');

            return $item;
        }, $seasons);

        return view('admin.create-game', [
            'groups' => $groups,
            'teams' => $teams,
            'days' => $days,
            'seasons' => $seasons
        ]);
    }

    public function createGame($divisionID, $categoryID, Request $request)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-competition-manager')) {
            Auth::logout();
            return redirect('/');
        }

        $request->validate([
            "homeTeamID" => "required|numeric|min:1",
            "awayTeamID" => "required|numeric|min:1",
            "stade" => "required|string",
            "date" => "required|date",
            "dayID" => "required|numeric|min:1",
            "groupID" => [Rule::requiredIf($divisionID == 2), "nullable", "integer"],
            "seasonID" => "required|numeric|min:1",
        ]);

        if ($request->homeTeamID == $request->awayTeamID) {
            return redirect("/games/$divisionID/$categoryID")->with('error', 'choose different Teams');
        }

        // if (now() > $request->date) {
        //     return redirect("/games/$categoryID")->with('error', 'date is invalid you need to select future dates');
        // }

        $homeTeam = Team::where('id', $request->homeTeamID)->first();

        if (is_null($homeTeam)) {
            return redirect("/games/$divisionID/$categoryID")->with('error', 'Home team not found');
        }

        $awayTeam = Team::where('id', $request->awayTeamID)->first();

        if (is_null($awayTeam)) {
            return redirect("/games/$divisionID/$categoryID")->with('error', 'Home team not found');
        }

        $day = Day::where('id', $request->dayID)->first();

        if (is_null($day)) {
            return redirect("/games/$divisionID/$categoryID")->with('error', 'Day not found');
        }

        $homeGame = Game::where([['homeTeamID', $request->homeTeamID], ['dayID', $request->dayID], ["seasonID", $request->seasonID]])->first();

        if (!is_null($homeGame)) {
            return redirect("/games/$divisionID/$categoryID")->with('error', "You have created game of home team on $day->name");
        }

        $awayGame = Game::where([['homeTeamID', $request->awayTeamID], ['dayID', $request->dayID], ["seasonID", $request->seasonID]])->first();

        if (!is_null($awayGame)) {
            return redirect("/games/$divisionID/$categoryID")->with('error', "You have created game of away team on $day->name");
        }

        try {
            DB::transaction(function () use ($request) {
                $game = Game::create([
                    "homeTeamID" => $request->homeTeamID,
                    "awayTeamID" => $request->awayTeamID,
                    "stadeName" => $request->stade,
                    "homeTeamGoals" => 0,
                    "awayTeamGoals" => 0,
                    "date" => $request->date,
                    "dayID" => $request->dayID,
                    "groupID" => $request->groupID,
                    "seasonID" => $request->seasonID,
                    "userID" => Auth::id(),
                ]);

                TeamStatistic::create([
                    'gameID' => $game->id,
                    'teamID' => $request->homeTeamID,
                    'goalWin' => 0,
                    'goalLoss' => 0,
                    'score' => 0,
                    'userID' => Auth::id(),
                ]);

                TeamStatistic::create([
                    'gameID' => $game->id,
                    'teamID' => $request->awayTeamID,
                    'goalWin' => 0,
                    'goalLoss' => 0,
                    'score' => 0,
                    'userID' => Auth::id(),
                ]);
            });

            return redirect("/games/$divisionID/$categoryID")
                ->with('message', 'Game added successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function addMatchResult($divisionID, $categoryID, $id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-competition-manager')) {
            Auth::logout();
            return redirect('/');
        }

        $game = Game::where($id);

        if (!$game) {
            return redirect()->back()->with('error', 'Game not found');
        }

        // if (now() <  $game->date) {
        //     return redirect()->back()->with('error', 'not allowed to add result before match day');
        // }

        $team = DB::table('Game as a')
            ->select('b.id as homeTeamID', 'b.name as homeTeam', 'c.id as awayTeamID', 'c.name as awayTeam')
            ->join('Team as b', 'a.homeTeamID', '=', 'b.id')
            ->join('Team as c', 'a.awayTeamID', '=', 'c.id')
            ->where('a.id', $id)
            ->where('b.divisionID', $divisionID)
            ->where('c.divisionID', $divisionID)
            ->first();

        return view('admin.add-result', [
            'team' => $team,
            'gameID' => $id,
        ]);
    }

    public function createMatchResult($divisionID, $categoryID, Request $request, $gameID)
    {
        $request->validate([
            "homeTeamID" => "required|integer",
            "homeTeamGoals" => "required|integer",
            "awayTeamID" => "required|integer",
            "awayTeamGoals" => "required|integer"
        ]);

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

        $game = Game::find($gameID);

        if (!$game) {
            return redirect()->back()->with('error', 'Game not found');
        }

        $homeTeam = TeamStatistic::where([['gameID', $game->id], ['teamID', $request->homeTeamID]])->first();

        if (is_null($homeTeam)) {
            return redirect()->back()->with('error', 'Home Team not found');
        }
        $awayTeam = TeamStatistic::where([['gameID', $game->id], ['teamID', $request->awayTeamID]])->first();

        if (is_null($awayTeam)) {
            return redirect()->back()->with('error', 'Away Team not found');
        }

        try {
            DB::transaction(function () use ($request, $game, &$homeTeam, &$awayTeam) {
                $game->homeTeamGoals = $request->homeTeamGoals;
                $game->awayTeamGoals = $request->awayTeamGoals;
                $game->isPlayed = true;

                $homeTeam->goalWin = $request->homeTeamGoals;
                $homeTeam->goalLoss = $request->awayTeamGoals;

                $awayTeam->goalWin = $request->awayTeamGoals;
                $awayTeam->goalLoss = $request->homeTeamGoals;

                if ($request->homeTeamGoals > $request->awayTeamGoals) {
                    $homeTeam->score = 3;
                    $awayTeam->score = 0;
                }

                if ($request->homeTeamGoals < $request->awayTeamGoals) {
                    $homeTeam->score = 0;
                    $awayTeam->score = 3;
                }

                if ($request->homeTeamGoals === $request->awayTeamGoals) {
                    $homeTeam->score = 1;
                    $awayTeam->score = 1;
                }

                $homeTeam->save();
                $awayTeam->save();
                $game->save();
            });
            return redirect("/games/$divisionID/$categoryID")->with('message', 'Result Added successfully');
        } catch (\Exception $exception) {

            return \response()->json(
                ['message' => 'System error, contact support', 'errors' => $exception->getMessage()],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function updateFixture($id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-competition-manager')) {
            Auth::logout();
            return redirect('/');
        }

        $game = Game::find($id);

        if (!$game) {
            return redirect()->back()->with('error', 'Game not found');
        }

        if (now() >  $game->date) {
            return redirect()->back()->with('error', 'not allowed to changed finiched games');
        }

        $team = DB::table('Game as a')
            ->select('b.id as homeTeamID', 'b.name as homeTeam', 'c.id as awayTeamID', 'c.name as awayTeam')
            ->join('Team as b', 'a.homeTeamID', '=', 'b.id')
            ->join('Team as c', 'a.awayTeamID', '=', 'c.id')
            ->where('a.id', $id)
            ->first();

        $seasonID = Season::orderBy('created_at', 'DESC')->first()->id;

        $teams = Team::all();

        $days = Day::where('seasonID', $seasonID)->get();

        return view('admin.update-fixture', [
            'team' => $team,
            'game' => $game,
            'teams' => $teams,
            'days' => $days,
        ]);
    }

    public function updateGame($categoryID, Request $request, $id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-competition-manager')) {
            Auth::logout();
            return redirect('/');
        }

        $request->validate([
            "homeTeamID" => "required|integer",
            "awayTeamID" => "required|integer",
            "stade" => "required|string",
            "date" => "required|date",
            "dayID" => "required|integer",

        ]);

        $game = Game::find($id);

        if (!$game) {
            return redirect()->back()->with('error', 'Game not found');
        }

        $game->homeTeamID = $request->homeTeamID;
        $game->awayTeamID = $request->awayTeamID;
        $game->stade = $request->stade;
        $game->date = $request->date;
        $game->dayID = $request->dayID;
        $game->save();

        return redirect("/games/$categoryID")
            ->with('message', 'updated successfully');
    }

    public function deleteGame($categoryID, $id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-competition-manager')) {
            Auth::logout();
            return redirect('/');
        }

        $game = Game::find($id);

        if (!$game) {
            return redirect()->back()->with('error', 'Game not found');
        }

        try {
            DB::transaction(function () use ($game) {
                TeamStatistic::where('gameID', $game->id)->delete();
                Game::where('id', $game->id)->delete();
            });
            return redirect("/games/$categoryID")
                ->with('message', 'deleted successfully');
        } catch (\Exception $exception) {
            return \response()->json(
                ['message' => 'System error, contact support', 'errors' => $exception->getMessage()],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
