<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class ContactMessageController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'nullable',
            'message' => 'required',
        ]);

        ContactMessage::create($data);

        Mail::raw($data['message'], function ($mail) use ($data) {
            $mail->to(config('mail.from.address'))
                ->subject('Contact: ' . ($data['subject'] ?? 'Website Inquiry'))
                ->replyTo($data['email']);
        });

        return back()->with('success', 'Message sent successfully!');
    }
}
