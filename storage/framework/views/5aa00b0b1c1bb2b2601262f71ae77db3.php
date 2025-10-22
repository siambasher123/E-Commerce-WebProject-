

<?php $__env->startSection('title', 'Contact Us - MyShop'); ?>

<?php $__env->startPush('styles'); ?>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
  body {
    font-family: 'Inter', sans-serif;
    background-color: #f9f7f3;
  }

  .contact-wrapper {
    background-color: #fdf8f3;
  }

  .info-heading {
    font-weight: 700;
    font-size: 1rem;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    color: #111;
  }

  .form-container {
    background-color: #fffaf4;
    padding: 2.5rem;
    border-radius: 1rem;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .form-container:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.12);
  }

  .form-control {
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 12px 14px;
    font-size: 15px;
    color: #111;
    transition: border-color 0.2s ease;
  }

  .form-control:focus {
    border-color: #000;
    box-shadow: none;
  }

  .btn-submit {
    background-color: #000;
    color: #fff;
    font-weight: 600;
    border: none;
    border-radius: 8px;
    padding: 12px 32px;
    transition: all 0.3s ease;
  }

  .btn-submit:hover {
    background-color: #333;
    transform: translateY(-2px);
  }

  .fade-in {
    animation: fadeIn 0.8s ease-in-out;
  }

  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
  }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<!-- ✅ SUCCESS MESSAGE -->

<section class="contact-wrapper py-20 fade-in">
  <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-10 items-start">

    <!-- LEFT SIDE INFO -->
    <div>
      <h2 class="text-3xl font-bold text-gray-900 mb-8">We’re Ready To Help You!</h2>
      <div class="space-y-4 text-gray-700">
        <div>
          <h3 class="info-heading">General Inquiries</h3>
          <p>support@myshop.com</p>
        </div>
        <div>
          <h3 class="info-heading">Wholesale</h3>
          <p>wholesale@myshop.com</p>
        </div>
        <div>
          <h3 class="info-heading">Donations</h3>
          <p>donations@myshop.com</p>
        </div>
        <div>
          <h3 class="info-heading">Main Office</h3>
          <p>(831) 555-1212</p>
          <p class="text-sm text-gray-500">Mon–Fri, 9:00am – 5:00pm PST</p>
        </div>
        <div>
          <h3 class="info-heading">Address</h3>
          <p>104 Bronson Street, Suite 19<br>Santa Cruz, CA 95062</p>
        </div>
      </div>
    </div>

    <!-- RIGHT SIDE FORM -->
    <div class="form-container">
      <h3 class="text-2xl font-semibold text-gray-900 mb-6">Talk With Us.</h3>

      <form action="<?php echo e(route('contact.store')); ?>" method="POST" class="space-y-6">
        <?php echo csrf_field(); ?>

        <div class="grid md:grid-cols-2 gap-6">
          <div>
            <label for="first_name" class="block text-sm font-semibold text-gray-800 mb-2">
              First Name <span class="text-red-500">*</span>
            </label>
            <input type="text" name="first_name" id="first_name" value="<?php echo e(old('first_name')); ?>"
              class="form-control" placeholder="Enter your first name" required>
            <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>

          <div>
            <label for="last_name" class="block text-sm font-semibold text-gray-800 mb-2">
              Last Name <span class="text-red-500">*</span>
            </label>
            <input type="text" name="last_name" id="last_name" value="<?php echo e(old('last_name')); ?>"
              class="form-control" placeholder="Enter your last name" required>
            <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>
        </div>

        <div>
          <label for="email" class="block text-sm font-semibold text-gray-800 mb-2">
            Email <span class="text-red-500">*</span>
          </label>
          <input type="email" name="email" id="email" value="<?php echo e(old('email')); ?>"
            class="form-control" placeholder="Enter your email" required>
          <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div>
          <label for="contact_number" class="block text-sm font-semibold text-gray-800 mb-2">
            Contact Number <span class="text-red-500">*</span>
          </label>
          <input type="text" name="contact_number" id="contact_number" value="<?php echo e(old('contact_number')); ?>"
            class="form-control" placeholder="Enter your contact number" required>
          <?php $__errorArgs = ['contact_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div>
          <label for="message" class="block text-sm font-semibold text-gray-800 mb-2">
            Message <span class="text-red-500">*</span>
          </label>
          <textarea name="message" id="message" rows="5" placeholder="Write your message..."
            class="form-control resize-none" required><?php echo e(old('message')); ?></textarea>
          <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <button type="submit" class="btn-submit w-full md:w-auto">Submit</button>
      </form>
    </div>
  </div>
</section>

<!-- FOOTER -->
<footer class="bg-[#0d0d0d] text-gray-300 py-10">
  <div class="max-w-6xl mx-auto text-center">
    <p class="text-sm">&copy; 2025 <span class="font-semibold text-white">MyShop</span>. All rights reserved.</p>
  </div>
</footer>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const alert = document.getElementById('contact-success');
    const redirectText = document.getElementById('redirect-text');

    if (alert) {
      // Step 1: show “Redirecting…” text after 2s
      setTimeout(() => redirectText.style.opacity = "1", 2000);

      // Step 2: fade out alert
      setTimeout(() => {
        alert.style.transition = "opacity 0.8s ease, transform 0.8s ease";
        alert.style.opacity = "0";
        alert.style.transform = "translateY(-10px)";
      }, 3000);

      // Step 3: fade whole page & redirect
      setTimeout(() => {
        document.body.style.transition = "opacity 0.6s ease";
        document.body.style.opacity = "0";
        setTimeout(() => {
          window.location.href = "<?php echo e(route('home')); ?>";
        }, 600);
      }, 3800);
    }
  });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\eshop\resources\views/contact.blade.php ENDPATH**/ ?>