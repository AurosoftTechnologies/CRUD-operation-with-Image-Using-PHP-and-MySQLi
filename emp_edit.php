<?php
include "include/config.php";
print_r($_POST);
if(isset($_POST['submit'])) {
    $id = $_POST['id'];
    $image = trim($_FILES['image']['name']);
    move_uploaded_file($_FILES['image']['tmp_name'], "images/".$_FILES['image']['name']);
    $checkbox1=$_POST['hoby'];  
    $chk="";  
    foreach($checkbox1 as $chk1)  
    {  
          $chk .= $chk1.",";  
    }
    $sql = "UPDATE emp_details SET name = '".$_POST['name']."', email = '".$_POST['email']."', gender = '".$_POST['gender']."' , hoby = '$chk'  ,department = '".$_POST['department']."', image =  '$image' , salary = '".$_POST['salary']."' where id = '".$_POST['id']."'     ";
    $result = mysqli_query($conn,$sql);
    if($result) {
        echo "Record Updated";
        header("location:emp_list.php");
    }
}

$id = '';
$name = '';
$email = '';
$gender = '';
$hoby = '';
$department = '';
$image = '';
$salary = '';

if(isset($_GET['action'])) {
    $action = $_GET['action'];
    $id = $_GET['id'];
if($action == 'update') 
    $result = mysqli_query($conn, "SELECT * FROM emp_details where id =".$id);
    $row = mysqli_fetch_assoc($result);
    if(isset($row)) {
        $id = $row['id'];
        $name = $row['name'];
        $email = $row['email'];
        $gender = $row['gender'];
        $hoby = $row['hoby'];
        $department = $row['department'];
        $image = $row['image'];
        $salary = $row['salary'];
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Edit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Employee</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>


                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

<div class = "container my-5">
<h1>Edit Employee Details</h1>
        <form method="post" action="emp_edit.php" enctype="multipart/form-data">
            <input type = "hidden" name = "id" value = "<?php echo $id; ?>">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Enter Employee Name" value = "<?php echo $name; ?>">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter Employee Email" value = "<?php echo $email; ?>">
          </div>
          <div class="mb-3">
            <label for="gender" class="form-label">Gender</label><br>
            <input type="radio" name="gender" <?php if ($gender=="Male") echo "checked";?>  value = "Male">Male
            <input type="radio" name="gender" <?php if ($gender=="Female") echo "checked";?>  value = "Female">Female
          </div>
          <div class = "mb-3">
            <lable for="checkbox" class="form-lablel">Hoby</lable><br>
            <?php 
					$chkbox=$row['hoby'];
					$arr=explode(",",$chkbox);
					
					?>
            <input type = "checkbox" name = "hoby[]" <?php if(in_array("Dance",$arr)){ echo "checked";}?>  value = "Dance"> Dance
            <input type = "checkbox" name = "hoby[]" <?php if(in_array("Singing",$arr)){ echo "checked";}?>  value = "Singing"> Singing
            <input type = "checkbox" name = "hoby[]" <?php if(in_array("Reading",$arr)){ echo "checked";}?>  value = "Reading"> Reading
            <input type = "checkbox" name = "hoby[]" <?php if(in_array("Cooking",$arr)){ echo "checked";}?>  value = "Cooking"> Cooking

          </div>
          <div class="mb-3">
            <label for="department" class="form-label">Department</label>
            <select class="form-control custom-select custom-select-lg mb-3" name = "department" value = "">
                <option selectednt><?php echo $department; ?></option>
                <option value="BCA"> BCA</option>
                <option value="MCA">MCA</option>
                <option value="BA">BA</option>
                <option value="BBA">BBA</option>
                <option value="Bsc">Bsc</option>
                <option value="Msc">Msc</option>
            </select>
          </div>
          <div class="custom-file mb-3">
          <label for="file" class="form-label"Choose File></label>
            <input type="file" class="form-control custom-file-input" id="image" name = "image" value = "<?php echo $image; ?>">
            <img src="images/<?php echo $image; ?>" width="50px" height="50px">
          </div>
          <div class="mb-3">
            <label for="salary" class="form-label">Salary</label>
            <input type="text" class="form-control" name="salary" id="salary" placeholder="Enter Employee Salary" value = "<?php echo $salary; ?>">
          </div>
          
          <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>