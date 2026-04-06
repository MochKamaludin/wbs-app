<?php 
  
namespace App\Http\Controllers\Auth; 
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; 
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
  
class ForgotPasswordController extends Controller
{
    public function showForgetPasswordForm(): View
    {
        return view('auth.forgetPassword');
    }
  
    public function submitForgetPasswordForm(Request $request): RedirectResponse
    {
        $request->validate([
            'i_wbls_adm' => 'required|email|exists:trwblsadm,i_wbls_adm',
        ]);
  
        $token = Str::random(64);
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->i_wbls_adm],
            [
                'token' => $token, 
                'created_at' => Carbon::now()
            ]
        );
  
        Mail::send('emails.forgetPassword', ['token' => $token], function($message) use($request){
            $message->to($request->i_wbls_adm);
            $message->subject('Reset Password');
        });
  
        return back()->with('message', 'Kami telah mengirimkan link reset password ke email Anda!');
    }

    public function showResetPasswordForm(Request $request, $token): View
{ 
    $email = $request->query('email');

    return view('auth.forgetPasswordLink', [
        'token' => $token, 
        'email' => $email
    ]);
}
  
    public function submitResetPasswordForm(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => 'required',
            'i_wbls_adm' => 'required|email|exists:trwblsadm,i_wbls_adm',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $checkToken = DB::table('password_reset_tokens')
                            ->where([
                                'email' => $request->i_wbls_adm, 
                                'token' => $request->token
                            ])
                            ->first();

        if(!$checkToken){
            return back()->withInput()->with('error', 'Kombinasi email dan token tidak valid!');
        }

        $update = DB::table('trwblsadm')
                    ->where('i_wbls_adm', $request->i_wbls_adm)
                    ->update(['c_wbls_admpswd' => Hash::make($request->password)]);

        if($update){
            DB::table('password_reset_tokens')->where(['email'=> $request->i_wbls_adm])->delete();
            
            return back()->with('message', 'Password Anda berhasil diperbarui! Silakan klik tombol kembali ke login untuk masuk.');
        }

        return back()->with('error', 'Gagal memperbarui password.');
    }
}