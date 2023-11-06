<?php include_once '../config/config.php'; ?>
<?php include_once '../includes/header.php'; ?>

<?php
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    //header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    echo 'HTTP/1.0 403 Forbidden';
    exit;
}
?>

<?php
    if(isset($_SESSION['username'])) {
        echo '<script>window.location="' . APP_URL . 'index.php";</script>';
    }
?>

    <div class="container">  
      <!-- Heading -->
      <h2 class="my-5 h2 text-center">Checkout</h2>

      <!--Grid row-->
      <div class="row d-flex justify-content-center align-items-center h-100 mt-5 mt-5">

        <!--Grid column-->
        <div class="col-md-12 mb-4">

          <!--Card-->
          <div class="card">

            <!--Card content-->
            <form class="card-body" method="POST" action="charge.php">

              <!--Grid row-->
              <div class="row">

                  <!--firstName-->
                <div class="col-md-6 mb-2">
                  <div class="md-form">
                    <label for="firstName" class="">First name</label>
                    <input type="text" name="fname" id="firstName" class="form-control">
                  </div>
                </div>

                  <!--lastName-->
                <div class="col-md-6 mb-2">
                  <div class="md-form">
                    <label for="lastName" class="">Last name</label>
                    <input type="text" name="lname" id="lastName" class="form-control">
                  </div>
                </div>

              </div>
              <!--Grid row-->

              <!--Username-->
              <div class="md-form mb-5">
                <label for="email" class="">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Username" aria-describedby="basic-addon1">
              </div>

              <!--email-->
              <div class="md-form mb-5">
                <label for="email" class="">Email (optional)</label>
                <input type="text" name="email" id="email" class="form-control" placeholder="youremail@example.com">
              </div>

              <hr class="mb-4">

                <script
                        src="https://checkout.stripe.com/checkout.js"
                        class="stripe-button"
                        data-key="pk_test_51O7eJzKerJqqFFmcYWt1MaNnfdYuUGMDN9VYqPwSeMcFiCHubtsfO28ROTgyT6HJCIh0LmySgmwL70R4w2eR0FsA00EPooLnB3"
                        data-amount="<?php echo isset($_SESSION['price']) ? $_SESSION['price'] * 100 : '0'; ?>"
                        data-currency="ron"
                        data-label="pay now"
                </script>


              <button name="submit" class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>

            </form>

          </div>
        </div>
    </div>
  </div>

<?php include_once '../includes/footer.php'; ?>
