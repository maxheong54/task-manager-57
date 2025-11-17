<x-app-layout>
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
        <div class="grid col-span-full">
            <h1 class="mb-5 text-5xl">{{ __('Tasks') }}</h1>

        <div class="w-full flex items-center justify-between">
            <form method="GET" action="{{ route('tasks.index') }}" class="flex items-center gap-2">
                <select class="rounded border-gray-300" name="filter[status_id]">
                    <option value="">{{ __('Status') }}</option>
                    @foreach ($taskStatuses as $status)
                        <option value="{{ $status->id }}" @selected($status->id == ($filters['status_id'] ?? null))>
                            {{ $status->name }}
                        </option>
                    @endforeach
                </select>

                <select class="rounded border-gray-300" name="filter[created_by_id]">
                    <option value="">{{ __('Author') }}</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" @selected($user->id == ($filters['created_by_id'] ?? null))>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>

                <select class="rounded border-gray-300" name="filter[assigned_to_id]">
                    <option value="">{{ __('Executor') }}</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" @selected($user->id == ($filters['assigned_to_id'] ?? null))>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>

                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Apply') }}
                </button>
            </form>

            @auth
                <a href="{{ route('tasks.create') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">
                    {{ __('Create a task') }}
                </a>
            @endauth
        </div>


        <table class="mt-4">
            <thead class="border-b-2 border-solid border-black text-left">
                <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Author') }}</th>
                    <th>{{ __('Executor') }}</th>
                    <th>{{ __('Date of creation') }}</th>
                    @auth
                        <th>{{ __('Actions') }}</th>
                    @endauth
                </tr>
            </thead>
            @forelse ($tasks as $task)
                <tr class="border-b border-dashed text-left">
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->status->name }}</td>
                    <td>
                        <a class="text-blue-600 hover:text-blue-900" href="{{ route('tasks.show', $task) }}">
                            {{ $task->name }}
                        </a>
                    </td>
                    <td>{{ $task->createdBy->name }}</td>
                    <td>{{ $task->assignedTo->name ?? '' }}</td>
                    <td>{{ $task->created_at->format('d.m.Y') }}</td>
                    @auth
                        <td class="flex gap-1">
                            {{-- @can('delete', $task)
                                <a href="{{ route('tasks.destroy', $task) }}" class="text-red-600 hover:text-red-900"
                                    onclick="event.preventDefault(); if (confirm('@lang('Are you sure?')')) document.getElementById('delete-task-{{ $task->id }}').submit();">
                                    @lang('Delete')
                                </a>

                                <form id="delete-task-{{ $task->id }}" method="POST" action="{{ route('tasks.destroy', $task) }}"
                                    style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @endcan --}}

                            @if($task->createdBy->is($user))
                                <a href="{{ route('tasks.destroy', $task) }}" class="text-red-600 hover:text-red-900"
                                    onclick="event.preventDefault(); if (confirm('{{ __('Are you sure?') }}')) document.getElementById('delete-task-{{ $task->id }}').submit();">
                                    {{ __('Delete') }}
                                </a>

                                <form id="delete-task-{{ $task->id }}" method="POST" action="{{ route('tasks.destroy', $task) }}"
                                    style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @endif
                            
                            <a class="text-blue-600 hover:text-blue-900" href="{{ route('tasks.edit', $task) }}">
                                {{ __('Change') }}
                            </a>
                        </td>
                    @endauth
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-transparent">
                        {{ __('No tasks found for selected filters') }}
                    </td>
                </tr>
            @endforelse
        </table>

        <x-pagination :paginator="$tasks" />
    </div>
</x-app-layout>