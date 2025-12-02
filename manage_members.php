<?php
session_start();
require_once __DIR__ . '/../config/db.php';
if (empty($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: /auth/login.php');
    exit;
}
include __DIR__ . '/../includes/header.php';
$r = $mysqli->query('SELECT id,name,student_id,email,role FROM users ORDER BY created_at DESC LIMIT 200');
?>
<div class="max-w-4xl mx-auto bg-white dark:bg-slate-800 rounded-xl p-6 card-shadow">
  <h2 class="text-xl font-semibold">Manage Members</h2>
  <div class="mt-4 overflow-x-auto">
    <table class="w-full text-sm">
      <thead><tr class="text-left"><th>Name</th><th>Student ID</th><th>Email</th><th>Role</th></tr></thead>
      <tbody>
        <?php while($u = $r->fetch_assoc()){ echo '<tr class="border-t"><td>'.htmlspecialchars($u['name']).'</td><td>'.htmlspecialchars($u['student_id']).'</td><td>'.htmlspecialchars($u['email']).'</td><td>'.htmlspecialchars($u['role']).'</td></tr>'; }?>
      </tbody>
    </table>
  </div>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>