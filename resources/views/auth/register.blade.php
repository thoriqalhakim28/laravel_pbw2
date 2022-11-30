<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Username -->
            <div>
                <x-input-label for="username" :value="__('Username')" />
                <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus />

                <x-input-error :messages="$errors->get('username')" class="mt-2" />
            </div>

            <!-- Fullname -->
            <div class="mt-4">
                <x-input-label for="fullname" :value="__('Fullname')" />
                <x-text-input id="fullname" class="block mt-1 w-full" type="text" name="fullname" :value="old('fullname')" required />

                <x-input-error :messages="$errors->get('fullname')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Address -->
            <div class="mt-4">
                <x-input-label for="address" :value="__('Address')" />
                <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required />

                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>

            <!-- Birthdate -->
            <div class="mt-4">
                <x-input-label for="birthdate" :value="__('Birth Date')" />
                <x-text-input datepicker id="birthdate" class="block mt-1 w-full" type="date" name="birthdate" :value="old('birthdate')" required />

                <x-input-error :messages="$errors->get('birthdate')" class="mt-2" />
            </div>

            <!-- Phone Number -->
            <div class="mt-4">
                <x-input-label for="phoneNumber" :value="__('Phone Number')" />
                <x-text-input id="phoneNumber" class="block mt-1 w-full" type="text" name="phoneNumber" :value="old('phoneNumber')" required />

                <x-input-error :messages="$errors->get('phoneNumber')" class="mt-2" />
            </div>

            <!-- Relegion -->
            <div class="mt-4">
                <x-input-label for="religion" :value="__('Religion')" />
                <x-text-input id="religion" class="block mt-1 w-full" type="text" name="religion" :value="old('religion')" required />

                <x-input-error :messages="$errors->get('religion')" class="mt-2" />
            </div>

            <!-- Gender -->
            <div class="mt-4">
                <x-input-label for="gender" :value="__('Gender')" />
                <select name="gender" id="gender" name='gender' :value="old('gender')"   class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option selected>Select gender</option>
                    <option value="1">Laki-laki</option>
                    <option value="2">Perempuan</option>
                </select>
                <x-input-error :messages="$errors->get('gender')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ml-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
