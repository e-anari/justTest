<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActiveCode extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'code', 'expired_at'];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeGenerateCode($query, $user)
    {
        // Is There any alive code for user?
        // Yes : Ok,return it.
        // No  : Make new one and return.
        if ($aliveCode = $this->isAliveCodeForUser($user)) {
            $code = $aliveCode->code;
        } else {
            // Genrate new code . Check that the generated code is not duplicate.
            do {
                $code = mt_rand(100000, 999999);
            } while ($this->checkCodeIsUniqe($user, $code));

            // Store code in active_code table.
            // The code expires after 10 minutes.
            $user->activeCodes()->create([
                'code' => $code,
                'expired_at' => now()->addMinutes(10),
            ]);
        }

        return $code;
    }

    public function isAliveCodeForUser($user)
    {
        return $user->activeCodes()->where('expired_at', '>', now())->first();
    }

    public function checkCodeIsUniqe($user, int $code)
    {
        # with (!!) change object to boolean
        return !!   $user->activeCodes()->where('code', $code)->first();
    }

    public function scopeVerifyCode($query,$user,$token)
    {
        return !!   $user->activeCodes()->whereCode($token)->where('expired_at','>',now())->first();
    }
}
