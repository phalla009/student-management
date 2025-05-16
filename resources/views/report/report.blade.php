<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Report</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="text-center mt-5">Payment Report</h1>
        <hr/>
        
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Receipt No</th>
                    <th>Enrollment No</th>
                    <th>Paid Date</th>
                    <th>Student Name</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payments as $payment)
                    <tr data-id="{{ $payment->id }}">
                        <td>{{ $payment->id }}</td>
                        <td>{{ $payment->enrollment->enroll_no }}</td>
                        <td>{{ \Carbon\Carbon::parse($payment->paid_date)->format('F d, Y') }}</td>
                        <td>{{ $payment->enrollment->student->name ?? 'N/A' }}</td>
                        <td>${{ number_format($payment->amount, 2) }}</td>
                        <td><button class="btn btn-sm btn-info print-btn" data-id="{{ $payment->id }}">Print</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <hr/>

        <p><strong>Printed By:</strong> <b>{{ Auth::check() ? Auth::user()->name : 'Guest' }}</b></p>
        <p><strong>Printed Date:</strong> <b>{{ \Carbon\Carbon::now()->format('F d, Y') }}</b></p>
    </div>

    <!-- JavaScript to Print Individual Row -->
    <script>
        document.querySelectorAll('.print-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                var rowId = this.getAttribute('data-id');
                var row = document.querySelector("tr[data-id='" + rowId + "']");
                
                var printWindow = window.open('', '', 'height=600,width=800');
                printWindow.document.write('<html><head><title>Print Row</title></head><body>');
                printWindow.document.write('<table border="1" style="width: 100%; border-collapse: collapse;">');
                
                // Copy the content of the row to the print window
                printWindow.document.write(row.outerHTML);
                
                printWindow.document.write('</table>');
                printWindow.document.write('</body></html>');
                printWindow.document.close();
                printWindow.print();
            });
        });
    </script>

</body>
</html>
