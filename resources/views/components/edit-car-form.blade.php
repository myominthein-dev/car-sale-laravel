<div class="max-w-3xl my-5 mx-auto p-6 bg-white rounded-lg ">
    <h2 class="text-xl font-semibold text-gray-800 mb-6">Edit your car</h2>

    
    <form enctype="multipart/form-data" action="{{ route('cars.update',$car) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        <div class="sm:grid grid-cols-3 gap-3">
            <div class="col-span-2 flex flex-col gap-5">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Maker</label>
                        <select name="maker" id="maker-create"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 
                            @error('maker') border-red-500 @enderror">
                            <option value="">Maker</option>
                            @foreach ($makers as $maker)
                                <option {{ $maker->id == $car->maker_id ? 'selected' : '' }} value="{{ $maker->id }}">
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
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500
                            @error('model') border-red-500 @enderror">
                            <option value="">Select Model</option>
                            @foreach ($models as $model)
                                <option data-parent="{{ $model->maker_id }}" 
                                    {{$model->id == $car->model_id ? 'selected' : '' }}   
                                    class="{{ $model->id == $car->model_id ? '' : 'hidden' }}" 
                                    value="{{ $model->id }}">
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
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500
                            @error('year') border-red-500 @enderror">
                            <option value="">Year</option>
                            @for ($i = date('Y'); $i >= 1900; $i--)
                                <option {{ $car->year == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        @error('year')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
    
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Car Type</label>
                    <div class="flex flex-wrap gap-4">
                        @foreach ($carTypes as $carType)
                            <label class="inline-flex items-center">
                                <input {{ $carType->id == $car->car_type_id ? 'checked' : '' }} 
                                    type="radio" 
                                    name="car_type" 
                                    value="{{ $carType->id }}"
                                    class="text-blue-600 focus:ring-blue-500 @error('car_type') border-red-500 @enderror">
                                <span class="ml-2">{{ $carType->name }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('car_type')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
    
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                        <input value="{{old('price',$car->price)}}" 
                            type="number" 
                            name="price" 
                            placeholder="Price"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500
                            @error('price') border-red-500 @enderror">
                        @error('price')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Vin Code</label>
                        <input value="{{old('vin',$car->vin)}}" 
                            type="text" 
                            name="vin_code" 
                            placeholder="Vin Code"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500
                            @error('vin_code') border-red-500 @enderror">
                        @error('vin_code')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Mileage (mi)</label>
                        <input value="{{old('mileage',$car->mileage)}}" 
                            type="number" 
                            name="mileage" 
                            placeholder="Mileage"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500
                            @error('mileage') border-red-500 @enderror">
                        @error('mileage')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
    
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Fuel Type</label>
                    <div class="flex flex-wrap gap-4">
                        @foreach ($fuelTypes as $fuelType)
                            <label class="inline-flex items-center">
                                <input {{ $fuelType->id == $car->fuel_type_id ? 'checked' : '' }} 
                                    type="radio" 
                                    name="fuel_type" 
                                    value="{{ $fuelType->id }}"
                                    class="text-blue-600 focus:ring-blue-500 @error('fuel_type') border-red-500 @enderror">
                                <span class="ml-2">{{ $fuelType->name }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('fuel_type')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
    
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">State/Region</label>
                        <select name="state" id="state-create"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500
                            @error('state') border-red-500 @enderror">
                            <option value="">State/Region</option>
                            @foreach ($states as $state)
                                <option {{ $state->id == $car->city->state_id ? 'selected' : '' }} 
                                    value="{{ $state->id }}">{{ $state->name }}</option>
                            @endforeach
                        </select>
                        @error('state')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">City</label>
                        <select name="city" id="city-create"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500
                            @error('city') border-red-500 @enderror">
                            <option value="">City</option>
                            @foreach ($cities as $city)
                                <option {{ $city->id == $car->city_id ? 'selected' : '' }} 
                                    class="hidden" 
                                    data-parent="{{ $city->state_id }}" 
                                    value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                        @error('city')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
    
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                        <input value="{{old('address',$car->address)}}" 
                            type="text" 
                            name="address" 
                            placeholder="Address"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500
                            @error('address') border-red-500 @enderror">
                        @error('address')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                        <input value="{{old('phone',$car->phone)}}" 
                            type="tel" 
                            name="phone" 
                            placeholder="Phone"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500
                            @error('phone') border-red-500 @enderror">
                        @error('phone')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
    
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-2 my-5">
                    @foreach ($carFeatures as $key => $value)
                        <label class="inline-flex items-center">
                            <input type="checkbox" 
                                {{ $value == 1 ? 'checked' : '' }}  
                                name="features[{{ $key }}]" 
                                value="1"
                                class="text-blue-600 rounded focus:ring-blue-500">
                            <span class="ml-2">{{ Str::title(str_replace('_', ' ', $key)) }}</span>
                        </label>
                    @endforeach
                    @error('features')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
    
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Detailed Description</label>
                    <textarea name="description" 
                        rows="4"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500
                        @error('description') border-red-500 @enderror">{{ old('description',$car->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
    
            <div class="col-span-1 border-l-2">
                <div class="space-y-4">
                    <div class="p-4 text-center">
                        <svg class="mx-auto h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <input name="images[]" 
                            id="imgUpload" 
                            type="file" 
                            multiple
                            class="mt-2 w-20 text-sm text-gray-500 opacity-0 absolute cursor-pointer" />
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
                        @foreach ($carImages as $carImage)
                            <div class="relative">
                                <img src="{{ asset('/storage/car_images/'.$carImage->image_path) }}" 
                                    class="w-full h-16 object-cover rounded">
                                <button type="button" 
                                    class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-4 h-4 flex items-center justify-center text-xs hover:bg-red-600" 
                                    onclick="this.parentElement.remove()">×</button>
                            </div>
                        @endforeach
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
                Update Car
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
