<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Party;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PartyController extends Controller {
    public function index(Request $request) 
    {
        $where = [];

        if($request->get("search"))
        {
            $search = $request->get("search");

            $where[] = "parties.first_name LIKE '%$search%' OR parties.last_name LIKE '%$search%' OR parties.company_name LIKE '%$search%'";
        }
        
        if($request->get("from_date"))
        {
            $where[] = "parties.created_at >= '".$request->get("from_date")."'";
        }
        
        if($request->get("to_date"))
        {
            $where[] = "parties.created_at <= '".$request->get("to_date")."'";
        }
        
        $listing = Party::getListing($request, $where);

        return view("party.index", ['listing' => $listing]);
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
                ]
            );
            if(!$validator->fails())
            {
                unset($data['_token']);
                
                $record = Party::create($data);

                if($record)
                {
                    $request->session()->flash('success', 'Party saved Successfully.');
                    return redirect()->route("party.index");
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

        return view("party.add");
    }
    
    public function edit(Request $request, $id)
    {
        if($request->isMethod("post"))
        {
            $data = $request->all();

            $validator = Validator::make(
                $data,
                [
                    "first_name" => "required"
                ]
            );
            if(!$validator->fails())
            {
                unset($data['_token']);
                
                $record = Party::modify($id, $data);

                if($record)
                {
                    $request->session()->flash('success', 'Party updated Successfully.');
                    return redirect()->route("party.index");
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

        $record = Party::get($id);

        if($record)
        {
            return view("party.edit", ["record" => $record]);
        }
        else
        {
            abort(404);
        }
    }

    public function statusChange(Request $request, $id)
    {
        $record = Party::get($id);

        if($record)
        {
            if($request->isMethod("post"))
            {
                $data = $request->all();
                unset($data['_token']);

                $record = Party::modify($id, $data);
                
                if($record)
                {
                    $request->session()->flash('success', 'Party updated Successfully.');
                    return redirect()->route("party.index");
                }
                else
                {
                    $request->session()->flash('success', 'Something Wrong. Please try again.');
                    return redirect()->route("party.index");
                }
            }
        }
    }

    public function delete(Request $request, $id)
    {
        $record = Party::get($id);

        if($record)
        {
            if($request->isMethod("post"))
            {
                $data = $request->all();
                unset($data['_token']);

                $record = Party::remove($id);
                
                if($record)
                {
                    $request->session()->flash('success', 'Partt deleted Successfully.');
                    return redirect()->route("party.index");
                }
                else
                {
                    $request->session()->flash('success', 'Something Wrong. Please try again.');
                    return redirect()->route("party.index");
                }
            }
        }
    }
}