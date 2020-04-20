<?php
    // 建立簡短的變數名稱
    $document_root = $_SERVER['DOCUMENT_ROOT'];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Bob's Auto Parts - Order Results</title>
    </head>
    <body>
        <h1>Bob's Auto Parts</h1>
        <h2>Customer Orders</h2>
        <?php
            // @$fp = fopen("$document_root/../orders/orders.txt", 'rb');
            @$fp = fopen("orders/orders.txt", 'rb');
            flock($fp, LOCK_SH); // lock file for reading

            if (!$fp) {
                echo "<p><strong>No orders pending.<br />
                Please try again later.</strong></p>";
                exit;
            }

            while (!feof($fp)) {
                $order = fgets($fp);
                echo htmlspecialchars($order)."<br />";
            }

            flock($fp, LOCK_UN); // 解開讀取鎖定
            fclose($fp);
        ?>
    </body>
</html>