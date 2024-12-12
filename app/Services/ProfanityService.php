<?php

namespace App\Services;

class ProfanityService
{
    protected $profanities = [];

    // Yapıcı metot ile küfür listesi dosyasını okuyun
    public function __construct()
    {
        // Profanity.txt dosyasını okuyarak küfür listesi dizisini oluşturun
        $this->profanities = array_map('trim', file(storage_path('karaliste.txt')));
    }

    // Girilen metinde küfür olup olmadığını kontrol eden metod
    public function containsProfanity($text)
    {
        $words = preg_split('/[\s\p{P}]+/u', $text);

        // Her bir kelimeyi kontrol ediyoruz
        foreach ($words as $word) {
            foreach ($this->profanities as $profanity) {
                if (strcasecmp($word, $profanity) === 0) { // Harf duyarsız tam eşleşme
                    return true; // Küfür bulunduğunda true döner
                }
            }
        }
        return false; // Küfür yoksa false döner
    }
}
