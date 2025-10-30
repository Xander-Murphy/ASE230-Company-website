
<?php
    require_once __DIR__ . '/../lib/jsonReader.php';
    require_once __DIR__ . '/../lib/CSVreader.php';

    //team stuff
    $teamFile = '../data/team.json';
    $totalMembers = 0;
    if (file_exists($teamFile)) {
        $jsonData = file_get_contents($teamFile);
        $teamData = json_decode($jsonData, true);
        $totalMembers = count($teamData);
    }

    $membersPerRow = 4;

    //product stuff
    $products = '../data/products.json';
    $total_products = 0;
    if (file_exists($products)) {
        $jsonData = file_get_contents($products);
        $productData = json_decode($jsonData, true);
        $total_products = count($productData);
    }

    $productsPerRow = 4;
?>

<?php
include("../lib/plaintextReader.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Qexal - Responsive Bootstrap 5 Landing Page Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Premium Bootstrap 5 Landing Page Template" />
        <meta name="keywords" content="bootstrap 5, premium, marketing, multipurpose" />
        <meta content="Themesbrand" name="author" />
        <!-- favicon -->
        <link rel="shortcut icon" href="images/favicon.ico" />

        <!-- css -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="css/materialdesignicons.min.css" rel="stylesheet" type="text/css" />
        <link href="css/style.min.css" rel="stylesheet" type="text/css" />
    </head>

    <body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-offset="20">
        <!-- Loader -->
        <div id="preloader">
            <div id="status">
                <div class="spinner">
                    <div class="bounce1"></div>
                    <div class="bounce2"></div>
                    <div class="bounce3"></div>
                  </div>
            </div>
        </div>

        <!--Navbar Start-->
        <nav class="navbar navbar-expand-lg navbar-light navbar-custom fixed-top" id="navbar">
            <div class="container">
                <!-- LOGO -->
                <a class="navbar-brand logo" href="index-1.html">
                    <img src="images/logo-dark.png" alt="" class="logo-dark" height="28" />
                    <img src="images/logo-light.png" alt="" class="logo-light" height="28" />
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav ms-auto navbar-center" id="navbar-navlist">
                        <li class="nav-item">
                            <a href="#home" class="nav-link active">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="#services" class="nav-link">Awards</a>
                        </li>

                        <li class="nav-item">
                            <a href="#pricing" class="nav-link">Pricing</a>
                        </li>
                        <li class="nav-item">
                            <a href="#team" class="nav-link">Team</a>
                        </li>
                        <li class="nav-item">
                            <a href="#contact" class="nav-link">Contact Us</a>
                        </li>
                    </ul>
                    <a href="" class="btn btn-sm rounded-pill nav-btn ms-lg-3">Buy Now</a>
                </div>
            </div>
            <!-- end container -->
        </nav>
        <!-- Navbar End -->

        <!-- Hero Start -->
        <section class="hero-3 bg-center position-relative" style="background-image: url(images/hero-3-bg.png);" id="home">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="text-center">
                            <!--<span class="badge badge-soft-primary mb-4">Professional Landing</span>-->
                            <h1 class="font-weight-semibold mb-4 hero-3-title">Company Overview</h1>
                            <p class="mb-5 text-muted subtitle w-100 mx-auto"><?php echo readPlainText("../data/overview.txt"); ?></p>
                            
                            <div>
                                <!--<button type="button" class="btn btn-primary rounded-pill me-2">Sign up for free</button>-->
                                <!--<button type="button" class="btn btn-light rounded-pill me-2" data-bs-toggle="modal" data-bs-target="#watchvideomodal">Play video <i class="ms-1 icon-sm align-middle" data-feather="play-circle"></i></button>-->
                            </div>

                            <!-- Modal -->
                            <div class="modal fade bd-example-modal-lg" id="watchvideomodal" data-keyboard="false" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog modal-lg">
                                    <div class="modal-content hero-modal-0 bg-transparent">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        <video id="VisaChipCardVideo" class="w-100" controls="">
                                            <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4">
                                            <!--Browser does not support <video> tag -->
                                        </video>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col -->
                </div><!-- end row -->
            </div>
        </section>
        <!-- Hero End -->

        <!-- Services start -->
        <section class="section" id="services">
            <div class="container">
                <div class="row justify-content-center mb-5">
                    <div class="col-lg-7 text-center">
                        <h2 class="fw-bold">Our Awards</h2>
                        <!--<p class="text-muted"></p>-->
                    </div>
                </div>
                <!-- end row -->
                <div class="row">
                    <div class="col-lg-4">
                        <div class="service-box text-center px-4 py-5 position-relative mb-4">
                            <div class="service-box-content p-4">
                                <div class="icon-mono service-icon avatar-md mx-auto mb-4">
                                    <i class="" data-feather="box"></i>
                                </div>
                                <h4 class="mb-3 font-size-22"><?php echo readCSV('../data/awards.csv', 1, 1); ?></h4>
                                <p class="text-muted mb-0"><?php echo readCSV('../data/awards.csv', 2, 1) . ", " . readCSV('../data/awards.csv', 0, 1); ?></p>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->

                    <div class="col-lg-4">
                        <div class="service-box text-center px-4 py-5 position-relative mb-4">
                            <div class="service-box-content p-4">
                                <div class="icon-mono service-icon avatar-md mx-auto mb-4">
                                    <i class="" data-feather="layers"></i>
                                </div>
                                <h4 class="mb-3 font-size-22"><?php echo readCSV('../data/awards.csv', 1, 2); ?></h4>
                                <p class="text-muted mb-0"><?php echo readCSV('../data/awards.csv', 2, 2) . ", " . readCSV('../data/awards.csv', 0, 2); ?></p>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->

                    <div class="col-lg-4">
                        <div class="service-box text-center px-4 py-5 position-relative mb-4">
                            <div class="service-box-content p-4">
                                <div class="icon-mono service-icon avatar-md mx-auto mb-4">
                                    <i class="" data-feather="server"></i>
                                </div>
                                <h4 class="mb-3 font-size-22"><?php echo readCSV('../data/awards.csv', 1, 3); ?></h4>
                                <p class="text-muted mb-0"><?php echo readCSV('../data/awards.csv', 2, 3) . ", " . readCSV('../data/awards.csv', 0, 3); ?></p>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->

                    <div class="col-lg-4">
                        <div class="service-box text-center px-4 py-5 position-relative mb-4">
                            <div class="service-box-content p-4">
                                <div class="icon-mono service-icon avatar-md mx-auto mb-4">
                                    <i class="" data-feather="box"></i>
                                </div>
                                <h4 class="mb-3 font-size-22"><?php echo readCSV('../data/awards.csv', 1, 4); ?></h4>
                                <p class="text-muted mb-0"><?php echo readCSV('../data/awards.csv', 2, 4) . ", " . readCSV('../data/awards.csv', 0, 4); ?></p>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->

                    <div class="col-lg-4">
                        <div class="service-box text-center px-4 py-5 position-relative mb-4">
                            <div class="service-box-content p-4">
                                <div class="icon-mono service-icon avatar-md mx-auto mb-4">
                                    <i class="" data-feather="layers"></i>
                                </div>
                                <h4 class="mb-3 font-size-22"><?php echo readCSV('../data/awards.csv', 1, 5); ?></h4>
                                <p class="text-muted mb-0"><?php echo readCSV('../data/awards.csv', 2, 5) . ", " . readCSV('../data/awards.csv', 0, 5); ?></p>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->

                    <div class="col-lg-4">
                        <div class="service-box text-center px-4 py-5 position-relative mb-4">
                            <div class="service-box-content p-4">
                                <div class="icon-mono service-icon avatar-md mx-auto mb-4">
                                    <i class="" data-feather="server"></i>
                                </div>
                                <h4 class="mb-3 font-size-22"><?php echo readCSV('../data/awards.csv', 1, 6); ?></h4>
                                <p class="text-muted mb-0"><?php echo readCSV('../data/awards.csv', 2, 6) . ", " . readCSV('../data/awards.csv', 0, 6); ?></p>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->

        </section>
        <!-- Services end -->

        <!-- Features start -->
        <!-- Features end -->

        <!-- Cta end -->

        <!-- Pricing start -->
        <section class="section" id="pricing">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-7 text-center">
                <h2 class="fw-bold">Pricing</h2>
            </div>
        </div>

        <?php
        if (file_exists($products)) {
            $jsonData = file_get_contents($products);
            $productData = json_decode($jsonData, true);
            $total_products = count($productData);
        }

        for ($i = 0; $i < $total_products; $i++) {
            if ($i % $productsPerRow === 0) {
                echo '<div class="row">';
            }
        ?>
            <div class="col-lg-3 d-flex">
                <div class="card plan-card mt-4 rounded text-center border-0 shadow overflow-hidden">
                    <div class="card-body px-4 py-5">
                        <div class="icon-mono avatar-md bg-soft-primary rounded mx-auto mb-5 p-3">
                            <img src="images/pricing/3" alt="" class="img-fluid d-block mx-auto" />
                        </div>
                        <h4 class="text-uppercase mb-4 pb-1">
                            <?php echo echoFieldFromTeams($products, $i, 'name') ?>
                        </h4>
                        <p class="text-muted">
                            <?php echo echoFieldFromTeams($products, $i, 'description'); ?>
                        </p>
                        <ul class="text-start text-muted mb-4 pb-1">
                            <li><?php echo echoApplicationFromProducts($products, $i, 0)?></li>
                            <li><?php echo echoApplicationFromProducts($products, $i, 1)?></li>
                            <li><?php echo echoApplicationFromProducts($products, $i, 2)?></li>
                        </ul>
                        <p class="text-muted font-size-14 mb-1">All Extension Included</p>
                        <p class="font-size-16 font-weight-semibold mb-4 price-tag">$39.99 / Month</p>
                        <a href="javascript:void(0);" class="btn btn-soft-primary">Buy Now</a>
                    </div>
                </div>
            </div>
        <?php
            if (($i % $productsPerRow === $productsPerRow - 1) || $i === $total_products - 1) {
                echo '</div>';
            }
        }
        ?>
    </div>
</section>
        <!-- Pricing end -->

        <!-- Team start -->
        <section class="section bg-light" id="team">
            <div class="container">
                <div class="row justify-content-center mb-4">
                    <div class="col-lg-7 text-center">
                        <h2 class="fw-bold">Our Team Members</h2>
                    </div>
                </div>
                <?php 
                    for ($i = 0; $i < $totalMembers; $i++) {
                        if ($i % $membersPerRow === 0) {
                            echo '<div class="row">';
                        }
                ?>
                <div class="col-lg-3 col-sm-6">
                <div class="team-box mt-4 position-relative overflow-hidden rounded text-center shadow">
                    <div class="position-relative overflow-hidden">
                        <img src="images/team/default.png" alt="Team Member" class="img-fluid d-block mx-auto" />
                        <ul class="list-inline p-3 mb-0 team-social-item">
                            <li class="list-inline-item mx-3">
                                <a href="javascript: void(0);" class="team-social-icon h-primary"><i class="icon-sm" data-feather="facebook"></i></a>
                            </li>
                            <li class="list-inline-item mx-3">
                                <a href="javascript: void(0);" class="team-social-icon h-info"><i class="icon-sm" data-feather="twitter"></i></a>
                            </li>
                            <li class="list-inline-item mx-3">
                                <a href="javascript: void(0);" class="team-social-icon h-danger"><i class="icon-sm" data-feather="instagram"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="p-4">
                        <h5 class="font-size-19 mb-1"><?php echoFieldFromTeams($teamFile, $i, 'name'); ?></h5>
                        <p class="text-muted text-uppercase font-size-14 mb-0"><?php echoFieldFromTeams($teamFile, $i, 'title'); ?></p>
                    </div>
                </div>
            </div>
        <?php
            if (($i % $membersPerRow === $membersPerRow - 1) || $i === $totalMembers - 1) {
                echo '</div>';
            }
        }
        ?>
    </div>
</section>
        <!-- Team end -->

        <!-- Blog start -->
        <!-- Blog end -->

        <!-- CTA start -->
        <section class="section bg-center w-100 bg-light" style="background-image: url(images/cta-bg.png);">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card bg-gradient-primary text-center border-0">
                            <div class="bg-overlay-img" style="background-image: url(images/demos.png);"></div>
                            <div class="card-body mx-auto p-sm-5 p-4">
                                <div class="row justify-content-center">
                                    <div class="col-lg-10">
                                        <div class="p-3">
                                            <h2 class="text-white mb-4">Join our Growing Community</h2>
                                            <p class="text-white-70 font-size-16 mb-4 pb-3">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                            <a href="javascript: void(0);" class="btn btn-light rounded-pill">Sign Up for free</a>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                </div>
                                <!-- end row -->
                            </div>
                            <!-- end cardbody -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </section>
        <!-- CTA end -->

        <!-- Contact us start -->
        <section class="section" id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <h2 class="fw-bold mb-4">Get in Touch</h2>
                        <p class="text-muted mb-5">Et harum quidem rerum facilis est expedita distinctio temporecum soluta nobis est eligendi optio cumque nihil impedit quo minus maxime.</p>
                       
                        <div>
                            <form method="post" name="myForm" onsubmit="return validateForm()">
                                <p id="error-msg"></p>
                                <div id="simple-msg"></div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="name" class="text-muted form-label">Name</label>
                                            <input name="name" id="name" type="text" class="form-control" placeholder="Enter name*" >
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="email" class="text-muted form-label">Email</label>
                                            <input name="email" id="email" type="email" class="form-control" placeholder="Enter email*">
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-12">
                                        <div class="mb-4">
                                            <label for="subject" class="text-muted form-label">Subject</label>
                                            <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter Subject.." />
                                        </div>
    
                                        <div class="mb-4 pb-2">
                                            <label for="comments" class="text-muted form-label">Message</label>
                                            <textarea name="comments" id="comments" rows="4" class="form-control" placeholder="Enter message..."></textarea>
                                        </div>
    
                                        <button type="submit" id="submit" name="send" class="btn btn-primary">Send Message</button>
                                    </div>
                                    <!-- end col -->
                                </div>
                                <!-- end row -->
                            </form>
                            <!-- end form -->
                        </div>
                    </div>
                    <!-- end col -->

                    <div class="col-lg-5 ms-lg-auto">
                        <div class="mt-5 mt-lg-0">
                            <img src="images/contact.png" alt="" class="img-fluid d-block" />
                            <p class="text-muted mt-5 mb-3"><i class="me-2 text-muted icon icon-xs" data-feather="mail"></i> Support@info.com</p>
                            <p class="text-muted mb-3"><i class="me-2 text-muted icon icon-xs" data-feather="phone"></i> +91 123 4556 789</p>
                            <p class="text-muted mb-3"><i class="me-2 text-muted icon icon-xs" data-feather="map-pin"></i> 2976 Edwards Street Rocky Mount, NC 27804</p>
                            <ul class="list-inline pt-4">
                                <li class="list-inline-item me-3">
                                    <a href="javascript: void(0);" class="social-icon icon-mono avatar-xs rounded-circle"><i class="icon-xs" data-feather="facebook"></i></a>
                                </li>
                                <li class="list-inline-item me-3">
                                    <a href="javascript: void(0);" class="social-icon icon-mono avatar-xs rounded-circle"><i class="icon-xs" data-feather="twitter"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="social-icon icon-mono avatar-xs rounded-circle"><i class="icon-xs" data-feather="instagram"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </section>
        <!-- Contact us end -->

        <!-- Footer Start -->
        <footer class="footer" style="background-image: url(images/footer-bg.png);">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="mb-4">
                            <a href="index-1.html"><img src="images/logo-light.png" alt="" class="" height="30" /></a>
                            <p class="text-white-50 my-4">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti.</p>
                        </div>
                    </div>
                    <!-- end col -->

                    <div class="col-lg-7 ms-lg-auto">
                        <div class="row">
                            <div class="col-lg-3 col-6">
                                <div class="mt-4 mt-lg-0">
                                    <h4 class="text-white font-size-18 mb-3">Customer</h4>
                                    <ul class="list-unstyled footer-sub-menu">
                                        <li><a href="javascript: void(0);" class="footer-link">Works</a></li>
                                        <li><a href="javascript: void(0);" class="footer-link">Strategy</a></li>
                                        <li><a href="javascript: void(0);" class="footer-link">Releases</a></li>
                                        <li><a href="javascript: void(0);" class="footer-link">Press</a></li>
                                        <li><a href="javascript: void(0);" class="footer-link">Mission</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-lg-3 col-6">
                                <div class="mt-4 mt-lg-0">
                                    <h4 class="text-white font-size-18 mb-3">Product</h4>
                                    <ul class="list-unstyled footer-sub-menu">
                                        <li><a href="javascript: void(0);" class="footer-link">Trending</a></li>
                                        <li><a href="javascript: void(0);" class="footer-link">Popular</a></li>
                                        <li><a href="javascript: void(0);" class="footer-link">Customers</a></li>
                                        <li><a href="javascript: void(0);" class="footer-link">Features</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-lg-3 col-6">
                                <div class="mt-4 mt-lg-0">
                                    <h4 class="text-white font-size-18 mb-3">Information</h4>
                                    <ul class="list-unstyled footer-sub-menu">
                                        <li><a href="javascript: void(0);" class="footer-link">Developers</a></li>
                                        <li><a href="javascript: void(0);" class="footer-link">Support</a></li>
                                        <li><a href="javascript: void(0);" class="footer-link">Customer Service</a></li>
                                        <li><a href="javascript: void(0);" class="footer-link">Get Started</a></li>
                                        <li><a href="javascript: void(0);" class="footer-link">Guide</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-lg-3 col-6">
                                <div class="mt-4 mt-lg-0">
                                    <h4 class="text-white font-size-18 mb-3">Support</h4>
                                    <ul class="list-unstyled footer-sub-menu">
                                        <li><a href="javascript: void(0);" class="footer-link">FAQ</a></li>
                                        <li><a href="javascript: void(0);" class="footer-link">Contact</a></li>
                                        <li><a href="javascript: void(0);" class="footer-link">Disscusion</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-5">
                            <p class="text-white-50 f-15 mb-0">
                                <script>
                                document.write(new Date().getFullYear())
                            </script> © Qexal. Design By Themesbrand</p>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </footer>
        <!-- Footer End -->

        <!-- Style switcher -->
        <div id="style-switcher">
            <div class="bottom">
                <a href="javascript: void(0);" id="mode" class="mode-btn text-white">
                    <i class="mdi mdi-white-balance-sunny mode-light"></i>
                    <i class="mdi mdi-moon-waning-crescent mode-dark"></i>
                </a>
                <a href="javascript: void(0);" class="settings" onclick="toggleSwitcher()"><i class="mdi mdi-cog  mdi-spin"></i></a>
            </div>
        </div>

        <!-- javascript -->
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/smooth-scroll.polyfills.min.js"></script>

        <script src="https://unpkg.com/feather-icons"></script>

        <!-- App Js -->
        <script src="js/app.js"></script>
    </body>
</html>
