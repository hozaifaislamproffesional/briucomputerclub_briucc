<?php
// user/briucc.php
session_start();
$selected = $_GET['item'] ?? null; // captures which sub-item was clicked
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BRIUCC - BRIU Computer Club</title>
<script src="https://cdn.tailwindcss.com"></script>
<style>
  body { font-family: 'Roboto', sans-serif; background: linear-gradient(135deg,#0f2027,#203a43,#2c5364); color: white; }
  .glass { background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); padding:20px; border-radius:1rem; }
</style>
</head>
<body class="text-white px-6 md:px-20">

<h1 class="text-4xl font-bold text-sky-400 mb-6">BRIUCC</h1>

<div class="glass">
    <?php
    if($selected){
        echo "<h2 class='text-2xl font-semibold text-sky-300 mb-2'>".htmlspecialchars($selected)."</h2>";
        echo "<p>This is the page for <strong>".htmlspecialchars($selected)."</strong>. You can customize the content here.</p>";
    } else {
        echo "<p>Welcome to the BRIUCC section. Select a sub-item from the dropdown to see details.</p>";
    }
    ?>
</div>

<a href="../index.php" class="inline-block mt-6 px-4 py-2 bg-sky-500 hover:bg-sky-600 rounded transition">Back to Home</a>

</body>
</html>
