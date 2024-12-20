<?php

namespace App\Services;

use DOMDocument;

class WordCounterService
{
    protected $total_word_count = [];

    function countWordsInParagraphs($html) {
        // DOMDocument sınıfı ile HTML'yi parse et
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);  // HTML hatalarını yok say
        $dom->loadHTML($html);
        libxml_clear_errors();

        // <p> etiketlerini al
        $paragraphs = $dom->getElementsByTagName('p');

        $wordCount = 0;

        // Her <p> etiketi için metin kısmını al ve kelimeleri say
        foreach ($paragraphs as $paragraph) {
            $text = $paragraph->textContent;  // <p> içeriğini al
            $wordCount += str_word_count($text);  // Kelime sayısını ekle
        }

        return $wordCount;
    }
}
