<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyColoc | Admin Dashboard</title>
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
        body { font-family: 'Outfit', sans-serif; background-color: #f1f5f9; }
        .glass { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.4); transition: all 0.3s ease; }
        .glass:hover { transform: translateY(-5px); box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1); }
        .sidebar-item-active { background: #6366f1; color: white; border-radius: 16px; box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.3); }
        .stat-card-blue { border-bottom: 4px solid #3b82f6; }
        .stat-card-indigo { border-bottom: 4px solid #6366f1; }
        .stat-card-emerald { border-bottom: 4px solid #10b981; }
        .modal-active { overflow: hidden; }
    </style>
</head>
<body class="min-h-screen flex text-gray-800">

    <aside class="w-72 bg-white border-r border-gray-100 hidden lg:flex flex-col p-6 sticky top-0 h-screen z-50">
        <div class="flex items-center space-x-3 mb-10 px-2">
            <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-200">
                <span class="text-white font-bold text-xl">E</span>
            </div>
            <span class="text-2xl font-bold tracking-tight text-gray-900">EasyColoc<span class="text-indigo-600 text-xs">Admin</span></span>
        </div>

        <nav class="space-y-2 flex-1">
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[2px] mb-4 ml-2">Main Menu</p>

            <a href="#" class="flex items-center space-x-3 p-4 sidebar-item-active font-semibold">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" stroke-width="2" stroke-linecap="round"/></svg>
                <span>Dashboard</span>
            </a>

            <a href="#" class="flex items-center space-x-3 p-4 text-gray-500 hover:bg-indigo-50 hover:text-indigo-600 rounded-2xl transition-all font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" stroke-width="2" stroke-linecap="round"/></svg>
                <span>Utilisateurs</span>
            </a>

            <a href="#" class="flex items-center space-x-3 p-4 text-gray-500 hover:bg-indigo-50 hover:text-indigo-600 rounded-2xl transition-all font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" stroke-width="2" stroke-linecap="round"/></svg>
                <span>Colocations</span>
            </a>

            <a href="#" class="flex items-center space-x-3 p-4 text-gray-500 hover:bg-indigo-50 hover:text-indigo-600 rounded-2xl transition-all font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2" stroke-linecap="round"/></svg>
                <span>Dépenses Totales</span>
            </a>
        </nav>

        <div class="mt-auto pt-6 border-t border-gray-100">
            <div class="flex items-center space-x-3 p-2">
                <img src="https://ui-avatars.com/api/?name={{ auth()->user()->firstname }}+{{ auth()->user()->lastname }}&background=6366f1&color=fff" class="w-10 h-10 rounded-full border-2 border-indigo-100">
                <div class="truncate">
                    <p class="text-sm font-bold truncate">{{ auth()->user()->firstname }}  {{ auth()->user()->lastname }}</p>
                    <a href="/logout" class="text-[10px] font-black uppercase text-red-500 hover:underline">Déconnexion</a>
                </div>
            </div>
        </div>
    </aside>

    <main class="flex-1 p-6 sm:p-10 lg:p-12 overflow-y-auto">
        <header class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-10 gap-4">
            <div>
                <span class="text-indigo-600 font-bold text-sm tracking-widest uppercase">Overview</span>
                <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">Espace Admin</h1>
                <p class="text-gray-500 mt-1">Surveillez l'activité globale en temps réel.</p>
            </div>
            <div class="flex gap-3">
                <button onclick="toggleModal('modalCreateColoc')" class="px-6 py-3 bg-white text-indigo-600 border border-indigo-100 rounded-[20px] font-bold shadow-sm hover:bg-indigo-50 transition-all">+ Coloc</button>
                <button onclick="toggleModal('modalExpense')" class="px-6 py-3 bg-white text-indigo-600 border border-indigo-100 rounded-[20px] font-bold shadow-sm hover:bg-indigo-50 transition-all">
                    + Dépense
                </button>
                <button onclick="toggleModal('modalCategorie')" class="px-6 py-3 bg-white text-indigo-600 border border-indigo-100 rounded-[20px] font-bold shadow-sm hover:bg-indigo-50 transition-all">
                    + Catégorie
                </button>
            </div>
        </header>
        <div>
            @if(isset($colocations))
                <h2 class="text-3xl font-bold text-gray-900">{{ $colocations->name }}</h2>
                <p class="text-gray-500 mt-2 font-medium uppercase text-xs tracking-wider">Role: <span class="text-indigo-600">{{ $colocations->user_role }}</span> | Places: {{ $colocations->numbers }}</p>
            @else
                <div class="text-left">
                    <h2 class="text-xl font-bold text-gray-900">No Colocation Found</h2>
                    <p class="text-gray-500 mb-4">Start managing expenses with roommates today.</p>
                    <button onclick="toggleModal('modalCreateColoc')" 
                            class="px-6 py-3 bg-indigo-600 text-white font-bold rounded-2xl hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100">
                        Create New Colocation
                    </button>
                </div>
            @endif
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            <div class="glass p-8 rounded-[32px] stat-card-blue flex flex-col justify-between">
                <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 mb-4 font-bold">U</div>
                <div>
                    <h2 class="text-gray-500 font-semibold text-sm uppercase tracking-wider">Utilisateurs</h2>
                    <p class="text-4xl font-black text-gray-900 mt-1">{{ $users->count() }}</p>
                    <p class="text-green-500 text-xs font-bold mt-2">↑ {{ number_format($users->count() / 30, 1) }} ce mois</p>
                </div>
            </div>

            <div class="glass p-8 rounded-[32px] stat-card-indigo flex flex-col justify-between">
                <div class="w-12 h-12 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 mb-4 font-bold">C</div>
                <div>
                    <h2 class="text-gray-500 font-semibold text-sm uppercase tracking-wider">Colocations</h2>
                    <p class="text-4xl font-black text-gray-900 mt-1">{{ $createdcol->count() }}</p>
                    <p class="text-indigo-500 text-xs font-bold mt-2">Actives maintenant</p>
                </div>
            </div>

            <div class="glass p-8 rounded-[32px] stat-card-emerald flex flex-col justify-between">
                <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 mb-4 font-bold">DH</div>
                <div>
                    <h2 class="text-gray-500 font-semibold text-sm uppercase tracking-wider">Dépenses Totales</h2>
                    <p class="text-4xl font-black text-gray-900 mt-1">{{ number_format($expenses->sum('amount'), 2) }} <span class="text-lg">DH</span></p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-[40px] border border-gray-100 shadow-sm overflow-hidden">
            <div class="p-8 border-b border-gray-50 flex justify-between items-center bg-white">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Colocations Récentes</h2>
                    <p class="text-gray-400 text-sm">Liste des derniers espaces créés.</p>
                </div>
                <button class="text-indigo-600 font-bold text-sm hover:underline">Voir tout →</button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50">
                            <th class="p-6 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Colocation</th>
                            <th class="p-6 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Créateur</th>
                            <th class="p-6 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Membres</th>
                            <th class="p-6 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @if(isset($createdcol) && $createdcol->count() > 0)
                        @foreach($createdcol as $coloc)
                        <tr class="hover:bg-indigo-50/30 transition-colors">
                            <td class="p-6">
                                <span class="font-bold text-gray-800">{{ $coloc->name }}</span>
                            </td>
                            <td class="p-6">
                                <div class="flex items-center space-x-2">
                                    <div class="w-8 h-8 bg-indigo-100 rounded-full text-[10px] flex items-center justify-center font-bold text-indigo-600 uppercase">
                                        {{ substr($coloc->firstname, 0, 1) }}{{ substr($coloc->lastname, 0, 1) }}
                                    </div>
                                    <span class="text-sm font-medium">{{ $coloc->firstname }} {{ $coloc->lastname }}</span>
                                </div>
                            </td>
                            <td class="p-6 text-sm font-medium">{{ $coloc->numbers }} Places</td>
                            <td class="p-6 text-sm text-gray-500">
                                {{ date('d/m/Y', strtotime($coloc->created_at)) }}
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <div id="modalCreateColoc" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/50 backdrop-blur-md">
        <div class="bg-white w-full max-w-lg rounded-[48px] p-12 shadow-2xl relative">
            <button onclick="toggleModal('modalCreateColoc')" class="absolute top-8 right-8 text-gray-400 hover:text-gray-600 transition-colors"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-width="2" stroke-linecap="round"/></svg></button>
            <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Nouvelle Coloc</h2>
            <p class="text-gray-500 mb-8">Créez votre espace pour gérer vos factures.</p>
            <form action="{{ route('colocations.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="space-y-2">
                    <label class="text-xs font-bold text-gray-400 uppercase tracking-widest ml-4">Nom de la Coloc</label>
                    <input type="text" name="name" required class="w-full px-8 py-5 bg-gray-50 border border-gray-100 rounded-[24px] outline-none focus:ring-2 focus:ring-indigo-500 transition-all" placeholder="Ex: Appartement 404">
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-bold text-gray-400 uppercase tracking-widest ml-4">Nombre de places</label>
                    <input type="number" name="number" min="1" required class="w-full px-8 py-5 bg-gray-50 border border-gray-100 rounded-[24px] outline-none focus:ring-2 focus:ring-indigo-500 transition-all" placeholder="Ex: 3">
                </div>
                <button type="submit" class="w-full py-5 bg-indigo-600 text-white rounded-[24px] font-bold text-xl shadow-xl shadow-indigo-100 hover:bg-indigo-700 transition-all">Lancer la Coloc</button>
            </form>
        </div>
    </div>

    <div id="modalInvite" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/50 backdrop-blur-md">
        <div class="bg-white w-full max-w-lg rounded-[48px] p-12 shadow-2xl relative">
            <button onclick="toggleModal('modalInvite')" class="absolute top-8 right-8 text-gray-400"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-width="2" stroke-linecap="round"/></svg></button>
            <div class="bg-blue-100 w-16 h-16 rounded-2xl flex items-center justify-center mb-6 text-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
            </div>
            <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Inviter un colocataire</h2>
            <p class="text-gray-500 mb-8">Sifet invitation par email bach it-zad m'akom f l-hisab.</p>
            <form action="{{ route('invitations.send') }}" method="POST" class="space-y-6">
                @csrf
                @if(isset($colocation)) <input type="hidden" name="colocation_id" value="{{ $colocation->id }}"> @endif
                <div class="space-y-2">
                    <label class="text-xs font-bold text-gray-400 uppercase tracking-widest ml-4">Email du destinataire</label>
                    <input type="email" name="email" required class="w-full px-8 py-5 bg-gray-50 border border-gray-100 rounded-[24px] outline-none focus:ring-2 focus:ring-indigo-500 transition-all" placeholder="example@mail.com">
                </div>
                <button type="submit" class="w-full py-5 bg-indigo-600 text-white rounded-[24px] font-bold text-xl shadow-xl shadow-indigo-100 hover:bg-indigo-700 transition-all">Envoyer l'invitation</button>
            </form>
        </div>
    </div>

    <div id="modalExpense" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/50 backdrop-blur-md">
        <div class="bg-white w-full max-w-lg rounded-[48px] p-12 shadow-2xl relative">
            <button onclick="toggleModal('modalExpense')" class="absolute top-8 right-8 text-gray-400"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-width="2" stroke-linecap="round"/></svg></button>
            <h2 class="text-3xl font-extrabold text-gray-900 mb-8">Ajouter une dépense</h2>
            <form action="{{ route('expenses.store') }}" method="POST" class="space-y-6">
                @csrf
                <select name="categories_id" class="w-full px-8 py-5 bg-gray-50 border border-gray-100 rounded-[24px] outline-none">
                    <option value="">Sélectionnez une catégorie</option>
                    @if(isset($categories)) @foreach($categories as $category) <option value="{{ $category->id }}">{{ $category->name }}</option> @endforeach @endif
                </select>
                <input type="text" name="description" required class="w-full px-8 py-5 bg-gray-50 border border-gray-100 rounded-[24px] outline-none" placeholder="Description (ex: Facture Eau)">
                <input type="number" name="amount" required class="w-full px-8 py-5 bg-gray-50 border border-gray-100 rounded-[24px] outline-none" placeholder="Montant Total (DH)">
                @if(isset($colocation)) <input type="hidden" name="colocation_id" value="{{ $colocation->id }}"> @endif
                <button type="submit" class="w-full py-5 bg-indigo-600 text-white rounded-[24px] font-bold text-xl shadow-xl shadow-indigo-100 hover:bg-indigo-700 transition-all">Enregistrer</button>
            </form>
        </div>
    </div>

    <div id="modalCategorie" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/50 backdrop-blur-md">
        <div class="bg-white w-full max-w-lg rounded-[48px] p-12 shadow-2xl relative">
            <button onclick="toggleModal('modalCategorie')" class="absolute top-8 right-8 text-gray-400"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-width="2" stroke-linecap="round"/></svg></button>
            <h2 class="text-3xl font-extrabold text-gray-900 mb-6">Nouvelle Catégorie</h2>
            <form action="{{ route('categories.store') }}" method="POST" class="space-y-6">
                @csrf
                <input type="text" name="name" required class="w-full px-8 py-5 bg-gray-50 border border-gray-100 rounded-[24px] outline-none focus:ring-2 focus:ring-indigo-500 transition-all" placeholder="Ex: Courses, Internet...">
                @if(isset($colocation)) <input type="hidden" name="colocation_id" value="{{ $colocation->id }}"> @endif
                <button type="submit" class="w-full py-5 bg-indigo-600 text-white rounded-[24px] font-bold text-xl shadow-xl shadow-indigo-100 hover:bg-indigo-700 transition-all">Ajouter</button>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="fixed bottom-10 right-10 bg-white border-l-4 border-green-500 shadow-2xl p-6 rounded-2xl flex items-center space-x-4 animate-bounce z-[100]">
            <div class="bg-green-100 p-2 rounded-full text-green-600 font-bold">✓</div>
            <p class="font-bold text-gray-800">{{ session('success') }}</p>
        </div>
    @endif

</body>
</html>