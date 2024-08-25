<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lot;
use App\Models\LotWorker;
use App\Models\Setting;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AssignLotController extends Controller 
{
    public function add(Request $request)
    {
        if($request->isMethod("post"))
        {
            $data = $request->all();

            $validator = Validator::make(
                $data,
                [
                    "lot_id" => "required",
                    "worker_id" => "required",
                    "assign_pcs" => "required|integer|min:1",
                ]
            );
            if(!$validator->fails())
            {
                unset($data['_token']);
                $worker = Worker::get($data['worker_id']);
                $data['worker_type_id'] = $worker->workerType->id;

                if(!isset($data['assign_date']) || !$data['assign_date'])
                {
                    $data['assign_date'] = date("Y-m-d");
                }

                $record = LotWorker::create($data);

                if($record)
                {
                    Lot::modify($data['lot_id'], ["tailor_status" => 2]);

                    $request->session()->flash('success', 'Lot Assigned Successfully.');
                    return redirect()->route("lot.index");
                }
                else
                {
                    $request->session()->flash('success', 'Something Wrong. Please try again.');
                    // return redirect()->back()->withErrors($validator)->withInput();
                }
            }
            else
            {
                $request->session()->flash('error', 'Please provide valid inputs.');
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }

        $lots = Lot::where("status", 1)->select(["id", "lot_no", "pcs"])->get();
        $getWorkerTypeId = Setting::get('assign_lot_worker_type');
        
        $workers = Worker::where("status", 1)
        ->select(["id", "first_name", "worker_type_id"]);
        if($getWorkerTypeId)
        {
            $workers->where("worker_type_id", $getWorkerTypeId);
        }
        $workers = $workers->with(['workerType'])
        ->get();

        return view("assignLot.add", [
            "lots" => $lots,
            "workers" => $workers
        ]);
    }

    public function edit(Request $request, $lotId)
    {
        $assignLotInfo = $this->getLotAssignInfo($request, $lotId);

        if($request->isMethod("post"))
        {
            $data = $request->all();

            $validator = Validator::make(
                $data,
                [
                ]
            );
            if(!$validator->fails())
            {
                unset($data['_token']);
                $oldAssignLotWorker = array_column($assignLotInfo->worker->toArray(), "id");
                $newAssignLotWorker = array_keys($data['assign_lot']);
                
                $diffAssignLotWorker = array_diff($oldAssignLotWorker, $newAssignLotWorker);

                foreach ($diffAssignLotWorker as $value) {
                    LotWorker::remove($value);
                }
                
                if(isset($data['assign_lot']) && $data['assign_lot'])
                {
                    foreach($data['assign_lot'] as $key => $value)
                    {
                        LotWorker::modify($key, $value);
                    }
                }          

                $request->session()->flash('success', 'Lot Assigned Updated Successfully.');
                return redirect()->route("lot.index");
            }
            else
            {
                $request->session()->flash('error', 'Please provide valid inputs.');
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }

        $lots = Lot::where("status", 1)->select(["id", "lot_no", "pcs"])->get();
        $getWorkerTypeId = Setting::get('assign_lot_worker_type');
        
        $workers = Worker::where("status", 1)
        ->select(["id", "first_name", "worker_type_id"]);
        if($getWorkerTypeId)
        {
            $workers->where("worker_type_id", $getWorkerTypeId);
        }
        $workers = $workers->with(['workerType'])
        ->get();

        return view("assignLot.edit", [
            "lots" => $lots,
            "workers" => $workers,
            "lotId" => $lotId,
            "assignLotInfo" => $assignLotInfo
        ]);
    }

    public function getLotAssignInfo(Request $request, $id)
    {
        $data = Lot::where(["id" => $id])
        ->with(['worker' => function($query){
            $query->select([
                "workers.first_name", 
                "workers.last_name", 
                "lot_workers.assign_pcs", 
                "lot_workers.id", 
                "lot_workers.assign_date",
                "lot_workers.rate"
            ]);
        }])
        ->first();

        if($request->ajax())
        {
            return response()->json([
                "status" => true,
                "data" => $data
            ]);
        }
        else
        {
            return $data;
        }
    }
}


// Add All Pcs