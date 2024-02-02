<?php

use Botble\Base\Facades\BaseHelper;
use Datlechin\WhatsAppFloatingButton\Http\Controllers\WhatsAppFloatingButtonSettingController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => sprintf('%s/whatsapp-floating-button', BaseHelper::getAdminPrefix()),
    'as' => 'whatsapp-floating-button.',
    'middleware' => ['core', 'web', 'auth'],
    'permission' => 'whatsapp-floating-button.settings',
], function () {
    Route::get('/', [WhatsAppFloatingButtonSettingController::class, 'edit'])->name('settings');
    Route::put('/', [WhatsAppFloatingButtonSettingController::class, 'update'])->name('settings.update');
});
