<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>By Price Range</title>
</head>
<body>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Quality</th>
            <th>FID_Vendor</th>
            <th>FID_Category</th>
        </tr>
        <?php
        include('interlinked.php');
        if(isset($_GET["min"])&&isset($_GET["max"]))
        {
            $min = $_GET["min"];
            $max = $_GET["max"];
           
            try{
               // SELECT * FROM `items` WHERE price BETWEEN 1000 AND 2000
                $sqlGetRange = "SELECT * FROM lb_pdo_goods.items WHERE price BETWEEN :min AND :max";
                $stm = $dbh->prepare($sqlGetRange);
                $stm->bindParam(':min', $min, PDO::PARAM_INT);
                $stm->bindParam(':max', $max, PDO::PARAM_INT);
                $stm->execute();
                
                $cursor = $stm->fetchAll();
                foreach($cursor as $row)
                {
                    $itemId = $row['ID_Items'];
                    $name = $row['name'];
                    $price = $row['price'];
                    $quantity = $row['quantity'];
                    $quality = $row['quality'];
                    $fidVendor = $row['FID_Vendor'];
                    $fidCategory = $row['FID_Category'];

                    print "<tr> <th>$itemId</th> <th>$name</th>
                    <th>$price</th> <th>$quantity</th><th>$quality</th>
                    <th>$fidVendor</th><th>$fidCategory</th></tr>";

                }

            }
            catch(PDOException $e)
            {
                print "Error!: " . $e->getMessage() . "<br/>";
                die();
            }
        }
        ?>
    </table>
</body>
</html>