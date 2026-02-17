<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ธนชา พรหมบุตร(ต้นน้ำ)</title>
</head>
<body>
    <h1>งาน i --ธนชา พรหมบุตร(ต้นน้ำ)</h1>
    <feom method="post"action="">
        ชื่อภาค<input type ="text" name="rname" autofocus required>
        <button type="sumbit" name="submit">บันทึก</button>
</from><br><br>
<?php
if(ISSET($_POST['SUBMIT'])){
    include_once("connectdb.php");
    $sql2 = "iINSERT INTO 'regions'('r_id',r_name')VALUES(NULL,
    '{$rname}')";
    mysqli_query($conn'$sql2 or die("เพิ่มข้อมูลไม่ได้")
}


<table border="1">
    <tr>
        <th>รหัสภาค</th>
        <th>ชื่อภาค</th>
    </tr>
<?php
include_once("connectdb.php");
$sql = "SELECT * FROM 'regions'";
$rs = mysqli_qery($conn,$sql);

while($data = mysqli_fetch_array($rs)){
?>
    <tr>
        <td><?php echo $data['r_id'];?></td>
        <td><?php echo $data['r_name'];?></td>
        <tdwidth="80" align="center"><img.src="images/delete.jpg" width="20"></td>

    </tr>
<?php} ?>
</table> 

</body>
</html>