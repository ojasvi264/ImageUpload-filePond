<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if (session('success'))
            <div 
                x-data="{ show: true }" 
                x-init="setTimeout(() => show = false, 5000)" 
                x-show="show"
                class="fixed top-20 right-5 z-50 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow-lg flex items-center space-x-2"
                role="alert"
            >
                <span class="block sm:inline">{{ session('success') }}</span>
                <button @click="show = false" class="ml-2 text-green-700 hover:text-green-900 font-bold">&times;</button>
            </div>
        @endif
        @if (session('failed'))
            <div 
                x-data="{ show: true }" 
                x-init="setTimeout(() => show = false, 5000)" 
                x-show="show"
                class="fixed top-20 right-5 z-50 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded shadow-lg flex items-center space-x-2"
                role="alert"
            >
                <span class="block sm:inline">{{ session('failed') }}</span>
                <button @click="show = false" class="ml-2 text-red-700 hover:text-red-900 font-bold">&times;</button>
            </div>
        @endif
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end mb-4">
                <a href="{{ route('multiple_image.create') }}">
                    <x-default-button>
                        {{ __('Create') }}
                    </x-default-button>
                </a>
            </div>

            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="w-full table-auto border border-gray-300 dark:border-gray-700">
                        <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                            <tr>
                                 <th class="px-4 py-2 border">S.N</th>
                                <th class="px-4 py-2 border">Image</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach($multipleImageList as $index => $image)
                                <tr class="border-t">
                                    <td>{{ ++$index }}</td>
                                    <td class="px-4 py-2 border">
                                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                                            @foreach($image as $img)
                                                <div>
                                                    <img src="{{ asset($img->album) }}" alt="" class="w-32 h-32 object-cover rounded">
                                                </div>
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
