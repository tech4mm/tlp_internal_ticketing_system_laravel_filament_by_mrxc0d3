<?php

namespace App\Filament\Resources\Tickets\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section as ComponentsSection;
use Filament\Schemas\Schema;

class TicketForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ComponentsSection::make('Ticket Details')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->hint('Short title for this ticket'),
                        MarkdownEditor::make('description')
                            ->required()
                            ->columnSpanFull()
                            ->hint('Detailed description of the issue'),
                        \Filament\Forms\Components\Select::make('status')
                            ->options([
                                'open' => 'Open',
                                'in_progress' => 'In Progress',
                                'resolved' => 'Resolved',
                                'closed' => 'Closed',
                            ])
                            ->default('open')
                            ->required()
                            ->hint('Current status of the ticket'),
                        \Filament\Forms\Components\Select::make('priority')
                            ->options([
                                'low' => 'Low',
                                'medium' => 'Medium',
                                'high' => 'High',
                                'critical' => 'Critical',
                            ])
                            ->default('medium')
                            ->required()
                            ->hint('Priority level of the ticket'),
                    ]),
                ComponentsSection::make('Client Information')
                    ->schema([
                        TextInput::make('client_id')
                            ->hint('Client identifier (e.g., TLPP-1552)'),
                        TextInput::make('client_name')
                            ->hint('Name of the client (eg., Tyne Aung)'),
                        TextInput::make('client_email')
                            ->email()
                            ->hint('Email address of the client (eg., tyneaung@gmail.com)'),
                        \Filament\Forms\Components\Select::make('client_env')
                            ->options([
                                'windows' => 'Windows',
                                'mac' => 'Mac',
                                'linux' => 'Linux',
                                'iphone' => 'iPhone',
                                'android' => 'Android',
                                'other' => 'Other',
                            ])
                            ->searchable()
                            ->nullable()
                            ->hint('Client operating environment'),
                        \Filament\Forms\Components\Select::make('client_browser')
                            ->options([
                                'chrome' => 'Google Chrome',
                                'firefox' => 'Mozilla Firefox',
                                'safari' => 'Safari',
                                'edge' => 'Microsoft Edge',
                                'opera' => 'Opera',
                                'brave' => 'Brave',
                                'ie' => 'Internet Explorer',
                                'other' => 'Other',
                            ])
                            ->searchable()
                            ->nullable()
                            ->hint('Browser used by the client'),
                        TextInput::make('client_device_model')
                            ->hint('Device model of the client (e.g., iPhone 17 Pro Max)'),
                    ]),


                ComponentsSection::make('Reporter & Assignee')
                    ->schema([
                        \Filament\Forms\Components\Hidden::make('reported_by')
                            ->default(fn() => auth()->id())
                            ->dehydrated(),
                        \Filament\Forms\Components\Select::make('assigned_to')
                            ->relationship('assignedTo', 'name')
                            ->preload()
                            ->searchable()
                            ->nullable()
                            ->hint('Person assigned to handle this ticket'),
                    ]),

                ComponentsSection::make('Bug Tracking')
                    ->schema([
                        DateTimePicker::make('bug_est_time')
                            ->required()
                            ->hint('Estimated time of bug occurrence'),
                        \Filament\Forms\Components\FileUpload::make('attachments')
                            ->multiple()
                            ->disk('public')
                            ->directory('ticket-attachments')
                            ->visibility('public')
                            ->preserveFilenames()
                            ->downloadable()
                            ->openable()
                            ->columnSpanFull()
                            ->hint('Attach relevant files or screenshots'),
                        \Filament\Forms\Components\KeyValue::make('meta')
                            ->columnSpanFull()
                            ->reorderable()
                            ->addButtonLabel('Add Meta')
                            ->hint('Additional metadata related to the ticket'),
                    ]),
            ]);
    }
}
