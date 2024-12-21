<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            border: 1px solid #ddd;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .details {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Payment Receipt</h1>
        <p><strong>Date:</strong> {{ now()->format('F d, Y') }}</p>
    </div>

    <div class="details">
        <h3>Student Details</h3>
        <p><strong>Index Number:</strong> {{ $feespaid->student_index_number }}</p>
        <p><strong>Name:</strong> {{ $feespaid->student_name }}</p>

        <h3>Payment Details</h3>
        <table>
            <tr>
                <th>Academic Year</th>
                <td>{{ $feespaid->start_academic_year }} - {{ $feespaid->end_academic_year }}</td>
            </tr>
            <tr>
                <th>Semester</th>
                <td>{{ $feespaid->semester }}</td>
            </tr>
            <tr>
                <th>Amount Paid</th>
                <td>{{ $feespaid->currency }} {{ number_format($feespaid->amount, 2) }}</td>
            </tr>
            <tr>
                <th>Balance</th>
                <td>{{ $feespaid->currency }} {{ number_format($feespaid->balance, 2) }}</td>
            </tr>
            <tr>
                <th>Method of Payment</th>
                <td>{{ $feespaid->method_of_payment }}</td>
            </tr>
            @if ($feespaid->cheque_number)
            <tr>
                <th>Cheque Number</th>
                <td>{{ $feespaid->cheque_number }}</td>
            </tr>
            @endif
            @if ($feespaid->Momo_number)
            <tr>
                <th>MoMo Number</th>
                <td>{{ $feespaid->Momo_number }}</td>
            </tr>
            @endif
        </table>
    </div>

    <div class="footer">
        <p>Thank you for your payment!</p>
    </div>
</body>
</html>
