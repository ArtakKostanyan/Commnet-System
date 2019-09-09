{{ $comment->body }}

<div style="margin-left: {{$count}}px">
    <form  action="/comments" method="post">
        @csrf
        <textarea name="body" id="" cols="30" rows="10"></textarea>
        <input type="hidden" name="post_id" value="{{$post->id}}" >

        <input type="hidden" name="parent_id" value="{{$comment->id}}" >
        <input type="submit" value="Reply">
    </form>
</div>
