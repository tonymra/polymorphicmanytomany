<?php

Use App\Tag;
Use App\Post;
Use App\Video;
Use App\Taggable;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


//Create - Post, Video

Route::get('/create', function(){



 $post = Post::create(['name'=>'Post 1']);

 $tag1 = Tag::findOrFail(1);

 $post->tags()->save($tag1);

  $video =  Video::create(['name'=>'Video 1']);

  $tag2 = Tag::findOrFail(2);

 $video->tags()->save($tag2);

});


//Read

Route::get('/read/{post_id}', function($post_id){

    $post = Post::findOrFail($post_id);

    foreach ($post->tags as $tag){

        echo $tag->name;
    }
});


//Update

Route::get('/update/{post_id}', function($post_id){

//    $post = Post::findOrFail($post_id);
//
//    foreach ($post->tags as $tag){
//
//        $tag->whereName('PHP')->update(['name'=>'C#']);
//    }


    $post = Post::findOrFail($post_id);

    $tag = Tag::find(1);

    //$post->tags()->save($tag);


    //$post->tags()->attach($tag);

    $post->tags()->sync([1,2]);


});

Route::get('/delete/{post_id}', function ($post_id){

 $post=Post::findorFail($post_id);

 foreach ($post->tags as $tag){

     $tag->whereId(2)->delete();
 }

});