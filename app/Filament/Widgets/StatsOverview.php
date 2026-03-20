<?php

namespace App\Filament\Widgets;

use App\Models\Application;
use App\Models\Student;
use App\Models\Institution;
use App\Models\Inquiry;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Students', Student::count())
                ->description('Registered students')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),
            Stat::make('Pending Applications', Application::where('status', 'pending')->count())
                ->description('Applications waiting for review')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('warning'),
            Stat::make('Partner Institutions', Institution::count())
                ->description('Universities worldwide')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('success'),
            Stat::make('Unread Inquiries', Inquiry::where('status', 'unread')->count())
                ->description('Contact messages to reply')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('danger'),
        ];
    }
}
