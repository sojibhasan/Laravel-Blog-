<?php

namespace App\Http\Controllers;

use App\User;
use App\Profile;
use Illuminate\Http\Request;
use App\Mail\RegistrationMail;
use App\Notifications\RegisterNoti;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('profile')->paginate(6);
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'min:11', 'max:255', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'unique:users'],
            'role' => ['required'],
            'password' => ['required', 'string', 'min:8', 'max:255', 'confirmed'],
        ]);

        $user = User::create([
            'phone' => $request['phone'],
            'role' => $request['role'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        Profile::create([
            'user_id' => $user->id,
        ]);

        $for = 'create';
        $user->notify(new RegisterNoti($for));
        Mail::to($request->email)->send(new RegistrationMail($request));

        Toastr::success('Successfully Added a New User', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = Profile::with('user')
            ->where('user_id', $id)
            ->first();
        return view('user.show', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.create', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if ($user->phone == $request->phone) {
            if ($user->email == $request->email) {
                $this->validate($request, [
                    'phone' => ['required', 'min:11', 'max:255', 'numeric'],
                    'role' => ['required'],
                    'email' => ['required', 'string', 'email', 'max:255'],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                ]);
            } else {
                $this->validate($request, [
                    'phone' => ['required', 'min:11', 'max:255', 'numeric'],
                    'role' => ['required'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                ]);
            }
        } else {
            $this->validate($request, [
                'phone' => ['required', 'min:11', 'max:255', 'numeric', 'unique:users'],
                'role' => ['required'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['required', 'string', 'min:8', 'max:255', 'confirmed'],
            ]);
        }

        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = $request->password;

        $user->save();

        Mail::to($request->email)->send(new RegistrationMail($request));

        Toastr::success('Successfully Updated', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->role == 1) {
            Toastr::warning('This user can\'t be deleted', '', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }

        $user->delete();
        Toastr::success('Successfully Delete', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('user.index');
    }
}
