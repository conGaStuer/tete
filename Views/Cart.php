    <?php
    include("../Database/database.php");
    session_start();
    if (isset($_POST["search_item"]) && !empty($_POST['search'])) {
        $search = $_POST['search'];
        $sql_search = "SELECT * FROM products WHERE item_name LIKE :search";
        $stmt_search = $conn->prepare($sql_search);
        $stmt_search->execute(['search' => "%$search%"]);
        $result_search = $stmt_search->fetchAll(PDO::FETCH_ASSOC);

        if ($result_search && count($result_search) > 0) {
            foreach ($result_search as $row) {
                if ($search == 'chair') header("Location: ../Filter/Chair.php");
                if ($search == 'table') header("Location: ../Filter/Table.php");
                if ($search == 'room') header("Location: ../Filter/Room.php");
                if ($search == 'package') header("Location: ../Filter/Package.php");
            }
        } else {
            header("Location: ../Filter/NotFound.php");
        }
    }

    ?>

    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/cart.css?v=5">
        <script src="https://unpkg.com/scrollreveal"></script>
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

                    <form action='' method='post' class='seacrh-form'>
                        <input type='text' name='search' id=''>
                        <button type='submit' name='search_item' class='search'>Search</button>
                    </form>

                </div>
                <img src="../assets/logo.png" alt="" width="200px" class="logo">
                <div class="nav-user">
                    <i class="fa-regular fa-user"></i>
                    <i class="fa-regular fa-heart"></i>
                    <a href="../Views/Cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
                </div>
            </div>
        </div>

        <div class="item_cart" style="height: 70px">
            <div class="item" style="font-size: 20px; position: relative; top: 0px; left:30px">
                Prodcuct
                <div class="item_name" style="font-size: 20px; position: relative; top: 0px; left:80px">
                    Prodcuct Name
                </div>
                <div class="item_price" style="font-weight: bold; position: relative; top: 0px; left:50px">
                    Prodcuct Price
                </div>
            </div>

            <div style="font-weight: bold; position: relative; top: 0px; left:340px">
                Modify
            </div>
        </div>
        <?php
    $sql = "SELECT * FROM cart";
    $stmt = $conn->query($sql);

    if ($stmt) {
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $rows) {
            // Move $new_price inside the loop
            $new_price = $rows["item_price"] * $rows["quantity"];
    ?>
            <a href="../Views/Product.php?id=<?php echo $rows["id"] ?>">
                <div class="item_cart">
                    <div class="item">
                        <img src="<?php echo $rows["image"] ?>" alt="" class="img" width="200px" height="200px">
                        <div class="item_name" style="font-size: 20px; position: relative; top: 10px;">
                            <?php echo $rows["item_name"] ?>
                        </div>
            </a>
            <div style="font-size: 20px; position: relative; top: 10px; left:250px;">
                <?php
                $quan = filter_input(INPUT_POST, "quan", FILTER_SANITIZE_SPECIAL_CHARS);
                if (isset($_POST["update_button"])) {
                    foreach ($_POST["update"] as $id => $quantity) {
                        $quan = filter_var($quantity, FILTER_SANITIZE_SPECIAL_CHARS);
                
                        $sql_plus = "UPDATE cart SET quantity = :quantity WHERE id = :id";
                        $stmt_plus = $conn->prepare($sql_plus);
                        $stmt_plus->execute(['quantity' => $quan, 'id' => $id]);
                
                        if ($stmt_plus) {
                            // Update the quantity on the page without refreshing
                            $new_price = $rows["item_price"] * $quan;
                        }
                    }
                }

                ?>
                <div class="item_price" style="font-weight: bold; position: relative; top: 40px; left:-100px">
                    <?php echo $new_price ?>
                </div>
                <form action="" method='post'>
        <input type="number" name="update[<?php echo $rows["id"]; ?>]" value="<?php echo $rows["quantity"]; ?>">
        <button type="submit" name="update_button">Update</button>
    </form>

            </div>
                    </div>
                </div>
                <?php
                $id = $rows["id"];
                if (isset($_POST["delete"])) {
                    $delete_id = $_POST["delete_id"];
                    if (isset($_POST["delete"])) {
                        $delete_id = $_POST["delete_id"];
                        $sql_delete = "DELETE FROM cart WHERE id = :id";
                        $stmt_delete = $conn->prepare($sql_delete);
                        $stmt_delete->execute(['id' => $delete_id]);
                    
                        // Redirect the user back to the cart page
                        header("Location: Cart.php");
                        exit(); // Make sure to exit after a header redirect
                    }
                }
                echo "<form action='' method='post'>
                    <input type='hidden' name='delete_id' value='$id'>
                    <button class='delete' type='submit' name= 'delete' style='height:55px;'>Delete</button>
                    </form>";
                ?>
    <?php
        }
    }
    ?>
    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["checkout"])) {
            // Get user information from the session (you should have this information set during login)
            $_SESSION["username"]  = $username ;// Replace with the actual session variable storing user ID
            if ($stmt) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $rows) {
            // Iterate through cart items and insert them into the orders table
                $item_name = $rows['item_name'];
                $item_price = $rows['item_price'];
                $quantity = $rows['quantity'];
    
                // Insert into the orders table
                $sql_insert_order = "INSERT INTO orders (username, item_name, item_price, quantity) 
                                     VALUES (:username, :item_name, :item_price, :quantity)";
                $stmt_insert_order = $conn->prepare($sql_insert_order);
                $stmt_insert_order->execute([
                    ':username' => $username,
                    ':item_name' => $item_name,
                    ':item_price' => $item_price,
                    ':quantity' => $quantity,
                ]);
            }
            }
        }
    
            // Redirect or display a success message
            exit();
        }
    
    ?>
    <form action="" method="post">
        <button class="checkout" name="checkout"> Check out</button>
    </form>
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