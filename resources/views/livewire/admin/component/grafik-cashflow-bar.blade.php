<div>
    <div>
        <canvas id="myChartBar" width="300" height="300"></canvas>
    </div>

    @push('script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"></script>

        <script>
            const dataBar = {
                labels: [
                    'Penjualan',
                    'Pemasukan',
                    'Pengeluaran',
                ],
                datasets: [{
                    type: 'bar',
                    label: 'Bar Dataset',
                    data: [{{ $penjualan }}, {{ $pemasukan }}, {{ $pengeluaran }}],
                    borderColor: 'rgb(255, 99, 132)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)'
                }, ]
            };

            const configBar = {
                type: 'scatter',
                data: dataBar,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    responsive: true,
                    maintainAspectRatio: false
                }
            };

            const myChartBar = new Chart(
                document.getElementById('myChartBar'),
                configBar
            );
        </script>
    @endpush
</div>
