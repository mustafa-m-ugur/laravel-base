<?php

namespace App\Models;

use App\Support\Utils\Constant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory;

    use SoftDeletes;


    public $timestamps = false;

    protected $fillable = ['name', 'permissions', 'guard_name', 'slug'];

    public function getPermissionListAttribute()
    {
        return json_decode(
            $this->attributes['permissions'],
            true
        );
    }

    public function getStatusSpanAttribute()
    {
        $badge = $this->status ? 'success' : 'danger';
        $text = Constant::$status_list[(int)$this->status];

        return '<span class="badge badge-' . $badge . '">' . $text . '</span>';
    }

    public function can($type, $action)
    {
        if ($action == 'store') {
            $action = 'create';
        } elseif ($action == 'update') {
            $action = 'edit';
        } elseif ($action == 'show') {
            $action = 'index';
        } elseif ($action == 'view') {
            $action = 'view';
        } elseif ($action == 'datatable') {
            $action = 'index';
        }  elseif ($action == 'list') {
            $action = 'list';
        }  elseif ($action == 'payment') {
            $action = 'payment';
        }  elseif ($action == 'payments_payment') {
            $action = 'payments_payment';
        } else {
            if (!in_array($action, ['index', 'create', 'edit', 'destroy'])) {
                $action = 'index';
            }
        }

        $perm = $type . '_' . $action;

        $list = $this->permission_list;

        if (!array_key_exists($perm, $list)) {
            return false;
        }

        return $list[$perm];
    }

    public function sidebar($perm)
    {
        $list = $this->permission_list;

        if (!array_key_exists($perm, $list)) {
            return false;
        }

        return $list[$perm];
    }
}
