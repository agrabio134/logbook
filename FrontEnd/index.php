<?php

session_start();


// if not logged in redirect to login page
if (!isset($_SESSION['users_id'])) {
  header("Location: http://localhost/logbook/frontend/login.php");
  exit;
}
$user_id = $_SESSION['users_id'];
$fname = $_SESSION['fname'];
$lname = $_SESSION['lname'];
// echo "<h3>Admin: $fname $lname</h3>";

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <title>
    Logbook
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css"
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="css/form.css">
</head>

<body class="g-sidenav-show  bg-gray-200">
  <aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
    id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
        aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="#" target="_blank">
        <img src="assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white">Logbook</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <!-- Add profile -->
        <li class="nav-item">
          <a class="nav-link text-white" href="./profile.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">person</i>
            </div>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>
        <!-- end -->


        <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-primary" disable>
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Create Log</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="./tables.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Tables</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="./archived.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">receipt_long</i>
            </div>
            <span class="nav-link-text ms-1">Recycle Bin</span>
          </a>
        </li>
      </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
      <div class="mx-3">

        <form class="logoutBg" action="../server/api/logout" method="post">
          <div class="button-container">
            <!-- <span class="adminName"><?php echo "$fname $lname"; ?></span> -->
            <button class="btn bg-gradient-primary w-100" type="submit">Logout</button>
          </div>
        </form>
      </div>
    </div>
  </aside>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
      data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Create log</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Create log</h6>
        </nav>
      </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="card">

          <div class="form-container">
            <form action="../server/api/create_log" method="post">
              <div class="form-section">
              <h3 class="centered-heading">DEFECT</h3>
                <div class="form-row">
                  <div class="form-field">
                    <label for="item_no">Item Number:</label>
                    <input type="number" name="item_no" placeholder="Item number" required>
                  </div>
                  <div class="form-field">
                    <label for="fault_code">Fault Code:</label>
                    <input type="text" name="fault_code" placeholder="Fault Code">
                  </div>
                </div>
                <div class="break"></div>
                <div class="form-row">
                  <div class="form-field">
                    <label for="fault_desc">Fault Description:</label>
                    <textarea name="fault_desc" placeholder="Fault Description" cols="50"></textarea>
                  </div>

                </div>
              </div>
              <div class="form-section">
              <h3 class="centered-heading">ACTION TAKEN</h3>
                <div class="form-row">
                  <!-- <div class="form-field">
                    <label for="#">Item Number:</label>
                    <input type="text" name="#" placeholder="Item Number">
                  </div> -->
                  <div class="form-field">
                    <label for="transfer_to_do_s_no">Transfer to DO S/No:</label>
                    <input type="number" name="transfer_to_do_s_no" placeholder="Item">
                  </div>
                  <div class="form-field">
                    <label for="mel_item_no">MEL Item No.:</label>
                    <input type="number" name="mel_item_no" placeholder="Code">
                  </div>
                  <div class="form-field">
                    <label for="cat">Category:</label>
                    <select class="form-field" name="cat" id="cat">
                      <option value="A">A</option>
                      <option value="B">B</option>
                      <option value="C">C</option>
                      <option value="D">D</option>
                    </select>
                  </div>
                  <br>
                  <div class="break"></div>
                  <div class="form-field">
                    <label for="action_taken">Description::</label>
            
                    <textarea name="action_taken" placeholder="Description" cols="50"></textarea>
                  </div>
                </div>
              </div>
              <button style=" background-color: #e91e63; " type="submit">Create log</button>
            </form>

          </div>






        </div>
      </div>
    </div>
  </main>

  <!--   Core JS Files   -->
  <!-- <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="assets/js/plugins/chartjs.min.js"></script>
  -->
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-dashboard.min.js?v=3.1.0"></script>
</body>

</html>