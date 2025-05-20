<x-filament::section class="{{ $bgColorClass }} border-0">
    <div class="flex items-center gap-4">
        <div class="rounded-full bg-primary-500/10 p-3">
            @if ($timeIcon === 'heroicon-o-sun')
                <x-heroicon-o-sun class="h-6 w-6 text-primary-500" />
            @else
                <x-heroicon-o-moon class="h-6 w-6 text-primary-500" />
            @endif
        </div>

        <div>
            <h2 class="text-xl font-bold tracking-tight sm:text-2xl">
                {{ $greeting }}{{ !empty($userName) ? ', ' . $userName : '' }}!
            </h2>

            <p class="text-sm text-gray-500 dark:text-gray-400">
                {{ $currentTime }}
            </p>
        </div>
    </div>
</x-filament::section>
