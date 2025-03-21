<x-guest-layout>
    <main class="w-full max-w-6xl  rounded-2xl overflow-hidden">
        <div class="flex flex-col md:flex-row">
            <div class="w-full md:w-1/2 px-10">
                <div class="text-center mb-4">
                    <a href="/" class="inline-block">
                        <img src="{{ asset('img/car_logo.jpg') }}" alt="Logo" class="h-12 mx-auto">
                    </a>
                </div>
                <h1 class="text-3xl font-bold text-center text-gray-700 mb-8">Login</h1>

                 <!-- Display validation errors -->
                 @if ($errors->any())
                 <div class="bg-red-50 text-red-500 p-3 rounded-lg mb-4">
                     <ul class="list-disc pl-5">
                         @foreach ($errors->all() as $error)
                             <li>{{ $error }}</li>
                         @endforeach
                     </ul>
                 </div>
             @endif

                <form action="{{ route('login') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <input type="email" name="email" placeholder="Your Email" class="w-full px-4 py-3 rounded-lg bg-gray-100 border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 transition duration-200 @error('email') border-red-500 @enderror"  required>
                        @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                        </div>
                        <div>
                            <input type="password" name="password" placeholder="Your Password" class="w-full px-4 py-3 rounded-lg bg-gray-100 border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 transition duration-200 @error('password') border-red-500 @enderror" required>
                        @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                        </div>
                    </div>
                    
                   
                    
                    <button type="submit" class="w-full bg-blue-600 text-white rounded-lg px-4 py-3 font-semibold hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 transition duration-200">Login</button>
                </form>

                <div class="mt-4 text-gray-600  gap-4">
                    <a href="{{ route('auth.google.redirect') }}" class="flex w-full items-center justify-center gap-2 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-200">
                        <img src="{{ asset('img/google.png') }}" alt="Google" class="w-5 h-5">
                        <span>Google</span>
                    </a>
                    
                </div>

                <p class="text-center mt-4 text-gray-600">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Click here to create one!</a>
                </p>
            </div>
            <div class="hidden md:flex md:w-1/2 bg-gradient-to-br  p-12  items-center justify-center">
                <div class="text-center">
                    <img src="{{ asset('img/car-png-39071.png') }}" alt="Car" class="max-w-full size-72 h-auto mx-auto mb-5 transform hover:scale-105 transition duration-300">
                    <h2 class="text-2xl font-bold text-gray-600 mb-4">Find Your Perfect Ride</h2>
                    <p class="text-xl text-sky-600 font-semibold">Join us and discover the best cars for your needs.</p>
                </div>
            </div>
        </div>
    </main>
</x-guest-layout>
