<?php

namespace App\Http\Traits;

//use App\Models\Seo;

trait SeoTrait
{
    public function seo($title, $url, $description = 'Description', $keywords = 'keywords')
    {
        /*$seo = Seo::first();
        $data = [
            'title' => $title . ' | ' . $seo->title,
            'description' => $seo->description,
            'keywords' => $seo->keywords,
            'image' => $seo->image,
            'url' => $url,
        ];*/
        $data = [
            'title' => $title . ' | ' . env('APP_NAME'),
            'description' => $description,
            'keywords' => $keywords,
            'image' => asset('Logo.svg'),
            'url' => env('APP_URL') . '/' . $url,
        ];
        return $data;
    }
}
