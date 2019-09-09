<?php

namespace  App;
use Illuminate\Support\Facades\Session;

class PrintCommnets{

    public $parents=[];
    public $children=[];
    public $post;
    public function FormGenerate($comment,$post,$count){

        echo view('posts.CommentsForm',['comment'=>$comment,'post'=>$post,'count'=>$count]);
  }


//    public function space($count){
//        for ($count; $count > 0; $count--) {
//            echo "!!!";
//        }
//    }

    public function print_Commnet($parent,$count=0){
        foreach ($parent as $k=>$v){
//            $this->space($count,);
//            echo $v->body;
//            echo "<br>";
            $this->FormGenerate($v,$this->post,$count);

            if (  !empty ($this->children[$v->id])){
                $this->print_Commnet($this->children[$v->id],$count+40);
            }
        }
    }

    public function __construct($comments,$post)
    {

            $this->post=$post;

        foreach ($comments as $comment) {
            if ($comment->parent_id === NULL) {
                $this->parents[$comment->id][] = $comment;
            } else {
                $this->children[$comment->parent_id][] = $comment;
            }
        }
    }

    public  function print_Comments(){

        foreach ($this->parents as $parent){

            $this->print_Commnet($parent);
        }
    }
}





