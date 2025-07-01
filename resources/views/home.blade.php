<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <title>nirmaan</title>
</head>
<body class="scroll-smooth bg-white pt-20">

@if(session('showLogin'))
<script>
    window.onload = function () {
        showAuthForm('login');
    };
</script>
@endif


    @if (session('success'))
    <div id="flash-message" class="fixed inset-0 flex items-center justify-center z-50">
        <div class="bg-green-500 text-white text-xl font-semibold py-5 px-10 rounded-2xl shadow-2xl animate-bounce-in border border-white/30 backdrop-blur-lg glow-effect">
            ✅ {{ session('success') }}
        </div>
    </div>
    @endif
    

    
    @include('layouts.navbar')
    @include('layouts.auth-modal')
    @include('layouts.welcome-page')
    @include('layouts.about')
    @include('layouts.services')
    @include('layouts.contact')
    @include('layouts.footer')

    



    <script>
    setTimeout(() => {
        const msg = document.getElementById('flash-message');
        if (msg) {
            msg.classList.add('fade-out');
            setTimeout(() => msg.remove(), 600);
        }
    }, 3000);

    
</script>

<style>
    .animate-bounce-in {
        animation: bounceIn 0.6s ease forwards;
    }

    @keyframes bounceIn {
        0% {
            opacity: 0;
            transform: scale(0.6) translateY(-50px);
        }
        60% {
            transform: scale(1.05) translateY(10px);
        }
        80% {
            transform: scale(0.95) translateY(-5px);
        }
        100% {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    .glow-effect {
        box-shadow: 0 0 20px rgba(34, 197, 94, 0.6), 0 0 60px rgba(34, 197, 94, 0.3);
    }

    .fade-out {
        transition: opacity 0.6s ease;
        opacity: 0;
    }
</style>




</body>
</html>
