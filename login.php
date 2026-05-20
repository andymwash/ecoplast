<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email    = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role']    = $user['role'];

        // Redirect based on role
        if ($user['role'] == 'manager') {
            header("Location: manager_dashboard.php");
        } elseif ($user['role'] == 'finance') {
            header("Location: finance_dashboard.php");
        } else {
            header("Location: employee_dashboard.php");
        }
        exit();
    } else {
        echo "Invalid login credentials.";
    }
}
?>