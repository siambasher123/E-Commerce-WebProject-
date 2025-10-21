<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard - MyShop</title>
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeInUp { animation: fadeInUp 0.6s ease-out; }
  </style>
</head>

<body class="bg-gray-100 text-gray-800 flex min-h-screen">

  <!-- ✅ SIDEBAR -->
  <aside class="bg-[#0d0d0d] text-white w-64 flex flex-col fixed top-0 left-0 h-full shadow-lg z-50">
    <div class="p-5 flex items-center space-x-2 border-b border-gray-700">
      <span class="text-2xl">🛍</span>
      <h1 class="text-xl font-bold tracking-wide">MyShop Admin</h1>
    </div>

    <nav class="flex-1 p-4 space-y-3">
      <a href="{{ route('admin.dashboard') }}" 
         class="block px-4 py-2 rounded-lg hover:bg-gray-800 transition {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800' : '' }}">
        🏠 Dashboard
      </a>

      <a href="{{ route('admin.products') }}" 
         class="block px-4 py-2 rounded-lg hover:bg-gray-800 transition {{ request()->routeIs('admin.products') ? 'bg-gray-800' : '' }}">
        🛒 Products
      </a>

      <a href="{{ route('admin.discounts') }}"
         class="block px-4 py-2 rounded-lg hover:bg-gray-800 transition {{ request()->routeIs('admin.discounts') ? 'bg-gray-800' : '' }}">
        💸 Give Discount
      </a>

      <!-- New Buttons -->
      <a href="{{ route('admin.orders') }}"
         class="block px-4 py-2 rounded-lg hover:bg-gray-800 transition {{ request()->routeIs('admin.orders') ? 'bg-gray-800' : '' }}">
        🧾 Orders
      </a>

      <a href="{{ route('admin.transactions') }}"
         class="block px-4 py-2 rounded-lg hover:bg-gray-800 transition {{ request()->routeIs('admin.transactions') ? 'bg-gray-800' : '' }}">
        💳 Transactions
      </a>

     <a href="{{ route('admin.inquiries') }}" 
   class="block px-4 py-2 rounded-lg hover:bg-gray-800 transition {{ request()->routeIs('admin.inquiries') ? 'bg-gray-800' : '' }}">
  📞 Contact Requests
</a>


      <a href="#"
         class="block px-4 py-2 rounded-lg hover:bg-gray-800 transition">
        👥 Registered Clients
      </a>
    </nav>

    <form method="POST" action="{{ route('logout') }}" class="p-4 border-t border-gray-700">
      @csrf
      <button type="submit" 
              class="w-full bg-white text-black font-semibold py-2 rounded-lg hover:bg-gray-200 transition text-sm">
        Logout
      </button>
    </form>
  </aside>

  <!-- ✅ MAIN CONTENT -->
  <main class="ml-64 flex-1 p-10 animate-fadeInUp">
    <h1 class="text-4xl font-extrabold mb-8 text-gray-900">👑 Welcome, Admin!</h1>

    <!-- 🔹 Quick Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
      <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition">
        <h2 class="text-lg font-semibold text-gray-700 mb-2">Total Users</h2>
        <p class="text-3xl font-bold text-indigo-600">{{ \App\Models\User::count() }}</p>
      </div>

      <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition">
        <h2 class="text-lg font-semibold text-gray-700 mb-2">Total Admins</h2>
        <p class="text-3xl font-bold text-indigo-600">{{ \App\Models\User::where('role', 'admin')->count() }}</p>
      </div>

      <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition">
        <h2 class="text-lg font-semibold text-gray-700 mb-2">Total Customers</h2>
        <p class="text-3xl font-bold text-indigo-600">{{ \App\Models\User::where('role', 'user')->count() }}</p>
      </div>
    </div>

    <!-- 🔹 Users Table -->
    <div class="bg-white rounded-2xl shadow-xl p-8">
      <h2 class="text-2xl font-bold text-gray-800 mb-6">👥 Registered Users</h2>

      <table class="min-w-full text-left border-collapse">
        <thead>
          <tr class="bg-gray-200 text-gray-700 text-sm uppercase tracking-wider">
            <th class="py-3 px-4 rounded-tl-lg">#</th>
            <th class="py-3 px-4">Name</th>
            <th class="py-3 px-4">Email</th>
            <th class="py-3 px-4">Role</th>
            <th class="py-3 px-4 rounded-tr-lg">Joined</th>
          </tr>
        </thead>
        <tbody class="text-gray-700 divide-y divide-gray-200">
          @foreach(\App\Models\User::orderBy('id','desc')->take(10)->get() as $user)
          <tr class="hover:bg-gray-50 transition">
            <td class="py-3 px-4">{{ $user->id }}</td>
            <td class="py-3 px-4">{{ $user->first_name }} {{ $user->last_name }}</td>
            <td class="py-3 px-4">{{ $user->email }}</td>
            <td class="py-3 px-4 capitalize">
              <span class="{{ $user->role === 'admin' ? 'bg-indigo-100 text-indigo-700' : 'bg-green-100 text-green-700' }} px-2 py-1 rounded-full text-xs font-semibold">
                {{ $user->role }}
              </span>
            </td>
            <td class="py-3 px-4 text-sm text-gray-500">{{ $user->created_at->format('d M, Y') }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </main>

</body>
</html>
