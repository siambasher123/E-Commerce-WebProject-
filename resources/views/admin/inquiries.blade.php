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
  @include('admin.sidebar')

  <!-- ✅ Main Content -->
  <main class="ml-64 p-10 flex-1 animate-fadeInUp">
    <div class="flex items-center justify-between mb-8">
      <h1 class="text-3xl font-bold text-gray-900">📨 Contact Requests</h1>
      <span class="text-sm text-gray-500">
        Total Requests: <b>{{ count($inquiries) }}</b>
      </span>
    </div>

    @if(session('success'))
      <div class="alert alert-success text-center fade show" role="alert">
        {{ session('success') }}
      </div>
    @endif

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
          @foreach($inquiries as $inq)
          <tr class="hover:bg-gray-50 transition">
            <td>{{ $inq->id }}</td>
            <td>{{ $inq->first_name }} {{ $inq->last_name }}</td>
            <td>{{ $inq->email }}</td>
            <td>{{ $inq->contact_number }}</td>
            <td>
              <button class="text-blue-600 hover:underline" data-bs-toggle="modal" data-bs-target="#viewMessage{{ $inq->id }}">
                {{ Str::limit($inq->message, 40) }}
              </button>
            </td>
            <td class="text-gray-600 text-sm">
              {{ $inq->created_at->format('d M, Y h:i A') }}
            </td>

            <td class="text-center">
              @if($inq->replied)
                <span class="px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-700">
                  ✅ Replied
                </span>
              @else
                <span class="px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-700">
                  ⏳ Pending
                </span>
              @endif
            </td>

            <td class="text-center">
              @if(!$inq->replied)
                <button 
                  onclick="openReplyModal({{ $inq->id }}, '{{ $inq->email }}')" 
                  class="bg-indigo-600 text-white px-4 py-1.5 rounded-lg hover:bg-indigo-700 transition text-sm">
                  Reply
                </button>
              @else
                <button disabled class="bg-gray-300 text-gray-600 px-4 py-1.5 rounded-lg cursor-not-allowed">
                  Reply Sent
                </button>
              @endif
            </td>
          </tr>

          <!-- 🔍 View Full Message Modal -->
          <div class="modal fade" id="viewMessage{{ $inq->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content rounded-3xl shadow-lg">
                <div class="modal-header bg-gray-100 border-0">
                  <h5 class="modal-title font-semibold text-gray-800">💬 Message from {{ $inq->first_name }}</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-gray-700">
                  <p>{{ $inq->message }}</p>
                </div>
                <div class="modal-footer border-0">
                  <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
          @endforeach
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
        @csrf
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

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

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

  // ✅ AJAX Form Submission
  replyForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const id = replyForm.getAttribute('data-id');
    const formData = new FormData(replyForm);

    sendBtn.disabled = true;
    sendBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Sending...';

    try {
      const response = await fetch(`/admin/inquiries/reply/${id}`, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value },
        body: formData
      });

      if (response.ok) {
        // ✅ Update badge & button instantly
        const row = document.querySelector(`button[onclick*="${id}"]`).closest('tr');
        const statusCell = row.querySelector('td:nth-child(7)');
        const actionCell = row.querySelector('td:nth-child(8)');

        statusCell.innerHTML = `
          <span class="px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-700">
            ✅ Replied
          </span>`;

        actionCell.innerHTML = `
          <button disabled class="bg-green-600 text-white px-4 py-1.5 rounded-lg">
            Replied
          </button>`;

        // ✅ Show success message
        showMessage('✅ Reply sent successfully!', 'green');

        closeReplyModal();
      } else {
        showMessage('❌ Failed to send reply.', 'red');
      }
    } catch (error) {
      showMessage('⚠️ Server error. Try again later.', 'red');
      console.error(error);
    } finally {
      sendBtn.disabled = false;
      sendBtn.innerHTML = 'Send Reply';
    }
  });

  // ✅ Function to show auto-disappearing message
  function showMessage(text, color = 'green') {
    const msg = document.createElement('div');
    msg.className = `
      fixed top-6 right-6 z-50 px-5 py-3 rounded-lg text-white shadow-lg font-medium animate-fadeInUp
      ${color === 'green' ? 'bg-green-600' : 'bg-red-600'}
    `;
    msg.textContent = text;
    document.body.appendChild(msg);

    // Vanish smoothly after 3s
    setTimeout(() => {
      msg.style.transition = 'opacity 0.5s ease';
      msg.style.opacity = '0';
      setTimeout(() => msg.remove(), 500);
    }, 3000);
  }
</script>

</body>
</html>
