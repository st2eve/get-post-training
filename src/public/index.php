<!--
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>GET - POST</title>
</head>
<body>
    <form method="post" action="index.php">
        <input type="text" name="name">
        <input type="text" name="lang">
        <input type="submit" value="submit">
        <p>http://yourdomain.com/index.php?name=<a href="https://google.com">Click Me</a></p>
    </form>
    <?php
        /*if (isset($_POST['name'], $_POST['lang'])) {
            $name = $_POST['name'];
            $lang = $_POST['lang'];
            echo $name . '<br>'; 
            echo $lang;
        }*/
    ?>
</body>
</html>
-->

<?php

// open the $_SESSION
session_start();

require_once("connexion.php");

try {

    //prepare() is a PDO method to make sure that our query is not subject to a SQL inject.
    //this returns a PDOStatement object
    $q = $db->prepare("SELECT productName, productCode FROM products");

    //To execute the query set into $q (PDOStatement) object
    $q->execute();

} catch(Exception $e) {
    echo $e->getMessage();
    exit;
}

// PDO::FETCH_ASSOC to display only the columns as keys in the array returned
$products = $q->fetchAll(PDO::FETCH_ASSOC);

include "./includes/header.php";

?>

<h1>Classic Models</h1>

    <ol>
        <?php
            //display the datas
            foreach($products as $product) : ?>

            <li>
                <a href="product.php?code=<?php echo $product["productCode"]; ?>">
                <h3><?php echo $product["productName"];?></h3>
                </a>
            </li>

        <?php
            endforeach;
        ?>
    </ol>

<?php
    include "./includes/footer.php";
?>