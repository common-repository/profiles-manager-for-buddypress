<?php

	/*******************************************************************************
	*																			   *
	*	Backend Functions. 														   *
	*	(C) Elbuntu 2014														   *
	*																			   *
	*******************************************************************************/

	global $wpdb;

	$groups = BP_XProfile_Group::get( array(
		'fetch_fields' => true
	));

	function init() {
		//Initial Plug-in Page.
		include("init.php");
	}

	function init_profiles() {
		//Initiate profile management page.
		include("profileManager.php");
	}

	function init_subscription() {
		//Initiate subscription management page
		include("subscriptionManager.php");
	}
	
?>


