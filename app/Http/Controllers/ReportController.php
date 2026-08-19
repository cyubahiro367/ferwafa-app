<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentType;
use App\Support\FilteredExport;
use App\Support\ListFilters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['get', 'getSingle', 'getReportDoc']]);
    }

    public function addDocument()
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        $types = DocumentType::all();
        return view('admin.create-document', [
            "types" => $types
        ]);
    }

    public function create(Request $request)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        $request->validate([
            "title" => "required|string|max:255",
            "reportFile" =>  'required|file|max:10000|mimes:pdf',
            "typeID" => 'required|integer'
        ]);

        $path = $request->reportFile->store('documents');

        Document::create([
            'title' => $request->title,
            'url' => $path,
            'type_id' => $request->typeID,
            'userID' => Auth::id(),
        ]);

        return redirect('/report-view')
            ->with('message', 'document is added successfully');
    }

    public function getReport(Request $request)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        $filters = ListFilters::fromRequest($request);

        $reports = DB::table('Document as a')
            ->join('DocumentType as b', 'b.id', '=', 'a.type_id')
            ->leftJoin('users as u', 'u.id', '=', 'a.userID')
            ->select('a.id', 'a.title', 'a.url', 'b.name', 'u.name as creator_name');

        ListFilters::apply($reports, $filters, 'a.userID', 'a.created_at');
        $reports->orderByDesc('a.created_at');

        if (FilteredExport::requested($request)) {
            $rows = $reports->get()->map(function ($report) {
                return [
                    $report->title,
                    $report->name,
                    $report->creator_name ?? '—',
                ];
            })->all();

            return FilteredExport::download(
                'Documents',
                $filters,
                ['Title', 'Type', 'Created by'],
                $rows,
                $request->input('format')
            );
        }

        $reports = $reports->paginate(10);

        $reports->getCollection()->transform(function ($report) {
            $parts = preg_split('#/#', $report->url);
            return [
                'id' => $report->id,
                'title' => $report->title,
                'type' => $report->name,
                'url' => $parts[1] ?? $report->url,
                'creator_name' => $report->creator_name,
            ];
        });

        return view('admin.reportlist', array_merge(ListFilters::viewData($request), [
            'reports' => $reports,
        ]));
    }

    public function get()
    {
        $paginator = DB::table('Document as a')
            ->join('DocumentType as b', 'a.type_id', '=', 'b.id')
            ->where('b.name', 'report')
            ->select('a.*')
            ->orderByDesc('a.created_at')
            ->paginate(12);

        $paginator->getCollection()->transform(function ($value) {
            $parts = explode('/', $value->url);
            return (object) [
                'id' => $value->id,
                'title' => $value->title,
                'created_at' => $value->created_at,
                'updated_at' => $value->updated_at,
                'url' => $parts[1] ?? $value->url,
            ];
        });

        return view('documents.index', [
            'documents' => $paginator,
            'pageTitle' => 'Reports',
            'pageLabel' => 'Resources',
            'navActive' => 'resources',
        ]);
    }

    public function getSingle($id)
    {

        $report = Document::where('id', $id)->first();

        if (!$report) {
            return redirect()->back()->with('errors', 'report not found');
        }

        return response()->json($report);
    }


    public function getReportDoc($id)
    {
        $record = Document::findOrFail($id);
        $fileName = basename($record->url);

        if (Storage::exists('documents/' . $fileName)) {
            return Storage::response('documents/' . $fileName);
        }
        abort(404);
    }

    public function editReport($id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        $report = Document::where('id', $id)->first();
        $types = DocumentType::all();

        if (!$report) {
            return redirect()->back()->with('errors', 'report not found');
        }

        return view('admin.update-document', [
            'report' => $report,
            'types' => $types
        ]);
    }

    public function updateReport(Request $request, $id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        $request->validate([
            "title" => "required|string|max:255",
            "reportFile" =>  'required|file|max:5000|mimes:pdf',
            "typeID" => 'required|integer'
        ]);

        $report = Document::where('id', $id)->first();

        if (!$report) {
            return redirect()->back()->with('errors', 'report not found');
        }

        Storage::delete($report->url);

        $path = $request->reportFile->store('documents');

        $report->title = $request->title;
        $report->url = $path;
        $report->save();

        return redirect('/report-view')
            ->with('message', 'document is updated successfully');
    }

    public function deleteReport($id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        $report = Document::where('id', $id)->first();

        if (!$report) {
            return redirect()->back()->with('errors', 'report not found');
        }

        Storage::delete($report->url);
        $report->delete();

        return redirect('/report-view')
            ->with('message', 'document deleted successfully');
    }
}
