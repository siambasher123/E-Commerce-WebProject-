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
      <a href="<?php echo e(route('admin.dashboard')); ?>" 
         class="block px-4 py-2 rounded-lg hover:bg-gray-800 transition <?php echo e(request()->routeIs('admin.dashboard') ? 'bg-gray-800' : ''); ?>">
        🏠 Dashboard
      </a>

      <a href="<?php echo e(route('admin.products')); ?>" 
         class="block px-4 py-2 rounded-lg hover:bg-gray-800 transition <?php echo e(request()->routeIs('admin.products') ? 'bg-gray-800' : ''); ?>">
        🛒 Products
      </a>

      <a href="<?php echo e(route('admin.discounts')); ?>"
         class="block px-4 py-2 rounded-lg hover:bg-gray-800 transition <?php echo e(request()->routeIs('admin.discounts') ? 'bg-gray-800' : ''); ?>">
        💸 Give Discount
      </a>

      <!-- New Buttons -->
      <a href="<?php echo e(route('admin.orders')); ?>"
         class="block px-4 py-2 rounded-lg hover:bg-gray-800 transition <?php echo e(request()->routeIs('admin.orders') ? 'bg-gray-800' : ''); ?>">
        🧾 Orders
      </a>

      <a href="<?php echo e(route('admin.transactions')); ?>"
         class="block px-4 py-2 rounded-lg hover:bg-gray-800 transition <?php echo e(request()->routeIs('admin.transactions') ? 'bg-gray-800' : ''); ?>">
        💳 Transactions
      </a>

     <a href="<?php echo e(route('admin.inquiries')); ?>" 
   class="block px-4 py-2 rounded-lg hover:bg-gray-800 transition <?php echo e(request()->routeIs('admin.inquiries') ? 'bg-gray-800' : ''); ?>">
  📞 Contact Requests
</a>


   <a href="<?php echo e(route('admin.clients')); ?>"
   class="block px-4 py-2.5 rounded-lg hover:bg-gray-800 transition duration-200 ease-in-out 
          <?php echo e(request()->routeIs('admin.clients') ? 'bg-gray-800' : ''); ?>">
  👥 Registered Clients
</a>

     

    <form method="POST" action="<?php echo e(route('logout')); ?>" class="p-4 border-t border-gray-700">
      <?php echo csrf_field(); ?>
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
        <p class="text-3xl font-bold text-indigo-600"><?php echo e(\App\Models\User::count()); ?></p>
      </div>

      <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition">
        <h2 class="text-lg font-semibold text-gray-700 mb-2">Total Admins</h2>
        <p class="text-3xl font-bold text-indigo-600"><?php echo e(\App\Models\User::where('role', 'admin')->count()); ?></p>
      </div>

      <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition">
        <h2 class="text-lg font-semibold text-gray-700 mb-2">Total Customers</h2>
        <p class="text-3xl font-bold text-indigo-600"><?php echo e(\App\Models\User::where('role', 'user')->count()); ?></p>
      </div>
    </div>


  </main>

</body>
</html>
<?php /**PATH C:\Users\USER\eshop\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>