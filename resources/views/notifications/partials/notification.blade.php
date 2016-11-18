<div class="notification">
    <div class="media-left">
        <a href="#">
            <img class="media-object avatar" src="{{$notification->from()->photo}}" alt="Generic placeholder image">
        </a>
    </div>
    <div class="media-body">
        <strong class="media-heading" style="padding-bottom: 1000px">{{$notification->data['text']}}</strong>
        <p>{{$notification->regarding()->text}}</p>
        <div class="notification-footer">
            {{ date('H:i F y', $notification->created_at->getTimestamp()) }}
        </div>
    </div>
</div>