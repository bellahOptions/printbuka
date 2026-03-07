<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice {{ $invoice->invoice_number }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #333; margin: 0; padding: 0; }
        .container { width: 100%; padding: 30px; }
        header { display: flex; justify-content: space-between; margin-bottom: 40px; }
        header .company-info { text-align: right; }
        h1 { font-size: 28px; margin-bottom: 10px; color: #111; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid #ccc; }
        th, td { padding: 10px; text-align: left; }
        th { background: #f4f4f4; }
        .text-right { text-align: right; }
        .totals { margin-top: 20px; width: 300px; float: right; }
        .totals table { border: none; }
        .totals th, .totals td { border: none; padding: 5px 10px; }
        footer { margin-top: 50px; font-size: 12px; text-align: center; color: #888; }
    </style>
</head>
<body>
<div class="container">
    <header>
        <div class="logo">
            <img src="{{ public_path('images/printbuka-logo.png') }}" alt="PrintBuka Logo" style="height:80px;">
        </div>
        <div class="company-info">
            <h2>PrintBuka</h2>
            <div>info@printbuka.com</div>
            <div>+234 800 000 0000</div>
            <div>Lagos, Nigeria</div>
        </div>
    </header>

    <h1>Invoice</h1>

    <div style="margin-bottom: 30px;">
        <strong>Invoice Number:</strong> {{ $invoice->invoice_number }} <br>
        <strong>Date Issued:</strong> {{ $invoice->date_issued->format('M d, Y') }} <br>
        <strong>Payment Due:</strong> {{ $invoice->payment_due_by->format('M d, Y') }}
    </div>

    <div style="margin-bottom: 20px;">
        <strong>Bill To:</strong><br>
        {{ $invoice->client_name }} <br>
        {{ $invoice->client_address }} <br>
        {{ $invoice->client_phone }} <br>
        {{ $invoice->client_email }}
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Description</th>
                <th>Size/Format</th>
                <th>Material</th>
                <th>Qty</th>
                <th>Unit Price</th>
                <th>Discount</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoice->items as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item['description'] ?? '' }}</td>
                    <td>{{ $item['size_format'] ?? '' }}</td>
                    <td>{{ $item['material'] ?? '' }}</td>
                    <td>{{ $item['quantity'] ?? 0 }}</td>
                    <td class="text-right">{{ number_format($item['unit_price'] ?? 0, 2) }}</td>
                    <td class="text-right">{{ number_format($item['discount'] ?? 0, 2) }}</td>
                    <td class="text-right">{{ number_format($item['amount'] ?? 0, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="totals">
        <table>
            <tr>
                <th>Subtotal:</th>
                <td class="text-right">{{ number_format($invoice->subtotal, 2) }}</td>
            </tr>
            <tr>
                <th>VAT:</th>
                <td class="text-right">{{ number_format($invoice->vat, 2) }}</td>
            </tr>
            <tr>
                <th>Discount:</th>
                <td class="text-right">{{ number_format($invoice->discount, 2) }}</td>
            </tr>
            <tr>
                <th>Total Due:</th>
                <td class="text-right">{{ number_format($invoice->total_due, 2) }}</td>
            </tr>
            <tr>
                <th>Amount Paid:</th>
                <td class="text-right">{{ number_format($invoice->amount_paid, 2) }}</td>
            </tr>
            <tr>
                <th>Balance:</th>
                <td class="text-right">{{ number_format($invoice->balance, 2) }}</td>
            </tr>
        </table>
    </div>

    <div style="clear: both; margin-top: 100px;">
        <strong>Payment Status:</strong> {{ $invoice->payment_status }} <br>
        <strong>Payment Method:</strong> {{ $invoice->payment_method ?? 'N/A' }}
    </div>

    <footer>
        Thank you for your business! PrintBuka - Your Printing Partner<br>
        www.printbuka.com
    </footer>
</div>
</body>
</html>