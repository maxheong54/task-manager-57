<x-app-layout>
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
        <div class="grid col-span-full">
            <h1 class="mb-5 text-5xl">@lang('Statuses')</h1>

            @can('create', App\Models\TaskStatus::class)
                <div>
                    <a href="{{ route('task_statuses.create') }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        @lang('Create a status')
                    </a>
                </div>
            @endcan

            <table class="mt-4">
                <thead class="border-b-2 border-solid border-black text-left">
                    <tr>
                        <th>@lang('ID')</th>
                        <th>@lang('Name')</th>
                        <th>@lang('Date of creation')</th>
                        <th>@lang('Actions')</th>
                    </tr>
                </thead>
                @foreach ($taskStatuses as $status)
                    <tr class="border-b border-dashed text-left">
                        <td>@lang($status->id)</td>
                        <td>@lang($status->name)</td>
                        <td>@lang($status->created_at->format('d.m.Y'))</td>
                        <td>
                            @can('update', $status)
                                <form method="POST" action="{{ route('task_statuses.destroy', $status) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="@lang('Are you sure')" class="text-red-600 hover:text-red-900">
                                        @lang('Delete')
                                    </button>
                                </form>

                                <a class="text-blue-600 hover:text-blue-900" href="{{ route('task_statuses.edit', $status) }}">
                                    @lang('Change')
                                </a>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </table>
            <x-pagination :paginator="$taskStatuses" />
        </div>
    </div>
</x-app-layout>