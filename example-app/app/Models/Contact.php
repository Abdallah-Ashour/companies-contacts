<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Company;
use App\Models\Task;
use App\Scopes\AllowedFilterSearch;
use App\Scopes\AllowedSort;
use App\Scopes\SimpleSoftDeletingScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory
    , SoftDeletes , AllowedSort, AllowedFilterSearch;

    public function compnaies(){
        return $this->belongsTo(Company::class)->withTrashed();

    }

    protected $guarded = [];

    public function tsaks(){
        return $this->HasMany(Task::class);
    }


    public function user(){
        return $this->belongsTo(User::class);
    }

    // protected $fillable = ['first_name', 'last_name', 'phone', 'email', 'address', 'company_id'];

    // public function getRouteKeyName(){
    //     return 'id';
    // }




    // protected static function booted(){
    //     static::addGlobalScope('softDeletes', function(Builder $builder){
    //         $builder->whereNull('deleted_at');
    //     });
    // }

        // protected static function booted(){
        //     static::addGlobalScope(new SimpleSoftDeletingScope);
        // }

}
