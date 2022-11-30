<x-app-layout>
    <x-guest-layout>
        <x-auth-card>
            <x-slot name="logo">
                <p class="font-semibold text-xl text-gray-800">
                    {{ __('😊 TAMBAH KOLEKSI 😊') }}
                </p>
            </x-slot>
            <form method="POST" action="{{ route('koleksiStore') }}">
                @csrf

                <!-- Nama -->
                <div class="mt-4">
                    <x-input-label for="namaKoleksi" :value="__('Nama Koleksi')" />
                    <x-text-input  id="namaKoleksi" class="block mt-1 w-full" type="text" name="namaKoleksi" :value="old('namaKoleksi')" required />
                    <x-input-error :messages="$errors->get('namaKoleksi')" class="mt-2" />
                </div>

                <!-- Jenis -->
                <div class="mt-4">
                    <x-input-label for="jenisKoleksi" :value="__('Jenis Koleksi')" />
                    <select id="jenisKoleksi" type="number" name="jenisKoleksi" :value="old('jenisKoleksi')" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option selected>Select Type</option>
                        <option value="1">Buku</option>
                        <option value="2">Majalah</option>
                        <option value="3">Cakram Digital</option>
                    </select>
                    <x-input-error :messages="$errors->get('jenisKoleksi')" class="mt-2" />
                </div>

                <!-- Jumlah -->
                <div class="mt-4">
                    <x-input-label for="jumlahKoleksi" :value="__('Jumlah Koleksi')" />
                    <x-text-input datepicker id="jumlahKoleksi" class="block mt-1 w-full" type="number" name="jumlahKoleksi" :value="old('jumlahKoleksi')" required />

                    <x-input-error :messages="$errors->get('jumlahKoleksi')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ml-4" type="submit">
                        {{ __('Submit') }}
                    </x-primary-button>

                    <x-danger-button class="ml-4" type="reset">
                        {{ __('Reset') }}
                    </x-danger-button>
                </div>
            </form>
        </x-auth-card>
    </x-guest-layout>
</x-app-layout>
