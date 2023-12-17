<?php 
include("../Database/database.php");

session_start();
if(isset($_SESSION['username']) && $_SESSION['username'] != "" ) {
    $username = $_SESSION["username"];
}
if(isset($_SESSION['password']) && $_SESSION['password'] != "" ) {
    $password = $_SESSION["password"];
}
echo "Hello" . $username;
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/adminPage.css?v=3">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>
<body>
    <a href="../Admin/adminPage.php">Return to admin Page</a>

    <?php 
    include("../Database/database.php");

    echo "
    <form action='' method='post' class='seacrh-form'>
        <input type='text' name='search' id=''>
        <button type='submit' name='search_item' class='search'>Search</button>
    </form>";
    ?>

    <table>
        <tr>
            <th>ID</th>
            <th>Item_name</th>
            <th>Item_imageLink</th>
            <th>Item_price</th>
            <th>Item_tag</th>
            <th>Edit</th>
        </tr>

        <?php 
        include("../Database/database.php");

        if(isset($_POST["search_item"]) && !empty($_POST['search']) ) {
            $search =  $_POST['search'];
            $sql_search = "SELECT * from products where item_name like :search";
            $stmt_search = $conn->prepare($sql_search);
            $stmt_search->bindValue(':search', "%$search%", PDO::PARAM_STR);
            $stmt_search->execute();

            if($stmt_search->rowCount() > 0) {
                if( $search == 'chair') {
                    header("Location: ../Admin/chair.php");
                } elseif($search == 'table') {
                    header("Location: ../Admin/table.php");
                } elseif($search == 'room') {
                    header("Location: ../Admin/room.php");
                } elseif($search == 'package') {
                    header("Location: ../Admin/package.php");
                }
            }  else {
                header("Location: ../Filter/NotFound.php");
            }      
        }

        $sql = 'SELECT * from products where item_tag = "table"';
        $stmt = $conn->query($sql);

        if (isset($_POST["delete"])) {
            // Get the ID of the product to delete
            $delete_id = $_POST["delete_id"];

            // Delete the product from the database
            $sql_delete = "DELETE FROM products WHERE id = :delete_id";
            $stmt_delete = $conn->prepare($sql_delete);
            $stmt_delete->bindValue(':delete_id', $delete_id, PDO::PARAM_INT);
            $stmt_delete->execute();
        }

        if($stmt->rowCount() > 0) {
            while($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><span><?php echo $rows["id"] ?></span></td>
                    <td><span><?php echo $rows["item_name"] ?></span></td>
                    <td><span><?php echo $rows["image"] ?></span></td>
                    <td><span><?php echo $rows["item_price"] ?></span></td>
                    <td><span><?php echo $rows["item_tag"] ?></span></td>
                    <td>
                        <button class="update"><a href="../Admin/update.php?id=<?php echo $rows["id"] ?>">Update</a></button>
                        <?php
                        $id = $rows["id"];

                        echo "<form action='' method='post'>
                        <input type='hidden' name='delete_id' value='$id'>
                        <button class='delete' type='submit' name= 'delete' >Delete</button>
                        </form>" ;
                        ?>
                    </td>
                </tr>
                <?php
            }
        }
        ?>

        <button class="add" ><a href="../Admin/add.php">Add new items</a></button>
    </body>
    </html>
