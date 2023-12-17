<?php
include("../Database/database.php");

session_start();
if (isset($_SESSION['username']) && $_SESSION['username'] != "") {
    $username = $_SESSION["username"];
}
if (isset($_SESSION['password']) && $_SESSION['password'] != "") {
    $password = $_SESSION["password"];
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/adminPage.css?v=3">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
          integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>
<body>
<a href="../Admin/adminPageUser.php"><button>Manage Users</button></a>

<?php
include("../Database/database.php");

if (isset($_POST["search_item"]) && !empty($_POST['search'])) {
    $search = $_POST['search'];
    $sql_search = "SELECT * FROM products WHERE item_name LIKE :search";
    $stmt = $conn->prepare($sql_search);
    $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        if ($search == 'chair') {
            header("Location: ../Admin/chair.php");
        } else if ($search == 'table') {
            header("Location: ../Admin/table.php");
        } else if ($search == 'room') {
            header("Location: ../Admin/room.php");
        } else if ($search == 'package') {
            header("Location: ../Admin/package.php");
        }
    } else {
        header("Location: ../Filter/NotFound.php");
    }
}

echo "
<form action='' method='post' class='search-form'>
    <input type='text' name='search' id=''>
    <button type='submit' name='search_item' class='search'>Search</button>
</form>";
?>

<button class="add"><a href="../Admin/add.php">Add new items</a></button>

<table>
    <tr>
        <th>ID</th>
        <th>Item_name</th>
        <th>Item_imageLink</th>
        <th>Item_price</th>
        <th>Item_tag</th>
        <th>Quantity</th>
        <th>Edit</th>
    </tr>

    <?php
    $sql = "SELECT * FROM products";
    $stmt = $conn->query($sql);

    if ($stmt->rowCount() > 0) {
        while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <tr>
                <td><span><?php echo $rows["id"] ?></span></td>
                <td><span><?php echo $rows["item_name"] ?></span></td>
                <td><span><?php echo $rows["image"] ?></span></td>
                <td><span><?php echo $rows["item_price"] ?></span></td>
                <td><span><?php echo $rows["item_tag"] ?></span></td>
                <td><span><?php echo $rows["quantity"] ?></span></td>
                <td>
                    <button class="update"><a
                                href="../Admin/update.php?id=<?php echo $rows["id"] ?>">Update</a></button>
                    <?php
                    $id = $rows["id"];
                    if (isset($_POST["delete"])) {
                        // Get the ID of the product to delete
                        $delete_id = $_POST["delete_id"];
                        if ($delete_id == $id) {
                            // Delete the product from the database
                            $sql_delete = "DELETE FROM products WHERE id = :delete_id";
                            $stmt_delete = $conn->prepare($sql_delete);
                            $stmt_delete->bindValue(':delete_id', $delete_id, PDO::PARAM_INT);
                            $stmt_delete->execute();
                        }
                    }
                    echo "<form action='' method='post'>
                        <input type='hidden' name='delete_id' value='$id'>
                        <button class='delete' type='submit' name='delete'>Delete</button>
                        </form>";
                    ?>
                </td>
            </tr>
            <?php
        }
    }
    ?>
</table>
</body>
</html>
