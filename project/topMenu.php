<?php
require_once("site_configuration.php");

if(isset($_POST['loginModalSubmit'])){
    if(isset($_POST['loginModalSubmit'])){
        $email = trim($_POST['email-modal']);
        $password = trim($_POST['password-modal']);
        if($siteConfigurationObject->userLogin($email, $password)){
        }
    }
}
else if(isset($_POST['loginSubmit'])){
    if(isset($_POST['loginSubmit'])){
        $email = trim($_POST['loginEmail']);
        $password = trim($_POST['loginPassword']);
        if($siteConfigurationObject->userLogin($email, $password)){
        }
    }
}
else if(isset($_POST['registerSubmit'])){ 
    if($siteConfigurationObject->registerUser()){
    }
}
else if(isset($_GET['logOut'])){
 if($siteConfigurationObject->logOut()){
    } 
}

?>
<!DOCTYPE html> 
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Online toy store">
    <meta name="keywords" content="toys, online toy store">

    <title>
        The Toy Box : Online Toy Store
    </title>

    <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100' rel='stylesheet' type='text/css'>

    <!-- styles-->
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/owl.carousel.css" rel="stylesheet">
    <link href="css/owl.theme.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/css/bootstrapValidator.css"/>

    <!-- theme stylesheet -->
    <link href="css/style.custom.css" rel="stylesheet" id="theme-stylesheet">

    <link href="css/custom.css" rel="stylesheet">

    <script src="js/respond.min.js"></script>

    <link rel="shortcut icon" href="favicon.png">
    <!-- *** SCRIPTS TO INCLUDE ***
 _________________________________________________________ -->
    <script src="js/jquery-1.11.0.min.js"></script>
    <!--<script src="js/bootstrap.min.js"></script>-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.js"></script>
    <script src="js/jquery.cookie.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/modernizr.js"></script>
    <script src="js/bootstrap-hover-dropdown.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/front.js"></script>

    <script src="js/formValidation.js"></script>

</head>

<body>
    <!-- *** TOPBAR ***
 _________________________________________________________ -->
    <div id="top">
        <div class="container">
            <div class="col-md-6 offer" data-animate="fadeInDown">
                <a href="#" class="btn btn-success btn-sm" data-animate-hover="shake">Offer of the day</a>  <a href="#">Get flat 35% off on orders over $50!</a>
            </div>
            <div class="col-md-6" data-animate="fadeInDown">
                <ul class="menu">
                    <?php if ($siteConfigurationObject->isUserLoggedIn()) : ?>
                        <li><a href="accountDetails.php"><?php echo 'Hello, ' . $siteConfigurationObject->getUserFullName(); ?></a>
                        </li>
                        <li><a href="accountDetails.php">My Account</a>
                        </li>
                       <li><a href="category.php">Products</a>
                        </li>
                        <li><a href="index.php?logOut=1">LogOut</a>
                        </li>
                    <?php else : ?>
                        <li><a href="#" data-toggle="modal" data-target="#login-modal">Login</a>
                        </li>
                        <li><a href="register.php">Register</a>
                        </li>
                    <?php endif;?>
                    <li><a href="#">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
            <div class="modal-dialog modal-sm">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="Login">Customer login</h4>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" id="loginModalForm">
                            <input type='hidden' name='loginModalSubmit' id='loginModalSubmit' value='1'/>
                            <div class="form-group">
                                <div class="inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                        <input type="text" class="form-control" name="email-modal" id="email-modal" placeholder="E-Mail Address">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input type="password" class="form-control" name="password-modal" id="password-modal" placeholder="password">
                                    </div>
                                </div>
                            </div>

                            <p class="text-center">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-sign-in"></i> Log in</button>
                            </p>

                        </form>

                        <p class="text-center text-muted">Not registered yet?</p>
                        <p class="text-center text-muted"><a href="register.php"><strong>Register now</strong></a>! It is easy and done in 1&nbsp;minute and gives you access to special discounts and much more!</p>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- *** TOP BAR END *** -->

    <!-- *** NAVBAR ***
 _________________________________________________________ -->

    <div class="navbar navbar-default yamm" role="navigation" id="navbar">
        <div class="container">
            <div class="navbar-header">

                <a class="navbar-brand home" href="index.php" data-animate-hover="bounce">
                    <img id="logo" src="img/logo.jpeg" alt="Toy Box logo" class="hidden-xs">
                </a>
            </div> 
            <div class="navbar-header">
                <div class="navbar-buttons">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <i class="fa fa-align-justify"></i>
                    </button>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#search">
                        <span class="sr-only">Toggle search</span>
                        <i class="fa fa-search"></i>
                    </button>
                    <a class="btn btn-default navbar-toggle" href="basket.php">
                        <i class="fa fa-shopping-cart"></i>
                        <span class="hidden-xs">
                            <?php echo $siteConfigurationObject->getCartQuantity() . " item(s) in Cart" ?>
                        </span>
                    </a>
                </div>
            </div>          
            <!--/.navbar-header -->

            <div class="navbar-collapse collapse" id="navigation">

                <ul class="nav navbar-nav navbar-left">
                    <li><a href="index.php">Home</a>
                    </li>
                    <li class="dropdown yamm-fw">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="200">Art & Crafts <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="yamm-content">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h5>Arts</h5>
                                            <ul>
                                                <li><a href="category.php?category=1">Drawing and Painiting Supplies</a>
                                                </li>
                                                <li><a href="#">Craft Kits</a>
                                                </li>
                                                <li><a href="#">Sketching Tablets</a>
                                                </li>
                                                <li><a href="#">Easels & Beads</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-3">
                                            <h5>Building Toys</h5>
                                            <ul>
                                                <li><a href="#">Building Sets</a>
                                                </li>
                                                <li><a href="#">Marble Runs</a>
                                                </li>
                                                <li><a href="#">Gear Sets</a>
                                                </li>
                                                <li><a href="#">Stacking Blocks</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-3">
                                            <h5>Kids</h5>
                                            <ul>
                                                <li><a href="#">Dolls</a>
                                                </li>
                                                <li><a href="#">Doll Accessories</a>
                                                </li>
                                                <li><a href="#">Beauty & Fashion</a>
                                                </li>
                                                <li><a href="#">Playsets</a>
                                                </li>
                                                <li><a href="#">Costumes</a>
                                                </li>
                                                <li><a href="#">Hats & Puppets</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.yamm-content -->
                            </li>
                        </ul>
                    </li>

                    <li class="dropdown yamm-fw">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="200">Learning & Education <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="yamm-content">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h5>Skills</h5>
                                            <ul>
                                                <li><a href="category.php?category=3" >Science</a>
                                                </li>
                                                <li><a href="#">Mathematics & Counting</a>
                                                </li>
                                                <li><a href="#">Reading & Writing</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-3">
                                            <h5>Puzzles</h5>
                                            <ul>
                                                <li><a href="category.php?category=4">3-D Puzzles</a>
                                                </li>
                                                <li><a href="#">Brain Teasers</a>
                                                </li>
                                                <li><a href="#">Floor Puzzles</a>
                                                </li>
                                                <li><a href="#">Pegged & Jigsaw</a>
                                                </li>
                                                 <li><a href="#">Puzzle Accessories</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-3">
                                            <h5>Hobbies</h5>
                                            <ul>
                                                <li><a href="#">Coin Collecting</a>
                                                </li> 
                                                <li><a href="#">Model & ModelKits</a>
                                                </li>
                                                <li><a href="#">Slot Cars & Race Tracks</a>
                                                </li>
                                                </ul>
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- /.yamm-content -->
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown yamm-fw">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="200">Games <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="yamm-content">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h5>Sports & Outdoor Play</h5>
                                            <ul>
                                                <li><a href="category.php?category=2">Sports</a>
                                                </li>
                                                <li><a href="#">Pools & Water Fun</a>
                                                </li>
                                                <li><a href="#">Flying Toys</a>
                                                </li>
                                                <li><a href="#">Lawn Games</a>
                                                </li>
                                                <li><a href="#">PlayHouses</a>
                                                </li>

                                            </ul>
                                        </div>
                                        <div class="col-sm-3">
                                            <h5>Toy Remote Contol & Play</h5>
                                            <ul>
                                                <li><a href="#">RC Vehicles & Batteries</a>
                                                </li>
                                                <li><a href="#">Die-Cast Vehicles</a>
                                                </li>
                                                <li><a href="#">Pull Back Vehicles</a>
                                                </li>
                                                <li><a href="#">Play Trains & Railway Sets</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-3">
                                            <h5>Tricycles,Sccoters & Wagons</h5>
                                            <ul>
                                                <li><a href="#">Ride-On Toys</a>
                                                </li>
                                                <li><a href="#">Kids' Bikes</a>
                                                </li>
                                                <li><a href="#">Electric Vehicles</a>
                                                </li>
                                                <li><a href="#">Balance Bikes</a>
                                                </li>
                                                <li><a href="#">Scooters & Equipment</a>
                                                </li>
                                                <li><a href="#">Tricylces</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row">   
                                        <div class="col-sm-3">
                                            <h5>Video Games</h5>
                                            <ul>
                                                <li><a href="category.php?category=5">PlayStation 4</a>
                                                </li>
                                                <li><a href="#">PlayStation 3</a>
                                                </li>
                                                <li><a href="#">Xbox One</a>
                                                </li>
                                                <li><a href="#">Xbox 360</a>
                                                </li>
                                                <li><a href="#">Wii</a>
                                                </li>
                                                <li><a href="#">Wii U</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-3">
                                       
                                            <h5>Games</h5>
                                            <ul>
                                                <li><a href="#">Board Games</a>
                                                </li>
                                                <li><a href="#">Card Games</a>
                                                </li>
                                                <li><a href="#">Dice & gaming Dice</a>
                                                </li>
                                                <li><a href="#">DVD Games</a>
                                                </li>
                                                <li><a href="#">Handheld Games</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            
                                <!-- /.yamm-content -->
                            </li>
                        </ul>
                    </li>
                    
                    <li class="dropdown yamm-fw">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="200">Electronic Toys <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="yamm-content">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h5>Toys and Robots</h5>
                                            <ul>
                                                <li><a href="#">Toys</a>
                                                </li>
                                                <li><a href="#">RC Figures and Robots</a>
                                                </li>
                                                <li><a href="#">Music Players & Karaoke</a>
                                                </li>
                                                <li><a href="#">Electronic Pets</a>
                                                </li>
                                                <li><a href="#">Cameras & Camcorders</a>
                                                </li>
                                                <li><a href="#">Systems & Accessories</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- /.yamm-content -->
                            </li>
                        </ul>
                    </li>
            
            </div>
            <!--/.nav-collapse -->

            <div class="navbar-buttons">

                <div class="navbar-collapse collapse right" id="basket-overview">
                    <a href="basket.php" class="btn btn-primary navbar-btn"><i class="fa fa-shopping-cart"></i>
                        <span class="hidden-sm">
                            <?php echo $siteConfigurationObject->getCartQuantity() . " item(s) in Cart" ?>
                        </span></a>
                </div>
                <!--/.nav-collapse -->

                <div class="navbar-collapse collapse right" id="search-not-mobile">
                    <button type="button" class="btn navbar-btn btn-primary" data-toggle="collapse" data-target="#search">
                        <span class="sr-only">Toggle search</span>
                        <i class="fa fa-search"></i>
                    </button>
                </div>

            </div>

            <div class="collapse clearfix" id="search">

                <form class="navbar-form" role="search" method="post" action="searchRedirect.php">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search" name="searchValue">
                        <span class="input-group-btn">

                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>

                        </span>
                    </div>
                </form>

            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
            
<!--</body>-->



        
        <!-- /container -->
            
    <!-- /#navbar -->

    <!-- *** NAVBAR END *** -->
    


