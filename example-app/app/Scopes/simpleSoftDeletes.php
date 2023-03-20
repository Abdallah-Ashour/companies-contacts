<?php
namespace App\Scopes;

trait SimpleSoftDeletes{
    protected static function bootSimpleSoftDeletes(){
        static::addGlobalScope(new SimpleSoftDeletingScope);
    }
}
?>

