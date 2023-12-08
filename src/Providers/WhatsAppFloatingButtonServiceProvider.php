<?php

namespace Datlechin\WhatsAppFloatingButton\Providers;

use Botble\Base\Facades\DashboardMenu;
use Botble\Base\Supports\ServiceProvider;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Theme\Facades\Theme;
use Illuminate\Routing\Events\RouteMatched;

class WhatsAppFloatingButtonServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function boot(): void
    {
        $this
            ->setNamespace('plugins/whatsapp-floating-button')
            ->loadRoutes()
            ->loadAndPublishTranslations()
            ->publishAssets()
            ->loadAndPublishViews();

        $this->app->booted(function () {
            $this->app['events']->listen(RouteMatched::class, function () {
                DashboardMenu::make()
                    ->registerItem([
                        'id' => 'plugins-whatsapp-floating-button',
                        'priority' => 9999,
                        'name' => 'plugins/whatsapp-floating-button::whatsapp-floating-button.name',
                        'icon' => version_compare('7.0.0', get_core_version(), '>=') ? 'ti ti-brand-whatsapp' : 'fab fa-whatsapp',
                        'url' => route('whatsapp-floating-button.settings'),
                    ]);

                if (setting('whatsapp-floating-button.enabled')) {
                    Theme::asset()
                        ->usePath(false)
                        ->add('floating-wpp-css', asset('vendor/core/plugins/whatsapp-floating-button/css/floating-wpp.min.css'));

                    Theme::asset()
                        ->container('footer')
                        ->usePath(false)
                        ->add('floating-wpp-js', asset('vendor/core/plugins/whatsapp-floating-button/js/floating-wpp.min.js'), ['jquery'])
                        ->add('whatsapp-floating-button-js', asset('vendor/core/plugins/whatsapp-floating-button/js/whatsapp-floating-button.js'), ['floating-wpp-js']);

                    add_filter(THEME_FRONT_FOOTER, function (string|null $data): string|null {
                        return $data . sprintf(
                            '<div id="whatsapp-floating-button" data-phone="%s" data-popup-message="%s" data-show-popup="%s" data-popup-title="%s" data-position="%s"></div>',
                            setting('whatsapp-floating-button.phone_number'),
                            setting('whatsapp-floating-button.popup_message'),
                            setting('whatsapp-floating-button.show_popup', false),
                            setting('whatsapp-floating-button.popup_title'),
                            setting('whatsapp-floating-button.position', 'right')
                        );
                    });
                }
            });
        });
    }
}
