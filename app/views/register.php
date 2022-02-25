<?php require_once VIEWS . '/user.views/inc/header.php' ?>
<section class="py-5" style="background: url(<?= URLROOT . 'public/images/airport-bag.jpg' ?>) no-repeat;background-size:cover;">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body px-5 py-4">
              <h2 class="fs-4 text-secondary text-uppercase text-center mb-5">Create an account</h2>

              <form method="post">
                <div class="d-lg-flex gap-md-3">
                    <div class="flex-grow-1 form-outline mb-4">
                        <label class="form-label" for="fname">First Name</label>
                        <input required type="text" name="fname" id="fname" class="form-control " placeholder="Enter your first name" />
                    </div>

                    <div class="flex-grow-1 form-outline mb-4">
                        <label class="form-label" name="lname" for="lname">Last Name</label>
                        <input required type="text" name="lname" id="lname" class="form-control " placeholder="Enter your last name" />
                    </div>
                </div>

                <div class="mb-4">
                  <label class="form-label" for="nic">NIC</label>
                  <input required type="text" name="nic" id="nic" class="form-control " placeholder="Enter your national identity card number" />
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label" for="phone">Phone</label>
                    <input required type="tel" name="phone" id="phone" class="form-control " placeholder="Enter your phone number" />
                </div>
                
                <div class="form-outline mb-4">
                    <label class="form-label" for="email">Email</label>
                    <input required type="email" name="email" id="email" class="form-control " placeholder="Enter your email" />
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label" for="pass">Password</label>
                    <input required type="password" name="pass" id="pass" class="form-control " placeholder="Choose a password" />
                </div>
                
                <div class="d-flex justify-content-center">
                  <button type="submit" class="btn btn-success btn-block">Register</button>
                </div>

                <p class="text-center text-muted mt-4 mb-0">Have already an account? <a href="<?= URLROOT.'user/login' ?>" class="fw-bold text-primary">Login</a></p>

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php require_once VIEWS . '/user.views/inc/footer.php' ?>
