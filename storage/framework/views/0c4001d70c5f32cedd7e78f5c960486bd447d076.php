<div class="navbar <?php if(($configData['isNavbarFixed'])=== true): ?><?php echo e('navbar-fixed'); ?> <?php endif; ?>">
  <nav
    class="<?php echo e($configData['navbarMainClass']); ?> <?php if($configData['isNavbarDark']=== true): ?> <?php echo e('navbar-dark'); ?> <?php elseif($configData['isNavbarDark']=== false): ?> <?php echo e('navbar-light'); ?> <?php elseif(!empty($configData['navbarBgColor'])): ?> <?php echo e($configData['navbarBgColor']); ?> <?php else: ?> <?php echo e($configData['navbarMainColor']); ?> <?php endif; ?>">
    <div class="nav-wrapper">
      <div class="header-search-wrapper hide-on-med-and-down" id="MyClockDisplay" onload="showTime()">
       
       
      </div>
      <ul class="navbar-list right">
        <li class="dropdown-language">
          <a class="waves-effect waves-block waves-light translation-button" href="#"
            data-target="translation-dropdown">
            <span class="flag-icon flag-icon-gb"></span>
          </a>
        </li>
        <li class="hide-on-med-and-down">
          <a class="waves-effect waves-block waves-light toggle-fullscreen" href="javascript:void(0);">
            <i class="material-icons">settings_overscan</i>
          </a>
        </li>
        <li class="hide-on-large-only search-input-wrapper">
          <a class="waves-effect waves-block waves-light search-button" href="javascript:void(0);">
            <i class="material-icons">search</i>
          </a>
        </li>
        <li>
          <a class="waves-effect waves-block waves-light notification-button" href="javascript:void(0);"
            data-target="notifications-dropdown" id="seennotify">
            <i class="material-icons">notifications_none<small class="notification-badge"><?php echo e(auth()->user()->unreadNotifications->count()); ?></small></i>
          </a>
        </li>
        <li>
          <a class="waves-effect waves-block waves-light profile-button" href="javascript:void(0);"
            data-target="profile-dropdown">
            <span class="avatar-status avatar-online">
              <img src="<?php echo e(@asset('storage/app/files/shares/profileimage/'.Auth::user()->image)); ?>" alt="avatar"><i></i>
            </span>
          </a>
        </li>
      
      </ul>
      <!-- translation-button-->
      <ul class="dropdown-content" id="translation-dropdown">
        <li class="dropdown-item">
          <a class="grey-text text-darken-1" href="<?php echo e(url('lang/en')); ?>" data-language="en">
            <i class="flag-icon flag-icon-gb"></i>
            English
          </a>
        </li>
      
       
      </ul>
      <!-- notifications-dropdown-->
      <ul class="dropdown-content" id="notifications-dropdown">
        <li>
          <h6 id="dropnotification">Clear<span class="new badge"><?php echo e(auth()->user()->unreadNotifications->count()); ?></span></h6>
        </li>
        <li class="divider"></li>
        <?php $__currentLoopData = auth()->user()->unreadNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <li>
                 <?php echo ($notification->data['data']); ?>
          <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00"><?php echo e(($notification->created_at)->diffForHumans()); ?></time>
        </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php $__currentLoopData = auth()->user()->readNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="#e8f5e9 green lighten-5">
          <?php echo ($notification->data['data']); ?>
   <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00"><?php echo e(($notification->created_at)->diffForHumans()); ?></time>
 </li>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
      <!-- profile-dropdown-->
      <ul class="dropdown-content" id="profile-dropdown">
        <li>
          <a class="grey-text text-darken-1" href="#">
            <i class="material-icons">person_outline</i>
            Profile
          </a>
        </li>
        <li>
          <a class="grey-text text-darken-1" href="#">
            <i class="material-icons">chat_bubble_outline</i>
            Chat
          </a>
        </li>
        <li>
          <a class="grey-text text-darken-1" href="#">
            <i class="material-icons">help_outline</i>
            Help
          </a>
        </li>
        <li class="divider"></li>
        <li>
          <a class="grey-text text-darken-1" href="#">
            <i class="material-icons">lock_outline</i>
            Lock
          </a>
        </li> <li><a class="grey-text text-darken-1" href="<?php echo e(route('logout')); ?>"
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
           <i class="material-icons">keyboard_tab</i> Sign out   </a>
       <form id="logout-form"  action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
        <input  type="hidden" name="user" value="superadmin">
           <?php echo csrf_field(); ?>
       </form>
      </li>
       
      </ul>
    </div>
   
  </nav>
</div>
<script>
  function showTime(){
   var date = new Date();
   var h = date.getHours(); // 0 - 23
   var m = date.getMinutes(); // 0 - 59
   var s = date.getSeconds(); // 0 - 59
   var session = "AM";
   
   if(h == 0){
       h = 12;
   }
   
   if(h > 12){
       h = h - 12;
       session = "PM";
   }
   
   h = (h < 10) ? "0" + h : h;
   m = (m < 10) ? "0" + m : m;
   s = (s < 10) ? "0" + s : s;
   
   var time = h + ":" + m + ":" + s + " " + session;
   document.getElementById("MyClockDisplay").innerText = time;
   document.getElementById("MyClockDisplay").textContent = time;
   
   setTimeout(showTime, 1000);
   
}

showTime();
$(document).ready(function () {
$("#seennotify").click(function(){

 $.ajax({
     type: "post",
     url:url+'/superadmin/seennotification',

 });

});
$("#dropnotification").click(function(){

$.ajax({
    type: "post",
    url:url+'/superadmin/deletenotification',
       success: function (d) {
            M.toast({
    html: 'Your Seen  Notifcation'
 
});
location.reload();
}

});
});
});
  
  </script>
<?php /**PATH C:\xampp\htdocs\laravel\laravel8\Homeobari\resources\views/panels/superadminnavbar.blade.php ENDPATH**/ ?>