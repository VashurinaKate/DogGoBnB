<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Contracts\ResponseContract;

class ImagesController extends Controller
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
        $this->validate($request, [
            'image' => 'required|mimes:jpeg,jpg'
        ]);
        $img = Auth::user()->img;
        if ($img !== null) {
            $img = substr_replace($img, '', 0, 8);
            $imgPrizn = Storage::disk('public')->exists($img);
            if ( $imgPrizn ) {
                Storage::disk('public')->delete($img);
                Auth::user()->update(['img' => null]);
            }
        }
        if (($request->file(key: 'image') !== null) && ($request->file(key: 'image') !== '')) {
            $image = $request->file(key: 'image')->storePublicly(path: 'public/images');
            $image = substr_replace($image, 'storage', 0, 6);
            Auth::user()->update(['img' => $image]);
        //  $image =$request->file(key: 'image')->store('uploads', 'public');
        }
        return $this->json->response(
            data: [
                'image' =>  Auth::user()->img,
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
