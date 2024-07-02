<?php
if (isset ($_POST['submit'])){
    $studentid = $_POST['studentid'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $dob = $_POST['dob'];
    $phone = $_POST['phone'];
    $mobile = $_POST['mobile'];
    $parentid = $_POST['parentid'];
    $dateofjoin = $_POST['dateofjoin'];
    $status = $_POST['status'];
    $succ = "Registration Success";
    $conn = new mysqli('localhost','root','','schoolms');
    if($conn->connect_error){
        die('connection faied : '.$conn->connect_error);
    }else{
        $stmt = $conn->prepare("INSERT INTO `student`(`student_id`, `email`, `password`, `fname`, `lname`, `dob`, `phone`, `mobile` , `parent_id`, `date_of_join`, `status`)
        VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssssssiss",$studentid, $email, $password, $fname, $lname, $dob, $phone, $mobile, $parentid, $dateofjoin, $status);
        $stmt->execute();
        echo "<h1>" . $succ . "</h1>";
        header ("refresh:2;url=student.php");
        $stmt->close();
        $conn->close();
    }
}
?>

<html>
    <head>
        <title>Admin</title>
        <link rel="stylesheet" type="text/css" href="adminstyle.css">
    </head>
    <body>
    <div id="page-wrap">
        <br><br><br><br><br>
        <h1>School Management System</h1>
        <div class="modalpos">
                <a href="#openModal"><button class="button-3"> Add Student </button></a>
        </div>
        <div id="openModal" class="modalDialog">
            <div><a href="student.php" title="Close" class="close">X</a>
                <h2><center>Add student</center></h2>
                <br><br>
                <form action="student.php" method="POST">
                    <label class="formstyle">Student ID:</label>
                    <input type="text" name="studentid" placeholder="Student ID"><br><br>
                    <label class="formstyle">Email:</label>
                    <input type="text" name="email" placeholder="Email"><br><br>
                    <label class="formstyle">Password:</label>
                    <input type="text" name="password" placeholder="Password"><br><br>
                    <label class="formstyle">First name:</label>
                    <input type="text" name="fname" placeholder="First name"><br><br>
                    <label class="formstyle">Last name:</label>
                    <input type="text" name="lname" placeholder="Last name"><br><br>
                    <label class="formstyle">Date of Birth:</label>
                    <input type="date" name="dob" placeholder="yy/mm/dd"><br><br>
                    <label class="formstyle">Phone number:</label>
                    <input type="text" name="phone" placeholder="Phone number"><br><br>
                    <label class="formstyle">Mobile:</label>
                    <input type="text" name="mobile" placeholder="Mobile"><br><br>
                    <label class="formstyle">Parent ID</label>
                    <select name="parentid">
                    <?php
                    $con = mysqli_connect('localhost','root', '', 'schoolms');
                    $sql = "SELECT * FROM parent";
                    $all_parent = mysqli_query($con,$sql);
                    while ($parentid = mysqli_fetch_array(
                        $all_parent,MYSQLI_ASSOC)):;
                    ?>
                    <option value="<?php echo $parentid["parent_id"];
                    ?>">
                        <?php echo $parentid["parent_id"];?>
                    </option>
                    <?php
                        endwhile;
                    ?>
                    </select><br><br>
                    <label class="formstyle">Date of Join:</label>
                    <input type="text" name="dateofjoin" placeholder="yy/mm/dd"><br><br>
                    <label class="formstyle">Status:</label>
                    <input type="radio" name="status" value="1">active
                    <input type="radio" name="status" value="0">Inactive 
                    <br><br>
                    <div class="submitcen">
                        <input class="submit" type="submit" value="Register" name="submit">
                    </div>
                </form>
            </div>
        </div>

        <div class="tabs">
           <div class="tab">
            <a href="student.php"><button id="tab-1">
               <label class="active" for="tab-1">Students</label></button></a>
               <div class="content">
                <h3>Student Informations</h3><br>
                <?php
                $con = mysqli_connect('localhost','root', '', 'schoolms');
                if (!$con)
                {
                die('Could not connect: ');
                }
                $sql = "SELECT * FROM student";
                $result = $con->query($sql);
                echo "<table class='tableclass'>
                <tr>
                <th>Student ID</th>
                <th>Email</th>
                <th>password</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Birthdate</th>
                <th>Phone</th>
                <th>Mobile</th>
                <th>Parent ID</th>
                <th>Date of Join</th>
                <th>Status</th>
                <th>Actions</th>
                </tr>";
                while($row = $result-> fetch_assoc())
                {
                echo "<tr>";
                echo "<td>" . $row['student_id'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['password'] . "</td>";
                echo "<td>" . $row['fname'] . "</td>";
                echo "<td>" . $row['lname'] . "</td>";
                echo "<td>" . $row['dob'] . "</td>";
                echo "<td>" . $row['phone'] . "</td>";
                echo "<td>" . $row['mobile'] . "</td>";
                echo "<td>" . $row['parent_id'] . "</td>";
                echo "<td>" . $row['date_of_join'] . "</td>";
                echo "<td>" . $row['status'] . "</td>";?>
                <form action="delete.php" method="POST">
                    <input type="hidden" name="student_id" value="<?php echo $row["student_id"]?>">
                    <td><input class="button-4" type="submit" name="deleteS" value="Delete"></td>
                </form>
                <?php
                echo "</tr>";
                }
                echo "</table>";
                mysqli_close($con);
                ?> 
               </div>
           </div>

           <div class="tab">
               <a href="parent.php"><button id="tab-2">
               <label for="tab-2">Parent</label></button></a>            
           </div>
        
           <div class="tab">
               <a href="teacher.php"><button id="tab-3">
               <label for="tab-3">Teacher</label></button></a>            
           </div>

            <div class="tab">
            <a href="classroom.php"><button id="tab-4">
               <label for="tab-4">Classroom</label></button></a>
            </div>

            <div class="tab">
               <a href="classroom_student.php"><button id="tab-11">
               <label for="tab-11">ClassStud</label></button></a>            
           </div>
            
            <div class="tab">
               <a href="grade.php"><button id="tab-5">
               <label for="tab-5">Grade</label></button></a>            
            </div>

            <div class="tab">
               <a href="course.php"><button id="tab-6">
               <label for="tab-6">Course</label></button></a>            
            </div>

            <div class="tab">
                <a href="exam.php"><button id="tab-7">
                <label for="tab-7">Exam</label></button></a>
            </div>

            <div class="tab">
                <a href="examtype.php"><button id="tab-8">
                <label for="tab-8">Exam Type</label></button></a>
            </div>

            <div class="tab">
                <a href="exam_results.php"><button id="tab-9">
                <label for="tab-9">ExamResult</label></button></a>
            </div>

            <div class="tab">
               <a href="attendance.php"><button id="tab-10">
               <label for="tab-10">Attendance</label></button></a>            
           </div>

        </div>
        <a href="index.html">
        <button class="button-18" type="button"> Log out </button>
        </div>



    </body>
</html>

