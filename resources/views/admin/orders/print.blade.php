<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipping Label - {{ $order->code }}</title>
    <style>
        body { font-family: sans-serif; padding: 20px; border: 1px solid #ccc; max-width: 600px; margin: 0 auto; }
        .header { text-align: center; border-bottom: 2px solid #000; padding-bottom: 20px; margin-bottom: 20px; }
        .title { font-size: 24px; font-weight: bold; }
        .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .box { border: 1px solid #000; padding: 15px; }
        .label { font-size: 10px; text-transform: uppercase; color: #666; margin-bottom: 5px; }
        .value { font-size: 16px; font-weight: bold; }
        .address { font-size: 14px; line-height: 1.4; }
        .resi { text-align: center; margin-top: 20px; padding: 20px; border: 2px dashed #000; }
        .resi-number { font-size: 32px; font-weight: bold; letter-spacing: 2px; }
        @media print {
            body { border: none; }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="header">
        <div class="title">CIPA STORE</div>
        <div>Fashion & Lifestyle</div>
    </div>

    <div class="resi">
        <div class="label">Tracking Number (Resi)</div>
        <div class="resi-number">{{ $order->tracking_number ?? 'NO RESI' }}</div>
        <div style="margin-top: 10px;">{{ $order->courier }}</div>
    </div>

    <div class="grid" style="margin-top: 20px;">
        <div class="box">
            <div class="label">Sender</div>
            <div class="value">Cipa Store</div>
            <div class="address" style="margin-top: 5px;">
                Jakarta, Indonesia<br>
                0812-3456-7890
            </div>
        </div>
        <div class="box">
            <div class="label">Receiver</div>
            <div class="value">{{ $order->user->name }}</div>
            <div class="address" style="margin-top: 5px;">
                {{ $order->user->address }}<br>
                {{ $order->user->phone_number }}
            </div>
        </div>
    </div>

    <div class="box" style="margin-top: 20px;">
        <div class="label">Items</div>
        <ul style="margin: 0; padding-left: 20px; font-size: 14px;">
            @foreach($order->details as $detail)
            <li>{{ $detail->product->name }} (x{{ $detail->quantity }})</li>
            @endforeach
        </ul>
    </div>
    
    <div style="margin-top: 20px; text-align: center; font-size: 12px; color: #888;">
        Order Code: {{ $order->code }} | Date: {{ $order->created_at->format('d M Y') }}
    </div>
</body>
</html>
