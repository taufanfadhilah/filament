<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Employee;

class ListEmployees extends ListRecords
{
    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\CreateAction::make()];
    }

    public function getTabs(): array
    {
        return [
            'All' => Tab::make(),
            'This week' => Tab::make()->modifyQueryUsing(
                fn(Builder $query) => $query->where(
                    'date_hired',
                    '>=',
                    now()->subWeek()
                )
            )->badge(Employee::query()->where('date_hired', '>=', now()->subWeek())->count()),
            'This month' => Tab::make()->modifyQueryUsing(
                fn(Builder $query) => $query->where(
                    'date_hired',
                    '>=',
                    now()->subMonth()
                )
            )->badge(Employee::query()->where('date_hired', '>=', now()->subMonth())->count()),
            'This year' => Tab::make()->modifyQueryUsing(
                fn(Builder $query) => $query->where(
                    'date_hired',
                    '>=',
                    now()->subYear()
                )
            )->badge(Employee::query()->where('date_hired', '>=', now()->subYear())->count()),
        ];
    }
}
