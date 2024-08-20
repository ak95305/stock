<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Worker;
use App\Models\WorkerType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WorkerController extends Controller {
    public function index(Request $request) 
    {
        $where = [];

        if($request->get("search"))
        {
            $search = $request->get("search");

            $where[] = "(workers.first_name LIKE '%$search%' OR workers.last_name LIKE '%$search%')";
        }
        
        if($request->get("from_date"))
        {
            $where[] = "workers.created_at >= '".$request->get("from_date")."'";
        }
        
        if($request->get("to_date"))
        {
            $where[] = "workers.created_at <= '".$request->get("to_date")."'";
        }
        
        if($request->get("worker_type_id"))
        {
            $where["worker_type_id = ?"] = [$request->get("worker_type_id")];
        }
        
        $listing = Worker::getListing($request, $where);

        $workerTypes = WorkerType::where("status", 1)->get();
        return view("worker.index", ['listing' => $listing, "workerTypes" => $workerTypes]);
    }

    public function add(Request $request)
    {
        if($request->isMethod("post"))
        {
            $data = $request->all();

            $validator = Validator::make(
                $data,
                [
                    "first_name" => "required",
                    "worker_type_id" => "required",
                ]
            );
            if(!$validator->fails())
            {
                unset($data['_token']);
                
                $record = Worker::create($data);

                if($record)
                {
                    $request->session()->flash('success', 'Worker saved Successfully.');
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

        $workerTypes = WorkerType::where("status", 1)->get();
        return view("worker.add", ["workerTypes" => $workerTypes]);
    }
    
    public function edit(Request $request, $id)
    {
        if($request->isMethod("post"))
        {
            $data = $request->all();

            $validator = Validator::make(
                $data,
                [
                    "first_name" => "required",
                    "worker_type_id" => "required"
                ]
            );
            if(!$validator->fails())
            {
                unset($data['_token']);
                
                $record = Worker::modify($id, $data);

                if($record)
                {
                    $request->session()->flash('success', 'Worker updated Successfully.');
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

        $record = Worker::get($id);

        if($record)
        {
            $workerTypes = WorkerType::where("status", 1)->get();
            return view("worker.edit", ["record" => $record, "workerTypes" => $workerTypes]);
        }
        else
        {
            abort(404);
        }
    }

    public function statusChange(Request $request, $id)
    {
        $record = Worker::get($id);

        if($record)
        {
            if($request->isMethod("post"))
            {
                $data = $request->all();
                unset($data['_token']);

                $record = Worker::modify($id, $data);
                
                if($record)
                {
                    $request->session()->flash('success', 'Worker updated Successfully.');
                    return redirect()->route("worker.index");
                }
                else
                {
                    $request->session()->flash('success', 'Something Wrong. Please try again.');
                    return redirect()->route("worker.index");
                }
            }
        }
    }

    public function delete(Request $request, $id)
    {
        $record = Worker::get($id);

        if($record)
        {
            if($request->isMethod("post"))
            {
                $data = $request->all();
                unset($data['_token']);

                $record = Worker::remove($id);
                
                if($record)
                {
                    $request->session()->flash('success', 'Worker deleted Successfully.');
                    return redirect()->route("worker.index");
                }
                else
                {
                    $request->session()->flash('success', 'Something Wrong. Please try again.');
                    return redirect()->route("worker.index");
                }
            }
        }
        else
        {
            return redirect()->route("worker.index");
        }
    }
}