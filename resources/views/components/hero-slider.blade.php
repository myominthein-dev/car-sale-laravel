<section class="relative min-h-[90dvh]  flex items-center justify-center overflow-hidden">
    {{-- Background Image with Overlay --}}
    <div class="absolute inset-0 z-0">
        <img 
            src="{{ asset('/img/car-png-39071.png') }}" 
            alt="" 
            class="w-full h-full object-cover"
            aria-hidden="true"
        />
        <div class="absolute inset-0 bg-gradient-to-r from-black/80 to-black/40"></div>
    </div>

    {{-- Main Content Container --}}
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            {{-- Hero Text Content --}}
            <div class="text-white space-y-6 animate-fade-in">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight">
                    Drive Your Dreams Today
                </h1>
                <p class="text-lg md:text-xl text-gray-200 max-w-xl">
                    
                </p>
                
                {{-- Features/Benefits --}}
                <div class="grid sm:grid-cols-2 gap-4 pt-6">
                    <div class="flex items-center space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>24/7 Support</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Free Cancellation</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>No Hidden Fees</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Flexible Pickup</span>
                    </div>
                </div>
            </div>

            {{-- Booking Form --}}
            <div class="bg-white p-6 rounded-lg shadow-xl w-full max-w-md mx-auto lg:ml-auto animate-fade-in-up">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Find Your Perfect Car</h2>
                <form class="rounded-lg" action="{{ route('home.search') }}" method="GET" >
            
                    <div class="flex flex-col gap-2">
                        <div class="grid  grid-cols-2 gap-2">
                            <select name="maker_id" id="maker" class="w-full rounded-lg">
                                <option value="">Maker</option>
                                @foreach($makers as $maker)
                                    <option value="{{ $maker->id }}">{{ $maker->name }}</option>
                                @endforeach
                            </select>

                            <select name="model_id" id="model" class="w-full rounded-lg">
                                <option value="">Model</option>
                                @foreach($models as $model)
                                    <option class="hidden" value="{{ $model->id }}" data-parent="{{ $model->maker_id }}">{{ $model->name }}</option>
                                @endforeach
                            </select>
                        </div>
                       
                        <div class="grid grid-cols-2 gap-2">
                            <select name="state_id" id="state" class="w-full rounded-lg">
                                <option value="">State/Region</option>
                                @foreach($states as $state)
                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                @endforeach
                            </select>

                            <select name="city_id" id="city" class="w-full rounded-lg">
                                <option value="">City</option>
                                @foreach($cities as $city)
                                    <option class="hidden" value="{{ $city->id }}" data-parent="{{ $city->state_id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <select name="car_type_id" class="w-full rounded-lg">
                                <option value="">Type</option>
                                @foreach($carTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        
                    </div>
                    <div class="md:col-span-2 lg:col-span-4 mt-5 flex justify-end space-x-2">
                    <button type="submit" class="bg-blue-600 rounded-lg text-white px-4 py-2 ">Find</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Scroll Indicator --}}
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce hidden md:block">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
        </svg>
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

<style>
    @keyframes fade-in {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes fade-in-up {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fade-in 1s ease-out;
    }

    .animate-fade-in-up {
        animation: fade-in-up 1s ease-out;
    }
</style>