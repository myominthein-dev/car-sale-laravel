@extends('layouts.app')

@section('content')
<main class="py-8 px-4 md:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold mb-2">{{ $car->carModel->name }} - {{ $car->year }}</h1>
        <div class="text-gray-600 mb-6">{{ $car->location }} - {{ $car->posted_at }}</div>

        <div class="grid grid-cols-1 lg:grid-cols-[1fr,400px] gap-6">
            {{-- Left Column --}}
            <div class="space-y-6">
                {{-- Image Carousel --}}
                <div class="relative rounded-lg overflow-hidden bg-gray-100">
                    <div class="relative pb-[56.25%]"> {{-- 16:9 Aspect Ratio --}}
                        <img
                            id="activeImage"
                            src="{{ asset('/storage/car_images/'.$car->primaryImage?->image_path) }}"
                            alt=""
                            class="absolute top-0 left-0 w-full h-full object-cover"
                        />
                    </div>
                    
                    {{-- Thumbnails --}}
                    <div class="grid grid-cols-7 gap-2 p-4 bg-white">
                        @foreach($car->carImage as $image)
                            <div class="relative pb-[100%]"> {{-- 1:1 Aspect Ratio --}}
                                <img data-child
                                    src="{{ asset("/storage/car_images/".$image?->image_path) }}"
                                    alt=""
                                    class="absolute top-0 left-0 w-full h-full object-cover rounded cursor-pointer hover:ring-2 hover:ring-primary"
                                    
                                />
                            </div>
                        @endforeach
                    </div>

                    
                </div>

                {{-- Description --}}
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-semibold mb-4">Detailed Description</h2>
                    <div class="space-y-4 text-gray-600">
                        <p>
                            {{ $car->description }}
                        </p>
                    </div>
                </div>

                {{-- Specifications --}}
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-semibold mb-4">Car Specifications</h2>
                    <ul class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        
                        @foreach ($carFeatures as $key => $value)
                        <li class="flex items-center gap-2">
                            @if($value == 1)
                                <svg class="w-5 h-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" />
                                </svg>
                            @else
                                <svg class="w-5 h-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm3 10.5a.75.75 0 0 0 0-1.5H9a.75.75 0 0 0 0 1.5h6Z" />
                                </svg>
                            @endif
                            <span class="text-sm">{{ Str::replace("_"," ", $key) }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            {{-- Right Column - Car Details --}}
            <div class="bg-white rounded-lg shadow p-6 h-fit">
                <div class="flex items-center justify-between mb-4">
                    <p class="text-3xl font-bold text-primary">${{ $car->price }}</p>
                    @if ($car->favouriteByUser)
                    <a href="{{ route('cars.addToWishList',$car) }}" class="p-2 hover:bg-gray-100 rounded-full">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24" stroke="red">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                    </a>
                    @else
                    <a href="{{ route('cars.addToWishList',$car) }}" class="p-2 hover:bg-gray-100 rounded-full">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                    </a>
                    @endif
                </div>

                <hr class="my-4">

                <table class="w-full">
                    <tbody class="divide-y">
                       
                            <tr>
                                <th class="py-3 text-left text-gray-600">Maker</th>
                                <td class="py-3 text-right">{{ $car->maker->name }}</td>
                            </tr>
                            <tr>
                                <th class="py-3 text-left text-gray-600">Model</th>
                                <td class="py-3 text-right">{{ $car->carModel->name  }}</td>
                            </tr>
                            <tr>
                                <th class="py-3 text-left text-gray-600">Year</th>
                                <td class="py-3 text-right">{{ $car->year }}</td>
                            </tr>
                            <tr>
                                <th class="py-3 text-left text-gray-600">Car Type</th>
                                <td class="py-3 text-right">{{ $car->carType->name }}</td>
                            </tr>
                            <tr>
                                <th class="py-3 text-left text-gray-600">Fuel Type</th>
                                <td class="py-3 text-right">{{ $car->fuelType->name }}</td>
                            </tr>
                     
                    </tbody>
                </table>

                <hr class="my-4">

                <div class="flex items-center gap-4 mb-6">
                    <div class="relative w-12 h-12">
                        <img src="{{ asset('/storage/'.$car->user->avatar) }}" alt="" class="absolute top-0 left-0 w-full h-full object-cover rounded-full">
                    </div>
                    <div>
                        <h3 class="font-semibold">{{ $car->user->name }}</h3>
                        
                    </div>
                </div>

                <a href="{{ $car->phone }}" class="flex items-center justify-center gap-2 w-full bg-primary text-white py-3 rounded-lg hover:bg-primary/90">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="
                    currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                    </svg>
                    {{ $car->phone  }}
                    
                </a>
            </div>
        </div>
    </div>
</main>
@endsection

{{-- <script>
    const images = @json(array_map(fn($i) => asset("img/cars/Lexus-RX200t-2016/$i.jpeg"), range(1, 7)));
    let currentImageIndex = 0;
    const activeImage = document.getElementById('activeImage');
    const prevButton = document.getElementById('prevButton');
    const nextButton = document.getElementById('nextButton');

    function updateMainImage(src) {
        activeImage.src = src;
        currentImageIndex = images.indexOf(src);
    }

    prevButton.addEventListener('click', () => {
        currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
        activeImage.src = images[currentImageIndex];
    });

    nextButton.addEventListener('click', () => {
        currentImageIndex = (currentImageIndex + 1) % images.length;
        activeImage.src = images[currentImageIndex];
    });
</script> --}}

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const subImages = Array.from(document.querySelectorAll("img[data-child]"))
        const activeImg = document.getElementById("activeImage")
        subImages.forEach(sub => {
            sub.addEventListener("click", function () {
                activeImage.src = this.src
            })
        });
    })
</script>

