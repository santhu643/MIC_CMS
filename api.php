<?php
require_once 'feed_db_connection.php';
require 'config.php';
require 'session.php';

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'get_departments':
        $result = $db->query("SELECT * FROM departments");
        echo json_encode($result->fetch_all(MYSQLI_ASSOC));
        break;

    case 'create_feedback':
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $conn->prepare("INSERT INTO event_feedbacks (title, event_level, event_date, event_duration, event_mode, venue, organizer) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $data['title'], $data['event_level'], $data['event_date'], $data['event_duration'], $data['event_mode'], $data['venue'], $data['organizer']);
        $stmt->execute();
        $fid = $stmt->insert_id;


    case 'edit_feedback':
        // Similar to create_feedback, but with UPDATE query
        break;

    case 'delete_feedback':
        $fid = $_POST['fid'] ?? 0;
        $db->query("DELETE FROM feedback_assignments WHERE fid = $fid");
        $db->query("DELETE FROM feedback_responses WHERE fid = $fid");
        $db->query("DELETE FROM feedback_forms WHERE fid = $fid");
        echo json_encode(['success' => true]);
        break;

    case 'submit_response':
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $conn->prepare("INSERT INTO feedback_responses (fid, uid, q1_rating, q2_rating, q3_rating, q4_rating, q5_rating, q6_rating, q7_answer, q8_answer, q9_answer, q10_rating) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iiiiiiiisssi", $data['fid'], $data['uid'], $data['q1'], $data['q2'], $data['q3'], $data['q4'], $data['q5'], $data['q6'], $data['q7'], $data['q8'], $data['q9'], $data['q10']);
        $stmt->execute();
        echo json_encode(['success' => true]);
        break;
    case 'get_feedback':
        $sql = "SELECT * FROM feedback_forms ORDER BY created_at DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['title'] . "</td>";
                echo "<td>" . ucfirst($row['target_audience']) . "</td>";
                echo "<td>" . $row['departments'] . "</td>";
                echo "<td>" . $row['created_at'] . "</td>";
                echo "<td>
                        <button class='btn btn-sm btn-primary edit-feedback' data-id='" . $row['id'] . "'><i class='fas fa-edit'></i></button>
                        <button class='btn btn-sm btn-danger delete-feedback' data-id='" . $row['id'] . "'><i class='fas fa-trash'></i></button>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6' class='text-center'>No feedback forms found</td></tr>";
        }

        $conn->close();
        break;


    default:
        echo json_encode(['error' => 'Invalid action']);
}