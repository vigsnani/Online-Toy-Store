<?php include 'topMenu.php';?>
<?php
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "toy";
    $conn = new mysqli($servername, $username, $password, $dbname);
    $userid = $siteConfigurationObject->getUserId();

    $sql = "select p.purchase_id, p.user_id, p.qty, p.toy_id, t.toy_name, t.price, t.image,ROUND((p.qty * t.price), 2) as total from purchased as p
            LEFT JOIN toy AS t ON t.toy_id = p.toy_id 
            where p.user_id = $userid and p.status = 0 and t.status = 1";
    $result = $conn->query($sql);

    $sql = "select ROUND(SUM(p.qty * t.price),2) as sum,count(*) as total,sum(p.qty) as quantity 
            from purchased AS p LEFT JOIN toy AS t ON t.toy_id = p.toy_id 
            where user_id = $userid and p.status = 0 and t.status = 1";
    $price = $conn->query($sql);
    while($row = mysqli_fetch_array($price)){
        $sum = $row['sum'];
        $total = $row['quantity'];
    }

    $conn->close();
?>
    <div id="all">

        <div id="content">
            <div class="container">

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="#">Home</a>
                        </li>
                        <li>Checkout - Order review</li>
                    </ul>
                </div>

                <div class="col-md-9" id="checkout">

                    <div class="box">
                        <form method="post" action="checkout_form.php">
                            <h1>Checkout - Order review</h1>
                            <ul class="nav nav-pills nav-justified">
                                <li><a href="checkout1.php"><i class="fa fa-map-marker"></i><br>Address</a>
                                </li>
                                <li><a href="checkout2.php"><i class="fa fa-truck"></i><br>Delivery Method</a>
                                </li>
                                <li><a href="checkout3.php"><i class="fa fa-money"></i><br>Payment Method</a>
                                </li>
                                <li class="active"><a href="#"><i class="fa fa-eye"></i><br>Order Review</a>
                                </li>
                            </ul>

                            <div class="content">
                                <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Product</th>
                                            <th>Quantity</th>
                                            <th>Unit price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                            <?php
								while($row = $result->fetch_assoc()){
									echo "<tr>";
									echo "<td><img src='img/products/".$row['image']."' alt='Toy Image'></td>";
									echo "<td>".substr($row['toy_name'],0,25)."</td>";
									echo "<td>".$row['qty']."</td>";
									echo "<td>".$row['price']."</td>";
									echo "<td>$ ".$row['total']."</td>";
									echo "</tr>";
								}
							?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3">Total</th>
                                            <th class="text-right" colspan="2">
											<?php
												if(mysqli_num_rows($result)==0){
													echo "There are no items in your cart ...";
												}
												else{
													echo "Total price : $ $sum( $total items)";
		 											}
											?>	
											</th>
                                        </tr>
                                    </tfoot>
                                </table>

                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.content -->

                            <div class="box-footer">
                                <div class="pull-left">
                                    <a href="checkout3.php" class="btn btn-default"><i class="fa fa-chevron-left"></i>Back to Payment method</a>
                                </div>
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-primary">Place an order<i class="fa fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.box -->


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
													echo "$$sum";
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

                </div>
                <!-- /.col-md-3 -->

            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->
    </div>
    <!-- /#all -->
        
<?php include 'footer.php';?>