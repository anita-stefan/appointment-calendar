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
@csrf
<form id="form">
<div class="container">
    <input id="data" type="date" name="data" min="{{ $currentData }}">
    <label for="hour">Choose a hour:</label>
    <select name="hour" id="hour">
{{--        @foreach($hoursAvailable as $hour)--}}
            <option value="">Alege ora</option>
{{--        @endforeach--}}
    </select>
    <button id="submit">Programeaza</button>
</div>
</form>
</body>
</html>

<script>

    $('#data').on('change', function() {
        let data = this.value;
        console.log(data)
        $.ajax({
            url: '/hours',
            data: {'date': data, _token: '{!! csrf_token() !!}'},
            type:'GET',
            success: function(data) {
                $('option').remove()
                data.map((e) => {
                    $("#hour").append("<option>"+e+"</option>")

                })
                console.log(data)
            }
        })
    })

    $('#submit').on('click', function () {
        let date = $('#data').val()
        let hour = $('#hour').val()

        if(date !== '') {
            $.ajax({
                url: '/insert-data',
                data: {'date': date, 'hour': hour, _token: '{!! csrf_token() !!}'},
                type: "POST",
                cache: false,
                success: function () {
                    $('#data').val('')
                },
                error: function (error) {
                    console.log(error)
                }
            })
        } else {
            alert('Selecteaza o data')
        }
    })

    $('#data').on('change', function () {
        let day = new Date(this.value).getDay();
        if ([0, 6].includes(day)) {
            this.value = ''
            alert('Nu e permis in weekend')
        }
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


