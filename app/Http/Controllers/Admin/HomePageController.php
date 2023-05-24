<?php

namespace App\Http\Controllers\Admin;

use App\Models\HomePage;
use App\Http\Controllers\Controller;
use App\Http\Traits\ImageTrait;
use App\Http\Requests\Admin\HomePage\UpdateHeroSectionRequest;

class HomePageController extends Controller
{
    use ImageTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(HomePage::firstOrFail(), 200);
    } //end index()

    /**
     * Update the hero section of the home page.
     */
    public function updateHeroSection(UpdateHeroSectionRequest $request)
    {
        $home_page = HomePage::firstOrFail();
        $form_data = $request->except(['hero_image']);
        if ($request->hero_image) {
            $home_page->hero_image ? $this->deleteImg($home_page->hero_image) : '';
            $form_data['hero_image'] = $this->img($request->hero_image, 'images/home/');
        }
        $home_page->update($form_data);
        return response()->json(__('Section Updated'), 200);
    } //end upateHeroSection()
}
