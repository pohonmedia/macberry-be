<section id="header">
    <div class="position-relative overflow-hidden p-3 p-md-5 text-center bg-light c-header">
        <div class="row">
        <div class="col-lg-12">
                <h3 class="text-capitalize"><?php echo $article->art_title;?></h3>
                <p><?php echo mdate("%d %M %Y", strtotime($article->date_create));?></p>
            </div>
        </div>
    </div>
</section>

<section id="service" class="about-us pb-30 mt-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title pb-30 mt-25">
                    <?php echo $article->art_content;?>
                </div>
                <!-- section title -->
            </div>
        </div>
        <!-- row -->
    </div>
    <!-- container -->
</section>