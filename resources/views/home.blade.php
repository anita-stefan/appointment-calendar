<!DOCTYPE html>
<html>
    <head>
        <title>Appointment calendar</title>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script
            src="https://code.jquery.com/jquery-3.7.0.min.js"
            integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
            crossorigin="anonymous">
        </script>
    </head>
    <body>
        <div class="container">
            <div class="center">
                <h2>Programeaza-te la o sedinta</h2>
                <input id="data" type="date" name="data" min="{{ $currentData }}">
                <select name="hour" id="hour">
                    <option value="">Alege ora</option>
                </select>
                <button id="submit">Programeaza</button>
            </div>
        </div>
    </body>
</html>

<script>
    $('#data').on('change', function () {
        let data = this.value;
        console.log(data)
        $.ajax({
            url: '/hours',
            data: {'date': data, _token: '{!! csrf_token() !!}'},
            type: 'GET',
            success: function (data) {
                $('option').remove()
                data.map((e) => {
                    $("#hour").append("<option>" + e + "</option>")

                })
                console.log(data)
            }
        })
    })

    $('#submit').on('click', function () {
        let date = $('#data').val()
        let hour = $('#hour').val()

        if (date !== '') {
            $.ajax({
                url: '/insert-data',
                data: {'date': date, 'hour': hour, _token: '{!! csrf_token() !!}'},
                type: "POST",
                cache: false,
                success: function () {
                    $('#data').val('')
                    alert('Ai fost programat!')
                },
                error: function (error) {
                    console.log(error)
                }
            })
        } else {
            alert('Selecteaza o data!')
        }
    })

    $('#data').on('change', function () {
        let day = new Date(this.value).getDay();
        if ([0, 6].includes(day)) {
            this.value = ''
            alert('Alege o zi din din intervalul Luni - Vineri')
        }
    })
</script>

<style>
    .container {
        width: 100%;
        height: auto;
    }

    .center {
        height: 45rem;
        width: 45%;
        margin: auto;
        display: grid;
        align-items: center;
        justify-content: center;
        align-content: center;
        gap: 27px;
    }

    input, select, button {
        height: 40px;
        border-radius: 5px;
    }
</style>


