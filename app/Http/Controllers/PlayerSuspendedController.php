<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Division;
use App\Models\PlayerSuspended;
use App\Models\Season;
use App\Models\Team;
use App\Models\TeamCategory;
use App\Models\TopScore;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PlayerSuspendedController extends Controller
{
    public function addPlayerSuspended($divisionID, $categoryID)
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

        $teams = Team::where([['divisionID', $divisionID], ['categoryID', $categoryID]])->get()->toArray();

        if (empty($teams)) {
            return redirect("/player-suspended/$divisionID/$categoryID")->with('error', 'create teams first');
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

        return view('admin.create-playerSuspended', [
            'teams' => $teams,
            'seasons' => $seasons
        ]);
    }

    public function createPlayerSuspended($divisionID, $categoryID, Request $request)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-competition-manager')) {
            Auth::logout();
            return redirect('/');
        }

        $request->validate([
            "seasonID" => "required|numeric|min:1",
            "dayID" => "required|numeric|min:1",
            "name" => "required|string",
            "teamID" => "required|integer",
            "reason" => "required|string|max:30",
        ]);

        $division = Division::where('id', $divisionID)->first();

        if (is_null($division)) {
            return redirect(`/create-player-suspended/$divisionID/$categoryID`)
                ->with('error', 'Division not found');
        }

        $teamCategory = TeamCategory::where('id', $categoryID)->first();

        if (is_null($teamCategory)) {
            return redirect(`/create-player-suspended/$divisionID/$categoryID`)
                ->with('error', 'Category not found');
        }

        $team = Team::where([['divisionID', $divisionID], ['id', $request->teamID]])->first();

        if (is_null($team)) {
            return redirect(`/create-player-suspended/$request->divisionID/$categoryID`)->with('error', 'team Not Found');
        }

        $season = Season::where('id', $request->seasonID)->first();

        if (is_null($season)) {
            return redirect(`/create-player-suspended/$request->divisionID/$categoryID`)->with('error', 'Season Not Found');
        }

        $day = Day::where('id', $request->dayID)->first();

        if (is_null($day)) {
            return redirect(`/create-player-suspended/$request->divisionID/$categoryID`)->with('error', 'Day Not Found');
        }
        
        PlayerSuspended::create([
            'seasonID' => $request->seasonID,
            'dayID' => $request->dayID,
            'teamID' => $request->teamID,
            'name' => $request->name,
            'reason' => $request->reason,
            'userID' => Auth::id(),
        ]);

        return redirect("/player-suspended/$divisionID/$categoryID")
            ->with('message', 'Player Suspended');
    }

    public function getPlayerSuspendedImageDoc($fileName)
    {
        if (Storage::exists('playerSuspended/' . $fileName)) {
            return Storage::response('playerSuspended/' . $fileName);
        }
        abort(404);
    }

    public function listPlayerSuspended(Request $request, $divisionID, $categoryID)
    {

        if (!Gate::allows('is-admin') && !Gate::allows('is-competition-manager')) {
            Auth::logout();
            return redirect('/');
        }

        $season = empty($request->all()) ? Season::orderBy('created_at', 'DESC')->first() : Season::where('id', $request->seasonID)->first();

        if (is_null($season)) {
            return redirect(`/player-suspended/$divisionID/$categoryID`)
                ->with('error', 'Season not found');
        }

        $division = Division::where('id', $divisionID)->first();

        if (is_null($division)) {
            return redirect(`/player-suspended/$divisionID/$categoryID`)
                ->with('error', 'Division not found');
        }

        $day = empty($request->all()) ? Day::where('seasonID', $season->id)->orderBy('created_at', 'DESC')->first() : Day::where([['seasonID', $season->id], ['id', $request->dayID]])->first();

        $teams = Team::where([['divisionID', $divisionID], ['categoryID', $categoryID]])->get()->toArray();
        $days = Day::where([['seasonID', $season->id]])->get()->toArray();

        $playerSuspendeds = PlayerSuspended::with('creator')
            ->where('seasonID', $season->id)
            ->when(!is_null($day), function ($query) use ($day) {
                return $query->where('dayID', $day->id);
            })
            ->orderByDesc('id')
            ->paginate(10);

        $teamsById = collect($teams)->keyBy('id');
        $daysById = collect($days)->keyBy('id');

        $playerSuspendeds->getCollection()->transform(function ($value) use ($teamsById, $daysById) {
            $team = $teamsById->get($value->teamID);
            $dayItem = $daysById->get($value->dayID);
            if (!$team || !$dayItem) {
                return null;
            }

            return [
                'id' => $value->id,
                'name' => $value->name,
                'teamName' => $team['name'],
                'reason' => $value->reason,
                'period' => $dayItem['name'],
                'creator_name' => optional($value->creator)->name,
            ];
        });

        $playerSuspendeds->setCollection($playerSuspendeds->getCollection()->filter()->values());

        $seasons = Season::all()->toArray();

        $seasons = array_map(function ($item) {
            $item['from'] = Carbon::createFromTimestamp($item['from'])->format('Y');
            $item['to'] = Carbon::createFromTimestamp($item['to'])->format('Y');

            return $item;
        }, $seasons);

        return view('admin.playerSuspended', [
            'playerSuspendeds' => $playerSuspendeds,
            'seasonID' => $season->id,
            'seasons' => $seasons,
            'days' => $days,
            'dayID' => optional($day)->id,
            'divisionID' => $divisionID,
            'categoryID' => $categoryID,
        ]);
    }

    public function editPlayerSuspended($divisionID, $categoryID, $id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-competition-manager')) {
            Auth::logout();
            return redirect('/');
        }

        $playerSuspended = PlayerSuspended::find($id);

        if (!$playerSuspended) {
            return redirect()->back()->with('failed', 'PlayerSuspended not found');
        }

        $teams = Team::where([['divisionID', $divisionID], ['categoryID', $categoryID]])->get()->toArray();

        if (empty($teams)) {
            return redirect("/player-suspended/ $divisionID/$categoryID")->with('error', 'create teams first');
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

        return view('admin.update-playerSuspended', [
            'playerSuspended' => $playerSuspended,
            'teams' => $teams,
            'seasons' => $seasons
        ]);
    }


    public function updatePlayerSuspended($divisionID, $categoryID, Request $request, $id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-competition-manager')) {
            Auth::logout();
            return redirect('/');
        }

        $request->validate([
            "seasonID" => "required|numeric|min:1",
            "dayID" => "required|numeric|min:1",
            "name" => "required|string",
            "teamID" => "required|integer",
            "reason" => "required|string|max:30",
        ]);

        $division = Division::where('id', $divisionID)->first();

        if (is_null($division)) {
            return redirect("/player-suspended/ $divisionID/$categoryID")
                ->with('error', 'Division not found');
        }

        $playerSuspended = PlayerSuspended::find($id);

        if (!$playerSuspended) {
            return redirect()->back()->with('fail', 'PlayerSuspended not found');
        }

        $team = Team::where([['divisionID', $divisionID], ['id', $request->teamID]])->first();

        if (is_null($team)) {
            return redirect(`/create-player-suspended/$request->divisionID/$categoryID`)->with('error', 'team Not Found');
        }

        $season = Season::where('id', $request->seasonID)->first();

        if (is_null($season)) {
            return redirect(`/create-player-suspended/$request->divisionID/$categoryID`)->with('error', 'Season Not Found');
        }

        $day = Day::where('id', $request->dayID)->first();

        if (is_null($day)) {
            return redirect(`/create-player-suspended/$request->divisionID/$categoryID`)->with('error', 'Day Not Found');
        }

        $playerSuspended->name = $request->name;
        $playerSuspended->reason = $request->reason;
        $playerSuspended->teamID = $team->id;
        $playerSuspended->seasonID = $request->seasonID;
        $playerSuspended->dayID = $request->dayID;
        $playerSuspended->save();

        return redirect("/player-suspended/$divisionID/$categoryID")
            ->with('message', 'updated successfully');
    }


    public function deletePlayerSuspended($categoryID, $id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-competition-manager')) {
            Auth::logout();
            return redirect('/');
        }

        $playerSuspended = TopScore::find($id);

        if (!$playerSuspended) {
            return redirect("/player-suspended/$categoryID")
                ->with('error', 'Top Score not found');
        }

        $playerSuspended->delete();

        return redirect("/player-suspended/$categoryID")
            ->with('message', 'deleted successfully');
    }
}
