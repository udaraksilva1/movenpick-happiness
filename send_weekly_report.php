<?php
include 'db.php';

$start_date = date('Y-m-d', strtotime('-6 days'));
$end_date = date('Y-m-d');
$filename = "weekly_vote_report_" . $end_date . ".csv";

header('Content-Type: text/csv');
header("Content-Disposition: attachment; filename=$filename");

$output = fopen('php://output', 'w');
fputcsv($output, ['Date', 'Happy', 'Sad']);

$query = $conn->query("
  SELECT vote_date,
         SUM(CASE WHEN mood = 'happy' THEN 1 ELSE 0 END) as happy,
         SUM(CASE WHEN mood = 'sad' THEN 1 ELSE 0 END) as sad
  FROM votes
  WHERE vote_date BETWEEN '$start_date' AND '$end_date'
  GROUP BY vote_date
  ORDER BY vote_date
");

while ($row = $query->fetch_assoc()) {
    fputcsv($output, [$row['vote_date'], $row['happy'], $row['sad']]);
}
fclose($output);
?>
