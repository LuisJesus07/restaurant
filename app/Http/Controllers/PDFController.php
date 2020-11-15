<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Bill;

class PDFController extends Controller
{

    //descargar pdf
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

            //generar codigo qr
            $this->generate_qr($bill->id);

	        //generar pdf y descargarlo
	    	$pdf = \PDF::loadView('pdf.factura',compact('bill'));
	     	return $pdf->download('factura_'.$bill->id.'.pdf');


    	}

    	
    }

    //vizualisar pdf en el navegador
    public function viewPDF($bill_id)
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
            return $pdf->stream('pdf.factura.pdf');
            //return view('pdf.factura', compact('bill'));


        }

        
    }

    public function generate_qr($bill_id)
    {
        QrCode::generate("http://127.0.0.1:8000/pdf/view/".$bill_id, public_path().'/qrcodes/factura_'.$bill_id.'.svg');
    }
}
