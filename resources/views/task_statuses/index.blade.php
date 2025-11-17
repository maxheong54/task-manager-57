<x-app-layout>
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
        <div class="grid col-span-full">
            <h1 class="mb-5 text-5xl">{{ __('Statuses') }}</h1>

            @auth
                <div>
                    <a href="{{ route('task_statuses.create') }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        {{ __('Create a status') }}
                    </a>
                </div>
            @endauth

            <table class="mt-4">
                <thead class="border-b-2 border-solid border-black text-left">
                    <tr>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Date of creation') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
                @foreach ($taskStatuses as $status)
                    <tr class="border-b border-dashed text-left">
                        <td>{{ $status->id }}</td>
                        <td>{{ $status->name }}</td>
                        <td>{{ $status->created_at->format('d.m.Y') }}</td>
                        <td>
                            @auth
                                <a href="{{ route('task_statuses.destroy', $status) }}"
                                    class="text-red-600 hover:text-red-900"
                                    onclick="event.preventDefault(); if (confirm('{{ __('Are you sure?') }}')) document.getElementById('delete-status-{{ $status->id }}').submit();">
                                    {{ __('Delete') }}
                                </a>

                                <form id="delete-status-{{ $status->id }}" method="POST"
                                    action="{{ route('task_statuses.destroy', $status) }}" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>


                                <a class="text-blue-600 hover:text-blue-900" href="{{ route('task_statuses.edit', $status) }}">
                                    {{ __('Change') }}
                                </a>
                            @endauth
                        </td>
                    </tr>
                @endforeach
            </table>
            <x-pagination :paginator="$taskStatuses" />
        </div>
    </div>
</x-app-layout>