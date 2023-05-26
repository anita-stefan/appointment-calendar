<!DOCTYPE html>
<html>
<head>
    <title>Appointment calendar</title>
    <meta charset="utf-8">
</head>
<body>
    <h2>Appointments</h2>
    <table>
        <tr>
            <th>Data rezervare</th>
            <th>Ora rezervare</th>
        </tr>
        @foreach($appointments as $appointment)
        <tr>
            <td>{{ $appointment->appointment_date }}</td>
            <td>{{ $appointment->appointment_time }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>

<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
</style>
