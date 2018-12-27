<div class="sidebar">
  <ul>

        <li class="{{ Request::is('architect/offers') ? 'active' : '' }}">
          <a href="{{route('rrhh.admin.offers.index')}}">
            <i class="fa fa-file"></i><span class="text">Offres</span> </a>
        </li>

        <li class="{{ Request::is('architect/applications') ? 'active' : '' }}">          <a href="{{route('rrhh.admin.applications.index')}}">
            <i class="fa fa-address-card"></i><span class="text">Candidatures</span> </a>
        </li>

        <li class="{{ Request::is('architect/applications/spontaneous') ? 'active' : '' }}">          <a href="{{route('rrhh.admin.applications.spontaneous')}}">
            <i class="fa fa-address-card-o"></i><span class="text">C. spontanées</span> </a>
        </li>
   </ul>
   <hr />
   <ul>
        <li class="{{ Request::is('architect/candidates') ? 'active' : '' }}">          <a href="{{route('rrhh.admin.candidates.index')}}">
            <i class="fa fa-user"></i><span class="text">Candidats</span> </a>
        </li>

        <li class="{{ Request::is('architect/customers') ? 'active' : '' }}">
          <a href="{{route('rrhh.admin.customers.index')}}">
            <i class="fa fa-user-o"></i><span class="text">Clients</span>
          </a>
        </li>

        <li>
          <a href="{{route('rrhh.admin.massmail')}}">
            <i class="fa fa-paper-plane"></i><span class="text">Envoyer un e-mail</span>
          </a>
        </li>
    </ul>
    <hr/>
    <ul>
        <li class="{{ Request::is('architect/offer-tags') ? 'active' : '' }}">
          <a href="{{route('rrhh.admin.tags.index')}}"><i class="fa fa-tag"></i><span class="text">Tags</span> </a>
        </li>
    </ul>
    <hr/>
</div>
