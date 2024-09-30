<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="flex justify-center items-center min-h-screen">
        <!-- Main container -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden flex w-full max-w-4xl">

            <!-- Left side with image and logo -->
        <div class="hidden lg:block lg:w-1/2 bg-no-repeat bg-center relative" style="background-image: url('image/laptop.png'); background-size: 70%;">

            <!-- Logo in top left corner of the image area -->
            <div class="absolute top-4 left-4">
                <img src="image/Rimberio.png" alt="Logo" class="h-15 w-40">
            </div>

        </div>

            <!-- Right side with login form -->
            <div class="w-full lg:w-1/2 p-8">
                <h2 class="text-2xl font-bold text-gray-800 text-start mb-2">e-Rapor SMA</h2>
                <p class="text-[15px] mb-6">Silahkan login untuk mengakses aplikasi</p>


                <!-- Session Status (Laravel Blade Component) -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Username -->
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                        <input id="username" name="username" type="text" required autofocus class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        <x-input-error :messages="$errors->get('username')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input id="password" name="password" type="password" required autocomplete="current-password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    

                    <!-- Forgot Password & Login Button -->
                    <div class="flex items-center justify-between mt-4">
                        @if (Route::has('password.request'))
                            <a class="text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                Forgot your password?
                            </a>   
                        @endif

                        <!-- Remember Me -->
                    <div class="block mt-2">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                            <span class="ml-2  text-sm text-gray-600">Remember me</span>
                        </label>
                    </div>
                        
                    </div>
                    <div class="flex justify-center mt-4">
                        <button type="submit" class="bg-[#285598] text-white text-center font-bold px-12 py-2 rounded-lg hover:bg-[#1e447a]">
                            LOGIN
                        </button>
                    </div>
                    
                    
                </form>
            </div>

        </div>
    </div>

</body>
</html>
