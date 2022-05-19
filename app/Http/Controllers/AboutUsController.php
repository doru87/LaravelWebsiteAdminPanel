<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class AboutUsController extends Controller
{
    public function index()
    {
        return view('admin.despre-noi.despre-noi');
    }
    public function create(Request $request) {

        if ($request->isMethod('post')) {
            $success = '';

            $rules = [
                'continut' => 'required',
            ];
            $messages = [
                'continut.required' => 'Campul Continut trebuie sa fie completat',
            ];
            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }

            $about_us = new AboutUs();
            $about_us->continut = $request->get('continut');
            $image = $request->session()->get('image');
            $about_us->imagine = $image;
            $about_us->save();

            if ($about_us) {
                $success = 'Sectiunea Despre noi a fost adaugata';
                return response()->json(['success' => $success,'image_name'=>$about_us->image]);
            }
        }
    }
    public function incarca_imaginea(Request $request) {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $imageName = time().'.'.$request->image->extension();  
     
        $request->image->move(public_path('files'), $imageName);

        $imagePath = public_path('files/'.$imageName);
        $img = Image::make($imagePath)->resize(800, 400, function($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($imagePath);
  
        $request->session()->put('image', $imageName);
 
        $success = 'Imaginea a fost adaugata';
        return response()->json(['success' => $success]);
        
    }
}
