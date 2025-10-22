

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-6 py-10">
  <div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Search results</h1>
    <p class="text-gray-600 mt-1">
      Query: <span class="font-medium">"<?php echo e($q); ?>"</span>
    </p>
    <?php if(!empty($filters)): ?>
      <div class="mt-3 flex flex-wrap gap-2">
        <?php $__currentLoopData = ['category','subcategory']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php if(!empty($filters[$key])): ?>
            <span class="px-3 py-1 rounded-full text-xs bg-gray-100 text-gray-800 border"><?php echo e(ucfirst($key)); ?>: <?php echo e($filters[$key]); ?></span>
          <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if(!is_null($filters['min_price'])): ?> <span class="px-3 py-1 rounded-full text-xs bg-gray-100 text-gray-800 border">Min: $<?php echo e(number_format($filters['min_price'],2)); ?></span> <?php endif; ?>
        <?php if(!is_null($filters['max_price'])): ?> <span class="px-3 py-1 rounded-full text-xs bg-gray-100 text-gray-800 border">Max: $<?php echo e(number_format($filters['max_price'],2)); ?></span> <?php endif; ?>
        <?php if(!is_null($filters['in_stock'])): ?>  <span class="px-3 py-1 rounded-full text-xs bg-gray-100 text-gray-800 border"><?php echo e($filters['in_stock'] ? 'In Stock' : 'Any Stock'); ?></span> <?php endif; ?>
        <?php if(!empty($filters['keywords'])): ?>
          <?php $__currentLoopData = $filters['keywords']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <span class="px-3 py-1 rounded-full text-xs bg-gray-100 text-gray-800 border">#<?php echo e($kw); ?></span>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </div>

  <?php if($products->isEmpty()): ?>
    <div class="bg-white rounded-2xl shadow p-10 text-center text-gray-500">
      No matching products found.
    </div>
  <?php else: ?>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-7">
      <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(route('shop.product', $p->id)); ?>" class="bg-white rounded-2xl shadow hover:shadow-2xl overflow-hidden group transition">
          <div class="relative">
            <img src="<?php echo e(asset('storage/'.$p->image)); ?>" alt="<?php echo e($p->subcategory); ?>"
                 class="w-full h-64 object-cover group-hover:scale-[1.02] transition">
            <span class="absolute top-2 left-2 bg-black/80 text-white text-[11px] px-2 py-1 rounded"><?php echo e($p->category); ?></span>
          </div>
          <div class="p-4">
            <h3 class="font-semibold text-gray-900 truncate"><?php echo e($p->subcategory); ?></h3>
            <p class="text-sm text-gray-500 truncate mt-1"><?php echo e(\Illuminate\Support\Str::limit($p->description, 60)); ?></p>

            <div class="mt-3 flex items-baseline gap-2">
              <?php if($p->old_price && $p->old_price > $p->price): ?>
                <span class="text-gray-400 line-through">$<?php echo e(number_format($p->old_price, 2)); ?></span>
              <?php endif; ?>
              <span class="text-[17px] font-bold text-gray-900">$<?php echo e(number_format($p->price, 2)); ?></span>
            </div>

            <div class="mt-2 text-xs <?php echo e($p->stock > 0 ? 'text-emerald-600' : 'text-rose-600'); ?>">
              <?php echo e($p->stock > 0 ? 'In Stock' : 'Out of Stock'); ?>

            </div>
          </div>
        </a>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="mt-8">
      <?php echo e($products->links()); ?>

    </div>
  <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\eshop\resources\views/client/shop/search.blade.php ENDPATH**/ ?>