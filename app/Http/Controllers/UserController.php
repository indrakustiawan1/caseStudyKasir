<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;


class UserController extends Controller
{
    public function index()
    {
        $role = Role::all();
        $permissions = Permission::all();
        return view('admin.user.index', compact('role', 'permissions'));
    }

    public function datatables_user(Request $request)
    {
        if ($request->ajax()) {
            $data = User::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($value) {
                    return Str::title($value->name);
                })
                ->addColumn('username', function ($value) {
                    return Str::title($value->username);
                })
                ->addColumn('email', function ($value) {
                    return Str::title($value->email);
                })
                ->addColumn('action', function ($value) {
                    $actionBtn = '<div class="btn-group">
                        <a href="javascript:void(0)" class="btn btn-primary btn-sm" data-id="' . $value->id . '"  id="btn-setAccesUser" title="Set Role & Permission"><i class="fa fa-cogs" aria-hidden="true"></i></a>
                        <a href="javascript:void(0)" class="btn btn-warning btn-sm" data-id="' . $value->id . '"  id="btn-editUser" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                        <a href="javascript:void(0)" class="btn btn-danger btn-sm"  data-id="' . $value->id . '" id="btn-deleteUser" title="Hapus"><i class="fas fa-trash-alt"></i></a>
                    </div>';
                    return $actionBtn;
                })
                ->rawColumns(['name', 'username', 'email', 'action'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required|unique:users,username,' . ($request->id ? $request->id : 'NULL') . ',id',
            'email' => 'required|email',
            'password' => $request->id ? 'nullable' : 'required|min:6', // Password boleh kosong pada mode edit
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error'  => $validator->errors()->toArray()
            ]);
        }

        $data = [
            'name' => Str::lower($request->name),
            'username' => $request->username,
            'email' => $request->email,
        ];

        // Tambahkan password jika disertakan dalam permintaan
        if ($request->has('password')) {
            $data['password'] = bcrypt($request->password);
        }

        if ($request->id) {
            // Mode Edit
            $data['updated_at'] = now(); // Menggunakan fungsi now() untuk mendapatkan tanggal dan waktu saat ini
            User::where('id', $request->id)->update($data);

            // Hapus semua peran pengguna saat ini
            User::find($request->id)->roles()->detach();

            $role = Role::find($request->role);

            if ($role) {
                User::find($request->id)->assignRole($role->name);
            } else {
                // Tanggapan jika peran tidak ditemukan
                return response()->json([
                    'status' => false,
                    'message' => 'Role not found.'
                ], 404);
            }

            return response()->json([
                'status' => true,
                'message' => 'Data berhasil diupdate.'
            ], 200);
        } else {
            // Mode Tambah
            $data['created_at'] = now();
            $user = User::create($data);

            $role = Role::find($request->role);

            if ($role) {
                $user->assignRole($role->name);
            } else {
                // Tanggapan jika peran tidak ditemukan
                return response()->json([
                    'status' => false,
                    'message' => 'Role not found.'
                ], 404);
            }

            return response()->json([
                'status' => true,
                'message' => 'Data berhasil disimpan.'
            ], 200);
        }
    }
    public function edit(User $user)
    {
        // dd($user);
        return response()->json([
            'data' => $user,
            'status' => true
        ], 200);
    }

    public function destroy(User $user)
    {
        User::destroy($user->id);
        return response()->json([
            'status' => true
        ], 200);
    }
}
