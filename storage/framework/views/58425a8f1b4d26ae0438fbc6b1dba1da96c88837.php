<div class="sidebar">
  <ul>
        <?php if(isset($typology_id) && $typology_id == $typology->id): ?>
          <li class="active">
        <?php else: ?>
          <li>
        <?php endif; ?>
          <a href="<?php echo e(route('rrhh.admin.offers.index')); ?>">
            <i class="fa fa-file"></i><span class="text">Offres</span> </a>
        </li>

        <li>
          <a href="<?php echo e(route('rrhh.admin.applications.index')); ?>">
            <i class="fa fa-address-card"></i><span class="text">Candidatures</span> </a>
        </li>

        <li>
          <a href="<?php echo e(route('rrhh.admin.applications.spontaneous')); ?>">
            <i class="fa fa-address-card-o"></i><span class="text">C. spontanées</span> </a>
        </li>
   </ul>
   <hr />
   <ul>
        <li>
          <a href="<?php echo e(route('rrhh.admin.candidates.index')); ?>">
            <i class="fa fa-user"></i><span class="text">Candidats</span> </a>
        </li>

        <li>
          <a href="<?php echo e(route('rrhh.admin.customers.index')); ?>">
            <i class="fa fa-user-o"></i><span class="text">Clients</span>
          </a>
        </li>
    </ul>
    <hr/>
    <ul>
        <li>
          <a href="<?php echo e(route('rrhh.admin.tags.index')); ?>"><i class="fa fa-tag"></i><span class="text">Tags</span> </a>
        </li>
    </ul>
    <hr/>
</div>
