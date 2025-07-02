<section id="home" class="bg-white" itemscope itemtype="https://schema.org/Organization">
  <div class="max-w-screen-xl mx-auto px-4 py-10 lg:py-20 grid lg:grid-cols-12 gap-8 items-center">

    <!-- Left Content -->
    <div class="lg:col-span-7 space-y-6">
      <h1 class="text-4xl md:text-5xl xl:text-6xl font-extrabold text-gray-900 leading-tight" itemprop="name">
        Welcome to <span class="text-blue-600" itemprop="brand">Nirmaan</span>!
      </h1>
      <p class="text-gray-600 text-base md:text-lg lg:text-xl max-w-2xl" itemprop="description">
        We are connecting builders, contractors, and teams to streamline construction projects,
        enhance collaboration, and bring efficiency to every stage of development.
      </p>

      <!-- Buttons -->
      <div class="flex flex-wrap gap-4">
        <button aria-label="Get Started - Login or Signup" onclick="showAuthForm('login')" class="inline-flex items-center px-5 py-3 text-white bg-blue-600 hover:bg-blue-700 rounded-lg text-base font-medium focus:ring-4 focus:ring-blue-300 transition" itemprop="potentialAction" itemscope itemtype="https://schema.org/Action">
          Get Started
          <svg class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
            <path fill-rule="evenodd" clip-rule="evenodd"
              d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 
              0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 
              0 010-1.414z" />
          </svg>
        </button>
        <a href="#about" aria-label="Learn more about Nirmaan" class="px-5 py-3 text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100 text-base font-medium focus:ring-4 focus:ring-gray-100 transition">
          Learn More
        </a>
      </div>
    </div>

    <!-- Right Image -->
    <div class="lg:col-span-5 hidden lg:flex justify-center">
      <img loading="lazy" width="500" height="400" class="w-full max-w-md object-contain" src="{{ url('images/construction-of-real-estate-vector.jpg') }}" alt="Illustration of construction professionals collaborating on real estate development projects with Nirmaan" itemprop="image">
    </div>

  </div>
</section>

