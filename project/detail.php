<?php
require("topMenu.php");


$conn = mysqli_connect("localhost","root","root","toy");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    echo "Database Connection Error";
}
else{
if(isset($_GET['toyId']))   
    $toy_id = $_GET['toyId'];
else {
    $toy_id = 0;
}
     $sql = "SELECT * FROM TOY where toy_id = '$toy_id'";
     $result = mysqli_query($conn, $sql);
     if(! $result ) {
            die('Could not get data: ' . mysqli_error());
    }
}

$datarow = mysqli_fetch_array($result);

$url = "$_SERVER[REQUEST_URI]";
$path = parse_url($url, PHP_URL_PATH);
$qs = parse_url($url, PHP_URL_QUERY);
$returnURL = $path;
if(isset($qs))
    $returnURL .= "?$qs";
$returnURL = urlencode($returnURL);

?>

    <div id="all">

        <div id="content">
            <div class="container">

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="#">Home</a>
                        </li>
                        <li><a href="#">Category</a>
                        </li>
                        <li><?php echo $datarow["toy_name"] ?></li>
                    </ul>

                </div>

                <div class="col-md-3">
                    <!-- *** MENUS AND FILTERS ***
 _________________________________________________________ -->
                    <div class="panel panel-default sidebar-menu">

                        <div class="panel-heading">
                            <h3 class="panel-title">Categories</h3>
                        </div>

                        <div class="panel-body">
                            <ul class="nav nav-pills nav-stacked category-menu">
                                <li>
                                    <a href="category.php?category=0">All Products </a>
                                </li>
                                <li>
                                    <a href="category.php?category=1">Arts & Craft </a>
                                    <ul>
                                        <li><a href="category.php?category=6">Drawing & Painting</a>
                                        </li>
                                        <li><a href="category.php?category=7">Craft Kits</a>
                                        </li>
                                        <li><a href="category.php?category=8">Building Toys</a>
                                        </li>
                                        <li><a href="category.php?category=9">Sketching Tablets</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="category.php?category=2">Learning & Education </a>
                                    <ul>
                                        <li><a href="category.php?category=10">Science</a>
                                        </li>
                                        <li><a href="category.php?category=5">Puzzles</a>
                                        </li>
                                        <li><a href="category.php?category=11">Model & Model Kits</a>
                                        </li>
                                        <li><a href="category.php?category=12">Puzzle Accessories</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="category.php?category=3">Games </a>
                                    <ul>
                                        <li><a href="category.php?category=13">Sports</a>
                                        </li>
                                        <li><a href="category.php?category=14">Video Games</a>
                                        </li>
                                        <li><a href="category.php?category=15">Board Games</a>
                                        </li>
                                        <li><a href="category.php?category=16">Scooters</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="category.php?category=4">Electronic Toys </a>
                                    <ul>
                                        <li><a href="category.php?category=17">Kids Toys</a>
                                        </li>
                                        <li><a href="category.php?category=18">Cameras</a>
                                        </li>
                                        <li><a href="category.php?category=19">RC Figures & Robots</a>
                                        </li>
                                        <li><a href="category.php?category=20">Systems & Accessories</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="row" id="productMain">
                        <div class="col-sm-6">
                            <div id="mainImage">
                                <img src="<?php echo "img/products/$datarow[image]" ?>" alt="" class="img-responsive" style="height:500px;width:400px;">
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="box">
                                <h2 class="text-center"><?php echo $datarow["toy_name"] ?></h2>
                                <p class="goToDescription"><a href="#details" class="scroll-to">Scroll to product details, material & care and sizing</a>
                                </p>
                                <p class="price">$<?php echo $datarow["price"] ?></p>

                                <p class="text-center buttons">
                                    <?php if ($siteConfigurationObject->isUserLoggedIn()) : ?>
                                        <a href=<?php echo 'addToCart.php?toyId='.$datarow["toy_id"] . "&returnURL=$returnURL" ?> class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                    <?php endif; ?>
                                   
                                    <?php if ($siteConfigurationObject->isUserAdmin()) : 
                                               if ($datarow["status"] == "1") : ?>
                                                    <a href=<?php echo 'deleteProduct.php?toyId='.$datarow["toy_id"] . "&returnURL=$returnURL&status=0" ?> class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Disable Product</a>
                                                <?php else :?>
                                                    <a href=<?php echo 'deleteProduct.php?toyId='.$datarow["toy_id"] . "&returnURL=$returnURL&status=1" ?> class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Enable Product</a>
                                    <?php endif; 
                                        endif;?>
                                </p>


                            </div>

                            <!--<div class="row" id="thumbs">
                                <div class="col-xs-4">
                                    <a href="img/detailbig1.jpg" class="thumb">
                                        <img src="img/detailsquare.jpg" alt="" class="img-responsive">
                                    </a>
                                </div>
                                <div class="col-xs-4">
                                    <a href="img/detailbig2.jpg" class="thumb">
                                        <img src="img/detailsquare2.jpg" alt="" class="img-responsive">
                                    </a>
                                </div>
                                <div class="col-xs-4">
                                    <a href="img/detailbig3.jpg" class="thumb">
                                        <img src="img/detailsquare3.jpg" alt="" class="img-responsive">
                                    </a>
                                </div>
                            </div>-->
                        </div>

                    </div>


                    <div class="box" id="details">
                        <p>
                            <h4>Product details</h4>
                            <?php if ($siteConfigurationObject->isUserAdmin()) : ?>
                                <form id="newProductForm" action="updateProductInfo.php" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <input type="hidden" name="toyid" value=<?php echo $datarow["toy_id"] ?> >

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="toyname">Product Name<span class="required">*</span>
                                                </label>
                                                <input type="text" class="form-control" id="toyname" name="toyname" value="<?php echo $datarow["toy_name"] ?>">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="price">Price <span class="required">*</span>
                                                </label>
                                                <input type="text" class="form-control" id="price" name="price" value="<?php echo $datarow["price"] ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="available">Quantity <span class="required">*</span>
                                                </label>
                                                <input type="text" class="form-control" id="available" name="available" value="<?php echo $datarow["total_available"] ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label class="control-label">Select File</label>
                                                <input type="file" class="file" id="fileToUpload" name="fileToUpload">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label for="description">Category <span class="required">*</span>
                                                </label>
                                                <select class="form-control" id="category" name="category[]" multiple="multiple" title="hold ctrl or shift (or drag with the mouse) to select more than one.">
                                                    <?php 
                                                        $query = "SELECT C.category_id, C.category_name, crt.toy_id  FROM Category C LEFT JOIN Category_ref_table crt
                                                                    ON c.category_id = crt.category_id AND crt.toy_id = $toy_id";

                                                        $result = $siteConfigurationObject->runSelectQuery($query);
                                                        if($result["success"]){
                                                            while($row = mysqli_fetch_array($result["data"])){
                                                                if(isset($row["toy_id"]))
                                                                    echo "<option value=\"$row[category_id]\" selected=\"true\">$row[category_name]</option>";
                                                                else
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
                                                <textarea class="form-control" id="description" name="description" rows="4"><?php echo $datarow["description"] ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12 text-right">
                                            <button class="btn btn-primary" name="submitForm" type="submit"><i class="fa fa-plus"></i> Save Changes</button>
                                        </div>
                                    </div>


                                </form>
                            <?php else : ?>
                                <blockquote>
                                <p><em><?php echo nl2br($datarow["description"]) ?></em></p></blockquote>
                                <h4>In Stock : <?php echo $datarow["total_available"] ?></h4>
                            <?php endif;?>
                            
                            <!--<h4>Size & Fit</h4>
                            <ul>
                                <li>Regular fit</li>
                                <li>The model (height 5'8" and chest 33") is wearing a size S</li>
                            </ul>

                            <blockquote>
                                <p><em>Define style this season with Armani's new range of trendy tops, crafted with intricate details. Create a chic statement look by teaming this lace number with skinny jeans and pumps.</em>
                                </p>
                            </blockquote>-->

                            <hr>
                            <div class="social">
                                <h4>Show it to your friends</h4>
                                <p>
                                    <a href="#" class="external facebook" data-animate-hover="pulse"><i class="fa fa-facebook"></i></a>
                                    <a href="#" class="external gplus" data-animate-hover="pulse"><i class="fa fa-google-plus"></i></a>
                                    <a href="#" class="external twitter" data-animate-hover="pulse"><i class="fa fa-twitter"></i></a>
                                    <a href="#" class="email" data-animate-hover="pulse"><i class="fa fa-envelope"></i></a>
                                </p>
                            </div>
                    </div>

                    <div class="row same-height-row">
                        <div class="col-md-3 col-sm-6">
                            <div class="box same-height">
                                <h3>You may also like these products</h3>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <div class="product same-height">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front">
                                            <a href="#">
                                                <img src="img/products/25.jpg" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="back">
                                            <a href="#">
                                                <img src="img/products/25.jpg" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                   </div>
                                </div>
                                <a href="#" class="invisible">
                                    <img src="img/products/25.jpg" alt="" class="img-responsive">
                                </a>
                                <div class="text">
                                    <h3>Crafts</h3>
                                    <p class="price">$50.00</p>
                                </div>
                            </div>
                            <!-- /.product -->
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <div class="product same-height">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front">
                                            <a href="#">
                                                <img src="img/products/35.jpg" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="back">
                                            <a href="#">
                                                <img src="img/products/35.jpg" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                        
                                    </div>
                                </div>
                                <a href="#" class="invisible">
                                    <img src="img/products/35.jpg" alt="" class="img-responsive">
                                </a>
                                <div class="text">
                                    <h3>Toys</h3>
                                    <p class="price">$112.00</p>
                                </div>
                            </div>
                            <!-- /.product -->
                        </div>


                        <div class="col-md-3 col-sm-6">
                            <div class="product same-height">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front">
                                            <a href="#">
                                                <img src="img/products/55.jpg" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="back">
                                            <a href="#">
                                                <img src="img/products/55.jpg" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <a href="#" class="invisible">
                                    <img src="img/products/55.jpg" alt="" class="img-responsive">
                                </a>
                                <div class="text">
                                    <h3>Play Toys</h3>
                                    <p class="price">$65.00</p>

                                </div>
                            </div>
                            <!-- /.product -->
                        </div>

                    </div>
                
                
                    <div class="row same-height-row">
                        <div class="col-md-3 col-sm-6">
                            <div class="box same-height">
                                <h3>Products viewed recently</h3>
                            </div>
                        </div>


                        <div class="col-md-3 col-sm-6">
                            <div class="product same-height">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front">
                                            <a href="#">
                                                <img src="img/products/12.jpg" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="back">
                                            <a href="#">
                                                <img src="img/products/12.jpg" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                       
                                    </div>
                                </div>
                                <a href="#" class="invisible">
                                    <img src="img/products/12.jpg" alt="" class="img-responsive">
                                </a>
                                <div class="text">
                                    <h3>Kits</h3>
                                    <p class="price">$20.00</p>
                                </div>
                            </div>
                            <!-- /.product -->
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <div class="product same-height">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front">
                                            <a href="#">
                                                <img src="img/products/50.jpg" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="back">
                                            <a href="#">
                                                <img src="img/products/50.jpg" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                        
                                    </div>
                                </div>
                                <a href="#" class="invisible">
                                    <img src="img/products/50.jpg" alt="" class="img-responsive">
                                </a>
                                <div class="text">
                                    <h3>Puzzles</h3>
                                    <p class="price">$80.00</p>
                                </div>
                            </div>
                            <!-- /.product -->
                        </div>


                        <div class="col-md-3 col-sm-6">
                            <div class="product same-height">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front">
                                            <a href="#">
                                                <img src="img/products/60.jpg" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="back">
                                            <a href="#">
                                                <img src="img/products/60.jpg" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                       
                                    </div>
                                </div>
                                <a href="#" class="invisible">
                                    <img src="img/products/60.jpg" alt="" class="img-responsive">
                                </a>
                                <div class="text">
                                    <h3>Games</h3>
                                    <p class="price">$45.00</p>

                                </div>
                            </div>
                            <!-- /.product -->
                        </div>

                    </div>


                </div>
                <!-- /.col-md-9 -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->

<?php
require("footer.php");
?>
