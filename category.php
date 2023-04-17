<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>By Category</title>
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
        if(isset($_GET["category_name"]))
        {
            $categoryName = $_GET["category_name"];
            try{
              $sqlGetCategories = "SELECT * FROM lb_pdo_goods.category";
              
              foreach($dbh->query($sqlGetCategories) as $row)
              {
                if ($categoryName==$row['c_name'])
                {
                  $categoryId=$row['ID_Category'];
                }
              }
              
                $sqlGetCategoryFid = "SELECT * FROM lb_pdo_goods.items WHERE FID_Category= :id";
                $stm = $dbh->prepare($sqlGetCategoryFid);
                $stm->bindParam(':id', $categoryId, PDO::PARAM_INT);
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