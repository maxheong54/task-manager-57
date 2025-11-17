<x-app-layout>
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
        <div class="grid col-span-full">
            <h1 class="mb-4 text-5xl">{{ __('Create a status') }}</h1>
    
            <form class="w-50" method="POST" action="{{ route('task_statuses.store') }}">
                @csrf
                <div class="flex flex-col">
                    <div>
                        <label for="name">{{ __('Name') }}</label>
                    </div>
                    <div class="mt-2">
                        <input class="rounded border-gray-300 w-2/3" type="text" name="name" id="name">
                        @error('name')
                            <p class="text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mt-2">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                            type="submit">{{ __('Create') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>