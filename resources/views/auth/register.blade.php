<x-guest-layout>
    <div class="w-full max-w-md bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block font-medium text-sm text-gray-700">{{ __('Name') }}</label>
                <input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ old('name') }}" required autofocus />
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Nickname -->
            <div class="mt-4">
                <label for="nickname" class="block font-medium text-sm text-gray-700">{{ __('Nickname') }}</label>
                <input id="nickname" class="block mt-1 w-full" type="text" name="nickname" value="{{ old('nickname') }}" />
                @error('nickname')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <label for="email" class="block font-medium text-sm text-gray-700">{{ __('Email') }}</label>
                <input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ old('email') }}" required />
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label for="password" class="block font-medium text-sm text-gray-700">{{ __('Password') }}</label>
                <input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <label for="password_confirmation" class="block font-medium text-sm text-gray-700">{{ __('Confirm Password') }}</label>
                <input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
            </div>

            <!-- Birth Date -->
            <div class="mt-4">
                <label for="birth_date" class="block font-medium text-sm text-gray-700">{{ __('Birth Date') }}</label>
                <input id="birth_date" class="block mt-1 w-full" type="date" name="birth_date" value="{{ old('birth_date') }}" />
                @error('birth_date')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Avatar -->
            <div class="mt-4">
                <label for="avatar" class="block font-medium text-sm text-gray-700">{{ __('Avatar') }}</label>
                <input id="avatar" class="block mt-1 w-full" type="file" name="avatar" accept="image/*" />
                @error('avatar')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex items-center justify-between mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('dashboard') }}">
                    {{ __('Back') }}
                </a>

                <button type="submit" class="ml-4 btn btn-primary">
                    {{ __('Register') }}
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>