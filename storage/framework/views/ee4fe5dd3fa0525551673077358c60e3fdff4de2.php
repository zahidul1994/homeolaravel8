												
												
<?php if($errors->any()): ?>


											
											<div class="card-alert card green">
                                                    <div class="card-content white-text">
                                                        <span class="card-title white-text darken-1">
                                                            <i class="material-icons">notifications</i> <?php echo e(count($errors)); ?> Errors</span>
                                                        <p> <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="card-alert card red">
                                                    <div class="card-content white-text">
													
                
                                                       <p><?php echo e($error); ?></p>
                                                     
                                                    </div>
                                                    <button type="button" class="close cyan-text" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></p>
                                                    </div>
                                                   
                                                    <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
<?php endif; ?>


<?php /**PATH C:\xampp\htdocs\laravel\laravel8\Homeobari\resources\views/partial/formerror.blade.php ENDPATH**/ ?>