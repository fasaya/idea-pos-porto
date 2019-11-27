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
									<a class="nav-link" href="<?= base_url() ?>app/home">
										<i class="fas fa-home" aria-hidden="true"></i>
										<span>Point Of Sale</span>
									</a>
								</li>
								<li>
									<a class="nav-link" href="<?= base_url() ?>app/activity">
										<i class="fas fa-scroll" aria-hidden="true"></i>
										<span>Activity</span>
									</a>
								</li>
								<li>
									<a class="nav-link" href="<?= base_url() ?>app/inventory">
										<i class="fas fa-edit" aria-hidden="true"></i>
										<span>Inventory</span>
									</a>
								</li>
								<li>
									<a class="nav-link" href="<?= base_url() ?>app/shift">
										<i class="fas fa-users" aria-hidden="true"></i>
										<span>Shift</span>
									</a>
								</li>
								<li>
									<a class="nav-link" href="<?= base_url() ?>app/settings">
										<i class="fas fa-cogs" aria-hidden="true"></i>
										<span>Settings</span>
									</a>
								</li>
							</ul>
						</nav>

						<hr class="separator" />

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