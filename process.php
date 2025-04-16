<?php
require 'config.php';
require 'session.php';

if (isset($_POST['save_stdname'])) {
    $fa = mysqli_real_escape_string($db, $_POST['faculty']);

    if (isset($_POST["selected_students"]) && is_array($_POST["selected_students"])) {
        $stmt = $db->prepare("UPDATE student SET mentor=? WHERE sid=?");

        foreach ($_POST["selected_students"] as $selected_student) {
            $stmt->bind_param("ss", $fa, $selected_student);
            $stmt->execute();
        }

        if ($stmt->affected_rows > 0) {
            $res = [
                'status' => 200,
                'message' => 'Mentor Added Successfully'
            ];
        } else {
            $res = [
                'status' => 500,
                'message' => 'Mentor Not Added'
            ];
        }

        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 502,
            'message' => 'No students selected'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_POST['save_csv'])) {
    $ay = mysqli_real_escape_string($db, $_POST['ayear']);

    if (isset($_FILES["csvfile"]) && $_FILES["csvfile"]["error"] == 0) {
        $file = $_FILES["csvfile"]["tmp_name"];

        $handle = fopen($file, "r");
        $firstRow = true;

        $stmt1 = $db->prepare("INSERT INTO student (sid, sname, ayear, mail, dept, pass, section) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt2 = $db->prepare("INSERT INTO sbasic (sid, batch) VALUES (?, ?)");

        try {
            while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                if ($firstRow) {
                    $firstRow = false;
                    continue;
                }

                $column1 = $data[0];
                $column2 = $data[1];
                $column3 = $ay;
                $column4 = $data[2];
                $column5 = $data[3];
                $column6 = $data[4];

                $stmt1->bind_param("sssssss", $column1, $column2, $column3, $column4, $column5, $column1, $column6);
                $stmt1->execute();

                $stmt2->bind_param("ss", $column1, $ay);
                $stmt2->execute();
            }

            fclose($handle);

            if ($stmt1->affected_rows > 0) {
                $res = [
                    'status' => 200,
                    'message' => 'Students added Successfully'
                ];
            } else {
                $res = [
                    'status' => 500,
                    'message' => 'Failed to add students'
                ];
            }

            echo json_encode($res);
            return;

        } catch (Exception $e) {
            $res = [
                'status' => 500,
                'message' => 'Duplicate Entry found'
            ];
            echo json_encode($res);
            return;
        }
    }
}

if (isset($_POST['save_stdname1'])) {
    $fa = mysqli_real_escape_string($db, $_POST['faculty']);

    if (isset($_POST["selected_students"]) && is_array($_POST["selected_students"])) {
        $stmt = $db->prepare("UPDATE student SET mentor='' WHERE sid=?");

        foreach ($_POST["selected_students"] as $selected_student) {
            $stmt->bind_param("s", $selected_student);
            $stmt->execute();
        }

        if ($stmt->affected_rows > 0) {
            $res = [
                'status' => 200,
                'message' => 'Mentees Deleted Successfully'
            ];
        } else {
            $res = [
                'status' => 500,
                'message' => 'Mentees Not Deleted'
            ];
        }

        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 502,
            'message' => 'No students selected'
        ];
        echo json_encode($res);
        return;
    }
}
?>
