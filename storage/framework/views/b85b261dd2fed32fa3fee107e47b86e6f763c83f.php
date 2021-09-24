<div class="collapsible-body">
  <ul class="collapsible collapsible-sub" data-collapsible="accordion">
    <?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
      $custom_classes="";
      if(isset($submenu->class))
      {
      $custom_classes = $submenu->class;
      }
      ?>
    <li class="<?php echo e((request()->is($submenu->url.'*')) ? 'active' : ''); ?>">
      <a href="<?php if(($submenu->url) === 'javascript:void(0)'): ?><?php echo e($submenu->url); ?> <?php else: ?><?php echo e(url($submenu->url)); ?> <?php endif; ?>"
        class="<?php echo e($custom_classes); ?> <?php echo e((request()->is($submenu->url.'*')) ? 'active '.$configData['activeMenuColor'] : ''); ?>"
        <?php if(!empty($configData['activeMenuColor'])): ?> <?php echo e('style=background:none;box-shadow:none;'); ?> <?php endif; ?>
        target="<?php echo e(isset($submenu->newTab) ? '_blank':''); ?>">
        <i class="material-icons">radio_button_unchecked</i>
        <span><?php echo e(__('locale.'.$submenu->name)); ?></span>
      </a>
      <?php if(isset($submenu->submenu)): ?>
      <?php echo $__env->make('panels.submenu', ['menu' => $submenu->submenu], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php endif; ?>
    </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </ul>
</div><?php /**PATH C:\xampp\htdocs\laravel\laravel8\Homeobari\resources\views/panels/submenu.blade.php ENDPATH**/ ?>