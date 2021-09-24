<div class="col s12">
    <div class="container">
      <!--Basic Card-->
<div class="card">
<div class="card-content">
<h4 class="card-title">Hello <?php echo e($data['name']); ?> .</h4>
<p>Subject:-  <?php echo e($data['subject']); ?></p>
<div class="row">
<div class="row">
  <div class="col s12 m6 l6">
    <div class="card light-blue">
      <div class="card-content white-text">
        <span class="card-title">Our Reply</span>
        <p>
         <?php echo $data['message']; ?>

        </p>
      </div>
      <div class="card-action">
        <a href="https://homeobari.com" class="lime-text text-accent-1">Visite Now</a>
        <a href="facebook.com" class="lime-text text-accent-1">Facebook</a>
      </div>
    </div>
  </div>
  </div>
  </div><?php /**PATH C:\xampp\htdocs\laravel\laravel8\Homeobari\resources\views/email/replycontactemail.blade.php ENDPATH**/ ?>