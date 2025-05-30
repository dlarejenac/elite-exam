@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('dashboard')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Admin Dashboard</h1>

        <div class="flex flex-wrap gap-4 mb-8">
            <button id="btnTotalAlbums" type="button" class="btn btn-primary">Total Albums Sold Per Artist</button>
            <button id="btnCombinedSales" type="button" class="btn btn-secondary">Combined Album Sales Per Artist</button>
            <button id="btnTopArtist" type="button" class="btn btn-success">Top Artist By Sales</button>
            <button id="btnTopAlbumsYear" type="button" class="btn btn-info">Top 10 Albums Per Year</button>
        </div>

        <div id="dashboardOutput" class="bg-white shadow-md rounded-lg p-6 min-h-[200px]">
            <p class="text-gray-500">Click a button above to load data.</p>
        </div>
    </div>

<script>
    const output = document.getElementById('dashboardOutput');

    function showLoading() {
        output.innerHTML = `
            <div role="status" class="flex items-center space-x-2">
                <svg aria-hidden="true" class="w-6 h-6 text-blue-600 animate-spin" viewBox="0 0 100 101" fill="none">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908Z" fill="#E5E7EB"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5536C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7236 75.2124 7.41289C69.5422 4.10215 63.2754 1.94025 56.7223 1.05197C51.7661 0.367031 46.7651 0.446862 41.8674 1.27873C39.4319 1.69328 37.9506 4.19778 38.5887 6.62326C39.2268 9.04874 41.6919 10.4717 44.1255 10.1071C47.8517 9.53398 51.6557 9.49979 55.4003 10.0086C60.8646 10.7506 66.1385 12.5457 70.9057 15.2738C75.6729 18.002 79.8394 21.6205 83.2114 25.841C85.4977 28.6929 87.2619 31.9446 88.4338 35.4748C89.1309 37.7512 91.5423 38.6781 93.9676 39.0409Z" fill="currentColor"/>
                </svg>
                <span>Loading...</span>
            </div>`;
    }

    document.getElementById('btnTotalAlbums').addEventListener('click', () => {
        showLoading();
        fetch("{{ route('admin.dashboard.totalAlbums') }}")
            .then(res => res.json())
            .then(data => {
                let html = '<h3 class="text-xl font-semibold mb-4">Total Albums Sold Per Artist</h3><ul class="list-disc pl-5 space-y-1">';
                data.forEach(item => {
                    html += `<li><strong>${item.artist}</strong>: ${item.total_albums} albums</li>`;
                });
                html += '</ul>';
                output.innerHTML = html;
            })
            .catch(() => {
                output.innerHTML = '<p class="text-red-600 font-semibold">Error loading data.</p>';
            });
    });

    document.getElementById('btnCombinedSales').addEventListener('click', () => {
        showLoading();
        fetch("{{ route('admin.dashboard.combinedSales') }}")
            .then(res => res.json())
            .then(data => {
                let html = '<h3 class="text-xl font-semibold mb-4">Combined Album Sales Per Artist</h3><ul class="list-disc pl-5 space-y-1">';
                data.forEach(item => {
                    html += `<li><strong>${item.artist}</strong>: ${item.combined_sales} sales</li>`;
                });
                html += '</ul>';
                output.innerHTML = html;
            })
            .catch(() => {
                output.innerHTML = '<p class="text-red-600 font-semibold">Error loading data.</p>';
            });
    });

    document.getElementById('btnTopArtist').addEventListener('click', () => {
        showLoading();
        fetch("{{ route('admin.dashboard.topArtist') }}")
            .then(res => res.json())
            .then(data => {
                if (data) {
                    output.innerHTML = `
                        <h3 class="text-xl font-semibold mb-4">Top Artist By Combined Sales</h3>
                        <p><strong>${data.artist}</strong> with <strong>${data.combined_sales}</strong> combined sales</p>
                    `;
                } else {
                    output.innerHTML = '<p class="text-gray-600">No data available.</p>';
                }
            })
            .catch(() => {
                output.innerHTML = '<p class="text-red-600 font-semibold">Error loading data.</p>';
            });
    });

    document.getElementById('btnTopAlbumsYear').addEventListener('click', () => {
        showLoading();
        fetch("{{ route('admin.dashboard.topAlbumsYear') }}")
            .then(res => res.json())
            .then(data => {
                let html = '<h3 class="text-xl font-semibold mb-4">Top 10 Albums Per Year</h3>';
                for (const [year, albums] of Object.entries(data)) {
                    html += `<h4 class="text-lg font-semibold mt-4 mb-2">Year ${year}</h4><ol class="list-decimal pl-5 space-y-1">`;
                    albums.forEach(album => {
                        html += `<li><strong>${album.name}</strong> by ${album.artist_name} - Sales: ${album.sales}</li>`;
                    });
                    html += '</ol>';
                }
                output.innerHTML = html;
            })
            .catch(() => {
                output.innerHTML = '<p class="text-red-600 font-semibold">Error loading data.</p>';
            });
    });
</script>
@endsection