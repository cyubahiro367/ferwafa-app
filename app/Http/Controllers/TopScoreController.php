<?php

namespace App\Http\Controllers;

use App\Models\Division;
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

class TopScoreController extends Controller
{
    public function addTopScore($divisionID, $categoryID)
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
            return redirect("/top-score/$divisionID/$categoryID")->with('error', 'create teams first');
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

        return view('admin.create-topScore', [
            'teams' => $teams,
            'seasons' => $seasons
        ]);
    }

    public function createTopScore($divisionID, $categoryID, Request $request)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-competition-manager')) {
            Auth::logout();
            return redirect('/');
        }

        $request->validate([
            "name" => "required|string",
            "goals" => "required|integer",
            "teamID" => "required|integer",
            "seasonID" => "required|numeric|min:1",
        ]);

        $division = Division::where('id', $divisionID)->first();

        if (is_null($division)) {
            return redirect(`/create-top-score/$divisionID/$categoryID`)
                ->with('error', 'Division not found');
        }

        $teamCategory = TeamCategory::where('id', $categoryID)->first();

        if (is_null($division)) {
            return redirect(`/create-top-score/$divisionID/$categoryID`)
                ->with('error', 'Division not found');
        }

        $team = Team::where([['divisionID', $divisionID], ['id', $request->teamID]])->first();

        if (is_null($team)) {
            return redirect(`/create-top-score/$request->divisionID/$categoryID`)->with('error', 'team Not Found');
        }

        $season = Season::where('id', $request->seasonID)->first();

        if (is_null($season)) {
            return redirect(`/create-top-score/$request->divisionID/$categoryID`)->with('error', 'Season Not Found');
        }
        
        TopScore::create([
            "name" => $request->name,
            "goals" => $request->goals,
            "teamName" => $team->name,
            'categoryID' => $categoryID,
            'divisionID' => $request->divisionID,
            "seasonID" => $request->seasonID,
        ]);

        return redirect("/top-score/$divisionID/$categoryID")
            ->with('message', 'Member is added successfully');
    }

    public function getTopScoreImageDoc($fileName)
    {
        if (Storage::exists('topScore/' . $fileName)) { {
                return response()->file(storage_path('/app/topScore/' . $fileName));
            }
        }
    }

    public function listTopScore(Request $request, $divisionID, $categoryID)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-competition-manager')) {
            Auth::logout();
            return redirect('/');
        }

        $season = empty($request->all()) ? Season::orderBy('created_at', 'DESC')->first() : Season::where('id', $request->seasonID)->first();

        if (is_null($season)) {
            return redirect("/games/$divisionID/$categoryID")->with('error', 'create season first');
        }

        if (is_null($season)) {
            return redirect(`/top-score/$divisionID/$categoryID`)
                ->with('error', 'Season not found');
        }

        $division = Division::where('id', $divisionID)->first();

        if (is_null($division)) {
            return redirect(`/top-score/$divisionID/$categoryID`)
                ->with('error', 'Division not found');
        }

        $teams = Team::where([['divisionID', $divisionID], ['categoryID', $categoryID]])->get()->toArray();

        $topScores = TopScore::where([['seasonID', $season->id], ['divisionID', $divisionID], ['categoryID', $categoryID]])->orderBy('goals', 'DESC')->get();

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

        $seasons = Season::all()->toArray();
              
        $seasons = array_map(function($item){
            $item['from'] = Carbon::createFromTimestamp($item['from'])->format('Y');
            $item['to'] = Carbon::createFromTimestamp($item['to'])->format('Y');

            return $item;
        }, $seasons);

        return view('admin.topScore', [
            'topScores' => $finalTopScores,
            'seasonID' => $season->id,
            'seasons' => $seasons
        ]);
    }

    public function editTopScore($divisionID, $categoryID, $id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-competition-manager')) {
            Auth::logout();
            return redirect('/');
        }
        $topScore = TopScore::find($id);

        if (!$topScore) {
            return redirect()->back()->with('failed', 'TopScore not found');
        }

        $teams = Team::where([['divisionID', $divisionID], ['categoryID', $categoryID]])->get()->toArray();

        if (empty($teams)) {
            return redirect("/top-score/ $divisionID/$categoryID")->with('error', 'create teams first');
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

        return view('admin.update-topScore', [
            'topScore' => $topScore,
            'teams' => $teams,
            'seasons' => $seasons
        ]);
    }


    public function updateTopScore($divisionID, $categoryID, Request $request, $id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-competition-manager')) {
            Auth::logout();
            return redirect('/');
        }

        $request->validate([
            "name" => "required|string",
            "goals" => "required|integer",
            "teamID" => "required|integer",
            "seasonID" => "required|numeric|min:1",

        ]);

        $division = Division::where('id', $divisionID)->first();

        if (is_null($division)) {
            return redirect("/top-score/ $divisionID/$categoryID")
                ->with('error', 'Division not found');
        }

        $topScore = TopScore::find($id);

        if (!$topScore) {
            return redirect()->back()->with('fail', 'TopScore not found');
        }

        $team = Team::where([['divisionID', $divisionID], ['categoryID',$categoryID], ['id', $request->teamID]])->first();

        if (is_null($team)) {
            return redirect("/top-score/ $divisionID/$categoryID")->with('error', 'team Not Found');
        }

        $season = Season::where('id', $request->seasonID)->first();

        if (is_null($season)) {
            return redirect(`/create-top-score/$request->divisionID/$categoryID`)->with('error', 'Season Not Found');
        }

        $topScore->name = $request->name;
        $topScore->goals = $request->goals;
        $topScore->teamName = $team->name;
        $topScore->seasonID = $request->seasonID;
        $topScore->save();

        return redirect("/top-score/$divisionID/$categoryID")
            ->with('message', 'updated successfully');
    }


    public function deleteTopScore($categoryID, $id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-competition-manager')) {
            Auth::logout();
            return redirect('/');
        }

        $topScore = TopScore::find($id);

        if (!$topScore) {
            return redirect("/top-score/$categoryID")
                ->with('error', 'Top Score not found');
        }

        $topScore->delete();

        return redirect("/top-score/$categoryID")
            ->with('message', 'deleted successfully');
    }
}
