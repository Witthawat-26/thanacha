<! Wheeler-dealer-style HTML/PHP Template -->
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>66010914029 ดนยา อุดมคำ (ปูเป้)</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { font-family: 'Sarabun', sans-serif; background-color: #f8f9fa; padding: 20px; }
        .container { max-width: 1000px; margin: auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .chart-grid { display: flex; flex-wrap: wrap; gap: 20px; margin-bottom: 30px; }
        .chart-item { flex: 1; min-width: 300px; padding: 15px; border: 1px solid #eee; border-radius: 8px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #007bff; color: white; }
        tr:hover { background-color: #f5f5f5; }
        h3 { color: #333; text-align: center; }
    </style>
</head>
<body>

<div class="container">
    <h3>รายงานยอดขายแยกตามประเทศ: ดนยา อุดมคำ</h3>

    <?php
    include_once("connectdb.php"); 
    
    $sql = "SELECT `p_country`, SUM(`p_amount`) AS total 
            FROM `popsupermarket` 
            GROUP BY `p_country` 
            ORDER BY total DESC"; 
    
    $rs = mysqli_query($conn, $sql);

    // 2. เตรียมข้อมูลสำหรับ Chart
    $labels = [];
    $values = [];

    // เก็บข้อมูลลงใน Array เพื่อเอาไปวนลูปแสดงตารางและสร้างกราฟ
    $data_list = [];
    while ($row = mysqli_fetch_array($rs)) {
        $data_list[] = $row;
        $labels[] = $row['p_country'];
        $values[] = $row['total'];
    }
    mysqli_close($conn); 
    ?>

    <div class="chart-grid">
        <div class="chart-item">
            <canvas id="barChart"></canvas>
        </div>
        <div class="chart-item">
            <canvas id="pieChart"></canvas>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>ประเทศ</th>
                <th style="text-align: right;">ยอดขายรวม</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data_list as $data) { ?>
            <tr>
                <td><?php echo $data['p_country']; ?></td>
                <td align="right"><?php echo number_format($data['total'], 2); ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script>
    // 5. นำข้อมูลจาก PHP (Array) มาแปลงเป็น JSON เพื่อใช้ใน JavaScript
    const chartLabels = <?php echo json_encode($labels); ?>;
    const chartData = <?php echo json_encode($values); ?>;
    const colors = [
        'rgba(255, 99, 132, 0.7)', 'rgba(54, 162, 235, 0.7)', 
        'rgba(255, 206, 86, 0.7)', 'rgba(75, 192, 192, 0.7)', 
        'rgba(153, 102, 255, 0.7)', 'rgba(255, 159, 64, 0.7)'
    ];

    // สร้าง Bar Chart
    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: chartLabels,
            datasets: [{
                label: 'ยอดขายรวม',
                data: chartData,
                backgroundColor: colors,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: { title: { display: true, text: 'กราฟแท่งยอดขาย' } }
        }
    });

    // สร้าง Pie Chart
    new Chart(document.getElementById('pieChart'), {
        type: 'pie',
        data: {
            labels: chartLabels,
            datasets: [{
                data: chartData,
                backgroundColor: colors
            }]
        },
        options: {
            responsive: true,
            plugins: { 
                title: { display: true, text: 'สัดส่วนยอดขาย (%)' },
                legend: { position: 'bottom' }
            }
        }
    });
</script>

</body>
</html>