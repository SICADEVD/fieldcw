<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\LeaveType;
use App\Models\Cooperative;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\EmployeeShift;
use App\Models\CustomFieldGroup;
use App\Models\AttendanceSetting;
use App\Models\FinancementDelegue;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\GoogleCalendarModule;

class FinancementController extends Controller
{

    public function index()
    {
        $pageTitle = "Gestion des financements de délégués";
        $financements  = FinancementDelegue::searchable(['numeroVirementCheque'])->orderBy('id', 'DESC')->paginate(getPaginate());
        $delegues = User::whereHas(
            'roles', function($q){
                $q->where('name', 'Delegue');
                }
                ) 
                ->select('id',DB::raw("CONCAT(lastname,' ', firstname) as nom"))
                ->get();
                
        return view('admin.financements.index', compact('pageTitle', 'financements','delegues'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user'    => 'required|max:255',
            'cheque'   => 'required|max:255',
            'montant'   => 'required|max:255',
            'prix' => 'required|max:255',
            'datefinance' => 'required|max:255'
        ]);
        
        if ($request->id) {
            $finance  = FinancementDelegue::findOrFail($request->id);
            $message = "Le financement a été mise à jour avec succès";
        } else {
            $finance  = new FinancementDelegue();
            $message = "Le financement a été ajoutée avec succès";
        }
 
        $finance->balancefinale = 0;
        $finance->poidsattendu = round($request->montant/$request->prix);
        $last = FinancementDelegue::where('user_id', $request->user)->orderby('id','desc')->first();
        if(isset($last->balancefinale)){ 
            if($last->balancefinale<0){
                $finance->balancefinale= $request->montant+$last->balancefinale;
            }else{
                $finance->balancefinale=$request->montant+$last->balancefinale;
            }
            
        }
        else{ $finance->balancefinale = $request->montant; }

        $finance->numeroVirementCheque    = $request->cheque;
        $finance->prixunitaire    = $request->prix; 
        $finance->balanceinitiale   = $request->montant; 
        $finance->montant   = $request->montant; 
        $finance->poidslivre = 0;
        $finance->user_id = $request->user;
        $finance->datefinance = $request->datefinance;
        $finance->save();

        $notify[] = ['success',$message];
        return back()->withNotify($notify);
    }

     

    public function status($id)
    {
        return Cooperative::changeStatus($id);
    }
     
}
