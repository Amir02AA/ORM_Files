<?php

namespace models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = ['name', 'username', 'password', 'verified'];
    public static function toggleVerify(string $username)
    {
        $user = Doctor::where('username', $username)->first();

        if ($user) {
            $user->update([
                'verified' => !$user->verified
            ]);
        }
    }

}