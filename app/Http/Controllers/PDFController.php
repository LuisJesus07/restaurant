<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;

class PDFController extends Controller
{

    public function generatePDF($bill_id)
    {

    	//obtener la cuenta
    	$bill = Bill::where('id',$bill_id)
    			->with('table','dishes','user','client')
    			->first();

    	if($bill){

    		//obtener iva(en monto)
	        $bill->iva = $bill->total_amount * 0.16;

	        //obtener total con iva
	        $bill->final_total = $bill->total_amount + $bill->iva;

	        //generar pdf y descargarlo
	    	$pdf = \PDF::loadView('pdf.factura',compact('bill'));
	     	return $pdf->download('pdf.factura.pdf');
	     	//return $pdf->stream('pdf.factura.pdf');

	     	//return view('pdf.factura', compact('bill'));

    	}

    	
    }
}
