<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>
        {{ $code }}
    </h1>
    <h2>
        {{ $merchant['merchant']['name'] }}
    </h2>
    <h2>
        Total : USD {{ $total }}
    </h2>


    @if (!count($order_items) == 0)
        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order_items as $item)
                <tr>
                    <td>{{ $item['menu']['name'] }}</td>
                    <td>{{ $item['menu']['name'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>

</html>