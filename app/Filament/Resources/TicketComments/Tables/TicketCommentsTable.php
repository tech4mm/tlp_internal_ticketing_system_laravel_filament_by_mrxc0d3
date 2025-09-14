<?php

namespace App\Filament\Resources\TicketComments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Table;

class TicketCommentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Stack::make([
                    TextColumn::make('ticket.title')
                        ->icon('heroicon-m-bug-ant')
                        ->label('Ticket')
                        ->sortable()
                        ->searchable()
                        ->extraAttributes(['class' => 'font-semibold text-lg p-1']),

                    TextColumn::make('comment')
                        ->limit(120)
                        ->wrap()
                        ->searchable()
                        ->label('Comment')
                        ->extraAttributes(['class' => 'font-medium text-base p-2']),
                    Split::make([
                        TextColumn::make('user.name')
                            ->icon('heroicon-m-user')
                            ->label('User')
                            ->sortable()
                            ->searchable()
                            ->alignStart()
                            ->size('sm')
                            ->color('gray'),
                        TextColumn::make('updated_at')
                            ->icon('heroicon-m-clock')
                            ->since()
                            ->sortable()
                            ->toggleable(isToggledHiddenByDefault: true)
                            ->label('Updated')
                            ->alignEnd()
                            ->size('sm')
                            ->color('gray'),
                    ])->extraAttributes(['class' => 'px-2 pt-1']),
                ]),
            ])
            ->defaultSort('updated_at', 'desc')
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])


            ->filters([
                //
            ])
            ->recordActions([])
            ->toolbarActions([
                BulkActionGroup::make([]),
            ]);
    }
}
