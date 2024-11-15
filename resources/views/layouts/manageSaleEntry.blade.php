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
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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
                                        <div class="col-md-2">
                                            <label for="billDate" class="form-label">Bill Date</label>
                                            <input type="date" 
                                                   class="form-control" 
                                                   id="billDate" 
                                                   name="billDate" 
                                                   required
                                                   value="{{ date('Y-m-d') }}" />
                                        </div>
                                        <div class="col-md-2">
                                            <label for="billType" class="form-label">Bill Type</label>
                                            <select id="billType" class="form-select" name="billType" required>
                                                <option selected disabled>Select</option>
                                                @foreach($billTypes as $billType)
                                                    <option value="{{ $billType->Bill_TypeID }}">{{ $billType->Description }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="row g-3" id="invoiceTypeContainer" style="display: none;">
                                            <div class="col-md-2">
                                                <label for="invoiceType" class="form-label">Invoice Type</label>
                                                <select id="invoiceType" class="form-select" name="invoiceType" required>
                                                    <option selected disabled>Select</option>
                                                    @foreach($billTypes as $billType)
                                                        <option value="{{ $billType->Bill_TypeID }}">{{ $billType->Description }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-2">
                                            <label for="taxClassification" class="form-label">Tax Classification</label>
                                            <select id="taxClassification" class="form-select" name="taxClassification" required>
                                                <option selected disabled>Select</option>
                                                @foreach($taxClassifications as $tax)
                                                    <option value="{{ $tax->ID }}">{{ $tax->Description }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="customerId" class="form-label">Customer ID</label>
                                            <select id="customerId" class="form-select" name="customerId" style="width: 100%;">
                                                <option value="">Search Customer...</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="billTo" class="form-label">Bill To(Leagal Name)</label>
                                            <input type="text" class="form-control" id="billTo" name="billTo">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="billAddress" class="form-label">Bill Address</label>
                                            <textarea class="form-control" id="billAddress" name="billAddress" rows="2" style="resize: none;" placeholder="Enter billing address"></textarea>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="customerTradeName" class="form-label">Customer Trade Name</label>
                                            <textarea class="form-control" id="customerTradeName" name="customerTradeName" rows="2" style="resize: none;" placeholder="Enter billing address"></textarea>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="customerLocation" class="form-label">Customer Location</label>
                                            <input type="text" class="form-control" id="customerLocation" name="customerLocation">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="placeOfSupply" class="form-label">Place of Supply</label>
                                            <select id="placeOfSupply" class="form-select" name="placeOfSupply" required>
                                                <option selected disabled>Select</option>
                                                @foreach($states as $state)
                                                    <option value="{{ $state->Id }}">{{ $state->Description }}-{{ $state->SID }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="pinCode" class="form-label">Pin Code</label>
                                            <input type="number" class="form-control" id="pinCode" name="pinCode">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="gstn" class="form-label">GSTIN</label>
                                            <input type="text" class="form-control" id="gstn" name="gstn">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="longNarration" class="form-label">Long Narration</label>
                                            <textarea class="form-control" id="longNarration" name="longNarration" rows="2" style="resize: none;" placeholder="Enter billing address"></textarea>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="internationalBilling" class="form-label">International Billing</label>
                                            <select class="form-select" id="internationalBilling" name="internationalBilling" required>
                                                <option selected disabled>Select</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="stateCode" class="form-label">State Code</label>
                                            <select id="stateCode" class="form-select" name="stateCode" required>
                                                <option selected disabled>Select</option>
                                                @foreach($states as $state)
                                                    <option value="{{ $state->Id }}">{{ $state->Description }}-{{ $state->SID }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="paymentType" class="form-label">Payment Type</label>
                                            <select id="paymentType" class="form-select" name="paymentType" required>
                                                <option selected disabled>Select</option>
                                                @foreach($paymentTypes as $paymentType)
                                                    <option value="{{ $paymentType->Paytype_ID }}">{{ $paymentType->Description }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="totalAmount" class="form-label">Total Amount</label>
                                            <input type="number" class="form-control" id="totalAmount" name="totalAmount">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="cgstAmount" class="form-label">CGST Amount</label>
                                            <input type="number" class="form-control" id="cgstAmount" name="cgstAmount">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="sgstAmount" class="form-label">SGST Amount</label>
                                            <input type="number" class="form-control" id="sgstAmount" name="sgstAmount">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="igstAmount" class="form-label">IGST Amount</label>
                                            <input type="number" class="form-control" id="igstAmount" name="igstAmount">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="bankReferenceNo" class="form-label">Bank Refernce No</label>
                                            <input type="number" class="form-control" id="bankReferenceNo" name="bankReferenceNo">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="courierCharges" class="form-label">Courier Charges</label>
                                            <input type="number" class="form-control" id="courierCharges" name="courierCharges">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <!-- Contributor Details Form Fields -->
                        <div class="col-lg-12">
                            <div class="card" id="saleEntryTableCard" style="display: none;">
                                <div class="card-body">
                                    <h5 class="card-title">Add New Entry</h5>
                                    <table class="table" id="addNewSaleEntryTable">
                                        <thead>
                                            <tr>
                                                <th>Select Book</th>
                                                <th>Quantity</th>
                                                <th>Base Rate</th>
                                                <th>MRP</th>
                                                <th>Bill Amount</th>
                                                <th>CGST %</th>
                                                <th>SGST %</th>
                                                <th>Discount %</th>
                                                <th>Total Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <select id="bookTitle" class="form-select" name="bookTitle" style="width: 100%;" required>
                                                        <option selected disabled>Select Book</option>
                                                        <!-- Initial data load -->
                                                        @foreach($books as $book)
                                                            <option value="{{ $book->Book_ID }}">{{ $book->Title }} - {{ $book->language }} - {{ $book->HSN_Code }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input type="text" class="form-control" name="contributors[0][name]" required></td>
                                                <td><input type="number" class="form-control" name="contributors[0][quantity]" required></td>
                                                <td><input type="number" class="form-control" name="contributors[0][baseRate]" required></td>
                                                <td><input type="number" class="form-control" name="contributors[0][mrp]" required></td>
                                                <td><input type="number" class="form-control" name="contributors[0][billAmount]" required></td>
                                                <td><input type="number" class="form-control" name="contributors[0][cgst]" required></td>
                                                <td><input type="number" class="form-control" name="contributors[0][sgst]" required></td>
                                                <td><input type="number" class="form-control" name="contributors[0][totalAmount]" required></td>
                                                <td><span class="action-btn delete-row">🗑️</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="text-end">
                                        <button type="button" class="btn btn-secondary" id="addRowBtn">+ Add New Row</button>
                                    </div>
                                    <hr>
                                    <div class="row g-3">
                                        <div class="col-md-2">
                                            <label for="recievedAmount" class="form-label">Recieved Amount</label>
                                            <input type="number" class="form-control" id="recievedAmount" name="recievedAmount">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="billStatus" class="form-label">Bill Status</label>
                                            <select id="billStatus" class="form-select" name="paymentType" required>
                                                <option selected disabled>Select</option>
                                                {{-- @foreach($paymentTypes as $paymentType)
                                                    <option value="{{ $paymentType->Paytype_ID }}">{{ $paymentType->Description }}</option>
                                                @endforeach --}}
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="discountFile" class="form-label">Upload Discount File</label>
                                            <input type="file" class="form-control" id="discountFile" name="discountFile"accept=".pdf,.doc,.docx,.xls,.xlsx">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="discountRemarks" class="form-label">Discount Remarks</label>
                                            <textarea class="form-control" id="discountRemarks" name="discountRemarks" rows="2" style="resize: none;" placeholder="Enter billing address"></textarea>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="billRemarks" class="form-label">Bill Remarks</label>
                                            <textarea class="form-control" id="billRemarks" name="billRemarks" rows="2" style="resize: none;" placeholder="Enter billing address"></textarea>
                                        </div>
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
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#billType').change(function() {
                    const selectedValue = $(this).val();
                    const invoiceTypeContainer = $('#invoiceTypeContainer');
                    
                    if (selectedValue && selectedValue !== 'Select') {
                        invoiceTypeContainer.slideDown(); // or use .show()
                    } else {
                        invoiceTypeContainer.slideUp(); // or use .hide()
                        $('#invoiceType').val('Select'); // Reset invoice type selection
                    }
                });

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

                // Optional: Handle selection change
                $('#bookTitle').on('select2:select', function(e) {
                    var bookId = e.params.data.id;
                    // You can add additional logic here when a book is selected
                });

                $('#customerId').select2({
                    placeholder: 'Search Customer ID or Name',
                    allowClear: true,
                    ajax: {
                        url: '{{ route("customers.data") }}',
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                search: params.term,
                                page: params.page || 1
                            };
                        },
                        processResults: function(data) {
                            return {
                                results: data.results,
                                pagination: {
                                    more: data.pagination.more
                                }
                            };
                        },
                        cache: true
                    },
                    minimumInputLength: 2
                });

                // Handle customer selection
                $('#customerId').on('select2:select', function(e) {
                    var customerId = e.params.data.id;
                    fetchCustomerDetails(customerId);
                });

                function fetchCustomerDetails(customerId) {
                    $.ajax({
                        url: '{{ route("customer.details") }}',
                        method: 'GET',
                        data: { customer_id: customerId },
                        success: function(response) {
                            if (response.success) {
                                const data = response.data;
                                
                                // Auto-fill the fields
                                $('#billTo').val(data.Customername);
                                $('#customerTradeName').val(data.CustomerTradeName);
                                $('#billAddress').val(data.CustomerAddress1);
                                $('#customerLocation').val(data.CustomerLocation);
                                $('#pinCode').val(data.CustomerPincode);
                                $('#stateCode').val(data.CustomerStatecode);
                                $('#gstn').val(data.GSTIN);
                                $('#taxClassification').val(data.VendorTaxClassification);

                                // If stateCode is a select element, trigger change event
                                $('#stateCode').trigger('change');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching customer details:', error);
                        }
                    });
                }

                // Optional: Clear fields when customer is cleared
                $('#customerId').on('select2:clear', function() {
                    $('#billTo').val('');
                    $('#customerTradeName').val('');
                    $('#billAddress').val('');
                    $('#customerLocation').val('');
                    $('#pinCode').val('');
                    $('#stateCode').val('').trigger('change');
                    $('#gstn').val('');
                    $('#taxClassification').val('').trigger('change');
                });
       
            });
            document.getElementById('placeOfSupply').addEventListener('change', function() {
                const selectedValue = this.value;
                const tableCard = document.getElementById('saleEntryTableCard');
                
                if (selectedValue && selectedValue !== 'Select') {
                    tableCard.style.display = 'block';
                } else {
                    tableCard.style.display = 'none';
                }
            });

            let rowCount = 1;

            document.getElementById('addRowBtn').addEventListener('click', function () {
                const addNewSaleEntryTable = document.getElementById('addNewSaleEntryTable').getElementsByTagName('tbody')[0];
                const newRow = addNewSaleEntryTable.insertRow();
                newRow.innerHTML = `
                    <td>
                        <select class="form-select select2-book" name="books[${rowCount}][bookId]" style="width: 100%;" required>
                            <option selected disabled>Select Book</option>
                        </select>
                    </td>
                    <td>
                        <input type="number" class="form-control" name="books[${rowCount}][quantity]" required>
                    </td>
                    <td>
                        <input type="number" class="form-control" name="books[${rowCount}][baseRate]" required>
                    </td>
                    <td>
                        <input type="number" class="form-control" name="books[${rowCount}][mrp]" required>
                    </td>
                    <td>
                        <input type="number" class="form-control" name="books[${rowCount}][billAmount]" required>
                    </td>
                    <td>
                        <input type="number" class="form-control" name="books[${rowCount}][cgst]" required>
                    </td>
                    <td>
                        <input type="number" class="form-control" name="books[${rowCount}][sgst]" required>
                    </td>
                    <td>
                        <input type="number" class="form-control" name="books[${rowCount}][discount]" required>
                    </td>
                    <td>
                        <input type="number" class="form-control" name="books[${rowCount}][totalAmount]" required>
                    </td>
                    <td>
                        <span class="action-btn delete-row">🗑️</span>
                    </td>
                `;
                
                // Initialize Select2 for the new book select
                $(newRow).find('.select2-book').select2({
                    placeholder: 'Search for books...',
                    ajax: {
                        url: '{{ route("manageStocks") }}',
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return {
                                search: params.term,
                                page: params.page || 1
                            };
                        },
                        processResults: function (data) {
                            return {
                                results: data.results,
                                pagination: {
                                    more: data.pagination.more
                                }
                            };
                        },
                        cache: true
                    },
                    minimumInputLength: 1,
                    dropdownAutoWidth: true
                });

                rowCount++;
            });

            // Handle row deletion
            $(document).on('click', '.delete-row', function() {
                $(this).closest('tr').remove();
            });
             

        </script>

        <script src="{{ asset('assets/js/main.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>   
    </body>
</html>
