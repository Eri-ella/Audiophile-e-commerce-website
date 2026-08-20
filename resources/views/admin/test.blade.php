<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>My First ApexChart</title>
</head>
<body>
  <div id="chart"></div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.45.0/apexcharts.min.js"></script>
  <script>
    
    var options = {
      chart: {
        type: 'line'
      },
      series: [{
        name: 'sales',
        data: [30, 30, 125, 80, 125, 30, 30, 91, 125]
      }],
      xaxis: {
        categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998, 1999]
      }
    }

    var chart = new ApexCharts(document.querySelector('#chart'), options)
    chart.render()
  </script>
</body>
</html>