<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>MyShop - E-Commerce</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#f8f8f8] text-gray-800">

  <!-- NAVBAR -->
  <header class="bg-[#0d0d0d] sticky top-0 z-50 shadow-md relative">

    <!-- LEFT: LOGO fixed top-left -->
    <div class="absolute top-3 left-6 flex items-center space-x-2">
      <span class="text-2xl">🛍</span>
      <h1 class="text-2xl font-bold text-white tracking-wide">MyShop</h1>
    </div>

    <!-- MAIN NAVBAR CONTENT -->
    <div class="max-w-7xl mx-auto px-6 py-3 flex items-center justify-center">

      <!-- CENTER: MENU + SEARCH -->
      <div class="flex items-center space-x-6">
        <nav class="hidden lg:flex space-x-6 font-medium text-gray-300 relative">

          @php
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
          @endphp

          @foreach($categories as $cat => $subs)
            <div class="group relative">
              <a href="{{ route('shop.category', ['category' => urlencode($cat)]) }}"
                 class="hover:text-white transition">
                {{ $cat }}
              </a>

              <!-- DROPDOWN MENU -->
              <div class="absolute hidden group-hover:block bg-white text-gray-800 rounded-lg mt-2 shadow-lg py-2 w-52 z-50">
                @foreach($subs as $sub)
                  <a href="{{ route('shop.subcategory', ['category' => urlencode($cat), 'subcategory' => urlencode($sub)]) }}"
                     class="block px-4 py-2 hover:bg-gray-100 whitespace-nowrap">
                    {{ $sub }}
                  </a>
                @endforeach
              </div>
            </div>
          @endforeach

        </nav>

        <!-- 🔍 SEARCH BAR -->
        <form action="{{ route('search') }}" method="GET" class="relative hidden md:block w-64">
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

    <!-- RIGHT: CART + CONTACT + LOGIN -->
    <div class="absolute top-3 right-6 flex items-center space-x-6">
      <!-- Cart -->
      <a href="{{ route('cart.index') }}" class="relative text-gray-200 hover:text-white" title="Cart">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 9m10-9l2 9m-6-9v9" />
        </svg>
        <span class="absolute -top-2 -right-2 bg-white text-black text-xs px-1 rounded-full">
          {{ count(session('cart', [])) }}
        </span>
      </a>

      <!-- Contact Us Button -->
      <a href="{{ route('contact.form') }}" 
         class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-semibold px-4 py-1.5 rounded-lg hover:scale-105 hover:shadow-md transition text-sm">
        Contact Us
      </a>

      <!-- Auth buttons -->
      @auth
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="bg-white text-black font-semibold px-4 py-1.5 rounded-lg hover:bg-gray-200 transition text-sm">
            Logout
          </button>
        </form>
      @else
        <a href="{{ route('login') }}" 
           class="bg-white text-black font-semibold px-4 py-1.5 rounded-lg hover:bg-gray-200 transition text-sm">
          Login
        </a>
      @endauth
    </div>

  </header>

  <!-- HERO SECTION -->
  <section class="bg-gradient-to-r from-gray-100 to-gray-200 py-20">
    <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between">
      <div class="mb-10 md:mb-0">
        <h2 class="text-4xl md:text-5xl font-bold mb-4 text-gray-900">Shop the Latest Trends</h2>
        <p class="text-lg mb-6 text-gray-600">Discover premium fashion, accessories, and fragrances designed for you.</p>
        <a href="{{ route('shop.index') }}" class="bg-black text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-800 transition">
          Shop Now
        </a>
      </div>
      <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=800&q=80"
        alt="Fashion" class="rounded-2xl shadow-xl w-full md:w-1/2">
    </div>
  </section>

  <!-- CATEGORY GRID -->
  <section class="max-w-7xl mx-auto px-6 py-16">
    <h3 class="text-3xl font-bold text-center mb-10 text-gray-900">Shop by Category</h3>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
      @foreach ([ 
        ['Men','https://images.unsplash.com/photo-1600180758890-6d9c3a1e1a64'],
        ['Women','https://images.unsplash.com/photo-1520962918287-7448c2878f65'],
        ['Kids','https://images.unsplash.com/photo-1605733160314-4d2a4a2a96ad'],
        ['Perfumes','https://images.unsplash.com/photo-1614228079419-1e705d5efb12']
      ] as [$title,$img])
      <a href="{{ route('shop.category', ['category' => urlencode($title)]) }}" 
         class="relative group overflow-hidden rounded-xl shadow-md hover:shadow-xl transition">
        <img src="{{ $img }}?auto=format&fit=crop&w=500&q=60" alt="{{ $title }}"
             class="w-full h-64 object-cover group-hover:scale-110 transition">
        <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
          <p class="text-white text-lg font-semibold">{{ $title }}</p>
        </div>
      </a>
      @endforeach
    </div>
  </section>

  <!-- FEATURED PRODUCTS -->
  <section class="bg-[#f4f4f4] py-20 border-t border-gray-200">
    <div class="max-w-7xl mx-auto px-6 text-center">
      <h3 class="text-3xl font-bold mb-6 text-gray-900">Featured Products</h3>
      <p class="text-gray-600 mb-12">Hand-picked styles and fragrances just for you!</p>
      <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @foreach ([
          ['Smart Watch','https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f',99.99],
          ['Headphones','https://images.unsplash.com/photo-1555617117-08fa0fdc9d6c',59.99],
          ['Sneakers','https://images.unsplash.com/photo-1593032465171-8b1e4a4e8d43',79.99],
          ['Luxury Perfume','https://images.unsplash.com/photo-1585386959984-a4155224a1ad',149.99]
        ] as [$title,$img,$price])
        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition">
          <img src="{{ $img }}?auto=format&fit=crop&w=500&q=60" alt="{{ $title }}"
               class="w-full h-64 object-cover">
          <div class="p-4">
            <h4 class="font-semibold mb-2">{{ $title }}</h4>
            <p class="text-gray-900 font-bold">${{ number_format($price,2) }}</p>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="bg-[#0d0d0d] text-gray-300 py-10 mt-10">
    <div class="max-w-7xl mx-auto px-6 text-center">
      <h4 class="text-lg font-semibold mb-3 text-white">Follow Us</h4>
      <div class="flex justify-center space-x-6 mb-6">
        <a href="#" class="hover:text-white transition">Facebook</a>
        <a href="#" class="hover:text-white transition">Instagram</a>
        <a href="#" class="hover:text-white transition">Twitter</a>
      </div>
      <p class="text-sm">&copy; 2025 MyShop. All rights reserved.</p>
    </div>
  </footer>

</body>
</html>
