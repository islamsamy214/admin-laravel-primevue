<?php

namespace App\Http\Traits;
use Illuminate\Support\Facades\Validator;

trait GeneralTrait
{
    public function notFound()
    {
        return response()->json([
            'status' => false,
            'message' => 'Not Found'
        ], 404);
    }

    public function apiSuccessResponse($data = null, $seo = null, $message = 'Success')
    {
        $response = [
            'status' => true,
            'message' => $message,
            'url' => url('/') . '/',
            'data' => $data,
            'seo' => $seo,
        ];
        return response()->json($response, 200);
    }

    public function apiCreatedResponse($data = null, $message = 'Created')
    {
        $response = [
            'status' => true,
            'message' => $message,
            'data' => $data,
        ];
        return response()->json($response, 201);
    }

    public function validationTrait($request, $rules)
    {
        $validator = Validator::make($request, $rules);
        if ($validator->fails()) {
            return $validator;
        } else {
            return false;
        }
    }

    public function validationApiTrait($request, $rules, $messages = null)
    {
        if ($messages) {
            $validator = Validator::make($request, $rules, $messages);
        } else {
            $validator = Validator::make($request, $rules);
        }
        if ($validator->fails()) {
            return response()->json([
                'status' => 'fail',
                'data' => $validator->errors(),
            ], 422);
        } else {
            return false;
        }
    }

    public function validationWebTrait($request, $rules)
    {
        $validator = Validator::make($request, $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            return false;
        }
    }

    public function arrayAltForImages()
    {
        return ['web design', 'web development', 'mobile app', 'seo', 'digital marketing', 'social media marketing', 'social media management', 'social media ads', 'social media content', 'social media strategy', 'social media campaign', 'social media analytics', 'team', 'team members'];
    }
}
