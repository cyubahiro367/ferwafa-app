<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventUrl;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except' => ['getEventImage','allEvents','getSingleEvent']]);
    }

    public function createEvent(Request $request)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        $request->validate([
            "name" => "required|string",
            "description" => "required|string",
            "statusID" => "required|in:1,2,3",
            "date" => "required",
            "image" => "required|file|max:5000|mimes:png,jpg,jpeg"
        ]);

        DB::transaction(function () use ($request) {

            $news = Event::create([
                "name" => $request->name,
                "description" => $request->description,
                "event_date" => 12334564,
                "statusID" => $request->statusID
            ]);

            $path = $request->image->store('eventImages');
            EventUrl::create([
                "image_url" => $path,
                "event_id" => $news->id
            ]);
        });


        return redirect('/event-view')
            ->with('message', 'Event has been created!');
    }

    public function getEventImage($fileName)
    {
        if (Storage::exists('eventImages/' . $fileName)) {
            return Storage::response('eventImages/' . $fileName);
        }
        abort(404);
    }

    public function allEvents()
    {
        $events = DB::select('SELECT a.*,b.image_url,c.statusName FROM 
                                Event AS a
                                JOIN EventUrl AS b
                                ON b.event_id = a.id
                                JOIN Status AS c
                                ON a.statusID = c.id
                                WHERE  c.id = 1
                                ORDER BY created_at DESC');

        $result = [];

        foreach ($events as $value) {
            $fileUrl = explode('/', $value->image_url)[1];
            $singleEvent = [
                "id" => $value->id,
                "name" => $value->name,
                "date" => $value->date,
                "description" => $value->description,
                "status" => $value->statusName,
                "created_at" => Carbon::parse($value->created_at)->format('d-m-Y'),
                "updated_at" => Carbon::parse($value->updated_at)->format('d-m-Y'),
                "image_url" => $fileUrl
            ];
            array_push($result, $singleEvent);
        }

        return view(
            'all_event',
            ["result" => $result]
        );
    }

    public function getSingleEvent($id)
    {
        $result = Event::where('id', $id)->first();
        $eventUrls = EventUrl::where('event_id', $id)->get();
        $urls = [];
        foreach ($eventUrls as $value) {
            $fileUrl = explode('/', $value->image_url)[1];
            $eventUrl = [
                'url' => $fileUrl
            ];
            array_push($urls, $eventUrl);
        }
        return view('single_event', [
            'result' => $result,
            'url' => $urls
        ]);
    }
}
