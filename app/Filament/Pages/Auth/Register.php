<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Auth\Register as AuthRegister;

class Register extends AuthRegister
{

    /**
     * @return array<int | string, string | Form>
     */
    protected function getForms(): array
    {
        $form = parent::getForms();

        $form['form']->components([...[$this->getFirstNameFormComponent()], ...$form['form']->getComponents()]);

        return $form;
    }

    protected function getFirstNameFormComponent(): Component
    {
        return TextInput::make('first_name')
            ->label('First Name')
            ->required()
            ->maxLength(255)
            ->autofocus()
        ;
    }

    protected function getNameFormComponent(): Component
    {
        return TextInput::make('last_name')
            ->label('Last Name')
            ->required()
            ->maxLength(255)
        ;
    }
}
