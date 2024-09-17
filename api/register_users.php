<?php
header("Content-Type: application/json");

include '../database/db_config.php';

$input = json_decode(file_get_contents("php://input"), true);

$firstname = isset($input['firstname']) ? $input['firstname'] : null;
$lastname = isset($input['lastname']) ? $input['lastname'] : null;
$email = isset($input['email']) ? $input['email'] : null;
$phone = isset($input['phone']) ? $input['phone'] : null;
$date = isset($input['date']) ? $input['date'] : null;
$address = isset($input['address']) ? $input['address'] : null;
$state = isset($input['state']) ? $input['state'] : null;
$city = isset($input['city']) ? $input['city'] : null;
$zip = isset($input['zip']) ? $input['zip'] : null;
$service = isset($input['service']) ? $input['service'] : null;
$department = isset($input['department']) ? $input['department'] : null;
$username = isset($input['username']) ? $input['username'] : null;
$password = isset($input['password']) ? password_hash($input['password'], PASSWORD_DEFAULT) : null;
$profile_picture = isset($input['profile_picture']) ? $input['profile_picture'] : null;
$license = isset($input['license']) ? $input['license'] : null;
$accountType = isset($input['accountType']) ? $input['accountType'] : null;


$stmt = $conn->prepare("
    INSERT INTO users_patients 
    (firstname, lastname, email, phone, date, address, state, city, zip, service, department, username, password, profile_picture, license, accountType)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
");

$stmt->bind_param("ssssssssssssssss", $firstname, $lastname, $email, $phone, $date, $address, $state, $city, $zip, $service, $department, $username, $password, $profile_picture, $license, $accountType);


if ($stmt->execute()) {
    echo json_encode(['message' => 'User registered successfully']);
} else {
    echo json_encode(['error' => 'Error: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
