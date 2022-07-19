<div>
    <div>
        <canvas id="myChartPie" width="300" height="300"></canvas>
    </div>

    @push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"></script>

    <script>
        const dataPie = {
            labels: [
                'Penjualan @uang($penjualan)',
                'Pemasukan @uang($pemasukan)',
                'Pengeluaran @uang($pengeluaran)'
            ],
            datasets: [{
                label: 'Cashflow Pie',
                data: [{{ $penjualan }}, {{ $pemasukan }}, {{ $pengeluaran }}],
                backgroundColor: [
                    'rgb(54, 162, 235)',
                    'rgb(36, 230, 49)',
                    'rgb(255, 99, 132)',
                ],
                hoverOffset: 4
            }]
        };

        const configPie = {
            type: 'pie',
            data: dataPie,
            options: {
                layout: {
                    padding: 20

                },
                responsive: true,
                maintainAspectRatio: false
            }
        };

        const myChartPie = new Chart(
            document.getElementById('myChartPie'),
            configPie
        );
    </script>
@endpush
</div>
