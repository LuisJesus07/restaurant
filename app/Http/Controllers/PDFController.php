<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PDFController extends Controller
{

    public function generatePDF()
    {
    	$pdf = new Fpdf();
		$pdf::AddPage();
		$pdf::SetFont("Arial","B",18);
		$pdf::Cell(0,10,"Title",0,"","C");
		$pdf::Ln();
		$pdf::Ln();
		$pdf::SetFont("Arial","B",12);
		$pdf::cell(25,8,"ID",1,"","C");
		$pdf::cell(45,8,"Name",1,"","L");
		$pdf::cell(35,8,"Address",1,"","L");
		$pdf::Ln();
		$pdf::SetFont("Arial","",10);
		$pdf::cell(25,8,"1",1,"","C");
		$pdf::cell(45,8,"John",1,"","L");
		$pdf::cell(35,8,"New York",1,"","L");
		$pdf::Ln();
		$pdf::Output();
		exit;
    }
}
