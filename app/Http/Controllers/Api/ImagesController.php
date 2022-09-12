<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Contracts\ResponseContract;

class ImagesController
{
    public function __construct(public ResponseContract $json)
    {
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return $this->json->response(data: [
            
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        // $this->validate($request, [
        //     // 'content' => 'required',
        //     'image' => 'required|mimes:jpeg,jpg'
        //     // 'image' => 'required|mimes:jpeg|dimensions:min_width=1000,min_height=400'
        // ]);

        $image = $request->file(key: 'image')->storePublicly(path: 'public/images');
        $image = substr_replace($image, 'storage', 0, 6);
        //Auth::user()->update(['img'=>$image]);
        //  $image =$request->file(key: 'image')->store('uploads', 'public');
        return $this->json->response(
            data: [
            //'image' =>  Auth::user()->img,
            'image' => $image,
            // '$request' => $request->all(),
            // 'user' => Auth::user(),
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): \Illuminate\Http\JsonResponse
    {
        return $this->json->response(data: [
            
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int  $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        return $this->json->response(data: [
            
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        return $this->json->response(data: [
            
        ]);
    }
}
