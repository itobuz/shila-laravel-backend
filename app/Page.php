<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model {

    use SoftDeletes;

    public $fillable = ['page_title', 'page_content', 'page_featuredimage', 'page_date', 'page_status', 'menu_order'];
    public $table = 'pages';
    protected $dates = ['deleted_at'];

    /**
     * Moves uploaded file and returns the new filenam
     * @param  Symfony\Component\HttpFoundation\File\UploadedFile $file upladed file
     * @return string            new name returned
     */
    public function handleFile($request) {
        if ($request->hasFile('page_featuredimage')) {
            $fileName = time() . '_' . $request->page_featuredimage->getClientOriginalName();
            $request->page_featuredimage->storeAs('public', $fileName);
        } else {
            $fileName = '';
        }
        return $fileName;
    }

    /*
     * Update uploaded file
     */

    public function updateHandleFile($request, $page) {
        if ($request->hasFile('page_featuredimage') == FALSE) {
            $fileName = $page->page_featuredimage;
        } else {
            Storage::delete('public/' . $page->page_featuredimage);
            $fileName = time() . '_' . $request->page_featuredimage->getClientOriginalName();
            $request->page_featuredimage->storeAs('public', $fileName);
        }
        return $fileName;
    }

    /*
     * Create post function
     */

    public function addPage($input, $page) {
        $page->page_title = $input['page_title'];
        $page->page_content = $input['page_content'];
        $page->page_featuredimage = $input['page_featuredimage'];
        $page->page_date = ($input['page_date'] == '' ? date("Y-m-d") : $input['page_date']);
        $page->page_status = $input['page_status'];
        $page->menu_order = $input['menu_order'];
        $page->save();
        return TRUE;
    }

}
