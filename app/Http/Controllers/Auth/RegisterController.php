<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Peserta;
use App\ProgramKeahlian;
use App\Providers\RouteServiceProvider;
use App\Sekolah;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Crypt;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifVerifikasiPeserta;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $sekolah = Sekolah::all();
        $programKeahlian = ProgramKeahlian::get();

        return view('auth.register', compact('sekolah','programKeahlian'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nama' => 'required|string',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:user,email',],
            'nis' => 'required|numeric|unique:peserta,nis',
            'jenis_kelamin' => 'required|in:L,P',
            'sekolah_id' => 'required_without:sekolah.nama|exists:sekolah,id',
            'program_keahlian_id' => 'required_without:program.nama|nullable|exists:program_keahlian,id',
            'sekolah.nama' => 'required_without:sekolah_id|unique:sekolah,nama',
            'sekolah.telepon' => 'sometimes|nullable',
            'sekolah.alamat' => 'sometimes|nullable',
            'program.nama' => 'required_without:program_keahlian_id|unique:program_keahlian,nama',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {

        DB::beginTransaction();

        try {
            if ($data['sekolah']['nama'] ?? null) {
                $sekolah = Sekolah::create($data['sekolah']);
                $data['sekolah_id'] = $sekolah['id'];
            }

            if ($data['program']['nama'] ?? null) {
                $program = ProgramKeahlian::create($data['program']);
                $data['program_keahlian_id'] = $program['id'];
            }

            $peserta = Peserta::create($data);
            $user = $peserta->authenticable()->create($data);
            DB::commit();
            $hash = Crypt::encrypt($peserta->id);
            //$url = url('peserta/confirmation?hash='.$hash);
            $url = 'http://lasmediafuan.com/';
            Mail::to($data['email'])->send(new NotifVerifikasiPeserta($data['nama'], $url));
            return $user;
        } catch (\Throwable $throwable) {
            return $throwable;
        }
    }
}
