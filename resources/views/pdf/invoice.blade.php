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
        
        /* Brand Colors */
        .brand-color { color: #FF6B00; } 
        .brand-bg { background-color: #FF6B00; color: #fff; }

        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 10px; text-align: left; }
        th { background: #f4f4f4; }
        .text-right { text-align: right; }
        .totals { margin-top: 20px; width: 300px; float: right; }
        .totals table { border: none; }
        .totals th, .totals td { border: none; padding: 5px 10px; }

        /* Badge */
        .badge { padding: 5px 12px; border-radius: 12px; font-weight: bold; color: #fff; display: inline-block; }
        .badge-unpaid { background-color: #FF6B00; }
        .badge-partial { background-color: #F4B400; }
        .badge-paid { background-color: #28A745; }

        footer { margin-top: 50px; font-size: 12px; text-align: center; color: #888; }
        img.logo { height: 80px; }
        .rounded { border-radius: 8px; }
    </style>
</head>
<body>
<div class="container rounded">
    <header>
        <div class="logo">
            <img src="{{ public_path('images/printbuka-logo.png') }}" alt="PrintBuka Logo" class="logo">
        </div>
        <div class="company-info">
            <h2 class="brand-color">PrintBuka</h2>
            <div>info@printbuka.com</div>
            <div>+234 800 000 0000</div>
            <div>Lagos, Nigeria</div>
        </div>
    </header>

    <h1 class="brand-color">Invoice</h1>

    <div style="margin-bottom: 30px;">
        <strong>Invoice Number:</strong> {{ $invoice->invoice_number }} <br>
        <strong>Date Issued:</strong> {{ $invoice->date_issued->format('M d, Y') }} <br>
        <strong>Payment Due:</strong> {{ $invoice->payment_due_by->format('M d, Y') }} <br>
        <strong>Status:</strong> 
        @php
            $statusClass = match($invoice->payment_status) {
                'Paid' => 'badge-paid',
                'Partial' => 'badge-partial',
                default => 'badge-unpaid',
            };
        @endphp
        <span class="badge {{ $statusClass }}">{{ $invoice->payment_status }}</span>
    </div>

    <div style="margin-bottom: 20px;">
        <strong>Bill To:</strong><br>
        {{ $invoice->client_name }} <br>
        {{ $invoice->client_address }} <br>
        {{ $invoice->client_phone }} <br>
        {{ $invoice->client_email }}
    </div>

    <table class="rounded">
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

    <footer>
        Thank you for choosing <strong>PrintBuka</strong>!<br>
        www.printbuka.com | info@printbuka.com
    </footer>
</div>
</body>
</html>