<header>
  <nav class="navbar navbar-expand-lg" aria-label="Eighth navbar example">
    <div class="container-lg">

      <a class="navbar-brand" href="#">
        Blog
      </a>

      <div class="collapse navbar-collapse" id="navbarsExample07">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="#">Explore</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Sign In</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Join</a>
          </li>
        </ul>
      </div>
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
        <li><a href="#">home</a></li>
        <li><a href="#">all blogs</a></li>
        <li><a href="#">categories</a></li>
        <li><a href="#">contact</a></li>
      </ul>
    </nav>
    <button id="open-mob-menu" onclick="toggleMenu()">
      <span></span>
      <span></span>
      <span></span>
    </button>
  </div>
</header>