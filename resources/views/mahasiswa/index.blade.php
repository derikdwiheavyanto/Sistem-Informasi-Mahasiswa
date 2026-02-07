@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">📚 Data Mahasiswa</h2>
                <p class="text-gray-500 text-sm">Kelola data mahasiswa aktif</p>
            </div>

            <a href="/mahasiswa/create"
                class="inline-flex items-center gap-2 bg-blue-600 text-white px-5 py-2 rounded-lg shadow hover:bg-blue-700 transition">
                ➕ Tambah Mahasiswa
            </a>
        </div>

        {{-- Card --}}
        <div class="bg-white rounded-xl shadow-md border border-gray-100 p-5 sm:p-6">

            {{-- Search --}}
            <form method="GET" action="/" class="flex flex-col sm:flex-row gap-3 mb-5">
                <input type="text" name="search" value="{{ $search }}"
                    placeholder="🔍 Cari nama, NIM, atau prodi..."
                    class="border border-gray-300 rounded-lg px-4 py-2 w-full sm:w-72 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                <div class="flex gap-2">
                    <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                        Cari
                    </button>

                    @if ($search)
                        <a href="/" class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100 transition">
                            Reset
                        </a>
                    @endif
                </div>
            </form>

            {{-- Table --}}
            <div class="relative overflow-x-auto rounded-lg border border-gray-200">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                        <tr>
                            <th class="p-3 text-left">No</th>
                            <th class="p-3 text-left">Nama</th>
                            <th class="p-3 text-left">NIM</th>
                            <th class="p-3 text-left">Prodi</th>
                            <th class="p-3 text-left">Sex</th>
                            <th class="p-3 text-left">Tgl Masuk</th>
                            <th class="p-3 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">
                        @forelse ($mahasiswas as $index => $mhs)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-3">
                                    {{ $mahasiswas->firstItem() + $index }}
                                </td>
                                <td class="p-3 font-medium text-gray-800">
                                    {{ $mhs->nama }}
                                </td>
                                <td class="p-3 text-gray-600">
                                    {{ $mhs->nim }}
                                </td>
                                <td class="p-3">
                                    <span class="px-2 py-1 rounded bg-blue-100 text-blue-700 text-xs">
                                        {{ $mhs->prodi }}
                                    </span>
                                </td>
                                <td class="p-3">
                                    @if ($mhs->sex == 'L')
                                        <span class="px-2 py-1 rounded bg-green-100 text-green-700 text-xs">
                                            Laki-laki
                                        </span>
                                    @else
                                        <span class="px-2 py-1 rounded bg-pink-100 text-pink-700 text-xs">
                                            Perempuan
                                        </span>
                                    @endif
                                </td>
                                <td class="p-3 text-gray-600">
                                    {{ \Carbon\Carbon::parse($mhs->tanggal_masuk)->format('d M Y') }}
                                </td>
                                <td class="p-3 text-center space-x-3 whitespace-nowrap">
                                    <a href="/mahasiswa/{{ $mhs->id }}/edit"
                                        class="text-blue-600 hover:underline font-medium">
                                        Edit
                                    </a>

                                    <form action="/mahasiswa/{{ $mhs->id }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn-delete text-red-600 hover:underline font-medium">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="p-6 text-center text-gray-500">
                                    😴 Data mahasiswa belum tersedia
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $mahasiswas->links() }}
            </div>

        </div>
    </div>
@endsection
