<header class="bg-[#0d0d0d] sticky top-0 z-50 shadow-md relative">

  <!-- LEFT: LOGO fixed top-left -->
  <div class="absolute top-3 left-6 flex items-center space-x-2">
    <span class="text-2xl">🛍</span>
    <a href="<?php echo e(route('home')); ?>" class="text-2xl font-bold text-white tracking-wide">
      MyShop
    </a>
  </div>

  <!-- MAIN NAVBAR CONTENT -->
  <div class="max-w-7xl mx-auto px-6 py-3 flex items-center justify-center">

    <!-- CENTER: MENU + SEARCH -->
    <div class="flex items-center space-x-6">
      <!-- Navigation with dropdowns -->
      <nav class="hidden lg:flex space-x-6 font-medium text-gray-300 relative">
        <?php
          $categories = [
            'Men' => ['T-Shirts', 'Jeans', 'Punjabi', 'Formal Shirts', 'Jackets'],
            'Women' => ['Sarees', 'Kurtis', 'Tops', 'Dresses', 'Three-Pieces'],
            'Kids' => ['Boys’ Wear', 'Girls’ Wear', 'Baby Wear', 'School Uniforms', 'Accessories'],
            'Winter' => ['Sweaters', 'Hoodies', 'Jackets', 'Scarves', 'Thermals'],
            'Jewellery' => ['Necklaces', 'Earrings', 'Bracelets', 'Rings', 'Anklets'],
            'Shoes' => ['Sneakers', 'Formal Shoes', 'Sandals', 'Sports Shoes', 'Boots'],
            'Home Decor' => ['Wall Art', 'Lamps', 'Cushions', 'Vases', 'Clocks'],
            'Perfumes' => ['Men’s Perfumes', 'Women’s Perfumes', 'Unisex Fragrances', 'Body Mists', 'Deodorants']
          ];
        ?>

        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat => $subs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="group relative">
            <a href="<?php echo e(route('shop.category', ['category' => urlencode($cat)])); ?>" 
               class="hover:text-white transition">
              <?php echo e($cat); ?>

            </a>

            <!-- DROPDOWN MENU -->
            <div class="absolute hidden group-hover:block bg-white text-gray-800 rounded-lg mt-2 shadow-lg py-2 w-52 z-50">
              <?php $__currentLoopData = $subs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('shop.subcategory', ['category' => urlencode($cat), 'subcategory' => urlencode($sub)])); ?>"
                   class="block px-4 py-2 hover:bg-gray-100 whitespace-nowrap">
                  <?php echo e($sub); ?>

                </a>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </nav>

      <!-- 🔍 SEARCH BAR -->
      <form action="<?php echo e(route('search')); ?>" method="GET" class="relative hidden md:block w-64">
        <input 
          name="q" 
          type="text" 
          placeholder="Search products..."
          class="w-full rounded-full px-4 py-1.5 bg-white text-gray-800 focus:ring-2 focus:ring-indigo-500 focus:outline-none placeholder-gray-500 text-sm"
        >
        <button type="submit" class="absolute right-3 top-1.5 text-gray-500 hover:text-indigo-600">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M21 21l-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z" />
          </svg>
        </button>
      </form>
    </div>
  </div>

  <!-- RIGHT: CART + LOGIN/LOGOUT fixed top-right -->
  <div class="absolute top-3 right-6 flex items-center space-x-6">
    <!-- Cart -->
    <a href="<?php echo e(route('cart.index')); ?>" class="relative text-gray-200 hover:text-white" title="Cart">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 9m10-9l2 9m-6-9v9" />
      </svg>
      <span class="absolute -top-2 -right-2 bg-white text-black text-xs px-1 rounded-full">
        <?php echo e(count(session('cart', []))); ?>

      </span>
    </a>

    <!-- Auth Buttons -->
    <?php if(auth()->guard()->check()): ?>
      <form method="POST" action="<?php echo e(route('logout')); ?>">
        <?php echo csrf_field(); ?>
        <button type="submit" class="bg-white text-black font-semibold px-4 py-1.5 rounded-lg hover:bg-gray-200 transition text-sm">
          Logout
        </button>
      </form>
    <?php else: ?>
      <a href="<?php echo e(route('login')); ?>" 
         class="bg-white text-black font-semibold px-4 py-1.5 rounded-lg hover:bg-gray-200 transition text-sm">
        Login
      </a>
    <?php endif; ?>
  </div>
</header>

<!-- ✅ FLASH MESSAGES BELOW NAVBAR -->
<?php if(session('success')): ?>
  <div class="max-w-5xl mx-auto mt-4">
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative shadow-sm" role="alert">
      <strong class="font-bold">Success!</strong>
      <span class="block sm:inline"><?php echo e(session('success')); ?></span>
    </div>
  </div>
<?php endif; ?>

<?php if(session('error')): ?>
  <div class="max-w-5xl mx-auto mt-4">
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative shadow-sm" role="alert">
      <strong class="font-bold">Error!</strong>
      <span class="block sm:inline"><?php echo e(session('error')); ?></span>
    </div>
  </div>
<?php endif; ?>

<!-- 🧩 Auto-hide Flash Messages -->
<script>
  setTimeout(() => {
    document.querySelectorAll('[role="alert"]').forEach(el => {
      el.style.transition = "opacity 0.5s ease";
      el.style.opacity = "0";
      setTimeout(() => el.remove(), 500);
    });
  }, 3000);
</script>
<?php /**PATH C:\Users\USER\eshop\resources\views/partials/navbar.blade.php ENDPATH**/ ?>