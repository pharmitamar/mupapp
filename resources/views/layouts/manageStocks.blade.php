<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>MUP</title>
    
        <!-- Google Fonts -->
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

        <!-- Template Main CSS File -->
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

        <!-- Select2 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <!-- jQuery (required for Select2) -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Select2 JS -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <style>
            /* Flexbox to format options like a table */
            .select2-results__option {
                display: flex;
                justify-content: space-between;
                padding: 5px;
                border-bottom: 1px solid #ddd;
            }
            
            .select2-results__option .row {
                width: 100%;
                display: flex;
                justify-content: space-between;
            }
            
            .select2-results__option .col-md-6,
            .select2-results__option .col-md-3 {
                text-align: left;
            }
        
            /* Styling for selected option */
            .select2-selection__rendered {
                display: flex;
                justify-content: space-between;
            }
        </style>
        
    </head>
    <body>
        @include('layouts.partials.header')
        {{-- @include('layouts.partials.sidebar') --}}
        <main id="main" class="main">
            <section class="section">
                <div class="row">
                    <!-- Single Form Container -->
                    <div class="col-lg-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Add Stocks</h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="bookTitle" class="form-label">Book Title</label>
                                        <select id="bookTitle" class="form-select" name="bookTitle" style="width: 100%;" required>
                                            <option selected disabled>Select Book</option>
                                            <!-- Initial data load -->
                                            @foreach($books as $book)
                                                <option value="{{ $book->Book_ID }}">{{ $book->Title }} - {{ $book->language }}</option>
                                            @endforeach
                            {{-- STORED PROCEDURE EXAMPLE --}}
                                            {{-- @foreach($books as $book)
                                                <option value="{{ $book->Book_ID }}">
                                                    {{ $book->Title }} - {{ $book->Description }} - {{ $book->HSN_Code }}
                                                </option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <label for="authors">Authors:</label>
                                        <input type="text" id="authors" class="form-control" readonly>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="language">Language:</label>
                                        <input type="text" id="language" class="form-control" readonly>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="totalPages">Total Pages:</label>
                                        <input type="text" id="totalPages" class="form-control" readonly>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="isbn">ISBN:</label>
                                        <input type="text" id="isbn" class="form-control" readonly>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="publicationDate">Publication Date:</label>
                                        <input type="text" id="publicationDate" class="form-control" readonly>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="totlQty">Total Quantity:</label>
                                        <input type="text" id="totlQty" class="form-control" readonly>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="mrp">MRP (in rs):</label>
                                        <input type="text" id="mrp" class="form-control" readonly>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="mrp_dollar">MRP (in $):</label>
                                        <input type="text" id="mrp_dollar" class="form-control" readonly>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="mrp_euro">MRP (in Euro)::</label>
                                        <input type="text" id="mrp_euro" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                               
                </div>
            </section>
            <section id="editionSection" class="section d-none">
                <div class="row">                   
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">View Edition Details</h5>
                                <table class="table" id="editionDetailTable">
                                    <thead>
                                        <tr>
                                            <th>ISBN</th>
                                            <th>Publication Date</th>
                                            <th>Total Copies</th>
                                            <th>MRP</th>
                                            <th>View Print Details</th>
                                            <th>Add New Print Details</th>
                                            <th>View Distribution Details</th>
                                            <th>Add New Distribution Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="existPrintDetailSection" class="section d-none">
                <div class="row">                   
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">View Existing Print Details</h5>
                                <table class="table" id="existPrintDetailTable">
                                    <thead>
                                        <tr>
                                            <th>Publication Date</th>
                                            <th>Subledger Code</th>
                                            <th>No of Copies</th>
                                            <th>Print Details</th>
                                            <th>Print Amt</th>
                                            <th>Copy Editing Amt</th>
                                            <th>Art Work Amt</th>
                                            <th>Base Rate</th>
                                            <th>Total Quantity</th>
                                            <th>View file</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main><!-- End #main -->

        @include('layouts.partials.footer')

        <!-- Vendor JS Files -->
        <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        {{-- <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script> --}}
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- DataTables JS -->
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

        
        <script src="{{ asset('assets/js/main.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>    
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#bookTitle').select2({
                    placeholder: 'Search for books...',
                    ajax: {
                        url: '{{ route("manageStocks") }}',  // Route to fetch books
                        dataType: 'json',
                        delay: 250,  // Delay before sending request
                        data: function (params) {
                            return {
                                search: params.term,  // The search term
                                page: params.page || 1  // The page number for pagination
                            };
                        },
                        processResults: function (data) {
                            return {
                                results: data.results,  // Process results into format required by Select2
                                pagination: {
                                    more: data.pagination.more  // Show if more pages exist
                                }
                            };
                        },
                        cache: true
                    },
                    minimumInputLength: 1,  // Minimum characters before search is triggered
                    dropdownAutoWidth: true  // Adjust dropdown width automatically
                });
                $('#bookTitle').on('select2:select', function (e) {
                    $('#editionSection').removeClass('d-none');

                    var selectedBookId = e.params.data.id;

                    console.log(selectedBookId);
                    
                    // Make an AJAX request to get book details
                    $.ajax({
                        url: '{{ route("getBookDetails") }}',
                        type: 'GET',
                        data: { book_id: selectedBookId },
                        success: function(response) {
                            // Populate the form fields
                            console.log(response)
                            if (response.authors.length > 0) {
                                    $('#authors').val(response.authors);
                                } else {
                                    $('#authors').val('No authors found');
                                }
                            if (response.language.length > 0) {
                                $('#language').val(response.language);
                            } else {
                                $('#language').val('No authors found');
                            }
                            
                            $('#totalPages').val(response.total_pages);
                            $('#isbn').val(response.isbn);
                            
                            if (response.mrp.length > 0) {
                                $('#mrp').val(response.mrp);
                            } else {
                                $('#mrp').val('No authors found');
                            }
                            if (response.mrp_dollar.length > 0) {
                                $('#mrp_dollar').val(response.mrp_dollar);
                            } else {
                                $('#mrp_dollar').val('No authors found');
                            }
                            if (response.mrp_euro.length > 0) {
                                $('#mrp_euro').val(response.mrp_euro);
                            } else {
                                $('#mrp_euro').val('No authors found');
                            }
                            if (response.isbn.length > 0) {
                                $('#isbn').val(response.isbn);
                            } else {
                                $('#isbn').val('No authors found');
                            }
                            if (response.print_date && response.print_date.length > 0) {
                                // Create a new Date object
                                let rawDate = new Date(response.print_date);
                                
                                // Format the date as 'YYYY-MM-DD'
                                let formattedDate = rawDate.toISOString().split('T')[0];

                                // Set the value in the input field
                                $('#publicationDate').val(formattedDate);
                            } else {
                                $('#publicationDate').val('No Print Date');
                            }

                              // Clear existing table rows

                            $('#editionDetailTable tbody').empty();

                            // Dynamically populate the table with edition details
                    
                                let row = '<tr>' +
                                    '<td>' + (response.isbn || 'N/A') + '</td>' +
                                    '<td>' + (response.print_date || 'N/A') + '</td>' +
                                    '<td>' + (response.totalQty || 'N/A') + '</td>' +
                                    '<td>' + (response.mrp || 'N/A') + '</td>' +
                                    '<td><button class="btn btn-success view-print-details" data-isbn="' + (response.isbn || '') + '">View/Edit</button></td>' +
                                    '<td><button class="btn btn-primary">+Add</button></td>' +
                                    '<td><button class="btn btn-success">View/Edit</button></td>' +
                                    '<td><button class="btn btn-primary">+Add</button></td>' +
                                '</tr>';
                                $('#editionDetailTable tbody').append(row);
                            
                                $(document).on('click', '.view-print-details', function() {
                                // Get the ISBN from the button's data attribute
                                let isbn = $(this).data('isbn');
                                
                                console.log('ISBN clicked:', isbn);  // For debugging
                                
                                // Make the edition section visible
                                $('#existPrintDetailSection').removeClass('d-none');
                                
                                $('#existPrintDetailSection tbody').empty();

                                // Dynamically populate the table with edition details                         
                            // Assuming response.bookPrintDetails is an array of print details
                                response.bookPrintDetails.forEach(function(detail) {
                                    let row = '<tr>' +
                                        '<td>' + (detail.Print_Date || 'N/A') + '</td>' +  // Publication Date
                                        '<td>' + (detail.SubledgerCode || 'N/A') + '</td>' +  // Subledger Code
                                        '<td>' + (detail.NoOfCopies || 'N/A') + '</td>' +  // No of Copies
                                        '<td>' + (detail.Printer_Name || 'N/A')  + '</td>' +
                                        '<td>' + (detail.Printing_amt || 'N/A') + '</td>' +  // Print Amt
                                        '<td>' + (detail.Copy_WritingAmt || 'N/A') + '</td>' +  // Copy Editing Amt
                                        '<td>' + (detail.ArtWork_amt || 'N/A') + '</td>' +  // Art Work Amt
                                        '<td>' + (detail.Base_Rate || 'N/A') + '</td>' +  // Base Rate
                                        '<td>' + (detail.Available_Qty || 'N/A') + '</td>' +  // Total Quantity
                                        '<td>' + + '</td>' +  // View file link
                                        '<td><a href="#" class="edit-link" data-id="' + (detail.id || '') + '">Edit</a></td>' +  // Edit link
                                    '</tr>';
                                    
                                    $('#existPrintDetailSection tbody').append(row);  // Append each row to the table
                                });

                            });

                        },
                        error: function(xhr) {
                            console.error(xhr);
                        }
                    });
                });

              
            });

            
        </script>
    
         <!-- Bootstrap Modal -->
         {{-- contributorsModal Details --}}
        
    </body>
</html>
