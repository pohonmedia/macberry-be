<!-- Navigation start here -->
<header class="header-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg">
                    <a class="navbar-brand" href="index.html">
                        <img src="<?php echo $theme_assets . 'img/macberry.svg'; ?>" alt="Logo" style="height:40px;" alt="<?php echo $this->config->item('website_name'); ?>" >
                    </a>
                    <!-- Logo -->
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="bar-icon"></span>
                        <span class="bar-icon"></span>
                        <span class="bar-icon"></span>
                    </button>
                    <?php
                        if (!empty($template['partials']['top_menu'])) {
                            echo $template['partials']['top_menu'];
                        } else {
                            echo '<div class="collapse navbar-collapse" id="navbarSupportedContent">';
                            echo '<ul class="navbar-nav mr-auto">';
                            echo '<li class="nav-item"><a href="' . base_url() . '">Home</a></li>';
                            echo '</ul>';
                            echo '<form class="form-inline my-2 my-lg-0">';
                            echo '<button class="btn btn-outline-success my-2 my-sm-0 btn--primary" id="contact">Contact Us</button>';
                            echo '</form>';
                            echo '</div>';
                        }
                    ?>

                    <!-- <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul id="nav" class="navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a data-scroll-nav="0" href="/app">Homepage</a>
                            </li>
                            <li class="nav-item">
                                <a data-scroll-nav="0" href="/app/product-list">Our Products</a>
                            </li>
                            <li class="nav-item">
                                <a data-scroll-nav="0" href="">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a data-scroll-nav="0" href="">Contact</a>
                            </li>
                            <li class="nav-item">
                                <a data-scroll-nav="0" href="">
                                    <i class="fas fa-shopping-basket"></i>
                                    &nbsp; Your Cart
                                </a>
                            </li>
                        </ul>
                        <form class="form-inline my-2 my-lg-0 ml-4">
                            <button class="c-btn-primary text-capitalize" type="submit" style="letter-spacing:0.5px;">
                                Masuk / daftar
                            </button>
                        </form>
                    </div> -->
                </nav>
                <!-- navbar -->
            </div>
        </div>
        <!-- row -->
    </div>
    <!-- container -->
</header>
<!-- Navigation end here -->