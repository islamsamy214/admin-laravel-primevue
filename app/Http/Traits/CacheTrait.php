<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Cache;

trait CacheTrait
{
    public $cache_duration = (60 * 60 * 168); // 1 week

    public function clearCache()
    {
        Cache::flush();
    }
}
