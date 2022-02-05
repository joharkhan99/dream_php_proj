<?php include "includes/header.php" ?>
<div id="wrapper">

  <?php include "includes/sidebar.php" ?>

  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

      <?php include "includes/topbar.php" ?>


      <!-- Begin Page Content -->
      <div class="container-fluid publish_page">

        <div class="row">

          <div class="col-md-8 mx-auto bg-white px-4 py-5 shadow">

            <div class="d-sm-flex align-items-center justify-content-between mb-1 border-bottom">
              <h1 class="h3 mb-0 text-gray-800">Password</h1>
            </div>

            <form method="post" id="change_pass_form" onsubmit="event.preventDefault();C_P();">
              <div class="row">
                <div class="col-md-12 mb-2 py-3">
                  <span class="d-block text-xs">TO ensure security. This is how your passsword is stored with us. So no one has any idea about it except YOU!</span>
                  <div class="bg-light">
                    <code>
                      <?php echo uniqid() . md5($_COOKIE['_uacct_']) . returnuserinfo($_COOKIE['_uacct_'], 'password') . md5($_COOKIE['_uacct_']) . uniqid() ?>
                    </code>
                  </div>
                </div>
                <div class="col-md-12">
                  <h5 class="py-1 border-bottom mb-3">Change Password</h5>
                </div>
                <div class="col-md-6">
                  <label class="mb-0">New Password</label>
                  <input type="text" class="form-control custom_input" name="pass" id="pass">
                </div>
                <div class="col-md-6">
                  <label class="mb-0">Confirm Password</label>
                  <input type="password" class="form-control custom_input" name="cnfm_pass" id="cnfm_pass">
                </div>
              </div>
              <div class="row border-top mt-5">
                <div class="col-md-6 mb-2 mx-auto mt-3">
                  <button type="submit" class="btn btn-primary btn-block">Update Password</button>
                </div>
              </div>
            </form>

          </div>
        </div>

      </div>
      <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->


    <?php include "includes/footer.php" ?>
  </div>
  <!-- End of Content Wrapper -->

</div>

<?php include "includes/scripts.php" ?>