<div class="media-left">
    <a href="#">
        <img class="media-object avatar" src="{{$notification->from()->photo}}" alt="Generic placeholder image">
    </a>
</div>
<div class="media-body">
    @if($notification->isType('Comment'))
        <h4 class="media-heading">{{$notification->from()->name}} commented on your post</h4>
        <p>{{$notification->regarding()->text}}</p>
    @elseif(isType('Mention'))
        <h4 class="media-heading">{{$notification->from()->name}} mentioned you in a post</h4>
        <p>{{$notification->regarding()->text}}</p>
    @elseif(isType('Vote'))
        <h4 class="media-heading">{{$notification->from()->name}} commented on your post</h4>
        <p>{{$notification->regarding()->text}}</p>
    @elseif(isTyoe('Follow'))
        <h4 class="media-heading">{{$notification->from()->name}} commented on your post</h4>
        <p>{{$notification->regarding()->text}}</p>
    @endif
</div>