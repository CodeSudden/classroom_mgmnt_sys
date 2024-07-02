<?php
$conn = mysqli_connect('localhost','root', '', 'schoolms');
if (!$conn)
{
die('Could not connect: ');
}
if (isset($_POST['deleteS'])){
    $studentid = $_POST['student_id'];
    $sql = "DELETE FROM student WHERE student_id= '$studentid'";
    if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully";
        header ("refresh:2;url=student.php");
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

if (isset($_POST['deleteT'])){
    $teacherid = $_POST['teacher_id'];
    $sql = "DELETE FROM teacher WHERE teacher_id= '$teacherid'";
    if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully";
        header ("refresh:2;url=teacher.php");
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

if (isset($_POST['deleteP'])){
    $parentid = $_POST['parent_id'];
    $sql = "DELETE FROM parent WHERE parent_id= '$parentid'";
    if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully";
        header ("refresh:2;url=parent.php");
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

if(isset($_POST['deleteC'])){
    $classroomid = $_POST['classroom_id'];
    $sql = "DELETE FROM classroom WHERE classroom_id= '$classroomid'";
    if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully";
        header ("refresh:2;url=classroom.php");
    } else {
    echo "Error deleting record: " . mysqli_error($conn);
}
}

if (isset($_POST['deleteG'])){
    $gradeid = $_POST['grade_id'];
    $sql = "DELETE FROM grade WHERE grade_id= '$gradeid'";
    if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully";
        header ("refresh:2;url=grade.php");
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

if (isset($_POST['deleteCO'])){
    $courseid = $_POST['course_id'];
    $sql = "DELETE FROM course WHERE course_id= '$courseid'";
    if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully";
        header ("refresh:2;url=course.php");
    } else {
    echo "Error deleting record: " . mysqli_error($conn);
}
}

if (isset($_POST['deleteCS'])){
    $classroomid = $_POST['classroomid'];
    $studentid = $_POST['studentid'];
    $sql = "DELETE FROM classroom_student WHERE classroom_id= '$classroomid' and student_id= '$studentid'";
    if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully";
        header ("refresh:2;url=classroom_student.php");
    } else {
    echo "Error deleting record: " . mysqli_error($conn);
}
}

if (isset($_POST['deleteE'])){
    $examid = $_POST['exam_id'];
    $sql = "DELETE FROM exam WHERE exam_id= '$examid'";
    if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully";
        header ("refresh:2;url=exam.php");
    } else {
    echo "Error deleting record: " . mysqli_error($conn);
}
}

if (isset($_POST['deleteET'])){
    $examtypeid = $_POST['exam_type_id'];
    $sql = "DELETE FROM exam_type WHERE exam_type_id= '$examtypeid'";
    if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully";
        header ("refresh:2;url=examtype.php");
    } else {
    echo "Error deleting record: " . mysqli_error($conn);
}
}

if (isset($_POST['deleteER'])){
    $examid = $_POST['exam_id'];
    $studentid = $_POST['student_id'];
    $courseid = $_POST['course_id'];
    $sql = "DELETE FROM exam_result WHERE exam_id= '$examid' and student_id = '$studentid' and course_id = '$courseid'";
    if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully";
        header ("refresh:2;url=exam_results.php");
    } else {
    echo "Error deleting record: " . mysqli_error($conn);
}
}

if (isset($_POST['deleteA'])){
    $date = $_POST['date'];
    $studentid = $_POST['studentid'];
    $sql = "DELETE FROM attendance WHERE date= '$date' and student_id= '$studentid'";
    if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully";
        header ("refresh:2;url=attendance.php");
    } else {
    echo "Error deleting record: " . mysqli_error($conn);
}
}

mysqli_close($conn);
?>

