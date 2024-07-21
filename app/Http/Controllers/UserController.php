<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use Auth;
use DB;
use App\Models\User;
use App\Models\Instansi;
use App\Models\Kegiatan;
use Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KegiatanExport;

class UserController extends Controller
{
    public function index() {
        $title = "Home";
        return view('user.index', compact('title'));
    }
    public function profile()
    {
        $title = 'Profile';
        $user = User::find(Auth::user()->id);
        return view('user.profile', compact('title','user'));
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
            return Redirect::route('user.profile');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('user.profile');
        }
    }
    public function penegakan_hukum() {
        $title = "Penegakan Hukum";
        $kegiatan = Kegiatan::where('jenis_kegiatan','Penegakan Hukum')->where('user_id', Auth::user()->id)->get();
        $instansi = Instansi::all();
        return view('user.penegakan_hukum', compact('title','kegiatan','instansi'));
    }
    public function bantuan_hukum_litigasi() {
        $title = "Bantuan Hukum Litigasi";
        $kegiatan = Kegiatan::where('jenis_kegiatan','Bantuan Hukum Litigasi')->where('user_id', Auth::user()->id)->get();
        $instansi = Instansi::all();
        return view('user.bantuan_hukum_litigasi', compact('title','kegiatan','instansi'));
    }
    public function audit_hukum() {
        $title = "Audit Hukum";
        $kegiatan = Kegiatan::where('jenis_kegiatan','Audit Hukum')->where('user_id', Auth::user()->id)->get();
        $instansi = Instansi::all();
        return view('user.audit_hukum', compact('title','kegiatan','instansi'));
    }
    public function bantuan_hukum_lainnya() {
        $title = "Bantuan Hukum Lainnya";
        $kegiatan = Kegiatan::where('jenis_kegiatan','Bantuan Hukum Lainnya')->where('user_id', Auth::user()->id)->get();
        $instansi = Instansi::all();
        return view('user.bantuan_hukum_lainnya', compact('title','kegiatan','instansi'));
    }
    public function bantuan_hukum_non_litigasi() {
        $title = "Bantuan Hukum Non Litigasi";
        $kegiatan = Kegiatan::where('jenis_kegiatan','Bantuan Hukum Non Litigasi')->where('user_id', Auth::user()->id)->get();
        $instansi = Instansi::all();
        return view('user.bantuan_hukum_non_litigasi', compact('title','kegiatan','instansi'));
    }
    public function perjanjian_kerjasama() {
        $title = "Perjanjian Kerjasama";
        $kegiatan = Kegiatan::where('jenis_kegiatan','Perjanjian Kerjasama')->where('user_id', Auth::user()->id)->get();
        $instansi = Instansi::all();
        return view('user.perjanjian_kerjasama', compact('title','kegiatan','instansi'));
    }
    public function pelayanan_hukum() {
        $title = "Pelayanan Hukum";
        $kegiatan = Kegiatan::where('jenis_kegiatan','Pelayanan Hukum')->where('user_id', Auth::user()->id)->get();
        $instansi = Instansi::all();
        return view('user.pelayanan_hukum', compact('title','kegiatan','instansi'));
    }
    public function pendampingan_hukum() {
        $title = "Pendampingan Hukum";
        $kegiatan = Kegiatan::where('jenis_kegiatan','Pendampingan Hukum')->where('user_id', Auth::user()->id)->get();
        $instansi = Instansi::all();
        return view('user.pendampingan_hukum', compact('title','kegiatan','instansi'));
    }
    public function pendapat_hukum() {
        $title = "Pendapat Hukum";
        $kegiatan = Kegiatan::where('jenis_kegiatan','Pendapat Hukum')->where('user_id', Auth::user()->id)->get();
        $instansi = Instansi::all();
        return view('user.pendapat_hukum', compact('title','kegiatan','instansi'));
    }
    public function detail_kegiatan($id) {
        $title = "Penegakan Hukum";
        $detail = Kegiatan::find($id);
        $instansi = Instansi::all();
        return view('user.detail_kegiatan', compact('title','detail','instansi'));
    }
    public function add_kegiatan(Request $request)
    {
        // return $request;
       DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                "pdf" => "required|mimes:pdf",
            ]);
            if($validator->fails()) {
                \Session::flash('msg_error','file harus PDF!');
                return Redirect::back();
            }
            $kegiatan = new Kegiatan;
            $namalampiran = "Foto Kegiatan"."  ".$request->jenis_kegiatan." ".date("Y-m-d H-i-s");
            $extention = $request->file('pdf')->extension();
            $lampiran = sprintf('%s.%0.8s', $namalampiran, $extention);
            $destination = base_path() .'/public/pdf';
            $request->file('pdf')->move($destination,$lampiran);

            $kegiatan->name = $request->name;
            $kegiatan->instansi_id = $request->instansi;
            $kegiatan->user_id = Auth::user()->id;
            $kegiatan->tanggal = $request->tanggal;
            $kegiatan->tempat = $request->tempat;
            $kegiatan->deskripsi = $request->deskripsi;
            $kegiatan->jenis_kegiatan = $request->jenis_kegiatan;
            $kegiatan->pdf = $lampiran;
            $kegiatan->save();

             DB::commit();
            \Session::flash('msg_success','Kegiatan Berhasil Ditambah!');
            return Redirect::back();
        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::back();
        }
    }
    public function update_kegiatan(Request $request)
    {
        // return $request;
       DB::beginTransaction();
        try {
            if (empty($request->pdf)) {
                $kegiatan = Kegiatan::find($request->id);
                $kegiatan->name = $request->name;
                $kegiatan->instansi_id = $request->instansi;
                $kegiatan->user_id = Auth::user()->id;
                $kegiatan->tanggal = $request->tanggal;
                $kegiatan->tempat = $request->tempat;
                $kegiatan->deskripsi = $request->deskripsi;
                $kegiatan->save();
            } else {
                $validator = Validator::make($request->all(), [
                "pdf" => "required|mimes:pdf",
                ]);
                if($validator->fails()) {
                    \Session::flash('msg_error','file harus PDF!');
                    return Redirect::back();
                }
                $kegiatan = Kegiatan::find($request->id);

                \File::delete(public_path('pdf/'.$kegiatan->pdf));

                $namalampiran = "Foto Kegiatan"."  ".$request->jenis_kegiatan." ".date("Y-m-d H-i-s");
                $extention = $request->file('pdf')->extension();
                $lampiran = sprintf('%s.%0.8s', $namalampiran, $extention);
                $destination = base_path() .'/public/pdf';
                $request->file('pdf')->move($destination,$lampiran);

                $kegiatan->name = $request->name;
                $kegiatan->instansi_id = $request->instansi;
                $kegiatan->user_id = Auth::user()->id;
                $kegiatan->tanggal = $request->tanggal;
                $kegiatan->tempat = $request->tempat;
                $kegiatan->deskripsi = $request->deskripsi;
                $kegiatan->pdf = $lampiran;
                $kegiatan->save();
            }


             DB::commit();
            \Session::flash('msg_success','Kegiatan Berhasil Diubah!');
            return Redirect::back();
        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::back();
        }
    }
    public function delete_kegiatan($id)
    {
        DB::beginTransaction();
        try {
            $cariKegiatan = Kegiatan::find($id);
            \File::delete(public_path('pdf/'.$cariKegiatan->pdf));

            $kegiatan = Kegiatan::where('id',$id)->delete();
            DB::commit();
            \Session::flash('msg_success','Data Kegiatan Berhasil Dihapus!');
            return Redirect::back();

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::back();
        }
    }
    function laporanKegiatan(Request $request) {
        return Excel::download(new KegiatanExport($request->tanggalAwal, $request->tanggalAkhir, $request->jenisKegiatan), 'data_laporan_kegiatan '.$request->tanggalAwal.' - '.$request->tanggalAkhir.'.xlsx');
    }
}
