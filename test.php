<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}
include "myconfig.php";

// Get the request number (or any other parameter you may need)
$requestNo = $_REQUEST['number'];

// Prepare the SQL query to fetch the data
$sql = "CALL test_select_numbers(?)";
$stmt = $pdo->prepare($sql);

// Initialize an array to store the user data
$users = array();

try {
    // Execute the query with the request number as the parameter
    $stmt->execute(array($requestNo));

    // Fetch all the results as an associative array
    $userData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Check if any data is fetched
    if ($userData) {
        // First, we prepare the static data related to the crime
        $response = array(
            'Status' => true,
            'Crime_No' => $userData[0]['Crime_No'],
            'Sections' => $userData[0]['Sections'],
            'requestStation' => $userData[0]['requestStation'],
            'caseStation' => $userData[0]['caseStation'],
            'CFC_No' => $userData[0]['Crime_No'], // Assuming CFC_No is the same as Crime_No
            'user' => array() // Empty array to store user details
        );

        // Loop through the fetched user data and populate the 'user' field
        foreach ($userData as $row) {
            $user = array(
                'mobNo' => $row['mobNo'],
                'Provider' => $row['Provider'],
                'fdate' => $row['fdate'], // Handle possible NULL values
                'tdate' => $row['tdate'], // Handle possible NULL values
                'cdr' => $row['cdr'],
                'CAF' => $row['CAF'],
                'address' => $row['address']
            );
            // Append the user data to the 'user' array
            array_push($response['user'], $user);
        }

        // Set the response code to 200 (OK)
        http_response_code(200);

        // Return the data as JSON
        echo json_encode($response);
    } else {
        // If no data found, return an error status
        $response = array(
            'Status' => false,
            'message' => 'No data found'
        );
        http_response_code(404);
        echo json_encode($response);
    }

} catch (PDOException $e) {
    // Catch any errors and return an error message
    $response = array(
        'Status' => false,
        'message' => 'Error: ' . $e->getMessage()
    );
    http_response_code(500); // Internal Server Error
    echo json_encode($response);
}
?>
