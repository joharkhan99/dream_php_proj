<!-- <form name="a_c" onsubmit="event.preventDefault();A_C()" id="a_c" class="rounded border py-3 px-3">
  <label for="catg">Add Category</label>
  <input type="text" name="catg" id="catg" placeholder="Enter Category" class="form-control mt-2" required>
  <button type="submit" name="submit_catg" id="submit_catg" class="btn btn-success w-100 mt-3">Add</button>
</form> -->

<?php include "includes/header.php" ?>

<div id="wrapper">

  <?php include "includes/sidebar.php" ?>

  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

      <?php include "includes/topbar.php" ?>


      <!-- Begin Page Content -->
      <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>

        <!-- Content Row -->
        <div class="row">

          <!-- Earnings (Monthly) Card Example -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Articles</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">300</div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Earnings (Monthly) Card Example -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Drafts</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">21</div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-file-signature fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Earnings (Monthly) Card Example -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Likes</div>
                    <div class="row no-gutters align-items-center">
                      <div class="col-auto">
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-heart fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Pending Requests Card Example -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Comments</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">

            <div class="row">

              <div class="col-md-6 mb-2">
                <div class="card gradient-1 custom-shadow1 h-100 py-2">
                  <a href="javascript:void(0)" class="d-block text-decoration-none text-white">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="h5 mb-2 font-weight-bold">View Published</div>
                          <div class="text-xs mb-0 font-weight-bold text-uppercase">click for details</div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                      </div>
                    </div>
                  </a>
                </div>
              </div>

              <div class="col-md-6 mb-2">
                <div class="card gradient-2 custom-shadow1 h-100 py-2">
                  <a href="write-article.php" class="d-block text-decoration-none text-white">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="h5 mb-2 font-weight-bold">Publish An Article</div>
                          <div class="text-xs mb-0 font-weight-bold text-uppercase">click to add</div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-feather-alt fa-2x text-gray-300"></i>
                        </div>
                      </div>
                    </div>
                  </a>
                </div>
              </div>

              <div class="col-md-6 mb-2">
                <div class="card gradient-3 custom-shadow1 h-100 py-2">
                  <a href="javascript:void(0)" class="d-block text-decoration-none text-white">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="h5 mb-2 font-weight-bold">View Drafts</div>
                          <div class="text-xs mb-0 font-weight-bold text-uppercase">click for details</div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-file-signature fa-2x text-gray-300"></i>
                        </div>
                      </div>
                    </div>
                  </a>
                </div>
              </div>

              <div class="col-md-6 mb-2">
                <div class="card gradient-4 custom-shadow1 h-100 py-2">
                  <a href="javascript:void(0)" class="d-block text-decoration-none text-white">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="h5 mb-2 font-weight-bold">View Comments</div>
                          <div class="text-xs mb-0 font-weight-bold text-uppercase">click for details</div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                      </div>
                    </div>
                  </a>
                </div>
              </div>

              <div class="col-md-6 mb-2">
                <div class="card gradient-5 custom-shadow1 h-100 py-2">
                  <a href="javascript:void(0)" class="d-block text-decoration-none text-white">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="h5 mb-2 font-weight-bold">Profile Settings</div>
                          <div class="text-xs mb-0 font-weight-bold text-uppercase">click for details</div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-user-cog fa-2x text-gray-300"></i>
                        </div>
                      </div>
                    </div>
                  </a>
                </div>
              </div>

            </div>

          </div>

          <!-- recent comments -->
          <div class="col-md-6">

            <div class="comments bg-white px-3 py-3 rounded shadow-sm">
              <h5 class="border-bottom py-2 mb-4">Recent comments on your articles</h5>

              <div class="comment-box bg-light rounded">
                <span class="commenter-pic">
                  <img src="../profiles/default.png" class="img-fluid">
                </span>
                <span class="commenter-name">
                  <span class="username">None</span> <span class="comment-time">5 months ago</span>
                </span>
                <p class="comment-txt more mb-0 pb-3">nice</p>
              </div>

              <div class="comment-box bg-light rounded">
                <span class="commenter-pic">
                  <img src="../profiles/default.png" class="img-fluid">
                </span>
                <span class="commenter-name">
                  <span class="username">None</span> <span class="comment-time">5 months ago</span>
                </span>
                <p class="comment-txt more border-bottom mb-0 pb-3">my nMW IS RENEWD</p>
                <div class="comment-box replied rounded bg-white">
                  <span class="commenter-name">
                    <span>None</span> <span class="comment-time">5 months ago</span>
                  </span>
                  <p class="comment-txt more">literally brother</p>
                </div>
                <div class="comment-box replied rounded bg-white">
                  <span class="commenter-name">
                    <span>None</span> <span class="comment-time">5 months ago</span>
                  </span>
                  <p class="comment-txt more">literally brother</p>
                </div>
              </div>

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