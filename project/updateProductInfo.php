<?php
	require_once("site_configuration.php");
	
	$toyid = $_POST["toyid"];
	$toyname = $_POST["toyname"];
	$available = $_POST["available"];
	$description = $_POST["description"];
	$price = $_POST["price"];
	$status = 1;

	if($available == "0")
		$status = 0;

	if($toyid == "new")
		$returnURL = "addNewProduct.php";
	else
		$returnURL = "detail.php?toyId=$toyid";

	$target_dir = "img/products/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$imageName = basename($_FILES["fileToUpload"]["name"]);
	$error_code = $_FILES["fileToUpload"]["error"];
	$uploadOk = 0;

	if($error_code == 0 || (isset($imageName) && !empty($imageName))){

		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if(isset($_POST["submitForm"])) {
		    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		    if($check !== false) {
		        echo "File is an image - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } else {
		        echo "File is not an image.";
		        $uploadOk = 0;
		    }
		}
		// Check if file already exists
		if (file_exists($target_file)) {
		    echo "Sorry, file already exists.";
		    $uploadOk = 0;
		}
		// Check file size 
		if ($_FILES["fileToUpload"]["size"] > 500000) {
		    echo "Sorry, your file is too large.";
		    $uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		    $uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
		    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		    } else {
		        echo "Sorry, there was an error uploading your file.";
		    }
		}
	}

    if($siteConfigurationObject->isUserLoggedIn()){
	    if(!$siteConfigurationObject->initializeConnection()){
			$siteConfigurationObject->errorHandler("Database Login Failure.");
			//header("Location:accountDetails.php");
			//exit();
    		$siteConfigurationObject->gotoURL($returnURL);
	    }

		$user_id = $siteConfigurationObject->getUserId();

		if($uploadOk == 1){
	    	if($toyid == "new")
				$query="INSERT INTO TOY (toy_name, description, total_available, price, image, status) 
						VALUES('$toyname', '$description', $available, $price, '$imageName', $status)";
			else
				$query="UPDATE TOY SET toy_name='$toyname', description='$description', total_available=$available, price=$price, image='$imageName', status=$status WHERE toy_id=$toyid";
	    }else{
	    	if($toyid == "new")
				$query="INSERT INTO TOY (toy_name, description, total_available, price, status) 
						VALUES('$toyname', '$description', $available, $price, $status)";
			else
				$query="UPDATE TOY SET toy_name='$toyname', description='$description', total_available=$available, price=$price, status=$status WHERE toy_id=$toyid";
	    }	    	
	    //echo $query;
        if(!mysqli_query($siteConfigurationObject->connection, $query)){
			$siteConfigurationObject->dbErrorHandler("Failed to update product details.");
    		$siteConfigurationObject->gotoURL($returnURL);
		}
				
		if($toyid == "new"){
			$query = "SELECT MAX(toy_id) AS maxId FROM TOY";
			$result = mysqli_query($siteConfigurationObject->connection, $query);
			$result = mysqli_fetch_array($result);
			$toyid = $result["maxId"];
		}

		if($toyid != "new"){
			$query = "DELETE FROM CATEGORY_REF_TABLE WHERE Toy_Id = $toyid";
			mysqli_query($siteConfigurationObject->connection, $query);
	    }

	    foreach ($_POST["category"] as $value) {
			$query="INSERT INTO CATEGORY_REF_TABLE (category_id, toy_id) VALUES('$value', '$toyid')";
			mysqli_query($siteConfigurationObject->connection, $query);
		}

	}
	$returnURL = "/detail.php?toyId=$toyid";

    $siteConfigurationObject->gotoURL($returnURL);
    
?>