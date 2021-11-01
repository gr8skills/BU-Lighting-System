<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LightSystem extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];


    public function ScopeByFilter($query, $data)
    {
        $whereClause = [];
        $whereParam = [];
        foreach ($data as $k => $v) {
            $whereClause[] = $k . '=?';
            $whereParam[] = $v;
        }
        $whereClause = implode(' and ', $whereClause);
        $result = $query->whereRaw($whereClause, $whereParam); //Collect the result using ->first() or ->get()
        return ($result);
    }


}
