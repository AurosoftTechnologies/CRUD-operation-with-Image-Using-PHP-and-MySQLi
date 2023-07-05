<?php
include "include/config.php";


if(isset($_FILES['image']))
{
    $file_name=$_FILES['image']['name'];
    $file_tmp=$_FILES['image']['tmp_name'];
    $file_size=$_FILES['image']['size'];
    if($_FILES['image']['size'] > 10526552)
    {
        echo "<br>image size is greater";
    }
    else
    {
        if(move_uploaded_file($file_tmp,'images/'.$file_name))
        { 
            
        }
       }
}

if(isset($_POST["submit"])) {
$checkbox1=$_POST['hoby'];  
$chk="";  
foreach($checkbox1 as $chk1)  
   {  
      $chk .= $chk1.",";  
   }

    $image= $_FILES['image']['name'];
    $sql = "INSERT INTO emp_details (name,email,gender,hoby,department,image,salary) VALUES ('".$_POST['name']."', '".$_POST['email']."' , '".$_POST['gender']."' , '$chk' , '".$_POST['department']."' , '$image', '".$_POST['salary']."')";
    $result = mysqli_query($conn,$sql);
    if($result) {
        echo "Record Successfully Inserted...";
        header("location:emp_list.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">    
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Entry</title>
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
<h1>Employee Entry</h1>
        <form method="post" action="emp_entry.php" enctype = "multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Enter Employee Name">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter Employee Email">
          </div>
          <div class="mb-3">
            <label for="radio" class="form-label">Gender</label><br>
            <input type="radio" name="gender" value = "Male">Male
            <input type="radio" name="gender" value = "Female">Female
          </div>
          <div class = "mb-3">
            <lable for="checkbox" class="form-lablel">Hoby</lable><br>
            <input type = "checkbox" name = "hoby[]" value = "Dance"> Dance
            <input type = "checkbox" name = "hoby[]" value = "Singing"> Singing
            <input type = "checkbox" name = "hoby[]" value = "Reading"> Reading
            <input type = "checkbox" name = "hoby[]" value = "Cooking"> Cooking
          </div>
          <div class="mb-3">
            <label for="department" class="form-label">Department</label>
            <select class="form-control custom-select custom-select-lg mb-3 " name = "department">
                <option selected>Select your department</option>
                <option value="BCA">BCA</option>
                <option value="MCA">MCA</option>
                <option value="BA">BA</option>
                <option value="BBA">BBA</option>
                <option value="Bsc">Bsc</option>
                <option value="Msc">Msc</option>
            </select>
          </div>
          <div class="custom-file mb-3">
          <label for="file" class="form-label"Choose File></label>
            <input type="file" class="form-control custom-file-input" id="image" name = "image">
            <img src="images/<?php echo $image; ?>" width="150px">
          </div>
          <div class="mb-3">
            <label for="salary" class="form-label">Salary</label>
            <input type="text" class="form-control" name="salary" id="salary" placeholder="Enter Employee Salary">
          </div>
          
          <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>







