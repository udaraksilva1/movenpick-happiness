<?php
include 'db.php';
$date = date('Y-m-d');
$res = $conn->query("SELECT mood, COUNT(*) as count FROM votes WHERE vote_date = '$date' GROUP BY mood");
$report = "Daily Mood Voting Report for $date:\n\n";

while ($row = $res->fetch_assoc()) {
    $report .= ucfirst($row['mood']) . ": " . $row['count'] . "\n";
}

$to = "hr@example.com";
$subject = "Daily Voting Report - $date";
$headers = "From: noreply@yourdomain.com";

mail($to, $subject, $report, $headers);
echo "Report sent.";
?>
