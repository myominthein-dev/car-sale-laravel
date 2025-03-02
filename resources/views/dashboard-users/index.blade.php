@extends('layouts.app')

@section('content')



<div class="pt-6 px-4">
    <x-back-btn/>
    <div class="mb-4 flex flex-col md:flex-row items-start md:items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Users</h1>
            <p class="mt-1 text-sm text-gray-600">Manage users in the system</p>
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
                <h3 class="text-lg font-semibold text-gray-900">All Users</h3>
                <span class="px-3 py-1 text-xs text-green-600 bg-green-100 rounded-full">{{ $users->count() ?? 0 }} Total</span>
            </div>
           
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-4 py-3">ID</th>
                        <th scope="col" class="px-4 py-3">Image</th>
                        <th scope="col" class="px-4 py-3">Name</th>
                        <th scope="col" class="px-4 py-3">Email</th>
                        <th scope="col" class="px-4 py-3">Phone</th>
                        <th scope="col" class="px-4  py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users ?? [] as $user)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $user->id }}</td>
                        <td class="px-4 py-3">
                            <img class="size-14 object-cover" src="{{ asset('/storage/'.$user->avatar)}}" alt="">
                        </td>
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $user->name }}</td>
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $user->email }}</td>
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $user->phone }}</td>

                        <td class="px-4 py-3  h-full ">
                           <div >
                            
                            <form action="{{ route('profile.destroy') }}" method="POST" class="inline-block delete-form">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
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
            {{ $users->links() }}
        </div>
    </div>
</div>


@endsection


