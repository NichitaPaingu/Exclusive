<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'message' => 'required|string',
        ]);
        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'messageContent' => $request->input('message'), // Изменено на messageContent
        ];
        Mail::send('emails.contact', $data, function ($message) use ($data) {
            $message->to('nichitapaingu123@icloud.com')
                ->subject('Новое сообщение от ' . $data['name']);
        });

        return response()->json(['message' => 'Ваше сообщение было успешно отправлено!']);
    }
}

