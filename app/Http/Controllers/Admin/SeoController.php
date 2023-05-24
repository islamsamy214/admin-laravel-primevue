<?php

namespace App\Http\Controllers\Admin;

use App\Models\Seo;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Seo\UpdateSeoRequest;
use App\Http\Traits\ImageTrait;

class SeoController extends Controller
{
    use ImageTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ['seo' => Seo::first()];
    } // end of index

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSeoRequest $request, Seo $seo)
    {
        $form_data = $request->validated();
        // decode the title json data from the request and convert it to array
        $form_data['title'] = json_decode($form_data['title'], true);
        $form_data['description'] = json_decode($form_data['description'], true);
        //image uploading
        if ($request->image) {
            $seo->image ? $this->deleteImg($seo->image) : '';
            $form_data['image'] = $this->img($request->image, 'images/seos/');
        } else {
            $form_data['image'] = $seo->image;
        }

        $seo->update($form_data);
        return response(['message' => 'Seo updated successfully', 'seo' => $seo], 200);
    } // end of update
}
