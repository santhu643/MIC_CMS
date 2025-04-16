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
            $sql = "SELECT uid, event, ayear, cert FROM scocu WHERE ayear IS NULL";
            $result = $conn->query($sql);
            $data = '';
            
            while ($row = $result->fetch_assoc()) {
                $data .= '<tr>
                    <td>' . htmlspecialchars($row['uid']) . '</td>
                    <td>' . htmlspecialchars($row['event']) . '</td>
                    <td>' . htmlspecialchars($row['ayear'] ?? '') . '</td>
                    <td class="action-buttons">
                        <button class="btn btn-primary btn-sm updateYearBtn" data-id="' . $row['uid'] . '">
                            <i class="fas fa-edit"></i> Update Year
                        </button>
                        <button class="btn btn-info btn-sm viewCertBtn" data-cert="' . htmlspecialchars($row['cert']) . '">
                            <i class="fas fa-eye"></i> View
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
            
            $sql = "UPDATE scocu SET ayear = ? WHERE uid = ?";
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
            
            // First get the certificate path to delete the file
            $sql = "SELECT cert FROM scocu WHERE uid = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $recordId);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($row = $result->fetch_assoc()) {
                $certPath = $row['cert'];
                // Delete the certificate file if it exists
                if (!empty($certPath) && file_exists($certPath)) {
                    unlink($certPath);
                }
            }
            $stmt->close();
            
            // Now delete the database record
            $sql = "DELETE FROM scocu WHERE uid = ?";
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