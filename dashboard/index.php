<?php
// $userkey = $_SESSION['userkey'];
// $query = mysqli_query($connection, "SELECT name,profile_pic FROM users WHERE userkey='$userkey'");
// $row = mysqli_fetch_assoc($query);
?>

<?php //session_start(); 
?>
<?php //ob_start(); 
?>
<?php
// if (!isset($_SESSION['userkey']) || !isset($_SESSION['role'])) {
//   header("Location: ../login.php");
// }
?>
<!-- <form name="a_c" onsubmit="event.preventDefault();A_C()" id="a_c" class="rounded border py-3 px-3">
  <label for="catg">Add Category</label>
  <input type="text" name="catg" id="catg" placeholder="Enter Category" class="form-control mt-2" required>
  <button type="submit" name="submit_catg" id="submit_catg" class="btn btn-success w-100 mt-3">Add</button>
</form> -->

<?php include "includes/header.php" ?>

<div id="wrapper">

  <!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
      </div>
      <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
      <a class="nav-link" href="index.html">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-newspaper"></i>
        <span>Articles</span>
      </a>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="buttons.html">Add Article</a>
          <a class="collapse-item" href="cards.html">Published</a>
          <a class="collapse-item" href="buttons.html">Drafts</a>
        </div>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="charts.html">
        <i class="fas fa-comment-dots"></i>
        <span>Comments</span></a>
    </li>
    <hr class="sidebar-divider">
    <li class="nav-item">
      <a class="nav-link" href="tables.html">
        <i class="fas fa-user"></i>
        <span>Profile</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="tables.html">
        <i class="fas fa-cogs"></i>
        <span>Settings</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

  </ul>
  <!-- End of Sidebar -->

  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

      <!-- Topbar -->
      <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
          <i class="fa fa-bars"></i>
        </button>

        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">
          <div class="topbar-divider d-none d-sm-block"></div>
          <!-- Nav Item - User Information -->
          <li class="nav-item dropdown no-arrow">
            <button class="bg-white border-0 nav-link dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
              <img class="img-profile rounded-circle" src="../profiles/frog.jpg">
            </button>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
              <a class="dropdown-item" href="#">
                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                Profile
              </a>
              <a class="dropdown-item" href="#">
                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                Settings
              </a>
              <a class="dropdown-item" href="#">
                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                Activity Log
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>

      </nav>
      <!-- End of Topbar -->


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
                  <a href="javascript:void(0)" class="d-block text-decoration-none text-white">
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