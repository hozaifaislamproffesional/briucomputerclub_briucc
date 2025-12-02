<?php
session_start();
require_once __DIR__ . '/../config/db.php';
if (empty($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: /auth/login.php');
    exit;
}
include __DIR__ . '/../includes/header.php';
// Simple event add form & list (starter)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['title'])) {
    $title = $mysqli->real_escape_string($_POST['title']);
    $desc = $mysqli->real_escape_string($_POST['description']);
    $date = $_POST['event_date'] ?? null;
    $stmt = $mysqli->prepare('INSERT INTO events (title, description, event_date) VALUES (?, ?, ?)');
    $stmt->bind_param('sss', $title, $desc, $date);
    $stmt->execute();
}
?>
<div class="max-w-3xl mx-auto bg-white dark:bg-slate-800 rounded-xl p-6 card-shadow">
  <h2 class="text-xl font-semibold">Manage Events</h2>
  <form method="post" class="mt-4 grid gap-3">
    <input name="title" placeholder="Event title" class="p-2 rounded-md border">
    <textarea name="description" placeholder="Description" class="p-2 rounded-md border"></textarea>
    <input name="event_date" type="date" class="p-2 rounded-md border">
    <button class="px-4 py-2 rounded-md bg-sky-600 text-white">Add Event</button>
  </form>
  <hr class="my-4">
  <h3 class="font-semibold">Existing Events</h3>
  <div class="mt-3 space-y-3">
    <?php
      $r = $mysqli->query('SELECT id,title,event_date FROM events ORDER BY event_date DESC LIMIT 50');
      while($row = $r->fetch_assoc()){
        echo '<div class="p-3 rounded-md bg-slate-50 dark:bg-slate-900 flex justify-between items-center">';
        echo '<div><strong>'.htmlspecialchars($row['title']).'</strong><div class="text-sm text-slate-500">'.htmlspecialchars($row['event_date']).'</div></div>';
        echo '<div><a href="?delete='.intval($row['id']).'" class="text-red-500">Delete</a></div>';
        echo '</div>';
      }
    ?>
  </div>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>