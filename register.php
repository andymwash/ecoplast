<?php
include 'db.php'; // your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email    = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role     = $_POST['role'];

    $sql = "INSERT INTO users (fullname, email, password, role) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $fullname, $email, $password, $role);

    if ($stmt->execute()) {
        echo "Registration successful! <a href='login.html'>Login here</a>";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>