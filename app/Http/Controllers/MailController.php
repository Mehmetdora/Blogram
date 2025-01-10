<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{

    public function contact(Request $request)
    {
        // Validasyon
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:40',
            'message' => 'required|string',
        ]);

        $site_setting = SiteSetting::first();

        try {
            // E-posta Gönderimi
            Mail::raw($request->message, function ($message) use ($request , $site_setting) {
                $message->to($site_setting->contact_email ?? 'mehmetdora333@gmail.com')
                    ->subject('İletişim Formu: ' . $request->name . ' | '.$request->subject)
                    ->replyTo($request->email);
            });

        } catch (\Exception $err) {
            return redirect()->back()->with('error',$err);
        }


        return back()->with('success', 'Mesajınız başarıyla gönderildi!');
    }
}
