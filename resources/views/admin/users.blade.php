@extends('layouts.admin')

@section('title', 'Kelola User')

@section('content')
    <div class="bg-white rounded-2xl border border-line p-6" x-data="{ showModal: false, isEdit: false, user: { id: '', name: '', email: '' } }">
        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <h2 class="font-display text-lg text-charcoal-900">Daftar Pengguna</h2>
            <button @click="isEdit = false; user = {name: '', email: ''}; showModal = true"
                class="bg-olive-700 text-white px-4 py-2 rounded-xl text-sm font-medium hover:bg-olive-800 transition">
                Tambah User
            </button>
        </div>

        {{-- Tabel User --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-charcoal-900/50 text-xs uppercase tracking-wide">
                        <th class="px-6 py-3 font-medium">Nama</th>
                        <th class="px-6 py-3 font-medium">Email</th>
                        <th class="px-6 py-3 font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-line">
                    @foreach ($users as $u)
                        <tr class="hover:bg-stone-50">
                            <td class="px-6 py-4 text-charcoal-900">{{ $u->name }}</td>
                            <td class="px-6 py-4 text-charcoal-900/80">{{ $u->email }}</td>
                            <td class="px-6 py-4 flex items-center gap-3">
                                {{-- Tombol Edit --}}
                                <button @click="isEdit = true; user = {{ $u }}; showModal = true"
                                    class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 transition">
                                    <i class="fa-solid fa-pen text-xs"></i>
                                </button>

                                {{-- Tombol Hapus dengan SweetAlert --}}
                                <form id="delete-form-{{ $u->id }}"
                                    action="{{ route('admin.users.destroy', $u->id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="button" onclick="confirmDelete('{{ $u->id }}')"
                                        class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition">
                                        <i class="fa-solid fa-trash text-xs"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Modal Form --}}
        <div x-show="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-charcoal-900/50 p-4" x-cloak>
            <div class="bg-white rounded-2xl w-full max-w-md p-6 shadow-xl" @click.away="showModal = false">
                <h3 class="font-display text-lg text-charcoal-900 mb-4" x-text="isEdit ? 'Edit User' : 'Tambah User'"></h3>

                <form :action="isEdit ? '/admin/users/' + user.id : '{{ route('admin.users.store') }}'" method="POST">
                    @csrf
                    <template x-if="isEdit"><input type="hidden" name="_method" value="PUT"></template>

                    <div class="space-y-4">
                        {{-- Input Nama --}}
                        <div>
                            <label class="block text-xs text-charcoal-900/60 mb-1">Nama</label>
                            <input type="text" name="name" x-model="user.name" required
                                class="w-full border border-line rounded-xl px-4 py-2.5 outline-none focus:ring-2 focus:ring-olive-600/20">
                        </div>

                        {{-- Input Email --}}
                        <div>
                            <label class="block text-xs text-charcoal-900/60 mb-1">Email</label>
                            <input type="email" name="email" x-model="user.email" required
                                class="w-full border border-line rounded-xl px-4 py-2.5 outline-none focus:ring-2 focus:ring-olive-600/20">
                        </div>

                        {{-- Input Password dengan Hide/Show Toggle --}}
                        <div>
                            <label class="block text-xs text-charcoal-900/60 mb-1">Password</label>
                            <div class="relative" x-data="{ showPassword: false }">
                                <input :type="showPassword ? 'text' : 'password'" name="password" placeholder="********"
                                    class="w-full border border-line rounded-xl pl-4 pr-10 py-2.5 outline-none focus:ring-2 focus:ring-olive-600/20">

                                <button type="button" @click="showPassword = !showPassword"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-charcoal-900/40 hover:text-charcoal-900/70 transition">
                                    <i class="fa-solid text-xs" :class="showPassword ? 'fa-eye-slash' : 'fa-eye'"></i>
                                </button>
                            </div>
                            <small class="text-[10px] text-charcoal-900/40 block mt-1" x-show="isEdit">
                                Kosongkan jika tidak ingin mengubah password
                            </small>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 mt-6">
                        <button type="button" @click="showModal = false"
                            class="px-4 py-2 text-sm text-charcoal-900 hover:text-charcoal-900/70">Batal</button>
                        <button type="submit"
                            class="px-6 py-2 bg-olive-700 text-white rounded-xl text-sm hover:bg-olive-800">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Script CDN Alpine.js & SweetAlert2 --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Script Trigger SweetAlert --}}
    <script>
        function confirmDelete(userId) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data user ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3f6212', // Menyesuaikan warna olive-850/700
                cancelButtonColor: '#ef4444', // Merah Tailwind
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                customClass: {
                    popup: 'rounded-2xl',
                    confirmButton: 'rounded-xl px-4 py-2 font-medium',
                    cancelButton: 'rounded-xl px-4 py-2 font-medium'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + userId).submit();
                }
            });
        }
    </script>
@endsection
