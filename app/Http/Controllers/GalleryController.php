<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['getImages', 'displayGalleryImage']]);
    }

    public function addGallery()
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        return view('admin.create-gallery');
    }

    public function createGallery(Request $request)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        $request->validate([
            "name" => "required|string",
            "image" => "required|file|max:5000|mimes:png,jpg,jpeg,svg"

        ]);

        $path = $request->image->store('gallery');

        Gallery::create([
            "name" => $request->name,
            "url" => $path,
            "userID" => Auth::id(),
        ]);

        return redirect('/gallery-view')
            ->with('message', 'Photo crated successfully');
    }

    public function galleryList()
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        $gallerries = DB::table('Gallery as g')
            ->leftJoin('users as u', 'u.id', '=', 'g.userID')
            ->select('g.*', 'u.name as creator_name')
            ->orderByDesc('g.id')
            ->paginate(10);

        $gallerries->getCollection()->transform(function ($value) {
            $parts = explode('/', $value->url);
            return [
                'id' => $value->id,
                'name' => $value->name,
                'created_at' => $value->created_at,
                'updataed_at' => $value->updated_at,
                'height' => $value->height,
                'width' => $value->width,
                'url' => $parts[1] ?? $value->url,
                'creator_name' => $value->creator_name,
            ];
        });

        return view('admin.gallery', [
            'galleries' => $gallerries,
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function getImages()
    {
        $paginator = DB::table('Gallery')->orderByDesc('created_at')->paginate(12);

        $paginator->getCollection()->transform(function ($value) {
            $parts = explode('/', $value->url);
            return (object) [
                'id' => $value->id,
                'name' => $value->name,
                'created_at' => $value->created_at,
                'updated_at' => $value->updated_at,
                'height' => $value->height,
                'width' => $value->width,
                'url' => $parts[1] ?? $value->url,
            ];
        });

        return view('gallery', [
            'galleries' => $paginator,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function displayGalleryImage($id)
    {
        $record = Gallery::findOrFail($id);
        $fileName = basename($record->url);

        if (Storage::exists('gallery/' . $fileName)) {
            return Storage::response('gallery/' . $fileName);
        }
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        $gallery = Gallery::find($id);

        if (!$gallery) {
            return redirect()->back()->with('failed', 'Photo not found');
        }

        return view('admin.update-gallery', [
            'gallery' => $gallery
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        $request->validate([
            "name" => "required|string",
            "image" => "required|file|max:5000|mimes:png,jpg,jpeg,svg"

        ]);

        $gallery = Gallery::find($id);

        if (!$gallery) {
            return redirect()->back()->with('failed', 'Photo not found');
        }

        Storage::delete($gallery->url);
        $path = $request->image->store('gallery');

        $gallery->name = $request->name;
        $gallery->url = $path;
        $gallery->save();

        return redirect('/gallery-view')
            ->with('message', 'updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        $gallery = Gallery::find($id);

        if (!$gallery) {
            return redirect()->back()->with('failed', 'Photo not found');
        }

        Storage::delete($gallery->url);

        $gallery->delete();

        return redirect('/gallery-view')
            ->with('message', 'Deleted successfully');
    }
}
