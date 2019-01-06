<?php
session_start();
if(isset($_SESSION['sess_user']))
{
    header('Location: home.php');
    exit();
}
include("db.php");
if(isset($_POST["submit"])){

if(!empty($_POST['email']) && !empty($_POST['password'])) {
    $email=$_POST['email'];
    $pass=$_POST['password'];

    //$con=mysql_connect('localhost','root','') or die(mysql_error());
    //mysql_select_db('user_registration') or die("cannot select DB");

    $query=mysqli_query($db,"SELECT * FROM admin WHERE email='$email' AND password='$pass'");
    $numrows=mysqli_num_rows($query);
    if($numrows!=0)
    {
    while($row=mysqli_fetch_assoc($query))
    {
    $dbusername=$row['username'];
    $dbpassword=$row['password'];
    $dbemail=$row['email'];
    $id=$row['admin_id'];
    }
    if($email == $dbemail && $pass == $dbpassword)
    {
    $_SESSION['sess_user']=$dbusername;
    $_SESSION['sess_id']=$id;
    $_SESSION['sess_email']=$email;

    /* Redirect browser */

header('Location: home.php');

    }
    } else {
    echo "<p align='center'>Invalid username or password!</p>";
    }

} else {
    echo "All fields are required!";
}
}
?>
    <form class="" action="#" method="post">
      <input type="email" name="email" placeholder="email" value="">
      <input type="password" name="password" placeholder="password" value="">
      <input type="submit" name="submit" value="LogIn"><br>
      <h4>want to login with username then <a href="login.php">click here</a></h4>
    </form>