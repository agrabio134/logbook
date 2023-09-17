<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <!-- registerpage -->
    <form action="../server/api/register" method="post">
        <input type="email" name="username" placeholder="Email">
        <input type="text" name="password" placeholder="Password">
        <input type="text" name="fname" placeholder="First name">
        <input type="text" name="lname" placeholder="Last name">
        <input type="text" name="department" placeholder="Department">
        <input type="text" name="contact_no" placeholder="Contact number">
        <button type="submit">Register</button>
    </form>

</body>
</html>