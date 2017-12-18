<?php require('topMenu.php');

    $userid = $siteConfigurationObject->getUserId();
    $query = "SELECT OM.ORDER_ID, DATE(SHIPPING_DATE) SHIPPING_DATE, DATE(ORDER_DATE) ORDER_DATE, ORDER_BY, ROUND(SUM(OD.PRICE * OD.QUANTITY), 2) AS TOTAL
                FROM Orders_Main OM JOIN ORDER_DETAILS OD ON OD.ORDER_ID = OM.ORDER_ID
                WHERE OM.ORDER_BY = $userid
                GROUP BY OM.ORDER_ID ORDER BY ORDER_ID DESC";
    $result = $siteConfigurationObject->runSQLQuery($query);
    if($result["success"]){
        $ORDERS = $result["data"];
        $NO_OF_ORDERS = $result["rows"];
    }
?>
   <div id="all">

        <div id="content">
            <div class="container">

                <div class="col-md-12">

                    <ul class="breadcrumb">
                        <li><a href="#">Home</a>
                        </li>
                        <li>My orders</li>
                    </ul>

                </div>

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
                                <li class="active">
                                    <a href="orderhistory.php"><i class="fa fa-list"></i> My orders</a>
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

                <div class="col-md-9" id="customer-orders">
                    <div class="box">
                        <h1>My orders</h1>
                        <p class="text-muted">If you have any questions, please feel free to <a href="contact.html">contact us</a>, our customer service center is working for you 24/7.</p>
                        <hr>
                        <?php if(isset($ORDERS) && $NO_OF_ORDERS > 0) : ?>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Order #</th>
                                            <th>Placed on</th>
                                            <th>Order Total</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($mainOrderRow = mysqli_fetch_array($ORDERS)) : ?>
                                            <tr>
                                                <td><?php echo $mainOrderRow["ORDER_ID"] ?></td>
                                                <td><?php echo $mainOrderRow["ORDER_DATE"] ?></td>
                                                <td>$ <?php echo $mainOrderRow["TOTAL"] ?></td>
                                                <td><?php if(isset($mainOrderRow["SHIPPING_DATE"]) && !empty($mainOrderRow["SHIPPING_DATE"])) 
                                                                echo "Shipped On $mainOrderRow[SHIPPING_DATE]";
                                                            else
                                                                echo "Processing";
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                                $query = "SELECT TOY.TOY_NAME, OD.PRICE, OD.QUANTITY, ROUND((OD.PRICE * OD.QUANTITY), 2) AS TOTAL
                                                            FROM Order_Details OD
                                                            JOIN Orders_Main OM ON OD.ORDER_ID = OM.ORDER_ID
                                                            JOIN TOY ON OD.TOY_ID = TOY.TOY_ID
                                                            WHERE OD.ORDER_ID = $mainOrderRow[ORDER_ID]";
                                                $result = $siteConfigurationObject->runSQLQuery($query);
                                                if($result["success"]){
                                                    $ORDER_DETAILS = $result["data"];
                                                    $NO_OF_ORDER_DETAILS = $result["rows"];
                                                }
                                            ?>
                                            <?php if(isset($ORDER_DETAILS) && $NO_OF_ORDER_DETAILS > 0) : ?>
                                            <tr>
                                                <td colspan="4">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Name</th>
                                                                <th>Price</th>
                                                                <th>Quantity</th>
                                                                <th>Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php while($orderDetailsRow = mysqli_fetch_array($ORDER_DETAILS)) : ?>
                                                                <tr>
                                                                    <td><?php echo $orderDetailsRow["TOY_NAME"] ?></td>
                                                                    <td>$ <?php echo $orderDetailsRow["PRICE"] ?></td>
                                                                    <td><?php echo $orderDetailsRow["QUANTITY"] ?></td>
                                                                    <td>$ <?php echo $orderDetailsRow["TOTAL"] ?></td>
                                                                </tr>
                                                            <?php endwhile;?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                </td>
                                            </tr>
                                            <?php endif;?>
                                        <?php endwhile;?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else : echo "You did not place any orders ...";?>
                        <?php endif;?>
                    </div>
                </div>

            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->




    </div>
    <!-- /#all -->

<?php include 'footer.php';?>