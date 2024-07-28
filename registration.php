<?php
// registration.php

if (isset($_POST["submit"])) {
    $fullName = $_POST["name"];
    $email = $_POST["email"];
    $telephone = $_POST["telephone"];
    $address1 = $_POST["address1"];
    $address2 = $_POST["address2"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $zip = $_POST["zip"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["repeat_password"];

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $errors = array();

    if (empty($fullName) || empty($email) || empty($telephone) || empty($address1) || empty($address2) || empty($city) || empty($state) || empty($zip) || empty($username) || empty($password) || empty($passwordRepeat)) {
        $errors[] = "All fields are required";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email is not valid";
    }
    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long";
    }
    if ($password !== $passwordRepeat) {
        $errors[] = "Passwords do not match";
    }
    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    } else {
        // If validation passes, send an email and redirect to thank you page
        require_once "send_email.php";
        sendThankYouEmail($fullName, $email);
        header("Location: thank_you.php?name=" . urlencode($fullName));
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <form action="registration.php" method="POST">
            <div class="form-group">
                <input type="text" class="form-control" name="name" placeholder="Name" value="<?= htmlspecialchars($fullName ?? '') ?>" required>
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email" value="<?= htmlspecialchars($email ?? '') ?>" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="telephone" placeholder="Telephone" value="<?= htmlspecialchars($telephone ?? '') ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="address1" placeholder="Address 1" value="<?= htmlspecialchars($address1 ?? '') ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="address2" placeholder="Address 2" value="<?= htmlspecialchars($address2 ?? '') ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="city" placeholder="City" value="<?= htmlspecialchars($city ?? '') ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="state" placeholder="State/Province" value="<?= htmlspecialchars($state ?? '') ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="zip" placeholder="Zip/Post Code" value="<?= htmlspecialchars($zip ?? '') ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="Username" value="<?= htmlspecialchars($username ?? '') ?>" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password" required>
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Register" name="submit">
            </div>
        </form>
    </div>
</body>
</html>
