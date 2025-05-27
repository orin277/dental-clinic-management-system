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
            <h3>Номер прийому: {{ $data[0]['appointment_id'] }}</h3>
            <h4>Дата: {{ $data[0]['appointment_date'] }}</h4>
        </td>
    </tr>
</table>

<div class="margin-top">
    <table class="w-full">
        <tr>
            <td class="w-half">
                <div><h4>{{ $data[0]['dentist_specialization_name'] . ':' }}</h4></div>
                <div>{{ $data[0]['dentist_name'] . ' ' . $data[0]['dentist_surname'] . ' ' . $data[0]['dentist_patronymic'] }}</div>
            </td>
            <td class="w-half">
                <div><h4>Пацієнт:</h4></div>
                {{ $data[0]['patient_name'] . ' ' . $data[0]['patient_surname'] . ' ' . $data[0]['patient_patronymic'] }}
            </td>
        </tr>
    </table>
</div>

<div class="margin-top">
    <table class="products">
        <tr>
            <th>Номер рахунку</th>
            <th>Сума</th>
            <th>Дата</th>
        </tr>
        @foreach($data as $item)
            <tr class="items">
                <td>
                    {{ $item['bill_id'] }}
                </td>
                <td>
                    {{ $item['amount'] }}
                </td>
                <td>
                    {{ $item['date'] }}
                </td>
            </tr>
        @endforeach
    </table>
</div>

<div class="total">
    Загальна сума: {{ array_sum(array_column($data, 'amount')) }}
</div>
</body>
</html>
