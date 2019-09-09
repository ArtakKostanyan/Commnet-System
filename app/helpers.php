<?php

namespace  App;
use Illuminate\Support\Facades\Session;

class PrintCommnets{

    public $parents=[];
    public $children=[];
    public $post;
    public function FormGenerate($comment,$post,$count){

?>
        <div style="margin-left: <?php echo $count?>px">
        <form  action="/comments" method="post">
            <textarea name="body" id="" cols="30" rows="10"></textarea>
            <input type="hidden" name="post_id" value="<?= $post->id?>" >
            <input type="hidden" name="_token" value="<?=  Session::token()?>">
            <input type="hidden" name="parent_id" value="<?= $comment->id ?>" >
            <input type="submit" value="Reply">
        </form>
        </div>
  <?php  }


//    public function space($count){
//        for ($count; $count > 0; $count--) {
//            echo "!!!";
//        }
//    }
    public function print_Commnet($parent,$count=0){
        foreach ($parent as $k=>$v){
//            $this->space($count,);
            echo $v->body;
            echo "<br>";
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





