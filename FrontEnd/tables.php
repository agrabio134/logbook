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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="css/tables.css">
</head>
<style>
  .input-head {
    display: flex;
    justify-content: space-around;


  }
  .printPrv {
    width: 400px;
    padding-top: 15px;
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
          <a class="nav-link text-white   active bg-gradient-primary" disable>
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
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Table</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Table</h6>
        </nav>
      </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="card">





          <!-- TABLE HERE  -->
          <div class="input-head">

            <a class="printPrv" href="print_summary.php" target="_blank">Print Preview Summary</a>

            <input type="text" class="form-control" id="tableSearch" placeholder="Search...">
          </div>

          <!-- create table for logs -->

          <table class="styled-table" id="logTable">
            <thead>
              <tr>
                <th colspan="3" class="centered-header with-line">DEFECT</th>
                <th colspan="7" class="centered-header with-line">ACTION TAKEN</th>
              </tr>
              <tr>



                <th>Item No.</th>
                <th>Fault Code</th>
                <th class="with-line">Fault Desc</th>

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
              $url = "http://localhost/logbook/server/api/get_logs";
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

                // Make "Fault Desc" cell fixed with a height of 100px and vertical scrolling
                echo "<td>";
                echo "<div style='max-width: 150px; height: 70px; overflow-y: auto;'>" . $log['fault_desc'] . "</div>";
                echo "</td>";


                echo "<td>" . $log['item_no'] . "</td>";
                echo "<td>" . $log['transfer_to_do_s_no'] . "</td>";
                echo "<td>" . $log['mel_item_no'] . "</td>";
                echo "<td class='cat-cell'>" . $log['cat'] . "</td>";

                // Make "Action Description" cell fixed with a height of 100px and vertical scrolling
                echo "<td>";
                echo "<div style='max-width: 150px; height: 70px; overflow-y: auto;'>" . $log['action_taken'] . "</div>";
                echo "</td>";

                echo "<td class='hidePrint'>" . $log['updated_at'] . "</td>";
                echo "<td class='hidePrint'>";
                echo "<button type='button' class='btn btn-danger' data-log-id='" . $log['log_id'] . "' onclick='if(confirm(`Are you sure you want to archive this log with ID " . $log['log_id'] . "?`)) window.location.href=`../server/api/archive?id=" . $log['log_id'] . "`;'>Archive</button>";

                // Add a space between buttons
                echo "&nbsp; &nbsp;";

                echo "<button type='button' class='btn btn-warning editButton' id='editButton'
          data-log-id='" . $log['log_id'] . "'
          data-toggle='modal' data-target='#editModal'
          >Edit</button>";


                echo "</td>";
                echo "</tr>";
              }
              ?>
            </tbody>

          </table>


        </div>


      </div>
    </div>
    </div>
    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title centered-header" id="editModalLabel">EDIT DATA</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">


            <!-- Form fields here -->
            <div class="form-container">

              <?php

              ?>
              <form action="../server/api/update_log" method="post">
                <div class="form-section">
                  <h3>DEFECT</h3>
                  <div class="form-row">
                    <div class="form-field">
                      <!-- <label for="log_id">Log Id:</label> -->
                      <input type="number" name="log_id" id="log_id" hidden>
                      <label for="item_no">Item Number:</label>
                      <!-- <input type="number" name="item_no" id="item_no" disabled> -->
                      <input type="number" name="item_no" id="item_no">
                    </div>
                    <div class="form-field">
                      <label for="fault_code">Fault Code:&nbsp&nbsp&nbsp&nbsp</label>
                      <input type="text" name="fault_code" id="fault_code">
                    </div>
                  </div>
                  <div class="break"></div>
                  <div class="form-row">
                    <div class="form-field">
                      <label for="fault_desc">Fault Description:</label>
                      <textarea name="fault_desc" placeholder="Fault Description" id="fault_desc" cols="50"></textarea>
                    </div>
                  </div>
                </div>
                <div class="form-section">
                  <h3>ACTION TAKEN</h3>
                  <div class="form-row">
                    <div class="form-field">
                      <label for="transfer_to_do_s_no">Transfer to DO S/No:</label>
                      <input type="text" name="transfer_to_do_s_no" id="edit_item_no_action" placeholder="Item">
                    </div>
                    <div class="form-field">
                      <label for="mel_item_no">MEL Item No.:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                      <input type="text" name="mel_item_no" id="edit_mel_item_no" placeholder="Code">
                    </div>
                    <div class="form-field">
                      <label for="cat">Category:</label>
                      <select class="form-field" name="cat" id="edit_cat">
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                      </select>
                    </div>
                  </div>
                  <br>
                  <div class="break"></div>
                  <div class="form-field">
                    <label for="action_taken">Description:</label>
                    <textarea name="action_taken" placeholder="Description" id="edit_action_taken" cols="50"></textarea>
                  </div>
                </div>
                <!-- <button style=" background-color: #e91e63; " type="submit">Create log</button> -->
                <!-- End form fields -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" id="saveChangesButton">Save changes</button>
            </div>
            </form>


          </div>
        </div>
      </div>
  </main>
  <script>
    $('.editButton').click(function() {
      let logIdToEdit = $(this).data('log-id');

      $('#loginInput').val(logIdToEdit);
      console.log("Log ID to edit: " + logIdToEdit);

      // Get log data from server

      // get payload
      let url = "http://localhost/logbook/server/api/get_log_by_id?id=" + logIdToEdit;

      fetch(url)
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }
          return response.json();
        })
        .then(log => {
          console.log(log);
          // put data into form fields add loading animation
          $('#log_id').val(log.payload[0].log_id);

          $('#item_no').val(log.payload[0].item_no);
          $('#fault_code').val(log.payload[0].fault_code);
          $('#fault_desc').val(log.payload[0].fault_desc);
          $('#edit_item_no_action').val(log.payload[0].item_no);
          $('#edit_mel_item_no').val(log.payload[0].mel_item_no);
          $('#edit_cat').val(log.payload[0].cat);
          $('#edit_action_taken').val(log.payload[0].action_taken);


        })
        .catch(error => {
          // Handle errors here
          console.error('There was a problem with the fetch operation:', error);
        });


      // console.log(log);


    });

    $(document).ready(function() {
      $("#tableSearch").on("keyup", function() {
        var searchText = $(this).val().toLowerCase();
        $("#logTable tbody tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(searchText) > -1);
        });
      });
    });
  </script>


  <script async defer src="https://buttons.github.io/buttons.js"></script>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>

</html>