<?php if(session_status() === PHP_SESSION_NONE) session_start(); ?>
<!doctype html>
<html lang="en" class="transition-colors duration-300">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>BRIU Computer Club</title>
  <!-- Tailwind Play CDN for quick prototyping -->
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* small custom styles */
    .card-shadow { box-shadow: 0 10px 30px rgba(2,6,23,0.08); }
    .glass { background: rgba(255,255,255,0.6); backdrop-filter: blur(6px); }
    html.dark .glass { background: rgba(3,7,18,0.45); }
  </style>
</head>
<body class="bg-slate-50 text-slate-900 dark:bg-slate-900 dark:text-slate-100">
<header class="bg-gradient-to-r from-slate-800 to-sky-700 text-white">
  <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16">
      <a href="/index.php" class="flex items-center gap-3">
        <img src="/assets/briu-logo.png" alt="BRIU" class="h-10 w-10 object-contain">
        <span class="font-semibold text-lg">BRIU Computer Club</span>
      </a>

      <!-- Desktop nav -->
      <nav class="hidden md:flex items-center gap-4">
        <a href="/index.php" class="hover:underline">Home</a>
        <a href="#events" class="hover:underline">Events</a>
        <a href="#committee" class="hover:underline">Committee</a>
        <a href="#gallery" class="hover:underline">Gallery</a>
        <?php if(empty($_SESSION['user_id'])): ?>
          <a href="/auth/register.php" class="ml-3 px-3 py-2 rounded-md bg-white text-slate-800 font-medium">Join</a>
          <a href="/auth/login.php" class="ml-2 px-3 py-2 rounded-md border border-white/30">Login</a>
        <?php else: ?>
          <a href="/user/dashboard.php" class="ml-3 px-3 py-2 rounded-md bg-white text-slate-800 font-medium">Dashboard</a>
        <?php endif; ?>
        <!-- Dark mode toggle -->
        <button id="themeToggle" class="ml-4 p-2 rounded-md bg-white/10 hover:bg-white/20" title="Toggle dark mode">🌓</button>
      </nav>

      <!-- Mobile menu button -->
      <div class="md:hidden flex items-center gap-2">
        <button id="themeToggleMobile" class="p-2 rounded-md bg-white/10">🌓</button>
        <button id="mobileBtn" class="p-2 rounded-md bg-white/10" aria-label="Open menu">☰</button>
      </div>
    </div>
  </div>

  <!-- Mobile panel -->
  <div id="mobilePanel" class="md:hidden hidden bg-slate-800/80 text-white">
    <div class="px-4 py-4 flex flex-col gap-2">
      <a href="/index.php">Home</a>
      <a href="#events">Events</a>
      <a href="#committee">Committee</a>
      <a href="#gallery">Gallery</a>
      <?php if(empty($_SESSION['user_id'])): ?>
        <a href="/auth/register.php" class="mt-2 px-3 py-2 rounded-md bg-white text-slate-800 inline-block">Join</a>
      <?php else: ?>
        <a href="/user/dashboard.php" class="mt-2 px-3 py-2 rounded-md bg-white text-slate-800 inline-block">Dashboard</a>
      <?php endif; ?>
    </div>
  </div>
</header>

<main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">


<script>
// Mobile menu toggle
document.addEventListener('DOMContentLoaded', function(){
  const btn = document.getElementById('mobileBtn');
  const panel = document.getElementById('mobilePanel');
  btn && btn.addEventListener('click', ()=> panel.classList.toggle('hidden'));

  // theme toggle (persist in localStorage)
  const themeToggle = document.getElementById('themeToggle');
  const themeToggleMobile = document.getElementById('themeToggleMobile');
  function setTheme(dark){
    if(dark){ document.documentElement.classList.add('dark'); localStorage.setItem('briu-theme','dark'); }
    else { document.documentElement.classList.remove('dark'); localStorage.setItem('briu-theme','light'); }
  }
  const saved = localStorage.getItem('briu-theme');
  if(saved === 'dark') setTheme(true);
  if(themeToggle) themeToggle.addEventListener('click', ()=> setTheme(!document.documentElement.classList.contains('dark')));
  if(themeToggleMobile) themeToggleMobile.addEventListener('click', ()=> setTheme(!document.documentElement.classList.contains('dark')));
});
</script>
