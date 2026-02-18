<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<button onclick="showimage('1.jpg', this)" style="background-color:green; color:white; padding:10px; border:none;">
    เปิดรูปที่ 1
</button>
<button onclick="showimage('2.jpg', this)" style="background-color:orange; color:white; padding:10px; border:none;">
    เปิดรูปที่ 2
</button>
<script>

function showImage(imgSrc, btn){
    btn.innerHTML = "<img src='" + imgSrc + "' width='150'>";
}
</script>

    
</body>
</html>