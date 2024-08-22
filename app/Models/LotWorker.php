<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LotWorker extends Model
{
    use SoftDeletes;

    public static function create($data)
    {
        $record = new LotWorker();

        foreach ($data as $k => $v) {
            $record->{$k} = $v;
        }

        return $record->save();
    }

    public static function getRow($select=[], $where = [], $orderBy = 'lot_workers.id desc')
    {
    	$record = LotWorker::orderByRaw($orderBy);

        if(!empty($select))
        {
            $record->select($select);
        }
        else
        {
            $record->select(["*"]);
        }

       foreach($where as $query => $values)
       {
            if(is_array($values))
                $record->whereRaw($query, $values);
            elseif(!is_numeric($query))
                $record->where($query, $values);
            else
                $record->whereRaw($values);
        }

        $record = $record->limit(1)->first();

        return $record;
    }
}
