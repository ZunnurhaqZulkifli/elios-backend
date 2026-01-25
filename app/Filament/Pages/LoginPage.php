<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Concerns\InteractsWithFormActions;
use Filament\Pages\SimplePage;
use Filament\Schemas\Components\Actions;
use Filament\Forms\Form;
use Filament\Schemas\Components\Utilities\Get;
use App\Helpers\NotificationHelper;
use App\Models\CurrentProject;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Auth\Http\Responses\Contracts\LoginResponse;
use Filament\Forms\Components\Component;
use Filament\Notifications\Notification;
use Filament\Schemas\Schema;

class LoginPage extends SimplePage implements HasForms
{
    use InteractsWithFormActions;
    use InteractsWithForms;

    public ?bool $remember = false;
    public ?string $email;
    public ?string $password;
    
    public ?array $data = [];

    protected string $view = 'filament.pages.login-page';

    public function mount() :void
    {
        if(Filament::auth()->check()) {
            redirect()->intended(Filament::getUrl());
        }

        $this->form->fill();
    }

    public function form(Schema $form): Schema
    {
        return $form
            ->schema([
                TextInput::make('email')
                    ->label('Email')
                    ->placeholder('Masukkan Email Anda')
                    ->email()
                    ->required(),

                TextInput::make('password')
                    ->label('Password')
                    ->placeholder('Masukkan Kata Laluan Anda')
                    ->revealable()
                    ->password()
                    ->required(),

                Checkbox::make('remember')
                    ->label('Ingat Saya')
                    ->default(false),

                Actions::make([
                    Action::make('Log Masuk')
                        ->action(function (Get $get) {
                            $this->authenticate();
                            return redirect()->intended(Filament::getUrl());
                        }),
                ])
                    ->fullWidth()
                    ->alignEnd(),
            ]);
    }

    public function authenticate(): ?LoginResponse
    {
        try {
            $this->rateLimit(10, 10);
        } catch (TooManyRequestsException $exception) {
            NotificationHelper::make('error', 'Terlalu Banyak Permintaan, Sila Tunggu ' . $exception->secondsUntilAvailable . ' saat lagi !');
            $this->getRateLimitedNotification($exception)?->send();
        }

        $data = $this->form->getState();

        if (Filament::auth()->attempt([ 'email' => $data['email'], 'password' => $data['password']], true)) {
            NotificationHelper::make('success', __('Assalamualaikum, Selamat Datang, ' . Filament::auth()->user()->name . '!'));

            session()->regenerate();

            session(['project_id' => CurrentProject::id()]);

            return app(LoginResponse::class);
        }

        NotificationHelper::make('error', 'Gagal Log Masuk, Sila Semak Kembali Email dan Kata Laluan Anda !');
        return null;
    }

    protected function getRateLimitedNotification(TooManyRequestsException $exception): ?Notification
    {
        return Notification::make()
            ->title(__('filament-panels::pages/auth/login.notifications.throttled.title', [
                'seconds' => $exception->secondsUntilAvailable,
                'minutes' => $exception->minutesUntilAvailable,
            ]))
            ->body(array_key_exists('body', __('filament-panels::pages/auth/login.notifications.throttled') ?: []) ? __('filament-panels::pages/auth/login.notifications.throttled.body', [
                'seconds' => $exception->secondsUntilAvailable,
                'minutes' => $exception->minutesUntilAvailable,
            ]) : null)
            ->danger();
    }

    protected function hasFullWidthFormActions(): bool
    {
        return true;
    }
}