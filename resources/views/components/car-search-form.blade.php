<!-- resources/views/components/car-search-form.blade.php -->
<section class="bg-white py-5 my-5">
  
    <div class="container mx-auto px-4">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Find Your Perfect Car</h2>

            
        <form id="searchForm" action="{{ route('home.search') }}" method="GET" >
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                <div>
                    <select name="maker_id" id="maker" class="w-full rounded-lg">
                        <option value="">Maker</option>
                        @foreach($makers as $maker)
                            <option value="{{ $maker->id }}">{{ $maker->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <select name="model_id" id="model" class="w-full rounded-lg">
                        <option value="">Model</option>
                        @foreach($models as $model)
                            <option class="hidden" value="{{ $model->id }}" data-parent="{{ $model->maker_id }}">{{ $model->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <select name="state_id" id="state" class="w-full rounded-lg">
                        <option value="">State/Region</option>
                        @foreach($states as $state)
                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <select name="city_id" id="city" class="w-full rounded-lg">
                        <option value="">City</option>
                        @foreach($cities as $city)
                            <option class="hidden" value="{{ $city->id }}" data-parent="{{ $city->state_id }}">{{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <select name="car_type_id" id="type" class="w-full rounded-lg">
                        <option value="">Type</option>
                        @foreach($carTypes as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <input type="number" id="year_from" name="year_from" placeholder="Year From" class="w-full rounded-lg">
                </div>
                <div>
                    <input type="number" id="year_to" name="year_to" placeholder="Year To" class="w-full rounded-lg">
                </div>
                <div>
                    <input type="number" id="price_from" name="price_from" placeholder="Price From" class="w-full rounded-lg">
                </div>
                <div>
                    <input type="number" id="price_to" name="price_to" placeholder="Price To" class="w-full rounded-lg">
                </div>
                <div>
                    <select name="fuel_type_id" id="fuel_type" class="w-full rounded-lg">
                        <option value="">Fuel Type</option>
                        @foreach($fuelTypes as $fuelType)
                            <option value="{{ $fuelType->id }}">{{ $fuelType->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="md:col-span-2 lg:col-span-4 mt-5 flex justify-end space-x-2">
                <button type="reset" class="bg-yellow-600   rounded-lg text-white px-4 py-2 ">Reset</button>
                <button type="submit" class="bg-blue-600 rounded-lg text-white px-4 py-2 ">Search</button>
            </div>
        </form>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const makerSelect = document.getElementById("maker");
        const modelSelect = document.getElementById("model");
        const allModels = Array.from(modelSelect.querySelectorAll("option[data-parent]"));

        const stateSelect = document.getElementById('state');
        const citySelect = document.getElementById('city');
        const cityOptions = Array.from(citySelect.querySelectorAll("option[data-parent]"));

       


        makerSelect.addEventListener("change", function () {
            const makerId = this.value;

            modelSelect.innerHTML = "<option value=''>Model</option>"

            allModels.forEach(option => {
                if (option.getAttribute('data-parent') == makerId) {
                    option.classList.remove('hidden');
                    modelSelect.append(option)
                }
            });
        })

        stateSelect.addEventListener("change", function () {
            const stateId = this.value

            citySelect.innerHTML = "<option value=''>City</option>";

            cityOptions.forEach(option => {
                if (option.getAttribute('data-parent') == stateId) {
                    option.classList.remove('hidden')
                    citySelect.append(option)
                }
            })
        })
    })
</script>