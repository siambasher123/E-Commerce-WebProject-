<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sign Up - MyShop</title>
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    /* Soft fade & scale animation */
    @keyframes fadeInUp {
      0% { opacity: 0; transform: translateY(30px); }
      100% { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeInUp { animation: fadeInUp 0.8s ease-out; }
  </style>
</head>

<body class="bg-gradient-to-br from-gray-100 via-gray-200 to-gray-300 text-gray-800">

  <!-- NAVBAR -->
  @include('partials.navbar')

  <!-- SUCCESS FLASH (after account creation) -->
  @if (session('success'))
  <div id="flash-message"
       class="fixed top-24 left-1/2 transform -translate-x-1/2 w-full max-w-md bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-lg shadow-md text-center animate-fadeInUp z-50">
      <strong class="block font-semibold">{{ session('success') }}</strong>
      <p class="text-sm text-gray-600 mt-1">Redirecting to login page...</p>
  </div>
  <script>
    setTimeout(() => {
      window.location.href = "{{ route('login') }}";
    }, 2500); // redirect after 2.5 seconds
  </script>
  @endif

  <!-- SIGNUP SECTION -->
  <section class="min-h-screen flex items-center justify-center px-6 py-12">
    <div class="bg-white/80 backdrop-blur-lg p-10 rounded-3xl shadow-2xl w-full max-w-lg border border-gray-200 animate-fadeInUp transition-all duration-300 hover:shadow-3xl hover:scale-[1.02]">
      
      <!-- Header -->
      <h2 class="text-4xl font-extrabold text-center mb-2 text-gray-900 tracking-tight">
        Create Your Account ✨
      </h2>
      <p class="text-center text-gray-600 mb-8 text-sm">
        Join <span class="font-semibold text-black">MyShop</span> and start your style journey.
      </p>

      <!-- Signup Form -->
      <form method="POST" action="{{ route('register.post') }}" class="space-y-5">
        @csrf

        <!-- First & Last Name -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block font-medium text-gray-700 mb-2">First Name</label>
            <input type="text" name="first_name" required placeholder="John"
              class="w-full rounded-xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all duration-200 shadow-sm hover:shadow-md">
          </div>
          <div>
            <label class="block font-medium text-gray-700 mb-2">Last Name</label>
            <input type="text" name="last_name" required placeholder="Doe"
              class="w-full rounded-xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all duration-200 shadow-sm hover:shadow-md">
          </div>
        </div>

        <!-- Email -->
        <div>
          <label class="block font-medium text-gray-700 mb-2">Email</label>
          <input type="email" name="email" required placeholder="you@example.com"
            class="w-full rounded-xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all duration-200 shadow-sm hover:shadow-md">
        </div>

        <!-- Phone -->
        <div>
          <label class="block font-medium text-gray-700 mb-2">Phone Number</label>
          <input type="text" name="phone" placeholder="+1 234 567 890"
            class="w-full rounded-xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all duration-200 shadow-sm hover:shadow-md">
        </div>

        <!-- Address -->
        <div>
          <label class="block font-medium text-gray-700 mb-2">Address</label>
          <textarea name="address" rows="2" placeholder="Your delivery address..."
            class="w-full rounded-xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all duration-200 shadow-sm hover:shadow-md"></textarea>
        </div>

        <!-- Role -->
        <div>
          <label class="block font-medium text-gray-700 mb-2">Role</label>
          <select name="role" required
            class="w-full rounded-xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all duration-200 shadow-sm hover:shadow-md">
            <option value="user">User</option>
            <option value="admin">Admin</option>
          </select>
        </div>

        <!-- Password -->
        <div>
          <label class="block font-medium text-gray-700 mb-2">Password</label>
          <input type="password" name="password" required placeholder="••••••••"
            class="w-full rounded-xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all duration-200 shadow-sm hover:shadow-md">
        </div>

        <!-- Submit -->
        <button type="submit"
          class="w-full bg-gradient-to-r from-black via-gray-900 to-gray-700 text-white font-semibold py-2.5 rounded-xl hover:from-gray-800 hover:to-black transition duration-300 shadow-md hover:shadow-xl">
          Create Account
        </button>
      </form>

      <!-- Link -->
      <p class="text-center text-sm text-gray-700 mt-6">
        Already have an account?
        <a href="{{ route('login') }}" class="text-indigo-600 font-medium hover:underline hover:text-indigo-700 transition">
          Login
        </a>
      </p>
    </div>
  </section>

</body>
</html>
