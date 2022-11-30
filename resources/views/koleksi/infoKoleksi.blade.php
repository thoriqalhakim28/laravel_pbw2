<x-app-layout>
    <x-guest-layout>
        <x-auth-card>
            <x-slot name="logo">
                <p class="font-semibold text-2xl text-gray-800 leading-tight">
                    {{ __('😊 Edit Koleksi 😊') }}
                </p>
            </x-slot>
            <form method="POST" action="{{ route('koleksiUpdate', $collection->id)}}">
                @csrf
                @method('put')

                <!-- Id Koleksi -->
                <div class="mt-4">
                    <x-input-label for="id" :value="__('Id Koleksi')" />
                    <x-text-input  id="id" class="block mt-1 w-full" type="text" name="id" value="{{$collection->id}}" readonly />
                    <x-input-error :messages="$errors->get('id')" class="mt-2" />
                </div>

                <!-- Judul Koleksi -->
                <div class="mt-4">
                    <x-input-label for="nama" :value="__('Judul Koleksi')" />
                    <x-text-input  id="nama" class="block mt-1 w-full" type="text" name="nama" value="{{$collection->namaKoleksi}}" readonly />
                    <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                </div>

                <!-- Jenis Koleksi -->
                <div class="mt-4">
                    <x-input-label for="jenisKoleksi" :value="__('Jenis Koleksi')" />
                    <select id="jenisKoleksi" name='jenisKoleksi' value="{{$collection->jenisKoleksi}}" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="1" @if(old('jenis', $collection->jenis) == 1) selected @endif>Buku</option>
                        <option value="2" @if(old('jenis', $collection->jenis) == 2) selected @endif>Majalah</option>
                        <option value="3" @if(old('jenis', $collection->jenis) == 3) selected @endif>Cakram Digital</option>
                    </select>
                    <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                </div>

                <!-- Jumlah Awal -->
                <div class="mt-4">
                    <x-input-label for="jumlahAwal" :value="__('Jumlah Awal')" />
                    <x-text-input  id="jumlahAwal" class="block mt-1 w-full" type="text" name="jumlahAwal" value="{{$collection->jumlahKoleksi}}" readonly />
                    <x-input-error :messages="$errors->get('jumlahAwal')" class="mt-2" />
                </div>

                <!-- Jumlah Sisa -->
                <div class="mt-4">
                    <x-input-label for="jumlahSisa" :value="__('Jumlah Sisa')" />
                    <x-text-input  id="jumlahSisa" class="block mt-1 w-full" type="text" name="jumlahSisa" :value="old('jumlahSisa')" required />
                    <x-input-error :messages="$errors->get('jumlahSisa')" class="mt-2" />
                </div>

                <!-- Jumlah Keluar -->
                <div class="mt-4">
                    <x-input-label for="jumlahKeluar" :value="__('Jumlah Keluar')" />
                    <x-text-input  id="jumlahKeluar" class="block mt-1 w-full" type="text" name="jumlahKeluar" :value="old('jumlahKeluar')" required />
                    <x-input-error :messages="$errors->get('jumlahKeluar')" class="mt-2" />
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
