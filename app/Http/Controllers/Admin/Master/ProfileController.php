<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Master\Navigation\Menu;
use App\Models\Master\Navigation\MenuCategory;
use App\Models\Master\Auth\LoginDetail;
use App\Models\Master\Auth\Privilege;
use App\Models\Master\Auth\RegionUser;

class ProfileController extends Controller
{
    public function showProfile()
    {
        if(!\Session::has('id_user') && !\Session::has('token')) return redirect()->route('Admin:Login');
        $token              = LoginDetail::where([
            ['id_user', \Session::get('id_user')],
            ['is_active', 1]
        ])->latest()->first();
        if(!$token || \Session::get('token') !== $token->token) return redirect()->route('Admin:Logout');

        $data['user']       = User::find(\Session::get('id_user'));
        $data['user_reg']   = RegionUser::select('id_provinsi', 'id_kabupatenkota', 'id_kecamatan', 'type')->where('id_user', \Session::get('id_user'))->get();
        $data['user_type']  = $data['user_reg'][0]->type;
        $data['category']   = MenuCategory::select('id_menu_category', 'name')->where('is_active', 1)->orderBy('id_menu_category', 'desc')->get();
        $data['menu']       = Menu::select('id_menu', 'id_menu_category', 'name', 'url', 'fa_class')->where('is_active', 1)->orderBy('id_menu')->orderBy('name')->get();
        $data['privilege']  = Privilege::select('id_role', 'id_menu', 'id_sub_menu', 'is_create', 'is_read', 'is_update', 'is_delete')->where([
            ['id_role', $data['user']->id_role],
            ['is_active', 1]
        ])->get();

        return view('auth.profile', compact('data'));
    }

    public function profileActivity()
    {
        if(!\Session::has('id_user') && !\Session::has('token')) return redirect()->route('Admin:Login');
        $token              = LoginDetail::where([
            ['id_user', \Session::get('id_user')],
            ['is_active', 1]
        ])->latest()->first();
        if(!$token || \Session::get('token') !== $token->token) return redirect()->route('Admin:Logout');

        $data['user']       = User::find(\Session::get('id_user'));
        $data['user_reg']   = RegionUser::select('id_provinsi', 'id_kabupatenkota', 'id_kecamatan', 'type')->where('id_user', \Session::get('id_user'))->get();
        $data['user_type']  = $data['user_reg'][0]->type;
        $data['category']   = MenuCategory::select('id_menu_category', 'name')->where('is_active', 1)->orderBy('id_menu_category', 'desc')->get();
        $data['menu']       = Menu::select('id_menu', 'id_menu_category', 'name', 'url', 'fa_class')->where('is_active', 1)->orderBy('id_menu')->orderBy('name')->get();
        $data['privilege']  = Privilege::select('id_role', 'id_menu', 'id_sub_menu', 'is_create', 'is_read', 'is_update', 'is_delete')->where([
            ['id_role', $data['user']->id_role],
            ['is_active', 1]
        ])->get();
        $data['activity']   = \DB::table('t_login_detail')->select('id_login_detail', 'is_active', 'created_at', 'updated_at')->where('id_user', \Session::get('id_user'))->orderBy('id_login_detail')->get();
        
        return view('auth.profile_activity', compact('data'));
    }

    public function profileStore(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'id_user' => ['required'],
            'username' => ['required']
        ]);

        if($validator->fails()) return redirect()->route('Admin:Profile:Index')->with('error', 'Username must be filled!');

        if($request->has('photo')) {
            $photo = time().'.'.$request->photo->extension();
            $request->photo->move(public_path('assets/profile'), $photo);
        }

        if($request->has('photo')) {
            User::find($request->id_user)->update([
                'username' => $request->username,
                'name' => $request->name,
                'email' => $request->email,
                'photo' => $photo,
            ]);
        } else {
            User::find($request->id_user)->update([
                'username' => $request->username,
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }

        return redirect()->route('Admin:Profile:Index')->with('success', 'Your profile has been changed!');
    }

    public function passwordChange(Request $request)
    {
        if($request->password !== $request->confirm_password) return redirect()->back()->with('pass_error', 'Password do not match!');

        if(!\Auth::attempt(['id_user' => \Session::get('id_user'), 'password' => $request->old_password])) return redirect()->back()->with('pass_error', 'Current password do not match!');

        User::find(\Session::get('id_user'))->update([
            'password' => bcrypt($request->password)
        ]);

        return redirect()->back()->with('success', 'Password has been changed');
    }
}
