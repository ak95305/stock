<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lot;
use App\Models\Party;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LotController extends Controller 
{
    public function index(Request $request) 
    {
        $where = [];
        if($request->get("search") || $request->get("search") == "0")
        {
            $search = $request->get("search");

            $partyIds = Party::whereLike("first_name", "%$search%")->orWhereLike("company_name", "%$search%")->pluck("id");
            $partyIds = !empty($partyIds) && count($partyIds) > 0 ? implode(", ", $partyIds->toArray()) : "0";

            $where[] = "(
                lots.lot_no LIKE '%$search%' 
                OR lots.party_id IN ($partyIds)
                OR lots.pcs LIKE '%$search%'
                OR lots.date LIKE '%$search%'
                OR lots.info LIKE '%$search%'
            )";
        }
        
        if($request->get("from_date"))
        {
            $where[] = "lots.date >= '".$request->get("from_date")."'";
        }
        
        if($request->get("to_date"))
        {
            $where[] = "lots.date <= '".$request->get("to_date")."'";
        }
        
        if($request->get("party"))
        {
            $partyIds = implode(", ", $request->party);
            $where[] = "lots.party_id IN ($partyIds)";
        }

        $select = [
            'id',
            'lot_no',
            'pcs',
            'rate',
            'date',
            'info',
            'status'
        ];
        $listing = Lot::getListing($request, $where, $select);

        if($request->ajax())
        {
            $html = view("lot.listing", ["listing" => $listing])->render();
            $html = self::highlightOccurrence($html, $request->search);

            return response()->json([
                "status" => true,
                "html" => $html
            ]);
        }

        $parties = Party::where("status", 1)->select(["id", "company_name", "first_name", "last_name"])->get();
        return view("lot.index", ['listing' => $listing, "parties" => $parties]);
    }

    public function add(Request $request)
    {
        if($request->isMethod("post"))
        {
            $data = $request->all();

            $validator = Validator::make(
                $data,
                [
                    "lot_no" => "required",
                    "party_id" => "required"
                ]
            );
            if(!$validator->fails())
            {
                unset($data['_token']);

                if(!isset($data['date']) || !$data['date'])
                {
                    $data['date'] = date("Y-m-d H:i:s");
                }
                
                $lot = Lot::create($data);

                if($lot)
                {
                    $request->session()->flash('success', 'Lot saved Successfully.');
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

        $parties = Party::where("status", 1)->get();
        return view("lot.add", ["parties" => $parties]);
    }
    
    public function edit(Request $request, $id)
    {
        if($request->isMethod("post"))
        {
            $data = $request->all();

            $validator = Validator::make(
                $data,
                [
                    "lot_no" => "required",
                    "party_id" => "required"
                ]
            );
            if(!$validator->fails())
            {
                unset($data['_token']);

                if(!isset($data['date']) || !$data['date'])
                {
                    $data['date'] = date("Y-m-d");
                }
                
                $lot = Lot::modify($id, $data);

                if($lot)
                {
                    $request->session()->flash('success', 'Lot updated Successfully.');
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

        $lot = Lot::get($id);

        if($lot)
        {
            $parties = Party::where("status", 1)->get();
            return view("lot.edit", ["record" => $lot, "parties" => $parties]);
        }
        else
        {
            abort(404);
        }
    }

    public function changeStatus(Request $request, $id)
    {
        $lot = Lot::get($id);

        if($lot)
        {
            if($request->isMethod("post"))
            {
                $data = $request->all();
                unset($data['_token']);
                
                $lotUpdated = Lot::modify($id, $data);
                
                if($lotUpdated)
                {
                    return response()->json([
                        "status" => true,
                        "message" => "Status Changed Successfully!"
                    ]);
                }
                else
                {
                    return response()->json([
                        "status" => false,
                        "message" => "Something's Wrong!"
                    ]);
                }
            }
        }
    }

    public function delete(Request $request, $id)
    {
        $lot = Lot::get($id);

        if($lot)
        {
            if($request->isMethod("post"))
            {
                $data = $request->all();
                unset($data['_token']);

                $lot = Lot::remove($id);
                
                if($lot)
                {
                    $request->session()->flash('success', 'Lot deleted Successfully.');
                    return redirect()->route("lot.index");
                }
                else
                {
                    $request->session()->flash('success', 'Something Wrong. Please try again.');
                    return redirect()->route("lot.index");
                }
            }
        }
    }

    protected static function highlightOccurrence($text, $highlightText)
    {
        $parts = preg_split('/(<[^>]+>)/', $text, -1, PREG_SPLIT_DELIM_CAPTURE);
        foreach ($parts as &$part) {
            if($part)
            {
                if ($part[0] !== '<') {
                    $part = str_ireplace($highlightText, "<highlight>$highlightText</highlight>", $part);
                }
            }
        }
        return implode('', $parts);
    }
}