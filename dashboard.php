<?php
session_start();
if (empty($_SESSION['user_id'])) {
    header('Location: /auth/login.php');
    exit;
}
include __DIR__ . '/../includes/header.php';
?>
<div class="max-w-3xl mx-auto bg-white dark:bg-slate-800 rounded-xl p-6 card-shadow">
  <h2 class="text-xl font-semibold">Dashboard</h2>
  <p class="mt-3">Welcome back, <?=htmlspecialchars($_SESSION['user_name'])?></p>
  <p class="mt-4"><a href="/auth/logout.php" class="text-sky-600">Logout</a></p>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>