<?php
// Connect to MySQL database  
require 'config.php';

// Get the selected date from the request
$selectedDate = $_POST['date'];

// Fetch data with proper counts
$sql = "
WITH AttendanceCount AS (
    SELECT 
        s.dept,
        s.ayear,
        COUNT(DISTINCT c.sid) as attended_count
    FROM 
        student s
        LEFT JOIN counselling c ON s.sid = c.sid AND c.datee = ?
    WHERE 
        s.ayear != '2020-2024'
    GROUP BY 
        s.dept, s.ayear
)
SELECT 
    s.dept,
    s.ayear,
    ac.attended_count,
    (
        SELECT COUNT(*)
        FROM student s2 
        WHERE s2.dept = s.dept 
        AND s2.ayear = s.ayear
    ) as total_students,
    COALESCE(f.name, 'Other') as mentor_name,
    COUNT(DISTINCT CASE WHEN c.sid IS NOT NULL THEN s.sid END) as mentor_attended_count
FROM 
    student s
    LEFT JOIN counselling c ON s.sid = c.sid AND c.datee = ?
    LEFT JOIN faculty f ON s.mentor = f.id
    JOIN AttendanceCount ac ON s.dept = ac.dept AND s.ayear = ac.ayear
WHERE 
    s.ayear != '2020-2024'
GROUP BY 
    s.dept,
    s.ayear,
    ac.attended_count,
    COALESCE(f.name, 'Other')
ORDER BY 
    s.dept,
    s.ayear,
    mentor_name
";

$stmt = $db->prepare($sql);
$stmt->bind_param("ss", $selectedDate, $selectedDate);
$stmt->execute();
$result = $stmt->get_result();

// Process the data to create a structured response
$data = array();
while ($row = $result->fetch_assoc()) {
    $key = $row['dept'] . '_' . $row['ayear'];
    
    if (!isset($data[$key])) {
        $data[$key] = array(
            'dept' => $row['dept'],
            'ayear' => $row['ayear'],
            'attended_count' => $row['attended_count'],
            'total_students' => $row['total_students'],
            'mentors' => array()
        );
    }
    
    // Only add mentor if they have attended students
    if ($row['mentor_attended_count'] > 0) {
        $data[$key]['mentors'][] = array(
            'name' => $row['mentor_name'],
            'data_completed_count' => $row['mentor_attended_count']
        );
    }
}

$db->close();

// Convert associative array to indexed array
$finalData = array_values($data);

// Return JSON response
echo json_encode($finalData);
?>