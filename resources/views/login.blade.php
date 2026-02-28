<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EasyColoc | Auth</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; overflow-x: hidden; }
        
        /* Animated Background */
        .bg-mesh {
            background-color: #f8fafc;
            background-image: 
                radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.15) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(129, 140, 248, 0.15) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(199, 210, 254, 0.15) 0px, transparent 50%),
                radial-gradient(at 0% 100%, rgba(165, 180, 252, 0.15) 0px, transparent 50%);
        }

        .blob {
            position: absolute;
            width: 500px;
            height: 500px;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.2) 0%, rgba(168, 85, 247, 0.2) 100%);
            filter: blur(80px);
            border-radius: 50%;
            z-index: -1;
            animation: float 20s infinite alternate;
        }

        @keyframes float {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(100px, 50px) scale(1.1); }
        }

        .gradient-bg {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            position: relative;
            overflow: hidden;
        }

        /* Glass effect for the side card */
        .gradient-bg::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle at center, rgba(255,255,255,0.1) 0%, transparent 40%);
            animation: rotate 30s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .input-focus { transition: all 0.3s ease; }
        .input-focus:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(79, 70, 229, 0.15);
        }
    </style>
</head>
<body class="bg-mesh min-h-screen flex items-center justify-center p-4 sm:p-6 lg:p-8 relative">

    <div class="blob" style="top: -100px; left: -100px; animation-delay: 0s;"></div>
    <div class="blob" style="bottom: -100px; right: -100px; animation-delay: -5s; background: linear-gradient(135deg, rgba(59, 130, 246, 0.2) 0%, rgba(147, 51, 234, 0.2) 100%);"></div>

    <div class="relative z-10 w-full max-w-[1050px] flex flex-col lg:flex-row shadow-[0_32px_64px_-15px_rgba(0,0,0,0.1)] rounded-[40px] overflow-hidden bg-white/80 backdrop-blur-xl border border-white/20">
        
        <div class="lg:w-[42%] gradient-bg p-12 text-white flex flex-col justify-between relative">
            <div class="relative z-10">
                <div class="flex items-center space-x-3 mb-16">
                    <div class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center border border-white/30 shadow-xl">
                        <span class="text-white font-bold text-2xl">E</span>
                    </div>
                    <span class="text-2xl font-bold tracking-tight">EasyColoc.</span>
                </div>
                
                <h1 id="side-title" class="text-4xl lg:text-5xl font-bold leading-tight mb-6">Gérez votre coloc en toute sérénité.</h1>
                <p id="side-desc" class="text-indigo-100 text-lg leading-relaxed font-light">L'outil indispensable pour harmoniser votre vie à plusieurs.</p>
            </div>

            <div class="relative z-10 mt-12 p-6 bg-white/10 backdrop-blur-lg rounded-3xl border border-white/10">
                <div class="flex -space-x-3 mb-4">
                    <img class="w-10 h-10 rounded-full border-2 border-indigo-400" src="https://ui-avatars.com/api/?name=Amine&background=6366f1&color=fff" alt="">
                    <img class="w-10 h-10 rounded-full border-2 border-indigo-400" src="https://ui-avatars.com/api/?name=Sara&background=a855f7&color=fff" alt="">
                    <img class="w-10 h-10 rounded-full border-2 border-indigo-400" src="https://ui-avatars.com/api/?name=Yassine&background=3b82f6&color=fff" alt="">
                </div>
                <p class="text-sm text-indigo-50/80 italic">"La gestion des charges est devenue un jeu d'enfant !"</p>
            </div>
        </div>

        <div class="lg:w-[58%] p-8 sm:p-12 lg:p-16 bg-white relative">
            
            <div class="inline-flex p-1.5 bg-gray-100/80 rounded-[20px] mb-12">
                <button id="btn-login" onclick="toggleForm('login')" class="px-8 py-2.5 rounded-[14px] text-sm font-bold transition-all bg-white shadow-md text-indigo-600">Connexion</button>
                <button id="btn-signup" onclick="toggleForm('signup')" class="px-8 py-2.5 rounded-[14px] text-sm font-bold transition-all text-gray-500 hover:text-gray-700">Inscription</button>
            </div>

            <div class="relative overflow-hidden">
                <div id="login-form" class="space-y-6 transition-all duration-500 opacity-100 transform translate-x-0">
                    <div class="mb-8">
                        <h2 class="text-3xl font-bold text-gray-900">Welcome Back</h2>
                        <p class="text-gray-500">Heureux de vous revoir parmi nous.</p>
                    </div>
                    <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
                        @csrf
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-gray-700 ml-1">Email</label>
                            <input type="email" name="email" required class="input-focus w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-[20px] focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500" placeholder="votre@email.com">
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-gray-700 ml-1">Mot de passe</label>
                            <input type="password" name="password" required class="input-focus w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-[20px] focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500" placeholder="••••••••">
                        </div>
                        <button type="submit" class="w-full py-4 bg-indigo-600 text-white rounded-[20px] font-bold text-lg shadow-[0_20px_40px_-10px_rgba(79,70,229,0.3)] hover:bg-indigo-700 active:scale-[0.98] transition-all duration-300">
                            Se connecter
                        </button>
                    </form>
                </div>

                <div id="signup-form" class="hidden space-y-6 transition-all duration-500 opacity-0 transform translate-x-8">
                    <div class="mb-8">
                        <h2 class="text-3xl font-bold text-gray-900">Rejoignez-nous</h2>
                        <p class="text-gray-500">Commencez l'expérience EasyColoc aujourd'hui.</p>
                    </div>
                    <form action="{{ route('register.post') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <input type="text" name="firstname" placeholder="Prénom" required class="input-focus w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-[20px] focus:outline-none focus:ring-4 focus:ring-indigo-500/10">
                            <input type="text" name="lastname" placeholder="Nom" required class="input-focus w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-[20px] focus:outline-none focus:ring-4 focus:ring-indigo-500/10">
                        </div>
                        <input type="email" name="email" placeholder="Email" required class="input-focus w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-[20px] focus:outline-none focus:ring-4 focus:ring-indigo-500/10">
                        <input type="password" name="password" placeholder="Mot de passe" required class="input-focus w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-[20px] focus:outline-none focus:ring-4 focus:ring-indigo-500/10">
                        @if(session('error'))
                            <div class="text-red-500 text-sm font-medium">{{ session('error') }}</div>
                        @endif
                        <button type="submit" class="w-full py-4 bg-indigo-600 text-white rounded-[20px] font-bold text-lg shadow-[0_20px_40px_-10px_rgba(79,70,229,0.3)] hover:bg-indigo-700 transition-all duration-300">
                            Créer mon compte
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleForm(mode) {
            const loginF = document.getElementById('login-form');
            const signupF = document.getElementById('signup-form');
            const btnLogin = document.getElementById('btn-login');
            const btnSignup = document.getElementById('btn-signup');
            const sideTitle = document.getElementById('side-title');

            if (mode === 'signup') {
                loginF.classList.add('hidden', 'opacity-0', '-translate-x-8');
                signupF.classList.remove('hidden');
                setTimeout(() => {
                    signupF.classList.remove('opacity-0', 'translate-x-8');
                    signupF.classList.add('opacity-100', 'translate-x-0');
                }, 50);
                btnSignup.classList.add('bg-white', 'shadow-md', 'text-indigo-600');
                btnLogin.classList.remove('bg-white', 'shadow-md', 'text-indigo-600');
                sideTitle.innerText = "La colocation, enfin simplifiée.";
            } else {
                signupF.classList.add('hidden', 'opacity-0', 'translate-x-8');
                loginF.classList.remove('hidden');
                setTimeout(() => {
                    loginF.classList.remove('opacity-0', '-translate-x-8');
                    loginF.classList.add('opacity-100', 'translate-x-0');
                }, 50);
                btnLogin.classList.add('bg-white', 'shadow-md', 'text-indigo-600');
                btnSignup.classList.remove('bg-white', 'shadow-md', 'text-indigo-600');
                sideTitle.innerText = "Gérez votre coloc en toute sérénité.";
            }
        }
    </script>
</body>
</html>