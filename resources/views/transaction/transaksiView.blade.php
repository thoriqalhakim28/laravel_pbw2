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
                    <div class="flex gap-2 mb-4">
                        <div>
                            <x-input-label for="peminjam" :value="__('Peminjam')" />
                            <x-text-input id="peminjam" class="block mt-1 w-full" type="text" name="peminjam" value="{{$transaction->fullnamePeminjam}}" readonly/>
                        </div>
                        <div>
                            <x-input-label for="koleksi3" :value="__('Petugas')" />
                            <x-text-input id="petugas" class="block mt-1 w-full" type="text" name="petugas" value="{{$transaction->fullnamePetugas}}" readonly/>
                        </div>
                    </div>
                    <table class="table table-striped w-full mt-4" id="datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Petugas</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Selesai</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable').DataTable({
            ajax:'{{ route("getAllDetailTransactions", $transaction->id ) }}',
            serverSide: false,
            processing: true,
            deferRender: true,
            type: 'GET',
            destroy: true,
            columns: [
                {data: 'id', name: 'id'},
                {data: 'koleksi', name: 'koleksi'},
                {data: 'tanggalPinjam', name: 'tanggalPinjam'},
                {data: 'tanggalKembali', name: 'tanggalKembali'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action'}
            ]
        });
    });
</script>
