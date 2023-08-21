<?php

namespace App\Jobs;

use App\Mail\User\PasswordMail;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class StoreUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;

    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
        //
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $password = Str::random(10); // пароль теперь генерируется в контроллере, из StoreRequest его нужно убрать
        $this->data['password'] = Hash::make($password);
        $user = User::firstOrCreate(['email'=>$this->data['email']], $this->data);

        // с помощью методов фасада Mail отправляем новый объект класса PasswordMail передав в его конструктор сгенерированный пароль
        Mail::to($this->data['email'])->send(new PasswordMail($password));
        event(new Registered($user));
    }
}
