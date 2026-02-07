@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    {{-- Charts --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <div class="bg-white rounded shadow p-5 h-[350px]">
            <h3 class="font-semibold mb-4">📊 Mahasiswa per Tahun</h3>
            <canvas id="barChart"></canvas>
        </div>

        <div class="bg-white rounded shadow p-5 h-[350px]">
            <h3 class="font-semibold mb-4">📈 Trend Mahasiswa Masuk</h3>
            <canvas id="lineChart"></canvas>
        </div>
    </div>

    <form method="GET" class="mb-6">
        <select name="tahun" onchange="this.form.submit()" class="border rounded px-3 py-2 w-48">
            <option value="">Semua Tahun</option>
            @foreach ($tahunList as $th)
                <option value="{{ $th }}" {{ $tahun == $th ? 'selected' : '' }}>
                    {{ $th }}
                </option>
            @endforeach
        </select>
    </form>


    {{-- Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white p-5 rounded shadow">
            <div class="text-gray-500 text-sm">Total Mahasiswa</div>
            <div class="text-3xl font-bold text-blue-600">{{ $total }}</div>
        </div>

        <div class="bg-white p-5 rounded shadow">
            <div class="text-gray-500 text-sm">Laki-laki</div>
            <div class="text-3xl font-bold text-green-600">{{ $laki }}</div>
        </div>

        <div class="bg-white p-5 rounded shadow">
            <div class="text-gray-500 text-sm">Perempuan</div>
            <div class="text-3xl font-bold text-pink-600">{{ $perempuan }}</div>
        </div>

        <div class="bg-white p-5 rounded shadow">
            <div class="text-gray-500 text-sm">Rasio</div>
            <div class="text-lg font-semibold">
                {{ $laki }} : {{ $perempuan }}
            </div>
        </div>
    </div>

    {{-- Mahasiswa Terbaru --}}
    <div class="bg-white rounded shadow p-5">
        <h3 class="font-semibold text-gray-700 mb-4">Mahasiswa Terbaru</h3>

        <table class="w-full border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border">Nama</th>
                    <th class="p-2 border">NIM</th>
                    <th class="p-2 border">Prodi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($terbaru as $mhs)
                    <tr>
                        <td class="p-2 border">{{ $mhs->nama }}</td>
                        <td class="p-2 border">{{ $mhs->nim }}</td>
                        <td class="p-2 border">{{ $mhs->prodi }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="p-2 text-center text-gray-500">
                            Belum ada data
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="bg-white rounded shadow p-5 mb-8">
        <h3 class="font-semibold mb-4">Statistik Mahasiswa per Prodi</h3>

        <table class="w-full border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border">Prodi</th>
                    <th class="p-2 border">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($perProdi as $row)
                    <tr>
                        <td class="p-2 border">{{ $row->prodi }}</td>
                        <td class="p-2 border">{{ $row->total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const labels = @json($chartLabels);
                const dataTotals = @json($chartData);

                if (labels.length === 0) return;

                new Chart(document.getElementById('barChart'), {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Jumlah Mahasiswa',
                            data: dataTotals,
                            backgroundColor: '#3b82f6'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true
                    }
                });

                new Chart(document.getElementById('lineChart'), {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Trend Mahasiswa Masuk',
                            data: dataTotals,
                            borderColor: '#10b981',
                            tension: 0.4,
                            fill: false
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true
                    }
                });
            });
        </script>
    @endpush
@endsection
