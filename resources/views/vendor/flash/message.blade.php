@foreach (session('flash_notification', collect())->toArray() as $message)
    @if ($message['overlay'])
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title' => $message['title'],
            'body' => $message['message']
        ])
    @else
        <div class="
            w-full max-w-xs mx-auto
            px-4 py-2 mb-3
            rounded-md 
            text-sm text-white
            {{ $message['level'] === 'success' ? 'bg-green-400' : '' }}
            {{ $message['level'] === 'danger' ? 'bg-red-400' : '' }}
            {{ $message['level'] === 'warning' ? 'bg-yellow-500 text-black' : '' }}
            {{ $message['level'] === 'info' ? 'bg-blue-500' : '' }}
            {{ $message['important'] ? 'border-2 border-black' : '' }}
        " role="alert">
            <div class="flex justify-between items-center">
                <span class="w-full text-center">@lang($message['message'])</span>
                @if ($message['important'])
                    <button type="button"
                            class="ml-4 text-white hover:text-gray-200"
                            x-on:click="$el.parentElement.parentElement.remove()"
                            aria-label="Close"
                    >&times;</button>
                @endif
            </div>
        </div>
    @endif
@endforeach

{{ session()->forget('flash_notification') }}

