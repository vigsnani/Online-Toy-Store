<?php
require("topMenu.php");
$PHP_SELF = $_SERVER['PHP_SELF'];
$url = "$_SERVER[REQUEST_URI]";
$path = parse_url($url, PHP_URL_PATH);
$queryString = parse_url($url, PHP_URL_QUERY);
$returnURL = $path;
if(isset($queryString))
    $returnURL .= "?$queryString";
$returnURL = urlencode($returnURL);
$sortBy = "1";
if(isset($_GET["sortBy"]))
    $sortBy = $_GET["sortBy"];

if(isset($_GET["search"]) && !empty(trim($_GET["search"])))
    $search = $_GET["search"];
?>


    <div id="all">

        <div id="content">
            <div class="container">

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="#">Home</a>
                        </li>
                        <li>Category</li>
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

                    <div class="box info-bar">
                        <div class="row">

                            <div class="col-sm-12 col-md-12  products-number-sort">
                                <div class="row">
                                    <form class="form-inline">
                                        <div class="col-md-6 col-sm-6">
                                            <div class="products-number">
                                                <strong>Show</strong>  <a href="#" class="btn btn-default btn-sm btn-primary">6</a>  <a href="#" class="btn btn-default btn-sm">12</a>  <a href="#" class="btn btn-default btn-sm">All</a> products
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="products-sort-by">
                                                <strong>Sort by</strong>
                                                <select name="sort-by" class="form-control" id="sortBy">
                                                    <option value="1">Price (Low - High)</option>
                                                    <option value="2">Price (High - Low)</option>
                                                    <option value="3">Name (Ascending)</option>
                                                    <option value="4">Name (Descending)</option>
                                                </select>
                                                <a href="#" class="btn btn-default btn-sm btn-primary" onclick="return sortData();">Sort</a>
                                                <script type="text/javascript">
                                                    function sortData(){
                                                        var currentURL = window.location.href;
                                                        var sortBy = document.getElementById("sortBy").value;
                                                        var url1 = "", url2 = "";
                                                        if(currentURL.toLowerCase().indexOf("sortby") >= 0){
                                                            url1= currentURL.substring(0, currentURL.toLowerCase().indexOf("&sortby"));
                                                            url2= currentURL.substring(currentURL.toLowerCase().indexOf("&sortby")+9);
                                                            currentURL = url1 + url2;
                                                        }
                                                        
                                                        window.location = currentURL + "&sortBy=" + sortBy;
                                                        
                                                        return true;
                                                    }
                                                    document.getElementById("sortBy").value="<?php echo $sortBy; ?>";
                                                </script>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row products">
                        <?php
						
						 $rec_limit = 6;
                         $count=0;
 
        				$conn = mysqli_connect("localhost","root","root","toy");

        				if (!$conn) {
        					die("Connection failed: " . mysqli_connect_error());
        					echo "Database Connection Error";
        				}
        				else{
        				if(isset($_GET['category']))	
        					$category = $_GET['category'];
        				else if (isset($_POST["category"])) {
        						 $category = $_POST["category"];

        				}
        				else {
        					$category = 0;
        				}
        						//echo "<h3>TOYS</h3><br>";
        						 /* Get total number of records */
        						 //$sql = "SELECT count(toy_id) FROM Toy JOIN  where category_id = '$category'";
                                if($siteConfigurationObject->isUserAdmin())
                                    $status = "0,1";
                                else
                                    $status = "1";

                                $OrderBy = "ORDER BY PRICE ASC";

                                $searchQuery = "";

                                if(isset($search) && !empty($search)){
                                    $searchQuery = " AND toy_name like '%$search%' ";
                                }


                                switch($sortBy){
                                    case 1 : $OrderBy = "ORDER BY PRICE ASC";
                                            break;
                                    case 2 : $OrderBy = "ORDER BY PRICE DESC";
                                            break;
                                    case 3 : $OrderBy = "ORDER BY TOY_NAME ASC";
                                            break;
                                    case 4 : $OrderBy = "ORDER BY TOY_NAME DESC";
                                            break;
                                    default : $OrderBy = "ORDER BY PRICE ASC";
                                            break;
                                }

                                 if($category == 0)
                                    $sql = "SELECT COUNT(Toy.Toy_ID) FROM Toy JOIN Category_ref_table AS C ON Toy.TOY_ID = C.TOY_ID WHERE Status IN ($status) $searchQuery";
                                else
                                    $sql = "SELECT COUNT(Toy.Toy_ID) FROM Toy JOIN Category_ref_table AS C ON Toy.TOY_ID = C.TOY_ID WHERE Category_ID = $category AND Status IN ($status) $searchQuery";

        						$retval =  $conn->query($sql);
        					   
        						 if(! $retval ) {
        							die('Could not get data: ' . mysqli_error());
        						 }
        						 $row = mysqli_fetch_array($retval, MYSQLI_NUM );
        						 $rec_count = $row[0];
        						 //echo $rec_count;
        						  $pages = $rec_count / $rec_limit;
        						 
        						 if(isset($_GET{'page'})) {
        							$page = $_GET{'page'};
        							$offset = $rec_limit * ($page - 1);
        						 }else {
        							$page = 1;
        							$offset = 0;
        						 }
        						 
        						 $left_rec = $rec_count - (($page - 1) * $rec_limit);
                                 
        						if ( $category == '0')
        						{
        								$query = "SELECT * FROM Toy WHERE Status IN ($status) $searchQuery $OrderBy LIMIT $offset, $rec_limit";	
        						}
        						else
        						{
        						  $query = "SELECT * FROM Toy JOIN Category_ref_table AS C ON TOY.TOY_ID = C.TOY_ID WHERE Category_ID = $category AND Status IN ($status) $searchQuery $OrderBy LIMIT $offset, $rec_limit" ;
        						}
        						
        						
        						$result = mysqli_query($conn, $query);
        						//$rec_count = mysqli_affected_rows($conn);
        						
        				}

						?>
                        <?php while($datarow = mysqli_fetch_array($result)) : $count++;?>
                            <div class="col-md-4 col-sm-6 products">
                                <div class="product">
                                    <a href="detail.php">
                                        <img src="<?php echo "img/products/$datarow[image]" ?>" alt="" class="img-responsive">
                                    </a>
                                    <div class="text">
                                        <input type='hidden' name='loginModalSubmit' id='loginModalSubmit' value=<?php echo $datarow["toy_id"] ?> />
                                        <h3><a href=<?php echo 'detail.php?toyId='.$datarow["toy_id"] ?> ><?php echo $datarow["toy_name"] ?></a></h3>
                                        <p class="price"><?php echo "$".$datarow["price"]; if($datarow["status"] == 1) echo "(In Stock)"; else echo "(Disabled)"; ?></p>
                                        <p class="buttons">
											<a href=<?php echo 'detail.php?toyId='.$datarow["toy_id"] ?> class="btn btn-default">View detail</a>
                                            <?php if ($siteConfigurationObject->isUserLoggedIn()) : ?>
                                                <a href=<?php echo 'addToCart.php?toyId='.$datarow["toy_id"] . "&returnURL=$returnURL" ?> class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                            <?php endif; ?>
                                        </p>
                                    </div>
                                    <!-- /.text -->
                                </div>
                                <!-- /.product -->
                            </div>
                        <?php endwhile;?>
                        <?php while($rec_limit != $count) : $count++;?>
                            <div class="col-md-4 col-sm-6 products">
                                <div class="product">
                                </div>
                                <!-- /.product -->
                            </div>
                        <?php endwhile;?>
                    </div>
                    <!-- /.products -->

                    <div class="row pages">
                        <ul class="pagination">
                            <?php if($rec_limit < $rec_count) : ?>
                            <?php 
                                $currQS = "?category=$category"; 
                                if(isset($search)) {
                                    $currQS = "?search=$search";
                                } 
                            ?>
                                <?php if($page == 1) : $next = $page + 1;?>
                                    <li><a href=<?php echo $PHP_SELF . "$currQS&sortBy=$sortBy&page=$next" ?> class="btn btn-primary btn-lg"><i class="fa fa-chevron-right"></i></a></li>
                                 <?php elseif($left_rec < $rec_limit ) : $last = $page - 1; ?>
                                    <li><a href=<?php echo $PHP_SELF . "$currQS&sortBy=$sortBy&page=$last" ?> class="btn btn-primary btn-lg"><i class="fa fa-chevron-left"></i></a></li>
                                <?php elseif($page > 1) : $next = $page + 1; $last = $page - 1;?>
                                    <li><a href=<?php echo $PHP_SELF . "$currQS&sortBy=$sortBy&page=$last" ?> class="btn btn-primary btn-lg"><i class="fa fa-chevron-left"></i></a></li>
                                    <li><a href=<?php echo $PHP_SELF . "$currQS&sortBy=$sortBy&page=$next" ?> class="btn btn-primary btn-lg"><i class="fa fa-chevron-right"></i></a></li>
                                <?php endif;?>
                            <?php endif;?>
                        </ul>
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