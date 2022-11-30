<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('transaksiTambah') }}" class="inline-flex items-center mb-4 px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Tambah Transaksi
                    </a>
                    <table class="table table-striped w-full mt-4" id="datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Peminjam</th>
                                <th>Petugas</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Selesai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable').DataTable({
            ajax:'{{ route("getAllTransaction") }}',
            serverSide: false,
            processing: true,
            deferRender: true,
            type: 'GET',
            destroy: true,
            columns: [
                {data: 'id', name: 'id'},
                {data: 'peminjam', name: 'peminjam'},
                {data: 'petugas', name: 'petugas'},
                {data: 'tanggalPinjam', name: 'tanggalPinjam'},
                {data: 'tanggalSelesai', name: 'tanggalSelesai'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    });
</script>
