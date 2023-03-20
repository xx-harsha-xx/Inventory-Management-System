


<!DOCTYPE html>
<html>
    <head>
        <title> Dashboard - Inventory Management System</title>

        <link rel="stylesheet" type ="text/css" href="../login/login.css">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Lora:ital@1&display=swap');
            </style>
            <script src="https://kit.fontawesome.com/1a25d359d9.js" crossorigin="anonymous"></script>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
            
    </head>
    <body>
        <div>
            <div id="dashboardMainContainer">
            <div class="dashboard_sidebar" id="dasboard_sidebar">
                    <h3 class="dashboard_logo">IMS
                    </h3>
                    <div class="dashboard_sidebar_user">
                        <img src="../images/121.png" alt="user image"/>
                        <span>
                        
                            <p>John Doe</p></span>
                    </div>
                    <div class="dashboard_sidebar_menus">
                        <ul class="dashboard_menu_lists">
                            <li> <!--class="menuActive" --> 
                            <a href="../login/dashboard.php"  style="text-decoration: none;"><i class="fa-solid fa-dashboard "></i> Inventory </a></li>
                            <li>
                            <a href="brands.php"  style="text-decoration: none;"><i class="fa-sharp fa-solid fa-chart-simple"></i> Brands </a></li>
                            </li>

                        </ul>
                    </div>
                        
                </div>
                <div class="dashboard_content_container my-5">
                <h2> Brands</h2>
                <a class ="btn btn-primary" href="create.php" role="button">Add</a>
                <br>
                <table class="table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>brand_name</th>
                        <th>num_products</th>
                        <th>created_at</th>
                        <th>Action <th>
                </thead>
            
            <tbody>
            <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $database = "ims";

                    $connection = new mysqli($servername, $username, $password, $database);

                    if($connection->connect_error){
                        die("Connection failed: " . $connection->connect_error);
                    }

                    $sql = "SELECT * FROM brand";
                    $result = $connection->query($sql);
                    
                    if(!$result){
                        die("Invalid  query: " . $connection->error);
                    }

                    while($row = $result->fetch_assoc()){
                        echo "
                        <tr>
                        <td>$row[id]</td>
                        <td>$row[brand_name]</td>
                        <td>$row[num_products]</td>
                        <td>$row[created_at]</td>
                        <td>
                        <a class ='btn btn-primary btn-sm' href= 'editBrands.php?id=$row[id]'> Edit</a>
                        <a class ='btn btn-danger btn-sm' href= 'deletebrands.php?id=$row[id]'> Delete</a>
                        </td>
                        </tr>
                        ";
                    }

                    ?>
            </tbody>
            

            <div class="dashboard_nav">
                <a href="../homepage/homepage.php" id="logoutBtn"><i class="fa-solid fa-right-from-bracket">Log-Out</i></a>
            </div>
                <div class="dashboard_content">
                    <div class="dashboard_content_main">

                    </div>               
                 </div>
                 </table>
            </div>
           
        </div>      
    </body>
</html>