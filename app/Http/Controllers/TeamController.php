<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Game;
use App\Models\Team;
use App\Models\TeamCategory;
use App\Models\TeamStatistic;
use App\Support\FilteredExport;
use App\Support\ListFilters;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['getTeamImageDoc']]);
    }


    public function addTeam($divisionID, $categoryID)
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

        $teamCategory = TeamCategory::all()->toArray();

        if (empty($teamCategory)) {
            return redirect("/team/$divisionID/$categoryID")
                ->with('error', 'Create Team Category first');
        }

        $divisions = Division::all()->toArray();

        if (empty($divisions)) {
            return redirect("/team/$divisionID/$categoryID")
                ->with('error', 'Contact Support');
        }

        return view('admin.create-team', [
            "categories" => $teamCategory,
            "divisions" => $categoryID == 1 ? array_filter($divisions, function($item){
                                return $item['id'] == 2;
                            }) : $divisions
        ]);
    }

    public function createTeam($categoryID, Request $request)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-competition-manager')) {
            Auth::logout();
            return redirect('/');
        }

        $request->validate([
            "name" => "required|string",
            "logo" => "required|file|max:5000|mimes:png,jpg,jpeg,svg",
            "categoryID" => "required|integer",
            "divisionID" => "required|integer"

        ]);

        $division = Division::where('id', $request->divisionID)->first();
        
        if (is_null($division)) {
            return redirect('/')
                ->with('error', 'Division not found');
        }

        $teamCategory = TeamCategory::where('id', $request->categoryID)->first();
        
        if (is_null($teamCategory)) {
            return redirect('/')
                ->with('error', 'Team category not found');
        }

        $path = $request->logo->store('team');
        
        DB::transaction(function() use($request, $path, $teamCategory, $division){
            Team::create([
                "name" => $request->name,
                "categoryID" => $teamCategory->id,
                "logo" => $path,
                "divisionID" => $division->id,
                "userID" => Auth::id(),
            ]);
        });

        return redirect("/team/$request->divisionID/$categoryID")
            ->with('message', 'Member is added successfully');
    }

    public function getTeamImageDoc($id)
    {
        $record = Team::findOrFail($id);
        $fileName = basename($record->logo);

        if (Storage::exists('team/' . $fileName)) {
            return Storage::response('team/' . $fileName);
        }
        abort(404);
    }

    public function listTeam(Request $request, $divisionID, $categoryID)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-competition-manager')) {
            Auth::logout();
            return redirect('/');
        }

        $division = Division::where('id', $divisionID)->first();

        if (is_null($division)) {
            return redirect(`/team/$divisionID/$categoryID`)
                ->with('error', 'Division not found');
        }

        $filters = ListFilters::fromRequest($request);

        $teams = DB::table('Team AS a')
            ->join('TeamCategory AS b', 'a.categoryID', '=', 'b.id')
            ->leftJoin('users as u', 'u.id', '=', 'a.userID')
            ->select(['a.id', 'a.name', 'a.logo', 'b.name AS category', 'u.name as creator_name', 'a.created_at'])
            ->where('categoryID', $categoryID)
            ->where('divisionID', $divisionID);

        ListFilters::apply($teams, $filters, 'a.userID', 'a.created_at');
        $teams->orderBy('name', 'asc');

        if (FilteredExport::requested($request)) {
            $rows = $teams->get()->map(function ($value) {
                return [
                    $value->name,
                    $value->category,
                    $value->creator_name ?? '—',
                ];
            })->all();

            return FilteredExport::download(
                'Teams',
                $filters,
                ['Name', 'Category', 'Created by'],
                $rows,
                $request->input('format')
            );
        }

        $teams = $teams->paginate(10);

        $teams->getCollection()->transform(function ($value) {
            $parts = explode('/', $value->logo);
            return [
                'id' => $value->id,
                'name' => $value->name,
                'category' => $value->category,
                'url' => $parts[1] ?? $value->logo,
                'creator_name' => $value->creator_name,
            ];
        });

        return view('admin.teams', array_merge(ListFilters::viewData($request), [
            'teams' => $teams,
            'divisionID' => $divisionID,
            'categoryID' => $categoryID,
        ]));
    }

    public function editTeam($divisionID, $categoryID, $id)
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

        $team = Team::find($id);
        $teamCategory = TeamCategory::all()->toArray();

        if (!$team) {
            return redirect()->back()->with('errors', 'Team not found');
        }

        $divisions = Division::all()->toArray();

        if (empty($divisions)) {
            return redirect("/team/$divisionID/$categoryID")
                ->with('error', 'Contact Support');
        }

        return view('admin.update-team', [
            'team' => $team,
            'categories' => $teamCategory,
            'divisions' => $divisions
        ]);
    }


    public function updateTeam($categoryID, Request $request, $id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-competition-manager')) {
            Auth::logout();
            return redirect('/');
        }

        $request->validate([
            "name" => "required|string",
            "logo" => "required|file|max:5000|mimes:png,jpg,jpeg,svg",
            "categoryID" => "required|integer",
            "divisionID" => "required|integer"
        ]);
        
        $division = Division::where('id', $request->divisionID)->first();
        
        if (is_null($division)) {
            return redirect('/')
                ->with('error', 'Division not found');
        }

        $teamCategory = TeamCategory::where('id', $request->categoryID)->first();
        
        if (is_null($teamCategory)) {
            return redirect('/')
                ->with('error', 'Team category not found');
        }

        $team = Team::find($id);

        if (!$team) {
            return redirect()->back()->with('errors', 'Team not found');
        }

        Storage::delete($team->logo);
        $path = $request->logo->store('team');

        $team->name = $request->name;
        $team->logo = $path;
        $team->categoryID = $request->categoryID;
        $team->divisionID = $request->divisionID;
        $team->save();

        return redirect("/team/$request->divisionID/$categoryID")
            ->with('message', 'updated successfully');
    }


    public function deleteTeam($divisionID, $categoryID,$id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-competition-manager')) {
            Auth::logout();
            return redirect('/');
        }

        $division = Division::where('id', $divisionID)->first();

        if (is_null($division)) {
            return redirect(`/team/$divisionID/$categoryID`)
                ->with('error', 'Division not found');
        }

        $team = Team::find($id);

        if (!$team) {
            return redirect("/team/$categoryID")->with('error', 'Team not found');
        }

        $teamStatistics = TeamStatistic::where('teamID', $id)->first();

        if (!is_null($teamStatistics)) {
            return redirect("/team/$categoryID")
                ->with('error', 'Team cant be deleted, has used in matches');
        }

        Storage::delete($team->logo);
        $team->delete();

        return redirect("/team/$divisionID/$categoryID")
            ->with('message', 'deleted successfully');
    }
}