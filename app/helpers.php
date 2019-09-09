<?php

namespace  App;
use Illuminate\Support\Facades\Session;

class PrintCommnets{

    public $parents=[];
    public $children=[];
    public $post;
    public function Form_Generate($comment,$post,$count){

        return view('posts.CommentsForm',['comment'=>$comment,'post'=>$post,'count'=>$count]);
  }


//    public function space($count){
//        for ($count; $count > 0; $count--) {
//            echo "!!!";
//        }
//    }

    public function Print_Commnet($parent,$count=0){
        foreach ($parent as $k=>$v){
//            $this->space($count,);
//            echo $v->body;
//            echo "<br>";
          echo  $this->Form_Generate($v,$this->post,$count);

            if (  !empty ($this->children[$v->id])){
                $this->Print_Commnet($this->children[$v->id],$count+40);
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

    public  function Print_Comments(){

        foreach ($this->parents as $parent){

            $this->Print_Commnet($parent);
        }
    }
}





