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
            <th>เดือน </th>
            <th>ยอดขายรวม</th>
        </tr>
        
        <?php
        include_once("connectdb.php"); 
        
       
        $sql = "SELECT 
                    MONTH(p_date) AS Month_Num, 
                    SUM(p_amount) AS Total_Sales
                FROM popsupermarket
                GROUP BY MONTH(p_date)
                ORDER BY Month_Num ASC;"; 
        
        $rs = mysqli_query($conn, $sql);

        while ($data = mysqli_fetch_array($rs)) {
        ?>
        <tr>
            <td align="center"><?php echo $data['Month_Num']; ?></td>
            <td align="right"><?php echo number_format($data['Total_Sales'], 0); ?></td>
        </tr>
        <?php
        } 
        mysqli_close($conn); 
        ?> 
    </table>
</body>
</html>