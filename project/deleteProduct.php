<?php
	require_once("site_configuration.php");
	$toy_id = $_GET["toyId"];
    $returnURL = $_GET["returnURL"];
    $status = $_GET["status"];


    if($siteConfigurationObject->isUserLoggedIn()){
	    if(!$siteConfigurationObject->initializeConnection()){
			$siteConfigurationObject->errorHandler("Database Login Failure.");
			return false;
	    }

		$user_id = $siteConfigurationObject->getUserId();
	    
		$query="UPDATE toy SET status=$status where toy_id = $toy_id ";

        if(!mysqli_query($siteConfigurationObject->connection, $query)){
			$siteConfigurationObject->dbErrorHandler("Failed to add item to cart.");
			$error_message = "Failed to add item to cart";
			//$returnURL .= "&error_message=$error_message";
			//header("Location:accountDetails.php");
			//exit();
			return false;
		}

	}

    $siteConfigurationObject->gotoURL($returnURL);
?>