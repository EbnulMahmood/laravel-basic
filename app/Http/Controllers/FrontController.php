<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\ContactForm;
use App\Models\MultiPic;
use Illuminate\Support\Carbon;

class FrontController extends Controller
{
    public function HomeContact()
    {
        $contact = Contact::first();
        return view('pages.contact', compact('contact'));
    }

    public function Portfolio()
    {
        $num_image = 9;
        $images = MultiPic::latest()->paginate($num_image);
        return view('pages.portfolio', compact('images'));
    }

    public function ContactForm(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:4',
            'email' => 'required|email',
            'subject' => 'required|min:4',
            'message' => 'required|min:4',
        ], [
            'name.required' => 'Please input your name.',
            'name.min' => 'Name longer than 4 characters.',
            'subject.required' => 'Please input your subject.',
            'subject.min' => 'Subject longer than 4 characters.',
            'message.required' => 'Please input your message.',
            'message.min' => 'Message longer than 4 characters.',
        ]);

        ContactForm::insert([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now(),
        ]);
        return Redirect()->route('contact')->with('message', 'Your message has been sent. Thank you!')->with('alert', 'success');
    }
}
