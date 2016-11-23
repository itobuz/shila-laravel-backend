<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model {

    public $fillable = ['name', 'description', 'featuredimage'];

    /**
     * The posts that belong to the user.
     */
    public function roles() {
        return $this->belongsToMany('App\Post');
    }

    /**
     * Moves uploaded file and returns the new filenam
     * @param  Symfony\Component\HttpFoundation\File\UploadedFile $file upladed file
     * @return string            new name returned
     */
    public function handleFile($request) {
        if ($request->hasFile('featuredimage')) {
            $fileName = time() . '_' . $request->featuredimage->getClientOriginalName();
            $request->featuredimage->storeAs('public', $fileName);
        } else {
            $fileName = '';
        }
        return $fileName;
    }

    /*
     * Update uploaded file
     */

    public function updateHandleFile($request, $category) {
        if ($request->hasFile('featuredimage') == FALSE) {
            $fileName = $category->featuredimage;
        } else {
            Storage::delete('public/' . $category->featuredimage);
            $fileName = time() . '_' . $request->featuredimage->getClientOriginalName();
            $request->featuredimage->storeAs('public', $fileName);
        }
        return $fileName;
    }

    /*
     * Create post function
     */

    public function addCategory($input, $category) {
        $category->name = $input['name'];
        $category->description = $input['description'];
        $category->featuredimage = $input['featuredimage'];
        $category->save();
        return TRUE;
    }

}
