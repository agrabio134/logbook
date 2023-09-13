<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<!-- create form for log -->
<form action="server/api/create_log" method="post">
    <input type="text" name="item_no" placeholder="item no">
    <input type="text" name="fault_code" placeholder="fault code">
    <input type="text" name="fault_desc" placeholder="fault desc">
    <input type="text" name="transfer_to_do_s_no" placeholder="transfer to do no">
    <input type="text" name="mel_no" placeholder="mel no">
    <input type="text" name="cat" placeholder="cat">
    <input type="text" name="action_taken" placeholder="action taken">
    <button type="submit">Create log</button>
</form>

<!-- edit form for log -->
<!-- <form action="edit_log" method="post">
    <input type="text" name="id" placeholder="id">
    <input type="text" name="item_no" placeholder="item no">
    <input type="text" name="fault_code" placeholder="fault code">
    <input type="text" name="fault_desc" placeholder="fault desc">
    <input type="text" name="transfer_to_do_no" placeholder="transfer to do no">
    <input type="text" name="mel_no" placeholder="mel no">
    <input type="text" name="cat" placeholder="cat">
    <input type="text" name="action_taken" placeholder="action taken">
    <button type="submit">Edit log</button>
</form> -->

    
</body>
</html>