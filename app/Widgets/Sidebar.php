<?php

namespace App\Widgets;

use App\Support\Utils\SidebarItem;
use Arrilot\Widgets\AbstractWidget;

class Sidebar extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'active_page_index' => '',
        'active_sub_page_index' => '',
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        return view('backend.widgets.sidebar', [
            'active_page_index' => $this->config['active_page_index'],
            'active_sub_page_index' => $this->config['active_sub_page_index'],
            'items' => $this->createMenuItems()
        ]);
    }

    private function createMenuItems()
    {
        $elements = [
            'home' => new SidebarItem('Ana Sayfa', 'bxs-dashboard', route('backend.home'), 'home_view'),

            'settings' => new SidebarItem('Ayarlar', 'mdi mdi-cog-outline', '', 'setting_view', '', [
                'config' => new SidebarItem('Ayarlar', 'fa-th-large', route('backend.config.index'), 'config_index'),
            ]),
        ];

        return $elements;
    }
}
