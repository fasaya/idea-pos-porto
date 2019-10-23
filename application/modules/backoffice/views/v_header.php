<!DOCTYPE html>
<html class="fixed">

<head>

	<!-- Basic -->
	<meta charset="UTF-8">

	<title><?= $title; ?> | IdeaPOS</title>
	<meta name="keywords" content="HTML5 Admin Template" />
	<meta name="description" content="Porto Admin - Responsive HTML5 Template">
	<meta name="author" content="okler.net">

	<!-- Mobile Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

	<!-- Web Fonts  -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

	<!-- Vendor CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>template/vendor/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" href="<?= base_url() ?>template/vendor/animate/animate.css">

	<link rel="stylesheet" href="<?= base_url() ?>template/vendor/font-awesome/css/all.min.css" />
	<link rel="stylesheet" href="<?= base_url() ?>template/vendor/magnific-popup/magnific-popup.css" />
	<link rel="stylesheet" href="<?= base_url() ?>template/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />

	<!-- Specific Page Vendor CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>template/vendor/jquery-ui/jquery-ui.css" />
	<link rel="stylesheet" href="<?= base_url() ?>template/vendor/jquery-ui/jquery-ui.theme.css" />
	<link rel="stylesheet" href="<?= base_url() ?>template/vendor/bootstrap-multiselect/css/bootstrap-multiselect.css" />
	<link rel="stylesheet" href="<?= base_url() ?>template/vendor/morris/morris.css" />
	<link rel="stylesheet" href="<?= base_url() ?>template/vendor/select2/css/select2.css" />
	<link rel="stylesheet" href="<?= base_url() ?>template/vendor/select2-bootstrap-theme/select2-bootstrap.min.css" />
	<link rel="stylesheet" href="<?= base_url() ?>template/vendor/datatables/media/css/dataTables.bootstrap4.css" />

	<!-- Theme CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>template/css/theme.css" />

	<!-- Skin CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>template/css/skins/default.css" />

	<!-- Theme Custom CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>template/css/custom.css">

	<!-- Head Libs -->
	<script src="<?= base_url() ?>template/vendor/modernizr/modernizr.js"></script>

	<!-- jquery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

</head>

<body>
	<section class="body">

		<!-- start: header -->
		<header class="header">
			<div class="logo-container">
				<a href="../2.2.0" class="logo">
					<img src="<?= base_url() ?>template/img/logo.png" width="75" height="35" alt="Porto Admin" />
				</a>
				<div class="d-md-none toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
					<i class="fas fa-bars" aria-label="Toggle sidebar"></i>
				</div>
			</div>

			<!-- start: search & user box -->
			<div class="header-right">

				<span class="separator"></span>

				<div id="userbox" class="userbox">
					<a href="#" data-toggle="dropdown">
						<figure class="profile-picture">
							<img src="<?= base_url() ?>template/img/!logged-user.jpg" alt="Joseph Doe" class="rounded-circle" data-lock-picture="<?= base_url() ?>template/img/!logged-user.jpg" />
						</figure>
						<div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
							<span class="name"><?= $email; ?></span>
							<span class="role"><?= $nav['name']; ?></span>
						</div>

						<i class="fa custom-caret"></i>
					</a>

					<div class="dropdown-menu">
						<ul class="list-unstyled mb-2">
							<li class="divider"></li>
							<li>
								<a role="menuitem" tabindex="-1" href="pages-user-profile.html"><i class="fas fa-user"></i> My Profile</a>
							</li>
							<li>
								<a role="menuitem" tabindex="-1" href="#" data-lock-screen="true"><i class="fas fa-lock"></i> Lock Screen</a>
							</li>
							<li>
								<a role="menuitem" tabindex="-1" href="<?= base_url() ?>backoffice/logout"><i class="fas fa-power-off"></i> Logout</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<!-- end: search & user box -->
		</header>
		<!-- end: header -->

		<div class="inner-wrapper">
			<!-- start: sidebar -->
			<aside id="sidebar-left" class="sidebar-left">

				<div class="sidebar-header">
					<div class="sidebar-title">
						Navigation
					</div>
					<div class="sidebar-toggle d-none d-md-block" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
						<i class="fas fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>

				<div class="nano">
					<div class="nano-content">
						<nav id="menu" class="nav-main" role="navigation">

							<ul class="nav nav-main">
								<li>
									<a class="nav-link" href="<?= base_url() ?>backoffice/dashboard">
										<i class="fas fa-home" aria-hidden="true"></i>
										<span>Dashboard</span>
									</a>
								</li>
								<li class="nav-parent">
									<a class="nav-link" href="#">
										<i class="fas fa-copy" aria-hidden="true"></i>
										<span>Reports</span>
									</a>
									<ul class="nav nav-children">
										<li class="">
											<a class="nav-link" href="index.html">
												Sales
											</a>
										</li>
										<li class="">
											<a class="nav-link" href="layouts-default.html">
												Transactions
											</a>
										</li>
										<li class="">
											<a class="nav-link" href="layouts-default.html">
												Invoice
											</a>
										</li>
										<li class="">
											<a class="nav-link" href="layouts-default.html">
												Shift
											</a>
										</li>
									</ul>
								</li>
								<li class="nav-parent">
									<a class="nav-link" href="#">
										<i class="fas fa-tasks" aria-hidden="true"></i>
										<span>Library</span>
									</a>
									<ul class="nav nav-children">
										<li>
											<a class="nav-link" href="<?= base_url() ?>backoffice/library/lists">
												Item Library
											</a>
										</li>
										<li>
											<a class="nav-link" href="<?= base_url() ?>backoffice/library/modifiers">
												Modifiers
											</a>
										</li>
										<li>
											<a class="nav-link" href="pages-recover-password.html">
												Categories
											</a>
										</li>
										<li>
											<a class="nav-link" href="pages-lock-screen.html">
												Promo
											</a>
										</li>
										<li>
											<a class="nav-link" href="pages-user-profile.html">
												Discount
											</a>
										</li>
										<li>
											<a class="nav-link" href="pages-session-timeout.html">
												Taxes
											</a>
										</li>
										<li>
											<a class="nav-link" href="pages-calendar.html">
												Gratuity
											</a>
										</li>
									</ul>
								</li>
								<li class="nav-parent">
									<a class="nav-link" href="#">
										<i class="fas fa-edit" aria-hidden="true"></i>
										<span>Inventory</span>
									</a>
									<ul class="nav nav-children">
										<li>
											<a class="nav-link" href="ui-elements-typography.html">
												Summary
											</a>
										</li>
										<li>
											<a class="nav-link" href="ui-elements-tabs.html">
												Supplier
											</a>
										</li>
										<li>
											<a class="nav-link" href="ui-elements-cards.html">
												Purchase Order
											</a>
										</li>
										<li>
											<a class="nav-link" href="ui-elements-widgets.html">
												Transfer
											</a>
										</li>
										<li>
											<a class="nav-link" href="ui-elements-portlets.html">
												Adjustments
											</a>
										</li>
									</ul>
								</li>
								<li class="nav-parent">
									<a class="nav-link" href="#">
										<i class="fas fa-id-card" aria-hidden="true"></i>
										<span>Customer</span>
									</a>
									<ul class="nav nav-children">
										<li>
											<a class="nav-link" href="forms-basic.html">
												Customer List
											</a>
										</li>
										<li>
											<a class="nav-link" href="forms-advanced.html">
												Feedback
											</a>
										</li>
										<li>
											<a class="nav-link" href="forms-validation.html">
												Loyalti Program
											</a>
										</li>
									</ul>
								</li>
								<li class="nav-parent">
									<a class="nav-link" href="#">
										<i class="fas fa-users" aria-hidden="true"></i>
										<span>Employee</span>
									</a>
									<ul class="nav nav-children">
										<li>
											<a class="nav-link" href="<?= base_url() ?>backoffice/employee/staff">
												Employee Slots
											</a>
										</li>
										<li>
											<a class="nav-link" href="<?= base_url() ?>backoffice/employee/access">
												Employee Access
											</a>
										</li>
										<li>
											<a class="nav-link" href="<?= base_url() ?>backoffice/employee/pin">
												PIN Access
											</a>
										</li>
									</ul>
								</li>
								<li class="nav-parent">
									<a class="nav-link" href="#">
										<i class="fas fa-lock" aria-hidden="true"></i>
										<span>Account Setting</span>
									</a>
									<ul class="nav nav-children">
										<li>
											<a class="nav-link" href="extra-changelog.html">
												Account
											</a>
										</li>
										<li>
											<a class="nav-link" href="<?= base_url() ?>backoffice/outlets">
												Outlet
											</a>
										</li>
										<li>
											<a class="nav-link" href="extra-ajax-made-easy.html">
												Public Profile
											</a>
										</li>
										<li>
											<a class="nav-link" href="extra-ajax-made-easy.html">
												Receipt
											</a>
										</li>
										<li>
											<a class="nav-link" href="extra-ajax-made-easy.html">
												Checkout
											</a>
										</li>
									</ul>
								</li>
							</ul>
						</nav>

						<hr class="separator" />

						<div class="sidebar-widget widget-stats">
							<div class="widget-header">
								<h6>Company Stats</h6>
								<div class="widget-toggle">+</div>
							</div>
							<div class="widget-content">
								<ul>
									<li>
										<span class="stats-title">Stat 1</span>
										<span class="stats-complete">85%</span>
										<div class="progress">
											<div class="progress-bar progress-bar-primary progress-without-number" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 85%;">
												<span class="sr-only">85% Complete</span>
											</div>
										</div>
									</li>
									<li>
										<span class="stats-title">Stat 2</span>
										<span class="stats-complete">70%</span>
										<div class="progress">
											<div class="progress-bar progress-bar-primary progress-without-number" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%;">
												<span class="sr-only">70% Complete</span>
											</div>
										</div>
									</li>
									<li>
										<span class="stats-title">Stat 3</span>
										<span class="stats-complete">2%</span>
										<div class="progress">
											<div class="progress-bar progress-bar-primary progress-without-number" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="width: 2%;">
												<span class="sr-only">2% Complete</span>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>

					<script>
						// Maintain Scroll Position
						if (typeof localStorage !== 'undefined') {
							if (localStorage.getItem('sidebar-left-position') !== null) {
								var initialPosition = localStorage.getItem('sidebar-left-position'),
									sidebarLeft = document.querySelector('#sidebar-left .nano-content');

								sidebarLeft.scrollTop = initialPosition;
							}
						}
					</script>


				</div>

			</aside>
			<!-- end: sidebar -->