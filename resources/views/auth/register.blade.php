<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="flex items-center">
            <!-- Name -->
            <div style="width:50%;margin-right: 8px;">
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
    
            <!-- Email Address -->
            <div style="width:50%;">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
        </div>
        

        <div class="my-4">
            <x-input-label for="role" :value="__('Role')" />
            <x-my-components.dropdown name="role" class="my-custom-class">
                <option value="admin">Admin</option>
                <option value="employee">Employee</option>
            </x-my-components.dropdown>
        </div>
        
        <div class="flex items-center">
            <!-- Name -->
            <div style="width:50%;margin-right: 8px;">
                <x-input-label for="department" :value="__('Department')" />
                <x-text-input id="department" class="block mt-1 w-full" type="text" name="department" :value="old('department')" required autocomplete="department" />
                <x-input-error :messages="$errors->get('department')" class="mt-2" />
            </div>
    
            <!-- Email Address -->
            <div style="width:50%;">
                <x-input-label for="job" :value="__('Job')" />
            <x-text-input id="job" class="block mt-1 w-full" type="text" name="job" :value="old('job')" required autocomplete="job" />
            <x-input-error :messages="$errors->get('job')" class="mt-2" />
            </div>
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
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <x-primary-button class="mt-4">
            {{ __('Register') }}
        </x-primary-button>

        <div class="text-center mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
        </div>
    </form>
</x-guest-layout>
