@extends('layouts.admin')

@section('title', 'Admin Control Center')

@section('content')
<!-- Metric Cards Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <!-- Revenue -->
    <div class="p-6 bg-gradient-to-tr from-emerald-500 to-emerald-400 text-white rounded-2xl shadow-sm shadow-emerald-500/10 hover:translate-y-[-2px] transition-all duration-300 flex flex-col justify-between min-h-[10rem]">
        <div class="flex justify-between items-start">
            <span class="text-xs font-bold uppercase tracking-wider text-emerald-100/90">Total Pendapatan</span>
            <div class="p-2 rounded-lg bg-white/20 backdrop-blur-sm font-bold shrink-0 text-white flex items-center justify-center border border-white/10">
                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-1.958-.659-1.071-.803-1.071-2.107 0-2.91C11.212 7.564 12.788 7.564 13.958 8.4l.88.66" />
                </svg>
            </div>
        </div>
        <div class="mt-4">
            <h3 class="text-2xl lg:text-3xl font-extrabold text-white break-words">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
            <p class="text-xs font-medium text-emerald-100/80 mt-1">Akumulasi seluruh transaksi sukses</p>
        </div>
    </div>

    <!-- Incoming Orders Today -->
    <div class="p-6 bg-gradient-to-tr from-amber-400 to-amber-300 text-slate-800 rounded-2xl shadow-sm shadow-amber-400/10 hover:translate-y-[-2px] transition-all duration-300 flex flex-col justify-between min-h-[10rem]">
        <div class="flex justify-between items-start">
            <span class="text-xs font-bold uppercase tracking-wider text-slate-700/80">Pesanan Hari Ini</span>
            <div class="p-2 rounded-lg bg-white/40 backdrop-blur-sm font-bold shrink-0 text-slate-800 flex items-center justify-center border border-white/20">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504 1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                </svg>
            </div>
        </div>
        <div class="mt-4">
            <h3 class="text-2xl lg:text-3xl font-extrabold text-slate-800 break-words">{{ $incomingOrdersToday }}</h3>
            <p class="text-xs font-medium text-slate-700/80 mt-1">Pesanan masuk hari ini</p>
        </div>
    </div>

    <!-- Active Couriers -->
    <div class="p-6 bg-gradient-to-tr from-cyan-500 to-cyan-400 text-white rounded-2xl shadow-sm shadow-cyan-500/10 hover:translate-y-[-2px] transition-all duration-300 flex flex-col justify-between min-h-[10rem]">
        <div class="flex justify-between items-start">
            <span class="text-xs font-bold uppercase tracking-wider text-cyan-100/90">Kurir Aktif</span>
            <div class="p-2 rounded-lg bg-white/20 backdrop-blur-sm font-bold shrink-0 text-white flex items-center justify-center border border-white/10">
                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.129-1.125V11.25c0-.447-.267-.852-.68-1.01l-2.902-1.09A1.125 1.125 0 0 0 17.25 9.75H13.5v9M13.5 9v11.25m-10.5-6h10.5" />
                </svg>
            </div>
        </div>
        <div class="mt-4">
            <h3 class="text-2xl lg:text-3xl font-extrabold text-white break-words">{{ $activeCouriersCount }} Orang</h3>
            <p class="text-xs font-medium text-cyan-100/80 mt-1">Staff kurir aktif siap kirim</p>
        </div>
    </div>

    <!-- Critical Stock -->
    <div class="p-6 bg-gradient-to-tr from-rose-500 to-rose-400 text-white rounded-2xl shadow-sm shadow-rose-500/10 hover:translate-y-[-2px] transition-all duration-300 flex flex-col justify-between min-h-[10rem]">
        <div class="flex justify-between items-start">
            <span class="text-xs font-bold uppercase tracking-wider text-rose-100/90">Stok Kritis (<15)</span>
            <div class="p-2 rounded-lg bg-white/20 backdrop-blur-sm font-bold shrink-0 text-white flex items-center justify-center border border-white/10">
                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                </svg>
            </div>
        </div>
        <div class="mt-4">
            <h3 class="text-2xl lg:text-3xl font-extrabold text-white break-words">{{ $criticalStockCount }} Produk</h3>
            <p class="text-xs font-medium text-rose-100/80 mt-1">Varian air butuh restock segera</p>
        </div>
    </div>
</div>

<!-- Low Stock Alerts -->
@if($lowStockProducts->count() > 0)
<div class="bg-rose-50 border border-rose-200/60 p-6 rounded-2xl text-rose-800 space-y-4 shadow-sm shadow-rose-500/5">
    <div class="flex items-center space-x-3">
        <div class="w-12 h-12 bg-white rounded-xl border border-rose-200/50 flex items-center justify-center text-rose-600 shadow-sm">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
            </svg>
        </div>
        <div>
            <h3 class="text-lg font-extrabold text-rose-900">Peringatan: Stok Menipis!</h3>
            <p class="text-xs font-semibold text-rose-700/95">Beberapa produk air mineral berada di bawah ambang batas stok aman (15 unit).</p>
        </div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 pt-2">
        @foreach($lowStockProducts as $prod)
        <div class="p-4 bg-white/80 border border-rose-200/40 rounded-xl shadow-sm text-slate-800 flex justify-between items-center">
            <div>
                <h4 class="font-extrabold text-sm text-slate-800">{{ $prod->nama_produk }}</h4>
                <p class="text-xs font-bold text-slate-500 capitalize">{{ $prod->jenis_kemasan }} ({{ $prod->kapasitas }})</p>
            </div>
            <div class="px-3 py-1 bg-rose-500 text-white rounded-lg font-bold text-xs shadow-sm">
                Stok: {{ $prod->stok }}
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

<!-- Status Pengiriman Live (Kanban Style) -->
<div class="bg-white/80 backdrop-blur border border-slate-200/80 p-8 rounded-3xl shadow-sm space-y-6">
    <div class="flex items-center justify-between border-b border-slate-200/80 pb-4">
        <div class="flex items-center space-x-3">
            <div class="p-2.5 rounded-xl bg-gradient-to-tr from-cyan-500 to-cyan-400 text-white shadow-sm shadow-cyan-500/10 shrink-0 inline-flex items-center justify-center">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.129-1.125V11.25c0-.447-.267-.852-.68-1.01l-2.902-1.09A1.125 1.125 0 0 0 17.25 9.75H13.5v9M13.5 9v11.25m-10.5-6h10.5" />
                </svg>
            </div>
            <h3 class="text-xl font-extrabold text-slate-800">Status Pengiriman Live (Kanban Control Center)</h3>
        </div>
        <span class="text-xs font-bold uppercase bg-gradient-to-tr from-yellow-400 to-yellow-300 px-3 py-1.5 rounded-lg shadow-sm shadow-yellow-400/10 text-slate-800">
            Drag & Drop / Klik Cepat
        </span>
    </div>

    <!-- Kanban Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <!-- Column: Menunggu -->
        <div class="kanban-column flex flex-col bg-slate-50/50 backdrop-blur-sm border border-slate-200/80 rounded-2xl p-4 min-h-[550px] transition-all shadow-sm" data-status="menunggu" ondragover="allowDrop(event)" ondrop="handleDrop(event, 'menunggu')">
            <div class="flex justify-between items-center mb-4 pb-2 border-b border-slate-200">
                <h4 class="font-bold text-xs text-slate-700 flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-slate-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <span>Menunggu</span>
                </h4>
                <span class="px-2 py-0.5 bg-slate-200/80 text-slate-600 rounded-md text-[10px] font-bold">{{ $menungguShipments->count() }}</span>
            </div>
            
            <div class="space-y-4 flex-1">
                @foreach($menungguShipments as $ship)
                    @include('admin.partials.kanban_card', ['ship' => $ship])
                @endforeach
            </div>
        </div>

        <!-- Column: Diproses -->
        <div class="kanban-column flex flex-col bg-slate-50/50 backdrop-blur-sm border border-slate-200/80 rounded-2xl p-4 min-h-[550px] transition-all shadow-sm" data-status="diproses" ondragover="allowDrop(event)" ondrop="handleDrop(event, 'diproses')">
            <div class="flex justify-between items-center mb-4 pb-2 border-b border-slate-200">
                <h4 class="font-bold text-xs text-slate-700 flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-slate-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.43l-1.003.828c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.43l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.752-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    <span>Proses (Assigned)</span>
                </h4>
                <span class="px-2 py-0.5 bg-slate-200/80 text-slate-600 rounded-md text-[10px] font-bold">{{ $diprosesShipments->count() }}</span>
            </div>
            
            <div class="space-y-4 flex-1">
                @foreach($diprosesShipments as $ship)
                    @include('admin.partials.kanban_card', ['ship' => $ship])
                @endforeach
            </div>
        </div>

        <!-- Column: Di Jalan -->
        <div class="kanban-column flex flex-col bg-slate-50/50 backdrop-blur-sm border border-slate-200/80 rounded-2xl p-4 min-h-[550px] transition-all shadow-sm" data-status="dijalan" ondragover="allowDrop(event)" ondrop="handleDrop(event, 'dijalan')">
            <div class="flex justify-between items-center mb-4 pb-2 border-b border-slate-200">
                <h4 class="font-bold text-xs text-slate-700 flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-slate-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                    </svg>
                    <span>Jalan (Transit)</span>
                </h4>
                <span class="px-2 py-0.5 bg-slate-200/80 text-slate-600 rounded-md text-[10px] font-bold">{{ $dijalanShipments->count() }}</span>
            </div>
            
            <div class="space-y-4 flex-1">
                @foreach($dijalanShipments as $ship)
                    @include('admin.partials.kanban_card', ['ship' => $ship])
                @endforeach
            </div>
        </div>

        <!-- Column: Selesai -->
        <div class="kanban-column flex flex-col bg-slate-50/50 backdrop-blur-sm border border-slate-200/80 rounded-2xl p-4 min-h-[550px] transition-all shadow-sm" data-status="selesai" ondragover="allowDrop(event)" ondrop="handleDrop(event, 'selesai')">
            <div class="flex justify-between items-center mb-4 pb-2 border-b border-slate-200">
                <h4 class="font-bold text-xs text-slate-700 flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-slate-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <span>Tiba (Selesai)</span>
                </h4>
                <span class="px-2 py-0.5 bg-slate-200/80 text-slate-600 rounded-md text-[10px] font-bold">{{ $selesaiShipments->count() }}</span>
            </div>
            
            <div class="space-y-4 flex-1">
                @foreach($selesaiShipments as $ship)
                    @include('admin.partials.kanban_card', ['ship' => $ship])
                @endforeach
            </div>
        </div>

    </div>
</div>

<!-- Drag and Drop Styles & Scripts -->
<style>
    .kanban-column.drag-over {
        border-color: #facc15 !important;
        background-color: rgba(250, 204, 21, 0.08) !important;
    }
</style>

<script>
    let draggedCardId = null;

    function handleDragStart(e, id) {
        draggedCardId = id;
        e.dataTransfer.setData('text/plain', id);
        e.dataTransfer.effectAllowed = 'move';
    }

    function allowDrop(e) {
        e.preventDefault();
        e.currentTarget.classList.add('drag-over');
    }

    document.querySelectorAll('.kanban-column').forEach(col => {
        col.addEventListener('dragleave', function() {
            this.classList.remove('drag-over');
        });
    });

    function handleDrop(e, targetStatus) {
        e.preventDefault();
        const column = e.currentTarget;
        column.classList.remove('drag-over');
        
        const id = draggedCardId;
        if (!id) return;
        
        if (targetStatus === 'menunggu') {
            updateKanban(id, { id_kurir: null, status_pengiriman: 'dijadwalkan' });
        } else if (targetStatus === 'diproses') {
            const card = document.getElementById('ship-card-' + id);
            const selectEl = card.querySelector('select');
            if (selectEl) {
                alert('Silakan pilih staff kurir pada dropdown kartu untuk memproses pengiriman!');
            } else {
                updateKanban(id, { status_pengiriman: 'dijadwalkan' });
            }
        } else if (targetStatus === 'dijalan') {
            updateKanban(id, { status_pengiriman: 'dalam perjalanan' });
        } else if (targetStatus === 'selesai') {
            updateKanban(id, { status_pengiriman: 'terkirim' });
        }
    }

    function assignCourier(id, courierId) {
        if (!courierId) return;
        updateKanban(id, { id_kurir: courierId, status_pengiriman: 'dijadwalkan' });
    }

    function updateStatus(id, status) {
        updateKanban(id, { status_pengiriman: status });
    }

    function updateKanban(id, data) {
        fetch(`/admin/pengiriman/${id}/quick-update`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(data)
        })
        .then(res => res.json())
        .then(result => {
            if (result.success) {
                window.location.reload();
            } else {
                alert('Gagal memperbarui status pengiriman: ' + (result.error || 'Terjadi kesalahan'));
            }
        })
        .catch(err => {
            console.error(err);
            alert('Gagal memperbarui status pengiriman');
        });
    }
</script>
@endsection
