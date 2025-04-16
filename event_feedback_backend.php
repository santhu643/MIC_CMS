<?php
require_once 'feed_db_connection.php';
require 'config.php';
require 'session.php';

$action = $_GET['action'] ?? ($_POST['action'] ?? ''); 

switch ($action) {
    case 'get_departments':
        $result = $db->query("SELECT * FROM departments");
        echo json_encode($result->fetch_all(MYSQLI_ASSOC));
        break;

    case 'save_feedback':
        $id = $_POST['id'];
        $title = $_POST['title'];
        $target_audience = $_POST['target_audience'];
        $departments = $_POST['departments'];
        if (empty($id)) {
            $sql = "INSERT INTO event_feedbacks (title, target_audience, organizer) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $title, $target_audience, $departments);
        } else {
            $sql = "UPDATE event_feedbacks SET title = ?, target_audience = ?, organizer = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssi", $title, $target_audience, $departments, $id);
        }

        if ($stmt->execute()) {
            echo "Success";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
        break;

    case 'edit_feedback':
        // Similar to create_feedback, but with UPDATE query
        break;

    case 'delete_feedback':
        $id = $_POST['id'];

        $sql = "DELETE FROM event_feedbacks WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            echo "Success";
        } else {
            echo "Error: " . $stmt->error;
        }
        
        $stmt->close();
        $conn->close();

        break;

    case 'submit_response':
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $conn->prepare("INSERT INTO feedback_responses (fid, uid, q1_rating, q2_rating, q3_rating, q4_rating, q5_rating, q6_rating, q7_answer, q8_answer, q9_answer, q10_rating) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iiiiiiiisssi", $data['fid'], $data['uid'], $data['q1'], $data['q2'], $data['q3'], $data['q4'], $data['q5'], $data['q6'], $data['q7'], $data['q8'], $data['q9'], $data['q10']);
        $stmt->execute();
        echo json_encode(['success' => true]);
        break;
    case 'get_all_feedback':
        $sql = "SELECT * FROM event_feedbacks";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['title'] . "</td>";
                echo "<td>" . $row['event_level'] . "</td>";
                echo "<td>" . $row['event_date'] . "</td>";
                echo "<td>" . ucfirst($row['target_audience']) . "</td>";
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
    case 'get_feedback':
        $id = $_GET['id'];
        $sql = "SELECT * FROM event_feedbacks WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $feedback = $result->fetch_assoc();

        echo json_encode($feedback);

        $stmt->close();
        $conn->close();
        break;

    default:
        echo json_encode(['error' => 'Invalid action']);
}