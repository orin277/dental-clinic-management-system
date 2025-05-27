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
            <th>Номер прийому</th>
            <th>Кабінет</th>
            <th>Дата</th>
            <th>Початок</th>
            <th>Кінець</th>
            <th>Причина звернення</th>
        </tr>
        @foreach($data as $item)
        <tr class="items">
            <td>
                {{ $item['id'] }}
            </td>
            <td>
                {{ $item['cabinet'] }}
            </td>
            <td>
                {{ $item['date'] }}
            </td>
            <td>
                {{ substr($item['start_time'], 0, 5) }}
            </td>
            <td>
                {{ substr($item['end_time'], 0, 5) }}
            </td>
            <td>
                {{ $item['reason'] }}
            </td>
        </tr>
        @endforeach
    </table>
</div>
</body>
</html>
