<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Http;

trait StrapiTrait
{
    public function getStrapiData($url, $param)
    {
        $responseEn = Http::strapi()->get($url . '?' . 'locale=en' . '&' . $param);
        $responseAr = Http::strapi()->get($url . '?' . 'locale=ar' . '&' . $param);

        return [
            'en' => $responseEn->json(),
            'ar' => $responseAr->json(),
        ];
    }
}
