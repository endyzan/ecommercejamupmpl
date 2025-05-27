<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cache;

class NaiveBayesClassifier
{
    protected $data;

    public function __construct()
    {
        // Cache data jamu 1 jam
        $this->data = Cache::remember('jamu_data', 3600, function () {
            return \App\Models\Jamu::select('id_jamu', 'nama_jamu', 'harga', 'manfaat', 'deskripsi', 'komposisi', 'fitur_index')
                ->where('stok', '>', 0)
                ->get();
        });
    }

    public function classify($input)
    {
        $input = strtolower(trim($input));
        $inputWords = $this->tokenize($input);
        $allergy = $this->detectAllergy($input);

        $bestMatch = null;
        $bestScore = 0;

        foreach ($this->data as $jamu) {
            if ($allergy && stripos($jamu->komposisi, $allergy) !== false) continue;

            $score = 0;
            $tokens = explode(',', $jamu->fitur_index); // fitur sudah diproses
            foreach ($inputWords as $word) {
                if (in_array($word, $tokens)) {
                    $score++;
                }
            }

            if ($score > $bestScore) {
                $bestScore = $score;
                $bestMatch = $jamu;
            }
        }
        return $bestMatch;
    }

    private function tokenize($text)
    {
        $words = preg_split('/\s+/', strtolower($text));
        return array_slice($words, 0, 20); // batas maksimal 20 kata
    }

    private function detectAllergy($input)
    {
        if (preg_match('/alergi (\w+)/', $input, $matches)) {
            return $matches[1]; // misalnya 'jeruk'
        }
        return null;
    }
}
