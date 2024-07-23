<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Team;
use App\Models\TeamCategory;
use App\Models\TopScore;
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

        return view('admin.create-topScore', [
            'teams' => $teams,
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
        
        TopScore::create([
            "name" => $request->name,
            "goals" => $request->goals,
            "teamName" => $team->name,
            'categoryID' => $categoryID,
            'divisionID' => $request->divisionID
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

    public function listTopScore($divisionID, $categoryID)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-competition-manager')) {
            Auth::logout();
            return redirect('/');
        }

        $division = Division::where('id', $divisionID)->first();

        if (is_null($division)) {
            return redirect(`/top-score/$divisionID/$categoryID`)
                ->with('error', 'Division not found');
        }

        $teams = Team::where([['divisionID', $divisionID], ['categoryID', $categoryID]])->get()->toArray();

        $topScores = TopScore::where([['divisionID', $divisionID], ['categoryID', $categoryID]])->orderBy('goals', 'DESC')->get();

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

        return view('admin.topScore', [
            'topScores' => $finalTopScores
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

        return view('admin.update-topScore', [
            'topScore' => $topScore,
            'teams' => $teams,
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
            "teamID" => "required|integer"

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

        $topScore->name = $request->name;
        $topScore->goals = $request->goals;
        $topScore->teamName = $team->name;
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
