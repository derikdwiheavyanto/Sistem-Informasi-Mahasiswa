@extends('layouts.app')
@section('title', 'Edit Mahasiswa')
@section('content')
    <div class="max-w-6xl mx-auto">

        {{-- Header --}}
        <div class="mb-6">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">
                ✏️ Edit Mahasiswa
            </h2>
            <p class="text-gray-500 mt-1">
                Perbarui data mahasiswa dengan benar
            </p>
        </div>

        {{-- Card --}}
        <div class="bg-white rounded-xl shadow-md border border-gray-100">

            <form action="/mahasiswa/{{ $mahasiswa->id }}" method="POST" class="p-6 sm:p-8">
                @csrf
                @method('PUT')

                {{-- Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- NIM --}}
                    <div>
                        <label class="block mb-1 font-medium text-gray-600">NIM</label>
                        <input type="text" name="nim" value="{{ old('nim', $mahasiswa->nim) }}"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            required>
                        @error('nim')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Nama --}}
                    <div>
                        <label class="block mb-1 font-medium text-gray-600">Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ old('nama', $mahasiswa->nama) }}"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            required>
                        @error('nama')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Prodi --}}
                    <div>
                        <label class="block mb-1 font-medium text-gray-600">Program Studi</label>
                        <select name="prodi"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            required>
                            <option value="Teknik Informatika"
                                {{ $mahasiswa->prodi == 'Teknik Informatika' ? 'selected' : '' }}>
                                Teknik Informatika
                            </option>
                            <option value="Teknik Geomatika"
                                {{ $mahasiswa->prodi == 'Teknik Geomatika' ? 'selected' : '' }}>
                                Teknik Geomatika
                            </option>
                            <option value="Teknik Sipil" {{ $mahasiswa->prodi == 'Teknik Sipil' ? 'selected' : '' }}>
                                Teknik Sipil
                            </option>
                        </select>
                        @error('prodi')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div>
                        <label class="block mb-1 font-medium text-gray-600">Jenis Kelamin</label>
                        <select name="sex"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            required>
                            <option value="L" {{ $mahasiswa->sex == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ $mahasiswa->sex == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('sex')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tanggal Masuk --}}
                    <div>
                        <label class="block mb-1 font-medium text-gray-600">Tanggal Masuk</label>
                        <input type="date" name="tanggal_masuk"
                            value="{{ old('tanggal_masuk', $mahasiswa->tanggal_masuk) }}"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            required>
                        @error('tanggal_masuk')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                {{-- Divider --}}
                <div class="border-t my-8"></div>

                {{-- Action --}}
                <div class="flex flex-col sm:flex-row justify-end gap-3">
                    <a href="/"
                        class="px-6 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100 transition text-center">
                        Batal
                    </a>

                    <button type="submit"
                        class="px-6 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition shadow">
                        🔄 Update Data
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection
