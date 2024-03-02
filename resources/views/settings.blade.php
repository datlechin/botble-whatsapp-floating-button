@extends(BaseHelper::getAdminMasterLayoutTemplate())

@section('content')
    <form action="{{ route('whatsapp-floating-button.settings') }}" method="post">
        @method('PUT')
        @csrf

        <x-core-setting::section
            :title="trans('plugins/whatsapp-floating-button::whatsapp-floating-button.name')"
            :description="trans('plugins/whatsapp-floating-button::whatsapp-floating-button.description')"
        >
            <div class="mb-3">
                <x-core-setting::on-off
                    :label="trans('plugins/whatsapp-floating-button::whatsapp-floating-button.enable')"
                    name="enabled"
                    :value="setting('whatsapp-floating-button.enabled')"
                    data-bb-toggle="collapse"
                    data-bb-target=".whatsapp-floating-button-settings"
                />
            </div>

            <div class="whatsapp-floating-button-settings" data-bb-value="1" @style(['display: none' => ! setting('whatsapp-floating-button.enabled')])>
                <x-core-setting::text-input
                    :label="trans('plugins/whatsapp-floating-button::whatsapp-floating-button.phone_number')"
                    :value="setting('whatsapp-floating-button.phone_number')"
                    name="phone_number"
                />

                <x-core-setting::select
                    :label="trans('plugins/whatsapp-floating-button::whatsapp-floating-button.position')"
                    name="position"
                    :value="setting('whatsapp-floating-button.position')"
                    :options="[
                        'right' => trans('plugins/whatsapp-floating-button::whatsapp-floating-button.right'),
                        'left' => trans('plugins/whatsapp-floating-button::whatsapp-floating-button.left'),
                    ]"
                />

                <x-core-setting::text-input
                    type="number"
                    :label="trans('plugins/whatsapp-floating-button::whatsapp-floating-button.offset_x')"
                    :value="setting('whatsapp-floating-button.offset_x', 20)"
                    name="offset_x"
                />

                <x-core-setting::text-input
                    type="number"
                    :label="trans('plugins/whatsapp-floating-button::whatsapp-floating-button.offset_y')"
                    :value="setting('whatsapp-floating-button.offset_y', 20)"
                    name="offset_y"
                />

                <x-core-setting::text-input
                    type="number"
                    :label="trans('plugins/whatsapp-floating-button::whatsapp-floating-button.size')"
                    :value="setting('whatsapp-floating-button.size', 60)"
                    name="size"
                />

                <x-core-setting::text-input
                    type="number"
                    :label="trans('plugins/whatsapp-floating-button::whatsapp-floating-button.z_index')"
                    :value="setting('whatsapp-floating-button.z_index', 999)"
                    name="z_index"
                />

                <div class="mb-3">
                    <x-core-setting::on-off
                        :label="trans('plugins/whatsapp-floating-button::whatsapp-floating-button.show_popup')"
                        name="show_popup"
                        :value="setting('whatsapp-floating-button.show_popup')"
                        data-bb-toggle="collapse"
                        data-bb-target="#popup-settings"
                    />
                </div>

                <fieldset id="popup-settings" data-bb-value="1" @style(['display: none' => ! setting('whatsapp-floating-button.show_popup')])>
                    <x-core-setting::text-input
                        :label="trans('plugins/whatsapp-floating-button::whatsapp-floating-button.popup_title')"
                        :value="setting('whatsapp-floating-button.popup_title')"
                        name="popup_title"
                    />

                    <x-core-setting::textarea
                        :label="trans('plugins/whatsapp-floating-button::whatsapp-floating-button.popup_message')"
                        :value="setting('whatsapp-floating-button.popup_message')"
                        name="popup_message"
                    />
                </fieldset>
            </div>
        </x-core-setting::section>

        <div class="flexbox-annotated-section" style="border: none">
            <div class="flexbox-annotated-section-annotation">
                &nbsp;
            </div>
            <div class="flexbox-annotated-section-content">
                <x-core::button type="submit" color="primary">
                    {{ trans('core/setting::setting.save_settings') }}
                </x-core::button>
            </div>
        </div>
    </form>
@stop

@push('footer')
    {!! $jsValidation !!}
@endpush
