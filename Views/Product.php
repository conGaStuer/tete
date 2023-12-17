<?php
include("../Database/database.php");

$id = $_GET["id"];

$sql_select = "SELECT * FROM products WHERE id = :id";
$stmt = $conn->prepare($sql_select);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$item_name = $row["item_name"];
$image = $row["image"];
$item_price = $row["item_price"];
$item_tag = $row["item_tag"];
$quantity = $row["quantity"];
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/product.css?v=2">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>

<body>
    <div class="side-bar">
        <i class="fa-solid fa-x" onClick="onClickSideBar()"></i>
        <ul>
            <li><a href="../Views/index.php">Home</a></li>
            <li><a href="../Views/Shop.php">Shop</a></li>
            <li><a href="../Views/Aboutus.php">About us</a></li>
            <li><a href="../Views/Contact.php">Contact us</a></li>
        </ul>
    </div>
    <div class="overlay"></div>
    <div class="nav-side">
        <div class="nav-bar">
            <div class="nav-menu">
                <i class="fa-solid fa-bars" onClick="menu()"></i>
                <i class="fa-solid fa-magnifying-glass"></i>
                <?php
                include("../Database/database.php");

                if (isset($_POST["search_item"]) && !empty($_POST['search'])) {
                    $search =  $_POST['search'];
                    $sql_search = "SELECT * from products where item_name like :search";
                    $stmt_search = $conn->prepare($sql_search);
                    $stmt_search->execute(['search' => "%$search%"]);
                    $result_search = $stmt_search->fetchAll(PDO::FETCH_ASSOC);

                    if ($result_search && count($result_search) > 0) {
                        if ($search == 'chair') header("Location: ../Filter/Chair.php");
                        else if ($search == 'table') header("Location: ../Filter/Table.php");
                        else if ($search == 'room') header("Location: ../Filter/Room.php");
                        else if ($search == 'package') header("Location: ../Filter/Package.php");
                    } else {
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
    <h4>Home/Shop/New & Now/ <?php echo $row["item_name"] ?></h4>
    <section>
        <div class="product-image">
            <img src="<?php echo $row["image"] ?>" alt="">
        </div>
        <div class="product-info">
            <div class="product_name">
                <?php echo $row["item_name"] ?>
            </div>
            <div class="product_rating">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <span>Stock: In stock</span>
            </div>
            <div class="product_price">
                $ <?php echo $row["item_price"] ?>
            </div>
            <div class="product_descrip">
                Aliquam condimentum dictum gravida. Sed eu odio id lorem fermentum faucibus. Cras tempor semper ligula.
            </div>
            <?php
            try {
                if (isset($_POST["add_to_cart"])) {
                    $sql_insert = "INSERT INTO cart (id,item_name,image,item_price,item_tag,quantity)
                        values (:id, :item_name, :image, :item_price, :item_tag, :quantity)";
                    $stmt_insert = $conn->prepare($sql_insert);
                    $stmt_insert->bindParam(':id', $id, PDO::PARAM_INT);
                    $stmt_insert->bindParam(':item_name', $item_name, PDO::PARAM_STR);
                    $stmt_insert->bindParam(':image', $image, PDO::PARAM_STR);
                    $stmt_insert->bindParam(':item_price', $item_price, PDO::PARAM_STR);
                    $stmt_insert->bindParam(':item_tag', $item_tag, PDO::PARAM_STR);
                    $stmt_insert->bindParam(':quantity', $quantity, PDO::PARAM_INT);

                    $stmt_insert->execute();

                    if ($stmt_insert) {
                        echo "Add successful!!!";
                    }
                }
            } catch (PDOException $e) {
                echo "The Item is already in Cart";
            }
            ?>
            <form action='' method='post'>
                <button type='submit' class='add' name='add_to_cart' style='height: 55px;'>ADD TO CART</button>
            </form>
            <button class="buy"><a>BUY NOW</a></button>
            <div class="product-detail">
                SKU:0093<br>
                BRANDS:Creative Design<br>
                TAGS:Furniture, Trending, Wood
            </div>
        </div>
    </section>
</body>
</html>

<script>
    const sideBar = document.getElementsByClassName("side-bar")[0];
    const overlay = document.getElementsByClassName("overlay")[0];
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
<?php
$conn = null; // Close the PDO connection
?>
