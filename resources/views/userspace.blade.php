<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyColoc | Tableau de bord</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #f8fafc; }
        .glass { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.3); }
        .modal-active { overflow: hidden; }
        .sidebar-item-active { background: #eef2ff; color: #4f46e5; border-radius: 16px; }
    </style>
</head>
<body class="min-h-screen flex text-gray-800">

    <aside class="w-72 bg-white border-r border-gray-100 hidden lg:flex flex-col p-6 sticky top-0 h-screen">
        <div class="flex items-center space-x-3 mb-10 px-2">
            <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-200">
                <span class="text-white font-bold text-xl">E</span>
            </div>
            <span class="text-2xl font-bold tracking-tight text-gray-900">EasyColoc<span class="text-indigo-600">.</span></span>
        </div>

        <nav class="space-y-1 flex-1">
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[2px] mb-4 ml-2">Menu Principal</p>
            <a href="#" class="flex items-center space-x-3 p-4 sidebar-item-active font-semibold">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <span>Dashboard</span>
            </a>
            
            <button onclick="toggleModal('modalColoc')" class="w-full flex items-center space-x-3 p-4 text-gray-500 hover:bg-gray-50 rounded-2xl transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <span>Créer Coloc</span>
            </button>
        </nav>

        <div class="mt-4 p-4 bg-indigo-50/50 rounded-[24px] border border-indigo-100/50">
            <p class="text-[10px] font-bold text-indigo-400 uppercase tracking-wider mb-3">Coloc Actuelle</p>
            <div class="flex items-center justify-between">
                <span class="font-bold text-gray-900 truncate">YouCode Students</span>
                <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
            </div>
            <div class="flex -space-x-2 mt-3">
                <img class="w-7 h-7 rounded-full border-2 border-white" src="https://ui-avatars.com/api/?name=User1">
                <img class="w-7 h-7 rounded-full border-2 border-white" src="https://ui-avatars.com/api/?name=User2">
                <div class="w-7 h-7 rounded-full border-2 border-white bg-indigo-500 text-[8px] flex items-center justify-center text-white font-bold">+2</div>
            </div>
        </div>

        <div class="mt-auto pt-6 border-t border-gray-100 flex items-center justify-between">
            @auth
              <div class="flex items-center space-x-3 overflow-hidden">
                <img src="https://ui-avatars.com/api/?name={{ auth()->user()->firstname . auth()->user()->lastname }}&background=6366f1&color=fff" class="w-10 h-10 rounded-full">
                <div class="truncate">
                    <p class="text-sm font-bold truncate">{{ auth()->user()->firstname . " " . auth()->user()->lastname }}</p>
                    <a href="/logout" class="flex items-center group">
                        <div class="p-2 rounded-xl bg-red-50 text-red-500 group-hover:bg-red-500 group-hover:text-white transition-all duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <span class="ml-3 text-sm font-bold text-gray-500 group-hover:text-red-600 transition-colors">Log-out</span>
                    </a>
                </div>
            </div>
            @endauth
        </div>
    </aside>

    <main class="flex-1 p-4 sm:p-8 lg:p-12 overflow-y-auto">
        
        <header class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-10 gap-4">
            <div>
                <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">Espace User</h1>
                <p class="text-gray-500 mt-1">Gérez vos finances et catégories en toute simplicité.</p>
            </div>
            <div class="flex gap-3">
                <button onclick="toggleModal('modalCategorie')" class="px-6 py-4 bg-white text-indigo-600 border border-indigo-100 rounded-[20px] font-bold shadow-sm hover:bg-indigo-50 transition-all flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    <span>Catégories</span>
                </button>
                <button onclick="toggleModal('modalExpense')" class="px-8 py-4 bg-indigo-600 text-white rounded-[20px] font-bold shadow-xl shadow-indigo-100 hover:bg-indigo-700 active:scale-95 transition-all flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    <span>Dépense</span>
                </button>
            </div>
        </header>
        @if(session('error'))
            <div class="bg-red-500 text-white p-4 rounded-xl mb-4">
                {{ session('error') }}
            </div>
        @elseif(session('success'))
            <div class="bg-red-500 text-white p-4 rounded-xl mb-4">
                {{ session('success') }}
            </div>
        @endif
        <div class="mb-10 group">
            <div class="glass p-10 rounded-[40px] bg-white/40 flex flex-col md:flex-row justify-between items-center gap-8 hover:bg-white/60 transition-all duration-500">
                <div class="flex items-center space-x-8">
                    <div class="w-20 h-20 bg-white rounded-3xl flex items-center justify-center shadow-sm border border-indigo-50 text-indigo-600">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                    <div>
                        @if($colocation)
                            <div class="flex items-center gap-4">
                                <h2 class="text-3xl font-bold text-gray-900">{{ $colocation->name }}</h2>
                                <span class="px-4 py-1.5 bg-green-100 text-green-700 text-[10px] font-black rounded-full uppercase tracking-widest shadow-sm">Actif</span>
                            </div>
                            <div class="flex items-center gap-4">
                                <h2 class="text-xl text-gray-900">Role : {{ $colocation->user_role }}</h2>
                            </div>
                            <p class="text-gray-500 mt-2 font-medium flex items-center">
                                <svg class="w-5 h-5 mr-2 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                MAX: {{ $colocation->numbers }}
                            </p>
                        @else
                           <div class="flex flex-col gap-2">
                                <h2 class="text-3xl font-bold text-gray-400 italic">Aucune Colocation</h2>
                                <button onclick="toggleModal('modalColoc')" class="text-indigo-600 font-bold hover:underline text-left">
                                    + Créer ou rejoindre une colocation
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="flex gap-4">
                    <button class="px-6 py-3 bg-white border border-gray-100 text-gray-600 font-bold rounded-2xl hover:bg-gray-50 transition-all">Détails</button>
                    <button onclick="toggleModal('modalInvite')" class="px-6 py-3 bg-indigo-50 text-indigo-600 font-bold rounded-2xl hover:bg-indigo-100 transition-all">Inviter +</button>
                </div>
            </div>
        </div>

        <div class="mb-10">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @if($memberships)
                    @foreach($memberships as $membership)
                        <div class="glass p-6 rounded-[32px] bg-white/60 border border-white hover:bg-white transition-all group">
                            <div class="flex items-center space-x-4">
                                <div class="relative">
                                    <img src="https://ui-avatars.com/api/?name={{ $membership->firstname }} . {{ $membership->lastname }}&background=6366f1&color=fff" 
                                         class="w-14 h-14 rounded-2xl shadow-sm group-hover:scale-105 transition-transform">
                                    <span class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 border-2 border-white rounded-full"></span>
                                </div>
                                <div class="truncate">
                                    <h3 class="font-bold text-gray-900 truncate">{{ $membership->firstname }} {{ $membership->lastname }}</h3>
                                    <span class="px-2 py-0.5 {{ $membership->role == 'admin' ? 'bg-indigo-100 text-indigo-600' : 'bg-gray-100 text-gray-500' }} text-[10px] font-black rounded-md uppercase tracking-tighter">
                                        {{ $membership->role }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-span-full p-8 text-center bg-gray-50 rounded-[32px] border-2 border-dashed border-gray-200">
                        <p class="text-gray-400 font-medium italic">Aucun membre à afficher.</p>
                    </div>
                @endif
            </div>
        </div>
        
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-10">
            <div class="p-8 bg-white rounded-[32px] shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                <p class="text-gray-400 text-[11px] font-bold uppercase tracking-widest mb-3">Mon Solde Personnel</p>
                <h3 class="text-3xl font-bold text-emerald-600">+450.00 DH</h3>
            </div>
            <div class="p-8 bg-white rounded-[32px] shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                <p class="text-gray-400 text-[11px] font-bold uppercase tracking-widest mb-3">Total Dépenses Mois</p>
                <h3 class="text-3xl font-bold text-gray-900">3,120.00 DH</h3>
            </div>
            <div class="p-8 bg-indigo-600 rounded-[32px] shadow-xl text-white">
                <p class="text-indigo-200 text-[11px] font-bold uppercase tracking-widest mb-3">Ma Réputation</p>
                <h3 class="text-3xl font-bold">Excellent 💎</h3>
            </div>
        </div>

        <div class="bg-white rounded-[40px] border border-gray-100 shadow-sm overflow-hidden">
            <div class="p-10 border-b border-gray-50 flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-900">Historique</h2>
                <button class="text-indigo-600 font-bold text-sm">Voir tout</button>
            </div>
            <div class="p-20 text-center flex flex-col items-center">
                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
                <p class="text-gray-400 font-medium italic">Pas encore de dépenses enregistrées.</p>
            </div>
        </div>
    </main>

    <div id="modalColoc" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/50 backdrop-blur-md">
        <div class="bg-white w-full max-w-lg rounded-[48px] p-12 shadow-2xl relative">
            <button onclick="toggleModal('modalColoc')" class="absolute top-8 right-8 text-gray-400 hover:text-gray-900 transition-colors">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
            <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Nouvelle Colocation</h2>
            <p class="text-gray-500 mb-10">Donnez un nom à votre aventure partagée.</p>

            <form action="{{ route('colocations.store') }}" method="POST" class="space-y-8">
                @csrf
                <div class="space-y-3">
                    <label class="text-sm font-bold text-gray-700 ml-2">Nom de la Colocation</label>
                    <input type="text" name="name" required class="w-full px-8 py-5 bg-gray-50 border border-gray-100 rounded-[24px] focus:ring-4 focus:ring-indigo-500/10 focus:bg-white outline-none transition-all" placeholder="Ex: YouCode Villa">
                </div>
                <div class="space-y-3">
                    <label class="text-sm font-bold text-gray-700 ml-2">Nombre de Membres (Numbers)</label>
                    <input type="number" name="number" required class="w-full px-8 py-5 bg-gray-50 border border-gray-100 rounded-[24px] focus:ring-4 focus:ring-indigo-500/10 focus:bg-white outline-none transition-all" placeholder="Ex: 4">
                </div>
                <input type="hidden" name="colocation_id" value="{{ $colocation->id }}">
                <button type="submit" class="w-full py-5 bg-indigo-600 text-white rounded-[24px] font-bold text-xl shadow-2xl shadow-indigo-200 hover:bg-indigo-700 active:scale-[0.98] transition-all">
                    Lancer la Coloc
                </button>
            </form>
        </div>
    </div>

    <div id="modalExpense" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/50 backdrop-blur-md">
        <div class="bg-white w-full max-w-lg rounded-[48px] p-12 shadow-2xl relative">
            <button onclick="toggleModal('modalExpense')" class="absolute top-8 right-8 text-gray-400 hover:text-gray-900 transition-colors">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
            <h2 class="text-3xl font-extrabold text-gray-900 mb-10">Ajouter un Frais</h2>

            <form action="{{ route('expenses.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="space-y-2">
                    <label class="text-sm font-bold text-gray-700 ml-2">Désignation</label>
                    <select name="categories" id="categories">
                        <option value=""></option>
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-gray-700 ml-2">Montant (DH)</label>
                        <input type="number" name="amount" required class="w-full px-8 py-5 bg-gray-50 border border-gray-100 rounded-[24px] outline-none" placeholder="00.00">
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-gray-700 ml-2">Type</label>
                        <select name="category" class="w-full px-8 py-5 bg-gray-50 border border-gray-100 rounded-[24px] outline-none appearance-none">
                            <option>Loyer</option>
                            <option>Énergie</option>
                            <option>Nourriture</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="w-full py-5 bg-indigo-600 text-white rounded-[24px] font-bold text-xl shadow-2xl shadow-indigo-200 hover:bg-indigo-700 active:scale-[0.98] transition-all">
                    Enregistrer le Paiement
                </button>
            </form>
        </div>
    </div>

    <div id="modalInvite" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/50 backdrop-blur-md">
        <div class="bg-white w-full max-w-lg rounded-[48px] p-12 shadow-2xl relative">
            <button onclick="toggleModal('modalInvite')" class="absolute top-8 right-8 text-gray-400 hover:text-gray-900 transition-colors">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
        
            <div class="w-16 h-16 bg-indigo-50 rounded-3xl flex items-center justify-center mb-6 text-indigo-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </div>
        
            <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Inviter un membre</h2>
            <p class="text-gray-500 mb-10">Entrez l'adresse email de votre futur colocataire.</p>

            <form action="{{ route('invitations.send') }}" method="POST" class="space-y-8">
                @csrf
                @if($colocation)
                    <input type="hidden" name="colocation_id" value="{{ $colocation->id }}">
                @endif

                <div class="space-y-3">
                    <label class="text-sm font-bold text-gray-700 ml-2">Adresse Email</label>
                    <div class="relative">
                        <span class="absolute left-6 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </span>
                        <input type="email" name="email" required 
                            class="w-full pl-14 pr-8 py-5 bg-gray-50 border border-gray-100 rounded-[24px] focus:ring-4 focus:ring-indigo-500/10 focus:bg-white outline-none transition-all" 
                            placeholder="exemple@mail.com">
                    </div>
                </div>

                <div class="space-y-3">
                   @error('email')
                        <p class="text-red-500 text-xs font-bold mb-4 italic">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="w-full py-5 bg-indigo-600 text-white rounded-[24px] font-bold text-xl shadow-2xl shadow-indigo-200 hover:bg-indigo-700 active:scale-[0.98] transition-all">
                    Envoyer l'invitation
                </button>
            </form>
        </div>
    </div>
    <div id="modalCategorie" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/50 backdrop-blur-md">
        <div class="bg-white w-full max-w-lg rounded-[48px] p-12 shadow-2xl relative">
            <button onclick="toggleModal('modalCategorie')" class="absolute top-8 right-8 text-gray-400 hover:text-gray-900 transition-colors">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
            <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Nouvelle Catégorie</h2>
            <p class="text-gray-500 mb-10">Organisez vos dépenses par types (Loyer, Courses...)</p>

            <form action="{{ route('categories.store') }}" method="POST" class="space-y-8">
                @csrf
                <div class="space-y-3">
                    <label class="text-sm font-bold text-gray-700 ml-2">Nom de la Catégorie</label>
                    <input type="text" name="name" required 
                        class="w-full px-8 py-5 bg-gray-50 border border-gray-100 rounded-[24px] focus:ring-4 focus:ring-indigo-500/10 focus:bg-white outline-none transition-all" 
                        placeholder="Ex: Factures, Internet...">
                </div>
            
                <button type="submit" class="w-full py-5 bg-indigo-600 text-white rounded-[24px] font-bold text-xl shadow-2xl shadow-indigo-200 hover:bg-indigo-700 active:scale-[0.98] transition-all">
                    Ajouter la Catégorie
                </button>
            </form>
        </div>
    </div>

    <script>
        function toggleModal(id) {
            const modal = document.getElementById(id);
            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.classList.add('modal-active');
            } else {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.classList.remove('modal-active');
            }
        }

        window.onclick = function(event) {
            if (event.target.classList.contains('fixed')) {
                event.target.classList.add('hidden');
                event.target.classList.remove('flex');
                document.body.classList.remove('modal-active');
            }
        }
    </script>

</body>
</html>