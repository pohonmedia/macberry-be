<div class="jumbotron c-blog--bg">
    <div class=""></div>
</div>
<div class="container c-blog-content" ">

    <div class="card mx-auto">
        <div class="card-body">

            <!-- card title start here -->
            <h1 class="text-left">
                <?php echo $article->art_title;?>
            </h1>
            <!-- card title end here -->
            <hr>
            <!-- card date start here -->
            <div class="row">
                <div class="col-lg-2 text-center">
                    <p>
                        <?php echo mdate("%d %M %Y", strtotime($article->date_create));?>
                    </p>
                </div>
                <div class="col-lg-6">
                    <button type="button" class="btn btn-primary badge-pill badge-primary">
                        <?php echo $article->ct_name;?>
                    </button>
                </div>
            </div>
            <!-- card date end here -->
            <div class="row">
                <div class="col-12 o-post">
                    <?php echo $article->art_content;?>
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- related post start here -->
    <div class="container">
        <div class="row c-blog-related">

            <div class="col-lg-12 text-left">
                <h3>
                    related post
                </h3>
                <hr align="left">
            </div>

            <!-- card content #1 start here -->
            <div class="col-lg-4 col-12 mb-4">
                <div class="card">
                    <img src="<?php echo base_url('themes/akana/assets/img/bromo2.jpg');?>" class="card-img-top" alt="image">
                    <div class="overlay card-img-overlay text-left">
                        <div class="c-content">
                            <h5 class="card-title">Blog title #1</h5>
                            <div class="row">
                                <div class="col-6">
                                    <p>
                                        14 mei 2019
                                    </p>
                                </div>
                                <div class="col-6">
                                    <p>
                                        tips
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et …
                        </p>
                        <a href="#" class="btn btn-link stretched-link">lihat detail</a>
                    </div>
                </div>
            </div>
            <!-- card content #1 end here -->

            <!-- card content #1 start here -->
            <div class="col-lg-4 col-12 mb-4">
                <div class="card">
                    <img src="<?php echo base_url('themes/akana/assets/img/bromo2.jpg');?>" class="card-img-top" alt="image">
                    <div class="overlay card-img-overlay text-left">
                        <div class="c-content">
                            <h5 class="card-title">Blog title #1</h5>
                            <div class="row">
                                <div class="col-6">
                                    <p>
                                        14 mei 2019
                                    </p>
                                </div>
                                <div class="col-6">
                                    <p>
                                        tips
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et …
                        </p>
                        <a href="#" class="btn btn-link stretched-link">lihat detail</a>
                    </div>
                </div>
            </div>
            <!-- card content #1 end here -->

            <!-- card content #1 start here -->
            <div class="col-lg-4 col-12 mb-4">
                <div class="card">
                    <img src="<?php echo base_url('themes/akana/assets/img/bromo2.jpg');?>" class="card-img-top" alt="image">
                    <div class="overlay card-img-overlay text-left">
                        <div class="c-content">
                            <h5 class="card-title">Blog title #1</h5>
                            <div class="row">
                                <div class="col-6">
                                    <p>
                                        14 mei 2019
                                    </p>
                                </div>
                                <div class="col-6">
                                    <p>
                                        tips
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et …
                        </p>
                        <a href="#" class="btn btn-link stretched-link">lihat detail</a>
                    </div>
                </div>
            </div>
            <!-- card content #1 end here -->

        </div>
    </div>
    <!-- related post end here -->

