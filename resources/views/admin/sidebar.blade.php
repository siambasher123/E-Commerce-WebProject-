<aside class="bg-[#0d0d0d] text-white w-64 flex flex-col fixed top-0 left-0 h-full shadow-xl z-50">
  <!-- 🔹 Logo / Header -->
  <div class="p-5 flex items-center space-x-2 border-b border-gray-700">
    <span class="text-2xl">🛍</span>
    <h1 class="text-xl font-bold tracking-wide">MyShop</h1>
  </div>

  <!-- 🔹 Navigation Links -->
  <nav class="flex-1 p-4 space-y-2">
    <a href="{{ route('admin.dashboard') }}"
       class="block px-4 py-2.5 rounded-lg hover:bg-gray-800 transition duration-200 ease-in-out 
              {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800' : '' }}">
      🏠 Dashboard
    </a>

    <a href="{{ route('admin.products') }}"
       class="block px-4 py-2.5 rounded-lg hover:bg-gray-800 transition duration-200 ease-in-out 
              {{ request()->routeIs('admin.products') ? 'bg-gray-800' : '' }}">
      🛒 Products
    </a>

    <a href="{{ route('admin.discounts') }}"
       class="block px-4 py-2.5 rounded-lg hover:bg-gray-800 transition duration-200 ease-in-out 
              {{ request()->routeIs('admin.discounts') ? 'bg-gray-800' : '' }}">
      💸 Give Discount
    </a>

    <a href="{{ route('admin.orders') }}"
       class="block px-4 py-2.5 rounded-lg hover:bg-gray-800 transition duration-200 ease-in-out 
              {{ request()->routeIs('admin.orders') ? 'bg-gray-800' : '' }}">
      🧾 Orders
    </a>

    <a href="{{ route('admin.transactions') }}"
       class="block px-4 py-2.5 rounded-lg hover:bg-gray-800 transition duration-200 ease-in-out 
              {{ request()->routeIs('admin.transactions') ? 'bg-gray-800' : '' }}">
      💳 Transactions
    </a>

<a href="{{ route('admin.inquiries') }}" 
   class="block px-4 py-2 rounded-lg hover:bg-gray-800 transition {{ request()->routeIs('admin.inquiries') ? 'bg-gray-800' : '' }}">
  📞 Contact Requests
</a>


<a href="#" class="block px-4 py-2.5 rounded-lg hover:bg-gray-800 transition duration-200 ease-in-out">
  👥 Registered Clients
</a>

  </nav>

  <!-- 🔹 Logout -->
  <form method="POST" action="{{ route('logout') }}" class="p-4 border-t border-gray-700">
    @csrf
    <button type="submit"
            class="w-full bg-white text-black font-semibold py-2 rounded-lg hover:bg-gray-200 transition text-sm">
      Logout
    </button>
  </form>
</aside>
