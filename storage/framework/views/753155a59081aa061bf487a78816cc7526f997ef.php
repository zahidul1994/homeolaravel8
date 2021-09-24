<!-- BEGIN: Footer-->
<footer
  class="<?php echo e($configData['mainFooterClass']); ?> <?php if($configData['isFooterFixed']=== true): ?><?php echo e('footer-fixed'); ?><?php else: ?> <?php echo e('footer-static'); ?> <?php endif; ?> <?php if($configData['isFooterDark']=== true): ?> <?php echo e('footer-dark'); ?> <?php elseif($configData['isFooterDark']=== false): ?> <?php echo e('footer-light'); ?> <?php else: ?> <?php echo e($configData['mainFooterColor']); ?> <?php endif; ?>">
  <div class="footer-copyright">
    <div class="container">
      <span>&copy Powerd by <a href="https://www.facebook.com/RongdhonuIt-706680669690980">Shohi Ltd <?php echo e(date('Y')); ?></a>
      </span>
      <span class="right hide-on-small-only">
        Design and Developed by <a href="https://rongdhonuit.com/">Rondhonu</a>
      </span>
    </div>
  </div>
</footer>

<!-- END: Footer--><?php /**PATH C:\xampp\htdocs\laravel\laravel8\Homeobari\resources\views/panels/footer.blade.php ENDPATH**/ ?>