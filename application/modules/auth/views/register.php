<div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
          <div class="login-brand">
                        <a href="<?php echo site_url() ?>">RegisterNew<b>Member</b></a>
                    </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Register</h4></div>

              <div class="card-body">
              <?php if (!empty($message)) { ?>
                  <div id="infoMessage" class="alert alert-danger alert-dismissible show fade">
                      <div class="alert-body">
                          <button class="close" data-dismiss="alert">
                          <span>&times;</span>
                          </button>
                          <?php echo $message; ?>
                      </div>
                  </div>
              <?php } ?>

              <?php echo form_open(uri_string()); ?>
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="first_name">Full Name</label>
                      <?php echo form_input($first_name); ?>
                    </div>
                    <div class="form-group col-6">
                      <label for="identity">Username</label>
                      <?php echo form_input($identity); ?>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="email">Email</label>
                    <?php echo form_input($email); ?>
                    <div class="invalid-feedback">
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="password" class="d-block">Password</label>
                      <?php echo form_input($password); ?>
                      <div id="pwindicator" class="pwindicator">
                        <div class="bar"></div>
                        <div class="label"></div>
                      </div>
                    </div>
                    <div class="form-group col-6">
                      <label for="password_confirm" class="d-block">Password Confirmation</label>
                      <?php echo form_input($password_confirm); ?>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="agree" class="custom-control-input" id="agree">
                      <label class="custom-control-label" for="agree">I agree with the terms and conditions</label>
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                      Register
                    </button>
                  </div>
                </form>
              </div>
            </div>
                    <div class="mt-5 text-muted text-center">
                        Have an account? <a href="<?php echo base_url('member'); ?>">Login Now</a>
                    </div>
            <div class="simple-footer">
                <small><b>PM</b>CMS v 0.9.8 <span class="label label-danger">powered by <b>Stisla</b></span></small>
                <p>&copy; <?php echo mdate("%Y", now())?> <a href="<?php echo base_url(); ?>"><?php echo $this->config->item('website_name'); ?></a></p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>