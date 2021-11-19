<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Dev</title>

  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
  <header class="flex items-center justify-between h-16 px-4 py-10 bg-gray-900">
    <div class="flex items-center">
      <button id="hamburger-menu-button">
        <img src="{{ asset('images/menu_white_24dp.svg') }}" alt="Hamburger menu button">
      </button>
      <a class="ml-4 text-white text-2xl" href="#">Smarta</a>
    </div>
    <div class="flex items-center">
      <button>
        <img src="{{ asset('images/notifications_white_24dp.svg') }}" alt="Notification menu button">
      </button>
      <button class="ml-4">
        <img class="h-10 w-10 rounded-full ring-2 ring-green-900" src="{{ asset('images/michael-dam-mEZ3PoFGs_k-unsplash.jpg') }}" alt="Profile image">
      </button>
    </div>
  </header>
  <div id="drawer-overlay" class="invisible absolute top-0 left-0 w-full h-full bg-opacity-0 bg-black transition"></div>
  <section id="drawer" class="absolute top-0 -left-full w-96 h-full shadow-lg bg-white transition-all">
    <div class="flex items-center h-16 px-4 py-10">
      <button id="arrow-back-button">
        <img src="{{ asset('images/arrow_back_black_24dp.svg') }}" alt="Back button">
      </button>
    </div>
    <div class="flex flex-col">
      <button class="flex items-center h-16 w-full px-4 border-t-2 border-green-900">
        <img src="{{ asset('images/account_circle_black_24dp.svg') }}" alt="Profile button">
        <h1 class="ml-4">Profile</h1>
      </button>
      <button class="flex items-center h-16 w-full px-4 border-t-2 border-green-900">
        <img src="{{ asset('images/dashboard_black_24dp.svg') }}" alt="Profile button">
        <h1 class="ml-4">Dashboard</h1>
      </button>
      <button class="flex items-center h-16 w-full px-4 border-t-2 border-green-900">
        <img src="{{ asset('images/subject_black_24dp.svg') }}" alt="Profile button">
        <h1 class="ml-4">Subject</h1>
      </button>
      <button class="flex items-center h-16 w-full px-4 border-t-2 border-b-2 border-green-900">
        <img src="{{ asset('images/notifications_black_24dp (1).svg') }}" alt="Profile button">
        <h1 class="ml-4">Notification</h1>
      </button>
    </div>
  </section>
  <script>
    const hamburgerMenuButton = document.getElementById('hamburger-menu-button');
    hamburgerMenuButton.onclick = openDrawer;

    const arrowBackButton = document.getElementById('arrow-back-button');
    arrowBackButton.onclick = closeDrawer;

    const drawer = document.getElementById('drawer');
    const drawerOverlay = document.getElementById('drawer-overlay');

    function openDrawer() {
      drawerOverlay.classList.remove('invisible');
      drawerOverlay.classList.remove('bg-opacity-0');
      drawerOverlay.classList.add('bg-opacity-20');

      drawerOverlay.addEventListener('click', closeDrawer);

      drawer.classList.remove('-left-full');
      drawer.classList.add('left-0');
    }

    function closeDrawer() {
      drawer.classList.remove('left-0');
      drawer.classList.add('-left-full');

      drawerOverlay.removeEventListener('click', closeDrawer);

      drawerOverlay.classList.remove('bg-opacity-20');
      drawerOverlay.classList.add('bg-opacity-0');
      drawerOverlay.classList.add('invisible');
    }
  </script>
</body>
</html>
