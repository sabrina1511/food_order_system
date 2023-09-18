<?php
	ob_start();
	$action = $_GET['action'];
	include 'admin_class.php';

	$crud = new Action();

	/* Login Action - Calling Login Function */
	if($action == 'login'){
		$login = $crud->login();
		if($login)
			echo $login;
	}

	/* Logout Action - Calling Logout Function */
	if($action == 'logout'){
		$logout = $crud->logout();
		if($logout)
			echo $logout;
	}

	/* Saving User Action - Calling Save User Function */
	if($action == 'save_user'){
		$save = $crud->save_user();
		if($save)
			echo $save;
	}

	/* Deleting User Action - Calling Delete User Function */
	if($action == 'delete_user'){
		$save = $crud->delete_user();
		if($save)
			echo $save;
	}
	/* Updating Account Action - Calling Update Account Function */
	if($action == 'update_account'){
		$save = $crud->update_account();
		if($save)
			echo $save;
	}

	/* Saving Category Action - Calling Save Category Function */
	if($action == "save_category"){
		$save = $crud->save_category();
		if($save)
			echo $save;
	}

	/* Deleting Category Action - Calling Delete Category Function */
	if($action == "delete_category"){
		$delete = $crud->delete_category();
		if($delete)
			echo $delete;
	}

	/* Saving Food Item Action - Calling Save Food Item Function */
	if($action == "save_food"){
		$save = $crud->save_food();
		if($save)
			echo $save;
	}

	/* Deleting Food Item Action - Calling Delete Food Item Function */
	if($action == "delete_food"){
		$delete = $crud->delete_food();
		if($delete)
			echo $delete;
	}

	/* Saving Order Action - Calling Save Order Function */
	if($action == "save_order"){
		$save = $crud->save_order();
		if($save)
			echo $save;
	}

	/* Deleting Order Action - Calling Delete Order Function */
	if($action == "delete_order"){
		$delete = $crud->delete_order();
		if($delete)
			echo $delete;
	}
	ob_end_flush();
?>
