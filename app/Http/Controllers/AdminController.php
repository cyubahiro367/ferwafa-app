<?php

namespace App\Http\Controllers;

use App\Models\Committe;
use App\Models\Document;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\News;
use App\Models\NewsType;
use App\Models\Partner;
use App\Models\Status;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createNewsView()
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        $statuses = Status::all();

        $newsTypes = NewsType::all();

        return view('admin.create-news', [
            "statuses" => $statuses,
            "newsTypes" => $newsTypes
        ]);
    }
    public function adminView()
    {
        $news = News::count();
        $events = Event::count();
        $commites = Committe::count();
        $docs = Document::count();
        $gallery = Gallery::count();
        $partners = Partner::count();
        return view('admin.admin', [
            'numberOfNews' => $news,
            'numberOfEvents' => $events,
            'numberOfcommitte' => $commites,
            'numberOfDocs' => $docs,
            'numberOfPhotos' => $gallery,
            'numberOfPartners' => $partners
        ]);
    }

    public function getNewsForAdmin()
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        $news = DB::table('News as a')
                    ->join('NewsUrl as b', 'b.news_id', '=', 'a.id')
                    ->join('Status as c', 'a.statusID', '=', 'c.id')
                    ->select('a.id', 'a.title', 'a.caption', 'a.description', 'a.is_top', 'a.created_at', 'a.updated_at', 'b.id as image_id', 'b.image_url', 'c.name')
                    ->orderBy('a.id', 'DESC')
                    ->limit(10)
                    ->get()
                    ->toArray();

        $result = [];

        foreach ($news as $value) {
            $fileUrl = explode('/', $value->image_url)[1];
            $singleNews = [
                "id" => $value->id,
                "title" => $value->title,
                "caption" => $value->caption,
                "description" => $value->description,
                "is_top" => $value->is_top == 1 ? 'True' : 'False',
                "status" => $value->name,
                "created_at" => Carbon::parse($value->created_at)->format('Y-m-d'),
                "updated_at" => Carbon::parse($value->updated_at)->format('Y-m-d'),
                "image_id" => $value->image_id,
                "image_url" => $fileUrl
            ];
            array_push($result, $singleNews);
        }

        return view('admin.newslist', [
            'news' => $result
        ]);
    }

    public function getEventsForAdmin()
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        $events = DB::select(
            'SELECT a.*,b.id AS image_id,b.image_url,c.name AS statusName
                                 FROM 
                                Event AS a
                                JOIN EventUrl AS b
                                ON b.event_id = a.id
                                JOIN Status AS c
                                ON a.statusID = c.id'
        );

        $result = [];

        foreach ($events as $value) {
            $fileUrl = explode('/', $value->image_url)[1];
            $singleEvent = [
                "id" => $value->id,
                "name" => $value->name,
                "date" => $value->event_date,
                "description" => $value->description,
                "status" => $value->statusName,
                "created_at" => Carbon::parse($value->created_at)->format('d-m-Y'),
                "updated_at" => Carbon::parse($value->updated_at)->format('d-m-Y'),
                "image_id" => $value->image_id,
                "image_url" => $fileUrl
            ];
            array_push($result, $singleEvent);
        }

        return view('admin.eventlist', [
            'events' => $result
        ]);
    }

    public function createEventsView()
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        return view('admin.create-events');
    }
}
