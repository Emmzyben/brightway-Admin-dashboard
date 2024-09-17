<?php
header("Content-Type: application/json");
include '../database/db_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = json_decode(file_get_contents("php://input"), true);
    
    if (isset($input['username']) && isset($input['password'])) {
        $user = $input['username'];
        $pass = password_hash($input['password'], PASSWORD_BCRYPT);
        
        $stmt = $conn->prepare("INSERT INTO register (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $user, $pass);
        
        if ($stmt->execute()) {
            echo json_encode(["message" => "User added successfully"]);
        } else {
            echo json_encode(["error" => "Failed to add user: " . $stmt->error]);
        }
        
        $stmt->close();
    } else {
        echo json_encode(["error" => "Invalid input"]);
    }
}

$conn->close();
?>
