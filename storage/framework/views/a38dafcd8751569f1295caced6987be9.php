

<?php $__env->startSection('content'); ?>

<?php
  use Illuminate\Support\Str;
?>

<div class="container mx-auto px-6 py-10 flex gap-8">

  
  <aside class="w-1/4 bg-white p-5 rounded-xl shadow-lg h-fit">
    <h3 class="font-bold text-lg mb-4">Filter</h3>

    <form method="GET" action="">
      <label class="block mb-2 font-medium text-gray-700">Price Range</label>
      <div class="flex gap-2 mb-4">
        <input type="number" name="min_price" class="w-1/2 border rounded-lg p-2" placeholder="Min" value="<?php echo e(request('min_price')); ?>">
        <input type="number" name="max_price" class="w-1/2 border rounded-lg p-2" placeholder="Max" value="<?php echo e(request('max_price')); ?>">
      </div>

      <label class="flex items-center mb-4">
        <input type="checkbox" name="stock" value="1" <?php echo e(request('stock') ? 'checked' : ''); ?> class="mr-2">
        Only show in-stock
      </label>

      <button type="submit" class="bg-black text-white w-full py-2 rounded-lg hover:bg-gray-800">
        Apply Filters
      </button>
    </form>
  </aside>

  
  <main class="flex-1">
    <h1 class="text-3xl font-extrabold mb-6 text-gray-900">
      🔍 Results for "<?php echo e($query); ?>"
    </h1>

    <?php if($results->isEmpty()): ?>
      <div class="text-center text-gray-500 py-20">
        <p>No products found matching your search.</p>
      </div>
    <?php else: ?>
      <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition p-4">
            <a href="<?php echo e(route('shop.product', $product->id)); ?>">

              
              <?php
                $imagePath = $product->image;

                if (Str::startsWith($imagePath, ['http://', 'https://'])) {
                    // External URL (CDN or remote)
                    $finalImage = $imagePath;
                } elseif (Str::startsWith($imagePath, ['/storage/', 'storage/'])) {
                    // Already points to storage, clean slashes
                    $finalImage = asset(Str::replaceFirst('/storage/', 'storage/', $imagePath));
                } else {
                    // Plain filename or relative path
                    $finalImage = asset('storage/' . ltrim($imagePath, '/'));
                }
              ?>

              <img src="<?php echo e($finalImage); ?>" 
                   alt="<?php echo e($product->subcategory ?? $product->name); ?>" 
                   class="w-full h-64 object-cover rounded-lg mb-3">

              <h2 class="font-semibold text-lg truncate">
                <?php echo e($product->subcategory ?? $product->name); ?>

              </h2>
            </a>

            <p class="text-indigo-600 font-bold mt-1">
              $<?php echo e(number_format($product->price, 2)); ?>

            </p>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    <?php endif; ?>
  </main>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\eshop\resources\views/find/results.blade.php ENDPATH**/ ?>