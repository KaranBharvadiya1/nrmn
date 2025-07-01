<nav class="bg-white fixed w-full top-0 z-50 bg-opacity-50 backdrop-blur-md">
  <div class="max-w-screen-xl flex items-center justify-between mx-auto p-4">

    <!-- Logo -->
    <a href="/" class="flex items-center text-[29px] md:text-[32px] font-extrabold text-blue-600 font-montserrat gap-1">
      <span class="w-12 h-12 text-2xl bg-blue-600 text-white flex items-center justify-center rounded-full italic">N</span>
      <span class="italic text-2xl">irmaan</span>
    </a>

    <!-- Get Started Button + Mobile Toggle -->
    <div class="flex md:order-2 space-x-3 items-center">
      <button onclick="showAuthForm('login')" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Get started</button>

      <!-- Hamburger Icon -->
      <button id="menu-toggle" class="md:hidden p-2 w-10 h-10 flex items-center justify-center text-gray-500 rounded-lg hover:bg-gray-100 focus:ring-2 focus:ring-gray-200">
        <svg class="w-5 h-5" viewBox="0 0 17 14" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
      </button>
    </div>

    <!-- Desktop Menu -->
    <div class="hidden md:flex md:space-x-8" id="desktop-menu">
      <a href="#home" class="py-2 px-3 text-blue-700 font-medium">Home</a>
      <a href="#about" class="py-2 px-3 text-gray-900 hover:text-blue-700 font-medium">About</a>
      <a href="#services" class="py-2 px-3 text-gray-900 hover:text-blue-700 font-medium">Services</a>
      <a href="#contact" class="py-2 px-3 text-gray-900 hover:text-blue-700 font-medium">Contact</a>
    </div>
  </div>

  <!-- Mobile Menu -->
  <div id="mobile-menu" class="hidden absolute top-full left-0 w-full bg-white p-4 shadow-md md:hidden z-40">
    <a href="#home" class="block py-2 px-3 text-blue-700 font-medium">Home</a>
    <a href="#about" class="block py-2 px-3 text-gray-900 hover:text-blue-700 font-medium">About</a>
    <a href="#services" class="block py-2 px-3 text-gray-900 hover:text-blue-700 font-medium">Services</a>
    <a href="#contact" class="block py-2 px-3 text-gray-900 hover:text-blue-700 font-medium">Contact</a>
  </div>
</nav>

<script>
  const menuToggle = document.getElementById('menu-toggle');
  const mobileMenu = document.getElementById('mobile-menu');

  menuToggle.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
  });

  // Close menu on link click (mobile UX fix)
  document.querySelectorAll('#mobile-menu a').forEach(link => {
    link.addEventListener('click', () => {
      mobileMenu.classList.add('hidden');
    });
  });
</script>
