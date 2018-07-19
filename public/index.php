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

                    

                </div><!-- ROW ENDS HERE -->
                
            </div>

        </div>

    </div>
    <!-- /.container -->

    <!-- INCLUDE FOOTER -->
    <?php include(TEMPLATE_FRONT.DS."footer.php"); ?>
    <!-- INCLUDE FOOTER -->