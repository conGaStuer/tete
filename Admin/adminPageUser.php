<?php 
include("../Database/database.php");

session_start();
if(isset($_SESSION['username']) && $_SESSION['username'] != "" ) {
    $username = $_SESSION["username"];
}
if(isset($_SESSION['password']) && $_SESSION['password'] != "" ) {
    $password = $_SESSION["password"];
}

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
    <a href="../Admin/adminPage.php"><button>Manage Products</button></a>
    <?php
    include("../Database/database.php");

    if(isset($_POST["search_item"]) && !empty($_POST['search'])) {
        $search =  $_POST['search'];
        $sql_search = "SELECT * FROM furnitures WHERE username LIKE :search";
        $stmt_search = $conn->prepare($sql_search);
        $stmt_search->bindValue(':search', "%$search%", PDO::PARAM_STR);
        $stmt_search->execute();

        if($stmt_search->rowCount() > 0) {
            if( $search == 'chair') {
                header("Location: ../Admin/chair.php");
            } else if($search == 'table') {
                header("Location: ../Admin/table.php");
            } else if($search == 'room') {
                header("Location: ../Admin/room.php");
            } else if($search == 'package') {
                header("Location: ../Admin/package.php");
            }
        } else {
            header("Location: ../Filter/NotFound.php");
        }      
    }
    ?>

    <table>
        <tr>
            <th>ID</th>
            <th>UserName</th>
            <th>Password</th>
            <th>Reg_date</th>
            <th>Edit</th>
        </tr>
        <?php 
        $sql = "SELECT * FROM furnitures";
        $stmt = $conn->query($sql);

        if($stmt->rowCount() > 0) {
            while($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><span><?php echo $rows["id"] ?></span></td>
                    <td><span><?php echo $rows["username"] ?></span></td>
                    <td><span><?php echo $rows["password"] ?></span></td>
                    <td><span><?php echo $rows["reg_date"] ?></span></td>
                    <td>
                        <?php
                        $id = $rows["id"];
                        if (isset($_POST["delete"])) {
                            // Get the ID of the product to delete
                            $delete_id = $_POST["delete_id"];

                            // Delete the product from the database
                            $sql_delete = "DELETE FROM furnitures WHERE id = :delete_id";
                            $stmt_delete = $conn->prepare($sql_delete);
                            $stmt_delete->bindValue(':delete_id', $delete_id, PDO::PARAM_INT);
                            $stmt_delete->execute();
                        }
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
    </table>
</body>
</html>
