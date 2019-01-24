<div class="sidebar">
  <ul>
    <li class="{{ Request::is('architect/customers') ? 'active' : '' }}">
      <a href="{{route('rrhh.admin.customers.index')}}">
        <i class="fa fa-user-o"></i><span class="text">Clients</span>
      </a>
    </li>
   </ul>
</div>
