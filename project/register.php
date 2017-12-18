<?php
require("topMenu.php");

?>

    <div id="all">

        <div id="content">
            <div class="container">

                <div class="col-md-12">

                    <ul class="breadcrumb">
                        <li><a href="index.php">Home</a>
                        </li>
                        <li>New account / Sign in</li>
                    </ul>

                </div>

                <?php if (!empty($siteConfigurationObject->getErrorMessage())) : ?>
                        <div data-animate="fadeInDown" class="col-md-12">
                            <div class="alert alert-danger">
                                <strong><?php echo $siteConfigurationObject->getErrorMessage(); ?></strong>
                            </div>
                        </div>
                <?php endif;?>

                <div class="col-md-6">
                    <div class="box">
                        <h1>New account</h1>

                        <p class="lead">Not our registered customer yet?</p>
                        <p>With registration you will have access to special deals. You will also be notified first about any new deals and offers.</p>
                        <p class="text-muted">If you have any questions, please feel free to <a href="contact.html">contact us</a>, our customer service center is working for you 24/7.</p>

                        <hr>
                        <form action="<?php echo $siteConfigurationObject->getSelfScript(); ?>" method="post" id="registerForm">
                            <input type='hidden' name='registerSubmit' id='registerSubmit' value='1'/>
                            <div class="form-group">
                                <div class="inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Full Name">
                                    </div>
                                </div>  
                            </div>
                            <div class="form-group">
                                <div class="inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                        <input type="text" class="form-control" name="registerEmail" id="registerEmail" placeholder="E-Mail Address">
                                    </div>
                                </div>                            
                            </div>
                            <div class="form-group">
                                <div class="inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input type="password" class="form-control" name="registerPassword" id="registerPassword" placeholder="Password">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input type="password" class="form-control" name="registerPasswordConfirm" id="registerPasswordConfirm" placeholder="Confirm Password">
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-user-md"></i> Register</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="box">
                        <h1>Login</h1>

                        <p class="lead">Already our customer?</p>

                        <hr>

                        <form action="<?php echo $siteConfigurationObject->getSelfScript(); ?>" method="post" id="loginForm">
                            <input type='hidden' name='loginSubmit' id='loginSubmit' value='1'/>
                            <div class="form-group">
                                <div class="inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                        <input type="text" class="form-control" id="loginEmail" name="loginEmail" placeholder="E-Mail Address">
                                    </div>
                                </div>  
                            </div>
                            <div class="form-group">
                                <div class="inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input type="password" class="form-control" id="loginPassword" name="loginPassword" placeholder="Password">
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-sign-in"></i> Log in</button>
                            </div>
                        <p class="text-muted"><a href="contact.html">forgot your password?</a></p>
                        </form>
                    </div>
                </div>


            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->

    </div>
    <!-- /#all -->
<?php
require("footer.php");
?>