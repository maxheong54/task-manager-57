<x-app-layout>
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
        <div class="grid col-span-full">
            <h1 class="mb-5">@lang('Create a task')</h1>

            <form class="w-50" method="POST" action="{{ route('tasks.store') }}">
                @csrf
                <div class="flex flex-col">
                    <div>
                        <label for="name">@lang('Name')</label>
                    </div>
                    <div class="mt-2">
                        <input class="rounded border-gray-300 w-1/3" type="text" name="name" id="name">
                        @error('name')
                            <p class="text-rose-600">@lang($message)</p>
                        @enderror
                    </div>
                    <div class="mt-2">
                        <label for="description">@lang('Description')</label>
                    </div>
                    <div>
                        <textarea class="rounded border-gray-300 w-1/3 h-32" name="description"
                            id="description"></textarea>
                    </div>
                    <div class="mt-2">
                        <label for="status_id">@lang('Status')</label>
                    </div>
                    <div>
                        <select class="rounded border-gray-300 w-1/3" name="status_id" id="status_id">
                            <option selected="selected"></option>
                            @foreach ($taskStatuses as $status)
                                <option value="{{ $status->id }}">@lang($status->name)</option>
                            @endforeach
                        </select>
                        @error('status_id')
                            <p class="text-rose-600">@lang($message)</p>
                        @enderror
                    </div>
                    <div class="mt-2">
                        <label for="status_id">@lang('Executor')</label>
                    </div>
                    <div>
                        <select class="rounded border-gray-300 w-1/3" name="assigned_to_id" id="assigned_to_id">
                            <option selected="selected"></option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-2">
                        <label for="status_id">Метки</label>
                    </div>
                    <div>
                        <select class="rounded border-gray-300 w-1/3 h-32" name="labels[]" id="labels[]" multiple>
                            @foreach ($labels as $label)
                                <option value="{{ $label->id }}">{{ $label->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-2">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                            type="submit">@lang('Create')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>