<?php
include "include/config.php";

if(isset($_GET['action'])) {
    $action = $_GET['action'];
    $id = $_GET['id'];
    if($action == 'delete') {
        $result = mysqli_query($conn,"delete from emp_details where id =".$id);
        if($result) {
            echo "Delete Record...";
            header("location: emp_list.php");
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" type="text/css">
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

    <div class="container my-5">
        <h1>Employee List</h1>
        <a href="emp_entry.php"><button class="btn btn-sm btn-info my-2">Add New Employee Detail</button></a>
        <table id="example" class="table table-bordered table-hover" enctype = "multipart/form-data">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Hoby</th>
                    <th>Department</th>
                    <th>Image</th>
                    <th>Salary</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $sql = "SELECT *FROM emp_details";
                $result = mysqli_query($conn,$sql);
                while($row = mysqli_fetch_assoc($result)) {
            ?>
                    <tr>
                        <td><?php echo $row["id"]; ?></td>                      
                        <td><?php echo $row["name"]; ?></td>                      
                        <td><?php echo $row["email"]; ?></td>                      
                        <td><?php echo $row["gender"]; ?></td>                      
                        <td><?php echo $row["hoby"]; ?></td>                      
                        <td><?php echo $row["department"]; ?></td>                      
                        <td><?php echo $row["image"]; ?>
                            <img src="images/<?php echo $row["image"]; ?>" width="50px" height="50px">
                        </td>                  
                        <td><?php echo $row["salary"]; ?></td>                      
                        <td style="width:150px;">
                            <a href="emp_edit.php?action=update&id=<?php echo $row['id']; ?>"><button class="btn btn-sm btn-success">Update</button></a>
                            <a href="emp_list.php?action=delete&id=<?php echo $row['id']; ?>" onclick = "return confirm('Do you want Delete?')"><button class="btn btn-sm btn-danger">Delete</button></a>
                        </td>
                    </tr>
<?php } ?>
             
            </tbody>
        </table>

    </div>
     <!-- jQuery first, then Popper.js, then Bootstrap JS -->
     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        
        <script src = "https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src = "https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
   <script>
    $(document).ready(function () {
        $('#example').DataTable();
    });
   </script> 
</body>
</html>