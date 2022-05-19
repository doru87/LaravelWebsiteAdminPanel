<?php
namespace App\Traits;

use Illuminate\Http\Request;

trait DataTrait
{
    public function saveImages(Request $request) {
        $files = [];
        if ($request->hasfile('imagini')) {
            foreach ($request->file('imagini') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path('files'), $name);
                $files[] = $name;
            }
            return $files;
        }
    }
}
