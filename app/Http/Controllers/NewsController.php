<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsType;
use App\Models\NewsUrl;
use App\Models\Partner;
use App\Models\Status;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => [
            'getNewsImage',
            'allNews',
            'getNews',
            'getSingleNews',
            'seniorMen',
            'u23',
            'u17',
            'otherMen',
            'seniorWomen',
            'u20Women',
            'otherWomen',
            'grassroots',
            'schools',
            'youth',
        ]]);
    }

    public function postNews(Request $request)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        $request->validate([
            "title" => "required|string",
            "caption" => "required|string|max:255",
            "description" => "required|string",
            "is_top" => "required|boolean",
            "statusID" => "required|in:1,2,3",
            "newsTypeID" => "required|numeric",
            "image" => "required|file|max:5000|mimes:png,jpg,jpeg"
        ]);

        DB::transaction(function () use ($request) {

            $news = News::create([
                "title" => $request->title,
                "caption" => $request->caption,
                "description" => $request->description,
                "statusID" => $request->statusID,
                "newsTypeID" => $request->newsTypeID,
                "is_top" => $request->is_top
            ]);

            $path = $request->image->store('newsImages');
            NewsUrl::create([
                "image_url" => $path,
                // "image_caption" => $request->image_caption,
                "news_id" => $news->id
            ]);
        });

        return redirect('/news-view')
            ->with('message', 'News has been created!');
    }

    public function getNewsImage($fileName)
    {
        if (Storage::exists('newsImages/' . $fileName)) { {
                return response()->file(storage_path('/app/newsImages/' . $fileName));
            }
        }
    }

    public function allNews()
    {
        $news = DB::select('SELECT a.*,b.image_url,c.name FROM 
                                News AS a
                                JOIN NewsUrl AS b
                                ON b.news_id = a.id
                                JOIN Status AS c
                                ON a.statusID = c.id
                                WHERE  c.id = 1
                                ORDER BY created_at DESC');

        $result = [];

        foreach ($news as $value) {
            $fileUrl = explode('/', $value->image_url)[1];
            $singleNews = [
                "id" => $value->id,
                "title" => $value->title,
                "caption" => $value->caption,
                "description" => $value->description,
                "is_top" => $value->is_top,
                "status" => $value->name,
                "created_at" => Carbon::parse($value->created_at)->format('d-m-Y'),
                "updated_at" => Carbon::parse($value->updated_at)->format('d-m-Y'),
                "image_url" => $fileUrl
            ];
            array_push($result, $singleNews);
        }

        return view(
            'all_news',
            ["result" => $result]
        );
    }

    public function seniorMen()
    {
        $news = DB::select('SELECT a.*,b.image_url,c.name FROM 
                                News AS a
                                JOIN NewsUrl AS b
                                ON b.news_id = a.id
                                JOIN Status AS c
                                ON a.statusID = c.id
                                WHERE  c.id = ?
                                AND
                                a.newsTypeID = ?
                                ORDER BY created_at DESC', [1, 1]);

        $result = [];

        foreach ($news as $value) {
            $fileUrl = explode('/', $value->image_url)[1];
            $singleNews = [
                "id" => $value->id,
                "title" => $value->title,
                "caption" => $value->caption,
                "description" => $value->description,
                "is_top" => $value->is_top,
                "status" => $value->name,
                "created_at" => Carbon::parse($value->created_at)->format('d-m-Y'),
                "updated_at" => Carbon::parse($value->updated_at)->format('d-m-Y'),
                "image_url" => $fileUrl
            ];
            array_push($result, $singleNews);
        }

        return view(
            'senior_men_news',
            ["result" => $result]
        );
    }

    public function u23()
    {
        $news = DB::select('SELECT a.*,b.image_url,c.name FROM 
                                News AS a
                                JOIN NewsUrl AS b
                                ON b.news_id = a.id
                                JOIN Status AS c
                                ON a.statusID = c.id
                                WHERE  c.id = ?
                                AND
                                a.newsTypeID = ?
                                ORDER BY created_at DESC', [1, 2]);

        $result = [];

        foreach ($news as $value) {
            $fileUrl = explode('/', $value->image_url)[1];
            $singleNews = [
                "id" => $value->id,
                "title" => $value->title,
                "caption" => $value->caption,
                "description" => $value->description,
                "is_top" => $value->is_top,
                "status" => $value->name,
                "created_at" => Carbon::parse($value->created_at)->format('d-m-Y'),
                "updated_at" => Carbon::parse($value->updated_at)->format('d-m-Y'),
                "image_url" => $fileUrl
            ];
            array_push($result, $singleNews);
        }

        return view(
            'u23_men_news',
            ["result" => $result]
        );
    }

    public function u17()
    {
        $news = DB::select('SELECT a.*,b.image_url,c.name FROM 
                                News AS a
                                JOIN NewsUrl AS b
                                ON b.news_id = a.id
                                JOIN Status AS c
                                ON a.statusID = c.id
                                WHERE  c.id = ?
                                AND
                                a.newsTypeID = ?
                                ORDER BY created_at DESC', [1, 3]);

        $result = [];

        foreach ($news as $value) {
            $fileUrl = explode('/', $value->image_url)[1];
            $singleNews = [
                "id" => $value->id,
                "title" => $value->title,
                "caption" => $value->caption,
                "description" => $value->description,
                "is_top" => $value->is_top,
                "status" => $value->name,
                "created_at" => Carbon::parse($value->created_at)->format('d-m-Y'),
                "updated_at" => Carbon::parse($value->updated_at)->format('d-m-Y'),
                "image_url" => $fileUrl
            ];
            array_push($result, $singleNews);
        }

        return view(
            'u17_men_news',
            ["result" => $result]
        );
    }

    public function otherMen()
    {
        $news = DB::select('SELECT a.*,b.image_url,c.name FROM 
                                News AS a
                                JOIN NewsUrl AS b
                                ON b.news_id = a.id
                                JOIN Status AS c
                                ON a.statusID = c.id
                                WHERE  c.id = ?
                                AND
                                a.newsTypeID = ?
                                ORDER BY created_at DESC', [1, 4]);

        $result = [];

        foreach ($news as $value) {
            $fileUrl = explode('/', $value->image_url)[1];
            $singleNews = [
                "id" => $value->id,
                "title" => $value->title,
                "caption" => $value->caption,
                "description" => $value->description,
                "is_top" => $value->is_top,
                "status" => $value->name,
                "created_at" => Carbon::parse($value->created_at)->format('d-m-Y'),
                "updated_at" => Carbon::parse($value->updated_at)->format('d-m-Y'),
                "image_url" => $fileUrl
            ];
            array_push($result, $singleNews);
        }

        return view(
            'other_men_news',
            ["result" => $result]
        );
    }

    public function seniorWomen()
    {
        $news = DB::select('SELECT a.*,b.image_url,c.name FROM 
                                News AS a
                                JOIN NewsUrl AS b
                                ON b.news_id = a.id
                                JOIN Status AS c
                                ON a.statusID = c.id
                                WHERE  c.id = ?
                                AND
                                a.newsTypeID = ?
                                ORDER BY created_at DESC', [1, 5]);

        $result = [];

        foreach ($news as $value) {
            $fileUrl = explode('/', $value->image_url)[1];
            $singleNews = [
                "id" => $value->id,
                "title" => $value->title,
                "caption" => $value->caption,
                "description" => $value->description,
                "is_top" => $value->is_top,
                "status" => $value->name,
                "created_at" => Carbon::parse($value->created_at)->format('d-m-Y'),
                "updated_at" => Carbon::parse($value->updated_at)->format('d-m-Y'),
                "image_url" => $fileUrl
            ];
            array_push($result, $singleNews);
        }

        return view(
            'senior_women_news',
            ["result" => $result]
        );
    }

    public function u20Women()
    {
        $news = DB::select('SELECT a.*,b.image_url,c.name FROM 
                                News AS a
                                JOIN NewsUrl AS b
                                ON b.news_id = a.id
                                JOIN Status AS c
                                ON a.statusID = c.id
                                WHERE  c.id = ?
                                AND
                                a.newsTypeID = ?
                                ORDER BY created_at DESC', [1, 6]);

        $result = [];

        foreach ($news as $value) {
            $fileUrl = explode('/', $value->image_url)[1];
            $singleNews = [
                "id" => $value->id,
                "title" => $value->title,
                "caption" => $value->caption,
                "description" => $value->description,
                "is_top" => $value->is_top,
                "status" => $value->name,
                "created_at" => Carbon::parse($value->created_at)->format('d-m-Y'),
                "updated_at" => Carbon::parse($value->updated_at)->format('d-m-Y'),
                "image_url" => $fileUrl
            ];
            array_push($result, $singleNews);
        }

        return view(
            'u20_women_news',
            ["result" => $result]
        );
    }

    public function otherWomen()
    {
        $news = DB::select('SELECT a.*,b.image_url,c.name FROM 
                                News AS a
                                JOIN NewsUrl AS b
                                ON b.news_id = a.id
                                JOIN Status AS c
                                ON a.statusID = c.id
                                WHERE  c.id = ?
                                AND
                                a.newsTypeID = ?
                                ORDER BY created_at DESC', [1, 7]);

        $result = [];

        foreach ($news as $value) {
            $fileUrl = explode('/', $value->image_url)[1];
            $singleNews = [
                "id" => $value->id,
                "title" => $value->title,
                "caption" => $value->caption,
                "description" => $value->description,
                "is_top" => $value->is_top,
                "status" => $value->name,
                "created_at" => Carbon::parse($value->created_at)->format('d-m-Y'),
                "updated_at" => Carbon::parse($value->updated_at)->format('d-m-Y'),
                "image_url" => $fileUrl
            ];
            array_push($result, $singleNews);
        }

        return view(
            'other_women_news',
            ["result" => $result]
        );
    }

    public function grassroots()
    {
        $news = DB::select('SELECT a.*,b.image_url,c.name FROM 
                                News AS a
                                JOIN NewsUrl AS b
                                ON b.news_id = a.id
                                JOIN Status AS c
                                ON a.statusID = c.id
                                WHERE  c.id = ?
                                AND
                                a.newsTypeID = ?
                                ORDER BY created_at DESC', [1, 8]);

        $result = [];

        foreach ($news as $value) {
            $fileUrl = explode('/', $value->image_url)[1];
            $singleNews = [
                "id" => $value->id,
                "title" => $value->title,
                "caption" => $value->caption,
                "description" => $value->description,
                "is_top" => $value->is_top,
                "status" => $value->name,
                "created_at" => Carbon::parse($value->created_at)->format('d-m-Y'),
                "updated_at" => Carbon::parse($value->updated_at)->format('d-m-Y'),
                "image_url" => $fileUrl
            ];
            array_push($result, $singleNews);
        }

        return view(
            'grassroots_news',
            ["result" => $result]
        );
    }

    public function schools()
    {
        $news = DB::select('SELECT a.*,b.image_url,c.name FROM 
                                News AS a
                                JOIN NewsUrl AS b
                                ON b.news_id = a.id
                                JOIN Status AS c
                                ON a.statusID = c.id
                                WHERE  c.id = ?
                                AND
                                a.newsTypeID = ?
                                ORDER BY created_at DESC', [1, 9]);

        $result = [];

        foreach ($news as $value) {
            $fileUrl = explode('/', $value->image_url)[1];
            $singleNews = [
                "id" => $value->id,
                "title" => $value->title,
                "caption" => $value->caption,
                "description" => $value->description,
                "is_top" => $value->is_top,
                "status" => $value->name,
                "created_at" => Carbon::parse($value->created_at)->format('d-m-Y'),
                "updated_at" => Carbon::parse($value->updated_at)->format('d-m-Y'),
                "image_url" => $fileUrl
            ];
            array_push($result, $singleNews);
        }

        return view(
            'schools_news',
            ["result" => $result]
        );
    }

    public function youth()
    {
        $news = DB::select('SELECT a.*,b.image_url,c.name FROM 
                                News AS a
                                JOIN NewsUrl AS b
                                ON b.news_id = a.id
                                JOIN Status AS c
                                ON a.statusID = c.id
                                WHERE  c.id = ?
                                AND
                                a.newsTypeID = ?
                                ORDER BY created_at DESC', [1, 10]);

        $result = [];

        foreach ($news as $value) {
            $fileUrl = explode('/', $value->image_url)[1];
            $singleNews = [
                "id" => $value->id,
                "title" => $value->title,
                "caption" => $value->caption,
                "description" => $value->description,
                "is_top" => $value->is_top,
                "status" => $value->name,
                "created_at" => Carbon::parse($value->created_at)->format('d-m-Y'),
                "updated_at" => Carbon::parse($value->updated_at)->format('d-m-Y'),
                "image_url" => $fileUrl
            ];
            array_push($result, $singleNews);
        }

        return view(
            'youth_news',
            ["result" => $result]
        );
    }

    public function getNews()
    {
        $topNews = DB::select('SELECT a.*,b.image_url,c.name FROM 
                                News AS a
                                JOIN NewsUrl AS b
                                ON b.news_id = a.id
                                JOIN Status AS c
                                ON a.statusID = c.id
                                WHERE  c.id = 1 AND a.is_top = 1
                                ORDER BY created_at DESC
                                LIMIT 4');

        $topResults = [];

        foreach ($topNews as $topNew) {
            $fileUrl = explode('/', $topNew->image_url)[1];
            $singleTopNews = [
                "id" => $topNew->id,
                "title" => $topNew->title,
                "caption" => $topNew->caption,
                "description" => $topNew->description,
                "is_top" => $topNew->is_top,
                "status" => $topNew->name,
                "created_at" => Carbon::parse($topNew->created_at)->format('d-m-Y'),
                "updated_at" => Carbon::parse($topNew->updated_at)->format('d-m-Y'),
                "image_url" => $fileUrl
            ];
            array_push($topResults, $singleTopNews);
        }                        

        $news = DB::select('SELECT a.*,b.image_url,c.name FROM 
                                News AS a
                                JOIN NewsUrl AS b
                                ON b.news_id = a.id
                                JOIN Status AS c
                                ON a.statusID = c.id
                                WHERE  c.id = 1
                                ORDER BY created_at DESC
                                LIMIT 4');

        $result = [];

        foreach ($news as $value) {
            $fileUrl = explode('/', $value->image_url)[1];
            $singleNews = [
                "id" => $value->id,
                "title" => $value->title,
                "caption" => $value->caption,
                "description" => $value->description,
                "is_top" => $value->is_top,
                "status" => $value->name,
                "created_at" => Carbon::parse($value->created_at)->format('d-m-Y'),
                "updated_at" => Carbon::parse($value->updated_at)->format('d-m-Y'),
                "image_url" => $fileUrl
            ];
            array_push($result, $singleNews);
        }

        $partners = Partner::all();

        $finalPartners = [];

        foreach ($partners as $value) {
            $fileUrl = explode('/', $value->image_url)[1];
            $partner = [
                "id" => $value->id,
                "link" => $value->link,
                "created_at" => $value->created_at,
                "updataed_at" => $value->updated_at,
                "url" => $fileUrl
            ];
            array_push($finalPartners, $partner);
        }

        return view('homePage', [
            "topResults" => $topResults,
            "result" => $result,
            'partners' => $finalPartners
        ]);
    }

    public function getSingleNews($id)
    {
        $result = News::where('id', $id)->first();
        $newsUrls = NewsUrl::where('news_id', $id)->get();
        $urls = [];
        foreach ($newsUrls as $value) {
            $fileUrl = explode('/', $value->image_url)[1];
            $newsUrl = [
                'url' => $fileUrl,
                'image_caption' => $value->image_caption
            ];
            array_push($urls, $newsUrl);
        }
        return view('single_news', [
            'result' => $result,
            'url' => $urls
        ]);
    }

    public function editSingleNews($id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }
        $result = News::where('id', $id)->first();
        $newsUrls = NewsUrl::where('news_id', $id)->get();
        $urls = [];
        foreach ($newsUrls as $value) {
            $fileUrl = explode('/', $value->image_url)[1];
            $newsUrl = [
                'url' => $fileUrl,
                'image_caption' => $value->image_caption
            ];
            array_push($urls, $newsUrl);
        }
        $statuses = Status::all();

        $newsTypes = NewsType::all();

        return view('admin.update-news', [
            'result' => $result,
            'url' => $urls,
            'statuses' => $statuses,
            'newsTypes' => $newsTypes
        ]);
    }

    public function updateSingleNews(Request $request, $id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        $request->validate([
            "title" => "required|string",
            "caption" => "required|string|max:255",
            "description" => "required|string",
            "is_top" => "boolean",
            "statusID" => "required|integer|in:1,2,3",
            "newsTypeID" => "required|numeric",
            "image" => "required|file|max:5000|mimes:png,jpg,jpeg"
        ]);

        $news = News::where("id", $id)->first();

        if (!$news) {
            return redirect('/news-view')
                ->with('error', 'News not found');
        }

        $news->title = $request->title;
        $news->caption = $request->caption;
        $news->description = $request->description;
        $news->is_top = $request->is_top;
        $news->statusID = $request->statusID;
        $news->newsTypeID = $request->newsTypeID;
        $news->save();

        $path = $request->image->store('newsImages');

        $newsImage = NewsUrl::where('news_id', $news->id)->first();

        Storage::delete($newsImage->image_url);

        $newsImage->image_url = $path;

        $newsImage->save();

        return redirect('/news-view')
            ->with('message', 'updated successfully');
    }

    public function deleteNews($id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        $news = News::where("id", $id)->first();

        if (!$news) {
            return redirect('/news-view')
                ->with('error', 'News not found');
        }

        $newsImage = NewsUrl::where('news_id', $news->id)->first();

        Storage::delete($newsImage->image_url);

        $newsImage->delete();

        $news->delete();

        return redirect('/news-view')
            ->with('message', 'deleted successfully');
    }
}
