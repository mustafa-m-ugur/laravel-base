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
            'service' => new SidebarItem('Hizmetler', 'bx-layer', route('backend.services.index'), 'services_index'),
            'employee' => new SidebarItem('Çalışanlar', 'bx-user-circle', route('backend.employees.index'), 'employees_index'),
            'customer' => new SidebarItem('Müşteriler', 'ri-briefcase-2-line', route('backend.customers.index'), 'customers_index'),
            'project' => new SidebarItem('Projeler', 'ri-lightbulb-flash-line', route('backend.projects.index'), 'projects_index'),

            /*'payment_managements' => new SidebarItem('Ödemeler', 'bx-money', 'javascript:void(0);', 'payment_view', '', [
                'payment' => new SidebarItem('Ödeme Listesi', 'ri-briefcase-2-line', route('backend.payments.list'), 'payments_list'),
                'payment_link' => new SidebarItem('Ödeme Linkleri', 'ri-briefcase-2-line', route('backend.payment_links.index'), 'payment_links_index'),
            ]),*/

            'task' => new SidebarItem('Görevler', 'bx-edit', route('backend.tasks.index'), 'tasks_index'),
            'ticket' => new SidebarItem('Destek Sistemi', 'bx-aperture', route('backend.tickets.index'), 'tickets_index'),
            'note' => new SidebarItem('Notlar', 'bx-file', route('backend.notes.index'), 'notes_index'),

            'role' => new SidebarItem('Roller', 'mdi mdi-cog-outline', route('backend.role.index'), 'role_index'),

            /*'settings' => new SidebarItem('Ayarlar', 'mdi mdi-cog-outline', '', 'setting_view', '', [
                'config' => new SidebarItem('Ayarlar', 'fa-th-large', route('backend.config.index'), 'config_index'),
            ]),*/
        ];

        return $elements;
    }
}
