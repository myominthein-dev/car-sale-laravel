<x-guest-layout>
    <main class="w-full max-w-6xl  rounded-2xl overflow-hidden">
        <div class="flex flex-col md:flex-row">
            <div class="w-full md:w-1/2 px-10">
                <div class="text-center mb-4">
                    <a href="/" class="inline-block">
                        <img src="{{ asset('img/car_logo.jpg') }}" alt="Logo" class="h-12 mx-auto">
                    </a>
                </div>
                <h1 class="text-3xl font-bold text-center text-gray-600 mb-8">Sign Up</h1>

                <form action="{{ route('register') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="space-y-4">
                        <input type="email" name="email" placeholder="Your Email" class="w-full px-4 py-3 rounded-lg bg-gray-100 border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 transition duration-200" required>
                        <input type="password" name="password" placeholder="Your Password" class="w-full px-4 py-3 rounded-lg bg-gray-100 border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 transition duration-200" required>
                        <input type="password" name="password_confirmation" placeholder="Repeat Password" class="w-full px-4 py-3 rounded-lg bg-gray-100 border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 transition duration-200" required>
                    </div>
                    
                    <div class="space-y-4">
                        <input type="text" name="name" placeholder="Your Name" class="w-full px-4 py-3 rounded-lg bg-gray-100 border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 transition duration-200" required>
                       
                        <input type="tel" name="phone" placeholder="Phone" class="w-full px-4 py-3 rounded-lg bg-gray-100 border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 transition duration-200" required>
                    </div>
                    
                    <button type="submit" class="w-full bg-blue-600 text-white rounded-lg px-4 py-3 font-semibold hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 transition duration-200">Register</button>
                </form>

                <div class="mt-4 text-gray-600 gap-4">
                    <button class="flex items-center w-full justify-center gap-2 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-200">
                        <img src="{{ asset('img/google.png') }}" alt="Google" class="w-5 h-5">
                        <span>Google</span>
                    </button>
                   
                </div>

                <p class="text-center mt-4 text-gray-600">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Click here to login</a>
                </p>
            </div>
            <div class="hidden md:flex md:w-1/2 bg-gradient-to-br  p-12  items-center justify-center">
                <div class="text-center">
                    <img src="{{ asset('img/car-png-39071.png') }}" alt="Car" class="max-w-full size-96 h-auto mx-auto mb-5 transform hover:scale-105 transition duration-300">
                    <h2 class="text-3xl font-bold text-gray-700 mb-4">Find Your Perfect Ride</h2>
                    <p class="text-xl text-blue-500 font-semibold">Join us and discover the best cars for your needs.</p>
                </div>
            </div>
        </div>
    </main>
</x-guest-layout>
