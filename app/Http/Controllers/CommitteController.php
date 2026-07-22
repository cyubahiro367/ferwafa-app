<?php

namespace App\Http\Controllers;

use App\Models\Committe;
use App\Models\CommitteeCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CommitteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['getComitteImageDoc', 'listAllCommitte']]);
    }

    public function addMember()
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        $committees = CommitteeCategory::all()->toArray();

        return view('admin.create-committe', [
           "committees" => $committees
        ]);
    }

    public function createCommitte(Request $request)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        $request->validate([
            "committeeCategoryID" => "required|integer|min:1",
            "name" => "required|string",
            "position" => "required|string|max:255",
            "image" => "nullable|file|max:5000|mimes:png,jpg,jpeg"

        ]);

        $committeeCategory = CommitteeCategory::where('id', $request->committeeCategoryID)->First();

        if(is_null($committeeCategory))
        {
            return redirect()->back()->with('error', 'Committee category is not found');
        }

        $path = !is_null($request->image) ? $request->image->store('committe') : null;

        Committe::create([
            "name" => $request->name,
            "position" => $request->position,
            "image_url" => $path,
            'committeeCategoryID' => $request->committeeCategoryID
        ]);

        return redirect('/committe')
            ->with('message', 'Member is added successfully');
    }

    public function getComitteImageDoc($fileName)
    {
        if (Storage::exists('committe/' . $fileName)) {
            return Storage::response('committe/' . $fileName);
        }
        abort(404);
    }

    public function listCommitte()
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        $committe = Committe::all();

        $finalCommitte = [];

        foreach ($committe as $value) {
            $fileUrl = !is_null($value->image_url) ? explode('/', $value->image_url)[1] : null;
            $committeMember = [
                "id" => $value->id,
                "name" => $value->name,
                "position" => $value->position,
                "created_at" => $value->created_at,
                "updataed_at" => $value->updated_at,
                "url" => $fileUrl
            ];
            array_push($finalCommitte, $committeMember);
        }

        return view('admin.committe', [
            'committes' => $finalCommitte
        ]);
    }

    public function listAllCommitte()
    {
        $committe = Committe::where("committeeCategoryID", 11)->get();

        $finalCommitte = [];

        foreach ($committe as $value) {
            $fileUrl = explode('/', $value->image_url)[1];
            $committeMember = [
                "id" => $value->id,
                "name" => $value->name,
                "position" => $value->position,
                "created_at" => $value->created_at,
                "updataed_at" => $value->updated_at,
                "url" => $fileUrl
            ];
            array_push($finalCommitte, $committeMember);
        }

        return view('about', [
            'committe' => $finalCommitte
        ]);
    }

    public function editCommitte($id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        $committe = Committe::find($id);

        if (!$committe) {
            return redirect()->back()->with('fail', 'member not found');
        }

        return view('admin.update-committe', [
            'committe' => $committe
        ]);
    }

    public function updateCommitte(Request $request, $id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        $request->validate([
            "name" => "required|string",
            "position" => "required|string|max:255",
            "image" => "required|file|max:5000|mimes:png,jpg,jpeg"

        ]);

        $committe = Committe::find($id);

        if (!$committe) {
            return redirect()->back()->with('fail', 'member not found');
        }

        Storage::delete($committe->image_url);

        $path = $request->image->store('committe');
        $committe->name = $request->name;
        $committe->position = $request->position;
        $committe->image_url = $path;
        $committe->save();

        return redirect('/committe')
            ->with('message', 'updated successfully');
    }


    public function deleteCommitte($id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        $committe = Committe::find($id);

        if (!$committe) {
            return response()->json(["errors" => "committe not found"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        Storage::delete($committe->image_url);

        $committe->delete();

        return redirect('/committe')
            ->with('message', 'Member is deleted');
    }
}
