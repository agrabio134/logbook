<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Preview Summary</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <!-- <link rel="stylesheet" type="text/css" href="css/print.css" media="print"> -->
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

    @media print {

        /* Hide elements you don't want to print */
        .hidePrint {
            display: none;
        }

        /* Show only specific elements for printing */
        .showPrint {
            display: block !important;
        }
    }
</style>

<body>
    <!-- Add your form here -->
    <div class="brand" style="text-align: center;">
        <h3 style="font-weight: bold; font-size: 40px; color: gray; margin-bottom: 0;">
            <img src="css/cropped-flyseair-free.png" alt="Company Logo" style="height: 40px; margin-right: 5px;">
            <b>fly<span style="color: black;">seair</span>.com</b>
        </h3>
        <h3 style="font-size: 45px; margin-top: 5px; font-family: 'Roboto', sans-serif; text-align: center; text-transform: uppercase;">
            TECHNICAL LOG
        </h3>
    </div>

    <!--  -->
    <div class="hidePrint">


        <h1>Print Preview Summary</h1>

        <button style="background-color: #e91e63;" class="printPrv" type="button" onclick="printTables()">Print</button>
    </div>
    <table>
        <tr>
            <th id="flight_no">Flight Number</th>
            <th id="date">Date</th>
            <th id="serial_no">Serial Number</th>
            <th id="to_start">To</th>
            <th id="from_end">From</th>
            <th id="chock_on_z">Chock ON (Z)</th>
            <th id="chock_off_z">Chock OFF (Z)</th>
            <th id="landing_z">Landing (Z)</th>
            <th id="take_off_z">Take-Off (Z)</th>
            <th id="flight_time">Flight Time</th>
            <th id="touch_and_go">Touch and Go</th>
            <th id="total_time">Total Time</th>
        </tr>
        <tbody>
            <?php
            // get all Sum
            $url = "http://localhost/logbook/server/api/get_flights";
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            $flight = json_decode($result, true);
            curl_close($ch);

            // loop through logs
            foreach ($flight['payload'] as $sum) {
                echo "<tr>";
                echo "<td class='editable' contenteditable='true'>" . $sum['flight_no'] . "</td>";
                echo "<td class='editable' contenteditable='true'>" . $sum['date'] . "</td>";
                echo "<td class='editable' contenteditable='true'>" . $sum['serial_no'] . "</td>";
                echo "<td class='editable' contenteditable='true'>" . $sum['to_start'] . "</td>";
                echo "<td class='editable' contenteditable='true'>" . $sum['from_end'] . "</td>";
                echo "<td class='editable' contenteditable='true'>" . $sum['chock_on_z'] . "</td>";
                echo "<td class='editable' contenteditable='true'>" . $sum['chock_off_z'] . "</td>";
                echo "<td class='editable' contenteditable='true'>" . $sum['landing_z'] . "</td>";
                echo "<td class='editable' contenteditable='true'>" . $sum['take_off_z'] . "</td>";
                echo "<td class='editable' contenteditable='true'>" . $sum['flight_time'] . "</td>";
                echo "<td class='editable' contenteditable='true'>" . $sum['touch_and_go'] . "</td>";
                echo "<td class='editable' contenteditable='true'>" . $sum['total_time'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <table>
        <tr>
            <th colspan="3">DEFECT</th>
            <th colspan="6">ACTION TAKEN</th>
        </tr>
        <tr>
            <th>Item No.</th>
            <th>Fault Code</th>
            <th>Fault Desc</th>
            <th>Item No.</th>
            <th>Transfer to DO S/No.</th>
            <th>MEL Item No.</th>
            <th>CAT</th>
            <th>Action Description</th>
            <th class="hidePrint">Created At</th>
            <th class="showPrint">Signature</th>
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
            echo "<td>";
            echo "<div style='max-width: 150px; overflow-y: auto;'>" . $log['fault_desc'] . "</div>";
            echo "</td>";
            echo "<td>" . $log['item_no'] . "</td>";
            echo "<td>" . $log['transfer_to_do_s_no'] . "</td>";
            echo "<td>" . $log['mel_item_no'] . "</td>";
            echo "<td>" . $log['cat'] . "</td>";
            echo "<td>";
            echo "<div style='max-width: 150px;  overflow-y: auto;'>" . $log['action_taken'] . "</div>";
            echo "</td>";
            echo "<td class='hidePrint'>" . $log['updated_at'] . "</td>";
            echo "<td class='showPrint' > </td>";
            echo "</tr>";
        }
        ?>
    </table>
    <table>
        <thead>
            <div id="add_head"></div>
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
    <div class="hidePrint">
        <button style="background-color: #e91e63;" class="save-button printBtn" onclick="saveData()">Save Changes</button>
    </div>
    <script>
        function printTables() {
            window.print();
        }

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

            if (editedCells.length === 0) {
                alert("Please fill up all fields.");
                return;
            }

            const editedData = {};

            editedCells.forEach(cell => {
                const column = cell.cellIndex;
                const row = cell.parentElement.rowIndex - 1;

                const table = cell.closest('table');
                const columnId = table.rows[0].cells[column].id;

                if (!editedData[row]) {
                    editedData[row] = {};
                }

                editedData[columnId] = cell.textContent;
            });

            const editedDataJson = JSON.stringify(editedData);
            console.log(editedDataJson);

            fetch('../server/api/update_detail', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(editedData),
                })
                .then(response => {
                    if (response.ok) {
                        console.log('Data saved successfully');
                        editedCells = [];
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

        const newRow = document.createElement("tr");
        newRow.id = "dynamicHeaderRow";

        newRow.innerHTML = `
            <th colspan="3">Arrival Fuel (LBS)</th>
            <th>Tire Pressure (PSI)</th>
            <th colspan="2">NOSE</th>
            <th colspan="2">LH MAIN</th>
            <th colspan="2">RH MAIN</th>
        </tr>
        `;

        const thead = document.querySelector("table thead");
        thead.appendChild(newRow);

        const currentRow = thead.querySelector("tr");
        thead.insertBefore(newRow, currentRow);
    </script>
</body>

</html>