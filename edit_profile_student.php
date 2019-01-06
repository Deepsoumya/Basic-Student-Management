<?php
session_start();
if(!isset($_SESSION['sess_user']))
{
    // not logged in
    header('Location: login.php');
    exit();
}
include('db.php');
$sessId=$_SESSION['sess_id'];
$sql="select * from students where id=$sessId";
$result=mysqli_query($db,$sql);
if($row=mysqli_fetch_array($result)){
?>
<?php
if(isset($_POST['fname_submit'])){
$fname=$_POST['firstname'];
$sql1="update students set fname='$fname' where id=$sessId";
$result1=mysqli_query($db,$sql1);
//$numrows1=mysqli_num_rows($result1);
//if($numrows1!=0){
//echo "Successfully done, now refresh the page to see the update!!!";
header("Location:edit_profile.php");
//}
}

if(isset($_POST['lname_submit'])){
$lname=$_POST['lastname'];
$sql2="update students set lname='$lname' where id=$sessId";
$result2=mysqli_query($db,$sql2);
//$numrows1=mysqli_num_rows($result1);
//if($numrows1!=0){
//echo "Successfully done, now refresh the page to see the update!!!";
header("Location:edit_profile.php");
//}
}

if(isset($_POST['email_submit'])){
$email=$_POST['email'];
$sql3="update students set email='$email' where id=$sessId";
$result3=mysqli_query($db,$sql3);
//$numrows1=mysqli_num_rows($result1);
//if($numrows1!=0){
//echo "Successfully done, now refresh the page to see the update!!!";
header("Location:edit_profile.php");
//}
}

if(isset($_POST['age_submit'])){
$age=$_POST['age'];
$sql4="update students set age='$age' where id=$sessId";
$result4=mysqli_query($db,$sql4);
//$numrows1=mysqli_num_rows($result1);
//if($numrows1!=0){
//echo "Successfully done, now refresh the page to see the update!!!";
header("Location:edit_profile.php");
//}
}

if(isset($_POST['address_submit'])){
$address=$_POST['address'];
$sql5="update students set address='$address' where id=$sessId";
$result5=mysqli_query($db,$sql5);
//$numrows1=mysqli_num_rows($result1);
//if($numrows1!=0){
//echo "Successfully done, now refresh the page to see the update!!!";
header("Location:edit_profile.php");
//}
}
?>
<style>
#fname_t{
    display:none;
}
#lname_t{
    display:none;
}
#age_t{
    display:none;
}
#address_t{
    display:none;
}
#email_t{
    display:none;
}
</style>
<a href="home.php"><button style="position:fixed;top:0px;right:0px;">Back to Home</button></a>
<center>
<p><b>Name -></b><?php echo " ".$row['fname']; ?><button onclick="fname()" id="fname_edit" style="background-color:transparent;border:none;outline:none;cursor:pointer;font-size:10px;">edit</button><?php echo " ".$row['lname']; ?><button onclick="lname()" id="lname_edit" style="background-color:transparent;border:none;outline:none;cursor:pointer;font-size:10px;">edit</button>
<form action="#" method="post" id="fname_t"><input type="text" name="firstname" placeholder="firstname" required><input type="submit" name="fname_submit" value="Edit"></form>
<form action="#" method="post" id="lname_t"><input type="text" name="lastname" placeholder="lastname" required><input type="submit" name="lname_submit" value="Edit"></form>
</p>
<p><b>email -></b><?php echo " ".$row['email']; ?><button onclick="email()" id="email_edit" style="background-color:transparent;border:none;outline:none;cursor:pointer;font-size:10px;">edit</button>
<form action="#" method="post" id="email_t"><input type="email" name="email" placeholder="email" required><input type="submit" name="email_submit" value="Edit"></form>
</p>
<p><b>age -></b><?php echo " ".$row['age']; ?><button onclick="age()" id="age_edit" style="background-color:transparent;border:none;outline:none;cursor:pointer;font-size:10px;">edit</button>
<form action="#" method="post" id="age_t"><input type="number" name="age" placeholder="age" required><input type="submit" name="age_submit" value="Edit"></form>
</p>
<p><b>address -></b><?php echo " ".$row['address']; ?><button onclick="address()" id="address_edit" style="background-color:transparent;border:none;outline:none;cursor:pointer;font-size:10px;">edit</button>
<form action="#" method="post" id="address_t"><input type="text" name="address" placeholder="address" required><input type="submit" name="address_submit" value="Edit"></form>
</p>
</center>
<script>
function fname() {
    var x = document.getElementById("fname_t");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}
function lname() {
    var x = document.getElementById("lname_t");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}
function email() {
    var x = document.getElementById("email_t");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}
function age() {
    var x = document.getElementById("age_t");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}
function address() {
    var x = document.getElementById("address_t");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}
</script>
<?php } ?>