<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/add.css?v=2">
    <title>Document</title>
</head>
<body>
<?php 
include("../Database/database.php");

$id = $_GET["id"];

if($_SERVER["REQUEST_METHOD"]=="POST" ){
    $id_new = $_POST["id"];
    $item_name = $_POST["item_name"];
    $image = $_POST["image"];
    $item_price = $_POST["item_price"];
    $item_tag = $_POST["item_tag"];
    
    try {
        // Prepare the SQL statement
        $sql_update = "UPDATE products SET 
            id = :id,
            item_name = :item_name,
            image = :image,
            item_price = :item_price,
            item_tag = :item_tag
            WHERE id = :id";
        $stmt = $conn->prepare($sql_update);

        // Bind parameters
        $stmt->bindParam(':id', $id_new, PDO::PARAM_STR);
        $stmt->bindParam(':item_name', $item_name, PDO::PARAM_STR);
        $stmt->bindParam(':image', $image, PDO::PARAM_STR);
        $stmt->bindParam(':item_price', $item_price, PDO::PARAM_STR);
        $stmt->bindParam(':item_tag', $item_tag, PDO::PARAM_STR);

        // Execute the statement
        $stmt->execute();

        header("Location: ../Admin/adminPage.php");
    } catch(PDOException $e) {
        echo "Update error: " . $e->getMessage();
    }
}

// Fetch the updated data using PDO
$sql_select = "SELECT * FROM products WHERE id = :id";
$stmt_select = $conn->prepare($sql_select);
$stmt_select->bindParam(':id', $id, PDO::PARAM_STR);
$stmt_select->execute();

// Fetch the updated data
$row = $stmt_select->fetch(PDO::FETCH_ASSOC);
?>
<div class="overlay">
    <i class="fa-solid fa-x" onCLick="closeX()"></i>
</div>

<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form">
    <div>
        <label for="">ID</label>
        <input type="text" name="id" id="" value="<?php echo $id ?>">
    </div>
    <div>
        <label for="">Item_name</label>
        <input type="text" name="item_name" id="" value="<?php echo $row["item_name"]; ?>">
    </div>
    <div>
        <label for="">Item_imageLink</label>
        <input type="text" name="image" id="" value="<?php echo $row["image"]; ?>">
    </div>
    <div>
        <label for="">Item_price</label>
        <input type="text" name="item_price" id="" value="<?php echo $row["item_price"]; ?>">
    </div>
    <div>
        <label for="">Item_tag</label>
        <input type="text" name="item_tag" id="" value="<?php echo $row["item_tag"]; ?>">
    </div>
    <button>Save</button>
</form>

</body>
</html>
