<div class="max-w-3xl my-5 mx-auto p-6  rounded-lg ">
    <h2 class="text-xl font-semibold text-gray-800 mb-6">Add new car</h2>

    <form enctype="multipart/form-data" action="{{ route('cars.store') }}" method="POST" class="space-y-6">
        @csrf

        <div class="md:grid grid-cols-3 gap-3">
            <div class="md:col-span-2">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Maker</label>
                        <select name="maker" id="maker-create"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('maker') border-red-500 @enderror">
                            <option value="">Maker</option>
                            @foreach ($makers as $maker)
                                <option value="{{ $maker->id }}" {{ old('maker') == $maker->id ? 'selected' : '' }}>
                                    {{ $maker->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('maker')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Model</label>
                        <select name="model" id="model-create"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('model') border-red-500 @enderror">
                            <option value="">Select Model</option>
                            @foreach ($models as $model)
                                <option data-parent="{{ $model->maker_id }}" class="hidden" value="{{ $model->id }}"
                                    {{ old('model') == $model->id ? 'selected' : '' }}>
                                    {{ $model->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('model')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Year</label>
                        <select name="year"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('year') border-red-500 @enderror">
                            <option value="">Year</option>
                            @for ($i = date('Y'); $i >= 1900; $i--)
                                <option value="{{ $i }}" {{ old('year') == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                        @error('year')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="space-y-3">
                    <label class="block text-sm mt-3 font-medium text-gray-700">Car Type</label>
                    <div class="flex flex-wrap gap-4">
                        @foreach ($carTypes as $carType)
                            <label class="inline-flex items-center">
                                <input type="radio" name="car_type" value="{{ $carType->id }}"
                                    {{ old('car_type') == $carType->id ? 'checked' : '' }}
                                    class="text-blue-600 focus:ring-blue-500 @error('car_type') border-red-500 @enderror">
                                <span class="ml-2">{{ $carType->name }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('car_type')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 my-3 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                        <input type="number" name="price" placeholder="Price" value="{{ old('price') }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('price') border-red-500 @enderror">
                        @error('price')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Vin Code</label>
                        <input type="text" name="vin_code" placeholder="Vin Code" value="{{ old('vin_code') }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('vin_code') border-red-500 @enderror">
                        @error('vin_code')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Mileage (mi)</label>
                        <input type="number" name="mileage" placeholder="Mileage" value="{{ old('mileage') }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('mileage') border-red-500 @enderror">
                        @error('mileage')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="space-y-2 my-3">
                    <label class="block text-sm font-medium text-gray-700">Fuel Type</label>
                    <div class="flex flex-wrap gap-4">
                        @foreach ($fuelTypes as $fuelType)
                            <label class="inline-flex items-center">
                                <input type="radio" name="fuel_type" value="{{ $fuelType->id }}"
                                    {{ old('fuel_type') == $fuelType->id ? 'checked' : '' }}
                                    class="text-blue-600 focus:ring-blue-500 @error('fuel_type') border-red-500 @enderror">
                                <span class="ml-2">{{ $fuelType->name }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('fuel_type')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 my-3 md:grid-cols-2 gap-4">
                    <div >
                        <label class="block text-sm font-medium text-gray-700 mb-1">State/Region</label>
                        <select name="state" id="state-create"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('state') border-red-500 @enderror">
                            <option value="">State/Region</option>
                            @foreach ($states as $state)
                                <option value="{{ $state->id }}" {{ old('state') == $state->id ? 'selected' : '' }}>
                                    {{ $state->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('state')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">City</label>
                        <select name="city" id="city-create"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('city') border-red-500 @enderror">
                            <option value="">City</option>
                            @foreach ($cities as $city)
                                <option class="hidden" data-parent="{{ $city->state_id }}" value="{{ $city->id }}"
                                    {{ old('city') == $city->id ? 'selected' : '' }}>
                                    {{ $city->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('city')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 my-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                        <input type="text" name="address" placeholder="Address" value="{{ old('address') }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('address') border-red-500 @enderror">
                        @error('address')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                        <input type="tel" name="phone" placeholder="Phone" value="{{ old('phone') }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('phone') border-red-500 @enderror">
                        @error('phone')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 my-3 gap-y-2">
                    <div class="space-y-2 ">
                        @foreach(['air_conditioning', 'power_windows', 'power_door_locks', 'abs', 'cruise_control', 'bluetooth_connectivity'] as $feature)
                            <label class="inline-flex w-full items-center">
                                <input type="checkbox" name="features[{{ $feature }}]" value="1"
                                    {{ old("features.$feature") ? 'checked' : '' }}
                                    class="text-blue-600 rounded focus:ring-blue-500">
                                <span class="ml-2">{{ Str::title(str_replace('_', ' ', $feature)) }}</span>
                            </label>
                        @endforeach
                    </div>

                    <div class="space-y-2 ">
                        @foreach(['remote_start', 'gps_navigation_system', 'heated_seats', 'climate_control', 'rear_parking_sensors', 'leather_seats'] as $feature)
                            <label class="inline-flex w-full items-center">
                                <input type="checkbox" name="features[{{ $feature }}]" value="1"
                                    {{ old("features.$feature") ? 'checked' : '' }}
                                    class="text-blue-600  rounded focus:ring-blue-500">
                                <span class="ml-2">{{ Str::title(str_replace('_', ' ', $feature)) }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Detailed Description</label>
                    <textarea name="description" rows="4"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="col-span-1 border-l-2">
                <div class="space-y-4">
                    <div class="p-4 text-center relative">
                        <svg class="mx-auto h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <input name="images[]" id="imgUpload" type="file" multiple
                            class="mt-2 w-20 text-sm opacity-0 text-gray-500 absolute cursor-pointer" />
                        <label for="carFormImageUpload" class="cursor-pointer">
                            <span class="text-blue-500 hover:text-blue-700 text-sm">Upload Image</span>
                        </label>
                        <p class="mt-1 text-xs text-gray-500">or drag and drop</p>
                        @error('images')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                        @error('images.*')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div id="imagePreviews" class="grid grid-cols-2 gap-2 max-h-32">
                        <!-- Image previews will be added here via JavaScript -->
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end space-x-4">
            <button type="reset"
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Reset
            </button>
            <button type="submit"
                class="px-4 py-2 text-sm font-medium text-white bg-blue-500 border border-transparent rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Create Car
            </button>
        </div>
    </form>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const uploader = document.getElementById('imgUpload')
        const makerSelect = document.getElementById('maker-create')
        const modelSelect = document.getElementById('model-create')
        const stateSelect = document.getElementById('state-create')
        const citySelect = document.getElementById('city-create')
        const cityOptions = Array.from(citySelect.querySelectorAll("option[data-parent]"))
        const modelOptions = Array.from(modelSelect.querySelectorAll("option[data-parent]"))

        makerSelect.addEventListener('change', function () {
            const makerId = this.value

            modelSelect.innerHTML = "<option value=''>Select Model</option>"

            modelOptions.forEach(option => {
                if (option.getAttribute('data-parent') == makerId ) {
                    option.classList.remove('hidden')
                    modelSelect.append(option)
                }
            });
        })

        stateSelect.addEventListener('change', function () {
            const stateId = this.value

            citySelect.innerHTML = "<option value=''>Select City</option>"

            cityOptions.forEach(option => {
                if (option.getAttribute('data-parent') == stateId) {
                    option.classList.remove('hidden')
                    citySelect.append(option)
                }
            })
        })

        function previewImages(event) {
            const previewContainer = document.getElementById('imagePreviews');
            previewContainer.innerHTML = '';

            const files = event.target.files;
            for (const file of files) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const div = document.createElement('div');
                    div.className = 'relative';
                    div.innerHTML = `
                <img src="${e.target.result}" class="w-full h-16 object-cover rounded">
                <button type="button" class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-4 h-4 flex items-center justify-center text-xs hover:bg-red-600" onclick="this.parentElement.remove()">×</button>
            `;
                    previewContainer.appendChild(div);
                };
                reader.readAsDataURL(file);
            }
        }

        uploader.addEventListener('change', function () {
            previewImages(event)
        })
    })
</script>
