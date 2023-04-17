<?php
 include('interlinked.php');
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Main</title>
    </head>
    <body>
        <div>
            <form method="get" action="vendor.php">
                <p><b>Choose vendor to see available products</b>
                    <select name='vendor_name'>
                        <option>Vendors</option>

                        <?php
                            $sql = "SELECT * FROM lb_pdo_goods.vendors";
                            foreach($dbh->query($sql) as $row)
                            {
                                $vendor_name = $row['v_name'];
                                echo "<option value = '$vendor_name'> $vendor_name</option>";
                            }
                        ?>
                </p>
                    </select>
                <input class="buttons" type="submit" value="Search">
            </form>

            <form method="get" action="category.php">
                <p><b>Choose category to see available products</b>
                    <select name='category_name'>
                        <option>Categories</option>

                        <?php
                            $sql = "SELECT * FROM lb_pdo_goods.category";
                            foreach($dbh->query($sql) as $row)
                            {
                                $category_name = $row['c_name'];
                                echo "<option value = '$category_name'> $category_name</option>";
                            }
                        ?>
                </p>
                    </select>
                <input class="buttons" type="submit" value="Search">
            </form>

            <form method="get" action="price.php">
                <p><b>Choose the prices range to see the available products</b>
                    <input name="min" type=number>
                    <input name="max" type=number>
                    <input class="buttons"  type="submit" value="Search" />
            </form>

        </div>
    </body>
</html>