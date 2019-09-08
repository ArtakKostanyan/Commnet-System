<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use function foo\func;

class PostController extends Controller
{

    public $parents = [];
    public $children = [];


     public function space($count){

         for ($count; $count > 0; $count--) {

                echo "!!!";
            }
     }

     public function print_Commnet($parent,$count=0){

        foreach ($parent as $k=>$v){

              $this->space($count);
              echo $v->body;
              echo "<br>";

            if (  !empty ($this->children[$v->id])){

                $this->print_Commnet($this->children[$v->id],$count+1);
            }
        }
    }

    public function index()
    {


        $comments = Comment::all();


        foreach ($comments as $comment) {

            if ($comment->parent_id === NULL) {

                $this->parents[$comment->id][] = $comment;

            } else {

                $this->children[$comment->parent_id][] = $comment;
            }
        }


        foreach ($this->parents as $parent){

            $this->print_Commnet($parent);
        }








         $posts =  Post::all();


        return view('posts.index', compact('posts'));
    }






    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        Post::create($request->all());

        return redirect()->route('posts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show', compact('post'));
    }
}
