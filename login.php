<?php
session_start();
require_once __DIR__ . '/../config/db.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = $_POST['type'];

    // LOGIN
    if ($type === 'login') {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        $stmt = $mysqli->prepare("SELECT id, password_hash, role FROM users WHERE email=? LIMIT 1");
        if (!$stmt) die("Prepare failed: ".$mysqli->error);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 1) {
            $stmt->bind_result($id, $hash, $role);
            $stmt->fetch();
            if (password_verify($password, $hash)) {
                $_SESSION['user_id'] = $id;
                $_SESSION['role'] = $role;
                header("Location: /briu_computer_club_tailwind/index.php");
                exit;
            } else {
                $errors[] = "Incorrect password.";
            }
        } else {
            $errors[] = "Email not found.";
        }
    }

    // REGISTER
    if ($type === 'register') {
        $name = trim($_POST['name']);
        $student_id = trim($_POST['student_id']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $role = $_POST['role'] ?? 'user';

        if (!$name || !$student_id || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 6) {
            $errors[] = "Enter valid name, student ID, email & password >=6 chars.";
        } else {
            // Check duplicate student_id or email
            $stmt = $mysqli->prepare("SELECT id FROM users WHERE email=? OR student_id=? LIMIT 1");
            if (!$stmt) die("Prepare failed: " . $mysqli->error);
            $stmt->bind_param("ss", $email, $student_id);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $errors[] = "Email or Student ID already exists.";
            } else {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $mysqli->prepare("INSERT INTO users (name, student_id, email, password_hash, role, created_at) VALUES (?,?,?,?,?,NOW())");
                if (!$stmt) die("Prepare failed: " . $mysqli->error);
                $stmt->bind_param("sssss", $name, $student_id, $email, $hash, $role);

                if ($stmt->execute()) {
                    $_SESSION['user_id'] = $mysqli->insert_id;
                    $_SESSION['role'] = $role;
                    header("Location: /briu_computer_club_tailwind/auth/login.php");
                    exit;
                } else {
                    $errors[] = "Registration failed: " . $stmt->error;
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>BRIU Computer Club — Login/Register</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 flex items-center justify-center min-h-screen text-white">

<div class="relative w-full max-w-3xl bg-white/10 backdrop-blur-md rounded-xl shadow-2xl overflow-hidden grid md:grid-cols-2 border border-white/20">

    <!-- Left Side -->
    <div class="hidden md:flex flex-col justify-center items-center bg-gradient-to-tr from-blue-700 to-blue-900 p-8 space-y-6">
        <img src="../assets/logo_club.png" alt="BRIU CC Logo" class="w-32 h-32 object-contain animate-pulse">
        <h1 class="text-3xl font-extrabold animate-pulse">BRIU Computer Club</h1>
        <p class="text-gray-200 text-center">Join workshops, competitions & tech projects.<br>Build your portfolio & connect with developers.</p>
        <div class="w-48 h-48 bg-blue-500 rounded-full animate-bounce opacity-40"></div>
    </div>

    <!-- Right Side Forms -->
    <div class="p-8 relative">
        <?php if($errors): ?>
            <div class="bg-red-500 text-white p-3 mb-4 rounded">
                <?= implode("<br>", $errors) ?>
            </div>
        <?php endif; ?>

        <!-- Tabs -->
        <div class="flex justify-center mb-6 space-x-4">
            <button id="loginTab" onclick="showTab('login')" class="px-4 py-2 font-bold border-b-2 border-blue-500">Login</button>
            <button id="registerTab" onclick="showTab('register')" class="px-4 py-2 font-bold border-b-2 border-transparent">Register</button>
        </div>

        <!-- LOGIN FORM -->
        <form method="POST" id="loginForm" class="space-y-4">
            <input type="hidden" name="type" value="login">
            <div>
                <label>Email</label>
                <input type="email" name="email" required class="w-full px-4 py-2 mt-1 rounded-lg bg-gray-700 border border-gray-600 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 transition">
            </div>
            <div>
                <label>Password</label>
                <input type="password" name="password" required class="w-full px-4 py-2 mt-1 rounded-lg bg-gray-700 border border-gray-600 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 transition">
            </div>
            <div class="text-right">
                <a href="forgot_password.php" class="text-sm text-blue-400 hover:underline">Forgot password?</a>
            </div>
            <button class="w-full bg-blue-600 hover:bg-blue-700 py-2 rounded-lg transition-all duration-300 transform hover:scale-105">Login</button>
        </form>

        <!-- REGISTER FORM -->
        <form method="POST" id="registerForm" class="hidden space-y-4">
            <input type="hidden" name="type" value="register">
            <div>
                <label>Full Name</label>
                <input type="text" name="name" required class="w-full px-4 py-2 mt-1 rounded-lg bg-gray-700 border border-gray-600 focus:border-green-400 focus:ring-1 focus:ring-green-400 transition">
            </div>
            <div>
                <label>Student ID</label>
                <input type="text" name="student_id" required class="w-full px-4 py-2 mt-1 rounded-lg bg-gray-700 border border-gray-600 focus:border-green-400 focus:ring-1 focus:ring-green-400 transition">
            </div>
            <div>
                <label>Email</label>
                <input type="email" name="email" required class="w-full px-4 py-2 mt-1 rounded-lg bg-gray-700 border border-gray-600 focus:border-green-400 focus:ring-1 focus:ring-green-400 transition">
            </div>
            <div>
                <label>Password</label>
                <input type="password" name="password" required class="w-full px-4 py-2 mt-1 rounded-lg bg-gray-700 border border-gray-600 focus:border-green-400 focus:ring-1 focus:ring-green-400 transition">
            </div>
            <div>
                <label>Role</label>
                <select name="role" class="w-full px-4 py-2 mt-1 rounded-lg bg-gray-700 border border-gray-600 focus:border-green-400 focus:ring-1 focus:ring-green-400 transition">
                    <option value="user" selected>User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <button class="w-full bg-green-600 hover:bg-green-700 py-2 rounded-lg transition-all duration-300 transform hover:scale-105">Register</button>
        </form>

        <p class="mt-4 text-center text-gray-400 text-sm">By signing up, you agree to our terms & policies.</p>
    </div>
</div>

<script>
function showTab(tab){
    if(tab==='login'){
        document.getElementById('loginForm').classList.remove('hidden');
        document.getElementById('registerForm').classList.add('hidden');
        document.getElementById('loginTab').classList.add('border-blue-500');
        document.getElementById('registerTab').classList.remove('border-green-500');
    } else {
        document.getElementById('loginForm').classList.add('hidden');
        document.getElementById('registerForm').classList.remove('hidden');
        document.getElementById('loginTab').classList.remove('border-blue-500');
        document.getElementById('registerTab').classList.add('border-green-500');
    }
}
</script>
</body>
</html>
