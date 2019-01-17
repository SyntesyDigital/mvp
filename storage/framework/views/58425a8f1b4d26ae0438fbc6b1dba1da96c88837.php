<div class="sidebar">
  <ul>

        <li class="<?php echo e(Request::is('architect/offers') ? 'active' : ''); ?>">
          <a href="<?php echo e(route('rrhh.admin.offers.index')); ?>">
            <i class="fa fa-file"></i><span class="text">Offres</span> </a>
        </li>

        <li class="<?php echo e(Request::is('architect/applications') ? 'active' : ''); ?>">          <a href="<?php echo e(route('rrhh.admin.applications.index')); ?>">
            <i class="fa fa-address-card"></i><span class="text">Candidatures</span> </a>
        </li>

        <li class="<?php echo e(Request::is('architect/applications/spontaneous') ? 'active' : ''); ?>">          <a href="<?php echo e(route('rrhh.admin.applications.spontaneous')); ?>">
            <i class="fa fa-address-card-o"></i><span class="text">C. spontanées</span> </a>
        </li>
   </ul>
   <hr />
   <ul>
        <li class="<?php echo e(Request::is('architect/candidates') ? 'active' : ''); ?>">          <a href="<?php echo e(route('rrhh.admin.candidates.index')); ?>">
            <i class="fa fa-user"></i><span class="text">Candidats</span> </a>
        </li>

        <li class="<?php echo e(Request::is('architect/customers') ? 'active' : ''); ?>">
          <a href="<?php echo e(route('rrhh.admin.customers.index')); ?>">
            <i class="fa fa-user-o"></i><span class="text">Clients</span>
          </a>
        </li>

        <li>
          <a href="<?php echo e(route('rrhh.admin.massmail')); ?>">
            <i class="fa fa-paper-plane"></i><span class="text">Envoyer un e-mail</span>
          </a>
        </li>
    </ul>
    <hr/>
    <ul>
        <li class="<?php echo e(Request::is('architect/offer-tags') ? 'active' : ''); ?>">
          <a href="<?php echo e(route('rrhh.admin.tags.index')); ?>"><i class="fa fa-tag"></i><span class="text">Tags</span> </a>
        </li>
    </ul>
    <ul>
        <li class="<?php echo e(Request::is('architect/filelist') ? 'active' : ''); ?>">
          <a href="<?php echo e(route('rrhh.tools.filelist.index')); ?>"><i class="fa fa-file"></i><span class="text">Documents</span> </a>
        </li>
    </ul>

    <hr/>

</div>
