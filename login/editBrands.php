<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ims";

//create conn
$connection = new mysqli($servername, $username, $password, $database);

$id = "";
$brand_name = "";
$num_products= "";

$error_message = "";
$successMessage = "";

if($_SERVER['REQUEST_METHOD']=='GET'){
    //GET method: show data

    if(!isset($_GET["id"])) {
        header("location: brand.php");
        exit;
    }

    $id = $_GET["id"];

    //read from db
    $sql = "SELECT * FROM brand WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if(!$row){
        header("location: brands.php");
        exit;
    }

    $brand_name = $row["brand_name"];
    $num_products = $row["num_products"];

}
else{
    //POST method: update data

    $id = $_POST["id"];
    $brand_name = $_POST["brand_name"]; 
    $num_products = $_POST["num_products"];

    do {
        if(empty($id) || empty($brand_name) || empty($num_products)){
            $error_message = "All the fields are reqd";
            break;
        }

        $sql = "UPDATE brand" .
            " SET brand_name ='$brand_name', num_products = '$num_products' " .
            "WHERE id= $id";

        $result = $connection->query($sql);

        if(!$result) {
            $error_message = "Invalid query: " . $connection->error;
            break;
        }

        $successMessage = "Client updated correctly";

        header("location: brands.php");
        exit;
    } while (true);
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
            <input type="hidden"  name="id" value="<?php echo $id; ?> ">
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