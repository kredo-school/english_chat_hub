<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactsController extends Controller
{
    // Inbox
    public function show()
    {
        $all_messages = Contact::oldest()->paginate(10);

        return view('admin.inbox.index')->with('all_messages',$all_messages);
    }
    public function updateStatus(Request $request, Contact $message)
    {
        $message->status_id = $request->input('status');
        $message->save();
    
        return redirect()->back();
    }
}
