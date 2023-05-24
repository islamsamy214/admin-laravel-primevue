<?php

namespace App\Http\Traits;

//use App\Models\Seo;

trait SeoTrait
{
    public function seo($title, $url)
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
            'title' => $title . ' | ' . 'AGS',
            'description' => 'Description',
            'keywords' => 'keywords',
            'image' => asset('images/default.jpg'),
            'url' => $url,
        ];
        return $data;
    }
}
