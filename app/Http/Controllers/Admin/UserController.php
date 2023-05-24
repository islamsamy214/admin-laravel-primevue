<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\ImageTrait;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use ImageTrait;

    private $paginate_users = 10;

    public function index(Request $request)
    {
        if ($request->search) {
            $users = $this->getSearch($request);
        } else {
            $users = $this->getUsers();
        }
        return $users;
    } //end of index


    public function getUsers()
    {
        $users = User::where('email', '!=', 'super_admin@app.com')->latest()->paginate($this->paginate_users);
        return $users;
    } //end of getUsers


    public function getSearch($request)
    {
        $users = User::where('email', '!=', 'super_admin@app.com')
            ->where('name', 'like', '%' . $request->search . '%')
            ->orWhere('email', 'like', '%' . $request->search . '%')
            ->latest()->paginate($this->paginate_users)->toArray();

        // pop super_admin@app.com from the collercion
        $users['data'] = array_filter($users['data'], function ($user) {
            return $user['email'] != 'super_admin@app.com';
        });

        return $users;
    } //end of getSearch

    public function store(StoreUserRequest $request)
    {
        //encrypt password
        $form_data = $request->except(['password', 'password_confirmation', 'image']);
        $form_data['password'] = bcrypt($request->password);

        //image uploading
        $request->image ? $form_data['image'] = $this->img($request->image, 'images/users/') : '';

        User::create($form_data);

        // send test mail to user
        // Mail::to($user)->send(new TestMail($user));

        return response()->json(__('User Created Successfully'));
    } //end of store


    public function edit(User $user)
    {
        return response()->json(['user' => $user]);
    } //end of edit


    public function update(UpdateUserRequest $request, User $user)
    {
        //encrypt password
        $form_data = $request->except(['password', 'password_confirmation', 'image']);
        if ($request->password) $form_data['password'] = Hash::make($request->password);

        //image uploading
        if ($request->image) {
            $user->image ? $this->deleteImg($user->image) : '';
            $form_data['image'] = $this->img($request->image, 'images/users/');
        } else {
            $form_data['image'] = $user->image;
        }
        $user->update($form_data);
        return response()->json(__('User Updated Successfully'));
    } //end of update

    public function destroy(User $user)
    {
        $user->image != 'assets/images/user.png' ? $this->deleteImg($user->image) : '';
        $user->delete();
    } //end of destroy
}
