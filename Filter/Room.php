<?php
include("../Database/database.php");

try {
    // Create a new PDO instance

    // Fetch filtered products
    $stmt = $conn->prepare("SELECT * FROM products WHERE item_tag = 'room'");
    $stmt->execute();
    $result_filter = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/shop.css?v=2">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>
<body>
   
    <!-- ... Your existing HTML code ... -->
    <div class="side-bar">

<i class="fa-solid fa-x" onClick="onClickSideBar()"></i>
    <ul>
    <li><a href="../Views/index.php">Home</a></li>
    <li><a href="../Views/Shop.php">Shop</a></li>
    <li><a href="../Views/Aboutus.php">About us</a></li>
    <li><a href="../Views/Contact.php">Contact us</a></li>
    </ul>
</div>
<div class="overlay">

</div>
    <div class="nav-side">
        <div class="nav-bar">
            <div class="nav-menu">
                <i class="fa-solid fa-bars" onClick="menu()"></i>
                <i class="fa-solid fa-magnifying-glass"></i>
                <?php 
                        include("../Database/database.php");


            if(isset($_POST["search_item"]) && !empty($_POST['search']) ) {
                $search =  $_POST['search'];
                $sql_search = "SELECT * from products where item_name like '%$search%'";
                $result_search = mysqli_query($conn,$sql_search);
                if($result_search && mysqli_num_rows($result_search) > 0) {
                    if( $search == 'chair')
                    header("Location: ../Filter/Chair.php"); 
                    else if($search == 'table') {
                        header("Location: ../Filter/Table.php"); 
                    }
                    else if($search == 'room') {
                        header("Location: ../Filter/Room.php"); 
                    }
                    else if($search == 'package') {
                        header("Location: ../Filter/Package.php"); 
                    }
                }  else {
                    header("Location: ../Filter/NotFound.php");
                }      
            }

            echo "
            <form action='' method='post' class='seacrh-form'>
                <input type='text' name='search' id=''>
                <button type='submit' name='search_item' class='search'>Search</button>
            </form>";
            
            ?>
            </div>
            <img src="../assets/logo.png" alt="" width="200px" class="logo">
            <div class="nav-user">
            <i class="fa-regular fa-user"></i>
            <i class="fa-regular fa-heart"></i>
            <a href="../Views/Cart.php"><i class="fa-solid fa-cart-shopping"></i></a> 
            </div>
        </div>
    </div>
    <section>
        <div class="filter-side">
            <p>Filter Products</p>
            <!-- Update your filter links with PHP -->
            <a href="../Filter/Chair.php" class="filter-page"><div><i class="fa-solid fa-square-check"></i> Chair</div></a>
            <a href="../Filter/Room.php" class="filter-page"><div><i class="fa-solid fa-square-check"></i> Room</div></a>
            <a href="../Filter/Package.php" class="filter-page"><div><i class="fa-solid fa-square-check"></i> Package</div></a>
            <a href="../Filter/Table.php" class="filter-page"><div><i class="fa-solid fa-square-check"></i> Table</div></a>
        </div>
        <div class="products-side">
            <?php
            if ($result_filter) {
                foreach ($result_filter as $rows) {
            ?>
                    <a href="../Views/Product.php?id=<?php echo $rows["id"] ?>">
                        <div class="product">
                            <img src="<?php echo $rows["image"] ?>" alt="" class="img" width="280px" height="400px">
                            <div class="item_name" style="font-size: 20px; position: relative; top: 10px; color: black">
                                <?php echo $rows["item_name"] ?>
                            </div>
                            <div class="item_price" style="font-weight: bold; position: relative; top: 15px; color: black">
                                <?php echo "$" . " " .  $rows["item_price"] ?>
                            </div>
                        </div>
                    </a>
            <?php
                }
            }
            ?>
        </div>
    </section>

    <!-- ... Your existing HTML code ... -->

</body>
</html>
<script>
        const sideBar = document.getElementsByClassName("side-bar")[0];
    const overlay =  document.getElementsByClassName("overlay")[0];
    const navSide = document.getElementsByClassName("nav-side")[0];
    const onClickSideBar = () => {
        sideBar.style.left = "-300px";
        navSide.style.display = "flex";
        overlay.style.opacity = 0;
        overlay.style.zIndex = -2;
    }
    const menu = () => {
        sideBar.style.left = "0px";
        overlay.style.opacity = 1;
        overlay.style.zIndex = 2;
        navSide.style.display = "none";
    }


</script> 
