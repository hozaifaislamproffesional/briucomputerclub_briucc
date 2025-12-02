<?php
session_start();
require_once __DIR__ . '/config/db.php';

// Show welcome if redirected from login/registration
$show_welcome = false;
if (isset($_SESSION['show_welcome'])) {
    $show_welcome = true;
    unset($_SESSION['show_welcome']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BRIU Computer Club</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
<style>
  body { font-family: 'Roboto', sans-serif; background: linear-gradient(135deg,#0f2027,#203a43,#2c5364); }
  .glass { background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); }
  .dropdown:hover .dropdown-menu { display: block; }
  .card-shadow { box-shadow: 0 8px 32px 0 rgba(0,0,0,0.37); }

  /* Welcome Animation */
  #welcome-message {
    position: fixed;
    inset:0;
    background: rgba(0,0,0,0.85);
    color: #38bdf8;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 2.5rem;
    font-weight: bold;
    z-index: 1000;
    opacity: 0;
    transform: scale(0.8);
    transition: opacity 1s ease, transform 1s ease;
    text-align:center;
    padding:20px;
  }
  #welcome-message.show {
    opacity: 1;
    transform: scale(1);
  }
</style>
</head>
<body class="text-white">

<?php if($show_welcome): ?>
<div id="welcome-message">🎉 Welcome to BRIU Computer Club! 🎉<br>We are excited to have you join!</div>
<script>
document.addEventListener('DOMContentLoaded', ()=>{
    const msg = document.getElementById('welcome-message');
    msg.classList.add('show');

    // Hide message after 3s
    setTimeout(()=> {
        msg.classList.remove('show');
        msg.style.display='none';
    }, 3000);
});
</script>
<?php endif; ?>
<style>
  /* Navbar adjustments */
  nav ul li a {
    padding: 0.3rem 0.6rem; /* smaller padding */
    font-size: 0.9rem;       /* slightly smaller font */
  }

  /* Dropdown menu adjustments */
  .dropdown-menu {
    min-width: 160px;      /* smaller width */
    padding: 0.25rem 0;    /* smaller vertical padding */
  }

  .dropdown-menu li a {
    padding: 0.35rem 0.8rem;
    font-size: 0.85rem;
  }

  /* Multi-level dropdowns */
  .dropdown ul.dropdown-menu ul.dropdown-menu {
    left: 100%;
    top: 0;
    margin-left: 0.1rem;
  }

  /* About button */
  .about-btn {
    padding: 0.3rem 0.8rem;
    font-size: 0.9rem;
  }
</style>

<!-- Navbar -->
<nav class="fixed w-full bg-black/50 backdrop-blur-md z-50 shadow-lg">
  <div class="max-w-7xl mx-auto px-4 py-2 flex justify-between items-center">
    
    <!-- Left: Navbar Items -->
    <ul class="flex gap-3 items-center">
      <li class="text-xl font-bold text-sky-400 mr-4">BRIU CC</li>
      <li><a href="#" class="hover:text-sky-400 transition">HOME</a></li>

      <!-- BRIUCC Dropdown -->
<li class="relative dropdown group">
    <a href="#" class="hover:text-sky-400 transition px-2 py-1 rounded">BRIUCC ▼</a>
    <ul class="absolute hidden top-full mt-1 bg-black/80 backdrop-blur-md rounded-lg py-1 dropdown-menu min-w-[180px]">
        <li><a href="user/briucc.php?item=General+Member" class="block px-4 py-2 hover:bg-sky-500/70 rounded transition">General Member</a></li>
        <li><a href="user/briucc.php?item=Founders+Panel" class="block px-4 py-2 hover:bg-sky-500/70 rounded transition">Founders Panel</a></li>
        <li><a href="user/briucc.php?item=Moderator" class="block px-4 py-2 hover:bg-sky-500/70 rounded transition">Moderator</a></li>
        <li><a href="user/briucc.php?item=Executive+Body" class="block px-4 py-2 hover:bg-sky-500/70 rounded transition">Executive Body</a></li>
        <li class="relative dropdown group">
            <a href="#" class="block px-4 py-2 hover:bg-sky-500/70 rounded transition">Session ▼</a>
            <ul class="absolute left-full top-0 mt-0 ml-1 hidden bg-black/80 backdrop-blur-md rounded-lg py-1 dropdown-menu min-w-[150px]">
                <li><a href="user/briucc.php?item=Session+Monthly" class="block px-4 py-2 hover:bg-sky-500/70 rounded transition">Monthly</a></li>
                <li><a href="user/briucc.php?item=Session+Weekly" class="block px-4 py-2 hover:bg-sky-500/70 rounded transition">Weekly</a></li>
            </ul>
        </li>
        <li><a href="user/briucc.php?item=Agency" class="block px-4 py-2 hover:bg-sky-500/70 rounded transition">Agency</a></li>
        <li><a href="user/briucc.php?item=Store" class="block px-4 py-2 hover:bg-sky-500/70 rounded transition">Store</a></li>
        <li class="relative dropdown group">
            <a href="#" class="block px-4 py-2 hover:bg-sky-500/70 rounded transition">Certificate ▼</a>
            <ul class="absolute left-full top-0 mt-0 ml-1 hidden bg-black/80 backdrop-blur-md rounded-lg py-1 dropdown-menu min-w-[150px]">
                <li><a href="user/briucc.php?item=Certificate+Session" class="block px-4 py-2 hover:bg-sky-500/70 rounded transition">Session</a></li>
                <li><a href="user/briucc.php?item=Certificate+Online+Course" class="block px-4 py-2 hover:bg-sky-500/70 rounded transition">Online Course</a></li>
                <li><a href="user/briucc.php?item=Certificate+Contest" class="block px-4 py-2 hover:bg-sky-500/70 rounded transition">Contest</a></li>
                <li><a href="user/briucc.php?item=Certificate+Best+Member" class="block px-4 py-2 hover:bg-sky-500/70 rounded transition">Best Member / Executive Crest</a></li>
                <li><a href="user/briucc.php?item=Certificate+Idea+Share" class="block px-4 py-2 hover:bg-sky-500/70 rounded transition">Idea Share</a></li>
            </ul>
        </li>
        <li><a href="user/briucc.php?item=Idea+Share" class="block px-4 py-2 hover:bg-sky-500/70 rounded transition">Idea Share</a></li>
    </ul>
</li>

<!-- E_SCHOOLS Dropdown -->
<li class="relative dropdown group">
    <a href="#" class="hover:text-sky-400 transition px-2 py-1 rounded">E_SCHOOLS ▼</a>
    <ul class="absolute hidden top-full mt-1 bg-black/80 backdrop-blur-md rounded-lg py-1 dropdown-menu min-w-[200px]">
        <li><a href="user/eschools.php?item=Computer" class="block px-4 py-2 hover:bg-sky-500/70 rounded transition">Computer</a></li>
        <li><a href="user/eschools.php?item=Science" class="block px-4 py-2 hover:bg-sky-500/70 rounded transition">Science</a></li>
        <li><a href="user/eschools.php?item=Programming+for+Bengali" class="block px-4 py-2 hover:bg-sky-500/70 rounded transition">Programming for Bengali</a></li>
        <li><a href="user/eschools.php?item=Seniors+Guide" class="block px-4 py-2 hover:bg-sky-500/70 rounded transition">Seniors Guide</a></li>
        <li><a href="user/eschools.php?item=Project" class="block px-4 py-2 hover:bg-sky-500/70 rounded transition">Project</a></li>
        <li><a href="user/eschools.php?item=Cover+Page+Generator" class="block px-4 py-2 hover:bg-sky-500/70 rounded transition">Cover Page Generator</a></li>
        <li class="relative dropdown group">
            <a href="#" class="block px-4 py-2 hover:bg-sky-500/70 rounded transition">Online Contest ▼</a>
            <ul class="absolute left-full top-0 mt-0 ml-1 hidden bg-black/80 backdrop-blur-md rounded-lg py-1 dropdown-menu min-w-[150px]">
                <li><a href="user/eschools.php?item=Online+Contest+→+Programming+Contest" class="block px-4 py-2 hover:bg-sky-500/70 rounded transition">Programming Contest</a></li>
                <li><a href="user/eschools.php?item=Online+Contest+→+Quiz+Contest" class="block px-4 py-2 hover:bg-sky-500/70 rounded transition">Quiz Contest</a></li>
                <li><a href="user/eschools.php?item=Online+Contest+→+Regular+Contest" class="block px-4 py-2 hover:bg-sky-500/70 rounded transition">Regular Contest</a></li>
                <li><a href="user/eschools.php?item=Online+Contest+→+Gaming+Contest" class="block px-4 py-2 hover:bg-sky-500/70 rounded transition">Gaming Contest</a></li>
                <li><a href="user/eschools.php?item=Online+Contest+→+Typing+Contest" class="block px-4 py-2 hover:bg-sky-500/70 rounded transition">Typing Contest</a></li>
            </ul>
        </li>
        <li><a href="user/eschools.php?item=Online+Course" class="block px-4 py-2 hover:bg-sky-500/70 rounded transition">Online Course</a></li>
    </ul>
</li>

<!-- E_SPORTS Dropdown -->
<li class="relative dropdown group">
    <a href="#" class="hover:text-sky-400 transition px-2 py-1 rounded">E_SPORTS ▼</a>
    <ul class="absolute hidden top-full mt-1 bg-black/80 backdrop-blur-md rounded-lg py-1 dropdown-menu min-w-[200px]">
        <li><a href="user/esports.php?item=Football" class="block px-4 py-2 hover:bg-sky-500/70 rounded transition">Football</a></li>
        <li><a href="user/esports.php?item=Chess" class="block px-4 py-2 hover:bg-sky-500/70 rounded transition">Chess</a></li>
        <li class="relative dropdown group">
            <a href="#" class="block px-4 py-2 hover:bg-sky-500/70 rounded transition">EPL ▼</a>
            <ul class="absolute left-full top-0 mt-0 ml-1 hidden bg-black/80 backdrop-blur-md rounded-lg py-1 dropdown-menu min-w-[150px]">
                <li><a href="user/esports.php?item=EPL+→+Football" class="block px-4 py-2 hover:bg-sky-500/70 rounded transition">Football</a></li>
                <li><a href="user/esports.php?item=EPL+→+Cricket" class="block px-4 py-2 hover:bg-sky-500/70 rounded transition">Cricket</a></li>
                <li><a href="user/esports.php?item=EPL+→+Badminton" class="block px-4 py-2 hover:bg-sky-500/70 rounded transition">Badminton</a></li>
                <li><a href="user/esports.php?item=EPL+→+Chess" class="block px-4 py-2 hover:bg-sky-500/70 rounded transition">Chess</a></li>
                <li><a href="user/esports.php?item=EPL+→+Ludo" class="block px-4 py-2 hover:bg-sky-500/70 rounded transition">Ludo</a></li>
                <li><a href="user/esports.php?item=EPL+→+Carrom" class="block px-4 py-2 hover:bg-sky-500/70 rounded transition">Carrom</a></li>
            </ul>
        </li>
    </ul>
</li>

      </li>
    </ul>

    <!-- Right: About button -->
    <div>
      <a href="#about" class="px-3 py-1 rounded-lg bg-sky-500 hover:bg-sky-600 transition about-btn">ABOUT</a>
    </div>

  </div>
</nav>





<!-- Hero Section -->
<section class="flex items-center justify-center h-screen px-6 md:px-20 text-center relative">
  <div class="glass p-12 rounded-3xl shadow-xl max-w-3xl">
    <h1 class="text-5xl font-bold text-sky-400 mb-6">BRIU Computer Club</h1>
    <p class="text-lg text-slate-200 mb-8">Join the community of tech enthusiasts, developers, and learners. Participate in workshops, competitions, and events to enhance your skills and network with like-minded students.</p>
    <a href="member_register.php" class="inline-block px-8 py-3 rounded-xl bg-gradient-to-r from-sky-500 to-blue-700 font-semibold hover:scale-105 transition transform shadow-lg">Join as Member</a>
  </div>
</section>

<!-- About Section -->
<section id="about" class="mt-12 px-6 md:px-20 text-center">
  <h2 class="text-3xl font-bold text-sky-400 mb-4">About BRIU Computer Club</h2>
  <p class="text-slate-200 max-w-3xl mx-auto">
    BRIU Computer Club is a community of tech enthusiasts, developers, and learners. 
    We organize workshops, hackathons, competitions, and events to enhance skills, 
    collaborate, and provide career support for students of BRIU.
  </p>
</section>

<!-- Upcoming Events -->
<section class="mt-12 px-6 md:px-20">
  <h2 class="text-3xl font-bold text-sky-400 mb-6 text-center">Upcoming Events</h2>
  <div class="grid md:grid-cols-3 gap-6">
    <?php
      $res = $mysqli->query('SELECT id, title, description, event_date FROM events WHERE event_date >= CURDATE() ORDER BY event_date ASC LIMIT 6');
      if($res && $res->num_rows){
        while($ev = $res->fetch_assoc()){
          $date = date('M j, Y', strtotime($ev['event_date']));
          echo '<div class="bg-white/10 p-6 rounded-xl glass card-shadow">';
          echo '<h3 class="font-semibold text-lg text-sky-300">'.htmlspecialchars($ev['title']).'</h3>';
          echo '<p class="text-sm text-slate-200 mt-2">'.htmlspecialchars(substr($ev['description'],0,100)).'...</p>';
          echo '<div class="mt-4 flex justify-between items-center text-sm text-slate-300">';
          echo '<span>'.$date.'</span>';
          echo '<a href="#" class="text-sky-400 hover:underline">Register</a>';
          echo '</div></div>';
        }
      } else {
        echo '<div class="md:col-span-3 text-center text-slate-300 p-6 bg-white/10 rounded-xl glass card-shadow">No upcoming events. Admins can add events.</div>';
      }
    ?>
  </div>
</section>

<!-- Footer -->
<footer class="mt-12 p-6 text-center text-slate-400 text-sm">© 2025 BRIU Computer Club. All Rights Reserved.</footer>

</body>
</html>
