<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Live Voting Results</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f0f0f0;
      text-align: center;
      padding: 20px;
    }
    h2 {
      color: #333;
    }
    canvas {
      display: block;
      margin: 20px auto;
    }
  </style>
</head>
<body>
  <h2>Live Mood Votes</h2>
  <canvas id="barChart" width="500" height="400"></canvas>

  <script>
    const canvas = document.getElementById('barChart');
    const ctx = canvas.getContext('2d');

    async function fetchData() {
      const res = await fetch('live.php');
      const data = await res.json();
      drawChart(data.happy, data.sad);
    }

    function drawChart(happy, sad) {
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      const baseY = 300;
      const barWidth = 100;
      const spacing = 120;

      // Animate height
      const max = Math.max(happy, sad, 1);
      const happyHeight = (happy / max) * 200;
      const sadHeight = (sad / max) * 200;

      // Happy Bar
      ctx.fillStyle = '#28a745';
      ctx.fillRect(100, baseY - happyHeight, barWidth, happyHeight);
      ctx.fillText(`😊 Happy: ${happy}`, 100, baseY + 20);

      // Sad Bar
      ctx.fillStyle = '#dc3545';
      ctx.fillRect(100 + spacing, baseY - sadHeight, barWidth, sadHeight);
      ctx.fillText(`😞 Sad: ${sad}`, 100 + spacing, baseY + 20);
    }

    // Initial load and interval refresh
    fetchData();
    setInterval(fetchData, 5000);
  </script>
</body>
</html>
