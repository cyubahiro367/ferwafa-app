<?php

namespace App\Http\Controllers;

use App\Mail\IndependentBodies;
use App\Models\Committe;
use App\Models\CommitteeCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class IndependentBodiesController extends Controller
{
    public function index(int $id)
    {
        $committeeCategory = CommitteeCategory::where('id', $id)->first();

        if (is_null($committeeCategory)) {
            return redirect()->back()->with('error', 'Committee category is not found');
        }

        $paginator = Committe::where('committeeCategoryID', $id)
            ->orderBy('id')
            ->paginate(12);

        $paginator->getCollection()->transform(function ($value) {
            $parts = $value->image_url ? explode('/', $value->image_url) : [];
            return (object) [
                'id' => $value->id,
                'name' => $value->name,
                'position' => $value->position,
                'created_at' => $value->created_at,
                'updated_at' => $value->updated_at,
                'url' => $parts[1] ?? null,
            ];
        });

        return view('independentBodies', [
            'title' => $committeeCategory->name,
            'committeeCategoryID' => $committeeCategory->id,
            'committee' => $paginator,
        ]);
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            "committeeCategoryID" => "required|integer|min:1",
            "name" => "required|string",
            "phone" => "required|string",
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            "subject" => "required|string",
            "message" => "required|string",
            "reportFile" =>  'required|file|max:10000|mimes:pdf'

        ]);

        $committeeCategory = CommitteeCategory::where('id', $request->committeeCategoryID)->first();

        if(is_null($committeeCategory))
        {
            return redirect()->back()->with('error', 'Committee category is not found');
        }

        $name = $request->input('name');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $subject = $committeeCategory->name." ".$request->input('subject');
        $message = $request->input('message');
        $attachment = $request->file('reportFile')->store('attachments');

        Mail::to('theotimecyubahiro@gmail.com')->send(new IndependentBodies($committeeCategory->name, $name, $phone, $email, $subject, $message, storage_path('app/' . $attachment)));

        return back()->with('mesage', 'Message sent successfully!');
    }
}
