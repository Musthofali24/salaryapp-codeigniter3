<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Penggajian</title>
    <!-- StyleSheets -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/landing/css/bootstrap/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/landing/css/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/landing/css/style.css" />
</head>

<body>
    <!-- Go to top Button -->
    <a href="#Home">
        <div class="Gototop">
            <i class="fa fa-angle-double-up text-white" aria-hidden="true"></i>
        </div>
    </a>
    <!-- Header Section -->
    <div class="Header" id="Home">
        <nav class="navbar fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#">AE SALARY</a>
                <div class="collapse_menu deactive">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                    <i class="fa fa-times" aria-hidden="true"></i>
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#Home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#Tentang">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#AboutMe">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('login'); ?>">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="banner">
            <div class="layer">
                <div class="row Section">
                    <div class="col">
                        <div class="box">
                            <div>
                                <h2>AE Salary</h2>
                            </div>
                            <p>aplikasi ini dibuat untuk membantu AE dalam mengatur proses penggajian para staff</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="Footer" id="Footer">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center my-3">
                    Copyright &copy; by Kelompok 1 PBO 2AEC
                </div>
            </div>
        </div>
    </div>
    <!-- Javascripts -->
    <script src="<?php echo base_url(); ?>assets/landing/js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>assets/landing/js/bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>assets/landing/js/script.js"></script>
</body>

</html>