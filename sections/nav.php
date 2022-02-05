<header class="shadow">
  <nav class="navbar navbar-expand-lg" aria-label="Eighth navbar example">
    <div class="container-lg">

      <a class="navbar-brand" href="index.php">
        Blog
      </a>

      <div class="collapse navbar-collapse" id="navbarsExample07">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="explore.php">Explore</a>
          </li>
          <?php if (empty($_COOKIE["_uacct_"]) || !isset($_COOKIE["_uacct_"])) : ?>
            <li class="nav-item">
              <a class="nav-link" href="login.php">Sign In</a>
            </li>
            <li class="nav-item">
              <a class="nav-link btn btn-primary text-white rounded" href="signup.php">Create account</a>
            </li>
          <?php endif; ?>

        </ul>
      </div>

      <?php if (!empty($_COOKIE["_uacct_"]) && isset($_COOKIE["_uacct_"])) : ?>
        <?php if (userKeyExists($_COOKIE["_uacct_"])) : ?>
          <div class="dropdown home-user-btn">
            <button type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="users/<?php echo getuserinfo($_COOKIE["_uacct_"], 'profile_pic') ?>" alt="" class="shadow-sm">
            </button>
            <ul class="dropdown-menu shadow border-0" aria-labelledby="dropdownMenuButton1">
              <li><a class="dropdown-item" href="dashboard">Dashboard</a></li>
              <li><a class="dropdown-item" href="logout.php">Log out</a></li>
            </ul>
            <style>
              .home-user-btn .dropdown-menu {
                right: 10px;
                left: unset;
              }

              .home-user-btn .dropdown-menu .dropdown-item {
                font-size: 14px;
              }

              .home-user-btn {
                margin-right: 50px;
              }

              .home-user-btn button {
                background: none;
                border: none;
                outline: none;
              }

              .home-user-btn button img {
                width: 35px;
                height: 35px;
                border-radius: 50%;
                object-fit: cover;
              }

              .home-user-btn img {
                object-fit: cover;
              }
            </style>
          </div>
        <?php endif; ?>
      <?php endif; ?>

    </div>
  </nav>

  <div class="mobile-nav">
    <div id="body-overlay" onclick="toggleMenu()"></div>
    <nav class="real-menu" role="navigation">
      <ul>
        <button class="close_btn" onclick="toggleMenu()">
          <span></span>
          <span></span>
        </button>
        <li><a href="index.php">home</a></li>
        <li><a href="explore.php">Explore</a></li>
        <li class="menu-btn menu-btn-2 shadow text-center mt-5"><a href="login.php">Sign In</a></li>
        <li class="menu-btn shadow text-center"><a href="signup.php">Create account</a></li>
      </ul>
    </nav>
    <button id="open-mob-menu" onclick="toggleMenu()">
      <span></span>
      <span></span>
      <span></span>
    </button>
  </div>
</header>