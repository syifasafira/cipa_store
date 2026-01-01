<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #f8f9fa; padding: 20px; text-align: center; border-radius: 8px; }
        .content { padding: 20px 0; }
        .button { display: inline-block; background-color: #4f46e5; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; margin-top: 20px; }
        .footer { text-align: center; font-size: 12px; color: #888; margin-top: 30px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Your Order is on the way!</h2>
        </div>
        
        <div class="content">
            <p>Hi {{ $order->user->name }},</p>
            
            <p>Great news! Your order <strong>#{{ $order->code }}</strong> has been shipped via <strong>{{ $order->courier }}</strong>.</p>
            
            <p><strong>Tracking Number:</strong> <br>
            <span style="font-size: 18px; font-weight: bold; background: #eee; padding: 5px 10px; border-radius: 4px;">
                {{ $order->tracking_number ?? 'Not Available' }}
            </span>
            </p>
            
            <p>You can track your package by clicking the button below:</p>
            
            <a href="{{ route('orders.show', $order->code) }}" class="button">Track My Order</a>
            
            <p>Thank you for shopping with Cipa Store!</p>
        </div>
        
        <div class="footer">
            &copy; {{ date('Y') }} Cipa Store. All rights reserved.
        </div>
    </div>
</body>
</html>
