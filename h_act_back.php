<?php
header('Content-Type: application/json');
require 'config.php';
require 'session.php';

$servername = "localhost";
$username = "TIHMIC";
$password = "KalaI@@1992@@";
$dbname = "mic";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// Predefined department
$dept = $fdept;

function getDepartmentStats($conn, $year = '', $batch = '', $dept = '') {
    $yearCondition = '';
    $batchCondition = '';
    $deptCondition = '';
    $params = [];
    $types = '';
    
    if (!empty($year)) {
        $yearCondition = " AND i.ayear = ?";
        $params[] = $year;
        $types .= 's';
    }

    if (!empty($batch)) {
        $batchCondition = " AND s.ayear = ?";
        $params[] = $batch;
        $types .= 's';
    }
    
    if (!empty($dept)) {
        // Check if the department is a special case
        if ($dept == 'Artificial Intelligence and Data Science' || $dept == 'Artificial Intelligence and Machine Learning') {
            $deptCondition = " AND s.dept IN (?, ?)";
            $params[] = 'Artificial Intelligence and Data Science';
            $params[] = 'Artificial Intelligence and Machine Learning';
            $types .= 'ss';
        } else {
            $deptCondition = " AND s.dept = ?";
            $params[] = $dept;
            $types .= 's';
        }
    }

    // Array of all queries with their base conditions
    $queries = [
        'Internships' => [
            "SELECT 
                s.dept,
                COUNT(*) as total_count,
                SUM(CASE WHEN i.status = 0 THEN 1 ELSE 0 END) as pending_count,
                SUM(CASE WHEN i.status = 1 THEN 1 ELSE 0 END) as approved_count
            FROM sintern i
            JOIN student s ON i.sid = s.sid
            WHERE 1=1" . $yearCondition . $batchCondition . $deptCondition . "
            GROUP BY s.dept"
        ],
        'certifications' => [
            "SELECT 
                s.dept,
                COUNT(*) as total_count,
                SUM(CASE WHEN c.status = 0 THEN 1 ELSE 0 END) as pending_count,
                SUM(CASE WHEN c.status = 1 THEN 1 ELSE 0 END) as approved_count
            FROM s_i_certification c
            JOIN student s ON c.sid = s.sid
            WHERE 1=1" . str_replace('i.ayear', 'c.ayear', $yearCondition) . $batchCondition . $deptCondition . "
            GROUP BY s.dept"
        ],
        'projects' => [
            "SELECT 
                s.dept,
                COUNT(*) as total_count,
                SUM(CASE WHEN p.status = 0 THEN 1 ELSE 0 END) as pending_count,
                SUM(CASE WHEN p.status = 1 THEN 1 ELSE 0 END) as approved_count
            FROM sproject p
            JOIN student s ON p.sid = s.sid
            WHERE 1=1" . str_replace('i.ayear', 'p.ayear', $yearCondition) . $batchCondition . $deptCondition . "
            GROUP BY s.dept"
        ],
        'languages' => [
            "SELECT 
                s.dept,
                COUNT(*) as total_count,
                SUM(CASE WHEN l.status = 0 THEN 1 ELSE 0 END) as pending_count,
                SUM(CASE WHEN l.status = 1 THEN 1 ELSE 0 END) as approved_count
            FROM slang l
            JOIN student s ON l.uid = s.uid
            WHERE 1=1" . str_replace('i.ayear', 'l.ayear', $yearCondition) . $batchCondition . $deptCondition . "
            GROUP BY s.dept"
        ],
        'cocurricular' => [
            "SELECT 
                s.dept,
                COUNT(*) as total_count,
                SUM(CASE WHEN c.status = 0 THEN 1 ELSE 0 END) as pending_count,
                SUM(CASE WHEN c.status = 1 THEN 1 ELSE 0 END) as approved_count
            FROM scocu c
            JOIN student s ON c.sid = s.sid
            WHERE 1=1" . str_replace('i.ayear', 'c.ayear', $yearCondition) . $batchCondition . $deptCondition . "
            GROUP BY s.dept"
        ],
        'extracurricular' => [
            "SELECT 
                s.dept,
                COUNT(*) as total_count,
                SUM(CASE WHEN e.status = 0 THEN 1 ELSE 0 END) as pending_count,
                SUM(CASE WHEN e.status = 1 THEN 1 ELSE 0 END) as approved_count
            FROM st_extra e
            JOIN student s ON e.sid = s.sid
            WHERE 1=1" . str_replace('i.ayear', 'e.ayear', $yearCondition) . $batchCondition . $deptCondition . "
            GROUP BY s.dept"
        ],
        'placements' => [
            "SELECT 
                s.dept,
                COUNT(*) as total_count,
                SUM(CASE WHEN p.status = 0 THEN 1 ELSE 0 END) as pending_count,
                SUM(CASE WHEN p.status = 1 THEN 1 ELSE 0 END) as approved_count
            FROM splacement p
            JOIN student s ON p.sid = s.sid
            WHERE 1=1" . str_replace('i.ayear', 'p.ayear', $yearCondition) . $batchCondition . $deptCondition . "
            GROUP BY s.dept"
        ]
    ];

    $results = [];
    foreach ($queries as $key => $queryData) {
        $stmt = $conn->prepare($queryData[0]);
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $results[$key] = $data;
        $stmt->close();
    }

    return $results;
}

function getFacultyStats($conn, $year = '', $batch = '', $dept = '') {
    $deptCondition = '';
    
    // Sanitize inputs to prevent SQL injection
    $year = $conn->real_escape_string($year);
    $batch = $conn->real_escape_string($batch);
    $dept = $conn->real_escape_string($dept);

    // Build the department condition
    if (!empty($dept)) {
        // Check if the department is a special case
        if ($dept == 'Artificial Intelligence and Data Science' || $dept == 'Artificial Intelligence and Machine Learning') {
            $deptCondition = " AND f.dept IN ('Artificial Intelligence and Data Science', 'Artificial Intelligence and Machine Learning')";
        } else {
            $deptCondition = " AND f.dept = '$dept'";
        }
    }

    // Build the SQL query
    $sql = "
        SELECT DISTINCT
            f.id AS faculty_id,
            f.name AS faculty_name,
            f.dept,
            COALESCE((SELECT COUNT(*) FROM sintern i2 JOIN student s2 ON i2.sid = s2.sid 
                WHERE s2.mentor = f.id" . (!empty($year) ? " AND i2.ayear = '$year'" : "") . (!empty($batch) ? " AND s2.ayear = '$batch'" : "") . "), 0) as total_internships,
            COALESCE((SELECT COUNT(*) FROM sintern i2 JOIN student s2 ON i2.sid = s2.sid 
                WHERE s2.mentor = f.id AND i2.status = 0" . (!empty($year) ? " AND i2.ayear = '$year'" : "") . (!empty($batch) ? " AND s2.ayear = '$batch'" : "") . "), 0) as pending_internships,
            COALESCE((SELECT COUNT(*) FROM sintern i2 JOIN student s2 ON i2.sid = s2.sid 
                WHERE s2.mentor = f.id AND i2.status = 1" . (!empty($year) ? " AND i2.ayear = '$year'" : "") . (!empty($batch) ? " AND s2.ayear = '$batch'" : "") . "), 0) as approved_internships,
            
            COALESCE((SELECT COUNT(*) FROM s_i_certification c JOIN student s2 ON c.sid = s2.sid 
                WHERE s2.mentor = f.id" . (!empty($year) ? " AND c.ayear = '$year'" : "") . (!empty($batch) ? " AND s2.ayear = '$batch'" : "") . "), 0) as total_certifications,
            COALESCE((SELECT COUNT(*) FROM s_i_certification c JOIN student s2 ON c.sid = s2.sid 
                WHERE s2.mentor = f.id AND c.status = 0" . (!empty($year) ? " AND c.ayear = '$year'" : "") . (!empty($batch) ? " AND s2.ayear = '$batch'" : "") . "), 0) as pending_certifications,
            COALESCE((SELECT COUNT(*) FROM s_i_certification c JOIN student s2 ON c.sid = s2.sid 
                WHERE s2.mentor = f.id AND c.status = 1" . (!empty($year) ? " AND c.ayear = '$year'" : "") . (!empty($batch) ? " AND s2.ayear = '$batch'" : "") . "), 0) as approved_certifications,
            
            COALESCE((SELECT COUNT(*) FROM sproject p JOIN student s2 ON p.sid = s2.sid 
                WHERE s2.mentor = f.id" . (!empty($year) ? " AND p.ayear = '$year'" : "") . (!empty($batch) ? " AND s2.ayear = '$batch'" : "") . "), 0) as total_projects,
            COALESCE((SELECT COUNT(*) FROM sproject p JOIN student s2 ON p.sid = s2.sid 
                WHERE s2.mentor = f.id AND p.status = 0" . (!empty($year) ? " AND p.ayear = '$year'" : "") . (!empty($batch) ? " AND s2.ayear = '$batch'" : "") . "), 0) as pending_projects,
            COALESCE((SELECT COUNT(*) FROM sproject p JOIN student s2 ON p.sid = s2.sid 
                WHERE s2.mentor = f.id AND p.status = 1" . (!empty($year) ? " AND p.ayear = '$year'" : "") . (!empty($batch) ? " AND s2.ayear = '$batch'" : "") . "), 0) as approved_projects,
            COALESCE((SELECT COUNT(*) FROM slang l JOIN student s2 ON l.uid = s2.uid 
                WHERE s2.mentor = f.id" . (!empty($year) ? " AND l.ayear = '$year'" : "") . (!empty($batch) ? " AND s2.ayear = '$batch'" : "") . "), 0) as total_languages,
            COALESCE((SELECT COUNT(*) FROM slang l JOIN student s2 ON l.uid = s2.uid 
                WHERE s2.mentor = f.id AND l.status = 0" . (!empty($year) ? " AND l.ayear = '$year'" : "") . (!empty($batch) ? " AND s2.ayear = '$batch'" : "") . "), 0) as pending_languages,
            COALESCE((SELECT COUNT(*) FROM slang l JOIN student s2 ON l.uid = s2.uid 
                WHERE s2.mentor = f.id AND l.status = 1" . (!empty($year) ? " AND l.ayear = '$year'" : "") . (!empty($batch) ? " AND s2.ayear = '$batch'" : "") . "), 0) as approved_languages,
            
            COALESCE((SELECT COUNT(*) FROM scocu co JOIN student s2 ON co.sid = s2.sid 
                WHERE s2.mentor = f.id" . (!empty($year) ? " AND co.ayear = '$year'" : "") . (!empty($batch) ? " AND s2.ayear = '$batch'" : "") . "), 0) as total_cocurricular,
            COALESCE((SELECT COUNT(*) FROM scocu co JOIN student s2 ON co.sid = s2.sid 
                WHERE s2.mentor = f.id AND co.status = 0" . (!empty($year) ? " AND co.ayear = '$year'" : "") . (!empty($batch) ? " AND s2.ayear = '$batch'" : "") . "), 0) as pending_cocurricular,
            COALESCE((SELECT COUNT(*) FROM scocu co JOIN student s2 ON co.sid = s2.sid 
                WHERE s2.mentor = f.id AND co.status = 1" . (!empty($year) ? " AND co.ayear = '$year'" : "") . (!empty($batch) ? " AND s2.ayear = '$batch'" : "") . "), 0) as approved_cocurricular,
            
            COALESCE((SELECT COUNT(*) FROM st_extra ex JOIN student s2 ON ex.sid = s2.sid 
                WHERE s2.mentor = f.id" . (!empty($year) ? " AND ex.ayear = '$year'" : "") . (!empty($batch) ? " AND s2.ayear = '$batch'" : "") . "), 0) as total_extracurricular,
            COALESCE((SELECT COUNT(*) FROM st_extra ex JOIN student s2 ON ex.sid = s2.sid 
                WHERE s2.mentor = f.id AND ex.status = 0" . (!empty($year) ? " AND ex.ayear = '$year'" : "") . (!empty($batch) ? " AND s2.ayear = '$batch'" : "") . "), 0) as pending_extracurricular,
            COALESCE((SELECT COUNT(*) FROM st_extra ex JOIN student s2 ON ex.sid = s2.sid 
                WHERE s2.mentor = f.id AND ex.status = 1" . (!empty($year) ? " AND ex.ayear = '$year'" : "") . (!empty($batch) ? " AND s2.ayear = '$batch'" : "") . "), 0) as approved_extracurricular,
            
            COALESCE((SELECT COUNT(*) FROM splacement pl JOIN student s2 ON pl.sid = s2.sid 
                WHERE s2.mentor = f.id" . (!empty($year) ? " AND pl.ayear = '$year'" : "") . (!empty($batch) ? " AND s2.ayear = '$batch'" : "") . "), 0) as total_placements,
            COALESCE((SELECT COUNT(*) FROM splacement pl JOIN student s2 ON pl.sid = s2.sid 
                WHERE s2.mentor = f.id AND pl.status = 0" . (!empty($year) ? " AND pl.ayear = '$year'" : "") . (!empty($batch) ? " AND s2.ayear = '$batch'" : "") . "), 0) as pending_placements,
            COALESCE((SELECT COUNT(*) FROM splacement pl JOIN student s2 ON pl.sid = s2.sid 
                WHERE s2.mentor = f.id AND pl.status = 1" . (!empty($year) ? " AND pl.ayear = '$year'" : "") . (!empty($batch) ? " AND s2.ayear = '$batch'" : "") . "), 0) as approved_placements
        FROM faculty f
        WHERE 1=1" . $deptCondition . "
        HAVING total_internships + total_certifications + total_projects + total_languages + total_cocurricular + total_extracurricular + total_placements > 0
        ORDER BY f.dept, f.name
    ";

    $result = $conn->query($sql);
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    return $data;
}
// Main execution
if (isset($_GET['type'])) {
    $type = $_GET['type'];
    $year = isset($_GET['year']) ? $_GET['year'] : '';
    $batch = isset($_GET['batch']) ? $_GET['batch'] : '';
    switch ($type) {
        case 'department':
            $response = getDepartmentStats($conn, $year, $batch, $dept);
            break;
        case 'faculty':
            $response = getFacultyStats($conn, $year, $batch, $dept);
            break;
        default:
            $response = ['error' => 'Invalid type specified'];
    }
    echo json_encode($response);
}
$conn->close();