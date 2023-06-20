<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact.show');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'email' => 'required|email',
            'content' => 'required|min:5',
        ]);

        $data = [
            'title' => $request->title,
            'email' => $request->email,
            'content' => $request->content,
        ];

        Mail::send('emails.contact', $data, function ($message) use ($data) {
            $message->to('mailtrap@mailcarps.com')->subject('New user Contact message');
            $message->from($data['email'], $data['title']);
        });
        return redirect()->route('contact')->with('status', 'Email sent successfully!');
    }
}
