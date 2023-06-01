<?php

namespace App\Support\Utils;

use Illuminate\Support\Facades\Auth;

class Constant
{
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
        'user', 'role', 'config', 'home', 'setting', 'services'
    ];

    public static function roles()
    {
        $roles = [
            1 => [
                'code' => 'user',
                'name' => 'Kullanıcılar',
                'actions' => [
                    0 => ['name' => 'Görüntüleme', 'code' => 'index'],
                    1 => ['name' => 'Oluşturma', 'code' => 'create'],
                    2 => ['name' => 'Güncelleme', 'code' => 'edit'],
                    3 => ['name' => 'Silme', 'code' => 'destroy']
                ]
            ],

            2 => [
                'code' => 'role',
                'name' => 'Roler',
                'actions' => [
                    0 => ['name' => 'Görüntüleme', 'code' => 'index'],
                    1 => ['name' => 'Oluşturma', 'code' => 'create'],
                    2 => ['name' => 'Güncelleme', 'code' => 'edit'],
                    3 => ['name' => 'Silme', 'code' => 'destroy']
                ]
            ],

            3 => [
                'code' => 'config',
                'name' => 'Ayarlar Sekmesi',
                'actions' => [
                    0 => ['name' => 'Görüntüleme', 'code' => 'view'],
                ]
            ],

            4 => [
                'code' => 'home',
                'name' => 'Ana Sayfa',
                'actions' => [
                    0 => ['name' => 'Görüntüleme', 'code' => 'view'],
                ]
            ],

            5 => [
                'code' => 'services',
                'name' => 'Hizmetler',
                'actions' => [
                    0 => ['name' => 'Görüntüleme', 'code' => 'index'],
                    1 => ['name' => 'Oluşturma', 'code' => 'create'],
                    2 => ['name' => 'Güncelleme', 'code' => 'edit'],
                    3 => ['name' => 'Silme', 'code' => 'destroy']
                ]
            ],
        ];

        return $roles;
    }

    /*
     * Permission list for roles
     * */
    public static $permissions = [];
}
