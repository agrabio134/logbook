<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

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
    echo "<h3>Name: $fname </h3>";
    echo "<h3>Last Name: $lname </h3>";
    ?>
    <!-- add logout method post-->
    <form action="../server/api/logout" method="post">
        <button type="submit">Logout</button>
    </form>



    <!-- create form for log -->
    <form action="../server/api/create_log" method="post">
        <input type="text" name="item_no" placeholder="item no">
        <input type="text" name="fault_code" placeholder="fault code">
        <input type="text" name="fault_desc" placeholder="fault desc">
        <input type="text" name="transfer_to_do_s_no" placeholder="transfer to do no">
        <input type="text" name="mel_no" placeholder="mel no">
    <select name="cat" id="cat">
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="C">D</option>
    </select>
        <input type="text" name="action_taken" placeholder="action taken">
        <button type="submit">Create log</button>
    </form>

    <!-- create table for logs -->
    <table>
        <tr>
            <th>Item No</th>
            <th>Fault Code</th>
            <th>Fault Desc</th>
            <th>Transfer to DO No</th>
            <th>MEL No</th>
            <th>CAT</th>
            <th>Action Taken</th>
            <th>Created At</th>
            <th>Actions</th>
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
            echo "<td>" . $log['transfer_to_do_s_no'] . "</td>";
            echo "<td>" . $log['mel_no'] . "</td>";
            echo "<td>" . $log['cat'] . "</td>";
            echo "<td>" . $log['action_taken'] . "</td>";
            // echo "<td>" . $log['created_at'] . "</td>";
            echo "<td>" . $log['updated_at'] . "</td>";
            echo "<td><a href='edit.php?id=" . $log['log_id'] . "'>Edit</a> | <a href='print.php?id=" . $log['log_id'] . "'>Print</a></td>";
            echo "</tr>";
        }
        ?>



</body>

</html>