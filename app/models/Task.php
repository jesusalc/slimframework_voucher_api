<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model {


    public function manualFind($id)
    {
        return self::find($id);
    }
}