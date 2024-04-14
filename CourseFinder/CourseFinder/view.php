<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>HOME</title>
</head>
<body class="d-flex flex-column min-vh-100">

<?php include 'header.php';?>

<?php
session_start();
require_once "database.php";
if (!isset($_SESSION['authenticated']))
{
    //if the value was not set, you redirect the user to your login page
    header("location: index.php");
    exit;
}

?>

<div class="h3-save"><h3>Your saved Courses</h3></div>
<p style="color: black; text-align: center; margin-top:30px;">View all saved courses with ease.</p>

<?php
//showing each row in the courses table if the current user has saved that course
$user = $_SESSION['user'];
$sql = "SELECT * FROM courses WHERE courseCode IN (SELECT courseCode FROM saved JOIN users WHERE saved.username = '$user')";
$res = $conn->query($sql) or die($conn->error);
$count = 0;

while($row = $res->fetch_assoc())
{
    //display table
    if ($count == 0)
    {
        echo '
        <div class="container"> 
        <form method="post">
        <table class="table table-striped" style="margin-top: 50px; margin-bottom: 80px;">
            <thead>
                <tr>
                    <th>courseCode</th>
                    <th>Course Title</th>
                    <th>University</th>
                    <th>Duration</th>
                    <th>Start Year</th>
                    <th>CategoryID</th>
                    <th>Saved</th>
                    <th>Click to Remove</th>
                </tr>
            </thead>
            <tbody>';
    }
    
    echo '
    <tr>
    <td>' . $row['courseCode']  . '</td>'.'
    <td>' . $row['courseTitle']  . '</td>'.'
    <td>' . $row['university']  . '</td>'.'
    <td>' . $row['durationYears']  . '</td>'.'
    <td>' . $row['startYear']  . '</td>'.'
    <td>' . $row['categoryID']  . '</td>'.'
    <td>' . $row['saved']  . '</td>'.'
        <td><button value="' . $row['courseCode'] . '" name="delete_button" class="btn btn-sm" style="margin-top: 0px !important;">remove</button></td>'.'
    </tr>';

    $count = 1;

}

echo'
</tbody>
</table>
</div>
</form>
';

//if user clicks delete button
if (isset($_POST["delete_button"]))
{
    $courseCode_delete = $_POST["delete_button"];
    $user = $_SESSION['user'];

    //change the saved value to N
    $sql2 = "UPDATE courses SET saved = 'N' WHERE courseCode = '$courseCode_delete'";

    if ($conn->query($sql2) === TRUE)
    {
        //delete course from saved table
        $sql3 = "DELETE FROM saved WHERE courseCode = '$courseCode_delete'";

        if ($conn->query($sql3) === TRUE)
        {
            echo '<script>alert("COURSE REMOVED!")</script>';
        }

    }
}

$conn->close();
?>

<?php include 'footer.php';?>

</body>

</html>