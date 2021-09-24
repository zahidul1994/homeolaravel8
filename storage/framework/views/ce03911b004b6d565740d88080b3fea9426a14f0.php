<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

 <style>
.preloader {
position: absolute;
top: 0;
left: 0;
width: 100%;
height: 100%;
z-index: 9999;
background-image: url('<?php echo e(asset('/den/storage/app/files/shares/backend/preloader.gif')); ?>');
background-repeat: no-repeat; 
background-color: #FFF;
background-position: center;
}
 </style>

<body
  class="<?php echo e($configData['mainLayoutTypeClass']); ?> <?php if(!empty($configData['bodyCustomClass']) && isset($configData['bodyCustomClass'])): ?> <?php echo e($configData['bodyCustomClass']); ?> <?php endif; ?> <?php if($configData['isMenuCollapsed'] && isset($configData['isMenuCollapsed'])): ?><?php echo e('menu-collapse'); ?> <?php endif; ?>"
  data-open="click" data-menu="vertical-modern-menu" data-col="2-columns">

  <!-- BEGIN: Header-->
  <header class="page-topbar" id="header">
    <?php echo $__env->make('panels.superadminnavbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </header>
  <!-- END: Header-->

  <!-- BEGIN: SideNav-->
  <?php echo $__env->make('panels.superadminsidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <!-- END: SideNav-->

  <!-- BEGIN: Page Main-->
  <div id="main">
    <div class="row">
      <?php if($configData["navbarLarge"] === true): ?>
      <?php if(($configData["mainLayoutType"]) === 'vertical-modern-menu'): ?>
      
      <div
        class="content-wrapper-before <?php if(!empty($configData['navbarBgColor'])): ?> <?php echo e($configData['navbarBgColor']); ?> <?php else: ?> <?php echo e($configData["navbarLargeColor"]); ?> <?php endif; ?>">
      </div>
      <?php else: ?>
      
      <div class="content-wrapper-before <?php echo e($configData["navbarLargeColor"]); ?>">
      </div>
      <?php endif; ?>
      <?php endif; ?>


      <?php if($configData["pageHeader"] === true && isset($breadcrumbs)): ?>
      
      <?php echo $__env->make('panels.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php endif; ?>
      <div class="col s12">
        <div class="container">
          <!-- END RIGHT SIDEBAR NAV -->
  <?php echo @Toastr::render(); ?>  <!-- toastr   Notification -->
          
          <?php echo $__env->yieldContent('content'); ?>

          
          <?php echo $__env->make('pages.sidebar.customizer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        
        <div class="content-overlay"></div>
      </div>
    </div>
  </div>
  <!-- END: Page Main-->


  
  <?php echo $__env->make('panels.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  
  <?php echo $__env->make('panels.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body><?php /**PATH C:\xampp\htdocs\laravel\laravel8\Homeobari\resources\views/layouts/verticalSuperadminLayoutMaster.blade.php ENDPATH**/ ?>