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
      <p class="text-gray-700 text-base md:text-lg lg:text-xl mb-6">
        At <strong>Nirmaan</strong>, we provide a smart and efficient way to manage construction projects. From tracking materials and labor to ensuring real-time project updates, our platform simplifies site management for builders, contractors, and project managers.
      </p>

      <!-- Mission & Vision Toggle -->
      <div class="max-w-md mx-auto text-center">
        <div class="flex justify-center gap-6 mb-4">
          <button id="mission" class="text-lg font-semibold text-blue-600 underline cursor-pointer">Our Mission</button>
          <button id="vision" class="text-lg font-semibold text-gray-700 hover:text-blue-600 cursor-pointer">Our Vision</button>
        </div>
        <div id="content" class="bg-white p-4 rounded-lg shadow">
          <p class="text-gray-700">
            To revolutionize the construction industry by seamlessly connecting project owners with trusted contractors, ensuring transparency, efficiency, and quality in every project.
          </p>
        </div>
      </div>
    </div>

  </div>
</section>

<script>
  const mission = document.getElementById("mission");
  const vision = document.getElementById("vision");
  const content = document.getElementById("content");

  mission.addEventListener("click", () => {
    content.innerHTML = `<p class="text-gray-700">
      To revolutionize the construction industry by seamlessly connecting project owners with trusted contractors,
      ensuring transparency, efficiency, and quality in every project.
    </p>`;
    mission.classList.add("text-blue-600", "underline");
    mission.classList.remove("text-gray-700");
    vision.classList.remove("text-blue-600", "underline");
    vision.classList.add("text-gray-700");
  });

  vision.addEventListener("click", () => {
    content.innerHTML = `<p class="text-gray-700">
      To become the leading digital platform that empowers construction professionals, streamlines project execution,
      and fosters innovation in the construction sector worldwide.
    </p>`;
    vision.classList.add("text-blue-600", "underline");
    vision.classList.remove("text-gray-700");
    mission.classList.remove("text-blue-600", "underline");
    mission.classList.add("text-gray-700");
  });
</script>
