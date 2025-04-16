<?php
// uintern_back.php
$conn = new mysqli('localhost', 'TIHMIC', 'KalaI@@1992@@', 'mic');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle AJAX requests
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
    
    switch($action) {
        case 'fetch':
            // Fetch internships with ayear NULL
            $sql = "SELECT uid,sid,date,ayear FROM splacement WHERE ayear IS NULL";
            $result = $conn->query($sql);
            $data = '';
            
            while ($row = $result->fetch_assoc()) {
                $data .= '<tr>
                    <td>' . htmlspecialchars($row['sid']) . '</td>
                    <td>' . htmlspecialchars($row['date']) . '</td>
                    <td class="action-buttons">
                        <button class="btn btn-primary btn-sm updateYearBtn" data-id="' . $row['uid'] . '">
                            <i class="fas fa-edit"></i> Update Year
                        </button>
                        <button class="btn btn-danger btn-sm deleteBtn" data-id="' . $row['uid'] . '">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </td>
                </tr>';
            }
            echo $data;
            break;

        case 'update':
            // Update academic year
            if (!isset($_POST['recordId']) || !isset($_POST['academicYear'])) {
                echo "Missing required parameters";
                break;
            }
            
            $recordId = intval($_POST['recordId']);
            $academicYear = $_POST['academicYear'];
            
            $sql = "UPDATE splacement SET ayear = ? WHERE uid = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $academicYear, $recordId);
            
            if ($stmt->execute()) {
                echo "Academic year updated successfully.";
            } else {
                echo "Failed to update academic year: " . $stmt->error;
            }
            $stmt->close();
            break;

        case 'delete':
            // Delete record
            if (!isset($_POST['recordId'])) {
                echo "Missing record ID";
                break;
            }
            
            $recordId = intval($_POST['recordId']);
            
         
            
            // Now delete the database record
            $sql = "DELETE FROM splacement WHERE uid = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $recordId);
            
            if ($stmt->execute()) {
                echo "Record deleted successfully.";
            } else {
                echo "Failed to delete record: " . $stmt->error;
            }
            $stmt->close();
            break;

        default:
            echo "Invalid action";
            break;
    }
    
    $conn->close();
    exit();
}
?>