@extends('layouts.app')

@section('title', 'Home - Car Findal Service')

@section('content')
    @if (session('error'))
        <div id="errorToast"
            class="bg-red-100 absolute top-0 left-0 right-0 z-30 border-l-4 w-[300px] mx-auto border-red-500 text-red-700 py-4 flex items-center justify-center mb-4"
            role="alert">
            {{ session('error') }}

            <button class="ml-5" id="closeBtn">X</button>
        </div>
    @endif
    <x-hero-slider :makers="$makers" :models="$models" :states="$states" :cities="$cities" :carTypes="$carTypes"
        :fuelTypes="$fuelTypes" />
    <x-car-search-form :makers="$makers" :models="$models" :states="$states" :cities="$cities" :carTypes="$carTypes"
        :fuelTypes="$fuelTypes" />
    <x-car-listing :cars="$latestCars" />
@endsection

<script type="module">
    document.addEventListener('DOMContentLoaded', function() {
        const errorToast = document.getElementById('errorToast');
        const closeBtn = document.getElementById('closeBtn');
        const unreadCount = document.querySelector('#unread-count')
        if (errorToast) {
            closeBtn.addEventListener('click', function() {
                errorToast.style.display = 'none';
            });

            setTimeout(() => {
                errorToast.style.display = 'none';
            }, 3000);
        }

        Echo.private('message').listen('SendMessage', (e) => {
            
            let c = 0

            if (e.message.length > 1) {
                e.message?.forEach(m => {

                    c += 1
                });
            } else {
                c = 1
            }

            if (unreadCount.getAttribute('data-id') == e.conversation?.receiver_id || unreadCount.getAttribute('data-id') == e.conversation?.sender_id ) {
                console.log('gg')
                    unreadCount.classList.remove('hidden');
                    unreadCount.classList.add('!block')
                    unreadCount.innerText = c
            }
        })



    });
</script>
