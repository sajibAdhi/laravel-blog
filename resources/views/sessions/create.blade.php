<x-layout>
    <main class="max-w-lg mx-auto mt-10 bg-gray-100  border border-gray-200 p-10 rounded-xl">
        <h1 class="text-center font-bold text-xl">Log In</h1>
        <form action="/login" method="post" class="mt-10">
            @csrf

            <div class="mb-6">
                <label class="block mb-2 uppercase font-bold text-xs text-grey-700" for="email">
                    email
                </label>

                <input class="border border-grey-400 p-2 w-full" type="email" name="email" id="email"
                    value="{{ old('email') }}" required>

                @error('email')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block mb-2 uppercase font-bold text-xs text-grey-700" for="password">
                    password
                </label>

                <input class="border border-grey-400 p-2 w-full" type="password" name="password" id="password" required>
                @error('password')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500">
                    Log In
                </button>
            </div>
        </form>
    </main>
</x-layout>
