<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;


class DashboardController extends Controller
{
    public function index()
    {
        // Fetch all languages from the language_m table
        $languages = DB::table('language_m')->get();
        
        // Fetch all categories from the book_category_m table
        $categories = DB::table('book_category_m')->get();
        
        // Fetch all categories from the book_contributetype_m table
        $contributeTypes = DB::table('book_contributetype_m')->get();

        // Fetch all books from the book_m table
        // $books = DB::table('book_m')->paginate(10);
        $books = DB::table('book_m')->get();

        // Fetch contributors for each book from book_contributedetails table
        $contributors = DB::table('book_contributedetails')
        ->join('book_contributetype_m', 'book_contributedetails.Type_ID', '=', 'book_contributetype_m.Type_ID')
        ->select('book_contributedetails.Book_ID', 'book_contributedetails.Type_ID', 'book_contributedetails.Name', 'book_contributedetails.RoyaltyPercentage', 'book_contributetype_m.Description as ContributorType')
        ->get()
        ->groupBy('Book_ID'); // Group contributors by Book_ID

        // Map contributors to each book
        foreach ($books as $book) {
            $book->contributors = $contributors->get($book->Book_ID) ?: []; // Attach contributors to each book
        }

        // Pass languages and categories to the view
        return view('layouts.dashboard', compact('languages', 'categories', 'contributeTypes', 'books'));
        
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            // Debugging: Check if the method is being hit
            Log::info('Store method accessed');
            Log::info('Request data:', $request->all());

           
            // Insert into book_m table
            $bookId = DB::table('book_m')->insertGetId([
                'Title' => $request->input('bookTitle'),
                'Category_ID' => $request->input('categoryId'),
                'Language' => $request->input('language'),
                'Total_pages' => $request->input('totalPages'),
                'CreatedDate' => Carbon::now(),
                'CreatedBy' => 'Admin', 
            ]);

            // Insert contributors into book_contributedetails table
            foreach ($request->input('contributors') as $index => $contributor) {
                DB::table('book_contributedetails')->insert([
                    'Book_ID' => $bookId,
                    'EntryNo' => $index + 1,
                    'Type_ID' => $contributor['typeId'],
                    'Name' => $contributor['name'],
                    'RoyaltyPercentage' => $contributor['royaltyPercentage'],
                ]);
            }

            DB::commit();

            // Set a success flash message in the session
            return redirect()->back()->with('success', 'Book and contributor details saved successfully.');
        }catch (\Exception $e) {
            DB::rollBack();
            
            // Log the exact error message
            Log::error('Error occurred:', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            
            // Optionally include the error message in the session
            return redirect()->back()->with('error', 'An error occurred while saving the data: ' . $e->getMessage());
        }
    }

}
