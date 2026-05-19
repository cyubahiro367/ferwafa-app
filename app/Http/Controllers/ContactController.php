<?php

namespace App\Http\Controllers;

use App\Mail\sendInfo;
use App\Mail\SendWhistleBlowers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function information()
    {
        return view('information');
    }

    public function whistleblowers()
    {
        return view('whistleblowers');
    }

    public function sendInfo(Request $request)
    {
        $request->validate([
            "name" => "required|string",
            "email" => "required|email:rfc,dns",
            "subject" => "required|string",
            "content" => "required|string"
        ]);

        try {
            Mail::to(env('INFO_EMAIL'))->send(new sendInfo(
                $request->name,
                $request->email,
                $request->subject,
                $request->content
            ));

            return redirect('/information')->with('message', 'Thank you for messaging us!');
        } catch (\Throwable $th) {
            return redirect('/information')->with('error', 'failed to send information message');
        }
    }

    public function sendWhistleblowers(Request $request)
    {
        $request->validate([
            "message" => "required|string"
        ]);

        Mail::to(Env('INFO_EMAIL'))->send(new SendWhistleBlowers(
            $request->message
        ));

        return redirect('/whistleblowers');
    }
}
