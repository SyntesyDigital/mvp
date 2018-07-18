<div id="{{$field['settings']['htmlId'] or ''}}" class="widget blog list-items image {{$field['settings']['htmlClass'] or ''}}">
  <h3>
    @include('turisme::partials.fields.'.$field['fields'][0]['type'],
      [
        "field" => $field['fields'][0],
        "settings" => $field['settings'],
        "div" => false
      ]
    )
  </h3>
  <ul>
    <li>
      <p class="image"><img src="images/img-medium.png"  alt=""/></p>
      <p class="text"><span class="data">30-11-2016</span> | <span class="categoria">Categoria </span></p>
      <a href="">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </a>
     </li>
    <li>
      <p class="image"><img src="images/img-medium.png"  alt=""/></p>
      <p class="text"><span class="data">30-11-2016</span> | <span class="categoria">Categoria </span></p>
      <a href="">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </a>
     </li>
    <li>
      <p class="image"><img src="images/img-medium.png"  alt=""/></p>
      <p class="text"><span class="data">30-11-2016</span> | <span class="categoria">Categoria </span></p>
      <a href="">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </a>
     </li>
    <li>
      <p class="image"><img src="images/img-medium.png"  alt=""/></p>
      <p class="text"><span class="data">30-11-2016</span> | <span class="categoria">Categoria </span></p>
      <a href="">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </a>
     </li>
  </ul>
  <p class="button">
    @include('turisme::partials.fields.'.$field['fields'][1]['type'],
      [
        "field" => $field['fields'][1],
        "settings" => $field['settings'],
        "div" => false
      ]
    )
  </p>
</div>
