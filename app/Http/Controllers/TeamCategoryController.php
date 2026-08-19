<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\TeamCategory;
use App\Support\FilteredExport;
use App\Support\ListFilters;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class TeamCategoryController extends Controller
{
    public function addTeamCategory()
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-competition-manager')) {
            Auth::logout();
            return redirect('/');
        }

        return view('admin.create-teamCategory');
    }

    public function createteamCategory(Request $request)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-competition-manager')) {
            Auth::logout();
            return redirect('/');
        }
        $request->validate([
            "name" => "required|string",
        ]);

        TeamCategory::create([
            "name" => $request->name,
            "userID" => Auth::id(),
        ]);

        return redirect('/team-category')
            ->with('message', 'Member is added successfully');
    }

    public function listTeamCategory(Request $request)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-competition-manager')) {
            Auth::logout();
            return redirect('/');
        }

        $filters = ListFilters::fromRequest($request);

        $teamCategorys = TeamCategory::with('creator');
        ListFilters::apply($teamCategorys, $filters);
        $teamCategorys->orderByDesc('id');

        if (FilteredExport::requested($request)) {
            $rows = $teamCategorys->get()->map(function ($value) {
                return [
                    $value->name,
                    optional($value->creator)->name ?? '—',
                ];
            })->all();

            return FilteredExport::download(
                'Team Categories',
                $filters,
                ['Name', 'Created by'],
                $rows,
                $request->input('format')
            );
        }

        $teamCategorys = $teamCategorys->paginate(10);

        $teamCategorys->getCollection()->transform(function ($value) {
            return [
                'id' => $value->id,
                'name' => $value->name,
                'creator_name' => optional($value->creator)->name,
            ];
        });

        return view('admin.teamCategory', array_merge(ListFilters::viewData($request), [
            'teamCategorys' => $teamCategorys,
        ]));
    }

    public function editTeamCategory($id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-competition-manager')) {
            Auth::logout();
            return redirect('/');
        }
        $teamCategory = TeamCategory::find($id);

        if (!$teamCategory) {
            return redirect()->back()->with('errors', 'TeamCategory not found');
        }

        return view('admin.update-TeamCategory', [
            'teamCategory' => $teamCategory
        ]);
    }


    public function updateTeamCategory(Request $request, $id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-competition-manager')) {
            Auth::logout();
            return redirect('/');
        }

        $request->validate([
            "name" => "required|string"
        ]);

        $teamCategory = TeamCategory::find($id);

        if (!$teamCategory) {
            return redirect()->back()->with('errors', 'TeamCategory not found');
        }

        $teamCategory->name = $request->name;
        $teamCategory->save();

        return redirect('/team-category')
            ->with('message', 'updated successfully');
    }


    public function deleteTeamCategory($id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-competition-manager')) {
            Auth::logout();
            return redirect('/');
        }

        $teamCategory = TeamCategory::find($id);

        if (!$teamCategory) {
            return redirect('/team-category')
                ->with('error', 'TeamCategory not found');
        }

        $team = Team::where('categoryID', $id)->first();

        if (!is_null($team)) {
            return redirect('/team-category')
                ->with('error', 'Cant be deleted, has been used');
        }

        $teamCategory->delete();

        return redirect('/team-category')
            ->with('message', 'deleted successfully');
    }
}
