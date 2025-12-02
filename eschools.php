<?php
// user/eschools.php
session_start();
$selected = $_GET['item'] ?? null;

// Define all E_SCHOOLS options with descriptions
$options = [
    'Computer' => 'Learn computer fundamentals and essential skills.',
    'Science' => 'Explore scientific concepts and experiments.',
    'Programming for Bengali' => 'Programming tutorials in Bengali for easy understanding.',
    'Seniors Guide' => 'Guides and tips from senior students.',
    'Project' => 'Project ideas, templates, and guidance.',
    'Cover Page Generator' => 'Tool to create beautiful cover pages.',
    'Online Contest → Programming Contest' => 'Participate in online programming contests.',
    'Online Contest → Quiz Contest' => 'Test your knowledge with quizzes.',
    'Online Contest → Regular Contest' => 'Standard competitions for practice.',
    'Online Contest → Gaming Contest' => 'Fun gaming contests to challenge your skills.',
    'Online Contest → Typing Contest' => 'Compete in typing speed contests.',
    'Online Course' => 'Access online courses for learning new skills.'
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>E_SCHOOLS - BRIU Computer Club</title>
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

<h1 class="text-5xl font-bold text-sky-400 mb-10 text-center">E_SCHOOLS</h1>

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
