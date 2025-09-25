<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PSB DEMO</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">

  <div class="w-full max-w-6xl bg-white shadow-2xl rounded-2xl flex overflow-hidden">
    <!-- Left Section with Logo -->
    <div class="w-1/2 bg-gradient-to-br from-green-600 to-green-800 flex items-center justify-center p-12">
      <div class="flex items-center justify-center">
        <img src="https://demo.pmb.smartpayment.co.id/images/bg-logo.png" 
             alt="PSB Demo Logo" 
             class="max-w-full max-h-96 object-contain"
             onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
        <!-- Fallback illustration if image fails to load -->
        <div class="hidden">
          <div class="relative">
            <!-- Stack of Books -->
            <div class="relative">
              <div class="w-48 h-8 bg-yellow-400 rounded-sm mb-1 shadow-lg transform -rotate-1"></div>
              <div class="w-52 h-8 bg-pink-500 rounded-sm mb-1 shadow-lg transform rotate-1"></div>
              <div class="w-50 h-8 bg-blue-500 rounded-sm mb-1 shadow-lg transform -rotate-2"></div>
              <div class="w-48 h-8 bg-orange-400 rounded-sm mb-1 shadow-lg transform rotate-2"></div>
              <div class="w-46 h-8 bg-purple-500 rounded-sm shadow-lg transform -rotate-1"></div>
            </div>
            
            <!-- Graduation Cap -->
            <div class="absolute -top-16 left-1/2 transform -translate-x-1/2">
              <div class="w-16 h-16 bg-blue-900 rounded-full relative">
                <div class="absolute -top-2 -left-6 w-28 h-4 bg-blue-900 rounded-lg transform -rotate-12"></div>
                <div class="absolute -top-8 right-2 w-1 h-12 bg-yellow-400"></div>
                <div class="absolute -top-8 right-0 w-3 h-3 bg-yellow-400 transform rotate-45"></div>
              </div>
            </div>
            
            <!-- Magnifying Glass -->
            <div class="absolute -right-8 top-4">
              <div class="w-12 h-12 border-4 border-gray-600 rounded-full bg-transparent"></div>
              <div class="w-6 h-1 bg-gray-600 transform rotate-45 translate-x-10 translate-y-2"></div>
            </div>
            
            <!-- Decorative elements -->
            <div class="absolute -top-4 -left-16">
              <div class="w-8 h-8 relative">
                <div class="w-2 h-2 bg-yellow-400 rounded-full absolute top-3 left-3"></div>
                <div class="w-8 h-1 border border-yellow-400 rounded-full absolute top-3.5 transform rotate-45"></div>
                <div class="w-8 h-1 border border-yellow-400 rounded-full absolute top-3.5 transform -rotate-45"></div>
              </div>
            </div>
            
            <!-- Globe -->
            <div class="absolute right-4 bottom-4">
              <div class="w-10 h-10 border-2 border-teal-400 rounded-full relative">
                <div class="absolute inset-1 border border-teal-400 rounded-full"></div>
                <div class="absolute top-2 left-2 w-6 h-1 border-t border-teal-400"></div>
                <div class="absolute top-4 left-1 w-8 h-1 border-t border-teal-400"></div>
                <div class="absolute top-6 left-2 w-6 h-1 border-t border-teal-400"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Right Section -->
    <div class="w-1/2 p-12 flex flex-col justify-center bg-gray-50">
      <div class="max-w-md mx-auto w-full">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-2">DEMO PSB</h1>
        <p class="text-center text-gray-400 mb-8 text-sm font-medium tracking-wider">FORM LOGIN</p>
        
        <form class="space-y-6" method="POST" action="{{ route('login') }}">
          @csrf
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Username</label>
            <input type="text" name="username" required
              class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all">
          </div>
          <div class="relative">
            <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
            <input type="password" name="password" id="password" required
              class="w-full border border-gray-300 rounded-lg px-4 py-3 pr-12 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all">
            <button type="button" id="togglePassword" class="absolute right-3 top-11 text-gray-500 hover:text-gray-700 focus:outline-none">
              <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
              </svg>
              <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21" />
              </svg>
            </button>
          </div>
          <button type="submit"
            class="w-full bg-green-700 text-white py-3 px-6 rounded-lg hover:bg-green-800 transition-all duration-200 font-medium text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
            Log In
          </button>
        </form>

        <div class="mt-8 text-center">
          <p class="text-gray-400 text-sm mb-6">— or Another Links —</p>

          <div class="flex justify-center space-x-4">
            <!-- Home Icon (Blue) -->
            <a href="{{url('/')}}" class="w-12 h-12 flex items-center justify-center rounded-full bg-blue-600 hover:bg-blue-700 text-white transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-110">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
              </svg>
            </a>
            
            <!-- Pencil/Edit Icon (Light Blue) -->
            <a href="{{url('/enroll')}}" class="w-12 h-12 flex items-center justify-center rounded-full bg-sky-400 hover:bg-sky-500 text-white transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-110">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
              </svg>
            </a>
            
            <!-- Credit Card Icon (Red) -->
            <a href="#" class="w-12 h-12 flex items-center justify-center rounded-full bg-red-500 hover:bg-red-600 text-white transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-110">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z"/>
              </svg>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('need_payment'))
<script>
    document.addEventListener("DOMContentLoaded", function () {
        Swal.fire({
            icon: 'warning',
            title: 'Belum Bayar',
            text: 'Anda belum melakukan pembayaran registrasi.',
            confirmButtonText: 'Lihat Detail',
            confirmButtonColor: '#3085d6'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ session('redirect_link') }}";
            }
        });
    });
</script>
@endif


@if(session('login_error'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  Swal.fire({
    icon: 'error',
    title: 'Login Gagal',
    text: "{{ session('login_error') }}",
    confirmButtonColor: '#d33',
    confirmButtonText: 'OK'
  })
</script>
@endif

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const passwordInput = document.getElementById('password');
      const togglePassword = document.getElementById('togglePassword');
      const eyeOpen = document.getElementById('eyeOpen');
      const eyeClosed = document.getElementById('eyeClosed');

      if (passwordInput && togglePassword && eyeOpen && eyeClosed) {
        togglePassword.addEventListener('click', function(e) {
          e.preventDefault();
          
          const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
          passwordInput.setAttribute('type', type);
          
          if (type === 'text') {
            eyeOpen.classList.add('hidden');
            eyeClosed.classList.remove('hidden');
          } else {
            eyeOpen.classList.remove('hidden');
            eyeClosed.classList.add('hidden');
          }
        });
      }
    });
  </script>

</body>
</html>