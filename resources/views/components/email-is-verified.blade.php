<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Пользователь создан!') }}
    </div>

    <div class="mt-4 flex items-center justify-between">

        <form method="GET" action="{{ route('home.index') }}">
            <x-primary-button>
                {{ __('На главную') }}
            </x-primary-button>
        </form>
    </div>
</x-guest-layout>
