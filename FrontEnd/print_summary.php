<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Preview Summary</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">

    <link rel="stylesheet" type="text/css" href="css/print.css" media="print">
</head>

<body>


    <!-- Add your form here -->

    <div class="hidePrint">

        <form action="">
            <div>
                <h3>Arrival Fuel (LBS)</h3>
                <input type="text" name="#" placeholder="LH">
                <input type="text" name="#" placeholder="Ctr">
                <input type="text" name="#" placeholder="RH">
            </div>
            <div>
                <h3>TIRE PRESSURE (PSI)</h3>
                  <input type="radio" name="#" value="hot">
                <label for="hot">Hot</label>
                  <input type="radio" name="#" value="cold">
                  <label for="cold">Cold</label><br>
            </div>
            <div>
                <h>NOSE</h>
                <input type="text" name="#" placeholder="LH">
                <input type="text" name="#" placeholder="RH">
            </div>
            <div>
                <h>LH MAIN</h>
                <input type="text" name="#" placeholder="INBD">
                <input type="text" name="#" placeholder="OUTBD">
            </div>
            <div>
                <h>RH MAIN</h>
                <input type="text" name="#" placeholder="INBD">
                <input type="text" name="#" placeholder="OUTBD">
            </div>
            <input type="submit" value="Submit">


        </form>
        <!-- Content for the print preview summary -->
        <h1>Print Preview Summary</h1>
        <button type="button" onclick="window.print()">Print</button>
    </div>

    <table>
        <tr>
            <th colspan="3">DEFECT</th>
            <th colspan="6">ACTION TAKEN</th>

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
            <th class="showPrint">Signature</th>
            <!-- <th class="hidePrint">Actions</th> -->

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
            echo "<td>" . $log['mel_no'] . "</td>";
            echo "<td>" . $log['cat'] . "</td>";
            echo "<td>" . $log['action_taken'] . "</td>";
            echo "<td class='hidePrint'>" . $log['updated_at'] . "</td>";
            echo "<td class='showPrint' > </td>";
            // echo "<td class='hidePrint'><a href='edit.php?id=" . $log['log_id'] . "'>Edit</a> ";
            echo "</tr>";
        }
        ?>

    </table>



    <table>
        <tr>
            <th>Arrival Fuel (LBS)</th>
            <th>TIRE PRESSURE (PSI)</th>
            <th>NOSE</th>
            <th>LH MAIN</th>
            <th>RH MAIN</th>
        </tr>

        <tr>
            <td>SAMPLE DATA</td>
            <td>SAMPLE DATA</td>
            <td>SAMPLE DATA</td>
            <td>SAMPLE DATA</td>
            <td>SAMPLE DATA</td>

        </tr>

        <tr>
            <td>SAMPLE DATA</td>
            <td>SAMPLE DATA</td>
            <td>SAMPLE DATA</td>
            <td>SAMPLE DATA</td>
            <td>SAMPLE DATA</td>

        </tr>

    </table>






</body>

</html>