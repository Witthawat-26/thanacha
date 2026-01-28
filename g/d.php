<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>66010914030 ธนชา พรหมบุตร(ต้นน้ำ)</title>
</head>
<body>
    <h3>66010914030 ธนชา พรหมบุตร(ต้นน้ำ)</h3>

    <table border="1" width="400">
        <tr bgcolor="#f2f2f2">
            <th>ประเทศ</th>
            <th>ยอดขายรวม</th>
        </tr>
        
        <?php
        include_once("connectdb.php"); 
       
        $sql = "SELECT `p_country`, SUM(`p_amount`) AS total 
                FROM `popsupermarket` 
                GROUP BY `p_country` 
                ORDER BY total DESC"; 
        
        $rs = mysqli_query($conn, $sql);

        while ($data = mysqli_fetch_array($rs)) {
        ?>
        <tr>
            <td><?php echo $data['p_country']; ?></td>
            <td align="right"><?php echo number_format($data['total'], 0); ?></td>
        </tr>
        <?php
        } 
        mysqli_close($conn); 
        ?> 
    </table>
</body>
</html>