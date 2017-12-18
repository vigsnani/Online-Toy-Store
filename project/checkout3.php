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
            where p.user_id = $userid and p.status = 0 and t.status = 1 group by user_id, p.toy_id";
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
                        <li>Checkout - Payment method</li>
                    </ul>
                </div>

                <div class="col-md-9" id="checkout">

                    <div class="box">
                        <form method="post" action="checkout4.php">
                            <h1>Checkout - Payment method</h1>
                            <ul class="nav nav-pills nav-justified">
                                <li><a href="checkout1.php"><i class="fa fa-map-marker"></i><br>Address</a>
                                </li>
                                <li><a href="checkout2.php"><i class="fa fa-truck"></i><br>Delivery Method</a>
                                </li>
                                <li class="active"><a href="#"><i class="fa fa-money"></i><br>Payment Method</a>
                                </li>
                                <li class="disabled"><a href="checkout4.html"><i class="fa fa-eye"></i><br>Order Review</a>
                                </li>
                            </ul>

                            <div class="content">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="box payment-method">

                                            <h4>Paypal</h4>

                                            <p>We like it all.</p>

                                            <div class="box-footer text-center">

                                                <input type="radio" name="payment" value="payment1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="box payment-method">

                                            <h4>Cash on delivery</h4>

                                            <p>You pay when you get it.</p>

                                            <div class="box-footer text-center">

                                                <input type="radio" name="payment" value="payment3">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="box payment-method">

                                            <h4>Payment gateway</h4>

                                            <p>VISA and Mastercard only.</p>

                                            <div class="box-footer text-center">

                                                <input type="radio" name="payment" value="payment2">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="box">
                                            <div class="content">
                                                <div class="row">
                                                    <div class="form-group col-sm-10">
                                                        <label for="cardnumber">Card Number</label>
                                                        <input type="text" class="form-control" id="cardnumber" name="cardnumber">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-sm-10">
                                                        <label for="cardname">Name on the Card</label>
                                                        <input type="text" class="form-control" id="cardname" name="cardname">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-sm-3">
                                                        <label for="month">Month</label>
                                                        <input type="text" class="form-control" id="month" name="month">
                                                    </div>
                                                    <div class="form-group col-sm-3">
                                                        <label for="year">Year</label>
                                                        <input type="text" class="form-control" id="year" name="year">
                                                    </div>
                                                    <div class="form-group col-sm-3">
                                                        <label for="cvv">CVV</label>
                                                        <input type="password" class="form-control" id="cvv" name="cvv">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-sm-4">
                                                        <label for="zip">Zip Code</label>
                                                        <input type="text" class="form-control" id="zip" name="zip">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.row -->

                            </div>
                            <!-- /.content -->

                            <div class="box-footer">
                                <div class="pull-left">
                                    <a href="checkout2.php" class="btn btn-default"><i class="fa fa-chevron-left"></i>Back to Shipping method</a>
                                </div>
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-primary">Continue to Order review<i class="fa fa-chevron-right"></i>
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


