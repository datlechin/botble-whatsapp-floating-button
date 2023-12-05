<?php

namespace Datlechin\WhatsAppFloatingButton\Http\Controllers;

use Botble\Base\Facades\Assets;
use Botble\Base\Facades\PageTitle;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\JsValidation\Facades\JsValidator;
use Botble\Setting\Facades\Setting;
use Datlechin\WhatsAppFloatingButton\Http\Requests\WhatsAppFloatingButtonSettingRequest;
use Illuminate\Contracts\View\View;

class WhatsAppFloatingButtonSettingController extends BaseController
{
    public function edit(): View
    {
        PageTitle::setTitle(trans('plugins/whatsapp-floating-button::whatsapp-floating-button.name'));

        Assets::addScripts(['jquery-validation', 'form-validation']);

        $jsValidation = JsValidator::formRequest(WhatsAppFloatingButtonSettingRequest::class);

        return view('plugins/whatsapp-floating-button::settings', compact('jsValidation'));
    }

    public function update(WhatsAppFloatingButtonSettingRequest $request): BaseHttpResponse
    {
        foreach ($request->validated() as $key => $value) {
            Setting::set(sprintf('whatsapp-floating-button.%s', $key), $value);
        }

        Setting::save();

        return BaseHttpResponse::make()
            ->setMessage(trans('core/base::notices.update_success_message'));
    }
}
