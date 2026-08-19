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
            "title" => "required|string|max:255",
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
                "is_top" => $request->is_top,
                "userID" => Auth::id(),
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

    public function getNewsImage($id)
    {
        $record = NewsUrl::findOrFail($id);
        $fileName = basename($record->image_url);

        if (Storage::exists('newsImages/' . $fileName)) {
            return Storage::response('newsImages/' . $fileName);
        }
        abort(404);
    }

    private function paginatePublishedNews(?int $newsTypeId = null)
    {
        $query = DB::table('News as a')
            ->join('NewsUrl as b', 'b.news_id', '=', 'a.id')
            ->join('Status as c', 'a.statusID', '=', 'c.id')
            ->where('c.id', 1)
            ->select('a.*', 'b.id as image_id', 'b.image_url', 'c.name as status_name')
            ->orderByDesc('a.created_at');

        if ($newsTypeId !== null) {
            $query->where('a.newsTypeID', $newsTypeId);
        }

        $paginator = $query->paginate(12);

        $paginator->getCollection()->transform(function ($value) {
            $parts = explode('/', $value->image_url);
            return (object) [
                'id' => $value->id,
                'title' => $value->title,
                'caption' => $value->caption,
                'description' => $value->description,
                'is_top' => $value->is_top,
                'status' => $value->status_name,
                'created_at' => $value->created_at,
                'updated_at' => $value->updated_at,
                'image_id' => $value->image_id,
                'image_url' => $parts[1] ?? $value->image_url,
            ];
        });

        return $paginator;
    }

    private function newsIndex(string $pageTitle, string $active, ?int $newsTypeId = null, string $label = 'News')
    {
        return view('news.index', [
            'result' => $this->paginatePublishedNews($newsTypeId),
            'pageTitle' => $pageTitle,
            'pageLabel' => $label,
            'navActive' => $active,
        ]);
    }

    public function allNews()
    {
        return $this->newsIndex('Latest News', 'resources');
    }

    public function seniorMen()
    {
        return $this->newsIndex('Senior Men – Amavubi', 'national', 1, 'National Teams');
    }

    public function u23()
    {
        return $this->newsIndex('U-23 Olympic', 'national', 2, 'National Teams');
    }

    public function u17()
    {
        return $this->newsIndex('U-17', 'national', 3, 'National Teams');
    }

    public function otherMen()
    {
        return $this->newsIndex('Other Men Teams', 'national', 4, 'National Teams');
    }

    public function seniorWomen()
    {
        return $this->newsIndex('Senior Women', 'women', 5, 'Women Football');
    }

    public function u20Women()
    {
        return $this->newsIndex('U-20 Women', 'women', 6, 'Women Football');
    }

    public function otherWomen()
    {
        return $this->newsIndex('Other Women Teams', 'women', 7, 'Women Football');
    }

    public function grassroots()
    {
        return $this->newsIndex('Grassroots Football', 'development', 8, 'Development');
    }

    public function schools()
    {
        return $this->newsIndex('Football for Schools', 'development', 9, 'Development');
    }

    public function youth()
    {
        return $this->newsIndex('Youth Development', 'development', 10, 'Development');
    }

    public function getNews()
    {
        $topNews = DB::select('SELECT a.*,b.id AS image_id,b.image_url,c.name FROM
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
                "image_id" => $topNew->image_id,
                "image_url" => $fileUrl
            ];
            array_push($topResults, $singleTopNews);
        }

        $news = DB::select('SELECT a.*,b.id AS image_id,b.image_url,c.name FROM
                                News AS a
                                JOIN NewsUrl AS b
                                ON b.news_id = a.id
                                JOIN Status AS c
                                ON a.statusID = c.id
                                WHERE  c.id = 1
                                ORDER BY created_at DESC
                                LIMIT 6');

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
                "image_id" => $value->image_id,
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
        $result = News::where('id', $id)->firstOrFail();
        $newsUrls = NewsUrl::where('news_id', $id)->get();
        $urls = [];
        foreach ($newsUrls as $value) {
            $parts = explode('/', $value->image_url);
            $urls[] = [
                'id' => $value->id,
                'url' => $parts[1] ?? $value->image_url,
                'image_caption' => $value->image_caption,
            ];
        }
        return view('news.show', [
            'result' => $result,
            'url' => $urls,
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
                'id' => $value->id,
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
