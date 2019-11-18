<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
    <!-- <div class="container"> -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo $theme_assets . 'img/logo.jpg'; ?>" alt="Logo"></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
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
            <form class="navbar-form navbar-right">
                <div class="btn-group btn-group-sm" role="group" aria-label="...">
                    <?php if (!$this->ion_auth->logged_in()) { ?>
                        <a href="<?php echo base_url('member'); ?>" class="btn btn-info btn-flat">Login</a>
                        <a href="<?php echo base_url('member/register'); ?>" class="btn btn-success btn-flat">Daftar</a>
                        <?php
                    } else {
                        echo '<a href="' . base_url('member') . '" class="btn btn-info btn-flat"><b>' . $this->ion_auth->user()->row    ()->first_name . '</b></a>';
                        echo '<a href="' . base_url('auth/logout') . '" class="btn btn-danger btn-flat">Logout</a>';
                    }
                    ?>
                </div>
            </form>
        </div><!--/.nav-collapse -->
    <!-- </div> -->
</nav>