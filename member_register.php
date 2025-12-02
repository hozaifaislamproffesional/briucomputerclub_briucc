<?php
session_start();
require_once __DIR__ . '/config/db.php';

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = trim($_POST['name']);
    $student_id = trim($_POST['student_id']);
    $department = trim($_POST['department']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $semester = trim($_POST['semester']);
    $gender = trim($_POST['gender']);
    $transaction = trim($_POST['transaction_number']);
    $amount = 200; // fixed membership fee

    if (empty($transaction)) {
        $error = "❌ Payment transaction number is required.";
    } else {
        $stmt = $mysqli->prepare("INSERT INTO club_members(name, student_id, department, email, phone, semester, gender, transaction_number, amount) VALUES (?,?,?,?,?,?,?,?,?)");
        if(!$stmt){
            $error = "Database Prepare Error: " . $mysqli->error;
        } else {
            $stmt->bind_param("ssssssssi", $name, $student_id, $department, $email, $phone, $semester, $gender, $transaction, $amount);

            if ($stmt->execute()) {
                // Registration successful → redirect to index
                header("Location: /briu_computer_club_tailwind/index.php");
                exit;
            } else {
                $error = "Database Error: " . $stmt->error;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Member Registration - BRIU CC</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
<style>
    body { font-family: 'Roboto', sans-serif; background: linear-gradient(135deg,#0f2027,#203a43,#2c5364); }
    .glass { background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); }
    .card-shadow { box-shadow: 0 8px 32px 0 rgba(0,0,0,0.37); }
</style>
</head>
<body class="text-white">

<div class="max-w-xl mx-auto mt-20 p-8 bg-gray-800 rounded-2xl shadow-lg glass">
    <h2 class="text-3xl font-bold text-center text-sky-400 mb-6">BRIU CC Member Registration</h2>

    <!-- Display success or error -->
    <?php if ($success): ?>
        <p class="bg-green-600 p-3 rounded mb-4 text-center"><?= $success ?></p>
    <?php endif; ?>

    <?php if ($error): ?>
        <p class="bg-red-600 p-3 rounded mb-4 text-center"><?= $error ?></p>
    <?php endif; ?>

    <!-- Membership Fee & Payment Info -->
    <p class="text-slate-300 font-medium mb-2">Membership Fee: <span class="text-sky-400 font-bold">200 Taka</span></p>
    <p class="text-slate-300 mb-2">Send the payment to one of the following numbers:</p>
    <ul class="text-slate-200 mb-4">
        <li>Bkash: <strong>01XXXXXXXXX</strong></li>
        <li>Nagad: <strong>01YYYYYYYYY</strong></li>
    </ul>
    <p class="text-red-400 mb-6">After payment, enter the transaction number below.</p>

    <form method="POST" class="space-y-4">

        <input type="text" name="name" placeholder="Full Name" required class="w-full p-3 rounded bg-gray-700">
        <input type="text" name="student_id" placeholder="Student ID" required class="w-full p-3 rounded bg-gray-700">

        <select name="department" required class="w-full p-3 rounded bg-gray-700">
            <option value="">Select Department</option>
            <option>CSE</option>
            <option>EEE</option>
            <option>BBA</option>
            <option>English</option>
            <option>LAW</option>
            <option>POL</option>
        </select>

        <input type="email" name="email" placeholder="Email Address" required class="w-full p-3 rounded bg-gray-700">
        <input type="text" name="phone" placeholder="Phone Number" required class="w-full p-3 rounded bg-gray-700">
        <input type="text" name="semester" placeholder="Semester (e.g. 3rd)" required class="w-full p-3 rounded bg-gray-700">

        <select name="gender" required class="w-full p-3 rounded bg-gray-700">
            <option value="">Select Gender</option>
            <option>Male</option>
            <option>Female</option>
        </select>

        <input type="text" name="transaction_number" placeholder="Bkash/Nagad Transaction Number" required class="w-full p-3 rounded bg-gray-700">

        <button class="w-full bg-sky-500 hover:bg-sky-600 p-3 rounded text-lg font-semibold">
            Submit Registration
        </button>
    </form>
</div>

</body>
</html>
