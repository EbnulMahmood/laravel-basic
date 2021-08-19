<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\ContactForm;
use Illuminate\Support\Carbon;

class ContactController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function Contact () {
        $num_page = 4;
        $contacts = Contact::latest()->paginate($num_page);
        return view('admin.contact.index', compact('contacts'));
    }

    public function AddContact()
    {
        return view('admin.contact.create');
    }

    public function StoreContact(Request $request)
    {
        $validated = $request->validate([
            'address' => 'required|min:4',
            'email' => 'required|email',
            'phone' => 'required|min:11|numeric',
        ], [
            'address.required' => 'Please input address.',
            'address.min' => 'Address longer than 4 characters.',
        ]);

        Contact::insert([
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'created_at' => Carbon::now(),
        ]);
        return Redirect()->route('admin-contact')->with('message', 'Contact inserted successfully!')->with('alert', 'success'); 
    }

    public function Edit($id)
    {
        $contact = Contact::find($id);
        return view('admin.contact.edit', compact('contact'));
    }

    public function Update(Request $request, $id)
    {
        $validated = $request->validate([
            'address' => 'required|min:4',
            'email' => 'required|email',
            'phone' => 'required|min:11|numeric',
        ], [
            'address.required' => 'Please input address.',
            'address.min' => 'Address longer than 4 characters.',
        ]);

        $update = Contact::find($id)->update([
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return Redirect()->route('admin-contact')->with('message', 'Contact updated successfully!')->with('alert', 'success');  
    }

    public function Delete($id)
    {
        $delete = Contact::find($id)->delete();
        return Redirect()->back()->with('message', 'Contact deleted successfully!')->with('alert', 'success');  
    }

    public function AdminMessage()
    {
        $num_page = 4;
        $messages = ContactForm::latest()->paginate($num_page);
        return view('admin.contact.message', compact('messages'));
    }

    public function DeleteMessage($id)
    {
        $delete = ContactForm::find($id)->delete();
        return Redirect()->back()->with('message', 'Message deleted successfully!')->with('alert', 'success');   
    }
}
