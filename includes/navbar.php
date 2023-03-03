 <!-- top navigation bar -->
 <?php require_once "classes/variables.php";
$var =  new Variables();
 ?>
 <nav class="navbar navbar-expand-lg navbar-dark bg-success fixed-top">
      <div class="container-fluid">
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="offcanvas"
          data-bs-target="#sidebar"
          aria-controls="offcanvasExample"
        >
          <span class="navbar-toggler-icon" data-bs-target="#sidebar"></span>
        </button>
        <a
          class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold"
          href="dashboard.php"
          >Farm Record</a
        >
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#topNavBar"
          aria-controls="topNavBar"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="topNavBar">
          <form class="d-flex ms-auto my-3 my-lg-0">
            <!--div class="input-group">
              <input
                class="form-control"
                type="search"
                placeholder="Search"
                aria-label="Search"
              />
              <button class="btn btn-primary" type="submit">
                <i class="bi bi-search"></i>
              </button>
            </div-->
          </form>
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle ms-2"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <i class="bi bi-person-fill"></i>
                <?php echo $_SESSION['username']; ?>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#change-pass">Change Password</a></li>
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#recovery-modal">Change Recovery Key</a></li>
                <li>
                  <a class="dropdown-item" href="#"data-bs-toggle="modal" data-bs-target="#logoutModal" >Log out</a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <?php include("modal/change_pass_modal.php");
          include("modal/change_recovery_modal.php");
      ?>
    <!-- top navigation bar -->
  <!-- Modal -->
<div class="modal fade" id="logoutModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header ">
        <h5 class="modal-title" id="staticBackdropLabel">Sign Out</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          Want to Logout?
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
        <form action="logout.php" method="post">
            <div class="d-grid">
              <button class="btn btn-primary btn-login text-uppercase fw-bold" name="logout" type="submit">Sign Out</button>
            </div>
          </form>
      </div>
    </div>
  </div>
</div>