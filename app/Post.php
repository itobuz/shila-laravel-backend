<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model {

    use SoftDeletes;

    public $fillable = ['post_title', 'post_content', 'post_excerpt', 'post_featuredimage', 'post_date', 'post_status', 'menu_order'];
    public $table = 'posts';
    protected $dates = ['deleted_at'];

    /**
     * Moves uploaded file and returns the new filenam
     * @param  Symfony\Component\HttpFoundation\File\UploadedFile $file upladed file
     * @return string            new name returned
     */
    public static function handleFile($request) {
        if ($request->hasFile('post_featuredimage')) {
            $fileName = time() . '_' . $request->post_featuredimage->getClientOriginalName();
            $request->post_featuredimage->storeAs('public', $fileName);
        } else {
            $fileName = '';
        }
        return $fileName;
    }

    /*
     * Update uploaded file
     */

    public static function updateHandleFile($request, $post) {
        if ($request->hasFile('post_featuredimage') == FALSE) {
            $fileName = $post->post_featuredimage;
        } else {
            Storage::delete('public/' . $post->post_featuredimage);
            $fileName = time() . '_' . $request->post_featuredimage->getClientOriginalName();
            $request->post_featuredimage->storeAs('public', $fileName);
        }
        return $fileName;
    }

    /*
     * Posttytpe Relation one to many
     */

    public function posttypes() {
        return $this->belongsTo('App\Posttype', 'posttype_id');
    }

    /*
     * Create post function
     */

    public static function addPost($input, $post, $posttype) {
        $post->post_title = $input['post_title'];
        $post->post_content = $input['post_content'];
        $post->post_excerpt = $input['post_excerpt'];
        $post->post_featuredimage = $input['post_featuredimage'];
        $post->post_date = ($input['post_date'] == '' ? date("Y-m-d") : $input['post_date']);
        $post->post_status = $input['post_status'];
        $post->menu_order = $input['menu_order'];
        $addedPost=$posttype->posts()->save($post);
        return $addedPost;
    }

    /**
     * The categories that belong to the user.
     */
    public function categories() {
        return $this->belongsToMany('App\Category');
    }

}
