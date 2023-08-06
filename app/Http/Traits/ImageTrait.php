<?php

namespace App\Http\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

trait ImageTrait
{
    public function img($file, $path = 'images/home/', $old_file = 'test.png', $quality = 100)
    {
        $publicPath = public_path($path);
        if (!File::isDirectory($publicPath)) {
            File::makeDirectory($publicPath, 0777, true, true);
        }
        $old_file ??= 'test.png';
        $this->deleteImg($old_file);
        // check if svg
        if ($file->getClientOriginalExtension() == 'svg') {
            return $this->svg($file, $path);
        } else {
            $filename = md5($file->getClientOriginalName()) . strtotime(Carbon::now()) . '.' . $file->getClientOriginalExtension();
            Image::Make($file)->encode('webp', $quality)->save(public_path($path . $filename . '.webp'));
            return $path . $filename . '.webp';
        }
    }

    public function svg($file, $path = 'images/icons/')
    {
        $filename = md5($file->getClientOriginalName()) . strtotime(Carbon::now()) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path($path), $filename);
        return $path . $filename;
    }

    public function deleteImg($file)
    {
        if (file_exists(public_path($file))) {
            unlink(public_path($file));
        }
    }

    public function saveImageFromServer($url = 'https://www.google.com/images/branding/googlelogo/1x/googlelogo_color_272x92dp.png', $path = 'images/strapi/')
    {
        // get extension
        $extension = pathinfo($url, PATHINFO_EXTENSION);
        $filename = md5($url) . strtotime(Carbon::now()) . '.' . $extension;
        $publicPath = public_path($path);
        if (!File::isDirectory($publicPath)) {
            File::makeDirectory($publicPath, 0777, true, true);
        }
        $file = file_get_contents($url);
        file_put_contents(public_path($path . $filename), $file);
        return $path . $filename;
    }

    public function uploadImages($images, $path = 'images/')
    {
        $images_paths = [];
        foreach ($images as $image) {
            $images_paths[] = $this->img($image, $path);
        }
        return json_encode($images_paths);
    }

    public function uploadS3Image($file, $path = 'images')
    {
        $path = Storage::disk('s3')->put($path, $file);
        return Storage::disk('s3')->url($path);
    }

    public function deleteS3Image($file)
    {
        $exploded_file = explode('/', $file);
        $file = array_slice($exploded_file, 3);
        $file = implode('/', $file);
        Storage::disk('s3')->delete($file);
    }
}
