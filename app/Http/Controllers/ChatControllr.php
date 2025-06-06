<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class ChatController extends Controller
{
    public function handleChat(Request $request)
    {
        $userMessage = $request->input('message');

        // کلید API
        $apiKey = env('AVALAI_API_KEY', 'aa-n8rVFTEKd56wK60KUUySapKQsc6GUe7u7Ta5Of18H1zzme5H');

        try {
            // لیست مدل‌ها برای امتحان کردن
            $models = ['gpt-4o', 'gpt-3.5-turbo'];
            $reply = null;

            foreach ($models as $model) {
                // ارسال درخواست به API avalai.ir
                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'Authorization' => "Bearer $apiKey",
                ])->post('https://api.avalai.ir/v1/chat/completions', [
                    'model' => $model,
                    'messages' => [
                        [
                            'role' => 'user',
                            'content' => $userMessage,
                        ],
                    ],
                ]);

                // لاگ کردن اطلاعات درخواست و پاسخ
                Log::info('API Request: ', [
                    'url' => 'https://api.avalai.ir/v1/chat/completions',
                    'model' => $model,
                    'body' => ['model' => $model, 'messages' => [['role' => 'user', 'content' => $userMessage]]],
                ]);
                Log::info('API Response Status: ' . $response->status());
                Log::info('API Response Body: ' . $response->body());

                // بررسی پاسخ API
                if ($response->successful()) {
                    $reply = $response->json()['choices'][0]['message']['content'] ?? 'پاسخ دریافت نشد';
                    break; // اگر موفق بود، از حلقه خارج شو
                } else {
                    $error = $response->json()['error'] ?? ['message' => 'خطای ناشناخته'];
                    Log::error('API Error for model ' . $model . ': ' . json_encode($error));
                    if ($error['code'] === 'quota_exceeded') {
                        $reply = 'خطا: حد نصاب API شما به پایان رسیده است. لطفاً حساب خود را در https://chat.avalai.ir/platform/billing بررسی کنید.';
                        break; // اگر خطای quota بود، ادامه نده
                    }
                }
            }

            if (!$reply) {
                $reply = 'خطا در دریافت پاسخ از API: ' . $response->status();
            }
        } catch (\Exception $e) {
            Log::error('Exception in API call: ' . $e->getMessage());
            $reply = 'خطا در ارتباط با سرور: ' . $e->getMessage();
        }

        return response()->json(['reply' => $reply]);
    }
}
