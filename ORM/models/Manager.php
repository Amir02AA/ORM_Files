<?php
namespace models;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    protected $fillable = ['name','username','password','verified'];

    public static function toggleVerify(string $username)
    {
        $user = Manager::where('username', $username)->first();

        if ($user) {
            $user->update([
                'verified' => !$user->verified
            ]);
        }
    }
}