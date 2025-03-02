<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <a href="{{ route('home.show', $car) }}">
        <img src="{{ asset('storage/car_images/'.$car->primaryImage?->image_path) }}" alt="{{ $car->title }}" class="w-full h-48 object-cover">
    </a>
    <div class="p-4">
        <div class="flex items-center justify-between mb-2">
            {{-- <small class="text-gray-500">{{ $car->city->name }}</small> --}}
            <div>
                <h2 class="text-lg text-gray-600 font-semibold">{{ $car->maker->name }} - {{ $car->carModel->name }}</h2>
            </div>
            <a href="{{ route('cars.addToWishList',$car) }}" class="text-gray-500 hover:text-red-500">
               @if ($car->favouriteByUser)
               <svg xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
            </svg>
               @else
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
            </svg>
                @endIf
            </a>
        </div>

        <div class="text-sm text-gray-700 font-semibold">
            Mileage : {{ $car->mileage }} KM, Location : {{ $car->city->name }}
        </div>
        <h3 class="text-lg font-semibold mb-2">{{ $car->title }}</h3>
        <p class="text-xl font-bold text-primary mb-2">${{ number_format($car->price, 2) }}</p>

        <div class="flex flex-wrap gap-2">
            <span class="bg-gray-200 text-gray-700 px-2 py-1 rounded-full text-sm">{{ $car->carType->name }}</span>
            <span class="bg-gray-200 text-gray-700 px-2 py-1 rounded-full text-sm">{{ $car->fuelType->name }}</span>
        </div>

        
        <hr class="my-2">
        <div class="flex justify-between items-center text-sm">
            <div >
                Owner : <span class="font-semibold"> {{ $car->user->name }}</span>
            </div>
            <div>
                <button class="bg-blue-500 rounded-lg px-2 py-2 text-white text-xs">Contact Owner</button>
            </div>
        </div>
    </div>
</div>