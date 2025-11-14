@props(['messages'])

@if ($messages)
    <div class="font-medium text-red-600">
        @lang('Oops! Something went wrong:')
    </div>
    <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 dark:text-red-400 space-y-1 list-disc list-inside']) }}>
        @foreach ((array) $messages as $message)
            <li>@lang($message)</li>
        @endforeach
    </ul>
@endif
