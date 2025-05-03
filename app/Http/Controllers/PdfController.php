<?php

namespace App\Http\Controllers;
use App\Models\booking;
use App\Models\payment;
use App\Models\invoice;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class PdfController extends Controller
{
    public function generatepdf(Request $request ){
        $invoice = Invoice::where('booking_id',$request->id)->with(['booking', 'user', 'service', 'type'])->first();
        $booking = booking::with(['agency', 'service', 'customer'])->with('payment')->findOrFail($request->id);
        $payment = payment::where('booking_id',$request->id)->first();
        $commission = $booking->calculateCommission();
        $invoice = invoice::where('booking_id',$request->id)->with(['booking', 'user', 'service', 'type'])->first();
        $pdf = Pdf::loadView('booking.invoice', compact('booking', 'payment', 'commission', 'invoice'));
        return $pdf->download('invoice_booking_'.$booking->id.'.pdf');
}
    public function viewinvoice(Request $request ){
        $invoice = Invoice::where('booking_id',$request->id)->with(['booking', 'user', 'service', 'type'])->first();
        $booking = booking::with(['agency', 'service', 'customer'])->with('payment')->findOrFail($request->id);
        $payment = payment::where('booking_id',$request->id)->first();
        $commission = $booking->calculateCommission();
        return view('booking.invoice', compact('booking', 'payment', 'commission', 'invoice'));
}
}
