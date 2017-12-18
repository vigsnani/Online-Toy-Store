<?php
    require_once("site_configuration.php");
    $conn = mysqli_connect("localhost","root","root","toy");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        echo "Database Connection Error";
    }
    $purchase_id = $_GET["purchase_id"];
    $quantity = 0;
    $user_id = $siteConfigurationObject->getUserId();
    $query = "select qty from purchased where purchase_id = $purchase_id";

    $result = $siteConfigurationObject->runSelectQuery($query);

    if($result["success"]){
        $row = mysqli_fetch_array($result["data"]);
        $quantity = $row["qty"];
    }

    if($quantity > 1)
        $sql = "UPDATE purchased SET qty=$quantity - 1 where purchase_id = $purchase_id";
    else
        $sql = "delete from purchased where purchase_id = $purchase_id";

    $conn->query($sql);
    $conn->close();
    header("Location: basket.php");
?>