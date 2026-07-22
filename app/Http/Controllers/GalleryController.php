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
            "url" => $path
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

        $gallerries = DB::table('Gallery')->paginate();

        $finalGallery = [];

        foreach ($gallerries as $value) {
            $fileUrl = explode('/', $value->url)[1];
            $gallery = [
                "id" => $value->id,
                "name" => $value->name,
                "created_at" => $value->created_at,
                "updataed_at" => $value->updated_at,
                "height" => $value->height,
                "width" => $value->width,
                "url" => $fileUrl
            ];
            array_push($finalGallery, $gallery);
        }

        return view('admin.gallery', [
            'galleries' => $finalGallery
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function getImages()
    {
        $gallerries = DB::table('Gallery')->paginate();

        $finalGallery = [];

        foreach ($gallerries as $value) {
            $fileUrl = explode('/', $value->url)[1];
            $gallery = [
                "id" => $value->id,
                "name" => $value->name,
                "created_at" => $value->created_at,
                "updataed_at" => $value->updated_at,
                "height" => $value->height,
                "width" => $value->width,
                "url" => $fileUrl
            ];
            array_push($finalGallery, $gallery);
        }

        return view('gallery', [
            'galleries' => $finalGallery
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
