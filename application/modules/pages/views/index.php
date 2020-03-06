    <!-- carousel start here -->
<div id="carouselExampleIndicators" class="carousel slide mt-100" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="https://placehold.it/1920x720" alt="First slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="https://placehold.it/1920x720" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="https://placehold.it/1920x720" alt="Third slide">
        </div>
    </div>
</div>

<section id="service" class="about-us pb-30 mt-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="services-left mt-25">
                    <div class="services">
                        <img src="<?php echo $theme_assets . 'img/img-1.jpg'; ?>" alt="about us" style="max-height: 400px; object-fit:cover; border-radius:10px;">
                    </div>
                    <!-- services btn -->
                </div>
                <!-- services left -->
            </div>
            <div class="col-lg-6">
                <div class="section-title pb-30 mt-25">
                    <h3 class="title mb-15 text-capitalize"><?php echo $page->hal_title; ?></h3>
                    <?php echo $page->hal_desc;?>
                </div>
                <!-- section title -->
            </div>
        </div>
        <!-- row -->
    </div>
    <!-- container -->
</section>




    <!-- faq start here -->
    <section id="faq" class="faq-content mt-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center pb-50">
                    <h2 class="text-uppercase">faq</h2>
                    <p>Pertanyaan yang sering ditanyakan</p>
                </div>
                <div class="col-lg-4">
                    <a class="btn c-btn-primary w-100 mb-20" data-toggle="collapse" href="#collapse1" role="button" aria-expanded="false" aria-controls="collapse1">
                        Apa keuntungan beli di sini ?
                    </a>
                    <div class="collapse" id="collapse1">
                        <div class="card card-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <a class="btn c-btn-primary w-100 mb-20" data-toggle="collapse" href="#collapse2" role="button" aria-expanded="false" aria-controls="collapse2">
                        Dimana saya tau barangnya ori ?
                    </a>
                    <div class="collapse" id="collapse2">
                        <div class="card card-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <a class="btn c-btn-primary w-100 mb-20" data-toggle="collapse" href="#collapse3" role="button" aria-expanded="false" aria-controls="collapse3">
                        Adminya ganteng kah ?
                    </a>
                    <div class="collapse" id="collapse3">
                        <div class="card card-body">
                            jelas.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- faq end here -->

    <!-- T & C start here -->
    <section id="termcontact" class="term-contacts pt-30">
        <div class="container">
            <div class="row">

                <div class="col-lg-6">
                    <h2 class="text-uppercase pb-20 text-center">term & condition</h2>
                    <div class="d-flex justify-content-center">
                        <a class="btn c-btn-primary w-85 mb-20" data-toggle="modal" data-target="#modalTerm" href="#">
                            Lihat term & condition
                        </a>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="modalTerm" tabindex="-1" role="dialog" aria-labelledby="modalTermTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTermTitle">Term & Condition</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptatem temporibus nihil culpa tenetur eos voluptatum, nesciunt, repudiandae maiores blanditiis tempora assumenda dolore voluptatibus tempore pariatur? Ab saepe delectus provident illum!
                                    <br><br>
                                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Amet suscipit sint hic, ratione tempora labore odit doloremque! Laudantium explicabo laboriosam quo nemo provident exercitationem veritatis maiores culpa est. Animi, dignissimos.
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- modal -->
                </div>

                <div class="col-lg-6">
                    <h2 class="text-uppercase pb-20 text-center">contact us</h2>
                    <div class="d-flex justify-content-center">
                        <a class="btn c-btn-primary w-85 mb-20" data-toggle="modal" data-target="#modalKontak" href="#">
                            Klik disini untuk support
                        </a>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="modalKontak" tabindex="-1" role="dialog" aria-labelledby="modalKontakTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalKontakTitle">Kontak Kami</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="form-group">
                                            <label for="inputEmail">Email anda</label>
                                            <input type="text" class="form-control" id="inputEmail" placeholder="Masukan email anda">
                                        </div>
                                        <div class="form-group pt-20">
                                            <label for="inputNomor">Nomor Telepon</label>
                                            <input type="text" class="form-control" id="inputNomor" placeholder="Masukan nomor telepon anda">
                                        </div>
                                        <div class="form-group pt-20">
                                            <div class="form-group">
                                                <label for="inputKeluhan">Masukan Keluhan</label>
                                                <textarea class="form-control" id="inputKeluhan" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <a class="btn c-btn-primary mt-20" href="#" role="button">Kirim keluhan</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- modal -->
                </div>

            </div>
        </div>
    </section>
    <!-- T & C end here -->