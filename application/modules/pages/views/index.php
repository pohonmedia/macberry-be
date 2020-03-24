    <!-- carousel start here 
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
carousel end here -->

<section id="service" class="about-us pb-30 mt-30" style="padding-top:150px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="services-left mt-25">
                    <div class="services">
                        <?php 
                            if($page->hal_img != null) {
                                echo '<img src="'. base_url($page->hal_img. '?' . random_string('alnum', 6)) . '" alt="about us" style="max-height: 400px; object-fit:cover; border-radius:10px;">';
                            } else {
                                echo '<img src="' . base_url('assets/modules/pages/default-image.jpg'). '" alt="about us" style="max-height: 400px; object-fit:cover; border-radius:10px;">';
                            }
                        ?>
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
                            <ul>
                                <li>Free ongkir se-indonesia</li>
                                <li>Free instalasi aplikasi lengkap</li>
                                <li>Free upgrade OS / iOS terbaru</li>
                                <li>Konsultasi & Troubleshooting 24 jam</li>
                                <li>Garansi service 1 bulan / tukar unit </li>
                                <li>Terpercaya dan berpengalaman selama lebih dari 10 tahun di dunia apple</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <a class="btn c-btn-primary w-100 mb-20" data-toggle="collapse" href="#collapse2" role="button" aria-expanded="false" aria-controls="collapse2">
                        Apakah ada di marketplace lainya ?
                    </a>
                    <div class="collapse" id="collapse2">
                        <div class="card card-body">
                            Iya, Macberry juga tersedia di tokopedia, shopee dan bukalapak, semuanya pakai nama : <b> Macberry Store</b>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <a class="btn c-btn-primary w-100 mb-20" data-toggle="collapse" href="#collapse3" role="button" aria-expanded="false" aria-controls="collapse3">
                        Bisakah update iOS & clean macOS ?
                    </a>
                    <div class="collapse" id="collapse3">
                        <div class="card card-body">
                            Iya, untuk update iOS kurang lebih 40 menit. Untuk clean macOS 3 - 4 jam kalau antrianya tidak banyak. Sudah include software microsoft office dan Adobe. Bisa request software lain juga.
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
                    <h2 class="text-uppercase pb-20 text-center">Apa yang Kamu Dapat?</h2>
                    <div class="d-flex justify-content-center">
                        <a class="btn c-btn-primary w-85 mb-20" data-toggle="modal" data-target="#modalTerm" href="#">
                            Lihat keuntungan
                        </a>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="modalTerm" tabindex="-1" role="dialog" aria-labelledby="modalTermTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTermTitle">Keuntungan yang Kamu Dapat</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>
                                   1. Free Ongkir <br>
2. Free Instalasi Aplikasi Lengkap <br>
3. Free upgrade OS terbaru <br>
4. Konsultasi 24 jam <br>
5. Garansi Service 1 Bulan / Tukar Unit <br>
6. Terpercaya dan Pengalaman selama lebih dari 10 Tahun di dunia Apple. <br>
</p>
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