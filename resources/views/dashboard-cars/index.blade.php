@extends('layouts.app')

@section('content')



<div class="pt-6 px-4">
    <x-back-btn/>
    <div class="mb-4 flex flex-col md:flex-row items-start md:items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Cars</h1>
            <p class="mt-1 text-sm text-gray-600">Manage cars in the system</p>
        </div>
       
    </div>

    @if(session('status'))
    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
        {{ session('status') }}
    </div>
    @endif

    <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8">
        <div class="sm:flex sm:items-center sm:justify-between mb-4">
            <div class="flex items-center gap-x-3">
                <h3 class="text-lg font-semibold text-gray-900">All Cars</h3>
                <span class="px-3 py-1 text-xs text-green-600 bg-green-100 rounded-full">{{ $cars->count() ?? 0 }} Total</span>
            </div>
           
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-4 py-3">ID</th>
                        <th scope="col" class="px-4 py-3">Image</th>
                        <th scope="col" class="px-4 py-3">Brand</th>
                        <th scope="col" class="px-4 py-3">Model</th>
                        <th scope="col" class="px-4 py-3">User Name</th>
                        <th scope="col" class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cars ?? [] as $car)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $car->id }}</td>
                        <td class="px-4 py-3">
                            <img class="size-14 object-cover" src="{{ asset('/storage/car_images').'/'.$car->primaryImage?->image_path }}" alt="">
                        </td>
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $car->maker->name }}</td>
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $car->carModel->name }}</td>
                        <td class="px-4 py-3 font-medium text-gray-900">GG win</td>

                        <td class="px-4 py-3  h-full ">
                           <div class="flex items-center space-x-2">
                            <a class="edit-btn font-medium text-blue-600 hover:underline"  href="{{ route('cars.edit',$car->id) }}">Edit</a>
                            <form action="{{ route('cars.destroy', $car->id) }}" method="POST" class="inline-block delete-form">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure to delete?')" type="submit" class="font-medium text-red-600 hover:underline">Delete</button>
                            </form>
                           </div>
                        </td>
                    </tr>
                    @empty
                    <tr class="bg-white border-b">
                        <td colspan="5" class="px-4 py-3 text-center">No cars found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $cars->links() }}
        </div>
    </div>
</div>


@endsection


