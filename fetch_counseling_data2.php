<?php
// Connect to MySQL database
require 'config.php';
// Get the selected date from the request
$selectedDate = $_POST['date'];
// Fetch data with both counselling attendance and total students, excluding 2020-2024
$sql = "
SELECT
    s.dept,
    s.ayear,
    COUNT(DISTINCT c.sid) AS attended_count,
    (
        SELECT COUNT(*)
        FROM student s2
        WHERE s2.dept = s.dept
        AND s2.ayear = s.ayear
    ) AS total_students
FROM
    student s
    LEFT JOIN counselling c ON s.sid = c.sid AND c.datee = ?
WHERE
    s.ayear != '2020-2024'
GROUP BY
    s.dept, s.ayear
ORDER BY
    s.dept, s.ayear
";
$stmt = $db->prepare($sql);
$stmt->bind_param("s", $selectedDate);
$stmt->execute();
$result = $stmt->get_result();
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}
$db->close();
// Return the data as a JSON response
echo json_encode($data);
?>