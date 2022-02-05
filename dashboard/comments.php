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

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4 border-bottom py-3">
          <h1 class="h3 mb-0 text-gray-800">Comments</h1>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="comments bg-white px-3 py-3 rounded shadow-sm">
              <h5 class="border-bottom py-2 mb-4">Comments Made By You</h5>
              <?php getCommentsBySpecificUser($_COOKIE['_uacct_']); ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="comments bg-white px-3 py-3 rounded shadow-sm">
              <h5 class="border-bottom py-2 mb-4">Comments On Your Articles</h5>
              <?php getCommentsForSpecificUserPosts($_COOKIE['_uacct_']); ?>
            </div>
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