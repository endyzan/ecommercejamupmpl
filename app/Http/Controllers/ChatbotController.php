<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\NaiveBayesClassifier;

class ChatbotController extends Controller
{
    public function index()
    {
        return view('chatbot');
    }

    public function chat(Request $request)
    {
        $input = $request->input('message');
        $classifier = new NaiveBayesClassifier();
        $result = $classifier->classify($input);

        if ($result) {
            return response()->json([
                'response' => "Saya merekomendasikan *{$result->nama_jamu}*. Manfaat: {$result->manfaat}. Harga: Rp" . number_format($result->harga)
            ]);
        }

        return response()->json(['response' => 'Maaf, tidak ada jamu yang cocok dengan kebutuhan Anda.']);
    }
}
