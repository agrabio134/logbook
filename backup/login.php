
<!DOCTYPE html>
<html lang="en">
<head>


 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <!--Stylesheet-->
    <style media="screen">
      
    </style>
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>


    <form action="../server/api/login" method="post">
        <h3>Login</h3>

        <label for="username">Username</label>
        <input type="text" name="username" placeholder="Email or Phone" id="username">

        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Password" id="password">

        <button type="submit">Log In</button>
        
    </form>
</body>
</html>
