<div class="sidebar">
  <ul>
    <li class="{{ Request::is('pages*') ? 'active' : '' }}">
      <a href="?display_pages=true" > <i class="fa fa-file-o"></i> <span class="text">Pàgines</span> </a>
    </li>
  </ul>
  <hr />
  <ul>
    @foreach($typologies as $typology)
        @if(isset($typology_id) && $typology_id == $typology->id)
          <li class="active">
        @else
          <li>
        @endif

          <a href="{{route('contents', ['typology_id' => $typology->id])}}"><i class="fa {{$typology->icon}}"></i><span class="text">{{$typology->name}}</span> </a>
        </li>
    @endforeach()
  </ul>
  <hr/>
  <ul>
    <li class="{{ Request::is('architect/categories*') ? 'active' : '' }}">
      <a href="{{route('categories')}}"> <i class="fa fa-list"></i> <span class="text">Categories</span> </a>
    </li>
    <li class="{{ Request::is('architect/tags*') ? 'active' : '' }}">
      <a href="{{route('tags')}}"> <i class="fa fa-tag"></i> <span class="text">Etiquetes</span> </a>
    </li>
  </ul>
</div>
