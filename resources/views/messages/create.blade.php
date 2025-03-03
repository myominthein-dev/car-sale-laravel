<x-app-layout>
   
    @section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Contact Owner') }}
                </h2>
                <a href="{{ route('/')}}" class="text-blue-600 hover:text-blue-800">
                    Back
                </a>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                        <h3 class="font-medium">Car Details</h3>
                        <div class="flex items-center mt-2">
                            <img src="{{ asset('storage/car_images/'.$car->primaryImage->image_path) }}" alt="{{ $car->title }}" class="w-16 h-16 object-cover rounded">
                            <div class="ml-4">
                                <p class="font-medium">{{ $car->title }}</p>
                                <p class="text-gray-600">${{ number_format($car->price, 0) }}</p>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('messages.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="car_id" value="{{ $car->id }}">
                        
                        <div class="mb-4">
                            <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                            <input 
                                type="text" 
                                name="subject" 
                                id="subject" 
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                value="Inquiry about {{ $car->title }}"
                            >
                        </div>
                        
                        <div class="mb-4">
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                            <textarea 
                                name="message" 
                                id="message" 
                                rows="6" 
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                placeholder="Type your message here..."
                                required
                            ></textarea>
                        </div>
                        
                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection
</x-app-layout>

