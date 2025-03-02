@extends('layouts.app')

@section('content')
<div class="overflow-x-auto">
    <table class="w-full border-collapse border border-gray-300 shadow-lg rounded-lg">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-center border border-gray-300">#</th>
                <th class="p-3 text-center border border-gray-300">Car Image</th>
                <th class="p-3 text-center border border-gray-300">Brand</th>
                <th class="p-3 text-center border border-gray-300">Model</th>
                <th class="p-3 text-center border border-gray-300">Price</th>
                <th class="p-3 text-center border border-gray-300">Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr  class=" hidden last:table-row ">
                <td class="text-center py-3 font-semibold text-lg" colspan="6"> You've not added any car to your wish list yet. 
                   
                </td>
              </tr>
            @foreach ($wishedCars as  $index => $wishedCar)
            
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="p-3 border border-gray-300">{{ $index + 1 }}</td>
                    <td class="p-3 border border-gray-300">
                        <img src="{{ asset('/storage/car_images/'. $wishedCar->car->primaryImage->image_path) }}" alt="Car Image" class="w-16 h-16 rounded-md object-cover">
                    </td>
                    <td class="p-3 border border-gray-300">{{ $wishedCar->car->maker->name }}</td>
                    <td class="p-3 border border-gray-300">{{ $wishedCar->car->carModel->name }}</td>
                    <td class="p-3 border text-right border-gray-300 font-semibold text-green-600">${{ number_format($wishedCar->car->price, 2) }}</td>
                    <td >
                        <div class="flex items-center justify-center text-center space-x-2">
                            <a href="{{ route('home.show', $wishedCar->car->id) }}" class="px-3 py-1 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 transition">View</a>
                            <a href="{{ route('cars.addToWishList',$wishedCar->car->id) }}" class="px-3 py-1 bg-red-500 text-white rounded-md hover:bg-red-600 transition">Remove</a>
                            {{-- <form action="{{ route('cars.destroy', $wishedCar->car_id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded-md hover:bg-red-600 transition">Remove</button>
                         </form> --}}
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection