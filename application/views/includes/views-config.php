<?php 

	

	$dashboard_uri 				= '';
	$products_uri 				= 'product';
	$po_uri 					= 'purchase-order';
	$add_new_product_uri 		= 'product/add';
	$new_po_uri 				= 'purchase-order/add';
	$reports_uri 				= 'report';
	$users_uri					= 'user';
	$login_uri					= 'login/validate_login';
	$logout_uri					= 'login/logout';
	$edit_product_uri			= 'product/edit';
	$delete_product_uri			= 'product/delete';
	$view_product_uri			= 'product/view';
	$view_po_uri 				= 'purchase-order/view';
	$new_user_uri 				= 'user/add';
	$edit_user_uri 				= 'user/edit';
	$user_profile_uri			= 'user/profile';
	$logout_uri					= 'login/logout';


	$dashboard 			= base_url($dashboard_uri);
	$products_page 		= base_url($products_uri);
	$po_page 			= base_url($po_uri);
	$add_new_product 	= base_url($add_new_product_uri);
	$new_po 			= base_url($new_po_uri);
	$reports 			= base_url($reports_uri);
	$users 				= base_url($users_uri);
	$login 				= base_url($login_uri);
	$logout 			= base_url($logout_uri);
	$edit_product 		= base_url($edit_product_uri);
	$delete_product 	= base_url($delete_product_uri);
	$view_product 		= base_url($view_product_uri);
	$view_po 			= base_url($view_po_uri);
	$new_user 			= base_url($new_user_uri);
	$edit_user 			= base_url($edit_user_uri);
	$user_profile 		= base_url($user_profile_uri);
	$logout 			= base_url($logout_uri);
	

	$current_url = current_url();


	$dashboard_active 			= $current_url == $dashboard?'active':'';
	$products_active 			= $current_url == $products_page?'active':'';
	$po_active 					= $current_url == $po_page?'active':'';
	$add_new_product_active 	= $current_url == $add_new_product?'active':'';
	$new_po_active 				= $current_url == $new_po?'active':'';
	$reports_active 			= $current_url == $reports?'active':'';
	$users_active	 			= $current_url == $users?'active':'';




	$user_id = $this->session->userdata('ilo_session_id');
	$username = $this->session->userdata('ilo_session_user');





?>