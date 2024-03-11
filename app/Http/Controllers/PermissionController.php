<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    public function index()
    {
        // $data = Permission::all();
        // dd($data);
        return view('admin.permission.index');
    }


    public function datatables_permission(Request $request)
    {
        // dd("sampai");
        if ($request->ajax()) {
            $data = Permission::all();
            // dd($data);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($value) {
                    $actionBtn = '<div class="btn-group">
                        <a href="javascript:void(0)" class="btn btn-warning btn-sm" data-id="' . $value->id . '"  id="btn-editPermission" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                        <a href="javascript:void(0)" class="btn btn-danger btn-sm"  data-id="' . $value->id . '" id="btn-deletePermission" title="Hapus"><i class="fas fa-trash-alt"></i></a>
                    </div>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $messages = array(
            'name.required'            => 'Nama Role tidak boleh kosong',
            'guard_name.required'            => 'Guard Name tidak boleh kosong'
        );
        $validator = Validator::make($request->all(), [
            'name'         => 'required',
            'guard_name'         => 'required'
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => FALSE,
                'error' => $validator->errors()->toArray()
            ]);
        }
        // ($request->guard_name) ? $guard_name = $request->guard_name :  $guard_name = 'web';
        $data = [
            'name' => Str::lower($request->name),
            'guard_name' => Str::lower($request->guard_name)
        ];

        // dd($data);

        // dd($data);
        if ($request->id) {
            $data['updated_at'] = date('Y-m-d H:i:s');
            Permission::where('id', $request->id)->update($data);

            return response()->json([
                'status' => TRUE,
                'message' => 'Data berhasil di update.'
            ], 200);
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            Permission::Create($data);

            return response()->json([
                'status' => TRUE,
                'message' => 'Data berhasil di simpan.'
            ], 200);
        }
    }

    public function edit(Permission $permission)
    {
        return response()->json([
            'data' => $permission,
            'status' => true
        ], 200);
    }

    public function destroy(Permission $permission)
    {
        Permission::destroy($permission->id);
        return response()->json([
            'status' => true
        ], 200);
    }
}
