<?php
    require_once("site_configuration.php");
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "toy";
    $conn = new mysqli($servername, $username, $password, $dbname);
    $userid = $siteConfigurationObject->getUserId();

    $sql = "INSERT INTO ORDERS_MAIN(ORDER_BY) VALUES($userid)";
    $result = $siteConfigurationObject->runSQLQuery($sql);
    if($result["success"]){
        $sql = "SELECT MAX(ORDER_ID) ORDER_ID FROM ORDERS_MAIN WHERE ORDER_BY = $userid";
        $result = $siteConfigurationObject->runSQLQuery($sql);
        if($result["success"]){
            $dataRow = mysqli_fetch_array($result["data"]);
            $order_id = $dataRow["ORDER_ID"];

            $sql = "SELECT P.*, T.price FROM PURCHASED P JOIN TOY T ON P.TOY_ID = T.TOY_ID WHERE USER_ID = $userid AND P.STATUS = 0";
            $purchased_result = $siteConfigurationObject->runSQLQuery($sql);
            if($purchased_result["success"]){
                while($dataRow = mysqli_fetch_array($purchased_result["data"])){
                    $purchase_id = $dataRow["purchase_id"];
                    $toy_id = $dataRow["toy_id"];
                    $price = $dataRow["price"];
                    $quantity = $dataRow["qty"];
                    $sql = "INSERT INTO ORDER_DETAILS(ORDER_ID, TOY_ID, PURCHASE_ID, PRICE, QUANTITY)
                            VALUES($order_id, $toy_id, $purchase_id, $price, $quantity)";
                    $order_details_result = $siteConfigurationObject->runSQLQuery($sql);
                    if($order_details_result["success"]){
                        $sql = "UPDATE purchased SET status = 1 WHERE user_id = $userid and status = 0 and purchase_id=$purchase_id";
                        $update_purchase_result = $siteConfigurationObject->runSQLQuery($sql);
                    }
                }
            }

        }
    }

    //setcookie("orders", "Your orders have been placed, Thank you for purchasing ... ", time()+1);
    header("Location: orderHistory.php");
?>