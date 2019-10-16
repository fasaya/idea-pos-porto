<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<title><?= $title; ?> | IdeaPOS</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
	<meta content="Coderthemes" name="author" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<link rel="shortcut icon" href="<?= base_url() ?>template/assets/images/favicon.ico">

	<!--Morris Chart CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>template/assets/plugins/morris/morris.css">

	<!-- DataTables -->
	<link href="<?= base_url() ?>template/assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url() ?>template/assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url() ?>template/assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url() ?>template/assets/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url() ?>template/assets/plugins/datatables/dataTables.colVis.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url() ?>template/assets/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url() ?>template/assets/plugins/datatables/fixedColumns.dataTables.min.css" rel="stylesheet" type="text/css" />

	<!-- Bootstrap core CSS -->
	<link href="<?= base_url() ?>template/assets/css/bootstrap.min.css" rel="stylesheet">
	<!-- MetisMenu CSS -->
	<link href="<?= base_url() ?>template/assets/css/metisMenu.min.css" rel="stylesheet">
	<!-- Icons CSS -->
	<link href="<?= base_url() ?>template/assets/css/icons.css" rel="stylesheet">
	<!-- Custom styles for this template -->
	<link href="<?= base_url() ?>template/assets/css/style.css" rel="stylesheet">
	<!-- jquery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

</head>


<body>

	<div id="page-wrapper">

		<!-- Top Bar Start -->
		<div class="topbar">

			<!-- LOGO -->
			<div class="topbar-left">
				<div class="">
					<a href="<?= base_url() ?>dashboard" class="logo">
						<img src="<?= base_url() ?>template/assets/images/logo.png" alt="logo" class="logo-lg" />
						<img src="<?= base_url() ?>template/assets/images/logo_sm.png" alt="logo" class="logo-sm hidden" />
					</a>
				</div>
			</div>

			<!-- Top navbar -->
			<div class="navbar navbar-default" role="navigation">
				<div class="container">
					<div class="">

						<!-- Mobile menu button -->
						<div class="pull-left">
							<button type="button" class="button-menu-mobile visible-xs visible-sm">
								<i class="fa fa-bars"></i>
							</button>
							<span class="clearfix"></span>
						</div>

						<!-- Top nav left menu -->
						<!-- <ul class="nav navbar-nav hidden-sm hidden-xs top-navbar-items">
								<li><a href="#">About</a></li>
								<li><a href="#">Help</a></li>
								<li><a href="#">Contact</a></li>
							</ul> -->

						<!-- Top nav Right menu -->
						<ul class="nav navbar-nav navbar-right top-navbar-items-right pull-right">
							<li class="dropdown top-menu-item-xs">
								<a href="#" data-target="#" class="dropdown-toggle menu-right-item" data-toggle="dropdown" aria-expanded="true">
									<i class="mdi mdi-bell"></i> <span class="label label-danger">3</span>
								</a>
								<ul class="dropdown-menu p-0 dropdown-menu-lg">
									<!--<li class="notifi-title"><span class="label label-default pull-right">New 3</span>Notification</li>-->
									<li class="list-group notification-list" style="height: 267px;">
										<div class="slimscroll">
											<!-- list item-->
											<a href="javascript:void(0);" class="list-group-item">
												<div class="media">
													<div class="media-left p-r-10">
														<em class="fa fa-diamond bg-primary"></em>
													</div>
													<div class="media-body">
														<h5 class="media-heading">A new order has been placed A new order has been placed</h5>
														<p class="m-0">
															<small>There are new settings available</small>
														</p>
													</div>
												</div>
											</a>

											<!-- list item-->
											<a href="javascript:void(0);" class="list-group-item">
												<div class="media">
													<div class="media-left p-r-10">
														<em class="fa fa-cog bg-warning"></em>
													</div>
													<div class="media-body">
														<h5 class="media-heading">New settings</h5>
														<p class="m-0">
															<small>There are new settings available</small>
														</p>
													</div>
												</div>
											</a>

											<!-- list item-->
											<a href="javascript:void(0);" class="list-group-item">
												<div class="media">
													<div class="media-left p-r-10">
														<em class="fa fa-bell-o bg-custom"></em>
													</div>
													<div class="media-body">
														<h5 class="media-heading">Updates</h5>
														<p class="m-0">
															<small>There are <span class="text-primary font-600">2</span> new updates available</small>
														</p>
													</div>
												</div>
											</a>

											<!-- list item-->
											<a href="javascript:void(0);" class="list-group-item">
												<div class="media">
													<div class="media-left p-r-10">
														<em class="fa fa-user-plus bg-danger"></em>
													</div>
													<div class="media-body">
														<h5 class="media-heading">New user registered</h5>
														<p class="m-0">
															<small>You have 10 unread messages</small>
														</p>
													</div>
												</div>
											</a>

											<!-- list item-->
											<a href="javascript:void(0);" class="list-group-item">
												<div class="media">
													<div class="media-left p-r-10">
														<em class="fa fa-diamond bg-primary"></em>
													</div>
													<div class="media-body">
														<h5 class="media-heading">A new order has been placed A new order has been placed</h5>
														<p class="m-0">
															<small>There are new settings available</small>
														</p>
													</div>
												</div>
											</a>

											<!-- list item-->
											<a href="javascript:void(0);" class="list-group-item">
												<div class="media">
													<div class="media-left p-r-10">
														<em class="fa fa-cog bg-warning"></em>
													</div>
													<div class="media-body">
														<h5 class="media-heading">New settings</h5>
														<p class="m-0">
															<small>There are new settings available</small>
														</p>
													</div>
												</div>
											</a>
										</div>
									</li>
									<!--<li>-->
									<!--<a href="javascript:void(0);" class="list-group-item text-right">-->
									<!--<small class="font-600">See all notifications</small>-->
									<!--</a>-->
									<!--</li>-->
								</ul>
							</li>

							<li class="dropdown top-menu-item-xs">
								<a href="" class="dropdown-toggle menu-right-item profile" data-toggle="dropdown" aria-expanded="true"><img src="<?= base_url() ?>template/assets/images/users/avatar-0.png" alt="user-img" class="img-circle"> </a>
								<ul class="dropdown-menu">
									<li><a href="#"><?= $email; ?></a></li>
									<li class="divider"></li>
									<li><a href="javascript:void(0)"><i class="ti-user m-r-10"></i> Profile</a></li>
									<li><a href="javascript:void(0)"><i class="ti-settings m-r-10"></i> Settings</a></li>
									<li class="divider"></li>
									<li><a href="<?= base_url() ?>auth/logout"><i class="ti-power-off m-r-10"></i> Logout</a></li>
								</ul>
							</li>
						</ul>
					</div>
				</div> <!-- end container -->
			</div> <!-- end navbar -->
		</div>
		<!-- Top Bar End -->


		<!-- Page content start -->
		<div class="page-contentbar">

			<!--left navigation start-->
			<aside class="sidebar-navigation">
				<div class="scrollbar-wrapper">
					<div>
						<button type="button" class="button-menu-mobile btn-mobile-view visible-xs visible-sm">
							<i class="mdi mdi-close"></i>
						</button>
						<!-- User Detail box -->
						<div class="user-details">
							<div class="pull-left">
								<img src="<?= base_url() ?>template/assets/images/users/avatar-0.png" alt="" class="thumb-md img-circle">
							</div>
							<div class="user-info">
								<a href="#"><?= $email; ?></a>
								<p class="text-muted m-0"><?= $nav['name']; ?></p>
							</div>
						</div>
						<!--- End User Detail box -->

						<!-- Left Menu Start -->
						<ul class="metisMenu nav" id="side-menu">
							<?php if ($nav['b_dashboard'] == '1') { ?>
								<li><a href="<?= base_url() ?>dashboard"><i class="ti-home"></i> Dashboard </a></li>
							<?php } ?>

							<?php if ($nav['b_reports'] == '1') { ?>
								<li>
									<a href="javascript: void(0);" aria-expanded="true"><i class="ti-files"></i> Reports <span class="fa arrow"></span></a>
									<ul class="nav-second-level nav" aria-expanded="true">
										<li><a href="<?= base_url() ?>reports/sales">Sales</a></li>
										<li><a href="#">Transaction</a></li>
										<li><a href="#">Invoice</a></li>
										<li><a href="#">Shift</a></li>
									</ul>
								</li>
							<?php } ?>

							<li>
								<a href="javascript: void(0);" aria-expanded="true"><i class="ti-menu-alt"></i> Library <span class="fa arrow"></span></a>
								<ul class="nav-second-level nav" aria-expanded="true">
									<li><a href="#">Item Library</a></li>
									<li><a href="#">Modifiers</a></li>
									<li><a href="#">Categories</a></li>
									<li><a href="#">Promo</a></li>
									<li><a href="#">Discount</a></li>
									<li><a href="#">Taxes</a></li>
									<li><a href="#">Gratuity</a></li>
								</ul>
							</li>

							<li>
								<a href="javascript: void(0);" Inventory-expanded="true"><i class="ti-pencil-alt"></i> Inventory <span class="fa arrow"></span></a>
								<ul class="nav-second-level nav" aria-expanded="true">
									<li><a href="#">Summary</a></li>
									<li><a href="#">Supplier</a></li>
									<li><a href="#">Purchase Order</a></li>
									<li><a href="#">Transfer</a></li>
									<li><a href="#">Adjustment</a></li>
								</ul>
							</li>

							<li>
								<a href="javascript: void(0);" aria-expanded="true"><i class="ti-id-badge"></i> Customer <span class="fa arrow"></span></a>
								<ul class="nav-second-level nav" aria-expanded="true">
									<li><a href="#">Customer List</a></li>
									<li><a href="#">Feedback</a></li>
									<li><a href="#">Loyalti Program</a></li>
								</ul>
							</li>

							<li>
								<a href="javascript: void(0);" aria-expanded="true"><i class="ti-user"></i> Employee <span class="fa arrow"></span></a>
								<ul class="nav-second-level nav" aria-expanded="true">
									<li><a href="<?= base_url() ?>employee/staff">Employee Slots</a></li>
									<li><a href="<?= base_url() ?>employee/access">Employee Access</a></li>
									<li><a href="<?= base_url() ?>employee/pin">PIN Access</a></li>
								</ul>
							</li>

							<li>
								<a href="javascript: void(0);" aria-expanded="true"><i class="ti-lock"></i> Account Setting <span class="fa arrow"></span></a>
								<ul class="nav-second-level nav" aria-expanded="true">
									<li><a href="#">Account</a></li>
									<li><a href="<?= base_url() ?>outlets">Outlet</a></li>
									<li><a href="#">Public Profile</a></li>
									<li><a href="#">Receipt</a></li>
									<li><a href="#">Checkout</a></li>
								</ul>
							</li>

						</ul>
					</div>
				</div>
				<!--Scrollbar wrapper-->
			</aside>
			<!--left navigation end-->

			<!-- START PAGE CONTENT -->