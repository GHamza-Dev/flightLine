<?php require_once VIEWS . '/user.views/inc/header.php' ?>
<?php 
    $email_err = isset($data['email_err']) ? $data['email_err'] : '';
    $pass_err = isset($data['pass_err']) ? $data['pass_err'] : '';
?>
<div class="container my-5 border rounded-3" style="height: 510px;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6 text-black">
        <div class="d-flex align-items-center px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

          <form action="<?= URLROOT.'user/login' ?>" method="post" style="width: 23rem;">

            <h3 class="fw-normal mb-3 pb-2" style="letter-spacing: 1px;">Log in</h3>

            <div class="form-outline mb-4">
                <label class="form-label" for="email">Email address</label>
                <input name="email" type="email" id="email" class="form-control form-control-lg" />
                <?php if(!empty($email_err)): ?> <small class="text-danger"><?= '*'.$email_err ?></small> <?php endif  ?>
            </div>

            <div class="form-outline mb-4">
                <label class="form-label" for="pass">Password</label>
                <input name="passwd" type="password" id="pass" class="form-control form-control-lg" />
                <?php if(!empty($pass_err)): ?> <small class="text-danger"><?= '*'.$pass_err ?></small> <?php endif  ?>
            </div>

            <div class="pt-1 mb-4">
              <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
            </div>

            <p>Don't have an account? <a href="#!" class="link-danger">Register here</a></p>

          </form>

        </div>

      </div>
      <div class="col-md-6 px-0 d-none d-md-block">
        <img src="<?= URLROOT.'public/images/connected_world_wuay.png' ?>" alt="Login image" class="w-100 h-100" style="object-fit: cover; object-position: left;">
      </div>
    </div>
  </div>
</div>
<?php require_once VIEWS . '/user.views/inc/footer.php' ?>
