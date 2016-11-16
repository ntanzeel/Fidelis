<div class="media-left">
    <a href="#">
        <img class="media-object avatar" src="{{$notification->from()->photo}}" alt="Generic placeholder image">
    </a>
</div>
<div class="media-body">
    <h4 class="media-heading">{{$notification->data['text']}}</h4>
    <p>{{$notification->regarding()->text}}</p>
</div>