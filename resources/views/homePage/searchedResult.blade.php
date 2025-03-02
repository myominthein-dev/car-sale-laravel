@extends('layouts.app')

@section('content')
    <!-- Found Cars -->
    <section>
        <div class="container mx-auto mt-5  p-4">
            <div class="sm:flex items-center justify-between mb-8">
                <div class="flex items-center">
                    <button class="show-filters-button flex items-center text-gray-700 hover:text-gray-900">
                        {{-- <x-icons.adjustments-vertical class="w-5 h-5 mr-2"/> --}}
                        Filters
                    </button>
                    <h2 class="ml-3 text-lg font-medium">Define your search criteria</h2>
                </div>

                <select name="sort"
                    class="mt-3 sm:mt-0 block w-full sm:w-auto rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                    <option value="">Order By</option>
                    <option value="price" @selected(request('sort') == 'price')>Price Asc</option>
                    <option value="-price" @selected(request('sort') == '-price')>Price Desc</option>
                </select>
            </div>

            <div class="grid grid-cols-1  lg:grid-cols-4 gap-8">
                <!-- Sidebar Filters -->
                <div class="lg:col-span-1">
                    <div class="search-cars-sidebar">
                        <div class="bg-white rounded-lg shadow p-4 mb-4">
                            <div class="flex justify-between items-center">
                                <p class="m-0">Found <strong>{{ $carsCount }}</strong> cars</p>
                                <button class="close-filters-button lg:hidden">
                                    <svg xmlns="http://www.w3.org/2000/svg" 
                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6 13.5V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m12-3V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m-6-9V3.75m0 3.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 9.75V10.5" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="bg-white rounded-lg shadow">
                            <form action="{{ route('home.search') }}" method="GET" class="p-6 space-y-6">
                               <div class="grid grid-cols-2 gap-3">
                                 <!-- Maker -->
                                 <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">Maker</label>
                                    <select name="maker_id" class="w-full rounded-md border-gray-300">
                                        <option value="">Select Maker</option>
                                        @foreach ($makers as $maker)
                                            <option value="{{ $maker->id }}" @selected(request('maker_id') == $maker->id)>
                                                {{ $maker->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Model -->
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">Model</label>
                                    <select name="model_id" class="w-full rounded-md border-gray-300">
                                        <option value="">Select Model</option>
                                        @foreach ($models as $model)
                                            <option value="{{ $model->id }}" data-maker="{{ $model->maker_id }}"
                                                @selected(request('model_id') == $model->id)>
                                                {{ $model->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                               </div>

                                <!-- Type -->
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="space-y-2">
                                        <label class="block text-sm font-medium text-gray-700">Type</label>
                                        <select name="car_type_id" class="w-full rounded-md border-gray-300">
                                            <option value="">Select Type</option>
                                            @foreach ($carTypes as $type)
                                                <option value="{{ $type->id }}" @selected(request('car_type_id') == $type->id)>
                                                    {{ $type->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="space-y-2">
                                        <label class="block text-sm font-medium text-gray-700">Fuel Type</label>
                                        <select name="car_type_id" class="w-full rounded-md border-gray-300">
                                            <option value="">Select Type</option>
                                            @foreach ($fuelTypes as $type)
                                                <option value="{{ $type->id }}" @selected(request('car_type_id') == $type->id)>
                                                    {{ $type->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Year Range -->
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">Year</label>
                                    <div class="grid grid-cols-2 gap-4">
                                        <input type="number" name="year_from" placeholder="Year From"
                                            value="{{ request('year_from') }}" class="rounded-md border-gray-300">
                                        <input type="number" name="year_to" placeholder="Year To"
                                            value="{{ request('year_to') }}" class="rounded-md border-gray-300">
                                    </div>
                                </div>

                                <!-- Price Range -->
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">Price</label>
                                    <div class="grid grid-cols-2 gap-4">
                                        <input type="number" name="price_from" placeholder="Price From"
                                            value="{{ request('price_from') }}" class="rounded-md border-gray-300">
                                        <input type="number" name="price_to" placeholder="Price To"
                                            value="{{ request('price_to') }}" class="rounded-md border-gray-300">
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-3">
                                   
                                    <div class="space-y-2">
                                        <label class="block text-sm font-medium text-gray-700"> State / Region </label>
                                        <select name="state_id" class="w-full rounded-md border-gray-300">
                                            <option value="">Select State</option>
                                            @foreach ($states as $state)
                                                <option value="{{ $state->id }}" @selected(request('state_id') == $state->id)>
                                                    {{ $state->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="space-y-2">
                                        <label class="block text-sm font-medium text-gray-700"> City </label>
                                        <select name="city_id" class="w-full rounded-md border-gray-300">
                                            <option value="">Select City</option>
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}" @selected(request('city_id') == $city->id)>
                                                    {{ $city->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">Mileage</label>
                                    <div class="grid grid-cols-2 gap-4">
                                        <input type="number" name="mileage_from" placeholder="Mileage From"
                                            value="{{ request('price_from') }}" class="rounded-md border-gray-300">
                                        <input type="number" name="mileage_to" placeholder="Moleage To"
                                            value="{{ request('price_to') }}" class="rounded-md border-gray-300">
                                    </div>
                                </div>
                                <div class="flex gap-4 pt-4">
                                    <button type="reset"
                                        class="flex-1 px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                                        Reset
                                    </button>
                                    <button type="submit"
                                        class="flex-1 px-4 py-2 bg-gray-600 text-white rounded-md text-sm font-medium hover:bg-gray-700">
                                        Update
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Search Results -->
                <div class="lg:col-span-3 pb-10  relative h-full">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($cars as $car)
                       <x-car-card :car="$car" />
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class=" absolute bottom-0 right-0">
                        {{ $cars->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<script>
    // Handle dependent dropdowns for maker/model
document.addEventListener('DOMContentLoaded', function() {
    const makerSelect = document.querySelector('[name="maker_id"]');
    const modelSelect = document.querySelector('[name="model_id"]');
    
    if (makerSelect && modelSelect) {
        makerSelect.addEventListener('change', function() {
            const makerId = this.value;
            
            // Hide all options first
            Array.from(modelSelect.options).forEach(option => {
                if (option.value === '') {
                    option.style.display = 'block';
                } else {
                    option.style.display = option.dataset.maker === makerId ? 'block' : 'none';
                }
            });
            
            modelSelect.value = '';
        });
    }
    
    // Mobile filters toggle
    const showFiltersBtn = document.querySelector('.show-filters-button');
    const closeFiltersBtn = document.querySelector('.close-filters-button');
    const sidebar = document.querySelector('.search-cars-sidebar');
    
    if (showFiltersBtn && closeFiltersBtn && sidebar) {
        showFiltersBtn.addEventListener('click', () => {
            sidebar.classList.add('active');
        });
        
        closeFiltersBtn.addEventListener('click', () => {
            sidebar.classList.remove('active');
        });
    }
});
</script>