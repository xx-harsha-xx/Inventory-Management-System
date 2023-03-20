<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "ims";

//Create connection
$connection = new mysqli($servername, $username, $password, $database);


$id = "";
$pname = "";
$stock = "";
$price = "";

$error_message = "";
$successMessage = "";

if($_SERVER['REQUEST_METHOD']=='POST'){
    $pname = $_POST["pname"];
    $stock =$_POST["stock"];
    $price = $_POST["price"];
    

    do {
        if (empty($pname) || empty($stock) || empty($price)) {
            $error_message = "All Fields are required";
            break;
        }

        //add new stuff
        $sql = "INSERT INTO products (pname, stock, price)" .
            "VALUES ('$pname', '$stock', '$price')";
        $result = $connection->query($sql);

        if(!$result){
            $error_message = "Invalid query: " . $connection->error;
            break;
        }


        $pname = "";
        $stock = "";
        $price = "";
        

        $successMessage = "Client added Correctly";

        header("location: dashboard.php");
        exit;

    } while (false);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>
    <div class="container my-5">
        <h2> New Products </h2>

        <?php 
        if(!empty($error_message)){
            echo "
            <div class ='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$error_message</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                ";
        }
        ?>

        <form method="post">
            <div class="row mb-3">
            <label class="col-sm-3 col-form-label">pname</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="pname" value="<?php echo $pname; ?>">
            </div>
</div>
<div class="row mb-3">
            <label class="col-sm-3 col-form-label">stock</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="stock" value="<?php echo $stock; ?>">
            </div>
</div>

<div class="row mb-3">
            <label class="col-sm-3 col-form-label">price</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="price" value="<?php echo $price; ?>">
            </div>
</div>



<?php
if (!empty($successMessage)) {
    echo "
    <div class='row mb-3'>
        <div class='offset-sm-3 col-sm-6'>
            <div class='alert alert-success alert-dimissible fade show' role='alert'>
            <strong>$successMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
    ";
}

?>


<div class="row mb-3">
    <div class ="offset-sm-3 col-sm-3 d-grid">
        <button type="submit" class=" btn btn-primary">Submit</button>
</div>

    <div class="col-sm-3 d-grid">
        <a class = "btn btn-outline-primary" href="dashboard.php" role="button">Cancel</a>
 </div>
</div>

        </form>
</div>
</body>
</html>