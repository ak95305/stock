<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class WorkerType extends Model
{
    use SoftDeletes;

    public static function create($data)
    {
        $record = new WorkerType();

        foreach ($data as $k => $v) {
            $record->{$k} = $v;
        }

        return $record->save();
    }

    public static function getListing(Request $request, $where = [])
    {
        $orderBy = $request->get('sort') ? $request->get('sort') : 'worker_types.id';
        $direction = $request->get('direction') ? $request->get('direction') : 'desc';
        $page = $request->get('page') ? $request->get('page') : 1;
        $limit = $request->get('limit') ? $request->get('limit') : 12;
        $offset = ($page - 1) * $limit;

        $listing = WorkerType::orderBy($orderBy, $direction);

        if (!empty($where))
        {
            foreach ($where as $query => $values) {
                if (is_array($values))
                    $listing->whereRaw($query, $values);
                elseif (!is_numeric($query))
                    $listing->where($query, $values);
                else
                    $listing->whereRaw($values);
            }
        }

        if ($page !== null && $page !== "" && $limit !== null && $limit !== "") {
            $listing->offset($offset);
            $listing->limit($limit);
        }

        $listing = $listing->paginate($limit);

        return $listing;
    }

    public static function get($id)
    {
        $record = WorkerType::find($id);

        return $record;
    }

    public static function remove($id)
    {
        $record = WorkerType::find($id);

        return $record ? $record->delete() : false;
    }

    public static function modify($id, $data)
    {
        $record = WorkerType::find($id);

        if($record)
        {
            foreach($data as $k => $v)
            {
                $record->{$k} = $v;
            }
            return $record->save();
        }
        else
        {
            return false;
        }
    }
}
