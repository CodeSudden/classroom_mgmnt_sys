<?php
if (isset($_POST['submit'])){
$classroomid = $_POST['classroomid'];
$year = $_POST['year'];
$gradeid = $_POST['gradeid'];
$section = $_POST['section'];
$status = $_POST['status'];
$remarks = $_POST['remarks'];
$teacherid = $_POST['teacherid'];
$succ = "Registration Success";
$conn = new mysqli('localhost','root','','schoolms');
if($conn->connect_error){
    die('connection faied : '.$conn->connect_error);
}else{
    $stmt = $conn->prepare("INSERT INTO classroom (`classroom_id`, `year`, `grade_id`, `section`, `status`, `remarks`, `teacher_id`)
    VALUES(?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssi",$classroomid, $year, $gradeid, $section, $status, $remarks, $teacherid);
    $stmt->execute();
    echo "<h1>" . $succ . "</h1>";
    header ("refresh:2;url=classroom.php");
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
            <a href="#openModal3"><button class="button-3">Add Classroom</button></a>
        </div>

        <div id="openModal3" class="modalDialog">
            <div><a href="classroom.php" title="Close" class="close">X</a>
                <h2>
                    <center>Add Classroom</center>
                </h2>
                <br><br>
                <form action="classroom.php" method="POST">
                    <label class="formstyle">Classroom ID:</label>
                    <input type="text" name="classroomid" placeholder="Classroom ID"><br><br>
                    <label class="formstyle">Year:</label>
                    <input type="text" name="year" placeholder="YEAR"><br><br>
                    <label class="formstyle">Grade ID</label>
                    <select name="gradeid">
                    <?php
                    $con = mysqli_connect('localhost','root', '', 'schoolms');
                    $sql = "SELECT * FROM grade";
                    $all_grade = mysqli_query($con,$sql);
                    while ($gradeid = mysqli_fetch_array(
                        $all_grade,MYSQLI_ASSOC)):;
                    ?>
                    <option value="<?php echo $gradeid["grade_id"];
                    ?>">
                        <?php echo $gradeid["grade_id"];?>
                    </option>
                    <?php
                        endwhile;
                    ?>
                    </select><br><br>
                    <label class="formstyle">Section:</label>
                    <input type="text" name="section" placeholder="Section"><br><br>
                    <input type="radio" name="status" value="1">Active
                    <input type="radio" name="status" value="0">Inactive 
                    <br><br>
                    <label class="formstyle">Remarks:</label>
                    <input type="text" name="remarks" placeholder="Remarks"><br><br>
                    <label class="formstyle">Teacher ID</label>
                    <select name="teacherid">
                    <?php
                    $con = mysqli_connect('localhost','root', '', 'schoolms');
                    $sql = "SELECT * FROM teacher";
                    $all_teacher = mysqli_query($con,$sql);
                    while ($teacherid = mysqli_fetch_array(
                        $all_teacher,MYSQLI_ASSOC)):;
                    ?>
                    <option value="<?php echo $teacherid["teacher_id"];
                    ?>">
                        <?php echo $teacherid["teacher_id"];?>
                    </option>
                    <?php
                        endwhile;
                    ?>
                    </select><br><br>
                    <div class="submitcen">
                        <input class="submit" type="submit" value="Register" name="submit">
                    </div>
                </form>
            </div>
        </div>

        <div class="tabs">
            <div class="tab">
                <a href="student.php"><button id="tab-1">
                <label for="tab-1">Students</label></button></a>
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
                <div class="content">
                    <h3>Classroom Informations</h3><br>
                    <?php
                $con = mysqli_connect('localhost','root', '', 'schoolms');
                if (!$con)
                {
                die('Could not connect: ');
                }
                $sql = "SELECT * FROM classroom";
                $result = $con->query($sql);
                echo "<table class='tableclass'>
                <tr>
                <th>Classroom ID</th>
                <th>Year</th>
                <th>Grade ID</th>
                <th>Section</th>
                <th>Status</th>
                <th>Remarks</th>
                <th>Teacher ID</th>
                <th>Actions</th>
                </tr>";
                $i=0;
                while($row = $result-> fetch_assoc())
                {
                echo "<tr>";
                echo "<td>" . $row['classroom_id'] . "</td>";
                echo "<td>" . $row['year'] . "</td>";
                echo "<td>" . $row['grade_id'] . "</td>";
                echo "<td>" . $row['section'] . "</td>";
                echo "<td>" . $row['status'] . "</td>";
                echo "<td>" . $row['remarks'] . "</td>";
                echo "<td>" . $row['teacher_id'] . "</td>";?>
                <form action="delete.php" method="POST">
                    <input type="hidden" name="classroom_id" value="<?php echo $row["classroom_id"]?>">
                    <td><input class="button-4" type="submit" name="deleteC" value="Delete"></td>
                </form>
                <?php
                echo "</tr>";
                }                
                $i++;
                echo "</table>";
                mysqli_close($con);
                ?>
                </div>
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
            <button class="button-18 type=" button"> Log out </button>
        </div>
</body>

</html>