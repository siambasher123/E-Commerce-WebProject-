<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>MyShop</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800">
  <?php echo $__env->make('partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <main><?php echo $__env->yieldContent('content'); ?></main>
</body>

</html>
<?php /**PATH C:\Users\USER\eshop\resources\views/layouts/app.blade.php ENDPATH**/ ?>