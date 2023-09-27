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

    @media print {
        body {
            overflow: hidden;
            /* Hide scrollbars in the printed output */
        }

        .printPrv {
            display: none;
            /* Hide the print button on the printed page */
        }

        /* Configure landscape printing */
        @page {
            size: landscape;
            margin: 1cm;
            /* Adjust margins as needed */
        }
.brand{
    display: block;
}
        /* Add your custom styles for the printed page here */
        /* For example, you can set different font sizes, margins, etc. */
        table {
            font-size: 12px;
            /* Adjust font size for tables in the printed page */
            /* Add other styles as needed */
        }

        /* Expand cell heights and widths to fit content when printing */
        td,
        th {
            white-space: normal !important;
            width: auto !important;
            max-height: none !important;
        }

    }

    .form-row {
        display: flex;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }

    /* Style for form fields */
    .form-field {
        flex: 1;
        margin-right: 10px;
    }

    /* Add a break after every second form field */
    .form-field:nth-child(2n) {
        margin-right: 0;
    }

    /* Style for labels */
    label {
        display: block;
        margin-bottom: 5px;
    }

    /* Style for input fields */
    input[type="text"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    /* Optional: Style for the form-section */
    .form-section {
        background-color: #f5f5f5;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 10px;
    }

    /* Optional: Add some spacing after the form */
    form {
        margin-bottom: 20px;
    }

    .break {
        margin-top: 10px;
        /* Add spacing between "Category" and "Description" */
        width: 100%;
        /* Make the break div occupy the full width */
        height: 0;
        /* Set height to zero so it doesn't visually affect layout */
        clear: both;
        /* Clear any floating elements above it */
    }
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


    </div>


    <div class="brand" style="text-align: center;">
        <h3 style="font-weight: bold; font-size: 40px; color: gray; margin-bottom: 0;">
            <img src="css/cropped-flyseair-free.png" alt="Company Logo" style="height: 40px; margin-right: 5px;">
            <b>fly<span style="color: black;">seair</span>.com</b>
        </h3>

        <h3
            style="font-size: 45px; margin-top: 5px; font-family: 'Roboto', sans-serif;  text-align: center; text-transform: uppercase;">
            TECHNICAL LOG</h3>

      
    </div>
    <h1>Print Preview Summary</h1>
    <form action="../server/api/create_log" method="post">
        <div class="form-section">
            <div class="form-row">
                <div class="form-field">
                    <label for="#">Flight Number:</label>
                    <input type="text" name="#" placeholder="Flight Number" required>
                </div>
                <div class="form-field">
                    <label for="#">Date:</label>
                    <input type="text" name="#" placeholder="Date">
                </div>
                <div class="form-field">
                    <label for="#">Serial Number:</label>
                    <input type="text" name="#" placeholder="Serial Number">
                </div>
                <div class="form-field">
                    <label for="#">To:</label>
                    <input type="text" name="#" placeholder="To">
                </div>
                <div class="form-field">
                    <label for="#">From:</label>
                    <input type="text" name="#" placeholder="From">
                </div>
                <div class="form-field">
                    <label for="#">Chock ON (Z):</label>
                    <input type="text" name="#" placeholder="Chock ON (Z)">
                </div>
                <div class="break"></div>
                <div class="form-field">
                    <label for="#">Chock OFF (Z):</label>
                    <input type="text" name="#" placeholder="Chock OFF (Z)">
                </div>

                <div class="form-field">
                    <label for="#">Landing (Z):</label>
                    <input type="text" name="#" placeholder="Landing (Z)">
                </div>
                <div class="form-field">
                    <label for="#">Take-Off (Z):</label>
                    <input type="text" name="#" placeholder="Take-Off (Z)">
                </div>
                <div class="form-field">
                    <label for="#">Flight Time:</label>
                    <input type="text" name="#" placeholder="Flight Time">
                </div>
                <div class="form-field">
                    <label for="#">Touch and Go:</label>
                    <input type="text" name="#" placeholder="Touch and Go">
                </div>
                <div class="form-field">
                    <label for="#">Total Time:</label>
                    <input type="text" name="#" placeholder="Total Time">
                </div>
            </div>
        </div>
    </form>
    <button style="background-color: #e91e63;" class="printPrv" type="button" onclick="printTables()">Print</button>
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
            echo "<td>";
            echo "<div style='max-width: 150px; overflow-y: auto;'>" . $log['fault_desc'] . "</div>";
            echo "</td>";
            // echo "<td class='hidePrint'>" . $log['updated_at'] . "</td>";
        
            echo "<td>" . $log['item_no'] . "</td>";
            echo "<td>" . $log['transfer_to_do_s_no'] . "</td>";
            echo "<td>" . $log['mel_item_no'] . "</td>";
            echo "<td>" . $log['cat'] . "</td>";
            echo "<td>";
            echo "<div style='max-width: 150px;  overflow-y: auto;'>" . $log['action_taken'] . "</div>";
            echo "</td>";


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
    <button style="background-color: #e91e63;" class="save-button printBtn" onclick="saveData()">Save Changes</button>



    <script>
        function printTables() {
    // Hide the print button
    const printButton = document.querySelector('.printPrv');
    printButton.style.display = 'none';

    // Hide the scroll bars in the printed page
    document.body.style.overflow = 'hidden';

    // Hide all elements except for tables and elements with the "brand" class
    const elementsToHide = document.querySelectorAll('body > *:not(table):not(.printPrv):not(.brand)');
    elementsToHide.forEach(element => {
        element.style.display = 'none';
    });

    // Print the page
    window.print();

    // Restore the visibility of hidden elements and the print button
    elementsToHide.forEach(element => {
        element.style.display = '';
    });
    printButton.style.display = 'block';

    // Restore the scroll bars after printing
    document.body.style.overflow = '';
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