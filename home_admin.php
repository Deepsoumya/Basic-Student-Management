<?php
session_start();
if(!isset($_SESSION['sess_user']))
{
    // not logged in
    header('Location: login.php');
    exit();
}
if(isset($_POST['asign'])){
    $select_value=substr($_POST['asign'],20);
    $select_course=$_POST['courses'.$select_value];
    $query123456 = "SELECT course_stu_id FROM `students` WHERE id=$select_value";
    $connect123456 = mysqli_connect("localhost", "deepcryp", "deep1997", "stdntmngmnt");
    $result123456 = mysqli_query($connect123456, $query123456);
    if($row123456 = mysqli_fetch_array($result123456)){
    if($row123456['course_stu_id'] == 'Not_Assigned'){
    
    $query5 = "UPDATE students,courses SET students.course_stu_id=courses.course_stu_id WHERE courses.course_name='$select_course' AND students.id=$select_value";
    $result_search12345=asign_course($query5);
    }
    else{
        echo "<script>alert('First delete the existing course!')</script>";
    }
    }
}
function asign_course($query5)
{
    $connect4 = mysqli_connect("localhost", "deepcryp", "deep1997", "stdntmngmnt");
    $result5 = mysqli_query($connect4, $query5);
    return $result5;
}




    //$delete_value=substr($_POST['assign'],30);
    //$nas='Not_Assigned';
    /*$connect3 = mysqli_connect("localhost", "deepcryp", "deep1997", "stdntmngmnt");
    $query3 = "select course_name from `courses`";
    $result1 = mysqli_query($connect3, $query3);
    return $result1;*/









if(isset($_POST['delete_course'])){
    
    $delete_value=substr($_POST['delete_course'],30);
    $nas='Not_Assigned';
    $query2 = "UPDATE students SET course_stu_id='Not_Assigned' WHERE id=$delete_value";
    $result_search=delete_course($query2);
}
function delete_course($query2)
{
    $connect2 = mysqli_connect("localhost", "deepcryp", "deep1997", "stdntmngmnt");
    $result = mysqli_query($connect2, $query2);
    return $result;
}
                    
if(isset($_POST['search']))
{
    echo 'hii';
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT id,fname,lname,age,email,course_stu_id,address FROM `students` WHERE CONCAT(`id`, `fname`, `lname`, `age`, `email`, `course_stu_id`, `address`) LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);
    
}
 else {
    $query = "SELECT id,fname,lname,age,email,course_stu_id,address FROM `students`";
    $search_result = filterTable($query);
}

// function to connect and execute the query
function filterTable($query)
{
    $connect = mysqli_connect("localhost", "deepcryp", "deep1997", "stdntmngmnt");
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
}

?>
<head>
        <title></title>
        <style>
            table,tr,th,td
            {
                border: 1px solid black;
            }
        </style>
        <script
    type="text/javascript"
    src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"
    
  ></script>
    </head>
    <body>
        Sort by :: <p><button onclick="sortTable()">Id</button><button onclick="sortTable1()">First Name</button><button onclick="sortTable2()">Last Name</button><button onclick="sortTable3()">Age</button><button onclick="sortTable4()">Email</button><button onclick="sortTable5()">Course_Id</button><button onclick="sortTable6()">Address</button></p>
        <form action="" method="post">
            <input type="text" name="valueToSearch" placeholder="Value To Search"><br><br>
            <input type="submit" name="search" value="Filter"><br><br>
            
            <table id="myTable">
                <tr>
                    <th>Id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Age</th>
                    <th>Email</th>
                    <th>Course Id</th>
                    <th>Address</th>
                    <th>Delete Assigned Course</th>
                    <th>Assign a Course</th>
                    <th>Delete Student</th>
                    <th>Send Mail</th>
                </tr>

      <!-- populate table from mysql database -->
                <?php
                $count=0;
                while($row = mysqli_fetch_array($search_result)):?>
                <tr id="target">
                    <td><?php echo $row['id'];?></td>
                    <td><?php echo $row['fname'];?></td>
                    <td><?php echo $row['lname'];?></td>
                    <td><?php echo $row['age'];?></td>
                    <td><?php echo $row['email'];?></td>
                    <td><?php echo $row['course_stu_id'];?></td>
                    <td><?php echo $row['address'];?></td>
                    <td>
                         <?php
                         $courseid=$row['course_stu_id'];
                        ?>
                         
                    <input name="delete_course" type="submit" onclick="delete_course()" value="Delete Assigned Course for id <?php echo $row['id']; ?>"></td>
                    <td>
                        <?php 
                        /*$count++;
                        $connect4 = mysqli_connect("localhost", "deepcryp", "deep1997", "stdntmngmnt");
                        
                        $select_value=substr($_POST['asign'],20);
                        $select_course=$_POST['courses{$count}'];
                        $query5 = "UPDATE students,courses SET students.course_stu_id=courses.course_stu_id WHERE courses.course_name=$select_course AND students.id=$select_value";
                        $result5 = mysqli_query($connect4, $query5);
                        if($row4 = mysqli_fetch_array($result5)){ */
                        //$rowid=$row['id'];
                        ?>
                        <select name="courses<?php echo $row['id'] ?>"><?php
                        $connect3 = mysqli_connect("localhost", "deepcryp", "deep1997", "stdntmngmnt");
                        $query3 = "select course_name from `courses`";
                        $result1 = mysqli_query($connect3, $query3);
                        while($row3 = mysqli_fetch_array($result1)):?>
                    
                        <option><?php echo $row3['course_name'];?></option>
                        <?php endwhile; ?>
                    </select><input type="submit" name="asign" value="Asign course for id <?php echo $row['id']; ?>"><?php  ?></td>
                    <td>
                        <input type="submit" name="delete<?php echo $row['id']; ?>" value="Delete Student Details">
                         <?php
                         $db = mysqli_connect("localhost", "deepcryp", "deep1997", "stdntmngmnt");
                         $rowid1 = $row['id'];
                         if(isset($_POST["delete".$rowid1])){
                         
                         $sql = "DELETE FROM students WHERE id=$rowid1";

                         if (mysqli_query($db, $sql)) {
                         header('Location: home.php');
                         } else {
                         echo "Error deleting record: " . mysqli_error($db);
                         }
                         }
                         ?>
                        
                    </td>
                    <td>
                        <form action="" method="post">
                            <input type="text" name="subj<?php echo $row['id']; ?>" placeholder="message subject" value=""><br>
                            <input type="text" name="msg<?php echo $row['id']; ?>" placeholder="message" value=""><br>
                            <input type="submit" name="button_pressed<?php echo $row['id']; ?>" value="Send Inmail to Student" />
                            <!--<input type="hidden" name="button_pressed<?php echo $row['id']; ?>" value="1" />-->
                        </form>

                        <?php
                        $studentId=$row['id'];
                        if(isset($_POST['button_pressed'.$row['id']]))
                        {
                            $to      = $row['email'];
                            $subject = $_POST['subj'.$row['id']];
                            $message = $_POST['msg'.$row['id']];
                            $headers = 'From: CourseFoundation@gmail.com' . "\r\n" . 'Reply-To: CourseFoundation@gmail.com' . "\r\n" . 'X-Mailer: PHP/' . phpversion();

                            mail($to, $subject, $message, $headers);
                            $sql1234 = "insert into noti(student_id,subject,message) values('$studentId','$subject','$message')";
                            //echo 'Email Sent.';
                            if (mysqli_query($db, $sql1234)) {
                            echo 'Email Sent.';
                            } else {
                            echo "Error deleting record: " . mysqli_error($db);
                            }
                            }

?>
                    </td>
                </tr>
                <?php endwhile;
                ?>
            </table>
            <script>
            $(document).ready(function(){
    $('#myTable').after('<div id="nav"></div>');
    var rowsShown = 6;
    var rowsTotal = $('#myTable tbody #target').length;
    var numPages = rowsTotal/rowsShown;
    for(i = 0;i < numPages;i++) {
        var pageNum = i + 1;
        $('#nav').append('<a href="#" rel="'+i+'">'+pageNum+'</a> ');
    }
    $('#myTable tbody #target').hide();
    $('#myTable tbody #target').slice(0, rowsShown).show();
    $('#nav a:first').addClass('active');
    $('#nav a').bind('click', function(){

        $('#nav a').removeClass('active');
        $(this).addClass('active');
        var currPage = $(this).attr('rel');
        var startItem = currPage * rowsShown;
        var endItem = startItem + rowsShown;
        $('#myTable tbody #target').css('opacity','0.0').hide().slice(startItem, endItem).
        css('display','table-row').animate({opacity:1}, 300);
    });
});
        </script>
        </form>
        
        
        
        
        <script>
function sortTable() {
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("myTable");
  switching = true;
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.getElementsByTagName("TR");
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[0];
      y = rows[i + 1].getElementsByTagName("TD")[0];
      //check if the two rows should switch place:
      if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
        //if so, mark as a switch and break the loop:
        shouldSwitch = true;
        break;
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
}
function sortTable1() {
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("myTable");
  switching = true;
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.getElementsByTagName("TR");
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[1];
      y = rows[i + 1].getElementsByTagName("TD")[1];
      //check if the two rows should switch place:
      if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
        //if so, mark as a switch and break the loop:
        shouldSwitch = true;
        break;
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
}function sortTable2() {
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("myTable");
  switching = true;
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.getElementsByTagName("TR");
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[2];
      y = rows[i + 1].getElementsByTagName("TD")[2];
      //check if the two rows should switch place:
      if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
        //if so, mark as a switch and break the loop:
        shouldSwitch = true;
        break;
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
}
function sortTable3() {
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("myTable");
  switching = true;
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.getElementsByTagName("TR");
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[3];
      y = rows[i + 1].getElementsByTagName("TD")[3];
      //check if the two rows should switch place:
      if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
        //if so, mark as a switch and break the loop:
        shouldSwitch = true;
        break;
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
}
function sortTable4() {
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("myTable");
  switching = true;
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.getElementsByTagName("TR");
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[4];
      y = rows[i + 1].getElementsByTagName("TD")[4];
      //check if the two rows should switch place:
      if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
        //if so, mark as a switch and break the loop:
        shouldSwitch = true;
        break;
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
}
function sortTable5() {
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("myTable");
  switching = true;
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.getElementsByTagName("TR");
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[5];
      y = rows[i + 1].getElementsByTagName("TD")[5];
      //check if the two rows should switch place:
      if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
        //if so, mark as a switch and break the loop:
        shouldSwitch = true;
        break;
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
}
function sortTable6() {
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("myTable");
  switching = true;
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.getElementsByTagName("TR");
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[6];
      y = rows[i + 1].getElementsByTagName("TD")[6];
      //check if the two rows should switch place:
      if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
        //if so, mark as a switch and break the loop:
        shouldSwitch = true;
        break;
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
}
</script>
<input id="btntest" type="button" value="Refresh" onclick="window.location.href = 'home.php' " />

<!---->

<br>
<?php
if(isset($_POST['add_student'])){
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $age=$_POST['age'];
    $password=$_POST['password'];
    $email=$_POST['email'];
    $course_id=$_POST['course_id'];
    $address=$_POST['address'];
    $conn = mysqli_connect("localhost", "deepcryp", "deep1997", "stdntmngmnt");
    $quer5 = "insert into students(fname,lname,age,password,email,course_stu_id,address) values('$fname','$lname','$age','$password','$email','$course_id','$address')";
    $resul7 = mysqli_query($conn, $quer5);
    if (!$resul7) {
    printf("Error: %s\n", mysqli_error($resul7));
    exit();
    }
    /*while(mysqli_fetch_array($resul7)):
        echo "success";
    endwhile;*/
    if($resul7!=0){
        echo "success";
    }
}
?>
<form action="" method="post">
    <span><label>First Name</label><input type="text" name="fname"></span><br>
    <span><label>last Name</label><input type="text" name="lname"></span><br>
    <span><label>Age</label><input type="number" name="age"></span><br>
    <span><label>Password</label><input type="text" name="password"></span><br>
    <span><label>Email</label><input type="email" name="email"></span><br>
    <span><label>Course Id</label><input type="text" name="course_id"></span><br>
    <span><label>Address(city)</label><input type="text" name="address"></span><br>
    <input type="submit" name="add_student" value="Add Student">
</form>

<br><br>
<br><br><br>
<?php

if(isset($_POST['search1']))
{
    $valueToSearch1 = $_POST['valueToSearch1'];
    // search in all table columns
    // using concat mysql function
    $query1 = "SELECT * FROM `courses` WHERE CONCAT(`id`, `course_stu_id`, `course_name`) LIKE '%".$valueToSearch1."%'";
    $search_result1 = filterTable1($query1);
    
}
 else {
    $query1 = "SELECT * FROM `courses`";
    $search_result1 = filterTable1($query1);
}

// function to connect and execute the query
function filterTable1($query1)
{
    $connect1 = mysqli_connect("localhost", "deepcryp", "deep1997", "stdntmngmnt");
    $filter_Result1 = mysqli_query($connect1, $query1);
    return $filter_Result1;
}

?>


Sort by :: <p><button onclick="sortTable9()">Id</button><button onclick="sortTable91()">Course_Id</button><button onclick="sortTable92()">Course_Name</button></p>
        <form action="" method="post">
            <input type="text" name="valueToSearch1" placeholder="Value To Search"><br><br>
            <input type="submit" name="search1" value="Filter"><br><br>
            
            <table id="myTable1">
                <tr>
                    <th>Id</th>
                    <th>Course Id</th>
                    <th>Course Name</th>
                    <th>Delete Course</th>
                </tr>

      <!-- populate table from mysql database -->
                <?php while($row1 = mysqli_fetch_array($search_result1)):?>
                <tr id="target1">
                    <td><?php echo $row1['id'];?></td>
                    <td><?php echo $row1['course_stu_id'];?></td>
                    <td><?php echo $row1['course_name'];?></td>
                    <td>
                    <input type="submit" name="delete1<?php echo $row1['id']; ?>" value="Delete Course Details of id <?php echo $row1['id']; ?>">
                         <?php
                         if(isset($_POST["delete1".$row1['id']])){
                         $rowidfetch=substr($_POST["delete1".$row1['id']],28);
     $connect4 = mysqli_connect("localhost", "deepcryp", "deep1997", "stdntmngmnt");
                         $sql1 = "DELETE FROM `courses` WHERE id=$rowidfetch";

                         if (mysqli_query($connect4, $sql1)) {
                             echo "";
                         } else {
                         echo "Error deleting record: " . mysqli_error($connect4);
                         }
                         }
                         ?>
                        
                    </td>
                </tr>
                <?php endwhile;?>
            </table>
            <script>
            $(document).ready(function(){
    $('#myTable1').after('<div id="nav1"></div>');
    var rowsShown = 3;
    var rowsTotal = $('#myTable1 tbody #target1').length;
    var numPages = rowsTotal/rowsShown;
    for(i = 0;i < numPages;i++) {
        var pageNum = i + 1;
        $('#nav1').append('<a href="#" rel="'+i+'">'+pageNum+'</a> ');
    }
    $('#myTable1 tbody #target1').hide();
    $('#myTable1 tbody #target1').slice(0, rowsShown).show();
    $('#nav1 a:first').addClass('active');
    $('#nav1 a').bind('click', function(){

        $('#nav1 a').removeClass('active');
        $(this).addClass('active');
        var currPage = $(this).attr('rel');
        var startItem = currPage * rowsShown;
        var endItem = startItem + rowsShown;
        $('#myTable1 tbody #target1').css('opacity','0.0').hide().slice(startItem, endItem).
        css('display','table-row').animate({opacity:1}, 300);
    });
});
        </script>
        </form>
        
        
        
        
        <script>
function sortTable9() {
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("myTable1");
  switching = true;
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.getElementsByTagName("TR");
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[0];
      y = rows[i + 1].getElementsByTagName("TD")[0];
      //check if the two rows should switch place:
      if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
        //if so, mark as a switch and break the loop:
        shouldSwitch = true;
        break;
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
}
function sortTable91() {
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("myTable1");
  switching = true;
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.getElementsByTagName("TR");
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[1];
      y = rows[i + 1].getElementsByTagName("TD")[1];
      //check if the two rows should switch place:
      if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
        //if so, mark as a switch and break the loop:
        shouldSwitch = true;
        break;
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
}function sortTable92() {
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("myTable1");
  switching = true;
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.getElementsByTagName("TR");
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[2];
      y = rows[i + 1].getElementsByTagName("TD")[2];
      //check if the two rows should switch place:
      if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
        //if so, mark as a switch and break the loop:
        shouldSwitch = true;
        break;
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
}
</script>
<input id="btntest" type="button" value="Refresh" onclick="window.location.href = 'home.php' " />

<!---->

<br>
<?php
if(isset($_POST['add_course'])){
    $course_name=$_POST['course_name'];
    $courseId=$_POST['course_id1'];
    $conn1 = mysqli_connect("localhost", "deepcryp", "deep1997", "stdntmngmnt");
    $quer51 = "insert into courses(course_name,course_stu_id) values('$course_name','$courseId')";
    $resul71 = mysqli_query($conn1, $quer51);
    if (!$resul71) {
    printf("Error: %s\n", mysqli_error($conn1));
    exit();
    }
    /*while(mysqli_fetch_array($resul7)):
        echo "success";
    endwhile;*/
    if($resul71!=0){
        echo "success";
    }
}
?>
<form action="#" method="post">
    <span><label>Course Name</label><input type="text" name="course_name"></span><br>
    <span><label>Course Id</label><input type="text" name="course_id1"></span><br>
    <input type="submit" name="add_course" value="Add Course">
</form>
<a href="logout.php"><button style="position:fixed;top:0px;right:0px;">Log Out</button></a>