<div class="sidebar">
  <ul>
        <?php if(isset($typology_id) && $typology_id == $typology->id): ?>
          <li class="active">
        <?php else: ?>
          <li>
        <?php endif; ?>
          <a href="<?php echo e(route('rrhh.admin.offers.index')); ?>"><i class="fa fa-pages"></i><span class="text">Liste des offres</span> </a>
        </li>

        <li>
          <a href="<?php echo e(route('rrhh.admin.applications.index')); ?>"><i class="fa fa-pages"></i><span class="text">Liste des candidatures</span> </a>
        </li>

        <li>
          <a href="<?php echo e(route('rrhh.admin.applications.spontaneous')); ?>"><i class="fa fa-pages"></i><span class="text">Liste des candidatures spontanées</span> </a>
        </li>
   </ul>
   <hr />
   <ul>

        <li>
          <a href="<?php echo e(route('rrhh.admin.candidates.index')); ?>"><i class="fa fa-pages"></i><span class="text">Liste des candidats</span> </a>
        </li>

        <li>
          <a href="<?php echo e(route('rrhh.admin.customers.index')); ?>"><i class="fa fa-pages"></i><span class="text">Liste des clients</span> </a>
        </li>
    </ul>
    <hr/>
    <ul>
        <li>
          <a href="<?php echo e(route('rrhh.admin.offers.index')); ?>"><i class="fa fa-pages"></i><span class="text">Liste des tags</span> </a>
        </li>
    </ul>
    <hr/>
</div>
