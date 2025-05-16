<?php
namespace App\Http\Controllers;

use App\Models\Payments;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;

class ReportController extends Controller
{
    public function report1($pid)
    {
        // Eager load enrollment with student and batch relations
        $payment = Payments::find($pid);

        if (!$payment) {
            abort(404, "Payment not found.");
        }

        $enrollment = $payment->enrollment;
        $student = $enrollment ? $enrollment->student : null;
        $batch = $enrollment ? $enrollment->batch : null;

        $pdf = App::make('dompdf.wrapper'); 

        $html = "<div style='margin:20px; padding:20px;'>";
        $html .= "<h1 align='center'> Payment Receipt </h1>"; 
        $html .= "<hr/>"; 
        $html .= "<p> Receipt No: <b>{$pid}</b></p>"; 
        $html .= "<p> Date: <b>{$payment->paid_date}</b></p>"; 
        $html .= "<p> Enrollment No: <b>" . ($enrollment->enroll_no ?? 'N/A') . "</b></p>";
        $html .= "<p> Student Name: <b>" . ($student->name ?? 'Unknown') . "</b></p>";
        $html .= "<hr/>";

        $html .= "<table style='width:100%; border-collapse: collapse;' border='1'>"; 
        $html .= "<tr><td><b>Description</b></td><td><b>Amount</b></td></tr>"; 
        $html .= "<tr>"; 
        $html .= "<td>" . ($batch->name ?? 'N/A') . "</td>"; 
        $html .= "<td>$" . number_format($payment->amount, 2) . "</td>";
        $html .= "</tr>"; 
        $html .= "</table>";

        $html .= "<hr/>"; 
        $html .= "<span> Printed By: <b>" . 'Khchel Rien' . "</b></span><br>"; 
        $html .= "<span> Printed Date: <b>" . date("Y-m-d") . "</b></span>"; 
        $html .= "</div>";

        $pdf->loadHTML($html); 
        return $pdf->stream("payment_receipt_{$pid}.pdf");
    }
}

?>