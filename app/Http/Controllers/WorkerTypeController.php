<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\WorkerType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WorkerTypeController extends Controller 
{
    public function index(Request $request) 
    {
        $where = [];

        if($request->get("search"))
        {
            $search = $request->get("search");

            $where[] = "(worker_types.title LIKE '%$search%')";
        }
        
        if($request->get("from_date"))
        {
            $where[] = "worker_types.created_at >= '".$request->get("from_date")."'";
        }
        
        if($request->get("to_date"))
        {
            $where[] = "worker_types.created_at <= '".$request->get("to_date")."'";
        }
        
        $listing = WorkerType::getListing($request, $where);

        return view("workerType.index", ['listing' => $listing]);
    }

    public function add(Request $request)
    {
        if($request->isMethod("post"))
        {
            $data = $request->all();

            $validator = Validator::make(
                $data,
                [
                    "title" => "required",
                ]
            );
            if(!$validator->fails())
            {
                unset($data['_token']);
                
                $record = WorkerType::create($data);

                if($record)
                {
                    $request->session()->flash('success', 'Worker Type saved Successfully.');
                    return redirect()->route("workerType.index");
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

        return view("workerType.add");
    }
    
    public function edit(Request $request, $id)
    {
        if($request->isMethod("post"))
        {
            $data = $request->all();

            $validator = Validator::make(
                $data,
                [
                    "title" => "required"
                ]
            );
            if(!$validator->fails())
            {
                unset($data['_token']);
                
                $record = WorkerType::modify($id, $data);

                if($record)
                {
                    $request->session()->flash('success', 'Worker Type updated Successfully.');
                    return redirect()->route("workerType.index");
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

        $record = WorkerType::get($id);

        if($record)
        {
            return view("workerType.edit", ["record" => $record]);
        }
        else
        {
            abort(404);
        }
    }

    public function statusChange(Request $request, $id)
    {
        $record = WorkerType::get($id);

        if($record)
        {
            if($request->isMethod("post"))
            {
                $data = $request->all();
                unset($data['_token']);

                $record = WorkerType::modify($id, $data);
                
                if($record)
                {
                    $request->session()->flash('success', 'Worker Type updated Successfully.');
                    return redirect()->route("workerType.index");
                }
                else
                {
                    $request->session()->flash('success', 'Something Wrong. Please try again.');
                    return redirect()->route("workerType.index");
                }
            }
        }
    }

    public function delete(Request $request, $id)
    {
        $record = WorkerType::get($id);

        if($record)
        {
            if($request->isMethod("post"))
            {
                $data = $request->all();
                unset($data['_token']);

                $record = WorkerType::remove($id);
                
                if($record)
                {
                    $request->session()->flash('success', 'Worker Type deleted Successfully.');
                    return redirect()->route("workerType.index");
                }
                else
                {
                    $request->session()->flash('success', 'Something Wrong. Please try again.');
                    return redirect()->route("workerType.index");
                }
            }
        }
        else
        {
            return redirect()->route("workerType.index");
        }
    }
}