<nav class="navbar navbar-expand-lg bg-light border-bottom border-body sticky-top" data-bs-theme="light">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
      aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index.php">
            <h4>Home</h4>
          </a>
        </li>
        <?php if ($_SESSION["login"] == true) { ?>
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=buchung">
              <h4>Neue Reservierung</h4>
            </a>
          </li>
        <?php } else { ?>
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=registrierungsformular">
              <h4>Registrierung</h4>
            </a>
          </li>
        <?php } ?>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index.php?page=news">
            <h4>News</h4>
          </a>
        </li>
        <?php if ($_SESSION["admin"] == true) { ?>
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=newsupload">
              <h4>Upload</h4>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=userverwaltung">
              <h4>User</h4>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=reservierungsverwaltung">
              <h4>Reservierungen</h4>
            </a>
          </li>
        <?php } ?>
      </ul>
      <ul class="navbar-nav ms-auto">
        <?php if ($_SESSION["login"] == true) { ?>
          <li class="nav-item">
            <a class="nav-link " href="index.php?page=account">
              <h4>Profil</h4>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="utils/logout.php">
              <h4>Logout</h4>
            </a>
          </li>
        <?php } else { ?>
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=loginformular">
              <h4>Login</h4>
            </a>
          </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</nav>