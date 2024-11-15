<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class manageSaleEntryController extends Controller
{
    // public function manageSaleEntry(Request $request)
    // {
    //     return view('layouts/manageSaleEntry');
    // }
    public function manageSaleEntry(Request $request)
    {
        $billTypes = DB::table('billtype_m')->get();
        $taxClassifications = DB::table('customer_tax_clasification')->get();
        $states = DB::table('state_m')->get();
        $paymentTypes = DB::table('paytype_m')->get();
        $books = DB::table('book_m')
        ->join('book_stock_m', 'book_m.Book_ID', '=', 'book_stock_m.Book_ID')
        ->select('book_m.Book_ID', 'book_m.Title', 'book_m.language', 'book_stock_m.HSN_Code')
        ->take(10)
        ->get();
        return view('layouts/manageSaleEntry', compact('billTypes', 'taxClassifications', 'states', 'paymentTypes', 'books'));
    }

    public function getBillTypes()
    {
        $billTypes = DB::table('billtype_m')->get();
        return response()->json($billTypes);
    }

    public function getCustomers(Request $request)
        {
            $search = $request->input('search');
            $page = $request->input('page', 1);
            $perPage = 10;

            $customers = DB::table('taxrentcustmer_mn')
                ->when($search, function($query) use ($search) {
                    return $query->where('Customername', 'like', '%' . $search . '%')
                                ->orWhere('CustomerID', 'like', '%' . $search . '%');
                })
                ->select('CustomerID as id', 
                        DB::raw("CONCAT(CustomerID, ' - ', Customername) as text"))
                ->paginate($perPage);

            return response()->json([
                'results' => $customers->items(),
                'pagination' => [
                    'more' => $customers->hasMorePages()
                ]
            ]);
        }

    // public function getCustomerDetails(Request $request)
    //     {
    //         $customerId = $request->input('customer_id');

    //         $customerDetails = DB::table('taxrentcustomer_detail')
    //             ->where('CustomerID', $customerId)
    //             ->select(
    //                 'CustomerTradeName',
    //                 'CustomerAddress1',
    //                 'CustomerLocation',
    //                 'CustomerPincode',
    //                 'CustomerStatecode',
    //                 'GSTIN',
    //                 'VendorTaxClassification'
    //             )
    //             ->first();

    //         if ($customerDetails) {
    //             return response()->json([
    //                 'success' => true,
    //                 'data' => $customerDetails
    //             ]);
    //         }

    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Customer details not found'
    //         ]);
    //     }

    public function getCustomerDetails(Request $request)
        {
            $customerId = $request->input('customer_id');

            $customerDetails = DB::table('taxrentcustomer_detail as td')
                ->join('taxrentcustmer_mn as tm', 'td.CustomerID', '=', 'tm.CustomerID')
                ->where('td.CustomerID', $customerId)
                ->select(
                    'tm.Customername',  // Added this line
                    'td.CustomerTradeName',
                    'td.CustomerAddress1',
                    'td.CustomerLocation',
                    'td.CustomerPincode',
                    'td.CustomerStatecode',
                    'td.GSTIN',
                    'td.VendorTaxClassification'
                )
                ->first();

            if ($customerDetails) {
                return response()->json([
                    'success' => true,
                    'data' => $customerDetails
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Customer details not found'
            ]);
        }
        
}
