<?php
session_start();
if(!isset($_SESSION['sess_user']))
{
    // not logged in
    header('Location: login.php');
    exit();
}
include('db.php');
?>
Welcome <?php echo $_SESSION['sess_name']; ?><br>
Your allocated course is 
<?php 
$useruser = $_SESSION['fname0'];
$courseId=$_SESSION['sess_courseId'];
$query0="select * from students where fname='$useruser'";
$result0=mysqli_query($db,$query0);
while($row0=mysqli_fetch_array($result0)){
$courseid0 = $row0['course_stu_id'];
}
$query="select * from courses where course_stu_id='$courseid0'";
$result=mysqli_query($db,$query);
$numrows=mysqli_num_rows($result);
if($numrows!=0){
    while($row=mysqli_fetch_array($result)){
        $courseName=$row['course_name'];
    }
    echo $courseName;
    
}
else{
    echo $courseid0;
}
?>
<br><br><a href="edit_profile.php"><button style="">My Profile</button></a>
<br><a href="logout.php"><button style="position:fixed;top:0px;right:0px;">LogOut</button></a>
<div style="overflow:auto;padding:10px;background-color:yellow;height:50%;width:30%;position:fixed;bottom:0px;right:0px;">
    <a href="#last"><button style="position:fixed;bottom:53%;right:0px;">See New Message</button></a>
    <br><br>
    <?php
    $stu_id=$_SESSION['sess_id'];
    $sql12="select * from noti where student_id=$stu_id";
    $result7=mysqli_query($db, $sql12);
    //if(mysqli_num_rows(mysqli_query($db, $sql12))!=0){
    
    while($row32 = mysqli_fetch_array($result7)){
        if($stu_id == $row32['student_id']){
            echo $row32['date']." :: Subject->".$row32['subject'].", Message->".$row32['message']."<hr>";
        }
        else{
            
        }
    }
    //}
    //else{
        
    //}
    ?>
    <p style="color:red;position:relative;bottom:0px;" id="last">New Message</p>
</div>