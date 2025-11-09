<x-app-layout>
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
        <div class="grid col-span-full">
            <h2 class="mb-5">
                @lang('View task'): {{ $task->name }}<a
                    href="{{ route('tasks.edit', $task) }}">&#9881;</a>
                </h2>
                <p><span class="font-black">@lang('Name'):</span> {{ $task->name }}</p>
                <p><span class="font-black">@lang('Status'):</span> {{ $task->status->name }}</p>
                <p><span class="font-black">@lang('Description'):</span> {{ $task->description }}</p>
                <p><span class="font-black">@lang('Tags')</span></p>
                <div>
                    <div
                        class="text-xs inline-flex items-center font-bold leading-sm uppercase px-3 py-1 bg-blue-200 text-blue-700 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        {{-- документация --}}
                    </div>
        </div>
    </div>
</x-app-layout>