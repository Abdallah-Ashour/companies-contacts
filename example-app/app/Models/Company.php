<?php

namespace App\Models;

use App\Scopes\AllowedFilterSearch;
use App\Scopes\AllowedSort;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes, AllowedSort, AllowedFilterSearch;


    // if the model not match to the table in DB use this formule
    // protected $table = "app_companies";
    // protected $primaryKey = "__id";
    protected $guarded = [];
    // protected $guarded = ['id', 'created_at', 'updated_at'];
    // protected $fillable = ['name', 'address', 'email', 'website'];

    public function contact(){
        return $this->hasMany(Contact::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }


}


// $company = Company::firstWhere('email', 'email@test.com');

// if(! $company){
//     $company = new Company();
//     $company->email = 'email@test.com';
//     $company->name = 'compnay 7';

// }

// $company->save();

//  or by use firstOrNew() method

// $company = Company::firstOrNew(
//     ['name' => 'company 8'],
//     ['email' => 'email@test.com']
// );

// $company->save();

// or by use firstOrCreate() method don't need to save() method

// Company::firstOrCreate(
//     ['name' => 'company 8'],
//     ['email' => 'email@test.com']

// );
