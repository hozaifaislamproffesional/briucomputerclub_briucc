<?php
// user/esports.php
session_start();
$selected = $_GET['item'] ?? null;

// Define all E_SPORTS options with descriptions
$options = [
    'Football' => 'Stay updated with local football matches and events.',
    'Chess' => 'Chess competitions and tutorials.',
    'EPL → Football' => 'English Premier League football updates.',
    'EPL → Cricket' => 'EPL cricket highlights and events.',
    'EPL → Badminton' => 'Badminton tournaments and tips.',
    'EPL → Chess' => 'Chess EPL competitions.',
    'EPL → Ludo' => 'Fun Ludo competitions.',
    'EPL → Carrom' => 'Carrom contests and events.'
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>E_SPORTS - BRIU Computer Club</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
<style>
  body { font-family: 'Roboto', sans-serif; background: linear-gradient(135deg,#0f2027,#203a43,#2c5364); }
  .glass { background: rgba(255,255,255,0.1); backdrop-filter: blur(12px); padding:30px; border-radius:1.5rem; box-shadow: 0 8px 32px rgba(0,0,0,0.4); }
  .option-card { transition: transform 0.3s, background 0.3s; }
  .option-card:hover { transform: translateY(-5px); background: rgba(56,189,248,0.2); }
</style>
</head>
<body class="text-white px-6 md:px-20 py-12">

<h1 class="text-5xl font-bold text-sky-400 mb-10 text-center">E_SPORTS</h1>

<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
<?php
if($selected && isset($options[$selected])){
    echo '<div class="glass option-card col-span-full">';
    echo '<h2 class="text-3xl font-semibold text-sky-300 mb-4">'.htmlspecialchars($selected).'</h2>';
    echo '<p class="text-slate-200 text-lg">'.htmlspecialchars($options[$selected]).'</p>';
    echo '</div>';
} else {
    foreach($options as $key => $desc){
        echo '<a href="?item='.urlencode($key).'" class="glass option-card block p-6 rounded-xl">';
        echo '<h2 class="text-2xl font-semibold text-sky-300 mb-2">'.htmlspecialchars($key).'</h2>';
        echo '<p class="text-slate-200">'.htmlspecialchars($desc).'</p>';
        echo '</a>';
    }
}
?>
</div>

<div class="text-center mt-12">
    <a href="../index.php" class="inline-block px-6 py-3 rounded-xl bg-sky-500 hover:bg-sky-600 transition font-semibold shadow-lg">Back to Home</a>
</div>

</body>
</html>
