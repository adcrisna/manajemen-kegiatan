<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use Auth;
use DB;
use App\Models\User;
use App\Models\Instansi;
use App\Models\Kegiatan;

class AdminController extends Controller
{
    public function index() {
        $title = "Home";
        return view('admin.index', compact('title'));
    }
    public function profile()
    {
        $title = 'Profile';
        $admin = User::find(Auth::user()->id);
        return view('admin.profile', compact('title','admin'));
    }
    public function updateProfile(Request $request){
        DB::beginTransaction();
        try {
            if (empty($request->password)) {
                $user = User::find($request->id);
                $user->name = $request->name;
                $user->email = $request->email;
                $user->jenis_kelamin = $request->jenis_kelamin;
                $user->jabatan = $request->jabatan;
                $user->save();
            }else {
                $user = User::find($request->id);
                $user->name = $request->name;
                $user->email = $request->email;
                $user->jenis_kelamin = $request->jenis_kelamin;
                $user->jabatan = $request->jabatan;
                $user->password = bcrypt($request->password);
                $user->save();
            }
             DB::commit();
            \Session::flash('msg_success','Profile Berhasil Diubah!');
            return Redirect::route('admin.profile');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.profile');
        }
    }
    public function instansi() {
        $title = 'Data Instansi';
        $instansi = Instansi::all();
        return view('admin.instansi', compact('title','instansi'));
    }
    public function addInstansi(Request $request)
    {
        // return $request;
       DB::beginTransaction();
        try {
            $instansi = new Instansi;
            $instansi->name = $request->name;
            $instansi->save();

             DB::commit();
            \Session::flash('msg_success','Instansi Berhasil Ditambah!');
            return Redirect::route('admin.instansi');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.instansi');
        }
    }
    public function updateInstansi(Request $request)
    {
        // return $request;
       DB::beginTransaction();
        try {
            $instansi = Instansi::find($request->id);
            $instansi->name = $request->name;
            $instansi->save();

             DB::commit();
            \Session::flash('msg_success','Instansi Berhasil Diubah!');
            return Redirect::route('admin.instansi');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.instansi');
        }
    }
    public function deleteInstansi($id)
    {
        DB::beginTransaction();
        try {
            $instansi = Instansi::where('id',$id)->delete();
            DB::commit();
            \Session::flash('msg_success','Data Instansi Berhasil Dihapus!');
            return Redirect::route('admin.instansi');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.instansi');
        }
    }
    public function user() {
        $title = 'Data Users';
        $user = User::where('role','User')->get();
        return view('admin.user', compact('title','user'));
    }
    public function addUser(Request $request)
    {
        // return $request;
       DB::beginTransaction();
        try {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->jenis_kelamin = $request->jenis_kelamin;
            $user->jabatan = $request->jabatan;
            $user->password = bcrypt($request->password);
            $user->role = 'User';
            $user->save();

             DB::commit();
            \Session::flash('msg_success','User Berhasil Ditambah!');
            return Redirect::route('admin.user');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.user');
        }
    }
    public function updateUser(Request $request)
    {
        // return $request;
       DB::beginTransaction();
        try {
            if (empty($request->password)) {
                $user = User::find($request->id);
                $user->name = $request->name;
                $user->email = $request->email;
                $user->jenis_kelamin = $request->jenis_kelamin;
                $user->jabatan = $request->jabatan;
                $user->save();
            }else {
                $user = User::find($request->id);
                $user->name = $request->name;
                $user->email = $request->email;
                $user->jenis_kelamin = $request->jenis_kelamin;
                $user->jabatan = $request->jabatan;
                $user->password = bcrypt($request->password);
                $user->save();
            }

             DB::commit();
            \Session::flash('msg_success','User Berhasil Diubah!');
            return Redirect::route('admin.user');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.user');
        }
    }
    public function deleteUser($id)
    {
        DB::beginTransaction();
        try {
            $user = User::where('id',$id)->delete();
            DB::commit();
            \Session::flash('msg_success','Data User Berhasil Dihapus!');
            return Redirect::route('admin.user');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.user');
        }
    }

    public function kegiatan() {
        $title = 'Data Kegiatan';
        $kegiatan = Kegiatan::all();
        return view('admin.kegiatan', compact('title','kegiatan'));
    }
}
