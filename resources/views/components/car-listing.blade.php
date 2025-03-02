<!-- resources/views/components/car-listing.blade.php -->
<section class=" py-12">
    <div class="container relative mx-auto px-4">
        <h2 class="text-2xl font-bold mb-6">Latest Added Cars</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($cars as $car)
                <x-car-card :car="$car" />
            @endforeach
        </div>

        <div class="mt-10">
            {{ $cars->links() }}
        </div>
    </div>
</section>