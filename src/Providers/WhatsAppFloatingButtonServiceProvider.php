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
            ->loadAndPublishConfigurations('permissions')
            ->loadAndPublishViews();

        $this->app->booted(function () {
            $this->app['events']->listen(RouteMatched::class, function () {
                DashboardMenu::make()
                    ->registerItem([
                        'id' => 'plugins-whatsapp-floating-button',
                        'priority' => 9999,
                        'name' => 'plugins/whatsapp-floating-button::whatsapp-floating-button.name',
                        'icon' => version_compare(
                            '7.0.0',
                            get_core_version(),
                            '<='
                        ) ? 'ti ti-brand-whatsapp' : 'fab fa-whatsapp',
                        'route' => 'whatsapp-floating-button.settings',
                    ]);

                if (setting('whatsapp-floating-button.enabled')) {
                    Theme::asset()
                        ->usePath(false)
                        ->add(
                            'floating-wpp-css',
                            asset('vendor/core/plugins/whatsapp-floating-button/css/floating-wpp.min.css')
                        );

                    Theme::asset()
                        ->container('footer')
                        ->usePath(false)
                        ->add(
                            'floating-wpp-js',
                            asset('vendor/core/plugins/whatsapp-floating-button/js/floating-wpp.min.js'),
                            ['jquery']
                        );

                    add_filter(THEME_FRONT_FOOTER, function (string|null $data): string {
                        return $data . view('plugins/whatsapp-floating-button::show');
                    });
                }
            });
        });
    }
}
