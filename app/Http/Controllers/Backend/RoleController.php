<?php

namespace App\Http\Controllers\Backend;

use App\Models\Role;
use App\Http\Requests\RoleRequest;
use App\Support\Utils\Constant;
use Illuminate\Support\Facades\Auth;

class RoleController extends BaseController
{
    public function __construct()
    {
        $this->type = 'role';
        $this->active_page_index = 'role';
        $this->active_sub_page_index = 'role';
        $this->will_check_user_access = true;

        parent::__construct();
    }

    public function index()
    {
        $roles = Role::orderBy('id', 'DESC')->whereNotIn('id', [1, 2, 3])->get();

        $with = [
            'title' => 'Roller',
            'status_list' => Constant::$status_list,
            'roles' => $roles,
        ];
        return $this->view('index', $with);
    }

    public function create()
    {
        $with = [
            'edit' => 0,
            'title' => 'Ekle',
            'action' => route('backend.role.store'),
            'permissions' => Constant::roles()
        ];

        return $this->view('edit', $with);
    }

    public function store(RoleRequest $request)
    {
        $data = $request->validated();
        $data['guard_name'] = 'backend';

        $data['permissions'] = $this->buildPermissions($request->input('permissions'));

        Role::create($data);

        return $this->respond(
            'success',
            'İşlem başarılı bir şekilde gerçekleştirildi.',
            route('backend.role.index')
        );
    }

    public function show(Role $role)
    {
        // will be implemented when required.
    }

    public function edit($id)
    {
        $row = Role::findOrFail($id);

        $with = [
            'edit' => 1,
            'title' => 'Düzenle',
            'action' => route('backend.role.update', $row->id),
            'row' => $row,
            'permissions' => Constant::roles()
        ];

        return $this->view('edit', $with);
    }

    public function update(RoleRequest $request, $id)
    {
        $row = Role::find($id);

        if (!$row) {
            return $this->respond(
                'danger',
                'Kayıt Bulunamadı'
            );
        }

        $data = $request->validated();
        $data['slug'] = str_slug_tr($data['name']);
        $data['status'] = $request->has('status');

        $data['permissions'] = $this->buildPermissions($request->input('permissions'));

        $row->update($data);

        return $this->respond(
            'success',
            'İşlem başarılı bir şekilde gerçekleştirildi.',
            route('backend.role.index')
        );
    }

    public function destroy($id)
    {
        $row = Role::find($id);

        if (!$row) {
            return $this->respond(
                'danger',
                'Kayıt Bulunamadı'
            );
        }

        $row->delete();

        return $this->respond(
            'success',
            'İşlem başarılı bir şekilde gerçekleştirildi.'
        );
    }

    private function buildPermissions($perms)
    {
        $permissions = [];

        if (!empty($perms)) {
            $types = Constant::$permission_codes;

            foreach ($perms as $code => $perm) {
                if ($perm == 'on') {
                    list($type, $action) = explode('-', $code);

                    if (in_array($type, $types)) {
                        $permissions[$type . "_" . $action] = true;
                    }
                }
            }
        }

        return json_encode($permissions);
    }
}
