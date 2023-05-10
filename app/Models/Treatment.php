<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Treatment extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function scopeDate($query, $date)
    {
        $query->when( $date ?? false, function ($query, $date){
            if( $date =='hari ini' ) :
                return $query->whereDate('created_at', Carbon::today());
            elseif( $date =='minggu ini' ) :
                return $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
            elseif( $date =='bulan ini' ) :
                return $query->whereMonth('created_at', Carbon::now()->month);
            elseif( $date =='tahun ini' ) :
                return $query->whereYear('created_at', Carbon::now()->year);
            endif;
        });
    }

    // relationship
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

}
