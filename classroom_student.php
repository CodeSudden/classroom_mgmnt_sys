<?php
if (isset ($_POST['submit'])){
    $classroomid = $_POST['classroomid'];
    $studentid = $_POST['studentid'];
    $succ = "Registration Success";
    $conn = new mysqli('localhost','root','','schoolms');
    if($conn->connect_error){
        die('connection faied : '.$conn->connect_error);
    }else{
        $stmt = $conn->prepare("INSERT INTO `classroom_student`(`classroom_id`, `student_id`)
        VALUES(?, ?)");
        $stmt->bind_param("ii", $classroomid, $studentid);
        $stmt->execute();
        echo "<h1>" . $succ . "</h1>";
        header ("refresh:2;url=classroom_student.php");
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
                <a href="#openModal"><button class="button-3">Add classroom record</button></a>
        </div>
        <div id="openModal" class="modalDialog">
            <div><a href="classroom_student.php" title="Close" class="close">X</a>
                <h2><center>Add classroom record</center></h2>
                <br><br>
                <form action="classroom_student.php" method="POST">
                    <label class="formstyle">Classroom Student</label>
                    <select name="classroomid">
                    <?php
                    $con = mysqli_connect('localhost','root', '', 'schoolms');
                    $sql = "SELECT * FROM classroom";
                    $all_classroom_id = mysqli_query($con,$sql);
                    while ($classroomid = mysqli_fetch_array(
                        $all_classroom_id,MYSQLI_ASSOC)):;
                    ?>
                    <option value="<?php echo $classroomid["classroom_id"];
                    ?>">
                        <?php echo $classroomid["classroom_id"];?>
                    </option>
                    <?php
                        endwhile;
                    ?>
                    </select><br><br>
                    <label class="formstyle">Student ID</label>
                    <select name="studentid">
                    <?php
                    $con = mysqli_connect('localhost','root', '', 'schoolms');
                    $sql = "SELECT * FROM student";
                    $all_student_id = mysqli_query($con,$sql);
                    while ($studentid = mysqli_fetch_array(
                        $all_student_id,MYSQLI_ASSOC)):;
                    ?>
                    <option value="<?php echo $studentid["student_id"];
                    ?>">
                        <?php echo $studentid["student_id"];?>
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
            </div>

            <div class="tab">
            <a href="classroom_student.php"><button id="tab-11">
               <label for="tab-11">ClassStud</label></button></a>
               <div class="content">
                <h3>Classroom students</h3><br>
                <?php
                $con = mysqli_connect('localhost','root', '', 'schoolms');
                if (!$con)
                {
                die('Could not connect: ');
                }
                $sql = "SELECT * FROM classroom_student";
                $result = $con->query($sql);
                echo "<table class='tableclass'>
                <tr>
                <th>Classroom ID</th>
                <th>Student ID</th>
                <th>Actions</th>
                </tr>";
                $i=0;
                while($row = $result-> fetch_assoc())
                {
                echo "<tr>";
                echo "<td>" . $row['classroom_id'] . "</td>";
                echo "<td>" . $row['student_id'] . "</td>";?>
                <form action="delete.php" method="POST">
                    <input type="hidden" name="classroomid" value="<?php echo $row["classroom_id"]?>">
                    <input type="hidden" name="studentid" value="<?php echo $row["student_id"]?>">
                    <td><input class="button-4" type="submit" name="deleteCS" value="Delete"></td>
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

