<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('multiple_image.store') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- Multiple Image Upload -->
                        <div>
                            <x-input-label for="image" :value="__('Images')" />
                            <input id="image" class="filepond" type="file" name="images[]" multiple />
                            <x-input-error :messages="$errors->get('images')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-3">
                                {{ __('Upload') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            // Register plugins
            FilePond.registerPlugin(
                FilePondPluginFileValidateType,
                FilePondPluginImagePreview,
                FilePondPluginImageEdit
            );

            // Create a FilePond instance
            const inputElement = document.querySelector('input[id="image"]');
            const pond = FilePond.create(inputElement);

            // Configure FilePond server options
            FilePond.setOptions({
                server: {
                    url: '/upload',
                    process: {
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                    },
                },
                allowMultiple: true,
                allowImagePreview: true,
                allowImageEdit: true,
            });
        </script>
    @endsection
</x-app-layout>
