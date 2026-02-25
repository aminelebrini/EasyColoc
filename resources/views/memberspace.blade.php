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
        .glass { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2); }
        .modal-active { overflow: hidden; }
    </style>
</head>
<body class="min-h-screen flex">

    <aside class="w-64 bg-white border-r border-gray-100 hidden lg:flex flex-col p-6 sticky top-0 h-screen">
        <div class="flex items-center space-x-2 mb-10">
            <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center shadow-lg">
                <span class="text-white font-bold text-lg">E</span>
            </div>
            <span class="text-xl font-bold tracking-tight">EasyColoc.</span>
        </div>

        <nav class="space-y-2 flex-1">
            <a href="#" class="flex items-center space-x-3 p-3 bg-indigo-50 text-indigo-600 rounded-xl font-semibold">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <span>Dashboard</span>
            </a>
            <button onclick="toggleModal('modalColoc')" class="w-full flex items-center space-x-3 p-3 text-gray-500 hover:bg-gray-50 rounded-xl transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <span>Créer Coloc</span>
            </button>
        </nav>

        <div class="mt-auto pt-6 border-t border-gray-100">
            <div class="flex items-center space-x-3 mb-6">
                <img src="https://ui-avatars.com/api/?name=Amine&background=6366f1&color=fff" class="w-10 h-10 rounded-full">
                <div class="overflow-hidden">
                    <p class="text-sm font-bold truncate">Amine Lebrini</p>
                    <p class="text-xs text-gray-500 uppercase tracking-wider">Membre</p>
                </div>
            </div>
        </div>
    </aside>

    <main class="flex-1 p-4 sm:p-8 lg:p-12 overflow-y-auto">
        <header class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-10 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Espace Membre</h1>
                <p class="text-gray-500 italic">"Simplifiez la gestion de vos charges communes."</p>
            </div>
            <div class="flex space-x-3">
                <button onclick="toggleModal('modalExpense')" class="px-6 py-3 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition-all flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    <span>Ajouter Dépense</span>
                </button>
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
            <div class="p-8 bg-white rounded-[32px] shadow-sm border border-gray-100">
                <p class="text-gray-400 text-sm font-semibold uppercase tracking-wider mb-2">Mon Solde</p>
                <h3 class="text-3xl font-bold text-green-600">+450.00 DH</h3>
            </div>
            <div class="p-8 bg-white rounded-[32px] shadow-sm border border-gray-100">
                <p class="text-gray-400 text-sm font-semibold uppercase tracking-wider mb-2">Dépenses Coloc</p>
                <h3 class="text-3xl font-bold text-gray-900">3,120.00 DH</h3>
            </div>
            <div class="p-8 bg-indigo-600 rounded-[32px] shadow-lg text-white">
                <p class="text-indigo-200 text-sm font-semibold uppercase tracking-wider mb-2">Réputation</p>
                <h3 class="text-3xl font-bold">Excellent</h3>
            </div>
        </div>

        <div class="bg-white rounded-[32px] border border-gray-100 shadow-sm overflow-hidden">
            <div class="p-8 border-b border-gray-50">
                <h2 class="text-xl font-bold text-gray-900">Historique des dépenses</h2>
            </div>
            <div class="p-8 text-center text-gray-500">
                Aucune dépense enregistrée pour le moment.
            </div>
        </div>
    </main>

    <div id="modalColoc" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/40 backdrop-blur-sm">
        <div class="bg-white w-full max-w-md rounded-[40px] p-10 shadow-2xl relative">
            <button onclick="toggleModal('modalColoc')" class="absolute top-6 right-6 text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Créer une colocation</h2>
            <p class="text-gray-500 text-sm mb-8">En créant une coloc, vous devenez l'administrateur (Owner).</p>

            <form action="{{ route('colocations.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="space-y-2">
                    <label class="text-sm font-bold text-gray-700 ml-1">Nom de la colocation</label>
                    <input type="text" name="name" required class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-[22px] focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all" placeholder="Ex: Résidence Al Baraka">
                </div>
                <button type="submit" class="w-full py-4 bg-indigo-600 text-white rounded-[22px] font-bold text-lg shadow-xl shadow-indigo-100 hover:bg-indigo-700 active:scale-95 transition-all">
                    Lancer la colocation
                </button>
            </form>
        </div>
    </div>

    <div id="modalExpense" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/40 backdrop-blur-sm">
        <div class="bg-white w-full max-w-md rounded-[40px] p-10 shadow-2xl relative">
            <button onclick="toggleModal('modalExpense')" class="absolute top-6 right-6 text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
            <h2 class="text-2xl font-bold text-gray-900 mb-8">Détails de la dépense</h2>

            <form action="{{ route('expenses.store') }}" method="POST" class="space-y-5">
                @csrf
                <div class="space-y-2">
                    <label class="text-sm font-bold text-gray-700 ml-1">Quoi ?</label>
                    <input type="text" name="title" required class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-[22px] outline-none focus:ring-4 focus:ring-indigo-500/10" placeholder="Ex: Électricité, Courses...">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-gray-700 ml-1">Montant (DH)</label>
                        <input type="number" name="amount" required class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-[22px] outline-none" placeholder="0.00">
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-gray-700 ml-1">Catégorie</label>
                        <select name="category" class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-[22px] outline-none appearance-none">
                            <option>Loyer</option>
                            <option>Charges</option>
                            <option>Nourriture</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="w-full py-4 bg-indigo-600 text-white rounded-[22px] font-bold text-lg shadow-xl shadow-indigo-100 hover:bg-indigo-700 active:scale-95 transition-all">
                    Confirmer la dépense
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

        // Fermer le modal en cliquant à l'extérieur
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