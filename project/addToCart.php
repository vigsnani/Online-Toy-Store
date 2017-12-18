<?php
	require_once("site_configuration.php");
	$toy_id = $_GET["toyId"];
    $returnURL = $_GET["returnURL"];

    if(isset($_GET["qty"]))
    	$qty = $_GET["qty"];
    else
    	$qty = 1;
    //echo $returnURL;

	$user_id = $siteConfigurationObject->getUserId();

    $query = "SELECT * FROM Purchased WHERE toy_id = $toy_id AND user_id = $user_id AND status = 0";
    $result = $siteConfigurationObject->runSelectQuery($query);
    if($result["success"]){
	    if($result["rows"] > 0){
	        while($row = mysqli_fetch_array($result["data"])){
	        	$Quantity = $row["qty"];
	        	$Quantity += $qty;
	            $query = "UPDATE Purchased SET qty = $Quantity WHERE purchase_id = $row[purchase_id]";
	        }
	    }
	    else{
			$query="INSERT INTO Purchased(user_id, status, qty, toy_id) VALUES ($user_id, 0, $qty, $toy_id)";
	    }

	    if($siteConfigurationObject->isUserLoggedIn()){
		    if(!$siteConfigurationObject->initializeConnection()){
				$siteConfigurationObject->errorHandler("Database Login Failure.");
				//header("Location:accountDetails.php");
				//exit();
				return false;
		    }

	        if(!mysqli_query($siteConfigurationObject->connection, $query)){
				$siteConfigurationObject->dbErrorHandler("Failed to add item to cart.");
				$error_message = "Failed to add item to cart";
				//$returnURL .= "&error_message=$error_message";
				//header("Location:accountDetails.php");
				//exit();
				return false;
			}
			$cartCount = $siteConfigurationObject->getCartQuantity();
			$cartCount += $qty;
			$siteConfigurationObject->setCartQuantity($cartCount);

		}
	}
    $siteConfigurationObject->gotoURL($returnURL);
?>