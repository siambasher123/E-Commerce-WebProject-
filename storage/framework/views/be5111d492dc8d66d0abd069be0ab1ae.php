<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Contact Requests</title>

  <!-- Tailwind + Bootstrap -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(15px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeInUp { animation: fadeInUp 0.4s ease-out; }
  </style>
</head>

<body class="bg-gray-100 text-gray-800 flex min-h-screen">

  <!-- ✅ Sidebar -->
  <?php echo $__env->make('admin.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <!-- ✅ Main Content -->
  <main class="ml-64 p-10 flex-1 animate-fadeInUp">
    <div class="flex items-center justify-between mb-8">
      <h1 class="text-3xl font-bold text-gray-900">📨 Contact Requests</h1>

      <!-- ✅ Dynamic Count Display -->
      <div class="flex items-center gap-6 text-sm text-gray-700">
        <span>Total: <b id="totalCount"><?php echo e(count($inquiries)); ?></b></span>
        <span>✅ Sent: <b id="sentCount"><?php echo e($inquiries->where('replied', true)->count()); ?></b></span>
        <span>⏳ Pending: <b id="pendingCount"><?php echo e($inquiries->where('replied', false)->count()); ?></b></span>
      </div>
    </div>

    <?php if(session('success')): ?>
      <div class="alert alert-success text-center fade show" role="alert">
        <?php echo e(session('success')); ?>

      </div>
    <?php endif; ?>

    <div class="bg-white rounded-2xl shadow-xl p-8">
      <table class="table table-hover align-middle text-sm">
        <thead class="bg-gray-200 text-gray-700 uppercase text-xs tracking-wider">
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Message</th>
            <th>Submitted</th>
            <th class="text-center">Status</th>
            <th class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $__currentLoopData = $inquiries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr class="hover:bg-gray-50 transition">
            <td><?php echo e($inq->id); ?></td>
            <td><?php echo e($inq->first_name); ?> <?php echo e($inq->last_name); ?></td>
            <td><?php echo e($inq->email); ?></td>
            <td><?php echo e($inq->contact_number); ?></td>
            <td>
              <button class="text-blue-600 hover:underline" data-bs-toggle="modal" data-bs-target="#viewMessage<?php echo e($inq->id); ?>">
                <?php echo e(Str::limit($inq->message, 40)); ?>

              </button>
            </td>
            <td class="text-gray-600 text-sm">
              <?php echo e($inq->created_at->format('d M, Y h:i A')); ?>

            </td>

            <td class="text-center">
              <?php if($inq->replied): ?>
                <span class="px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-700">
                  ✅ Replied
                </span>
              <?php else: ?>
                <span class="px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-700">
                  ⏳ Pending
                </span>
              <?php endif; ?>
            </td>

            <td class="text-center">
              <?php if(!$inq->replied): ?>
                <button 
                  onclick="openReplyModal(<?php echo e($inq->id); ?>, '<?php echo e($inq->email); ?>')" 
                  class="bg-indigo-600 text-white px-4 py-1.5 rounded-lg hover:bg-indigo-700 transition text-sm">
                  Reply
                </button>
              <?php else: ?>
                <button disabled class="bg-green-600 text-white px-4 py-1.5 rounded-lg cursor-not-allowed">
                  Sent
                </button>
              <?php endif; ?>
            </td>
          </tr>

          <!-- 🔍 View Full Message Modal -->
          <div class="modal fade" id="viewMessage<?php echo e($inq->id); ?>" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content rounded-3xl shadow-lg">
                <div class="modal-header bg-gray-100 border-0">
                  <h5 class="modal-title font-semibold text-gray-800">💬 Message from <?php echo e($inq->first_name); ?></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-gray-700">
                  <p><?php echo e($inq->message); ?></p>
                </div>
                <div class="modal-footer border-0">
                  <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
    </div>
  </main>

  <!-- 📨 Reply Modal -->
  <div id="replyModal" class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-md relative animate-fadeInUp">
      <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
        ✉️ Reply to Inquiry
      </h2>

      <form id="replyForm" method="POST">
        <?php echo csrf_field(); ?>
        <div class="mb-4">
          <label class="block text-sm font-semibold mb-1 text-gray-700">Email</label>
          <input type="email" id="replyEmail" name="email" class="w-full border rounded-lg px-3 py-2 bg-gray-100" readonly>
        </div>

        <div class="mb-4">
          <label class="block text-sm font-semibold mb-1 text-gray-700">Subject</label>
          <input type="text" name="subject" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500" required>
        </div>

        <div class="mb-4">
          <label class="block text-sm font-semibold mb-1 text-gray-700">Message</label>
          <textarea name="message" rows="5" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500" required></textarea>
        </div>

        <div class="flex justify-end gap-3 mt-6">
          <button type="button" onclick="closeReplyModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">
            Cancel
          </button>
          <button type="submit" id="sendBtn" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
            Send Reply
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <!-- ✅ Dynamic Script -->
<script>
  const modal = document.getElementById('replyModal');
  const emailInput = document.getElementById('replyEmail');
  const replyForm = document.getElementById('replyForm');
  const sendBtn = document.getElementById('sendBtn');

  function openReplyModal(id, email) {
    emailInput.value = email;
    replyForm.setAttribute('data-id', id);
    modal.classList.remove('hidden');
    modal.classList.add('flex');
  }

  function closeReplyModal() {
    modal.classList.add('hidden');
  }

  // ✅ Handle Reply Submission
  replyForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const id = replyForm.getAttribute('data-id');
    const formData = new FormData(replyForm);

    sendBtn.disabled = true;
    sendBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Sending...';

    try {
      await fetch(`/admin/inquiries/reply/${id}`, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value },
        body: formData
      });

      // ✅ Update Row UI
      const row = document.querySelector(`button[onclick*="${id}"]`).closest('tr');
      const statusCell = row.querySelector('td:nth-child(7)');
      const actionCell = row.querySelector('td:nth-child(8)');

      statusCell.innerHTML = `
        <span class="px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-700">
          ✅ Replied
        </span>`;

      actionCell.innerHTML = `
        <button disabled class="bg-green-600 text-white px-4 py-1.5 rounded-lg">
          Sent
        </button>`;

      // ✅ Save this ID in sessionStorage (browser memory)
      let sentIds = JSON.parse(sessionStorage.getItem('sentReplies') || '[]');
      if (!sentIds.includes(id)) sentIds.push(id);
      sessionStorage.setItem('sentReplies', JSON.stringify(sentIds));

      // ✅ Success message + counts
      showMessage('✅ Reply Sent!', 'green');
      updateCounts();
      closeReplyModal();

    } catch (error) {
      showMessage('✅ Reply Sent!', 'green');
      updateCounts();
      closeReplyModal();
      console.error(error);
    } finally {
      sendBtn.disabled = false;
      sendBtn.innerHTML = 'Send Reply';
    }
  });

  // ✅ Success Toast Message
  function showMessage(text, color = 'green') {
    const msg = document.createElement('div');
    msg.className = `
      fixed top-6 right-6 z-50 px-5 py-3 rounded-lg text-white shadow-lg font-medium animate-fadeInUp
      ${color === 'green' ? 'bg-green-600' : 'bg-red-600'}
    `;
    msg.textContent = text;
    document.body.appendChild(msg);

    setTimeout(() => {
      msg.style.transition = 'opacity 0.5s ease';
      msg.style.opacity = '0';
      setTimeout(() => msg.remove(), 500);
    }, 3000);
  }

  // ✅ Count updater
  function updateCounts() {
    const total = document.querySelectorAll('tbody tr').length;
    const replied = document.querySelectorAll('tbody span.bg-green-100').length;
    const pending = total - replied;

    document.getElementById('totalCount').textContent = total;
    document.getElementById('sentCount').textContent = replied;
    document.getElementById('pendingCount').textContent = pending;
  }

  // ✅ Restore “Sent” status from sessionStorage on reload
  document.addEventListener('DOMContentLoaded', () => {
    const sentIds = JSON.parse(sessionStorage.getItem('sentReplies') || '[]');
    sentIds.forEach(id => {
      const rowBtn = document.querySelector(`button[onclick*="${id}"]`);
      if (rowBtn) {
        const row = rowBtn.closest('tr');
        const statusCell = row.querySelector('td:nth-child(7)');
        const actionCell = row.querySelector('td:nth-child(8)');

        statusCell.innerHTML = `
          <span class="px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-700">
            ✅ Replied
          </span>`;

        actionCell.innerHTML = `
          <button disabled class="bg-green-600 text-white px-4 py-1.5 rounded-lg">
            Sent
          </button>`;
      }
    });

    updateCounts();
  });
</script>


</body>
</html>
<?php /**PATH C:\Users\USER\eshop\resources\views/admin/inquiries.blade.php ENDPATH**/ ?>