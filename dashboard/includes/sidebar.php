<?php
include_once "../ajax/functions.php";
checkIfLogin();
?>
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">
  <?php $pagename = basename($_SERVER['PHP_SELF']); ?>
  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
  </a>

  <hr class="sidebar-divider my-0">
  <li class="nav-item <?php echo ($pagename == 'index.php' ? 'active' : '') ?>">
    <a class="nav-link" href="index.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>
  <hr class="sidebar-divider">
  <li class="nav-item <?php echo ($pagename == 'write-article.php' || $pagename == 'published' || $pagename == 'draft.php' ? 'active' : '') ?>">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-newspaper"></i>
      <span>Articles</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="write-article.php">Add Article</a>
        <a class="collapse-item" href="published.php">Published</a>
        <a class="collapse-item" href="draft.php">Drafts</a>
      </div>
    </div>
  </li>
  <li class="nav-item <?php echo ($pagename == 'comments.php' ? 'active' : '') ?>">
    <a class="nav-link" href="comments.php">
      <i class="fas fa-comment-dots"></i>
      <span>Comments</span></a>
  </li>
  <hr class="sidebar-divider">
  <li class="nav-item <?php echo ($pagename == 'profile.php' ? 'active' : '') ?>">
    <a class="nav-link" href="profile.php">
      <i class="fas fa-user"></i>
      <span>Profile</span></a>
  </li>
  <li class="nav-item <?php echo ($pagename == 'settings.php' ? 'active' : '') ?>">
    <a class="nav-link" href="settings.php">
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