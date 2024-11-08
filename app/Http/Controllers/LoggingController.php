<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LoggingController extends Controller
{
    public function showButton()
    {
        return view('exception');
    }

    public function showError(Request $request)
    {
        try {
          $a = 1/0;
        } catch (\Throwable $e) {
            Log::error('Произошло исключение: ' . $e->getMessage());
            $this->sendLogToTelegram('Тут ошибка, ребят: ' .$e->getMessage());
            return view('error', ['error' => $e->getMessage()]);
        }
    }

    private function sendLogToTelegram($message)
    {
        $chat_id = config('services.telegram.chat_id');
        $token = config('services.telegram.bot_token');

        $response = Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
            'chat_id' => $chat_id,
            'text' => $message,
        ]);
    }
}
