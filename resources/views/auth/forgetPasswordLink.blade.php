<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Set Password Baru</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="antialiased bg-gray-50 text-gray-900 h-full">

<div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <div class="flex justify-center mb-6">
            <div class="rounded-xl bg-white p-2 shadow-sm ring-1 ring-gray-950/5">
                <svg class="h-10 w-10 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                </svg>
            </div>
        </div>
        
        <h2 class="text-center text-2xl font-bold tracking-tight text-gray-950">
            Set Password Baru
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600">
            Silakan masukkan password baru untuk akun <span class="font-semibold text-gray-900">{{ $email }}</span>
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-[400px]">
        <div class="bg-white px-6 py-10 shadow-sm ring-1 ring-gray-950/5 sm:rounded-2xl sm:px-10">
            <form action="{{ route('reset.password.post') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                @if (Session::has('message'))
                    <div class="rounded-lg bg-green-50 p-4 text-sm text-green-700 ring-1 ring-green-600/10 flex items-center" role="alert">
                        <svg class="h-5 w-5 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        {{ Session::get('message') }}
                    </div>
                @endif

                @if (Session::has('error'))
                    <div class="rounded-lg bg-red-50 p-4 text-sm text-red-700 ring-1 ring-red-600/10" role="alert">
                        {{ Session::get('error') }}
                    </div>
                @endif

                <div>
                    <label for="i_wbls_adm" class="block text-sm font-medium leading-6 text-gray-950">
                        Email Address
                    </label>
                    <div class="mt-2">
                        <input id="i_wbls_adm" name="i_wbls_adm" type="email" required 
                            value="{{ old('i_wbls_adm') }}"
                            class="block w-full rounded-lg border-0 py-2.5 px-4 text-gray-950 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('i_wbls_adm') ring-red-500 @enderror"
                            placeholder="Masukkan email Anda">
                    </div>
                    @error('i_wbls_adm')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium leading-6 text-gray-950">
                        Password Baru
                    </label>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" required 
                            class="block w-full rounded-lg border-0 py-2.5 px-4 text-gray-950 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('password') ring-red-500 @enderror">
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-950">
                        Konfirmasi Password Baru
                    </label>
                    <div class="mt-2">
                        <input id="password_confirmation" name="password_confirmation" type="password" required 
                            class="block w-full rounded-lg border-0 py-2.5 px-4 text-gray-950 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <button type="submit" 
                        class="flex w-full justify-center rounded-lg bg-indigo-600 px-3 py-2.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition duration-150">
                        Update Password
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center border-t border-gray-100 pt-6">
                <a href="/admin/login" class="text-sm font-medium text-gray-500 hover:text-indigo-600 transition duration-150">
                    Kembali ke halaman login
                </a>
            </div>
        </div>
    </div>
</div>

</body>
</html>