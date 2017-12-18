<?php include 'topMenu.php';?>
<?php
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "toy";
    $conn = new mysqli($servername, $username, $password, $dbname);
    $userid = $siteConfigurationObject->getUserId();
    echo $userid;

    $returnURL = urlencode("basket.php");
    //if(!empty($_GET)){
    //    $toyid = $_GET['toy_id'];
      // $sql = "insert into purchased(user_id,toy_id) values('1','103');";
    //    $conn->query($sql);
    //}
    //$sql = "select *,count(*) as total from purchased LEFT JOIN toy AS toys ON toys.toy_id = purchased.toy_id where purchased.user_id = $userid and purchased.status = 0 group by user_id";//and toys.deleted = 0;
    $sql = "select p.purchase_id, p.user_id, p.qty, p.toy_id, t.toy_name, t.price, t.image,ROUND((p.qty * t.price), 2) as total from purchased as p
            LEFT JOIN toy AS t ON t.toy_id = p.toy_id 
            where p.user_id = $userid and p.status = 0 and t.status = 1 ";
    $result = $conn->query($sql);
    //echo $result;

    //$sql = "select ROUND(SUM(price),2) as sum,count(*) as total,count(purchased.toy_id) as qty from purchased LEFT JOIN toy AS toys ON toys.toy_id = purchased.toy_id where user_id = $userid and purchased.status = 0";//and deleted = 0

    $sql = "select ROUND(SUM(p.qty * t.price),2) as sum,count(*) as total,sum(p.qty) as quantity 
            from purchased AS p LEFT JOIN toy AS t ON t.toy_id = p.toy_id 
            where user_id = $userid and p.status = 0 and t.status = 1";
    $price = $conn->query($sql);
    while($row = mysqli_fetch_array($price)){
        $sum = $row['sum'];
        $total = $row['quantity'];
    }

	/*$sql = "select user_id, count(purchased.toy_id) as total from purchased LEFT JOIN toy AS toys ON toys.toy_id = purchased.toy_id where user_id = $userid and purchased.status = 0 group by user_id";//and deleted = 0
    $sql = "select user_id, count(p.toy_id) as total from purchased AS p
            LEFT JOIN toy AS t ON t.toy_id = p.toy_id 
            where user_id = $userid and p.status = 0 and t.status = 1 group by user_id";
    $qty = $conn->query($sql);
    while($row = mysqli_fetch_array($qty)){
        $total = $row['total'];
    }*/
    $conn->close();
?>
    <div id="all">

        <div id="content">
            <div class="container">

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="#">Home</a>
                        </li>
                        <li>Shopping cart</li>
                    </ul>
                </div>

                <div class="col-md-9" id="basket">

                    <div class="box">

                        <form method="post" action="checkout1.php">

                            <h1>Shopping cart</h1>
                            <p class="text-muted">
							<?php
												if(mysqli_num_rows($result)==0){
													echo "There are no items in your cart ...";
												}
												else{
													echo "You currently have $total items(s) in your cart.";
		 											}
											?>	
							</p>
							<div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Product</th>
                                            <th>Quantity</th>
                                            <th>Unit price</th>
                                            <th>Discount</th>
                                            <th colspan="1">Total</th>
											<th>Update Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                            <?php
								while($row = $result->fetch_assoc()){
									echo "<tr>";
									echo "<td>"; ?>
                                   <img src="<?php echo "img/products/$row[image]" ?>" alt="" class="img-responsive">
                                    <?php
											echo "</td>";
											echo "<td>".substr($row['toy_name'],0,25)."</td>";
											echo "<td>".$row['qty']."</td>";
											echo "<td>".$row['price']."</td>";
											echo "<td>$ 0.00</td>";
											echo "<td>".$row['total']."</td>";
											echo "<td><a href=\"addToCart.php?toyId=$row[toy_id]&returnURL=$returnURL\" ><i class=\"fa fa-chevron-up\"></i></a>
											<a href=\"deleteToyCart.php?purchase_id=".$row['purchase_id']."\"><i class=\"fa  fa-chevron-down\"></i></a></td>";
									echo "</td>";
									echo "</tr>";
								}
							?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="5">Total</th>
                                            <th colspan="2">
											<?php
												if(mysqli_num_rows($result)>0){
													echo "Total price : $ $sum( $total items )";
		 											}
											?>	
											</th>
                                        </tr>
                                    </tfoot>
                                </table>

                            </div>
                            <!-- /.table-responsive -->

                            <div class="box-footer">
                                <div class="pull-left">
                                    <a href="category.php" class="btn btn-default"><i class="fa fa-chevron-left"></i> Continue shopping</a>
                                </div>
                                <?php if(mysqli_num_rows($result) > 0) : ?>
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-primary">Proceed to checkout <i class="fa fa-chevron-right"></i>
                                    </button>
                                </div>
                            <?php endif;?>
                            </div>

                        </form>

                    </div>
                    <!-- /.box -->


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
                                            <a href="category.php">
                                              <img src= 'img/products/10.jpg'  alt="" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="back">
                                            <a href="category.php">
                                                <img src="img/products/10.jpg" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <a href="category.php" class="invisible">
                                    <img src="img/products/10.jpg" alt="" class="img-responsive">
                                </a>
                                <div class="text">
                                    <h3>Kits</h3>
                                    <p class="price">$14.30</p>
                                </div>
                            </div>
                            <!-- /.product -->
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <div class="product same-height">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front">
                                            <a href="category.php">
                                                <img src="img/products/30.jpg" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="back">
                                            <a href="category.php">
                                                <img src="img/products/30.jpg'" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <a href="category.php" class="invisible">
                                    <img src="img/products/30.jpg" alt="" class="img-responsive">
                                </a>
                                <div class="text">
                                    <h3>Game of Dice</h3>
                                    <p class="price">$50.60</p>
                                </div>
                            </div>
                            <!-- /.product -->
                        </div>


                        <div class="col-md-3 col-sm-6">
                            <div class="product same-height">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front">
                                            <a href="category.php">
                                                <img src="img/products/55.jpg" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="back">
                                            <a href="category.php">
                                                <img src="img/products/55.jpg" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <a href="category.php" class="invisible">
                                    <img src="img/products/55.jpg" alt="" class="img-responsive">
                                </a>
                                <div class="text">
                                    <h3>Animal Toys</h3>
                                    <p class="price">$56.00</p>

                                </div>
                            </div>
                            <!-- /.product -->
                        </div>

                    </div>


                </div>
                <!-- /.col-md-9 -->

                <div class="col-md-3">
                    <div class="box" id="order-summary">
                        <div class="box-header">
                            <h3>Order summary</h3>
                        </div>
                        <p class="text-muted">Shipping and additional costs are calculated based on the values you have entered.</p>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Order subtotal</td>
                                        <th>
										<?php
												if(mysqli_num_rows($result)==0){
													echo "There are no items in your cart ...";
												}
												else{
													echo "$ $sum";
		 											}
											?>	
										</th>
                                    </tr>
                                    <tr>
                                        <td>Shipping and handling</td>
                                        <th>$10.00</th>
                                    </tr>
                                    <tr>
                                        <td>Tax</td>
                                        <th>$0.00</th>
                                    </tr>
                                    <tr class="total">
                                        <td>Total</td>
                                        <th>
										<?php
												$shipping=10;
												if(mysqli_num_rows($result)==0){
													echo "There are no items in your cart ...";
												}
												else{
													echo "$";
													print ($sum + $shipping);
													}
											?>	
										</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>


                    <div class="box">
                        <div class="box-header">
                            <h4>Coupon code</h4>
                        </div>
                        <p class="text-muted">If you have a coupon code, please enter it in the box below.</p>
                        <form>
                            <div class="input-group">

                                <input type="text" class="form-control">

                                <span class="input-group-btn">

					<button class="btn btn-primary" type="button"><i class="fa fa-gift"></i></button>

				    </span>
                            </div>
                            <!-- /input-group -->
                        </form>
                    </div>

                </div>
                <!-- /.col-md-3 -->

            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->
        
<?php include 'footer.php';?>