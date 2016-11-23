<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Pcategory extends Model {

    protected $table = 'pcategories';
    public $fillable = ['name', 'description', 'image'];

    /**
     * The category that belong to the product.
     */
    public function products() {
        return $this->belongsToMany('App\Product')->withTimestamps();
    }

    /**
     * Moves uploaded file and returns the new filenam
     * @param  Symfony\Component\HttpFoundation\File\UploadedFile $file upladed file
     * @return string            new name returned
     */
    public function handleFile($request) {
        if ($request->hasFile('image')) {
            $fileName = time() . '_' . $request->image->getClientOriginalName();
            $request->image->storeAs('public', $fileName);
        } else {
            $fileName = '';
        }
        return $fileName;
    }

    /*
     * Update uploaded file
     */

    public function updateHandleFile($request, $pcategory) {
        if ($request->hasFile('image') == FALSE) {
            $fileName = $pcategory->image;
        } else {
            Storage::delete('public/' . $pcategory->image);
            $fileName = time() . '_' . $request->image->getClientOriginalName();
            $request->image->storeAs('public', $fileName);
        }
        return $fileName;
    }

    /*
     * Create category function
     */

    public function addPcategory($input, $pcategory) {
        $pcategory->name = $input['name'];
        $pcategory->description = $input['description'];
        $pcategory->image = $input['image'];
        $pcategory->save();
        return TRUE;
    }

}
