{{-- @php $commnets->print_Comments()--}}

{{-- @endphp--}}

@foreach ($comments as $comment)
    <ul>
     @if ($comment->parent_id ==null)
            <div class="parrent">
               {{ 'parent:'.$comment->body }}
            </div>
     @else
            <li class="child">
                {{ 'child:'.$comment->body }}
            </li>
     @endif
         <form action="{{action('CommentController@store')}}" method="post">
             @csrf
             <textarea name="body" id="" cols="30" rows="10"></textarea>
                     <input type="hidden" name="post_id" value="{{$post->id}}" >
                     <input type="hidden" name="comment_id" value="{{$comment->id}}" >
             <input type="submit" value="Reply">
         </form>
    @if ( $comment->child->count()>0)
        @include('posts.form', ['comments' => $comment->child] )
    @endif
    </ul>
@endforeach
