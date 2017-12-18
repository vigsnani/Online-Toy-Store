<?php
require("topMenu.php");

?>

    <div id="all">
        <?php if ($siteConfigurationObject->isUserLoggedIn()) : ?>
            <div data-animate="fadeInDown">
                <div class="container">
                    <ul class="breadcrumb">
                        <li><a href="#">Welcome <strong><?php echo $siteConfigurationObject->getUserFullName(); ?></strong></a>
                        </li>
                    </ul>
                </div>
            </div>
        <?php endif;?>
        <?php if (!empty($siteConfigurationObject->getErrorMessage())) : ?>
            <div id="content" data-animate="fadeInDown">
                <div class="container">
                    <div class="alert alert-danger">
                        <strong><?php echo $siteConfigurationObject->getErrorMessage(); ?></strong>
                    </div>
                </div>
            </div>
        <?php endif;?>

            <div class="container">
                <div class="col-md-12">
                    <div id="main-slider">
                        <div class="item">
                            <img src="img/main-slider1.jpeg" alt="" class="img-responsive">
                        </div>
                        <div class="item">
                            <img class="img-responsive" src="img/main-slider2.jpeg" alt="">
                        </div>
                        <div class="item">
                            <img class="img-responsive" src="img/main-slider3.jpeg" alt="">
                        </div>
                        <div class="item">
                            <img class="img-responsive" src="img/main-slider4.jpeg" alt="">
                        </div>
                        <div class="item">
                            <img class="img-responsive" src="img/main-slider5.jpeg" alt="">
                        </div>
                    </div>
                    <!-- /#main-slider -->
                </div>
            </div>

            <!-- *** ADVANTAGES HOMEPAGE ***
 _________________________________________________________ -->
            <div id="advantages">

                <div class="container">
                    <div class="same-height-row">
                        <div class="col-sm-4">
                            <div class="box same-height clickable">
                                <div class="icon"><i class="fa fa-heart"></i>
                                </div>

                                <h3><a href="#">We love our customers</a></h3>
                                <p>We are known to provide best possible prices ever</p>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="box same-height clickable">
                                <div class="icon"><i class="fa fa-tags"></i>
                                </div>

                                <h3><a href="#">Best Deals</a></h3>
                                <p>We offer great deals weekly. Register or subscribe to get deals directly in your inbox.</p>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="box same-height clickable">
                                <div class="icon"><i class="fa fa-thumbs-up"></i>
                                </div>

                                <h3><a href="#">100% satisfaction guaranteed</a></h3>
                                <p>Free returns on everything for 3 months.</p>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->

                </div>
                <!-- /.container -->

            </div>
            <!-- /#advantages -->

            <!-- *** ADVANTAGES END *** -->

            <!-- *** HOT PRODUCT SLIDESHOW ***
 _________________________________________________________ -->
            <div id="hot">

                <div class="box">
                    <div class="container">
                        <div class="col-md-12">
                            <h2>Hot deals this Black Friday</h2>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="product-slider">
                        <div class="item">
                            <div class="product">
                                <a href="#">
                                    <img src="img/deal1.jpeg" alt="" class="img-responsive">
                                </a>
                                <div class="text">
                                    <h4><a href="#">Save up to 70% on Games</a></h4>
                                </div>
                                <!-- /.text -->
                            </div>
                            <!-- /.product -->
                        </div>

                        <div class="item">
                            <div class="product">
                                <a href="#">
                                    <img src="img/deal2.jpeg" alt="" class="img-responsive">
                                </a>
                                <div class="text">
                                    <h4><a href="#">Up to 70% off Action Figures</a></h4>
                                </div>
                                <!-- /.text -->
                            </div>
                            <!-- /.product -->
                        </div>

                        <div class="item">
                            <div class="product">
                                <a href="#">
                                    <img src="img/deal3.jpeg" alt="" class="img-responsive">
                                </a>
                                <div class="text">
                                    <h4><a href="#">Up to 50% off Preschool Toys</a></h4>
                                </div>
                                <!-- /.text -->
                            </div>
                            <!-- /.product -->
                        </div>

                        <div class="item">
                            <div class="product">
                                <a href="#">
                                    <img src="img/deal4.jpeg" alt="" class="img-responsive">
                                </a>
                                <div class="text">
                                    <h4><a href="#">Up to 50% off Building Toys</a></h4>
                                </div>
                                <!-- /.text -->
                            </div>
                            <!-- /.product -->
                        </div>

                        <div class="item">
                            <div class="product">
                                <a href="#">
                                    <img src="img/deal5.jpeg" alt="" class="img-responsive">
                                </a>
                                <div class="text">
                                    <h4><a href="#">Up to 50% off Stuffed Animals</a></h4>
                                </div>
                                <!-- /.text -->
                            </div>
                            <!-- /.product -->
                        </div>

                        <div class="item">
                            <div class="product">
                                <a href="#">
                                    <img src="img/deal6.jpeg" alt="" class="img-responsive">
                                </a>
                                <div class="text">
                                    <h4><a href="#">Save up to 50% off Dolls</a></h4>
                                </div>
                                <!-- /.text -->

                                <div class="ribbon gift">
                                    <div class="theribbon">GIFT</div>
                                    <div class="ribbon-background"></div>
                                </div>
                                <!-- /.ribbon -->

                            </div>
                            <!-- /.product -->
                        </div>

                    </div>
                    <!-- /.product-slider -->
                </div>
                <!-- /.container -->

            </div>
            <!-- /#hot -->

            <!-- *** HOT END *** -->\


        </div>
        <!-- /#content -->
<?php
require("footer.php");
?>