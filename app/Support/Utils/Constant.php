<?php

namespace App\Support\Utils;

use Illuminate\Support\Facades\Auth;

class Constant
{
    public static $customer_types = [
        1 => 'Bireysel',
        2 => 'Kurumsal'
    ];

    public static $exp_times = [
        1 => '1 GÜN',
        3 => '3 GÜN',
        5 => '5 GÜN',
        7 => '1 HAFTA',
        21 => '3 HAFTA',
        30 => '1 AY',
        0 => 'SINIRSIZ',
    ];

    public static $project_statuses = [
        1 => 'Görüşme Aşamasında',
        2 => 'Başlandı',
        4 => 'İnceleme',
        3 => 'Tamamlandı',
    ];

    public static $duration_types = [
        1 => 'Dakika',
        2 => 'Saat',
    ];

    public static $order_status_list = [
        1 => 'Onay Bekleniyor',
        2 => 'Hazırlanıyor',
        3 => 'Kargolandı',
        4 => 'Teslim Edildi',
        5 => 'İptal',
    ];

    public static $department_categories = [
        1 => 'Destek Departmanları',
        2 => 'Personel Departmanları',
    ];

    public static $priority = [
        1 => 'Düşük',
        2 => 'Orta',
        3 => 'Yüksek',
    ];

    public static $ticket_statuses = [
        1 => 'Yanıt Bekliyor',
        2 => 'Yanıtlandı',
        3 => 'Çözümlendi',
    ];

    /*
     * Status List
     */
    public static $status_list = [
        0 => 'Pasif',
        1 => 'Aktif',
    ];

    /*
     * IS READ List
     */
    public static $is_read_list = [
        0 => 'Okunmadı',
        1 => 'Okundu',
    ];

    /*
     * notification types
     */
    public static $notification_types = [
        1 => 'Task Create',
        2 => 'Task Reminder',
    ];


    public static $installments = [
        ['title' => 'Tek Çekim', 'installment' => 1],
        ['title' => '2 Taksit', 'installment' => 2],
        ['title' => '3 Taksit', 'installment' => 3],
        ['title' => '4 Taksit', 'installment' => 4],
        ['title' => '5 Taksit', 'installment' => 5],
        ['title' => '6 Taksit', 'installment' => 6],
        ['title' => '7 Taksit', 'installment' => 7],
        ['title' => '8 Taksit', 'installment' => 8],
        ['title' => '9 Taksit', 'installment' => 9],
        ['title' => '10 Taksit', 'installment' => 10],
        ['title' => '11 Taksit', 'installment' => 11],
        ['title' => '12 Taksit', 'installment' => 12],
    ];

    /*
     * Currency List
     */
    public static $currency_list = [
        'TRY', 'USD'
    ];

    /*
     * Gender List
     */
    public static $genders = [
        1 => 'Erkek',
        2 => 'Kadın',
    ];

    /*
     * Permission codes...
     * */
    public static $permission_codes = [
        'user', 'role', 'config', 'home', 'setting', 'services', 'customers', 'employees', 'payments',
        'projects', 'tasks', 'notes', 'tickets', 'payment', 'backends', 'payment_links'
    ];

    public static function roles()
    {
        if (Auth::guard('backend')->user()->backend->backend_plan_id == 1) {

            $roles = [
                3 => [
                    'code' => 'home',
                    'name' => 'Ana Sayfa',
                    'actions' => [
                        0 => ['name' => 'Görüntüleme', 'code' => 'view'],
                    ]
                ],
                11 => [
                    'code' => 'projects',
                    'name' => 'Projeler',
                    'actions' => [
                        0 => ['name' => 'Görüntüleme', 'code' => 'index'],
                        1 => ['name' => 'Oluşturma', 'code' => 'create'],
                        2 => ['name' => 'Güncelleme', 'code' => 'edit'],
                        3 => ['name' => 'Silme', 'code' => 'destroy']
                    ]
                ],
                12 => [
                    'code' => 'tasks',
                    'name' => 'Görevler',
                    'actions' => [
                        0 => ['name' => 'Görüntüleme', 'code' => 'index'],
                        1 => ['name' => 'Oluşturma', 'code' => 'create'],
                        2 => ['name' => 'Güncelleme', 'code' => 'edit'],
                        3 => ['name' => 'Silme', 'code' => 'destroy']
                    ]
                ],
                13 => [
                    'code' => 'notes',
                    'name' => 'Notlar',
                    'actions' => [
                        0 => ['name' => 'Görüntüleme', 'code' => 'index'],
                        1 => ['name' => 'Oluşturma', 'code' => 'create'],
                        2 => ['name' => 'Güncelleme', 'code' => 'edit'],
                        3 => ['name' => 'Silme', 'code' => 'destroy']
                    ]
                ],
                15 => [
                    'code' => 'backends',
                    'name' => 'Hesap Bilgileri',
                    'actions' => [
                        0 => ['name' => 'Görüntüleme', 'code' => 'index'],
                        2 => ['name' => 'Güncelleme', 'code' => 'edit'],
                    ]
                ],
            ];


        } elseif (Auth::guard('backend')->user()->backend->backend_plan_id == 2) {

            $roles = [
                3 => [
                    'code' => 'home',
                    'name' => 'Ana Sayfa',
                    'actions' => [
                        0 => ['name' => 'Görüntüleme', 'code' => 'view'],
                    ]
                ],
                4 => [
                    'code' => 'role',
                    'name' => 'Roller',
                    'actions' => [
                        0 => ['name' => 'Görüntüleme', 'code' => 'index'],
                        1 => ['name' => 'Oluşturma', 'code' => 'create'],
                        2 => ['name' => 'Güncelleme', 'code' => 'edit'],
                        3 => ['name' => 'Silme', 'code' => 'destroy']
                    ]
                ],
                /*5 => [
                    'code' => 'setting',
                    'name' => 'Ayarlar Sekmesi',
                    'actions' => [
                        0 => ['name' => 'Görüntüleme', 'code' => 'view'],
                    ]
                ],*/
                6 => [
                    'code' => 'services',
                    'name' => 'Hizmetler',
                    'actions' => [
                        0 => ['name' => 'Görüntüleme', 'code' => 'index'],
                        1 => ['name' => 'Oluşturma', 'code' => 'create'],
                        2 => ['name' => 'Güncelleme', 'code' => 'edit'],
                        3 => ['name' => 'Silme', 'code' => 'destroy']
                    ]
                ],
                8 => [
                    'code' => 'employees',
                    'name' => 'Çalışanlar',
                    'actions' => [
                        0 => ['name' => 'Görüntüleme', 'code' => 'index'],
                        1 => ['name' => 'Oluşturma', 'code' => 'create'],
                        2 => ['name' => 'Güncelleme', 'code' => 'edit'],
                        3 => ['name' => 'Silme', 'code' => 'destroy']
                    ]
                ],
                11 => [
                    'code' => 'projects',
                    'name' => 'Projeler',
                    'actions' => [
                        0 => ['name' => 'Görüntüleme', 'code' => 'index'],
                        1 => ['name' => 'Oluşturma', 'code' => 'create'],
                        2 => ['name' => 'Güncelleme', 'code' => 'edit'],
                        3 => ['name' => 'Silme', 'code' => 'destroy']
                    ]
                ],
                12 => [
                    'code' => 'tasks',
                    'name' => 'Görevler',
                    'actions' => [
                        0 => ['name' => 'Görüntüleme', 'code' => 'index'],
                        1 => ['name' => 'Oluşturma', 'code' => 'create'],
                        2 => ['name' => 'Güncelleme', 'code' => 'edit'],
                        3 => ['name' => 'Silme', 'code' => 'destroy']
                    ]
                ],
                13 => [
                    'code' => 'notes',
                    'name' => 'Notlar',
                    'actions' => [
                        0 => ['name' => 'Görüntüleme', 'code' => 'index'],
                        1 => ['name' => 'Oluşturma', 'code' => 'create'],
                        2 => ['name' => 'Güncelleme', 'code' => 'edit'],
                        3 => ['name' => 'Silme', 'code' => 'destroy']
                    ]
                ],
                15 => [
                    'code' => 'backends',
                    'name' => 'Hesap Bilgileri',
                    'actions' => [
                        0 => ['name' => 'Görüntüleme', 'code' => 'index'],
                        2 => ['name' => 'Güncelleme', 'code' => 'edit'],
                    ]
                ],
            ];

        } elseif (Auth::guard('backend')->user()->backend->backend_plan_id == 3) {
            $roles = [
                3 => [
                    'code' => 'home',
                    'name' => 'Ana Sayfa',
                    'actions' => [
                        0 => ['name' => 'Görüntüleme', 'code' => 'view'],
                    ]
                ],
                4 => [
                    'code' => 'role',
                    'name' => 'Roller',
                    'actions' => [
                        0 => ['name' => 'Görüntüleme', 'code' => 'index'],
                        1 => ['name' => 'Oluşturma', 'code' => 'create'],
                        2 => ['name' => 'Güncelleme', 'code' => 'edit'],
                        3 => ['name' => 'Silme', 'code' => 'destroy']
                    ]
                ],
                5 => [
                    'code' => 'setting',
                    'name' => 'Ayarlar Sekmesi',
                    'actions' => [
                        0 => ['name' => 'Görüntüleme', 'code' => 'view'],
                    ]
                ],
                6 => [
                    'code' => 'services',
                    'name' => 'Hizmetler',
                    'actions' => [
                        0 => ['name' => 'Görüntüleme', 'code' => 'index'],
                        1 => ['name' => 'Oluşturma', 'code' => 'create'],
                        2 => ['name' => 'Güncelleme', 'code' => 'edit'],
                        3 => ['name' => 'Silme', 'code' => 'destroy']
                    ]
                ],
                7 => [
                    'code' => 'customers',
                    'name' => 'Müşteriler',
                    'actions' => [
                        0 => ['name' => 'Görüntüleme', 'code' => 'index'],
                        1 => ['name' => 'Oluşturma', 'code' => 'create'],
                        2 => ['name' => 'Güncelleme', 'code' => 'edit'],
                        3 => ['name' => 'Silme', 'code' => 'destroy']
                    ]
                ],
                8 => [
                    'code' => 'employees',
                    'name' => 'Çalışanlar',
                    'actions' => [
                        0 => ['name' => 'Görüntüleme', 'code' => 'index'],
                        1 => ['name' => 'Oluşturma', 'code' => 'create'],
                        2 => ['name' => 'Güncelleme', 'code' => 'edit'],
                        3 => ['name' => 'Silme', 'code' => 'destroy']
                    ]
                ],
                /*9 => [
                    'code' => 'payments',
                    'name' => 'Ödemeler',
                    'actions' => [
                        0 => ['name' => 'Ödeme Listesi', 'code' => 'list'],
                    ]
                ],
                16 => [
                    'code' => 'payment_links',
                    'name' => 'Ödeme Linkler',
                    'actions' => [
                        0 => ['name' => 'Görüntüleme', 'code' => 'index'],
                        1 => ['name' => 'Oluşturma', 'code' => 'create'],
                        2 => ['name' => 'Güncelleme', 'code' => 'edit'],
                        3 => ['name' => 'Silme', 'code' => 'destroy']
                    ]
                ],
                10 => [
                    'code' => 'payment',
                    'name' => 'Ödemeler Sekmesi',
                    'actions' => [
                        0 => ['name' => 'Görüntüleme', 'code' => 'view'],
                    ]
                ],*/
                11 => [
                    'code' => 'projects',
                    'name' => 'Projeler',
                    'actions' => [
                        0 => ['name' => 'Görüntüleme', 'code' => 'index'],
                        1 => ['name' => 'Oluşturma', 'code' => 'create'],
                        2 => ['name' => 'Güncelleme', 'code' => 'edit'],
                        3 => ['name' => 'Silme', 'code' => 'destroy']
                    ]
                ],
                12 => [
                    'code' => 'tasks',
                    'name' => 'Görevler',
                    'actions' => [
                        0 => ['name' => 'Görüntüleme', 'code' => 'index'],
                        1 => ['name' => 'Oluşturma', 'code' => 'create'],
                        2 => ['name' => 'Güncelleme', 'code' => 'edit'],
                        3 => ['name' => 'Silme', 'code' => 'destroy']
                    ]
                ],
                13 => [
                    'code' => 'notes',
                    'name' => 'Notlar',
                    'actions' => [
                        0 => ['name' => 'Görüntüleme', 'code' => 'index'],
                        1 => ['name' => 'Oluşturma', 'code' => 'create'],
                        2 => ['name' => 'Güncelleme', 'code' => 'edit'],
                        3 => ['name' => 'Silme', 'code' => 'destroy']
                    ]
                ],
                14 => [
                    'code' => 'tickets',
                    'name' => 'Destek Sistemi',
                    'actions' => [
                        0 => ['name' => 'Görüntüleme', 'code' => 'index'],
                        1 => ['name' => 'Oluşturma', 'code' => 'create'],
                        2 => ['name' => 'Güncelleme', 'code' => 'edit'],
                        3 => ['name' => 'Silme', 'code' => 'destroy']
                    ]
                ],
                15 => [
                    'code' => 'backends',
                    'name' => 'Hesap Bilgileri',
                    'actions' => [
                        0 => ['name' => 'Görüntüleme', 'code' => 'index'],
                        2 => ['name' => 'Güncelleme', 'code' => 'edit'],
                    ]
                ],
            ];
        } else {
            $roles = [
                2 => [
                    'code' => 'config',
                    'name' => 'Ayarlar',
                    'actions' => [
                        0 => ['name' => 'Görüntüleme', 'code' => 'index'],
                        1 => ['name' => 'Güncelleme', 'code' => 'create'],
                    ]
                ],
                3 => [
                    'code' => 'home',
                    'name' => 'Ana Sayfa',
                    'actions' => [
                        0 => ['name' => 'Görüntüleme', 'code' => 'view'],
                    ]
                ],
                4 => [
                    'code' => 'role',
                    'name' => 'Roller',
                    'actions' => [
                        0 => ['name' => 'Görüntüleme', 'code' => 'index'],
                        1 => ['name' => 'Oluşturma', 'code' => 'create'],
                        2 => ['name' => 'Güncelleme', 'code' => 'edit'],
                        3 => ['name' => 'Silme', 'code' => 'destroy']
                    ]
                ],
                5 => [
                    'code' => 'setting',
                    'name' => 'Ayarlar Sekmesi',
                    'actions' => [
                        0 => ['name' => 'Görüntüleme', 'code' => 'view'],
                    ]
                ],
                6 => [
                    'code' => 'services',
                    'name' => 'Hizmetler',
                    'actions' => [
                        0 => ['name' => 'Görüntüleme', 'code' => 'index'],
                        1 => ['name' => 'Oluşturma', 'code' => 'create'],
                        2 => ['name' => 'Güncelleme', 'code' => 'edit'],
                        3 => ['name' => 'Silme', 'code' => 'destroy']
                    ]
                ],
                7 => [
                    'code' => 'customers',
                    'name' => 'Müşteriler',
                    'actions' => [
                        0 => ['name' => 'Görüntüleme', 'code' => 'index'],
                        1 => ['name' => 'Oluşturma', 'code' => 'create'],
                        2 => ['name' => 'Güncelleme', 'code' => 'edit'],
                        3 => ['name' => 'Silme', 'code' => 'destroy']
                    ]
                ],
                8 => [
                    'code' => 'employees',
                    'name' => 'Çalışanlar',
                    'actions' => [
                        0 => ['name' => 'Görüntüleme', 'code' => 'index'],
                        1 => ['name' => 'Oluşturma', 'code' => 'create'],
                        2 => ['name' => 'Güncelleme', 'code' => 'edit'],
                        3 => ['name' => 'Silme', 'code' => 'destroy']
                    ]
                ],
                /*9 => [
                    'code' => 'payments',
                    'name' => 'Ödemeler',
                    'actions' => [
                        0 => ['name' => 'Ödeme Listesi', 'code' => 'list'],
                    ]
                ],
                16 => [
                    'code' => 'payment_links',
                    'name' => 'Ödeme Linkler',
                    'actions' => [
                        0 => ['name' => 'Görüntüleme', 'code' => 'index'],
                        1 => ['name' => 'Oluşturma', 'code' => 'create'],
                        2 => ['name' => 'Güncelleme', 'code' => 'edit'],
                        3 => ['name' => 'Silme', 'code' => 'destroy']
                    ]
                ],
                10 => [
                    'code' => 'payment',
                    'name' => 'Ödemeler Sekmesi',
                    'actions' => [
                        0 => ['name' => 'Görüntüleme', 'code' => 'view'],
                    ]
                ],*/
                11 => [
                    'code' => 'projects',
                    'name' => 'Projeler',
                    'actions' => [
                        0 => ['name' => 'Görüntüleme', 'code' => 'index'],
                        1 => ['name' => 'Oluşturma', 'code' => 'create'],
                        2 => ['name' => 'Güncelleme', 'code' => 'edit'],
                        3 => ['name' => 'Silme', 'code' => 'destroy']
                    ]
                ],
                12 => [
                    'code' => 'tasks',
                    'name' => 'Görevler',
                    'actions' => [
                        0 => ['name' => 'Görüntüleme', 'code' => 'index'],
                        1 => ['name' => 'Oluşturma', 'code' => 'create'],
                        2 => ['name' => 'Güncelleme', 'code' => 'edit'],
                        3 => ['name' => 'Silme', 'code' => 'destroy']
                    ]
                ],
                13 => [
                    'code' => 'notes',
                    'name' => 'Notlar',
                    'actions' => [
                        0 => ['name' => 'Görüntüleme', 'code' => 'index'],
                        1 => ['name' => 'Oluşturma', 'code' => 'create'],
                        2 => ['name' => 'Güncelleme', 'code' => 'edit'],
                        3 => ['name' => 'Silme', 'code' => 'destroy']
                    ]
                ],
                14 => [
                    'code' => 'tickets',
                    'name' => 'Destek Sistemi',
                    'actions' => [
                        0 => ['name' => 'Görüntüleme', 'code' => 'index'],
                        1 => ['name' => 'Oluşturma', 'code' => 'create'],
                        2 => ['name' => 'Güncelleme', 'code' => 'edit'],
                        3 => ['name' => 'Silme', 'code' => 'destroy']
                    ]
                ],
                15 => [
                    'code' => 'backends',
                    'name' => 'Hesap Bilgileri',
                    'actions' => [
                        0 => ['name' => 'Görüntüleme', 'code' => 'index'],
                        2 => ['name' => 'Güncelleme', 'code' => 'edit'],
                    ]
                ],
            ];
        }

        return $roles;
    }

    /*
     * Permission list for roles
     * */
    public static $permissions = [];
}
