<div class="sidebar">
  <ul>
      <li class="{{ Request::is('architect/models') ? 'active' : '' }}">
          @foreach($models as $model)
            <a href="{{route('extranet.extranet.index')}}">
              <i class="fa {{$model->icon}}"></i><span class="text">{{$model->title}}</span>
            </a>
          @endforeach
      </li>
   </ul>
   <hr />
</div>
