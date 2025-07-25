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
                'response' => "Saya merekomendasikan Jamu : ",
                'nama_jamu' => $result->nama_jamu,
                'manfaat' => $result->manfaat,
                'harga' => rupiah($result->harga),
                'komposisi' => $result->komposisi,
                'deskripsi' => $result->deskripsi,
                'gambar' => $result->gambar,
            ]);
        }

        // return response()->json(['response' => $result]);
        return response()->json(['response' => 'Maaf, tidak ada jamu yang cocok dengan kebutuhan Anda.']);
    }
}
