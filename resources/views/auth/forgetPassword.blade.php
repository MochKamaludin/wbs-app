<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="antialiased bg-gray-50 text-gray-900 h-full">

<div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <div class="flex justify-center mb-6">
            <div class="rounded-xl bg-white p-2 shadow-sm ring-1 ring-gray-950/5">
                <svg class="h-10 w-10 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z" />
                </svg>
            </div>
        </div>
        
        <h2 class="text-center text-2xl font-bold tracking-tight text-gray-950">
            Reset Password
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600">
            Masukkan email Anda untuk menerima tautan reset.
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-[400px]">
        <div class="bg-white px-6 py-10 shadow-sm ring-1 ring-gray-950/5 sm:rounded-2xl sm:px-10">
            <form action="{{ route('forget.password.post') }}" method="POST" class="space-y-6">
                @csrf

                @if (Session::has('message'))
                    <div class="rounded-lg bg-green-50 p-4 text-sm text-green-700 ring-1 ring-green-600/10" role="alert">
                        {{ Session::get('message') }}
                    </div>
                @endif

                <div>
                    <label for="i_wbls_adm" class="block text-sm font-medium leading-6 text-gray-950">
                        Email Address
                    </label>
                    <div class="mt-2">
                        <input id="i_wbls_adm" 
                            name="i_wbls_adm" 
                            type="email" 
                            autocomplete="email" 
                            required 
                            value="{{ old('i_wbls_adm') }}"
                            class="block w-full rounded-lg border-0 py-2.5 px-3.5 text-gray-950 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('i_wbls_adm') ring-red-500 @enderror"
                            placeholder="Masukkan email Anda">
                    </div>
                    
                    @error('i_wbls_adm')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <button type="submit" 
                        class="flex w-full justify-center rounded-lg bg-indigo-600 px-3 py-2.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition duration-150">
                        Send Password Reset Link
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center">
                <a href="/admin/login" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                    &larr; Kembali ke halaman login
                </a>
            </div>
        </div>
    </div>
</div>

</body>
</html>