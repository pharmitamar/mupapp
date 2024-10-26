<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManageStocksController extends Controller
{
    public function manageStocks(Request $request)
    {
        $search = $request->input('search');  // Capture the search input
        $page = $request->input('page', 1);   // Capture the current page
        $perPage = 10;  // Define how many records you want per page
    
        // Query the database with optional search filtering and pagination
        $books = DB::table('book_m')
            ->join('book_stock_m', 'book_m.Book_ID', '=', 'book_stock_m.Book_ID')
            ->select('book_m.Book_ID', 'book_m.Title', 'book_m.language', 'book_stock_m.HSN_Code')
            ->when($search, function ($query, $search) {
                return $query->where('book_m.Title', 'like', "%{$search}%");
            })
            ->paginate($perPage, ['*'], 'page', $page);
    
        // Check if this is an AJAX request
        if ($request->ajax()) {
            // Format the data for Select2
            $formattedBooks = $books->map(function ($book) {
                return [
                    'id' => $book->Book_ID,
                    'hsnCode' => $book->HSN_Code,  // The value for the dropdown
                    'text' => $book->Title . ' - ' . $book->language . ' - ' . $book->HSN_Code  // The display text
                ];
            });
    
            // Return JSON response for Select2
            return response()->json([
                'results' => $formattedBooks,  // The current page of data
                'pagination' => ['more' => $books->hasMorePages()]  // Whether there are more pages to load
            ]);
        }
    
        // For non-AJAX requests, return the full HTML view with the initial set of books
        return view('layouts/manageStocks', compact('books'));
    }
    
    public function getBookDetails(Request $request)
    {
        // Get the selected book ID from the request
        $bookId = $request->input('book_id');

        // Fetch the authors from the 'book_contributedetails' table where Type_ID = 1
        $authors = DB::table('book_contributedetails')
                    ->where('Book_ID', $bookId)
                    ->where('Type_ID', 1)
                    ->pluck('Name');  // Assuming the 'Name' column holds the author's name

                    
        // Fetch other book details from your other tables (for example, book_m table)
        $bookDetails = DB::table('book_m')
                        ->where('Book_ID', $bookId)
                        ->select('language', 'Total_pages',)
                        ->first();

        $bookStockDetails = DB::table('book_stock_m')
        ->where('Book_ID', $bookId)
        ->select('MRP', 'MRP_Dollar', 'MRP_Euro', 'Print_Date', 'ISBN', 'Print_Qty')
        ->first();

        if ($bookStockDetails) {
            // Get all records from book_printdetails where ISBN matches the one from book_stock_m
            $bookPrintDetails = DB::table('book_printdetails')
                ->join('printer_m', 'book_printdetails.Printer_Details', '=', 'printer_m.Print_ID')  // Join with printer_m
                ->where('ISBN', $bookStockDetails->ISBN)
                ->select('SubledgerCode', 'Printing_amt', 'ArtWork_amt', 'Copy_WritingAmt', 'Base_Rate', 'Print_Date', 'NoOfCopies', 'Available_Qty', 'printer_m.Printer_Name')  // Add all the required columns here
                ->get();
        
        } else {
            return response()->json([
                'error' => 'Book stock details not found',
            ], 404);
        }

        // Return the response as JSON, including authors and other book details
        return response()->json([
            'authors' => $authors,  // This will return an array of author names
            'language' => $bookDetails->language,
            'total_pages' => $bookDetails->Total_pages,
            'mrp' => $bookStockDetails->MRP,
            'mrp_dollar' => $bookStockDetails->MRP_Dollar,
            'mrp_euro' => $bookStockDetails->MRP_Euro,
            'print_date' => $bookStockDetails->Print_Date,
            'isbn' => $bookStockDetails->ISBN,
            'totalQty' => $bookStockDetails->Print_Qty,
            'bookPrintDetails' => $bookPrintDetails->map(function ($detail) {
                return [
                    'NoOfCopies' => $detail->NoOfCopies,
                    'Print_Date' => $detail->Print_Date,
                    'SubledgerCode' => $detail->SubledgerCode,
                    'Printing_amt' => $detail->Printing_amt,
                    'ArtWork_amt' => $detail->ArtWork_amt,
                    'Copy_WritingAmt' => $detail->Copy_WritingAmt,
                    'Base_Rate' => $detail->Base_Rate,
                    'Available_Qty' => $detail->Available_Qty,
                    'Printer_Name' => $detail->Printer_Name,
                ];
            })
        ]);
    }
}
