<x-app-layout>
    <x-guest-layout>
        <x-auth-card>
            <x-slot name="logo">
                <p class="font-semibold text-xl text-gray-800">
                    {{ __('😊 TAMBAH TRANSAKSI 😊') }}
                </p>
            </x-slot>
            <form method="POST" action="{{ route('transaksiStore') }}">
                @csrf

                <!-- Peminjam -->
                <div class="mt-4">
                    <x-input-label for="userIdPeminjam" :value="__('Peminjam')" />
                    <select id="userIdPeminjam" type="number" name="userIdPeminjam" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="-1">Select Type</option>
                        @foreach ($users as $user)
                        @if($user->id == old('userPeminjam'))
                        <option value="{{$user->id}}" selected>{{$user->fullname}}</option>
                        @else
                        <option value="{{$user->id}}">{{$user->fullname}}</option>
                        @endif
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('userIdPeminjam')" class="mt-2" />
                </div>

                <!-- Koleksi 1 -->
                <div class="mt-4">
                    <x-input-label for="koleksi1" :value="__('Koleksi 1')" />
                    <select id="koleksi1" type="number" name="koleksi1" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="-1">Select Type</option>
                        @foreach ($collections as $collection)
                        @if($collection->id == old('koleksi1'))
                        <option value="{{$collection->id}}" selected>{{$collection->namaKoleksi}}</option>
                        @else
                        <option value="{{$collection->id}}">{{$collection->namaKoleksi}}</option>
                        @endif
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('koleksi1')" class="mt-2" />
                </div>

                <!-- Koleksi 2 -->
                <div class="mt-4">
                    <x-input-label for="koleksi2" :value="__('Koleksi 2')" />
                    <select id="koleksi2" type="number" name="koleksi2"class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="-1">Select Type</option>
                        @foreach ($collections as $collection)
                        @if($collection->id == old('koleksi2'))
                        <option value="{{$collection->id}}" selected>{{$collection->namaKoleksi}}</option>
                        @else
                        <option value="{{$collection->id}}">{{$collection->namaKoleksi}}</option>
                        @endif
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('koleksi2')" class="mt-2" />
                </div>

                <!-- Koleksi 3 -->
                <div class="mt-4">
                    <x-input-label for="koleksi3" :value="__('Koleksi 3')" />
                    <select id="koleksi3" type="number" name="koleksi3"class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="-1">Select Type</option>
                        @foreach ($collections as $collection)
                        @if($collection->id == old('koleksi3'))
                        <option value="{{$collection->id}}" selected>{{$collection->namaKoleksi}}</option>
                        @else
                        <option value="{{$collection->id}}">{{$collection->namaKoleksi}}</option>
                        @endif
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('koleksi3')" class="mt-2" />
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
