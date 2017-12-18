<?php
	require_once("site_configuration.php");
	$searchValue = urlencode("$_POST[searchValue]");

    $siteConfigurationObject->gotoURL("category.php?search=$searchValue");
?>