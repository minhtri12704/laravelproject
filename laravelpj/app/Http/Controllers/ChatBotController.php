<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatBotController extends Controller
{
    public function ask(Request $request)
    {
        $message = strtolower($request->input('message'));

        $responses = [
            'tivi' => 'Chúng tôi có nhiều mẫu tivi từ Sony, Samsung, LG... bạn muốn loại nào ạ?',
            'máy lạnh' => 'Máy lạnh hiện đang có khuyến mãi hấp dẫn, bạn cần loại 1HP hay 2HP?',
            'giảm giá' => 'Hiện có chương trình giảm giá đến 50% cho điện máy, bạn muốn xem sản phẩm nào?',
            'chào' => 'Chào bạn 👋! Mình có thể giúp gì cho bạn hôm nay?',
            'mở cửa' => 'Shop mở cửa từ 8h sáng đến 9h tối mỗi ngày ạ.',
        ];

        $reply = 'Xin lỗi, mình chưa hiểu ý bạn. Bạn có thể hỏi về tivi, máy lạnh, giảm giá, v.v.';

        foreach ($responses as $keyword => $response) {
            if (str_contains($message, $keyword)) {
                $reply = $response;
                break;
            }
        }

        return response()->json([
            'reply' => $reply
        ]);
    }
}
