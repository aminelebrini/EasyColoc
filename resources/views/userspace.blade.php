<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyColoc | Tableau de bord</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <script>
        function toggleModal(id) {
            const modal = document.getElementById(id);
            if (modal) {
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
        }
    </script>

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
            
            <a href="#invitations-section" class="flex items-center justify-between p-4 text-gray-500 hover:bg-indigo-50 hover:text-indigo-600 rounded-2xl transition-all group">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    <span class="font-semibold">Invitations</span>
                </div>
                @if(isset($receivedInvitations) && $receivedInvitations->count() > 0)
                    <span class="flex h-5 w-5 items-center justify-center rounded-full bg-red-500 text-[10px] font-bold text-white">{{ $receivedInvitations->count() }}</span>
                @endif
            </a>
        </nav>

        <div class="mt-auto pt-6 border-t border-gray-100 flex items-center justify-between">
            @auth
              <div class="flex items-center space-x-3 overflow-hidden">
                <img src="https://ui-avatars.com/api/?name={{ auth()->user()->firstname }}+{{ auth()->user()->lastname }}&background=6366f1&color=fff" class="w-10 h-10 rounded-full">
                <div class="truncate">
                    <p class="text-sm font-bold truncate">{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</p>
                    <a href="/logout" class="text-xs font-bold text-red-500 hover:text-red-600 transition-colors">Déconnexion</a>
                </div>
            </div>
            @endauth
        </div>
    </aside>

    <main class="flex-1 p-4 sm:p-8 lg:p-12 overflow-y-auto">
        <header class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-10 gap-4">
            <div>
                <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">Espace User</h1>
                <p class="text-gray-500 mt-1">Gérez vos finances en toute simplicité.</p>
            </div>
            <div class="flex gap-3">
                @if(isset($colocation->user_role) && $colocation->user_role === 'owner')
                    <button onclick="toggleModal('modalCategorie')" class="px-6 py-4 bg-white text-indigo-600 border border-indigo-100 rounded-[20px] font-bold shadow-sm hover:bg-indigo-50 transition-all flex items-center space-x-2">
                        <span>Catégories</span>
                    </button>
                @endif
                <button onclick="toggleModal('modalExpense')" class="px-8 py-4 bg-indigo-600 text-white rounded-[20px] font-bold shadow-xl shadow-indigo-100 hover:bg-indigo-700 active:scale-95 transition-all">
                    <span>+ Dépense</span>
                </button>
            </div>
        </header>

        <div class="mb-10 group">
            <div class="glass p-10 rounded-[40px] bg-white/40 flex flex-col md:flex-row justify-between items-center gap-8">
                <div class="flex items-center space-x-8">
                    <div class="w-20 h-20 bg-white rounded-3xl flex items-center justify-center shadow-sm border border-indigo-50 text-indigo-600">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                    <div>
                        @if(isset($colocation))
                            <h2 class="text-3xl font-bold text-gray-900">{{ $colocation->name }}</h2>
                            <p class="text-gray-500 mt-2 font-medium">Role: {{ $colocation->user_role }} | Places: {{ $colocation->numbers }}</p>
                        @endif
                    </div>
                </div>
                <div class="flex gap-4">
                    @if(isset($colocation) && $colocation->user_role === 'owner')
                         <button onclick="toggleModal('modalInvite')" class="px-6 py-3 bg-indigo-50 text-indigo-600 font-bold rounded-2xl hover:bg-indigo-100 transition-all">Inviter +</button>
                    @else
                         <button class="px-6 py-3 bg-red-50 text-red-500 font-bold rounded-2xl hover:bg-red-500 hover:text-white transition-all">Quitter</button>
                    @endif
                </div>
            </div>
        </div>

        <div class="mb-10">
            <h2 class="text-sm font-bold text-indigo-400 uppercase tracking-[2px] mb-4 ml-2">Membres de la Coloc</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @if(isset($memberships) && $memberships->count() > 0)
                    @foreach($memberships as $membership)
                        <div class="glass p-6 rounded-[32px] bg-white border border-white hover:bg-white transition-all group">
                            <div class="flex items-center space-x-4">
                                <img src="https://ui-avatars.com/api/?name={{ $membership->firstname }}+{{ $membership->lastname }}&background=6366f1&color=fff" class="w-12 h-12 rounded-2xl">
                                <div class="truncate">
                                    <h3 class="font-bold text-gray-900 truncate">{{ $membership->firstname }}</h3>
                                    <span class="text-[10px] font-black text-indigo-500 uppercase">{{ $membership->role }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-gray-400 italic">Aucun membre pour l'instant.</p>
                @endif
            </div>
        </div>

        <div class="bg-white rounded-[40px] border border-gray-100 shadow-sm overflow-hidden p-10">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Historique des dépenses</h2>
            <div class="flex flex-col items-center justify-center py-10">
                <p class="text-gray-400 font-medium italic">Pas encore de dépenses enregistrées.</p>
            </div>
        </div>
    </main>

    <div id="modalExpense" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/50 backdrop-blur-md">
        <div class="bg-white w-full max-w-lg rounded-[48px] p-12 shadow-2xl relative">
            <button onclick="toggleModal('modalExpense')" class="absolute top-8 right-8 text-gray-400">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-width="2" stroke-linecap="round"/></svg>
            </button>
            <h2 class="text-3xl font-extrabold text-gray-900 mb-8">Ajouter une dépense</h2>
            <form action="{{ route('expenses.store') }}" method="POST" class="space-y-6">
                @csrf
                <select name="categories_id" class="w-full px-8 py-5 bg-gray-50 border border-gray-100 rounded-[24px]">
                    <option value="">Sélectionnez une catégorie</option>
                    @if(isset($categories))
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    @endif
                </select>
                <div class="grid grid-cols-2 gap-6">                     
                    <div class="space-y-2">                         
                        <label class="text-sm font-bold text-gray-700 ml-2">Description</label>                         
                        <input type="text" name="description" required class="w-full px-8 py-5 bg-gray-50 border border-gray-100 rounded-[24px] outline-none" placeholder="Lma wdaw">                     
                    </div>                 
                </div>                 
                @if($colocation)                     
                <input type="hidden" name="colocation_id" value="{{ $colocation->id }}">                 
                @else                     
                <input type="hidden" name="colocation_id" value="">                 
                @endif
                <input type="number" name="amount" required class="w-full px-8 py-5 bg-gray-50 border border-gray-100 rounded-[24px]" placeholder="Montant (DH)">
                <button type="submit" class="w-full py-5 bg-indigo-600 text-white rounded-[24px] font-bold text-xl">Enregistrer</button>
            </form>
        </div>
    </div>

    <div id="modalCategorie" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/50 backdrop-blur-md">
        <div class="bg-white w-full max-w-lg rounded-[48px] p-12 shadow-2xl relative">
            <button onclick="toggleModal('modalCategorie')" class="absolute top-8 right-8 text-gray-400">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-width="2" stroke-linecap="round"/></svg>
            </button>
            <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Nouvelle Catégorie</h2>
            <form action="{{ route('categories.store') }}" method="POST" class="space-y-8">
                @csrf
                <input type="text" name="name" required class="w-full px-8 py-5 bg-gray-50 border border-gray-100 rounded-[24px]" placeholder="Ex: Courses...">
                <button type="submit" class="w-full py-5 bg-indigo-600 text-white rounded-[24px] font-bold">Ajouter</button>
            </form>
        </div>
    </div>

</body>
</html>