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
                        <li>New Product</li>
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
                                <li>
                                    <a href="accountDetails.php"><i class="fa fa-user"></i> My account</a>
                                </li>
                                <li>
                                    <a href="orderhistory.php"><i class="fa fa-list"></i> My orders</a>
                                </li>
                                <?php if ($siteConfigurationObject->isUserAdmin()) : ?>
                                    <li class="active">
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
                        <h1>Add a new product.</h1>
                        <p class="lead">Product Details</p>
                        <p class="text-muted"></p>

                        <hr>

                        <form id="newProductForm" action="updateProductInfo.php" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <input type="hidden" name="toyid" value="new">

                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="toyname">Product Name<span class="required">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="toyname" name="toyname">
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="price">Price <span class="required">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="price" name="price">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="available">Quantity <span class="required">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="available" name="available">
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label class="control-label">Select Image File</label>
                                        <input type="file" class="file" id="fileToUpload" name="fileToUpload">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="description">Category <span class="required">*</span>
                                        </label>
                                        <select class="form-control" id="category" name="category[]" multiple title="hold ctrl or shift (or drag with the mouse) to select more than one.">
                                            <?php 
                                                $query = "SELECT * FROM Category";
                                                $result = $siteConfigurationObject->runSelectQuery($query);
                                                if($result["success"]){
                                                    while($row = mysqli_fetch_array($result["data"])){
                                                        echo "<option value=\"$row[category_id]\">$row[category_name]</option>";
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="description">Product Description <span class="required">*</span>
                                        </label>
                                        <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 text-right">
                                    <button type="submit" class="btn btn-primary" name="submitForm"><i class="fa fa-plus"></i> Add Product</button>
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