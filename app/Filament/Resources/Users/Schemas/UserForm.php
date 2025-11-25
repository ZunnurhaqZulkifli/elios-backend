<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('profileable_type'),
                
                TextInput::make('profileable_id')
                    ->numeric(),
                    
                TextInput::make('name')
                    ->required(),
                    
                TextInput::make('username')
                    ->required(),
                    
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                    
                TextInput::make('role')
                    ->required()
                    ->default('User'),
                    
                Select::make('status')
                    ->options(['active' => 'Active', 'inactive' => 'Inactive'])
                    ->default('active')
                    ->required(),
                    
                DateTimePicker::make('email_verified_at'),
                
                TextInput::make('password')
                    ->password()
                    ->required(),
                    
                TextInput::make('settings'),
                TextInput::make('previous_settings'),
            ]);
    }
}
