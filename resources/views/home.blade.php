<!DOCTYPE html>
<html>
<head>
    <title>Page Title</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script
        src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
        crossorigin="anonymous">
    </script>
</head>
<body>
<div class="container">
    <input id="data" type="date" name="data" min="{{ $currentData }}">
    <label for="cars">Choose a hour:</label>
    <select name="cars" id="cars">
        <option value="1">Alege</option>
        @foreach($hoursAvailable as $hour)
            <option value="{{ $hour }}">{{ $hour }}</option>
        @endforeach
    </select>
    <button id="submit">Programeaza</button>
    @if(isset($data))
        <label>{{ date('Y-m-d', strtotime($data)) }}</label>
    @endif
</div>

</body>
</html>

<script>

    $('#submit').on('click', function (e) {
        let a = $('#data').val()
        let b = $('#cars').val()

        $.ajax({
            url: '/insert-data',
            data: {'date': a, 'hour': b, _token: '{!! csrf_token() !!}'},
            type: "POST",
            cache: false,
            success: function (data) {
                alert('Programarea s-a facut')
            },
            error: function (error) {
                console.log(error)
            }
        })
    })
</script>


<style>
    .container {
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid;
        width: 100%;
        height: 30rem;
    }

    input {
        width: 13.6rem;
        height: 50px;
    }

    button {
        width: 13.6rem;
        height: 50px;
    }

</style>


