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
            Mail::raw($request->message, function ($message) use ($request, $site_setting) {
                $message->to($site_setting->contact_email ?? 'mehmetdora333@gmail.com')
                    ->subject('İletişim Formu: ' . $request->name . ' | ' . $request->subject)
                    ->from($request->email, 'Blogram İletişim') // Sabit bir adres kullanın
                    ->replyTo($request->email, $request->name); // Kullanıcının e-posta adresini yanıtlanacak adres olarak ekleyin
            });


            return back()->with('success', 'Your message has been sent successfully!');

        } catch (\Exception $err) {
            return redirect()->back()->with('error',$err);
        }


    }
}
