<?php

namespace Datlechin\WhatsAppFloatingButton\Http\Requests;

use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class WhatsAppFloatingButtonSettingRequest extends Request
{
    public function rules(): array
    {
        return [
            'enabled' => ['sometimes', 'boolean'],
            'phone_number' => ['nullable', 'required_if:enabled,1', 'string'],
            'position' => ['required', 'string', Rule::in(['left', 'right'])],
            'show_popup' => ['nullable', 'required_if:enabled,1', 'boolean'],
            'popup_title' => ['nullable', 'required_if:show_popup,1', 'string'],
            'popup_message' => ['nullable', 'required_if:show_popup,1', 'string'],
        ];
    }
}
