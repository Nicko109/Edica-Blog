<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Mail\User\PasswordMail;
use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated(); //данные пришедшие в случае успешной валидации
        $password = Str::random(6); // пароль теперь генерируется в контроллере, из StoreRequest его нужно убрать
        $data['password'] = Hash::make($password);
        $user = User::firstOrCreate(['email'=>$data['email']], $data);
        // с помощью методов фасада Mail отправляем новый объект класса PasswordMail передав в его конструктор сгенерированный пароль
        Mail::to($data['email'])->send(new PasswordMail($password));
        event(new Registered($user));

        return redirect()->route('admin.user.index');
    }
}
