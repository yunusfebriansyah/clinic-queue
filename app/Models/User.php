<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
    protected $hidden = ['password'];

    // scope
    public function scopeStatus($query, $status)
    {
        if( $status == 'ditangani' ) :
            return $query->whereHas('doctor_treatments', function ($query) use ($status) {
                $query->where('created_at', '>=', Carbon::today())->where('status', $status)->orderBy('id', 'DESC');
            });
        endif;

        return $query->whereHas('doctor_treatments', function ($query) use ($status) {
            $query->where('created_at', '>=', Carbon::today())->where('status', $status);
        });

    }

    public function scopeToday($query)
    {

    return $query->whereHas('doctor_treatments', function ($query) {
        $query->where('created_at', '>=', Carbon::today())->where('status', '!=', 'ditolak')->where('status', '!=', 'dibatalkan')->where('status', '!=', 'menunggu konfirmasi');
    });

    }

    // relationship
    public function patient_treatments()
    {
        return $this->hasMany(Treatment::class, 'patient_id');
    }

    public function doctor_treatments()
    {
        return $this->hasMany(Treatment::class, 'doctor_id');
    }

}
