<?php

namespace  App;
use Illuminate\Support\Facades\Session;

class PrintCommnets{

    public $parents=[];
    public $children=[];
    public $post;
    public function formGenerate($comment,$post,$count){

        return view('posts.CommentsForm',['comment'=>$comment,'post'=>$post,'count'=>$count]);
  }


    public function printCommnet($parent,$count=0){
        foreach ($parent as $k=>$v){
          echo  $this->formGenerate($v,$this->post,$count);

            if (  !empty ($this->children[$v->id])){
                $this->printCommnet($this->children[$v->id],$count+40);
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

    public  function printComments(){

        foreach ($this->parents as $parent){

            $this->printCommnet($parent);
        }
    }
}





