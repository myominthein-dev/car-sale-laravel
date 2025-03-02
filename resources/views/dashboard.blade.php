@extends('layouts.app')

@section('content')

<div class="pt-6 px-4">
    <div class="w-full">
        <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 mb-6">
            <div class="mb-4 flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">App Features Management Dashboard</h3>
                    <span class="text-base font-normal text-gray-500">This is an overview of your app data management system</span>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="bg-blue-50 rounded-lg p-4 flex flex-col">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <span class="text-2xl sm:text-3xl leading-none font-bold text-blue-600">{{ $carTypesCount ?? 0 }}</span>
                        </div>
                    </div>
                    <h3 class="text-base font-normal text-gray-500 mt-2">Car Types</h3>
                    <a href="{{ route('car-types.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-500 mt-auto">View all</a>
                </div>
                <div class="bg-green-50 rounded-lg p-4 flex flex-col">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <span class="text-2xl sm:text-3xl leading-none font-bold text-green-600">{{ $fuelTypesCount ?? 0 }}</span>
                        </div>
                    </div>
                    <h3 class="text-base font-normal text-gray-500 mt-2">Fuel Types</h3>
                    <a href="{{ route('fuel-types.index') }}" class="text-sm font-medium text-green-600 hover:text-green-500 mt-auto">View all</a>
                </div>
                <div class="bg-purple-50 rounded-lg p-4 flex flex-col">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <span class="text-2xl sm:text-3xl leading-none font-bold text-purple-600">{{ $makersCount ?? 0 }}</span>
                        </div>
                    </div>
                    <h3 class="text-base font-normal text-gray-500 mt-2">Makers</h3>
                    <a href="{{ route('makers.index') }}" class="text-sm font-medium text-purple-600 hover:text-purple-500 mt-auto">View all</a>
                </div>
                <div class="bg-yellow-50 rounded-lg p-4 flex flex-col">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <span class="text-2xl sm:text-3xl leading-none font-bold text-yellow-600">{{ $modelsCount ?? 0 }}</span>
                        </div>
                    </div>
                    <h3 class="text-base font-normal text-gray-500 mt-2">Models</h3>
                    <a href="{{ route('models.index') }}" class="text-sm font-medium text-yellow-600 hover:text-yellow-500 mt-auto">View all</a>
                </div>
                <div class="bg-red-50 rounded-lg p-4 flex flex-col">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <span class="text-2xl sm:text-3xl leading-none font-bold text-red-600">{{ $regionsCount ?? 0 }}</span>
                        </div>
                    </div>
                    <h3 class="text-base font-normal text-gray-500 mt-2">States/Regions</h3>
                    <a href="{{ route('states.index') }}" class="text-sm font-medium text-red-600 hover:text-red-500 mt-auto">View all</a>
                </div>
                <div class="bg-indigo-50 rounded-lg p-4 flex flex-col">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <span class="text-2xl sm:text-3xl leading-none font-bold text-indigo-600">{{ $citiesCount ?? 0 }}</span>
                        </div>
                    </div>
                    <h3 class="text-base font-normal text-gray-500 mt-2">Cities</h3>
                    <a href="{{ route('cities.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500 mt-auto">View all</a>
                </div>
                <div class="bg-cyan-50 rounded-lg p-4 flex flex-col">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <span class="text-2xl sm:text-3xl leading-none font-bold text-cyan-600">{{ $carsCount ?? 0 }}</span>
                        </div>
                    </div>
                    <h3 class="text-base font-normal text-gray-500 mt-2">Cars</h3>
                    <a href="{{ route('dashboard-cars.index') }}" class="text-sm font-medium text-cyan-600 hover:text-cyan-500 mt-auto">View all</a>
                </div>
                <div class="bg-violet-50 rounded-lg p-4 flex flex-col">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <span class="text-2xl sm:text-3xl leading-none font-bold text-violet-600">{{ $usersCount ?? 0 }}</span>
                        </div>
                    </div>
                    <h3 class="text-base font-normal text-gray-500 mt-2">Users</h3>
                    <a href="{{ route('dashboard-users.index') }}" class="text-sm font-medium text-violet-600 hover:text-violet-500 mt-auto">View all</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

