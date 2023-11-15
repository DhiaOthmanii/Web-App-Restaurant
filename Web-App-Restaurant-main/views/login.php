<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Sign In</title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  <link rel="icon" href="../Images/logo.jpg">
  <link rel="stylesheet" href="../CSS/style.css">
</head>


<body>
    <body>
        <header>
           <nav>
               <a href="../HTML/index.html" class="logo">Restaurant</a>
               <div class="menu">
                   <a href="../HTML/Sing up.html" class="btn">SIGN UP</a>
               </div>
           </nav>    
        <div class="container" id="home"> 
           <div class="row">
               <div class="col-1">
                   <h1>Welcome to <br><span class="logo1">Restaurant</span></h1>
                   <p>Welcome to Restaurant, where we serve up a delicious menu with a cozy and inviting atmosphere.</p>
               </div>
           </div>
        </div>
       </header>

<!-- formulaire -->
<div class="login-form">
	<h2>Sign In</h2>
    <form name="f2" action="" method="POST" id="sing">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="pass" name="pass" required>
        </div>
        <div class="form-group">
            <button type="submit" class="bttn">Login</button>
        </div>
  </form>
</div>
<?php
include(footer.php);
?>