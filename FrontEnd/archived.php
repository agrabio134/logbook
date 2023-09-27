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
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <!-- jquery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="css/tables.css">
</head>

<style>
  .input-head {
    width: 300px;
    /* float: right; */


  }


  .form-control {
    /* width: 400px; */
    margin-top: 20px;
  }

  /* Style for the search input */

  #tableSearch {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 16px;
  }

  /* Optional: Add additional styles for better visual appeal */
  #tableSearch:focus {
    outline: none;
    border-color: #007bff;
    /* Change focus border color */
    box-shadow: 0 0 5px #007bff;
    /* Add a box shadow when focused */
  }
</style>

<body class="g-sidenav-show  bg-gray-200">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
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
          <a class="nav-link text-white" href="./index.php">
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
          <a class="nav-link text-white active bg-gradient-primary" disable>
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
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Bin</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Recycle Bin</h6>
        </nav>
      </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="card">





          <!-- TABLE HERE  -->
          <!-- Table for archived logs goes here -->
          <div class="input-head">


            <input type="text" class="form-control" id="tableSearch" placeholder="Search...">
          </div>
          <table class="styled-table" id="logTable">
            <thead>
            <tr>
              <th colspan="3" class="centered-header with-line">DEFECT</th>
              <th colspan="7" class="centered-header with-line">ACTION TAKEN</th>

            </tr>
            <tr>
              <th>Item No.</th>
              <th>Fault Code</th>
              <th>Fault Desc</th>
              <!-- <th class="hidePrint">Created At</th> -->

              <th>Item No.</th>
              <th>Transfer to DO S/No.</th>
              <th>MEL Item No.</th>
              <th>CAT</th>
              <th>Action Description</th>
              <th class="hidePrint">Created At</th>
              <th class="hidePrint">Actions</th>

            </tr>

            </thead>
            <tbody>
            <?php
            // get all logs
            $url = "http://localhost/logbook/server/api/get_archived_logs";
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            $logs = json_decode($result, true);
            curl_close($ch);

            // loop through logs
            foreach ($logs['payload'] as $log) {
              echo "<tr>";
              echo "<td>" . $log['item_no'] . "</td>";
              echo "<td>" . $log['fault_code'] . "</td>";
              echo "<td>";
              echo "<div style='max-width: 150px; height: 70px; overflow-y: auto;'>" . $log['fault_desc'] . "</div>";
              echo "</td>";
              // echo "<td class='hidePrint'>" . $log['updated_at'] . "</td>";

              echo "<td>" . $log['item_no'] . "</td>";
              echo "<td>" . $log['transfer_to_do_s_no'] . "</td>";
              echo "<td>" . $log['mel_item_no'] . "</td>";
              echo "<td>" . $log['cat'] . "</td>";
              echo "<td>";
              echo "<div style='max-width: 150px; height: 70px; overflow-y: auto;'>" . $log['action_taken'] . "</div>";
              echo "</td>";
              echo "<td class='hidePrint'>" . $log['updated_at'] . "</td>";
              echo "<td class='hidePrint'>";
              echo "<button type='button' class='btn btn-success' data-log-id='" . $log['log_id'] . "' onclick='if(confirm(`Are you sure you want to retrieve this log with ID " . $log['log_id'] . "?`)) window.location.href=`../server/api/retrieve?id=" . $log['log_id'] . "`;'>Retrieve</button>";
              echo "</td>";
              echo "</tr>";
            }
            ?>
            </tbody>

          </table>



        </div>
      </div>
    </div>
  </main>

  <script>
    let win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      let options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }

    $(document).ready(function() {
      $("#tableSearch").on("keyup", function() {
        let searchText = $(this).val().toLowerCase();
        $("#logTable tbody tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(searchText) > -1);
        });
      });
    });
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-dashboard.min.js?v=3.1.0"></script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>