<nav x-data="{ open: false }" class="bg-white border-gray-200 py-2.5 dark:bg-gray-900 shadow-md">
    <div class="flex flex-wrap items-center justify-between max-w-screen-xl px-4 mx-auto">
        <a href="{{ route('home') }}" class="flex items-center">
            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">
                @lang('Task Manager')
            </span>
        </a>

        <div class="flex items-center lg:order-2">
            @auth
                <form class="inline-block" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        @lang('Logout')
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    @lang('Log In')
                </a>
                <a href="{{ route('register') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">
                    @lang('Sign In')
                </a>
            @endauth
        </div>

        <div class="items-center justify-between hidden w-full lg:flex lg:w-auto lg:order-1">
            <ul class="flex flex-col  font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                <li>
                    <a href="{{ route('tasks.index') }}" class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">
                        @lang('Tasks')
                    </a>
                </li>
                <li>
                    <a href="{{ route('task_statuses.index') }}" class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">
                        @lang('Statuses')
                    </a>
                </li>
                <li>
                    <a href="{{ route('labels.index') }}" class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">
                        @lang('Tags')
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>