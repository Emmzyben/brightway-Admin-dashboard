<?php
session_start();

if (!isset($_SESSION['uniqueId'])) {
    header("Location: index.php");
    exit;
}

include 'database/db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['action'])) {
    $id = $_POST['id'];
    $action = $_POST['action'];

    if ($action === 'approved') {
        $status = 'approved';
    } elseif ($action === 'declined') {
        $status = 'declined';
    } else {
        $status = 'unapproved'; 
    }

    $sql = "UPDATE providers SET approved = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "provider status updated to " . ucfirst($status) . ".";
        $_SESSION['messageType'] = 'success';
    } else {
        $_SESSION['message'] = "Error updating provider status: " . $stmt->error;
        $_SESSION['messageType'] = 'error';
    }

    $stmt->close();
}

$conn->close();

header("Location: " . $_SERVER['HTTP_REFERER']);
exit;
