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
        <input type="text" name="username" placeholder="username">
        <input type="text" name="password" placeholder="password">
        <input type="text" name="fname" placeholder="first name">
        <input type="text" name="lname" placeholder="last name">
        <!-- <input type="text" name="address" placeholder="address"> -->
        <!-- <input type="text" name="email" placeholder="email"> -->
        <button type="submit">Register</button>
    </form>

</body>
</html>