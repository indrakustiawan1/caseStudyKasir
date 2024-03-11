<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function index()
    {
        return view("admin.role.index");
    }

    public function datatables_role(Request $request)
    {
        if ($request->ajax()) {
            $data = Role::all();
            // dd($data);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($value) {
                    $actionBtn = '<div class="btn-group">
                        <a href="javascript:void(0)" class="btn btn-warning btn-sm" data-id="' . $value->id . '"  id="btn-editRole" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                        <a href="javascript:void(0)" class="btn btn-danger btn-sm"  data-id="' . $value->id . '" id="btn-deleteRole" title="Hapus"><i class="fas fa-trash-alt"></i></a>
                    </div>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        ($request->id) ? $valid_role = 'required' : $valid_role = 'required|unique:roles,name';

        $validator = Validator::make($request->all(), [
            'role' => $valid_role,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => FALSE,
                'error'  => $validator->errors()->toArray()
            ]);
        }

        ($request->guard_name) ? $guard_name = $request->guard_name :  $guard_name = 'web';

        $data = [
            'name' => Str::lower($request->role),
            'guard_name' => Str::lower($guard_name)
        ];

        if ($request->id) {
            $data['updated_at'] = date('Y-m-d H:i:s');
            Role::where('id', $request->id)->update($data);

            return response()->json([
                'status' => TRUE,
                'message' => 'Data berhasil di update.'
            ], 200);
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            Role::Create($data);

            return response()->json([
                'status' => TRUE,
                'message' => 'Data berhasil di simpan.'
            ], 200);
        }
    }

    public function edit(Role $role)
    {
        return response()->json([
            'data' => $role,
            'status' => true
        ], 200);
    }

    public function destroy(Role $role)
    {
        Role::destroy($role->id);
        return response()->json([
            'status' => true
        ], 200);
    }
}
