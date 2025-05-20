<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;

class GreetingWidget extends Widget
{
    protected static string $view = 'filament.widgets.greeting-widget';

    // Make this widget appear at the top of the dashboard
    protected static ?int $sort = -3;

    // Set the default column span (width) of the widget
    protected int | string | array $columnSpan = 'full';

    /**
     * Get the appropriate greeting based on the time of day
     */
    protected function getGreeting(): string
    {
        $hour = now()->hour;

        if ($hour >= 5 && $hour < 12) {
            return 'Good Morning';
        } elseif ($hour >= 12 && $hour < 18) {
            return 'Good Afternoon';
        } else {
            return 'Good Evening';
        }
    }

    /**
     * Get the appropriate icon based on the time of day
     */
    protected function getTimeIcon(): string
    {
        $hour = now()->hour;

        if ($hour >= 5 && $hour < 12) {
            return 'heroicon-o-sun';
        } elseif ($hour >= 12 && $hour < 18) {
            return 'heroicon-o-sun';
        } elseif ($hour >= 18 && $hour < 21) {
            return 'heroicon-o-moon';
        } else {
            return 'heroicon-o-moon';
        }
    }

    /**
     * Get the background color class based on the time of day
     */
    protected function getBackgroundColorClass(): string
    {
        $hour = now()->hour;

        if ($hour >= 5 && $hour < 12) {
            return 'bg-amber-50 dark:bg-amber-950/20'; // Morning - light amber
        } elseif ($hour >= 12 && $hour < 18) {
            return 'bg-blue-50 dark:bg-blue-950/20'; // Afternoon - light blue
        } else {
            return 'bg-indigo-50 dark:bg-indigo-950/20'; // Evening/Night - light indigo
        }
    }

    /**
     * Get the authenticated user's name
     */
    protected function getUserName(): string
    {
        if (Auth::check()) {
            return Auth::user()->name;
        }

        return '';
    }

    /**
     * Pass data to the widget view
     */
    protected function getViewData(): array
    {
        return [
            'greeting' => $this->getGreeting(),
            'userName' => $this->getUserName(),
            'currentTime' => now()->format('l, F j, Y'),
            'timeIcon' => $this->getTimeIcon(),
            'bgColorClass' => $this->getBackgroundColorClass(),
        ];
    }
}
