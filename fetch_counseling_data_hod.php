<?php
// Connect to MySQL database  
require 'config.php';
require 'session.php';

// Get the selected date range and department from the request
$selectedDate = $_POST['date'];    // From date
$selectedDate1 = $_POST['date1'];  // To date
$selectedDept = $fdept;

// Prepare the department filter condition
$deptCondition = "";
if ($selectedDept == "Artificial Intelligence and Data Science") {
    // If AI&DS is selected, include both AI&DS and AI&ML departments
    $deptCondition = "AND (s.dept = 'Artificial Intelligence and Data Science' OR s.dept = 'Artificial Intelligence and Machine Learning')";
} else if (!empty($selectedDept)) {
    // For other departments, filter by exact department name
    $deptCondition = "AND s.dept = ?";
}

// Modified SQL query to handle date range
$sql = "
WITH AttendanceCount AS (
    SELECT
        s.dept,
        s.ayear,
        COUNT(DISTINCT c.sid) as attended_count
    FROM
        student s
        LEFT JOIN counselling c ON s.sid = c.sid 
        AND c.datee BETWEEN ? AND ?  -- Modified for date range
    WHERE
        s.status != '1'
        " . $deptCondition . "
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
        AND s2.ayear = s.ayear AND s2.status!=1
    ) as total_students,
    COALESCE(f.name, 'Other') as mentor_name,
    COUNT(DISTINCT CASE WHEN c.sid IS NOT NULL THEN s.sid END) as mentor_attended_count
FROM
    student s
    LEFT JOIN counselling c ON s.sid = c.sid 
    AND c.datee BETWEEN ? AND ?  -- Modified for date range
    LEFT JOIN faculty f ON s.mentor = f.id
    JOIN AttendanceCount ac ON s.dept = ac.dept AND s.ayear = ac.ayear
WHERE
    s.status != '1'
    " . $deptCondition . "
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

// Modified parameter binding to include both dates
if ($selectedDept == "Artificial Intelligence and Data Science") {
    $stmt->bind_param("ssss", 
        $selectedDate, $selectedDate1,  // First date range
        $selectedDate, $selectedDate1   // Second date range
    );
} else if (!empty($selectedDept)) {
    $stmt->bind_param("ssssss", 
        $selectedDate, $selectedDate1,  // First date range
        $selectedDept,                  // First department filter
        $selectedDate, $selectedDate1,  // Second date range
        $selectedDept                   // Second department filter
    );
} else {
    $stmt->bind_param("ssss", 
        $selectedDate, $selectedDate1,  // First date range
        $selectedDate, $selectedDate1   // Second date range
    );
}

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