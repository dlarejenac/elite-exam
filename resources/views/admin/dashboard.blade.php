@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('dashboard')
<div class="max-w-5xl mx-auto p-8 bg-gray-50 rounded-lg shadow-lg">
    <form method="POST" action="{{ route('admin.logout') }}" class="absolute top-5 right-5">
        @csrf
        <button type="submit"
            class="inline-flex items-center justify-center rounded-lg border border-yellow-600 bg-yellow-600 px-4 py-2 text-sm font-medium text-white hover:bg-yellow-700 focus:ring-4 focus:ring-yellow-300 transition">
            Logout
        </button>
    </form>

    <h2 class="text-4xl font-extrabold text-indigo-700 mb-10 text-center">Dashboard</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
        <button id="btnTotalAlbumsSold" type="button" 
            class="inline-flex items-center justify-center rounded-lg border border-indigo-600 bg-indigo-600 px-5 py-3 text-sm font-medium text-white hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 transition">
            Total Albums Sold per Artist
        </button>
        <button id="btnCombinedSales" type="button" 
            class="inline-flex items-center justify-center rounded-lg border border-indigo-600 bg-indigo-600 px-5 py-3 text-sm font-medium text-white hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 transition">
            Combined Album Sales per Artist
        </button>
        <button id="btnTopArtist" type="button" 
            class="inline-flex items-center justify-center rounded-lg border border-indigo-600 bg-indigo-600 px-5 py-3 text-sm font-medium text-white hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 transition">
            Top 1 Artist by Combined Sales
        </button>
        <button id="btnTopAlbumsYear" type="button" 
            class="inline-flex items-center justify-center rounded-lg border border-indigo-600 bg-indigo-600 px-5 py-3 text-sm font-medium text-white hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 transition">
            Top 10 Albums per Year by Sales
        </button>
        <a href="{{ route('albums.index') }}" 
            class="inline-flex items-center justify-center rounded-lg border border-indigo-600 bg-indigo-600 px-5 py-3 text-sm font-medium text-white hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 transition text-center">
            Go to Albums
        </a>
        <a href="{{ route('artists.index') }}" 
            class="inline-flex items-center justify-center rounded-lg border border-indigo-600 bg-indigo-600 px-5 py-3 text-sm font-medium text-white hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 transition text-center">
            Go to Artists
        </a>
    </div>

    <form id="searchForm" class="flex flex-col md:flex-row items-center gap-4 mb-8" onsubmit="event.preventDefault(); document.getElementById('btnSearchAlbums').click();">
        <label for="artistSearch" class="sr-only">Search artist albums</label>
        <div class="relative w-full md:w-96">
            <input required id="artistSearch" name="artistSearch" type="text" placeholder="Search artist albums..." 
                class="block w-full rounded-lg border border-gray-300 bg-white py-3 px-4 pr-12 text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 sm:text-sm" />
            <svg aria-hidden="true" class="absolute right-3 top-3 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" 
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 18a7.5 7.5 0 006.15-3.35z"></path>
            </svg>
        </div>
        <button id="btnSearchAlbums" type="button" 
            class="rounded-lg bg-indigo-600 px-6 py-3 text-sm font-semibold text-white hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 transition">
            Search Albums
        </button>
    </form>

    <div id="result" class="overflow-x-auto">
        <p class="text-center text-gray-400 select-none">Click a button or search to display data here.</p>
    </div>

</div>

<script>
    function renderTable(headers, rows, rowsPerPage = 10) {
        let currentPage = 1;
        const totalPages = Math.ceil(rows.length / rowsPerPage);

        const resultDiv = document.getElementById('result');
        resultDiv.innerHTML = ''; 

        const container = document.createElement('div');

        const table = document.createElement('table');
        table.className = "w-full text-sm text-left text-gray-500";

        const thead = document.createElement('thead');
        thead.className = "text-xs text-gray-700 uppercase bg-gray-50";
        const headRow = document.createElement('tr');

        headers.forEach(header => {
            const th = document.createElement('th');
            th.scope = "col";
            th.className = "px-6 py-3";
            th.textContent = header;
            headRow.appendChild(th);
    });

    thead.appendChild(headRow);
    table.appendChild(thead);

    const tbody = document.createElement('tbody');
    table.appendChild(tbody);

    container.appendChild(table);

    const pagination = document.createElement('div');
    pagination.className = "flex justify-center items-center gap-2 mt-4 text-gray-600";

    function renderPage(page) {
        tbody.innerHTML = '';
        const start = (page - 1) * rowsPerPage;
        const end = Math.min(start + rowsPerPage, rows.length);
        const pageRows = rows.slice(start, end);

        pageRows.forEach(row => {
            const tr = document.createElement('tr');
            tr.className = "bg-white border-b hover:bg-gray-50";

            headers.forEach(header => {
                const td = document.createElement('td');
                td.className = "px-6 py-4";
                td.textContent = row[header.toLowerCase().replace(/ /g, '_')] ?? '';
                tr.appendChild(td);
            });

            tbody.appendChild(tr);
        });
    }

    function renderPagination() {
        pagination.innerHTML = '';

        const prevBtn = document.createElement('button');
        prevBtn.textContent = 'Prev';
        prevBtn.disabled = currentPage === 1;
        prevBtn.className = prevBtn.disabled
            ? 'px-3 py-1 rounded bg-gray-300 cursor-not-allowed'
            : 'px-3 py-1 rounded bg-indigo-600 text-white hover:bg-indigo-700 transition';
        prevBtn.addEventListener('click', () => {
            if (currentPage > 1) {
                currentPage--;
                renderPage(currentPage);
                renderPagination();
            }
        });
        pagination.appendChild(prevBtn);

        const maxPagesToShow = 5;
        let startPage = Math.max(1, currentPage - 2);
        let endPage = Math.min(totalPages, startPage + maxPagesToShow - 1);

        if (endPage - startPage < maxPagesToShow - 1) {
            startPage = Math.max(1, endPage - maxPagesToShow + 1);
        }

        for (let i = startPage; i <= endPage; i++) {
            const pageBtn = document.createElement('button');
            pageBtn.textContent = i;
            pageBtn.className = (i === currentPage) 
                ? 'px-3 py-1 rounded bg-indigo-700 text-white cursor-default' 
                : 'px-3 py-1 rounded bg-indigo-600 text-white hover:bg-indigo-700 transition';
            if (i !== currentPage) {
                pageBtn.addEventListener('click', () => {
                    currentPage = i;
                    renderPage(currentPage);
                    renderPagination();
                });
            }
            pagination.appendChild(pageBtn);
        }

        const nextBtn = document.createElement('button');
        nextBtn.textContent = 'Next';
        nextBtn.disabled = currentPage === totalPages;
        nextBtn.className = nextBtn.disabled
            ? 'px-3 py-1 rounded bg-gray-300 cursor-not-allowed'
            : 'px-3 py-1 rounded bg-indigo-600 text-white hover:bg-indigo-700 transition';
        nextBtn.addEventListener('click', () => {
            if (currentPage < totalPages) {
                currentPage++;
                renderPage(currentPage);
                renderPagination();
            }
        });
        pagination.appendChild(nextBtn);
    }

        renderPage(currentPage);
        renderPagination();

        resultDiv.appendChild(container);
        resultDiv.appendChild(pagination);
    }


    document.getElementById('btnTotalAlbumsSold').addEventListener('click', () => {
        fetch("{{ route('dashboard.totalAlbumsSold') }}")
        .then(res => res.json())
        .then(data => {
            if (data.length === 0) {
                document.getElementById('result').textContent = 'No data available.';
                return;
            }
            renderTable(['Artist', 'Total Albums'], data.map(item => ({
                artist: item.artist,
                total_albums: item.total_albums
            })));
        });
    });

    document.getElementById('btnCombinedSales').addEventListener('click', () => {
        fetch("{{ route('dashboard.combinedSales') }}")
        .then(res => res.json())
        .then(data => {
            if (data.length === 0) {
                document.getElementById('result').textContent = 'No data available.';
                return;
            }
            renderTable(['Artist', 'Combined Sales'], data.map(item => ({
                artist: item.artist,
                combined_sales: item.combined_sales
            })));
        });
    });

    document.getElementById('btnTopArtist').addEventListener('click', () => {
        fetch("{{ route('dashboard.topArtist') }}")
        .then(res => res.json())
        .then(item => {
            if (!item.artist) {
                document.getElementById('result').textContent = 'No data available.';
                return;
            }
            renderTable(['Artist', 'Combined Sales'], [{
                artist: item.artist,
                combined_sales: item.combined_sales
            }]);
        });
    });

    document.getElementById('btnTopAlbumsYear').addEventListener('click', () => {
        fetch("{{ route('dashboard.topAlbumsYear') }}")
        .then(res => res.json())
        .then(data => {
            if (Object.keys(data).length === 0) {
                document.getElementById('result').textContent = 'No data available.';
                return;
            }
            
            let rows = [];
            Object.entries(data).forEach(([year, value]) => {
                value.top_albums.forEach(album => {
                    rows.push({
                        year: year,
                        album: album.album,
                        artist: album.artist,
                        sales: album.sales
                    });
                });
            });

            renderTable(['Year', 'Album', 'Artist', 'Sales'], rows);
        });
    });

    document.getElementById('btnSearchAlbums').addEventListener('click', () => {
        let artistName = document.getElementById('artistSearch').value.trim();
        if (!artistName) {
            alert('Please enter an artist name');
            return;
        }

        fetch("{{ route('dashboard.searchAlbumsByArtist') }}?artist=" + encodeURIComponent(artistName))
        .then(res => res.json())
        .then(data => {
            if (data.length === 0) {
                document.getElementById('result').textContent = 'No albums found for artist: ' + artistName;
                return;
            }
            renderTable(['Album Name', 'Year', 'Sales'], data.map(album => ({
                'album_name': album.name,
                'year': album.year,
                'sales': album.sales
            })));
        });
    });
</script>
@endsection