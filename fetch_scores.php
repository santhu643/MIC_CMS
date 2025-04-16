<?php
// Connect to the database
$servername = "localhost";
$username = "TIHMIC";
$password = "KalaI@@1992@@";
$dbname = "mic";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve selected department from POST request
$dept = $_POST['dept'];
$batch = $_POST['batch'];

// Query to retrieve HID, name, and regno for the selected department
$sql = "SELECT hid, name, regno FROM hackerrank WHERE dept = '$dept' and batch = '$batch'";
$result = $conn->query($sql);

// Create an array to hold the structured data for each student
$studentData = [];

// If there are results from the database query
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $hid = $row["hid"];
        $name = $row["name"];
        $regno = $row["regno"];

        // Fetch data from the HackerRank API for each HID
        $apiUrl = "https://www.hackerrank.com/rest/hackers/$hid/badges";

        // Set up the context options with request headers
        $contextOptions = [
            'http' => [
                'header' => [
                    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:99.0) Gecko/20100101 Firefox/99.0',
                    'Accept: application/json',
                ],
                'ignore_errors' => true,
            ]
        ];
        $context = stream_context_create($contextOptions);

        // Fetch data from the API using file_get_contents with context
        $response = file_get_contents($apiUrl, false, $context);

        // Check if the request was successful
        if ($response !== false) {
            // Parse the JSON response
            $data = json_decode($response, true);

            // Initialize score variables
            $javaScore = 0;
            $pythonScore = 0;
            $cScore = 0;

            // Iterate through the badge data to extract scores
            if (isset($data['models'])) {
                foreach ($data['models'] as $badge) {
                    switch ($badge['badge_type']) {
                        case 'java':
                            $javaScore = $badge['current_points'];
                            break;
                        case 'python':
                            $pythonScore = $badge['current_points'];
                            break;
                        case 'c':
                            $cScore = $badge['current_points'];
                            break;
                        default:
                            // Ignore badges other than Java, Python, and C
                            break;
                    }
                }
            }

            // Add student data to the array
            $studentData[] = [
                'name' => $name,
                'regno' => $regno,
                'javaScore' => $javaScore,
                'pythonScore' => $pythonScore,
                'cScore' => $cScore,
            ];
        }
    }

    // Return the array of structured student data as JSON response
    echo json_encode($studentData);
} else {
    echo json_encode(["error" => "No results found for the specified department."]);
}

// Close the database connection
$conn->close();
