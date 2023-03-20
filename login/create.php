<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "ims";

//Create connection
$connection = new mysqli($servername, $username, $password, $database);


$id = "";
$brand_name = "";
$num_products = "";

$error_message = "";
$successMessage = "";

if($_SERVER['REQUEST_METHOD']=='POST'){
    $id = $_POST["id"];
    $brand_name = $_POST["brand_name"];
    $num_products =$_POST["num_products"];
   

    do {
        if (empty($brand_name) || empty($num_products)) {
            $error_message = "All Fields are required";
            break;
        }

        //add new stuff
        $sql = "INSERT INTO brand ( brand_name, num_products)" .
            "VALUES ( '$brand_name', '$num_products')";
        $result = $connection->query($sql);

        if(!$result){
            $error_message = "Invalid query: " . $connection->error;
            break;
        }


        
        $brand_name = "";
        $num_products = "";

        $successMessage = "Client added Correctly";

        header("location: brands.php");
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
        <h2> New Brands </h2>

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
            <label class="col-sm-3 col-form-label">brand_name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="brand_name" value="<?php echo $brand_name; ?>">
            </div>
</div>
<div class="row mb-3">
            <label class="col-sm-3 col-form-label">num_products</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="num_products" value="<?php echo $num_products; ?>">
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
        <a class = "btn btn-outline-primary" href="brands.php" role="button">Cancel</a>
 </div>
</div>

        </form>
</div>
</body>
</html>