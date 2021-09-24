<!-- BEGIN VENDOR JS-->
<script src="<?php echo e(asset('js/vendors.min.js')); ?>"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<?php echo $__env->yieldContent('vendor-script'); ?>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN THEME  JS-->
<script src="<?php echo e(asset('js/plugins.js')); ?>"></script>
<script src="<?php echo e(asset('js/search.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/vendors/sweetalert/sweetalert.min.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/vendors/select2/select2.full.min.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/js/scripts/advance-ui-modals.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/js/scripts/form-select2.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/js/scripts/extra-components-sweetalert.js')); ?>"></script>
<script src="<?php echo e(asset('js/custom/custom-script.js')); ?>"></script>
<!-- END THEME  JS-->
<!-- BEGIN PAGE LEVEL JS-->
<?php echo $__env->yieldContent('page-script'); ?>
<script>

    var url = "<?php echo e(URL::to('/')); ?>";

 $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });
     $(".preloader").fadeOut("slow"); 
  

     $(".select2").select2({
  dropdownAutoWidth: true,
  width: '100%'
});


 </script><?php /**PATH C:\xampp\htdocs\laravel\laravel8\Homeobari\resources\views/panels/scripts.blade.php ENDPATH**/ ?>