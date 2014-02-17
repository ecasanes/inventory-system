<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<meta name="author" content="ThemeFuse">
<meta name="keywords" content="">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Inventory System | <?php echo $title; ?></title>

<?php include('header-styles.php'); ?>
<?php include('header-scripts.php'); ?>

</head>

<body>

<?php include('views-config.php'); ?>

<div class="body_wrap">
    <div class="container">

        <!-- content -->
        <div class="content " role="main">


            <!-- row -->
            <div class="row hidden-print">
                <div class="col-sm-12">
                    <!-- Website Menu -->
                    <div id="topmenu">
                        <ul class="dropdown clearfix boxed boxed-dark-blue hidden-print">
                            <li class="menu-level-0"><a class="<?php echo $dashboard_active; ?>" href="<?php echo $dashboard; ?>"><span>Dashboard</span></a></li>
                            <li class="menu-level-0"><a class="<?php echo $products_active; ?>" href="<?php echo $products_page; ?>"><span>Products</span></a>
                                <ul class="submenu-1">
                                    <li class="menu-level-1"><a class="<?php echo $add_new_product_active; ?>" href="<?php echo $add_new_product; ?>">Add New Product!</a></li>
                                    <!--
                                    <li class="menu-level-1"><a href="#">Add Stocks(to full view to be removed!)</a></li>
                                    <li class="menu-level-1"><a href="advanced-search.php">Advanced Search</a></li>
                                    -->
                                </ul>
                            </li>
                            <li class="menu-level-0"><a class="<?php echo $po_active; ?>" href="<?php echo $po_page; ?>"><span>Purchase Order</span></a>
                                <ul class="submenu-1">
                                    <li class="menu-level-1"><a class="<?php echo $new_po_active; ?>" href="<?php echo $new_po; ?>">New Purchase Order!</a></li>
                                </ul>
                            </li>
                            
                            <li class="menu-level-0"><a class="<?php echo $reports_active; ?>" href="<?php echo $users; ?>"><span>Users</span></a>
                                <ul class="submenu-1">
                                    <li class="menu-level-1"><a class="<?php echo $new_po_active; ?>" href="<?php echo $new_user; ?>">New User!</a></li>
                                </ul>
                            </li>

                            <li class="menu-level-0"><a class="<?php echo $reports_active; ?>" href="<?php echo $reports; ?>"><span>Reports</span></a>
                                <ul class="submenu-1">
                                    <li class="menu-level-1"><a class="<?php echo $new_po_active; ?>" href="<?php echo $out_of_stock_items; ?>">Out of Stock Items</a></li>
                                    <li class="menu-level-1"><a class="<?php echo $new_po_active; ?>" href="<?php echo $sales; ?>">Sales</a></li>
                                    <!--<li class="menu-level-1"><a class="<?php echo $new_po_active; ?>" href="<?php echo $in_demand_items; ?>">In Demand Items</a></li>
                                    <li class="menu-level-1"><a class="<?php echo $new_po_active; ?>" href="<?php echo $sales_chart; ?>">Sales Chart</a></li>-->
                                </ul>
                            </li>


                            <li class="menu-level-0 pull-right"><a class="<?php echo $reports_active; ?>" href="<?php echo $logout; ?>"><span>Logout</span></a>
                            </li>
                            <li class="menu-level-0 pull-right"><a class="<?php echo $reports_active; ?>" href="<?php echo $user_profile; ?>"><span>Welcome <?php echo $username; ?></span></a>
                            </li>
                        </ul>
                    </div>
                    <!--/ Website Menu -->
                </div>
            </div>
            <!--/ row -->

            <div class="row hidden-print">
                <div class="col-sm-12">
                    <h1 class="title"><?php echo $title; ?></h1>
                </div>
            </div>