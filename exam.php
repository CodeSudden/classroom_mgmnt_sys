<?php
if (isset ($_POST['submit'])){
    $examid = $_POST['examid'];
    $examtypeid = $_POST['examtypeid'];
    $name = $_POST['name'];
    $startdate = $_POST['date'];
    $succ = "Registration Success";
    $conn = new mysqli('localhost','root','','schoolms');
    if($conn->connect_error){
        die('connection faied : '.$conn->connect_error);
    }else{
        $stmt = $conn->prepare("INSERT INTO `exam`(`exam_id`, `exam_type_id`, `name`, `start_date`)
        VALUES(?, ?, ?, ?)");
        $stmt->bind_param("iiss",$examid, $examtypeid, $name, $startdate);
        $stmt->execute();
        echo "<h1>" . $succ . "</h1>";
        header ("refresh:2;url=exam.php");
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
                <a href="#openModal"><button class="button-3"> Add Exam </button></a>
        </div>
        <div id="openModal" class="modalDialog">
            <div><a href="exam.php" title="Close" class="close">X</a>
                <h2><center>Add Exam</center></h2>
                <br><br>
                <form action="exam.php" method="POST">
                    <label class="formstyle">Exam ID:</label>
                    <input type="text" name="examid" placeholder="Exam ID"><br><br>
                    <label class="formstyle">Exam Type</label>
                    <select name="examtypeid">
                    <?php
                    $con = mysqli_connect('localhost','root', '', 'schoolms');
                    $sql = "SELECT * FROM exam_type";
                    $all_exam_type = mysqli_query($con,$sql);
                    while ($examtypeid = mysqli_fetch_array(
                        $all_exam_type,MYSQLI_ASSOC)):;
                    ?>
                    <option value="<?php echo $examtypeid["exam_type_id"];
                    ?>">
                        <?php echo $examtypeid["exam_type_id"];?>
                    </option>
                    <?php
                        endwhile;
                    ?>
                    </select><br><br>
                    <label class="formstyle">Name:</label>
                    <input type="text" name="name" placeholder="name"><br><br>
                    <label class="formstyle">Start Date:</label>
                    <input type="date" name="date" placeholder="yy/mm/dd"><br><br> 
                    <div class="submitcen">
                        <input class="submit" type="submit" value="Register" name="submit">
                    </div>
                </form>
            </div>
        </div>

        <div class="tabs">

            <div class="tab">
                <a href="student.php"><button id="tab-1" name="tab-group-1">
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
               <div class="content">
                <h3>Exam Informations</h3><br>
                <?php
                $con = mysqli_connect('localhost','root', '', 'schoolms');
                if (!$con)
                {
                die('Could not connect: ');
                }
                $sql = "SELECT * FROM exam";
                $result = $con->query($sql);
                echo "<table class='tableclass'>
                <tr>
                <th>Exam ID</th>
                <th>Exam Type ID</th>
                <th>name</th>
                <th>Start Date</th>
                <th>Actions</th>
                </tr>";
                $i=0;
                while($row = $result-> fetch_assoc())
                {
                echo "<tr>";
                echo "<td>" . $row['exam_id'] . "</td>";
                echo "<td>" . $row['exam_type_id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['start_date'] . "</td>";?>
                <form action="delete.php" method="POST">
                    <input type="hidden" name="exam_id" value="<?php echo $row["exam_id"]?>">
                    <td><input class="button-4" type="submit" name="deleteE" value="Delete"></td>
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

