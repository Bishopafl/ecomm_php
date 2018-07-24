<?php require_once("../resources/config.php"); ?>
<!-- HEADER INCLUDES -->
<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>
<!-- HEADER INCLUDES -->

<!-- Page Content -->
<div class="container">

    <!-- Jumbotron Header -->
    <header class="jumbotron hero-spacer">
        <h1>Shop</h1>
    </header>

    <hr>
    <!-- /.row -->

    <!-- Page Features -->
    <div class="row text-center">

        <?php get_products_in_shop_page(); ?>

    </div><!-- /.row -->
<!-- INCLUDE FOOTER -->
<?php include(TEMPLATE_FRONT.DS."footer.php"); ?>
<!-- INCLUDE FOOTER -->        

        