<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyColoc | Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #f1f5f9; }
        .glass { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.4); transition: all 0.3s ease; }
        .glass:hover { transform: translateY(-5px); box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1); }
        .sidebar-item-active { background: #6366f1; color: white; border-radius: 16px; box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.3); }
        .stat-card-blue { border-bottom: 4px solid #3b82f6; }
        .stat-card-indigo { border-bottom: 4px solid #6366f1; }
        .stat-card-emerald { border-bottom: 4px solid #10b981; }
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
                <img src="https://ui-avatars.com/api/?name={{ auth()->user()->firstname }} . {{ auth()->user()->lastname }}&background=6366f1&color=fff" class="w-10 h-10 rounded-full border-2 border-indigo-100">
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
            <div class="bg-white px-6 py-3 rounded-2xl shadow-sm border border-gray-100 flex items-center space-x-3">
                <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                <span class="text-sm font-bold text-gray-600">Système opérationnel</span>
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            <div class="glass p-8 rounded-[32px] stat-card-blue flex flex-col justify-between">
                <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-width="2"/></svg>
                </div>
                <div>
                    <h2 class="text-gray-500 font-semibold text-sm uppercase tracking-wider">Utilisateurs</h2>
                    <p class="text-4xl font-black text-gray-900 mt-1">{{ $users->count() }}</p>

                    <p class="text-green-500 text-xs font-bold mt-2">↑ {{ $users->count() / 30 }} ce mois</p>
                </div>
            </div>

            <div class="glass p-8 rounded-[32px] stat-card-indigo flex flex-col justify-between">
                <div class="w-12 h-12 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" stroke-width="2"/></svg>
                </div>
                <div>
                    <h2 class="text-gray-500 font-semibold text-sm uppercase tracking-wider">Colocations</h2>
                    <p class="text-4xl font-black text-gray-900 mt-1">{{ $colocations->count() }}</p>
                    <p class="text-indigo-500 text-xs font-bold mt-2">Actives maintenant</p>
                </div>
            </div>

            <div class="glass p-8 rounded-[32px] stat-card-emerald flex flex-col justify-between">
                <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" stroke-width="2"/></svg>
                </div>
                <div>
                    <h2 class="text-gray-500 font-semibold text-sm uppercase tracking-wider">Dépenses Totales</h2>
                    <p class="text-4xl font-black text-gray-900 mt-1">{{ $expenses->sum('amount') }} <span class="text-lg">DH</span></p>
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
                            <th class="p-6 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Statut</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @if($createdcol && $createdcol->count() > 0)
                        @foreach($createdcol as $coloc)
                        <tr class="hover:bg-indigo-50/30 transition-colors">
                            <td class="p-6">
                                <span class="font-bold text-gray-800">{{ $coloc->name }}</span>
                            </td>
                            <td class="p-6">
                                <div class="flex items-center space-x-2">
                                    <div class="w-6 h-6 bg-indigo-100 rounded-full text-[10px] flex items-center justify-center font-bold text-indigo-600">JD</div>
                                    <span class="text-sm">{{ $coloc->firstname }} {{ $coloc->lastname }}</span>
                                </div>
                            </td>
                            <td class="p-6 text-sm">{{ $coloc->numbers }} Places</td>
                            <td class="p-6">
                                <span class="px-3 py-1 bg-green-100 text-green-600 text-[10px] font-black rounded-full uppercase">{{ $coloc->status }}</span>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    @if(session('success'))
        <div class="fixed bottom-10 right-10 bg-white border-l-4 border-green-500 shadow-2xl p-6 rounded-2xl flex items-center space-x-4 animate-bounce z-[100]">
            <div class="bg-green-100 p-2 rounded-full text-green-600 font-bold">✓</div>
            <p class="font-bold text-gray-800">{{ session('success') }}</p>
        </div>
    @endif

</body>
</html>