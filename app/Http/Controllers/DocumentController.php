<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DocumentController extends Controller
{
    private function paginateDocumentsByType(string $typeName)
    {
        $paginator = DB::table('Document as a')
            ->join('DocumentType as b', 'a.type_id', '=', 'b.id')
            ->where('b.name', $typeName)
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

        return $paginator;
    }

    private function documentIndex(string $typeName, string $pageTitle, string $navActive = 'resources', string $label = 'Resources')
    {
        return view('documents.index', [
            'documents' => $this->paginateDocumentsByType($typeName),
            'pageTitle' => $pageTitle,
            'pageLabel' => $label,
            'navActive' => $navActive,
        ]);
    }

    public function showDocumentPage()
    {
        return $this->documentIndex('document', 'Documents');
    }

    public function showGameRules()
    {
        return $this->documentIndex('game-rules', 'Laws of the Game');
    }

    public function showAdditionalGameRules()
    {
        return $this->documentIndex('additional-rules', 'Rules & Regulations');
    }

    public function showCircularPage()
    {
        return $this->documentIndex('circular', 'Circular');
    }

    public function showTendersPage()
    {
        return $this->documentIndex('tender', 'Tenders', 'career', 'Career');
    }

    public function showJobsPage()
    {
        return $this->documentIndex('jobs', 'Jobs', 'career', 'Career');
    }

    public function showOtherCareerPage()
    {
        return $this->documentIndex('other-career', 'Other Career', 'career', 'Career');
    }
}
