<x-app-layout>
    <x-guest-layout>
        <x-auth-card>
            <x-slot name="logo">
                <p class="font-semibold text-xl text-gray-800 mt-4">
                    {{ __('😊 EDIT PENGGUNA 😊') }}
                </p>
            </x-slot>
            <form method="POST" action="{{ route('userUpdate', $user->id) }}">
                @csrf
                @method('PUT')

                <!-- Username -->
                <div>
                    <x-input-label for="username" :value="__('Username')" />
                    <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" value="{{$user->username}}" readonly/>

                    <x-input-error :messages="$errors->get('username')" class="mt-2" />
                </div>

                <!-- Fullname -->
                <div class="mt-4">
                    <x-input-label for="fullname" :value="__('Fullname')" />
                    <x-text-input id="fullname" class="block mt-1 w-full" type="text" name="fullname" value="{{$user->fullname}}" required />

                    <x-input-error :messages="$errors->get('fullname')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />

                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{$user->email}}" readonly />

                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>


                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password" />
                </div>

                <!-- Address -->
                <div class="mt-4">
                    <x-input-label for="address" :value="__('Address')" />
                    <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" value="{{$user->address}}" required />

                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>

                <!-- Birthdate -->
                <div class="mt-4">
                    <x-input-label for="birthdate" :value="__('Birth Date')" />
                    <x-text-input datepicker id="birthdate" class="block mt-1 w-full" type="date" name="birthdate" value="{{$user->birthdate}}" readonly />

                    <x-input-error :messages="$errors->get('birthdate')" class="mt-2" />
                </div>

                <!-- Phone Number -->
                <div class="mt-4">
                    <x-input-label for="phoneNumber" :value="__('Phone Number')" />
                    <x-text-input id="phoneNumber" class="block mt-1 w-full" type="text" name="phoneNumber" value="{{$user->phoneNumber}}" required />

                    <x-input-error :messages="$errors->get('phoneNumber')" class="mt-2" />
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
