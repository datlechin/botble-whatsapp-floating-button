<?php

use Botble\Base\Facades\BaseHelper;
use Datlechin\WhatsAppFloatingButton\Http\Controllers\WhatsAppFloatingButtonSettingController;
use Illuminate\Support\Facades\Route;

Route::prefix(BaseHelper::getAdminPrefix() . '/whatsapp-floating-button')
    ->name('whatsapp-floating-button.settings')
    ->middleware(['core', 'web', 'auth'])
    ->group(function () {
        Route::get('/', [WhatsAppFloatingButtonSettingController::class, 'edit']);
        Route::put('/', [WhatsAppFloatingButtonSettingController::class, 'update'])->name('.update');
    });
