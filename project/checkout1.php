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
<?php
require_once("account_helper.php");


if(isset($_POST['personalSubmit'])){
    $accObject = new AccountOperations($siteConfigurationObject);
    $accObject->updateUserInformation();
}

?>
    <div id="all">

        <div id="content">
            <div class="container">

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="#">Home</a>
                        </li>
                        <li>Checkout - Address</li>
                    </ul>
                </div>

                <div class="col-md-9" id="checkout">

                    <div class="box">
                        <form method="post" action="checkout2.php">
                            <h1>Checkout</h1>
                            <ul class="nav nav-pills nav-justified">
                                <li class="active"><a href="#"><i class="fa fa-map-marker"></i><br>Address</a>
                                </li>
                                <li class="disabled"><a href="#"><i class="fa fa-truck"></i><br>Delivery Method</a>
                                </li>
                                <li class="disabled"><a href="#"><i class="fa fa-money"></i><br>Payment Method</a>
                                </li>
                                <li class="disabled"><a href="#"><i class="fa fa-eye"></i><br>Order Review</a>
                                </li>
                            </ul>

                            <div class="content">
                            <?php 
                                $accObject = new AccountOperations($siteConfigurationObject);
                                $data = $accObject->getUserInformation();
                                $valid = $data["success"];
                                $dataRow = $data["dataRow"];
                            ?>
                            <input type='hidden' name='personalSubmit' id='personalSubmit' value='1'/>
                            <input type='hidden' name='UserInfoId' id='UserInfoId' value="<?php if($valid){ echo $dataRow["UserInfo_Id"]; } ?>" />
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="firstname">Full Name</label>
                                        <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $siteConfigurationObject->getUserFullName() ?>" >
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="street">Street</label>
                                        <input type="text" class="form-control" id="street" name="street" value="<?php if($valid){ echo $dataRow["Street"]; } ?>" >
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-3">
                                    <div class="form-group">
                                        <label for="zip">City</label>
                                        <input type="text" class="form-control" id="city" name="city" value="<?php if($valid){ echo $dataRow["City"]; } ?>" >
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <div class="col-sm-3 col-md-3">
                                    <div class="form-group">
                                        <label for="zip">ZIP</label>
                                        <input type="text" class="form-control" id="zip" name="zip" value="<?php if($valid){ echo $dataRow["Zip"]; } ?>" >
                                    </div>
                                </div>
                                <div class="col-sm-3 col-md-3">
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
                                <div class="col-sm-3 col-md-3">
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
                            </div>
                        </div>

                            <div class="box-footer">
                                <div class="pull-left">
                                    <a href="basket.php" class="btn btn-default"><i class="fa fa-chevron-left"></i>Back to basket</a>
                                </div>
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-primary">Continue to Delivery Method<i class="fa fa-chevron-right"></i>
                                    </button>
                                </div>
                                <!-- /.row -->
                            </div>
                            </div>
                        </form>
                    
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

                </div>
                <!-- /.col-md-3 -->

            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->

    </div>
    <!-- /#all -->

<?php include 'footer.php';?>