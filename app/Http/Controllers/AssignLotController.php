<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lot;
use App\Models\LotWorker;
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
                    "assign_pcs" => "required",
                ]
            );
            if(!$validator->fails())
            {
                unset($data['_token']);
                $worker = Worker::get($data['worker_id']);
                $data['worker_type_id'] = $worker->workerType->id;

                $record = LotWorker::create($data);

                if($record)
                {
                    $request->session()->flash('success', 'Lot Assigned Successfully.');
                    return redirect()->route("worker.index");
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
        $workers = Worker::where("status", 1)->select(["id", "first_name", "worker_type_id"])->with(['workerType'])->get();

        return view("assignLot.add", [
            "lots" => $lots,
            "workers" => $workers
        ]);
    }

    public function getLotAssignInfo(Request $request, $id)
    {
        $data = Lot::where(["id" => $id])->with(['worker'])->get();
        pr($data->toArray());die;

        return response()->json([
            "status" => true,
            "data" => $data
        ]);
    }
}


// Add All Pcs
// Pcs Must less than lot pcs