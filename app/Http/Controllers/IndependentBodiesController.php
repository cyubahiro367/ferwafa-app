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

        if(is_null($committeeCategory))
        {
            return redirect()->back()->with('error', 'Committee category is not found');
        }

        $finalCommitte = [];

        $committe = Committe::where("committeeCategoryID", $id)->get();

        foreach ($committe as $value) {
            $fileUrl = explode('/', $value->image_url)[1];
            $committeMember = [
                "id" => $value->id,
                "name" => $value->name,
                "position" => $value->position,
                "created_at" => $value->created_at,
                "updataed_at" => $value->updated_at,
                "url" => $fileUrl
            ];
            array_push($finalCommitte, $committeMember);
        }

        return view('independentBodies', [
            "title" => $committeeCategory->name,
            "committeeCategoryID" => $committeeCategory->id,
            "committee" => $finalCommitte
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
