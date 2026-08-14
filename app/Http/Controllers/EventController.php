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
                "statusID" => $request->statusID,
                "userID" => Auth::id(),
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

    public function getEventImage($id)
    {
        $record = EventUrl::findOrFail($id);
        $fileName = basename($record->image_url);

        if (Storage::exists('eventImages/' . $fileName)) {
            return Storage::response('eventImages/' . $fileName);
        }
        abort(404);
    }

    public function allEvents()
    {
        $paginator = DB::table('Event as a')
            ->join('EventUrl as b', 'b.event_id', '=', 'a.id')
            ->join('Status as c', 'a.statusID', '=', 'c.id')
            ->where('c.id', 1)
            ->select('a.*', 'b.id as image_id', 'b.image_url', 'c.name as status_name')
            ->orderByDesc('a.created_at')
            ->paginate(12);

        $paginator->getCollection()->transform(function ($value) {
            $parts = explode('/', $value->image_url);
            return (object) [
                'id' => $value->id,
                'name' => $value->name,
                'date' => $value->event_date ?? ($value->date ?? null),
                'description' => $value->description,
                'status' => $value->status_name,
                'created_at' => $value->created_at,
                'updated_at' => $value->updated_at,
                'image_id' => $value->image_id,
                'image_url' => $parts[1] ?? $value->image_url,
            ];
        });

        return view('events.index', [
            'result' => $paginator,
        ]);
    }

    public function getSingleEvent($id)
    {
        $result = Event::where('id', $id)->firstOrFail();
        $eventUrls = EventUrl::where('event_id', $id)->get();
        $urls = [];
        foreach ($eventUrls as $value) {
            $parts = explode('/', $value->image_url);
            $urls[] = [
                'id' => $value->id,
                'url' => $parts[1] ?? $value->image_url,
            ];
        }
        return view('events.show', [
            'result' => $result,
            'url' => $urls,
        ]);
    }
}
