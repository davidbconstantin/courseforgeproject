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
    <title>SEARCH</title>
</head>
<body class="d-flex flex-column min-vh-100">

    <?php
    session_start();
    require_once "database.php";
    if (!isset($_SESSION["authenticated"]))
    {
        //if the value was not set, you redirect the user to your login page
        header("location: index.php");
        exit;
    }
    
    include 'header.php';
    ?>

    <div class="container" style="margin-top: 50px;">
        <div class="row">
            <div class="col-6">
                <div class="global-container-search">
                    <div class="card form-search">
                        
                        <h3 class="card-title text-center">Search by University or/and Course Title</h3>
                        <div class="card-text">
                            
                            <form method="post"> 

                                <div class="form-group">
                                    <label for="title">Course title:</label>
                                    <input type="text" class="form-control form-control-sm" name="courseTitle">
                                </div>

                                <div class="form-group">
                                    <label for="university">University:</label>
                                    <input type="text" class="form-control form-control-sm" name="university">
                                </div>

                                <br>

                                <button type="submit" name="submit_button" class="btn btn-block">search</button>

                            </form>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-6">
                <div class="global-container-search">
                    <div class="card form-search">
                        
                        <h3 class="card-title text-center">Search by Category</h3>
                        <div class="card-text">
                            
                            <form method="post"> 

                                <label for="category">Category:</label>
                                <select class="form-control form-control-sm" name="category">
                                    <option disabled selected>-- Select Category --</option>
                                    <?php
                                        //getting all categories
                                        $sql = "SELECT categoryDescription From categories";  // Use select query here 
                                        $res = $conn->query($sql) or die($conn->error);

                                        while($row = $res->fetch_assoc())
                                        {
                                            echo "<option value='". $row['categoryDescription'] ."'>" .$row['categoryDescription'] ."</option>";
                                            // displaying data in option menu
                                        }	
                                    ?>  
                                </select>    
                                <br>
                                <button type="submit" name="submit_button_cat" class="btn btn-block">search</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    error_reporting(0);

    //searching by university
    if (!empty($_POST["university"]) && empty($_POST["courseTitle"]))
    {
        $search_value = $_POST["university"];        
        $sql = "SELECT * FROM courses WHERE university LIKE '%$search_value%'";
    }

    //searching by title
    else if (empty($_POST["university"]) && !empty($_POST["courseTitle"]))
    {
        $search_value = $_POST["courseTitle"]; 
        $sql = "SELECT * FROM courses WHERE courseTitle LIKE '%$search_value%'";
    }

    //searching by title and university
    else if (!empty($_POST["university"]) && !empty($_POST["courseTitle"]))
    {
        $courseTitle = $_POST["courseTitle"];
        $university = $_POST["university"];
        
        $sql = "SELECT * FROM courses WHERE courseTitle LIKE '%$courseTitle%' AND university LIKE '%$university%'";
    }  

    //searching by category
    else if (isset($_POST["submit_button_cat"]))
    {
        $search_value = $_POST["category"];
        $sql = "SELECT * FROM courses JOIN categories ON courses.categoryID = categories.categoryID WHERE categoryDescription ='$search_value'";
    }

    //display everything if nothing is filled
    else if (empty($_POST["university"]) && empty($_POST["courseTitle"]))
    {
        $sql = "SELECT * FROM courses";
    }

    $res = $conn->query($sql) or die($conn->error);
    $count = 0;

    while($row = $res->fetch_assoc())
    {
        //displaying table
        //only display the table header once
        if ($count == 0)
        {
            echo '
            <div class="container"> 
            <form method="post">
            <table class="table table-striped" style="margin-top: 50px; margin-bottom: 80px;">
                <thead>
                    <tr>
                        <th>Course Code</th>
                        <th>Course Title</th>
                        <th>University</th>
                        <th>Duration</th>
                        <th>Start Year</th>
                        <th>Category ID</th>
                        <th>Saved</th>
                        <th>Click to Save</th>
                    </tr>
                </thead>
                <tbody>';
        }
        
        //if course isnt saved, disiaply a save button
        if ($row['saved'] == "N")
        {
            echo '
            <tr>
                <td>' . $row['courseCode']  . '</td>'.'
                <td>' . $row['courseTitle']  . '</td>'.'
                <td>' . $row['university']  . '</td>'.'
                <td>' . $row['durationYears']  . '</td>'.'
                <td>' . $row['startYear']  . '</td>'.'
                <td>' . $row['categoryID']  . '</td>'.'
                <td>' . $row['saved']  . '</td>'.'
                <td><button value="' . $row['courseCode'] . '" name="save_button" class="btn btn-sm" style="margin-top: 0px !important;">save</button></td>'.'
            </tr>';
        }

        else
        {
            echo '
            <tr>
                <td>' . $row['courseCode']  . '</td>'.'
                <td>' . $row['courseTitle']  . '</td>'.'
                <td>' . $row['university']  . '</td>'.'
                <td>' . $row['durationYears']  . '</td>'.'
                <td>' . $row['startYear']  . '</td>'.'
                <td>' . $row['categoryID']  . '</td>'.'
                <td>' . $row['saved']  . '</td>'.'
                <td></td>'.'
            </tr>';
        }


        $count = 1;
    }

    echo'
    </tbody>
    </table>
    </div>
    </form>
    ';

    //if user clicks save button
    if (isset($_POST["save_button"]))
    {
        $courseCode = $_POST["save_button"];
        $date = date("Y-m-d");
        $user = $_SESSION['user'];

        //update course to saved
        $sql2 = "UPDATE courses SET saved = 'Y' WHERE courseCode = '$courseCode'";
        

        if ($conn->query($sql2) === TRUE)
        {
            //insert users details into saved table
            $sql3 = "INSERT INTO saved VALUES ('$courseCode', '$user', '$date')";

            if ($conn->query($sql3) === TRUE)
            {
                echo '<script>alert("COURSE SAVED")</script>';
            }

        }
    }
    
    $conn->close();
    include 'footer.php';
?>


</body>
</html>