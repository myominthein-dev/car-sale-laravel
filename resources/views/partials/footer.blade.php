<!-- resources/views/partials/footer.blade.php -->
<footer class="bg-gray-800 mt-auto text-white py-8">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-lg font-semibold mb-4">About Us</h3>
                <p>
                   Register an account then create cars and connect to other registered users with realtime messaging system.
                </p>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('/') }}" class="hover:text-gray-300">Home</a></li>
                    <li><a href="{{ route('home.search') }}" class="hover:text-gray-300">Search Cars</a></li>
                    <li><a href="{{ route('cars.create') }}" class="hover:text-gray-300">Sell Your Car</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-4">Developer Contact</h3>
                
                <p>Email: myomin9916@gmail.com</p>
                <p>Phone: 09 451 819 025</p>
            </div>
        </div>
        <hr class="my-6 border-gray-700">
        <p class="text-center">&copy; {{ date('Y') }} Car Findal Service. All rights reserved.</p>
    </div>
</footer>