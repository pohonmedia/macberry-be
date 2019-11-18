<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url(); ?>"><?php echo $this->config->item('website_name'); ?></a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
            <?php
            if (!empty($template['partials']['top_menu'])) {
                echo $template['partials']['top_menu'];
            } else {
                echo '<div class="collapse navbar-collapse">';
                echo '<ul class="nav navbar-nav">';
                echo '<li><a href="' . base_url() . '">Home</a></li>';
                echo '</ul>';
                echo '</div>';
            }
            ?>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>