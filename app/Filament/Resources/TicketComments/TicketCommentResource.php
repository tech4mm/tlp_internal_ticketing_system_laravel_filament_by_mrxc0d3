<?php

namespace App\Filament\Resources\TicketComments;

use App\Filament\Resources\TicketComments\Pages\CreateTicketComment;
use App\Filament\Resources\TicketComments\Pages\EditTicketComment;
use App\Filament\Resources\TicketComments\Pages\ListTicketComments;
use App\Filament\Resources\TicketComments\Schemas\TicketCommentForm;
use App\Filament\Resources\TicketComments\Tables\TicketCommentsTable;
use App\Models\TicketComment;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TicketCommentResource extends Resource
{
    protected static ?string $model = TicketComment::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ChatBubbleBottomCenterText;
    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'TicketComment';

    public static function form(Schema $schema): Schema
    {
        return TicketCommentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TicketCommentsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTicketComments::route('/'),
            'create' => CreateTicketComment::route('/create'),
            'edit' => EditTicketComment::route('/{record}/edit'),
        ];
    }
}
