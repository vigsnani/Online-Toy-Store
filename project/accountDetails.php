<?php
require("topMenu.php");
require_once("account_helper.php");


if(isset($_POST['personalSubmit'])){
    $accObject = new AccountOperations($siteConfigurationObject);
    $accObject->updateUserInformation();
}
else if(isset($_POST['changePwdSubmit'])){ 
    $accObject = new AccountOperations($siteConfigurationObject);
    $accObject->changeUserPassword();
}

?>

    <div id="all">

        <div id="content">
            <div class="container">

                <div class="col-md-12">

                    <ul class="breadcrumb">
                        <li><a href="index.php">Home</a>
                        </li>
                        <li>My account</li>
                    </ul>

                </div>

                <?php if (!empty($siteConfigurationObject->getErrorMessage())) : ?>
                    <div data-animate="fadeInDown" class="col-md-12">
                        <div class="alert alert-danger">
                            <strong><?php echo $siteConfigurationObject->getErrorMessage(); ?></strong>
                        </div>
                    </div>
                <?php endif;?>

                <div class="col-md-3">
                    <!-- *** CUSTOMER MENU ***
 _________________________________________________________ -->
                    <div class="panel panel-default sidebar-menu">

                        <div class="panel-heading">
                            <h3 class="panel-title">Customer section</h3>
                        </div>

                        <div class="panel-body">

                            <ul class="nav nav-pills nav-stacked">
                                <li class="active">
                                    <a href="accountDetails.php"><i class="fa fa-user"></i> My account</a>
                                </li>
                                <li>
                                    <a href="orderHistory.php"><i class="fa fa-list"></i> My orders</a>
                                </li>
                                <?php if ($siteConfigurationObject->isUserAdmin()) : ?>
                                    <li>
                                        <a href="addNewProduct.php"><i class="fa fa-plus"></i> Add New Product</a>
                                    </li>
                                <?php endif;?>
                                <li>
                                    <a href="index.php?logOut=1"><i class="fa fa-sign-out"></i> Logout</a>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <!-- /.col-md-3 -->

                    <!-- *** CUSTOMER MENU END *** -->
                </div>

                <div class="col-md-9">
                    <div class="box">
                        <h1>My account</h1>
                        <p class="lead">Change your personal details or your password here.</p>
                        <p class="text-muted"></p>

                        <h3>Change password</h3>

                        <form id="changePwdForm" method="post" action="accountDetails.php">
                            <input type='hidden' name='changePwdSubmit' id='changePwdSubmit' value='1'/>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password_old">Old password</label>
                                        <div class="inputGroupContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                                <input type="password" class="form-control" name="password_old" id="password_old">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password_1">New password</label>
                                        <div class="inputGroupContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                                <input type="password" class="form-control" id="password_1" name="password_1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password_2">Retype new password</label>
                                        <div class="inputGroupContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                                <input type="password" class="form-control" id="password_2" name="password_2">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->

                            <div class="col-sm-12 text-center">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save new password</button>
                            </div>
                        </form>

                        <hr>

                        <h3>Personal details</h3>
                        <form id="personalForm" method="post" action="accountDetails.php">
                            <?php 
                                $accObject = new AccountOperations($siteConfigurationObject);
                                $data = $accObject->getUserInformation();
                                $valid = $data["success"];
                                $dataRow = $data["dataRow"];
                            ?>
                            <input type='hidden' name='personalSubmit' id='personalSubmit' value='1'/>
                            <input type='hidden' name='UserInfoId' id='UserInfoId' value="<?php if($valid){ echo $dataRow["UserInfo_Id"]; } ?>" />
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="firstname">Full Name</label>
                                        <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $siteConfigurationObject->getUserFullName() ?>" >
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="street">Street</label>
                                        <input type="text" class="form-control" id="street" name="street" value="<?php if($valid){ echo $dataRow["Street"]; } ?>" >
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label for="zip">City</label>
                                        <input type="text" class="form-control" id="city" name="city" value="<?php if($valid){ echo $dataRow["City"]; } ?>" >
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label for="zip">ZIP</label>
                                        <input type="text" class="form-control" id="zip" name="zip" value="<?php if($valid){ echo $dataRow["Zip"]; } ?>" >
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label for="state">State</label>
                                        <select class="form-control" id="state" name="state">
                                            <option></option>
                                            <option value="ST1">State 1</option>
                                            <option value="ST2">State 2</option>
                                            <option value="ST3">State 3</option>
                                            <option value="ST4">State 4</option>
                                        </select>
                                        <script type="text/javascript">document.getElementById("state").value="<?php if($valid){ echo $dataRow['State']; } ?>";</script>
                                    </div>
                                </div>
                                <div class="col-sm-10 col-md-3">
                                    <div class="form-group">
                                        <label for="country">Country</label>
                                        <select class="form-control" id="country" name="country">
                                            <option>USA</option>
                                            <option>country 1</option>
                                            <option>country 2</option>
                                            <option>country 3</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="phone">Telephone</label>
                                        <input type="text" class="form-control" id="phone" name="phone" value="<?php if($valid){ echo $dataRow["Phone"]; } ?>" >
                                    </div>
                                </div>
                                <div class="col-sm-12 text-center">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save changes</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->

<?php
require("footer.php");
?>