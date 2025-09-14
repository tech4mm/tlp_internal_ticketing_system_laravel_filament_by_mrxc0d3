<?php

namespace App\Filament\Resources\TicketComments\Schemas;

use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class TicketCommentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Select::make('ticket_id')
                    ->relationship('ticket', 'title')
                    ->required()
                    ->preload()
                    ->searchable()
                    ->hint('Select the related ticket'),
                \Filament\Forms\Components\Hidden::make('user_id')
                    ->default(fn() => auth()->id())
                    ->dehydrated(),
                MarkdownEditor::make('comment')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
