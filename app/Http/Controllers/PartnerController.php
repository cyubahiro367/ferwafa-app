<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Support\FilteredExport;
use App\Support\ListFilters;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PartnerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['getPartnerImageDoc']]);
    }

    public function addPartner()
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        return view('admin.create-partner');
    }

    public function createPartner(Request $request)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }
        $request->validate([
            "link" => "required|string",
            "image" => "required|file|max:5000|mimes:png,jpg,jpeg,svg"

        ]);

        $path = $request->image->store('partner');

        Partner::create([
            "link" => $request->link,
            "image_url" => $path,
            "userID" => Auth::id(),
        ]);

        return redirect('/parteners')
            ->with('message', 'Member is added successfully');
    }

    public function getPartnerImageDoc($id)
    {
        $record = Partner::findOrFail($id);
        $fileName = basename($record->image_url);

        if (Storage::exists('partner/' . $fileName)) {
            return Storage::response('partner/' . $fileName);
        }
        abort(404);
    }

    public function listPartner(Request $request)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        $filters = ListFilters::fromRequest($request);

        $partners = Partner::with('creator');
        ListFilters::apply($partners, $filters);
        $partners->orderByDesc('id');

        if (FilteredExport::requested($request)) {
            $rows = $partners->get()->map(function ($value) {
                return [
                    $value->link,
                    optional($value->creator)->name ?? '—',
                ];
            })->all();

            return FilteredExport::download(
                'Partners',
                $filters,
                ['Link', 'Created by'],
                $rows,
                $request->input('format')
            );
        }

        $partners = $partners->paginate(10);

        $partners->getCollection()->transform(function ($value) {
            $parts = explode('/', $value->image_url);
            return [
                'id' => $value->id,
                'link' => $value->link,
                'created_at' => $value->created_at,
                'updataed_at' => $value->updated_at,
                'url' => $parts[1] ?? $value->image_url,
                'creator_name' => optional($value->creator)->name,
            ];
        });

        return view('admin.partner', array_merge(ListFilters::viewData($request), [
            'partners' => $partners,
        ]));
    }

    public function editPartner($id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }
        $partner = Partner::find($id);

        if (!$partner) {
            return redirect()->back()->with('errors', 'Partner not found');
        }

        return view('admin.update-partner', [
            'partner' => $partner
        ]);
    }


    public function updatePartner(Request $request, $id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        $request->validate([
            "link" => "required|string",
            "image" => "required|file|max:5000|mimes:png,jpg,jpeg,svg"

        ]);

        $partner = Partner::find($id);

        if (!$partner) {
            return redirect()->back()->with('errors', 'Partner not found');
        }

        Storage::delete($partner->image_url);
        $path = $request->image->store('partner');

        $partner->link = $request->link;
        $partner->image_url = $path;
        $partner->save();

        return redirect('/parteners')
            ->with('message', 'updated successfully');
    }


    public function deletePartner($id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        $partner = Partner::find($id);

        if (!$partner) {
            return redirect('/parteners')
                ->with('errors', 'Partner not found');
        }

        Storage::delete($partner->image_url);

        $partner->delete();

        return redirect('/parteners')
            ->with('message', 'deleted successfully');
    }
}
