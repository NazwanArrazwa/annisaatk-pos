<?php
//==================================== HOME ====================================
if ($page == 'login') {

?>

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-5 col-lg-6 col-md-5">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Selamat Datang</h1>
                                    </div>
                                    <!-- PRE LOADER -->
                                    <section class="preloader">
                                        <div class="spinner">

                                            <span class="spinner-rotate"></span>

                                        </div>
                                    </section>
                                    <?php
                                    echo validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>', '</div>');
                                    echo $this->session->flashdata('message');
                                    ?>
                                    <form action="<?php echo base_url("login"); ?>" method="post" class="user">
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Masukkan Username">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Masukkan Password">
                                        </div>
                                        <div class="form-group">
                                            <!-- <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div> -->
                                        </div>
                                        <button class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                        <hr>
                                        <div class="text-center">
                                            <a class="small" href="<?= base_url('login/lupaPassword') ?>">Lupa Password?</a>
                                        </div>
                                        <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Login with Google
                                </a>
                                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                </a>
                            </form>
                            <hr>
                            
                            <div class="text-center">
                                <a class="small" href="register.html">Create an Account!</a>
                            </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>



<?php
    //==================================== lupa_password ====================================
} else if ($page == 'lupa_password') {

?>
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-5 col-lg-6 col-md-5">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Anda Lupa Password?</h1>
                                    </div>
                                    <!-- PRE LOADER -->
                                    <section class="preloader">
                                        <div class="spinner">

                                            <span class="spinner-rotate"></span>

                                        </div>
                                    </section>
                                    <?php
                                    echo validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>', '</div>');
                                    echo $this->session->flashdata('message');
                                    ?>
                                    <form action="<?php echo base_url("login/lupaPassword"); ?>" method="POST" class="user">
                                        <div class="form-group">
                                            <input type="text" name="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Masukkan Email....">
                                        </div>
                                        <button class="btn btn-primary btn-user btn-block">
                                            Reset Password
                                        </button>
                                        <hr>
                                        <div class="text-center">
                                            <a class="small" href="<?= base_url('login') ?>">Kembali Ke Login</a>
                                        </div>
                                        <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                            <i class="fab fa-google fa-fw"></i> Login with Google
                        </a>
                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                        </a>
                    </form>
                    <hr>
                    
                    <div class="text-center">
                        <a class="small" href="register.html">Create an Account!</a>
                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

<?php
    //==================================== lupa_password ====================================
} else if ($page == 'ubah_password') {

?>
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-5 col-lg-6 col-md-5">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-1">Ubah Password Anda :</h1>
                                        <h5 class="mb-4"><?= $this->session->userdata('reset_email'); ?></h5>
                                    </div>
                                    <!-- PRE LOADER -->
                                    <section class="preloader">
                                        <div class="spinner">

                                            <span class="spinner-rotate"></span>

                                        </div>
                                    </section>
                                    <?php
                                    echo validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>', '</div>');
                                    echo $this->session->flashdata('message');
                                    ?>
                                    <form action="<?= base_url('login/resetpassword?hash=' . $hash) ?>" method="POST" class="user">
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user" id="password1" aria-describedby="emailHelp" placeholder="Masukkan Password Baru...">
                                            <span class="badge badge-danger"><?php echo strip_tags(form_error('password1')); ?></span>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="cpassword" class="form-control form-control-user" id="password2" aria-describedby="emailHelp" placeholder="Ulangi Password Baru...">
                                            <span class="badge badge-danger"><?php echo strip_tags(form_error('password2')); ?></span>
                                        </div>
                                        <button class="btn btn-primary btn-user btn-block">
                                            Ubah Password
                                        </button>

                                        <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                            <i class="fab fa-google fa-fw"></i> Login with Google
                        </a>
                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                        </a>
                    </form>
                    <hr>
                    
                    <div class="text-center">
                        <a class="small" href="register.html">Create an Account!</a>
                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>


<?php
}


?>