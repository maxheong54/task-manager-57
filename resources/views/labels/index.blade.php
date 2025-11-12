<x-app-layout>
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
        <div class="grid col-span-full">
            <h1 class="mb-5 text-5xl">@lang('Tags')</h1>

            @auth
                <div>
                    <a href="{{ route('labels.create') }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    @lang('Create a label') </a>
                </div>
            @endauth

            <table class="mt-4">
                <thead class="border-b-2 border-solid border-black text-left">
                    <tr>
                        <th>@lang('ID')</th>
                        <th>@lang('Name')</th>
                        <th>@lang('Description')</th>
                        <th>@lang('Date of creation')</th>
                        <th>@lang('Actions')</th>
                    </tr>
                </thead>
                @foreach ($labels as $label)
                    <tr class="border-b border-dashed text-left">
                        <td>{{ $label->id }}</td>
                        <td>{{ $label->name }}</td>
                        <td>{{ $label->description }}</td>
                        <td>{{ $label->created_at->format('d.m.Y') }}</td>
                        @auth
                            <td>
                            <form method="POST" action="{{ route('labels.destroy', $label) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="@lang('Are you sure')"
                                        class="text-red-600 hover:text-red-900">
                                        @lang('Delete')
                                    </button>
                                </form>
                                <a class="text-blue-600 hover:text-blue-900" href="{{ route('labels.edit', $label) }}">
                                    @lang('Change') </a>
                            </td>
                        @endauth
                    </tr>
                @endforeach
            </table>


        </div>
    </div>
</x-app-layout>