<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>66010914030 ธนชา พรหมบุตร(ต้นน้ำ)</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;700&display=swap');
        
        body { font-family: 'Sarabun', sans-serif; background-color: #f0f2f5; padding: 30px; color: #333; }
        .main-card { max-width: 1100px; margin: auto; background: white; padding: 30px; border-radius: 20px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #f0f0f0; padding-bottom: 15px; }
        
        /* จัดวางกราฟ */
        .chart-container { display: flex; flex-wrap: wrap; gap: 20px; margin-bottom: 40px; justify-content: center; }
        .chart-box { flex: 1; min-width: 300px; max-width: 500px; padding: 20px; border: 1px solid #f8f9fa; border-radius: 15px; background: #fafafa; }
        
        /* ตารางสวยๆ */
        table { width: 100%; border-collapse: collapse; margin-top: 20px; border-radius: 10px; overflow: hidden; }
        th { background-color: #6366f1; color: white; padding: 15px; text-align: center; }
        td { padding: 12px; border-bottom: 1px solid #eee; text-align: center; }
        tr:nth-child(even) { background-color: #fcfcfc; }
        tr:hover { background-color: #f1f3ff; transition: 0.3s; }
        
        .title-name { color: #6366f1; font-weight: bold; }
    </style>
</head>
<body>

<div class="main-card">
    <div class="header">
        <h2>📊 สรุปรายงานยอดขายรายเดือน</h2>
        <p class="title-name">66010914030 ธนชา พรหมบุตร(ต้นน้ำ)</p>
    </div>

    <?php
    include_once("connectdb.php"); 
    
    // SQL ดึงข้อมูลรายเดือน
    $sql = "SELECT 
                MONTH(p_date) AS Month_Num, 
                SUM(p_amount) AS Total_Sales
            FROM popsupermarket
            GROUP BY MONTH(p_date)
            ORDER BY Month_Num ASC"; 
    
    $rs = mysqli_query($conn, $sql);

    // เตรียมข้อมูลสำหรับ JavaScript
    $month_map = [1=>"ม.ค.", 2=>"ก.พ.", 3=>"มี.ค.", 4=>"เม.ย.", 5=>"พ.ค.", 6=>"มิ.ย.", 
                  7=>"ก.ค.", 8=>"ส.ค.", 9=>"ก.ย.", 10=>"ต.ค.", 11=>"พ.ย.", 12=>"ธ.ค."];
    $labels = [];
    $values = [];
    $data_rows = [];

    while ($data = mysqli_fetch_array($rs)) {
        $m_name = $month_map[$data['Month_Num']]; // แปลงเลขเดือนเป็นชื่อเดือน
        $labels[] = $m_name;
        $values[] = $data['Total_Sales'];
        $data_rows[] = ['name' => $m_name, 'total' => $data['Total_Sales']];
    }
    mysqli_close($conn); 
    ?>

    <div class="chart-container">
        <div class="chart-box">
            <canvas id="barChart"></canvas>
        </div>
        <div class="chart-box">
            <canvas id="doughnutChart"></canvas>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>เดือน</th>
                <th style="text-align: right; padding-right: 50px;">ยอดขายรวม (บาท)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data_rows as $row) { ?>
            <tr>
                <td><strong><?php echo $row['name']; ?></strong></td>
                <td align="right" style="padding-right: 50px;"><?php echo number_format($row['total'], 2); ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script>
    // ข้อมูลจาก PHP
    const labels = <?php echo json_encode($labels); ?>;
    const dataValues = <?php echo json_encode($values); ?>;
    
    // โทนสีสวยๆ (Modern Palette)
    const colors = [
        '#6366f1', '#f43f5e', '#ec4899', '#8b5cf6', '#06b6d4', 
        '#10b981', '#f59e0b', '#3b82f6', '#64748b', '#a855f7'
    ];

    // 1. สร้าง Bar Chart
    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'ยอดขายต่อเดือน',
                data: dataValues,
                backgroundColor: '#6366f1',
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                title: { display: true, text: 'กราฟแสดงยอดขายแต่ละเดือน', font: { size: 16 } }
            }
        }
    });

    // 2. สร้าง Doughnut Chart
    new Chart(document.getElementById('doughnutChart'), {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                data: dataValues,
                backgroundColor: colors,
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: { display: true, text: 'สัดส่วนยอดขายรวม', font: { size: 16 } },
                legend: { position: 'bottom' }
            },
            cutout: '60%' // ทำให้รูกลางใหญ่ดูโมเดิร์น
        }
    });
</script>

</body>
</html>