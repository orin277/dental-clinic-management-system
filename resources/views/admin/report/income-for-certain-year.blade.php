<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <link rel="stylesheet" href="{{ public_path("pdf.css") }}" type="text/css">
</head>
<body style="font-family: firefly, DejaVu Sans, sans-serif;">
<table class="w-full">
    <tr>
        <td class="w-half">
            <img src="{{ public_path("img\logof.png") }}" width="140" />
        </td>
        <td class="w-half">
            <h3>Дохід за {{ $year }} рік</h3>
        </td>
    </tr>
</table>

<div class="margin-top">
    <table class="products">
        <tr>
            <th>Місяць</th>
            <th>Сума (грн)</th>
        </tr>
        @foreach($data as $item)
            <tr class="items">
                <td>
                    {{ $item['month'] }}
                </td>
                <td>
                    {{ $item['total_amount'] }}
                </td>
            </tr>
        @endforeach
    </table>
</div>
<div class="total">
    Загальна сума: {{ $totalIncome }} грн.
</div>
</body>
</html>
