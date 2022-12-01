<x-app-layout>
    <x-guest-layout>
        <x-auth-card>
            <x-slot name="logo">
                <a href="/">
                    <p class="font-semibold text-xl text-gray-800 mt-4">
                        {{ __('😊 EDIT DETAIL TRANSACTION 😊') }}
                    </p>
                </a>
            </x-slot>

            <form method="POST" action="{{ route('detailTransactionUpdate') }}">
                @csrf
                @method('PUT')

                <!-- Id Detail Transaction -->
                <div>
                    <x-input-label for="idTransaki" :value="__('Id Transaki')" />
                    <x-text-input id="idTransaki" class="block mt-1 w-full" type="text" name="idTransaki" value="{{$detailTransaction->idTransaksi}}" required autofocus />
                </div>

                <!-- Id Detail Transaction -->
                <div class="mt-4">
                    <x-input-label for="idDetailTransaksi" :value="__('Id Detail Transaksi')" />
                    <x-text-input id="idDetailTransaksi" class="block mt-1 w-full" type="text" name="idDetailTransaksi" value="{{$detailTransaction->id}}" required />
                </div>

                <!-- Peminjam -->
                <div class="mt-4">
                    <x-input-label for="idPeminjam" :value="__('Peminjam')" />
                    <x-text-input id="idPeminjam" class="block mt-1 w-full" type="text" name="idPeminjam" value="{{$detailTransaction->namaPeminjam}}" required />
                </div>

                <!-- Petugas -->
                <div class="mt-4">
                    <x-input-label for="idPetugas" :value="__('Petugas')" />
                    <x-text-input id="idPetugas" class="block mt-1 w-full" type="text" name="idPetugas" value="{{$detailTransaction->namaPetugas}}" required />
                </div>

                <!-- Koleksi -->
                <div class="mt-4">
                    <x-input-label for="koleksi" :value="__('Koleksi')" />
                    <x-text-input id="koleksi" class="block mt-1 w-full" type="text" name="koleksi" value="{{$detailTransaction->koleksi}}" required />
                </div>

                <!-- Status -->
                <div class="mt-4">
                    <x-input-label for="status" :value="__('Status')" />
                    <select id="status" name='status' class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="1" @if (old('status', $detailTransaction->status) == 1) selecetd @endif>Pinjam</option>
                        <option value="2" @if (old('status', $detailTransaction->status) == 2) selecetd @endif>Kembali</option>
                        <option value="3" @if (old('status', $detailTransaction->status) == 3) selecetd @endif>Hilang</option>
                    </select>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ml-4">
                        {{ __('Submit') }}
                    </x-primary-button>

                    <x-danger-button class="ml-4">
                        {{ __('Reset') }}
                    </x-danger-button>
                </div>
            </form>
        </x-auth-card>
    </x-guest-layout>
</x-app-layout>
