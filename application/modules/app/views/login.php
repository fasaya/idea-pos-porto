<!DOCTYPE html>
<html class="fixed">

<head>

    <!-- Basic -->
    <meta charset="UTF-8">

    <meta name="keywords" content="HTML5 Admin Template" />
    <meta name="description" content="Idea POS">
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

    <!-- Theme CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>template/css/theme.css" />

    <!-- Skin CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>template/css/skins/default.css" />

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>template/css/custom.css">

    <!-- Head Libs -->
    <script src="<?= base_url() ?>template/vendor/modernizr/modernizr.js"></script>

</head>

<body>
    <!-- start: page -->
    <section class="body-sign" style="padding-top:15%">
        <div class="center-sign" style="vertical-align: baseline !important;">
            <a href="#" class="logo float-left">
                <img src="<?= base_url() ?>template/img/logo.png" height="54" alt="Idea POS" />
            </a>

            <div class="panel card-sign">
                <div class="card-title-sign mt-3 text-right">
                    <h2 class="title text-uppercase font-weight-bold m-0"><i class="fas fa-user mr-1"></i> Sign In</h2>
                </div>
                <div class="card-body">
                    <?= $this->session->flashdata('message') ?>
                    <form action="<?= base_url() ?>backoffice/backoffice" method="post">
                        <div class="form-group mb-3">
                            <label>Email</label>
                            <div class="input-group">
                                <input name="email" type="text" class="form-control" />
                                <span class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                </span>
                            </div>
                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <div class="form-group mb-3">
                            <div class="clearfix">
                                <label class="float-left">Password</label>
                                <a href="pages-recover-password.html" class="float-right">Forget Password?</a>
                            </div>
                            <div class="input-group">
                                <input name="password" type="password" class="form-control" />
                                <span class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                </span>
                            </div>
                            <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 text-right">
                                <button type="submit" class="btn btn-primary mt-2">Sign In</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

            <!-- <p class="text-center text-muted mt-3 mb-3">&copy; Copyright 2017. All Rights Reserved.</p> -->
        </div>
    </section>
    <!-- end: page -->

    <!-- Vendor -->
    <script src="<?= base_url() ?>template/vendor/jquery/jquery.js"></script>
    <script src="<?= base_url() ?>template/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
    <script src="<?= base_url() ?>template/vendor/popper/umd/popper.min.js"></script>
    <script src="<?= base_url() ?>template/vendor/bootstrap/js/bootstrap.js"></script>
    <script src="<?= base_url() ?>template/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="<?= base_url() ?>template/vendor/common/common.js"></script>
    <script src="<?= base_url() ?>template/vendor/nanoscroller/nanoscroller.js"></script>
    <script src="<?= base_url() ?>template/vendor/magnific-popup/jquery.magnific-popup.js"></script>
    <script src="<?= base_url() ?>template/vendor/jquery-placeholder/jquery.placeholder.js"></script>

    <!-- Theme Base, Components and Settings -->
    <script src="<?= base_url() ?>template/js/theme.js"></script>

    <!-- Theme Custom -->
    <script src="<?= base_url() ?>template/js/custom.js"></script>

    <!-- Theme Initialization Files -->
    <script src="<?= base_url() ?>template/js/theme.init.js"></script>

</body>

</html>