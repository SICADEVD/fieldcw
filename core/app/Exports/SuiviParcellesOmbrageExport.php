<?php

namespace App\Exports;
 
use App\Models\SuiviParcellesAgroforesterie;
use App\Models\SuiviParcellesAnimal;
use App\Models\SuiviParcellesOmbrage;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class SuiviParcellesOmbrageExport implements FromView, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    public function view(): View
    {
        // TODO: Implement view() method.
        
        return view('manager.suiviparcelle.SuiviOmbragesExcel',[
            'ombrages' => SuiviParcellesOmbrage::joinRelationship('suiviParcelle.parcelle.producteur.localite.section')->where('cooperative_id',auth()->user()->cooperative_id)->get()
        ]);
    }

    public function title(): string
    {
        Return "Ombrages";
    }
}
