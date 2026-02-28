<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyColoc | Dashboard</title>
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
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[2px] mb-4 ml-2">Main Menu</p>
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
                @if(isset($colocation) && $colocation->user_role === 'owner')
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
                            <p class="text-gray-500 mt-2 font-medium uppercase text-xs tracking-wider">Role: <span class="text-indigo-600">{{ $colocation->user_role }}</span> | Places: {{ $colocation->numbers }}</p>
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
                </div>
                <div class="flex gap-4">
                    @if(isset($colocation))
                        @if($colocation->user_role === 'owner')
                            <button onclick="toggleModal('modalInvite')" class="px-6 py-3 bg-indigo-50 text-indigo-600 font-bold rounded-2xl hover:bg-indigo-100 transition-all">Inviter +</button>
                        @else
                            <button onclick="toggleModal('modalLeaveColoc')" class="px-6 py-3 bg-red-50 text-red-500 font-bold rounded-2xl hover:bg-red-500 hover:text-white transition-all">Quitter</button>
                        @endif
                    @endif
                </div>
            </div>
        </div>
        
        @if(isset($invitations) && $invitations->count() > 0)
        <div class="mb-10 animate-fade-in">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-2 h-8 bg-orange-500 rounded-full"></div>
                <h2 class="text-2xl font-bold text-gray-900">Invitations en attente</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($invitations as $invitation)
                <div class="glass p-6 rounded-[32px] bg-white/60 border border-white shadow-sm hover:shadow-md transition-all">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-indigo-100 rounded-2xl flex items-center justify-center text-indigo-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 line-clamp-1">{{ $invitation->colocation_name }}</h3>
                                <p class="text-xs text-gray-500 font-medium italic">Par: {{ $invitation->sender_name }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-2 mt-6">
                        <form action="{{ route('invitations.accept')}}" method="POST" class="flex-1">
                            @csrf
                            <button type="submit" class="w-full py-3 bg-indigo-600 text-white text-xs font-bold rounded-xl hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100">
                                Accepter
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <div class="bg-white rounded-[40px] border border-gray-100 shadow-sm overflow-hidden">
            <div class="p-10 border-b border-gray-50 flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Dépenses Récentes</h2>
                    <p class="text-gray-400 text-sm">Suivez les dépenses de la colocation en temps réel.</p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50">
                            <th class="p-6 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Membre</th>
                            <th class="p-6 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Désignation</th>
                            <th class="p-6 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Part Individuelle</th>
                            <th class="p-6 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @if(isset($expenses) && $expenses->count() > 0)
                            @foreach($expenses as $expense)
                                @if($expense->paid_to_user === auth()->id() || $expense->paid_by_user === auth()->id())
                                    <tr class="hover:bg-indigo-50/30 transition-colors group">
                                        <td class="p-6">
                                            <div class="flex items-center space-x-3">
                                                <img src="https://ui-avatars.com/api/?name={{ $expense->debtorfirstname }}&background=6366f1&color=fff" class="w-8 h-8 rounded-lg">
                                                <div>
                                                    <span class="font-bold text-gray-700 text-sm block">{{ $expense->debtorfirstname }} {{ $expense->debtorlastname }}</span>
                                                    @if($expense->paid_by_user === auth()->id() && $expense->paid_to_user !== auth()->id())
                                                        <span class="text-[9px] text-indigo-500 font-bold uppercase">Doit vous payer</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-6 text-sm font-medium text-gray-600">
                                            {{ $expense->description }}
                                            <span class="block text-[10px] text-gray-400 italic">Doit Payé par: {{ $expense->debtorfirstname }}</span>
                                        </td>
                                        <td class="p-6">
                                            <span class="font-bold text-gray-900">{{ number_format($expense->settlement_amount, 2) }} DH</span>
                                        </td>
                                        <td class="p-6">
                                            @if($expense->payment_status === true)
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black bg-green-100 text-green-700 uppercase border border-green-200">
                                                    ● Paid
                                                </span>
                                            @else
                                                @if($expense->paid_by_user === auth()->id())
                                                    <form action="{{ route('settlements.pay')}}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="expense_id" value="{{ $expense->id }}">
                                                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                                        <button type="submit" class="px-4 py-1.5 bg-indigo-600 text-white text-[10px] font-bold rounded-lg hover:bg-indigo-700 transition-all shadow-sm">
                                                            PAYER MA PART
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black bg-orange-50 text-orange-600 uppercase border border-orange-100">
                                                        En attente
                                                    </span>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @else
                            <tr><td colspan="4" class="p-20 text-center text-gray-400 italic">Aucune dépense enregistrée.</td></tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <div id="modalCreateColoc" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/50 backdrop-blur-md">
        <div class="bg-white w-full max-w-lg rounded-[48px] p-12 shadow-2xl relative">
            <button onclick="toggleModal('modalCreateColoc')" class="absolute top-8 right-8 text-gray-400 hover:text-gray-600"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-width="2" stroke-linecap="round"/></svg></button>
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
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
            </div>
            <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Inviter un colocataire</h2>
            <p class="text-gray-500 mb-8">Sifet invitation par email bach it-zad m'akom f l-hisab.</p>
            <form action="{{ route('invitations.send') }}" method="POST" class="space-y-6">
                @csrf
                @if(isset($colocation))
                    <input type="hidden" name="colocation_id" value="{{ $colocation->id }}">
                @endif
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
                <input type="text" name="name" required class="w-full px-8 py-5 bg-gray-50 border border-gray-100 rounded-[24px] outline-none" placeholder="Ex: Courses, Internet...">
                @if(isset($colocation))
                    <input type="hidden" name="colocation_id" value="{{ $colocation->id }}">
                @endif
                <button type="submit" class="w-full py-5 bg-indigo-600 text-white rounded-[24px] font-bold text-xl shadow-xl shadow-indigo-100 hover:bg-indigo-700 transition-all">Ajouter</button>
            </form>
        </div>
    </div>

    <div id="modalLeaveColoc" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/50 backdrop-blur-md">
        <div class="bg-white w-full max-w-lg rounded-[48px] p-12 shadow-2xl relative">
            <button onclick="toggleModal('modalLeaveColoc')" class="absolute top-8 right-8 text-gray-400"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-width="2" stroke-linecap="round"/></svg></button>
            <h2 class="text-3xl font-extrabold text-gray-900 mb-6">Quitter la colocation</h2>
            <p class="text-gray-700 mb-6">Êtes-vous sûr de vouloir quitter cette colocation ?</p>
            <form action="{{ route('colocations.leave') }}" method="POST">
                @csrf
                @if(isset($colocation))
                    <input type="hidden" name="colocation_id" value="{{ $colocation->id }}">
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                @endif
                <button type="submit" class="w-full py-5 bg-red-500 text-white rounded-[24px] font-bold text-xl shadow-xl shadow-red-100 hover:bg-red-600 transition-all">Confirmer</button>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="fixed bottom-10 right-10 bg-white border-l-4 border-green-500 shadow-2xl p-6 rounded-2xl flex items-center space-x-4 animate-bounce z-[100]">
            <div class="bg-green-100 p-2 rounded-full text-green-600 font-bold">✓</div>
            <p class="font-bold text-gray-800">{{ session('success') }}</p>
        </div>
    @endif
    
    @if(session('error'))
        <div class="fixed bottom-10 right-10 bg-white border-l-4 border-red-500 shadow-2xl p-6 rounded-2xl flex items-center space-x-4 animate-bounce z-[100]">
            <div class="bg-red-100 p-2 rounded-full text-red-600 font-bold">✗</div>
            <p class="font-bold text-gray-800">{{ session('error') }}</p>
        </div>
    @endif

</body>
</html>