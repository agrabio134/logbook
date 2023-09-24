<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Preview Summary</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">

    <link rel="stylesheet" type="text/css" href="css/print.css" media="print">
</head>
<style>
    td.editable {
        cursor: pointer;
    }

    td.editable:hover {
        background-color: lightgray;
    }

    /* .save-button {
            display: none;
        } */
</style>

<body>


    <!-- Add your form here -->

    <div class="hidePrint">

        <!-- <form action="../server/api/add_detail" method="post">
            <div>
                <h3>Arrival Fuel (LBS)</h3>
                <input type="text" name="arr_fuel_lh" placeholder="LH">
                <input type="text" name="arr_fuel_ctr" placeholder="Ctr">
                <input type="text" name="arr_fuel_rh" placeholder="RH">
            </div>
            <br>
            <div>
                <h3>TIRE PRESSURE (PSI)</h3>
                  <input type="radio" name="tire_pressure" value="hot">
                <label for="hot">Hot</label>
                  <input type="radio" name="tire_pressure" value="cold">
                  <label for="cold">Cold</label><br>
            </div>
            <br>
            <div>
                <h>NOSE &nbsp &nbsp</h>
                <input type="text" name="nose_lh" placeholder="LH">
                <input type="text" name="nose_rh" placeholder="RH">
            </div>
            <br>
            <div>
                <h>LH MAIN</h>
                <input type="text" name="lh_main_inbd" placeholder="INBD">
                <input type="text" name="lh_main_outbd" placeholder="OUTBD">
            </div>
            <br>
            <div>
                <h>RH MAIN</h>
                <input type="text" name="rh_main_inbd" placeholder="INBD">
                <input type="text" name="rh_main_outbd" placeholder="OUTBD">
            </div>
            <input type="submit" value="Submit">


        </form> -->
        <!-- Content for the print preview summary -->
        <h1>Print Preview Summary</h1>
        <button class="printBtn" type="button" onclick="window.print()">Print</button>
    </div>


    <h3><b>flyseair.com</b></h3>
    <h3>TECHNICAL LOG</h3>
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
            echo "<td>" . $log['mel_item_no'] . "</td>";
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

        <thead>
            <div id="add_head"></div>
            <!-- <tr>
            <th colspan="3">Arrival Fuel (LBS)</th>
            <th>Tire Pressure (PSI)</th>
            <th colspan="2">NOSE</th>
            <th colspan="2">LH MAIN</th>
            <th colspan="2">RH MAIN</th>
        </tr> -->
            <tr>
                <th id="arrival_fuel_lh">LH</th>
                <th id="arrival_fuel_ctr">Ctr</th>
                <th id="arrival_fuel_rh">RH</th>
                <th id="tire_pressure">( Hot | Cold )</th>
                <th id="nose_lh">LH</th>
                <th id="nose_rh">RH</th>
                <th id="lh_main_inbd">INBD</th>
                <th id="lh_main_outbd">OUTBD</th>
                <th id="rh_main_inbd">INBD</th>
                <th id="rh_main_outbd">OUTBD</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // get all Sum
            $url = "http://localhost/logbook/server/api/get_summary";
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            $summ = json_decode($result, true);
            curl_close($ch);

            // loop through logs
            foreach ($summ['payload'] as $sum) {
                echo "<tr>";
                echo "<td class='editable' contenteditable='true'>" . $sum['arrival_fuel_lh'] . "</td>";
                echo "<td class='editable' contenteditable='true'>" . $sum['arrival_fuel_ctr'] . "</td>";
                echo "<td class='editable' contenteditable='true'>" . $sum['arrival_fuel_rh'] . "</td>";
                echo "<td class='editable' contenteditable='true'>" . $sum['tire_pressure'] . "</td>";
                echo "<td class='editable' contenteditable='true'>" . $sum['nose_lh'] . "</td>";
                echo "<td class='editable' contenteditable='true'>" . $sum['nose_rh'] . "</td>";
                echo "<td class='editable' contenteditable='true'>" . $sum['lh_main_inbd'] . "</td>";
                echo "<td class='editable' contenteditable='true'>" . $sum['lh_main_outbd'] . "</td>";
                echo "<td class='editable' contenteditable='true'>" . $sum['rh_main_inbd'] . "</td>";
                echo "<td class='editable' contenteditable='true'>" . $sum['rh_main_outbd'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>

    </table>
    <button class="save-button" onclick="saveData()">Save Changes</button>



    <script>
        let editedCells = [];
        const saveButton = document.querySelector('.save-button');

        function toggleSaveButton() {
            saveButton.style.display = editedCells.length > 0 ? 'block' : 'none';
        }
        const saveData = () => {
            const dynamicHeaderRow = document.getElementById("dynamicHeaderRow");
            if (dynamicHeaderRow) {
                dynamicHeaderRow.remove();
            }

            // if one cell is empty alert
            // if (editedCells.length === 0) {
            //     alert("Please fill up all fields.");
            //     return;
            // }



            if (editedCells.length === 0) {
                alert("Please fill up all fields.");
                return;
            }

            const editedData = {};

            editedCells.forEach(cell => {
                const column = cell.cellIndex; // Get the column index
                const row = cell.parentElement.rowIndex - 1; // Subtract 1 for the header row
                const table = cell.closest('table');
                // const columnName = table.rows[0].cells[column].textContent; // Get the column name from the header row
                const columnId = table.rows[0].cells[column].id; // Get the "id" attribute of the column

                if (!editedData[row]) {
                    editedData[row] = {};
                }

                // editedData[row].columnName = columnName;
                // editedData[row].columnId = columnId;
                editedData[columnId] = cell.textContent; // Use "columnId" as the key in the edited data
            });


            const editedDataJson = JSON.stringify(editedData);
            console.log(editedDataJson);
            //make editedData an json
            // console.log(editedData);





            // Send the edited data to the server using a POST request
            fetch('../server/api/update_detail', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(editedData),

                })


                // Handle the response

                .then(response => {
                    if (response.ok) {
                        console.log('Data saved successfully');
                        editedCells = [];
                        console.log(editedCells);



                        toggleSaveButton();
                        alert("Data saved successfully");
                        window.location.reload();
                    } else {
                        console.error('Failed to save data');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        document.querySelectorAll('.editable').forEach(cell => {
            cell.addEventListener('input', () => {
                if (!editedCells.includes(cell)) {
                    editedCells.push(cell);
                }
                toggleSaveButton();
            });
        });
        // Create a new table row (<tr>) element
        const newRow = document.createElement("tr");
        newRow.id = "dynamicHeaderRow"; // Assign an ID to the row


        // Add the desired table header cells (<th>) to the new row
        newRow.innerHTML = `
    <th colspan="3">Arrival Fuel (LBS)</th>
    <th>Tire Pressure (PSI)</th>
    <th colspan="2">NOSE</th>
    <th colspan="2">LH MAIN</th>
    <th colspan="2">RH MAIN</th>

    </tr>
`;

        // Find the table's <thead> element and append the new row to it
        const thead = document.querySelector("table thead");
        thead.appendChild(newRow);

        const currentRow = thead.querySelector("tr");

        // Insert the new row before the current row
        thead.insertBefore(newRow, currentRow);
    </script>
</body>

</html>