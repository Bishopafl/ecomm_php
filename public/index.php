<?php require_once("../resources/config.php"); ?>

    <!-- HEADER INCLUDES -->
    <?php include(TEMPLATE_FRONT . DS . "header.php"); ?>
    <!-- HEADER INCLUDES -->

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <!-- CATEGORY INCLUDES -->
            <?php include(TEMPLATE_FRONT . DS . "side_nav.php"); ?>
            <!-- CATEGORY INCLUDES -->

            <div class="col-md-9">

                <div class="row carousel-holder">

                    <div class="col-md-12">
                        <!-- CAROUSEL INCLUDES -->
                        <?php include(TEMPLATE_FRONT . DS . "slider.php"); ?>
                        <!-- CAROUSEL INCLUDES -->
                    </div>

                </div>

                <div class="row">

                    <?php get_products(); ?>

                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img src="http://placehold.it/320x150" alt="">
                            <div class="caption">
                                <h4 class="pull-right">$24.99</h4>
                                <h4><a href="product.html">First Product</a>
                                </h4>
                                <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
                            </div>
                            <div class="ratings">
                                <p class="pull-right">15 reviews</p>
                                <p>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <h4><a href="#">Like this template?</a>
                        </h4>
                        <p>If you like this template, then check out <a target="_blank" href="http://maxoffsky.com/code-blog/laravel-shop-tutorial-1-building-a-review-system/">this tutorial</a> on how to build a working review system for your online store!</p>
                        <a class="btn btn-primary" target="_blank" href="http://maxoffsky.com/code-blog/laravel-shop-tutorial-1-building-a-review-system/">View Tutorial</a>
                    </div>

                </div><!-- ROW ENDS HERE -->
                
            </div>

        </div>

    </div>
    <!-- /.container -->

    <!-- INCLUDE FOOTER -->
    <?php include(TEMPLATE_FRONT.DS."footer.php"); ?>
    <!-- INCLUDE FOOTER -->