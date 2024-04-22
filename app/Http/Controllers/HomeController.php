<?php

namespace App\Http\Controllers;

use App\Models\invoices;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //total of Invoices
        $totalInvoices = number_format(invoices::sum('Total'), 2);
        //Count of invoices
        $invoicesCount = invoices::count();
        ///////////////////////////////////
        //total of invoicesNotPay
        $invoicesNotPay = invoices::where('Value_Status', '2')->sum('Total');
        $CountInvoicesNotPay = invoices::where('Value_Status', '2')->count();
        ///////////////////////////////////
        //percentage of NotPay Invoices
        /* notPayInvoices / countTotal Invoices *100  */
        $percentNotPay = round($CountInvoicesNotPay / $invoicesCount * 100, 2);
        ///////////////////////////////////

        //Payment Invoices
        $CountPayInvoices = invoices::where('Value_Status', '1')->count();
        $SumPayMentInvoices = invoices::where('Value_Status', '1')->sum('Total');
        /* PayInvoices / countTotal Invoices *100  */
        $percentPay = round($CountPayInvoices / $invoicesCount * 100, 2);

        ////////////////////////////////////////////////////////
        //Payment Invoices
        $CountPartiallypaid = invoices::where('Value_Status', '3')->count();
        $SumPartiallypaid = invoices::where('Value_Status', '3')->sum('Total');
        /* PayInvoices / countTotal Invoices *100  */
        $percentPartiallypaid = round($CountPartiallypaid / $invoicesCount * 100, 2);

        return view('home', compact(
            'totalInvoices',
            'invoicesCount',
            'invoicesNotPay',
            'CountInvoicesNotPay',
            'percentNotPay',
            'CountPayInvoices',
            'SumPayMentInvoices',
            'percentPay',
            'CountPartiallypaid',
            'SumPartiallypaid',
            'percentPartiallypaid'
        ));
    }
}
