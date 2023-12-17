<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/add.css?v=2">
    <title>Document</title>
</head>
<body>
<div class="overlay">
    <i class="fa-solid fa-x" onCLick="closeX()"></i>
    </div>

    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form">

        <div>
                <label for="">ID</label>
                <input type="text" name="id" id="">
        </div>
        <div>
                <label for="">Item_name</label>
                <input type="text" name="item_name" id="">
        </div>
        <div>
                <label for="">Item_imageLink</label>
                <input type="text" name="image" id="">
        </div>
        <div>
                <label for="">Item_price</label>
                <input type="text" name="item_price" id="">
        </div>
        <div>
                <label for="">Item_tag</label>
                <input type="text" name="item_tag" id="">
        </div>
        <div>
                <label for="">Quantity</label>
                <input type="text" name="quantity" id="">
        </div>
        <button>Save</button>
    </form>
    <?php 
    include("../Database/database.php");
    try {
        if($_SERVER["REQUEST_METHOD"]=="POST" ){
            $id = $_POST["id"];
            $item_name = $_POST["item_name"];
            $image = $_POST["image"];
            $item_price = $_POST["item_price"];
            $item_tag = $_POST["item_tag"];
            $quantity = $_POST["quantity"];
            // $pdo = new PDO("mysql:host=localhost;dbname:furniture","root","");
            // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql_insert = $conn->prepare("INSERT INTO products (id,item_name,image,item_price,item_tag,quantity)
            values (:id,:item_name,:image,:item_price,:item_tag,:quantity)");
            $sql_insert->bindParam(':id',$id);
            $sql_insert->bindParam(':item_name',$item_name);
            $sql_insert->bindParam(':image',$image);
            $sql_insert->bindParam(':item_price',$item_price);
            $sql_insert->bindParam(':item_tag',$item_tag);
            $sql_insert->bindParam(':quantity',$quantity);

            $sql_insert->execute();
            header("Location: ../Admin/adminPage.php");
            exit();
        } 
    } catch(PDOException $e) {
        if ($e->errorInfo[1] == 1062) {
            // Error code 1062 is for duplicate entry
            echo "DUPLICATE ID !!!!";
            echo "ADD AGAIN!!";
        } else {
            echo "Error: " . $e->getMessage();
        }
    }   

    ?>
</body>
</html>
