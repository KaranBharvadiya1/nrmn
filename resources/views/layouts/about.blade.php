<section id="about" class="bg-gray-100">
  <div class="max-w-screen-xl mx-auto px-4 py-10 lg:py-20 lg:px-6 grid lg:grid-cols-2 gap-16 items-center">

    <!-- Images -->
    <div class="grid grid-cols-2 gap-4">
      <img class="w-full rounded-lg shadow-md" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/content/office-long-2.png" alt="Modern office space 1">
      <img class="w-full rounded-lg shadow-md mt-4 lg:mt-10" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/content/office-long-1.png" alt="Modern office space 2">
    </div>

    <!-- Text Content -->
    <div>
      <h4 class="text-blue-600 font-semibold text-lg tracking-wide uppercase">Who We Are</h4>
      <h2 class="text-4xl font-extrabold text-gray-900 py-4">Efficient Construction Site Management Made Simple</h2>
      <p class="text-gray-600 text-base md:text-lg lg:text-xl mb-6">
        At <strong>Nirmaan</strong>, we provide a smart and efficient way to manage construction projects. From tracking materials and labor to ensuring real-time project updates, our platform simplifies site management for builders, contractors, and project managers.
      </p>

      <!-- Mission & Vision Toggle -->
      <div class="max-w-md mx-auto text-center">
        <div class="flex justify-center gap-6 mb-4">
          <button id="mission" class="text-lg font-semibold text-blue-600 underline cursor-pointer transition-colors duration-300">Our Mission</button>
          <button id="vision" class="text-lg font-semibold text-gray-700 hover:text-blue-600 cursor-pointer transition-colors duration-300">Our Vision</button>
        </div>
        <div id="content-container" class="relative bg-white rounded-lg shadow h-32 overflow-hidden">
          <div id="mission-content" class="p-4 absolute inset-0 transition-all duration-500 ease-in-out">
            <p class="text-gray-600">
              To revolutionize the construction industry by seamlessly connecting project owners with trusted contractors, ensuring transparency, efficiency, and quality in every project.
            </p>
          </div>
          <div id="vision-content" class="p-4 absolute inset-0 transition-all duration-500 ease-in-out translate-y-full opacity-0">
            <p class="text-gray-600">
              To become the leading digital platform that empowers construction professionals, streamlines project execution,
              and fosters innovation in the construction sector worldwide.
            </p>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>

<script>
  const missionBtn = document.getElementById("mission");
  const visionBtn = document.getElementById("vision");
  const missionContent = document.getElementById("mission-content");
  const visionContent = document.getElementById("vision-content");

  missionBtn.addEventListener("click", () => {
    // Update button styles
    missionBtn.classList.add("text-blue-600", "underline");
    missionBtn.classList.remove("text-gray-700");
    visionBtn.classList.remove("text-blue-600", "underline");
    visionBtn.classList.add("text-gray-700");
    
    // Content transition
    missionContent.classList.remove("translate-y-full", "opacity-0");
    visionContent.classList.add("translate-y-full", "opacity-0");
  });

  visionBtn.addEventListener("click", () => {
    // Update button styles
    visionBtn.classList.add("text-blue-600", "underline");
    visionBtn.classList.remove("text-gray-700");
    missionBtn.classList.remove("text-blue-600", "underline");
    missionBtn.classList.add("text-gray-700");
    
    // Content transition
    missionContent.classList.add("translate-y-full", "opacity-0");
    visionContent.classList.remove("translate-y-full", "opacity-0");
  });
</script>