@extends('layouts.app')

@section('content')

<div class="pt-6 px-4">
    <x-back-btn/>
    <div class="mb-4 flex flex-col md:flex-row items-start md:items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Car Brand</h1>
            <p class="mt-1 text-sm text-gray-600">Manage vehicle brand  in the system</p>
        </div>
        <button id="openAddModal" class="mt-4 md:mt-0 text-white bg-blue-600 hover:bg-blue-700  font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            Add Brand Name
        </button>
    </div>

    @if(session('success'))
    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8">
        <div class="sm:flex sm:items-center sm:justify-between mb-4">
            <div class="flex items-center gap-x-3">
                <h3 class="text-lg font-semibold text-gray-900">All Car Brands</h3>
                <span class="px-3 py-1 text-xs text-green-600 bg-green-100 rounded-full">{{ $makers->count() ?? 0 }} Total</span>
            </div>
            <div class="mt-3 sm:mt-0">
                <form action="{{ route('makers.index') }}" method="GET" class="flex items-center">
                   
                    <label for="simple-search" class="sr-only">Search</label>
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input type="text" value="{{ request()->input('search') }}" id="simple-search" name="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full pl-10 p-2" placeholder="Search">
                        <button id="clearBtn" class="absolute {{ request()->input('search') ? '' : 'opacity-0' }} top-2 right-2">X</button>
                    </div>
                    <button type="submit" class="p-2 ml-2 text-sm font-medium text-white bg-blue-600 rounded-lg border border-blue-600 focus:outline-none ">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <span class="sr-only">Search</span>
                    </button>
                   
                </form>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-4 py-3">ID</th>
                        <th scope="col" class="px-4 py-3">Name</th>
                        <th scope="col" class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($makers ?? [] as $maker)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $maker->id }}</td>
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $maker->name }}</td>
                        <td class="px-4 py-3 flex items-center space-x-2">
                            <button type="button" class="edit-btn font-medium text-blue-600 hover:underline" 
                                data-id="{{ $maker->id }}" 
                                data-name="{{ $maker->name }}" >
                                Edit
                            </button>
                            <form action="{{ route('makers.destroy', $maker) }}" method="POST" class="inline-block delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="font-medium text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr class="bg-white border-b">
                        <td colspan="5" class="px-4 py-3 text-center">No car brand found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $makers->links() }}
        </div>
    </div>
</div>
<!-- Add Fuel Type Modal -->
<div id="add-maker-modal"  class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center p-4 w-full md:inset-0 h-modal md:h-full">
    <div class="relative w-full mx-auto  max-w-2xl h-full md:h-auto">
        <div class="relative bg-white rounded-lg shadow">
            <div class="flex justify-between items-start p-4 rounded-t border-b">
                <h3 class="text-xl font-semibold text-gray-900">
                    Add Car Brand
                </h3>
                <button type="button" id="closeAddModal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" >
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            
            <form action="{{ route('makers.store') }}" method="POST">
                @csrf
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                            <input type="text" name="name" id="name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full p-2.5" required>
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                    </div>
                </div>
                <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-700  focus:outline-none  font-medium rounded-lg text-sm px-5 py-2.5 text-center">Save</button>
                    <button type="button" class="text-gray-500 bg-white hover:bg-gray-100  rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10" id="cancelAdd">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Fuel Type Modal -->
@foreach($makers ?? [] as $maker)
<div id="edit-maker-modal"   class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center p-4 w-full md:inset-0 h-modal md:h-full">
    <div class="relative w-full mx-auto max-w-2xl h-full md:h-auto">
        <div class="relative bg-white rounded-lg shadow">
            <div class="flex justify-between items-start p-4 rounded-t border-b">
                <h3 class="text-xl font-semibold text-gray-900">
                    Edit Car Brand
                </h3>
                <button type="button"  class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" id="closeEditModal">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6">
                            <label for="edit-name-{{ $maker->id }}" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                            <input type="text" name="name" id="edit-name" value="{{ $maker->name }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full p-2.5" required>
                        </div>
                        
                    </div>
                </div>
                <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800  focus:outline-none  font-medium rounded-lg text-sm px-5 py-2.5 text-center">Update</button>
                    <button type="button" class="text-gray-500 bg-white hover:bg-gray-100   rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10" id="cancelEdit">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Utility function to safely handle element operations
    function safeQuerySelector(selector) {
        return document.querySelector(selector);
    }

    // Utility function to safely add event listener
    function safeAddEventListener(element, event, handler) {
        if (element) {
            element.addEventListener(event, handler);
        }
    }

    // Modal handling
    const addModal = safeQuerySelector('#add-maker-modal');
    const editModal = safeQuerySelector('#edit-maker-modal');
    const openAddModalBtn = safeQuerySelector('#openAddModal');
    const closeAddModalBtn = safeQuerySelector('#closeAddModal');
    const cancelAddBtn = safeQuerySelector('#cancelAdd');
    const closeEditModalBtn = safeQuerySelector('#closeEditModal');
    const cancelEditBtn = safeQuerySelector('#cancelEdit');
    const editForm = safeQuerySelector('#editForm');
    const editNameInput = safeQuerySelector('#edit-name');
    const clearBtn = safeQuerySelector('#clearBtn');
    // Add Modal Events
    safeAddEventListener(openAddModalBtn, 'click', () => {
        addModal?.classList.remove('hidden');
    });

    safeAddEventListener(closeAddModalBtn, 'click', () => {
        addModal?.classList.add('hidden');
    });

    safeAddEventListener(cancelAddBtn, 'click', () => {
        addModal?.classList.add('hidden');
    });

    // Edit Modal Events
    const editButtons = document.querySelectorAll('.edit-btn');
    editButtons.forEach(button => {
        safeAddEventListener(button, 'click', function() {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            
            if (editForm && editNameInput && editModal) {
                editForm.action = `{{ route('makers.update', '') }}/${id}`;
                editNameInput.value = name;
                editModal.classList.remove('hidden');
            }
        });
    });

    safeAddEventListener(closeEditModalBtn, 'click', () => {
        editModal?.classList.add('hidden');
    });

    safeAddEventListener(cancelEditBtn, 'click', () => {
        editModal?.classList.add('hidden');
    });

    // Delete confirmation
    const deleteForms = document.querySelectorAll('.delete-form');
    deleteForms.forEach(form => {
        safeAddEventListener(form, 'submit', function(e) {
            if (!confirm('Are you sure you want to delete this car brand?')) {
                e.preventDefault();
            }
        });
    });

    // Search form validation
    const searchForm = safeQuerySelector('form[action="{{ route("makers.index") }}"]');
    const searchInput = safeQuerySelector('#simple-search');

   

   safeAddEventListener(clearBtn, 'click', function () {
    searchInput.value = '';
    searchForm.submit();
   })

    // Auto-dismiss alerts
    const alerts = document.querySelectorAll('[role="alert"]');
    if (alerts.length > 0) {
        setTimeout(function() {
            alerts.forEach(alert => {
                alert.classList.add('opacity-0', 'transition-opacity', 'duration-500');
                setTimeout(() => {
                    alert.remove();
                }, 500);
            });
        }, 5000);
    }
});
</script>
@endpush



