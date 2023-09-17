<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/print.css" media="print">

    <title>Document</title>
</head>
<style>
    /* Modal styles */
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
}

.modal-content {
    background-color: #fff;
    margin: 10% auto;
    padding: 20px;
    border-radius: 5px;
    width: 80%;
    max-width: 800px;
    position: relative;
}

.close {
    position: absolute;
    top: 0;
    right: 0;
    padding: 10px;
    cursor: pointer;
}

</style>
<body>

    <!-- session user -->
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

    <div class="hidePrint">
        <!-- add logout method post-->
    <form class="logoutBg"action="../server/api/logout" method="post">
        <div class="button-container">
        <!-- <span class="adminName"><?php echo "$fname $lname"; ?></span> -->
          <button class="logoutBtn" type="submit">Logout, <?php echo "$fname $lname"; ?></button>
        </div>
    </form>

      

        <!-- create form for log -->
        <form action="../server/api/create_log" method="post">
        
            <div>
                <h3>DEFECT</h3>
                <input type="text" name="user_id" value="<?php echo "$user_id"; ?>" hidden>
                <label for="Item Number">Item Number:&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp</label>
                <input type="text" name="item_no" placeholder="Item number" required>
                &nbsp &nbsp<label for="Fault Code">Fault Code:</label>
                <input type="text" name="fault_code" placeholder="Fault Code">
                &nbsp &nbsp <label for="Fault Description">Fault Description:</label>
                <input type="text" name="fault_desc" placeholder="Fault Description">
            </div>
            <div>
                <h3>ACTION TAKEN</h3>
                <label for="Transfer to DO S/No">Transfer to DO S/No:</label>
                <input type="text" name="transfer_to_do_s_no" placeholder="Transfer to DO S/No">
                &nbsp &nbsp<label for="MEL Item No">MEL Item No:</label>
                <input type="text" name="mel_item_no" placeholder="MEL Item No">
                &nbsp &nbsp<label for="Action Description">Action Description:</label>
                <input type="text" name="action_taken" placeholder="Description">
                &nbsp &nbsp <label for="CAT">Category:</label>

                <select name="cat" id="cat">
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="C">D</option>
                </select>
            </div>

            <!-- <input type="text" name="action_taken" placeholder="action taken"> -->
            <button type="submit">Create log</button>
        </form>




        <a class="printPrv" href="print_summary.php" target="_blank">Print Preview Summary</a>
    </div>

<!-- Button to open the modal -->
<button  id="openModalBtn">Open Trash Bin</button>

<!-- The Modal -->
<div id="trashBinModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Trash Bin</h2>
        <!-- Table for archived logs goes here -->
        <table>
        <tr>
            <th colspan="3">DEFECT</th>
            <th colspan="7">ACTION TAKEN</th>

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
            echo "<td>" . $log['fault_desc'] . "</td>";
            // echo "<td class='hidePrint'>" . $log['updated_at'] . "</td>";

            echo "<td>" . $log['item_no'] . "</td>";
            echo "<td>" . $log['transfer_to_do_s_no'] . "</td>";
            echo "<td>" . $log['mel_item_no'] . "</td>";
            echo "<td>" . $log['cat'] . "</td>";
            echo "<td>" . $log['action_taken'] . "</td>";
            echo "<td class='hidePrint'>" . $log['updated_at'] . "</td>";
            echo "<td class='hidePrint'>";
            echo "<a href='../server/api/retrieve?id=" . $log['log_id'] . "' class='retireve-button' data-log-id='" . $log['log_id'] . "'>Retrieve</a>";
            echo "</td>";
            echo "</tr>";
        }
        ?>

    </table>

    </div>
</div>

    <!-- create table for logs -->
    <table>
        <tr>
            <th colspan="3">DEFECT</th>
            <th colspan="7">ACTION TAKEN</th>

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
            echo "<td>" . $log['fault_desc'] . "</td>";
            // echo "<td class='hidePrint'>" . $log['updated_at'] . "</td>";

            echo "<td>" . $log['item_no'] . "</td>";
            echo "<td>" . $log['transfer_to_do_s_no'] . "</td>";
            echo "<td>" . $log['mel_item_no'] . "</td>";
            echo "<td>" . $log['cat'] . "</td>";
            echo "<td>" . $log['action_taken'] . "</td>";
            echo "<td class='hidePrint'>" . $log['updated_at'] . "</td>";
            echo "<td class='hidePrint'>";
            echo "<a href='../server/api/archive?id=" . $log['log_id'] . "' class='archive-button' data-log-id='" . $log['log_id'] . "'>Archive</a>";
            echo "</td>";
            echo "</tr>";
        }
        ?>

    </table>

        
</body>

</html>

<!-- Add this JavaScript function to the HTML -->
<script>
    const printPage = () => {
        window.print(); // Trigger the browser's print dialog
    }

    // Get all elements with the class 'archive-button'
    const archiveButtons = document.querySelectorAll('.archive-button');

    // Attach a click event listener to each 'Archive' button
    archiveButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default link behavior

            // Get the log_id from the 'data-log-id' attribute
            const logId = this.getAttribute('data-log-id');

            // Show a confirmation dialog
            const confirmed = confirm('Are you sure you want to archive this log entry?');

            // If the user confirms, proceed with the archive action
            if (confirmed) {
                window.location.href = `../server/api/archive?id=${logId}`;
            }
        });
    });

     const retrieveButtons = document.querySelectorAll('.retireve-button');

    // Attach a click event listener to each 'Archive' button
    retrieveButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default link behavior

            // Get the log_id from the 'data-log-id' attribute
            const logId = this.getAttribute('data-log-id');

            // Show a confirmation dialog
            const confirmed = confirm('Are you sure you want to Retrieve this log entry?');

            // If the user confirms, proceed with the archive action
            if (confirmed) {
                window.location.href = `../server/api/retrieve?id=${logId}`;
            }
        });
    });


    

   // Get the modal and close button by ID
const modal = document.getElementById('trashBinModal');
const openModalBtn = document.getElementById('openModalBtn');
const closeBtn = document.querySelector('.close');

// Function to open the modal
const openModal = () => {
    modal.style.display = 'block';
};

// Function to close the modal
const closeModal = () => {
    modal.style.display = 'none';
};

openModalBtn.addEventListener('click', openModal);

closeBtn.addEventListener('click', closeModal);

window.addEventListener('click', (event) => {
    if (event.target === modal) {
        closeModal();
    }
});


// Call the fetchArchivedLogs function when the modal is opened
openModalBtn.addEventListener('click', () => {
    openModal();
});


</script>