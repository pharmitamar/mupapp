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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <style>
            .action-btn {
                cursor: pointer;
                color: #dc3545; /* Bootstrap danger color */
                font-size: 18px;
            }
            .table td, .table th {
                vertical-align: middle;
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
                    <form class="row g-3" id="mainForm" action="{{ route('dashboard.store') }}" method="POST">
                        @csrf
                        <!-- Book Details Form Fields -->
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">Stock Sale (Billing)</h5>
                                    <div class="row g-3">
                                        <div class="col-md-2">
                                            <label for="billSerial" class="form-label">Bill Serial:</label>
                                            <input type="text" class="form-control" id="billSerial" name="billSerial" required>
                                        </div>
                                        {{-- <div class="col-md-4">
                                            <label for="categorySelect" class="form-label">Category ID</label>
                                            <select id="categorySelect" class="form-select" name="categoryId" required>
                                                <option selected disabled>Select Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->Category_ID }}">{{ $category->Category_description }}</option>
                                                @endforeach
                                            </select>
                                        </div> --}} 
                                        <div class="col-md-2">
                                            <label for="categorySelect" class="form-label">Category ID</label>
                                            <select id="categorySelect" class="form-select" name="categoryId" required>
                                                <option selected disabled>Select Category</option>
                                               
                                                    <option value="">Option</option>
                                               
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="totalPages" class="form-label">Total Pages</label>
                                            <input type="number" class="form-control" id="totalPages" name="totalPages">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="totalPages" class="form-label">Total Pages</label>
                                            <input type="number" class="form-control" id="totalPages" name="totalPages">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="totalPages" class="form-label">Total Pages</label>
                                            <input type="number" class="form-control" id="totalPages" name="totalPages">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="totalPages" class="form-label">Total Pages</label>
                                            <input type="number" class="form-control" id="totalPages" name="totalPages">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="totalPages" class="form-label">Total Pages</label>
                                            <input type="number" class="form-control" id="totalPages" name="totalPages">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <!-- Contributor Details Form Fields -->
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Add New Entry</h5>
                                    <table class="table" id="addNewSaleEntryTable">
                                        <thead>
                                            <tr>
                                                <th>Contributor Type</th>
                                                <th>Name</th>
                                                <th>Royalty Percentage (in %)</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <select class="form-select" name="contributors[0][typeId]" required>
                                                        <option selected disabled>Select Contributor Type</option>
                                                        {{-- @foreach($contributeTypes as $contributetype)
                                                            <option value="{{ $contributetype->Type_ID }}">{{ $contributetype->Description }}</option>
                                                        @endforeach --}}
                                                    </select>
                                                </td>
                                                <td><input type="text" class="form-control" name="contributors[0][name]" required></td>
                                                <td><input type="number" class="form-control" name="contributors[0][royaltyPercentage]" required></td>
                                                <td><span class="action-btn delete-row">🗑️</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="text-end">
                                        <button type="button" class="btn btn-secondary" id="addRowBtn">+ Add New Row</button>
                                    </div>
                                    <div class="col-lg-12 text-center mt-4">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>                                        
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

        <script>
             let contributorCount = 1;

                document.getElementById('addRowBtn').addEventListener('click', function () {
                    const addNewSaleEntryTable = document.getElementById('addNewSaleEntryTable').getElementsByTagName('tbody')[0];
                    const newRow = addNewSaleEntryTable.insertRow();
                    newRow.innerHTML = `
                        <td>
                            <select class="form-select" name="contributors[${contributorCount}][typeId]" required>
                                <option selected disabled>Select Contributor Type</option>
                               
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="contributors[${contributorCount}][name]" required></td>
                        <td><input type="number" class="form-control" name="contributors[${contributorCount}][royaltyPercentage]" required></td>
                        <td><span class="action-btn delete-row">🗑️</span></td>
                    `;
                    contributorCount++;
                });

        </script>

        <script src="{{ asset('assets/js/main.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
        <!-- Bootstrap Modal -->
        {{-- contributorsModal Details --}}
        
        {{-- <div class="modal fade" id="contributorsModal" tabindex="-1" role="dialog" aria-labelledby="contributorsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="contributorsModalLabel">Contributors Details</h5>
                    </div>
                    <div class="modal-body">
                        <!-- Contributors Table -->
                        <table id="contributorsTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Contributor Type</th>
                                    <th>Name</th>
                                    <th>Royalty Percentage</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Dynamic rows will be appended here using jQuery -->
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div> --}}

        <!-- Bootstrap Modal -->
        {{-- Edition Details --}}
        
    </body>
</html>
