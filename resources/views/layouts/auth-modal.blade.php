<div id="auth-modal" class="fixed inset-0 z-[10] flex items-center justify-center bg-blue-600/10 backdrop-blur-3xl hidden transition duration-300">
  <div class="bg-white p-6 rounded-lg shadow-2xl w-11/12 sm:w-2/3 md:w-1/3 lg:w-1/4 relative">
    
    <!-- Close Button -->
    <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 text-2xl leading-none">&times;</button>
    
    <!-- Signup Form -->
    <form id="signupForm" action="{{ route('signup') }}" method="POST" class="text-center space-y-4 hidden">
      @csrf
      <h2 class="text-2xl text-blue-600 font-bold">Create Account!</h2>
      <input type="text" name="first_name" placeholder="First Name" required class="w-full border border-gray-300 p-2 rounded">
      <input type="text" name="last_name" placeholder="Last Name" required class="w-full border border-gray-300 p-2 rounded">
      <select name="role" required class="w-full border border-gray-300 p-2 rounded">
        <option value="Owner">Owner</option>
        <option value="Contractor">Contractor</option>
      </select>
      <input type="email" name="email" placeholder="Your Business Email" required class="w-full border border-gray-300 p-2 rounded">
      <input type="password" name="password" placeholder="Create strong password" required class="w-full border border-gray-300 p-2 rounded">
      <button type="submit" class="w-full bg-blue-700 text-white font-semibold py-2 rounded hover:bg-blue-800 transition">Sign Up</button>
      <h6 class="text-sm">Already have an account? 
        <span class="text-blue-600 cursor-pointer hover:underline" onclick="showAuthForm('login')">Sign In</span>
      </h6>
    </form>
    
    <!-- Login Form -->
    <form id="loginForm" action="{{ route('login') }}" method="POST" class="text-center space-y-4 hidden">
      @csrf
      <h2 class="text-2xl text-blue-600 font-bold">Welcome!</h2>
      <h3 class="text-sm text-gray-600">Sign in to your account</h3>
      <input type="email" name="email" placeholder="Your Business Email" required class="w-full border border-gray-300 p-2 rounded">
      <input type="password" name="password" placeholder="Your Password" required class="w-full border border-gray-300 p-2 rounded">
      <button type="submit" class="w-full bg-blue-700 text-white font-semibold py-2 rounded hover:bg-blue-800 transition">Login</button>
      <h6 class="text-sm">Don't have an account? 
        <span class="text-blue-600 cursor-pointer hover:underline" onclick="showAuthForm('signup')">Sign Up</span>
      </h6>
    </form>

  </div>
</div>

<script>
  // Flash message auto close (if exists)
  setTimeout(() => {
    const message = document.getElementById('flash-message');
    if (message) {
      message.classList.add('opacity-0');
      setTimeout(() => message.remove(), 500);
    }
  }, 3000);

  // Show login/signup form
  function showAuthForm(formType) {
    const modal = document.getElementById('auth-modal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.getElementById('signupForm').classList.toggle('hidden', formType !== 'signup');
    document.getElementById('loginForm').classList.toggle('hidden', formType !== 'login');
  }

  // Close modal
  function closeModal() {
    const modal = document.getElementById('auth-modal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.getElementById('signupForm').classList.add('hidden');
    document.getElementById('loginForm').classList.add('hidden');
  }

  // Close when clicking outside
  document.getElementById('auth-modal').addEventListener('click', function (e) {
    if (e.target === this) closeModal();
  });
</script>
