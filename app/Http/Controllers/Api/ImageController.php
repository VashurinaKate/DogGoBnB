<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\ResponseContract;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
class ImageController extends Controller
{
    public function __construct(public ResponseContract $json)
    {
    }
    
    
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {

    
        $this->validate($request, [
            // 'content' => 'required',
            'image' => 'required|mimes:jpeg,jpg'
            // 'image' => 'required|mimes:jpeg|dimensions:min_width=1000,min_height=400'
        ]);

        $image = $request->file(key: 'image')->storePublicly(path: 'public/images');
        Auth::user()->update(['img'=>$image]);
        //  $image =$request->file(key: 'image')->store('uploads', 'public');
        return $this->json->response(data: [
            'image' => $image,
            '$request' => $request->all(),
            'user' => Auth::user(),
        ]);
    
    
    }


}

