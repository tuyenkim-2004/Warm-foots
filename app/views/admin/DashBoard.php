<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    #bestSellingChart {
        width: 100%;
        max-width: 800px;
        height: 400px;
        margin: 0 auto;
    }
</style>

<div class="container mt-5">
    <h2>Sản Phẩm Bán Chạy Nhất</h2>
    <canvas id="bestSellingChart" width="800" height="400"></canvas>
</div>

<script>
    const products = <?php echo json_encode($data['products']); ?>;

    const labels = products.map(product => product.product_name);
    const data = products.map(product => product.total_quantity);

    const ctx = document.getElementById('bestSellingChart').getContext('2d');
    const bestSellingChart = new Chart(ctx, {
        type: 'line', 
        data: {
            labels: labels,
            datasets: [{
                label: 'Tổng Số Lượng Bán',
                data: data,
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                fill: true,
                tension: 0.4 
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.dataset.label + ': ' + tooltipItem.raw;
                        }
                    }
                }
            }
        }
    });
</script>