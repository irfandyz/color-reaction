<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Colors</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/css/user-index.css') }}">
    <style>
        body {
            background: {{ $setting->background }};
        }
    </style>
</head>

<body id="body">
    @if ($setting->audioPlay == 'active')
        <audio controls autoplay id="audioPreview" src="{{ asset('assets/' . $setting->audio) }}"
            class="d-none"></audio>
    @endif
    <div class="starter" id="first">
        <input type="hidden" id="user_id" value="{{ Session::get('user')->id }}">
        <div id="button-first">
            <button class="start-button" onclick="attempt('{{ $setting->attempt }}')">
                <h1><i class="fas fa-gamepad text-success"></i> PLAY</h1>
            </button>
            <button class="start-button bg-warning-dark" onclick="guide()">
                <h1><i class="fas fa-book text-dark"></i> GUIDE</h1>
            </button>
            <button class="start-button bg-danger" onclick="logout()">
                <h1><i class="fas fa-sign-out text-warning"></i> LOGOUT</h1>
            </button>
        </div>
    </div>
    <div class="container bg-white box-guide d-none" id="guide">
        <div class="d-flex justify-content-between">
            <div>
                <button onclick="back()" class="btn btn-primary"><i class="fas fa-backward"></i> Kembali</button>
            </div>
            <div>
                <h1 class="text-center"><i class="fas fa-book"></i> Panduan Bermain</h1>
            </div>
        </div>
        @include('user.guide')
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-2">
                <h1 class="fw-bold d-none text-white" id="countAttempt"><span id="countdown">1</span> of <span
                        id="total-attempt"></span></h1>
            </div>
            <div class="col-sm-8 d-none text-center" id="content">
                @if ($setting->obstacle == 'active')
                    <div style="text-align:center">
                        <span class="dot" id="dot-1"></span>
                        <span class="dot" id="dot-2"></span>
                        <span class="dot" id="dot-3"></span>
                        <span class="dot" id="dot-4"></span>
                        <span class="dot" id="dot-5"></span>
                        <span class="dot" id="dot-6"></span>
                        <span class="dot" id="dot-7"></span>
                        <span class="dot" id="dot-8"></span>
                        <span class="dot" id="dot-9"></span>
                        <span class="dot" id="dot-10"></span>
                        <span class="dot" id="dot-11"></span>
                        <span class="dot" id="dot-12"></span>
                        <span class="dot" id="dot-13"></span>
                        <span class="dot" id="dot-14"></span>
                        <span class="dot" id="dot-15"></span>
                    </div>
                @endif
                <div class="d-flex justify-content-center">
                    @if ($setting->obstacle == 'active')
                        <div style="text-align:center">
                            <div class="dot-side mt-1" id="dot-16"></div>
                            <div class="dot-side mt-1" id="dot-17"></div>
                            <div class="dot-side mt-1" id="dot-18"></div>
                            <div class="dot-side mt-1" id="dot-19"></div>
                            <div class="dot-side mt-1" id="dot-20"></div>
                            <div class="mt-1 dot-side" id="dot-21"></div>
                        </div>
                    @endif
                    <div class="box border-main ms-5 mt-3" id="box-main">
                        <div class="d-flex justify-content-center margin-label" id="sign">
                            <h1 class="text-white">READY</h1>
                        </div>
                    </div>
                    <div style="width: 50px"></div>
                    <div class="box border-main me-5 mt-3" style="background: black" id="box-color">
                        <div class="d-flex justify-content-center margin-label" id="color">
                            <h1 id="wrong" class="text-white d-none">WRONG</h1>
                        </div>
                    </div>
                    @if ($setting->obstacle == 'active')
                        <div style="text-align:center">
                            <div class="mt-1 dot-side" id="dot-22"></div>
                            <div class="mt-1 dot-side" id="dot-23"></div>
                            <div class="mt-1 dot-side" id="dot-24"></div>
                            <div class="mt-1 dot-side" id="dot-25"></div>
                            <div class="mt-1 dot-side" id="dot-26"></div>
                            <div class="mt-1 dot-side" id="dot-27"></div>
                        </div>
                    @endif
                </div>
                @if ($setting->obstacle == 'active')
                    <div style="text-align:center" class="mt-3">
                        <span class="dot" id="dot-28"></span>
                        <span class="dot" id="dot-29"></span>
                        <span class="dot" id="dot-30"></span>
                        <span class="dot" id="dot-31"></span>
                        <span class="dot" id="dot-32"></span>
                        <span class="dot" id="dot-33"></span>
                        <span class="dot" id="dot-34"></span>
                        <span class="dot" id="dot-35"></span>
                        <span class="dot" id="dot-36"></span>
                        <span class="dot" id="dot-37"></span>
                        <span class="dot" id="dot-38"></span>
                        <span class="dot" id="dot-39"></span>
                        <span class="dot" id="dot-40"></span>
                        <span class="dot" id="dot-41"></span>
                        <span class="dot" id="dot-42"></span>
                    </div>
                @endif
            </div>
            <div class="col-sm-12 d-none" id="content-color">
                <div class="d-flex justify-content-center mt-5">
                    <div class="box" accesskey="q" id="box-1">
                        <div class="d-flex justify-content-center margin-label" id="sign">
                            <h1 class="text-white">ALT + Q</h1>
                        </div>
                    </div>
                    <div class="space"></div>
                    <div class="d-none" id="second">
                        <div class="text-center">
                            <h1 class="text-white" id="result"></h1>
                            <button onclick="next()" class="btn btn-primary">Next <i
                                    class="fa-solid fa-forward"></i></button>
                        </div>
                    </div>
                    <div class="space"></div>
                    <div class="box" accesskey="w" id="box-2">
                        <div class="d-flex justify-content-center margin-label" id="sign">
                            <h1 class="text-white">ALT + W</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        var startTime, endTime;
        var colors1 = ["{{ $setting->colorOne }}"];
        var colors2 = ["{{ $setting->colorTwo }}"];
        let score = [];
        var attempt;

        function attempt(num) {
            attempt = num;
            $('#attempt').addClass('d-none');
            $('#first').addClass('d-none');
            $('#countAttempt').removeClass('d-none');
            $('#total-attempt').text(attempt);
            start();
        }

        function start() {
            var color1 = colors1[Math.floor(Math.random() * colors1.length)];
            var color2 = colors2[Math.floor(Math.random() * colors2.length)];

            var rand = Math.floor(Math.random() * 2);
            if (rand == 0) {
                rand = color1;
            } else {
                rand = color2;
            }
            $('#box-color').css('background', "black");
            $('#box-main').css('background', '#000000');
            $('#box-1').css('background', color1);
            $('#box-2').css('background', color2);

            $('#leaderboard').removeClass('d-none');
            $('#content').removeClass('d-none');
            $('#content-color').removeClass('d-none');

            var time = Math.floor(Math.random() * 3) + 1;
            setTimeout(function() {
                $('#sign').addClass('d-none');
                $('#box-main').css('background', rand);
                $('#box-1').attr('onclick', "end('" + color1 + "','" + rand + "')");
                $('#box-2').attr('onclick', "end('" + color2 + "','" + rand + "')");
                startTime = new Date();
            }, time * 1000);
        };

        function guide() {
            $('#guide').removeClass('d-none');
            $('#first').addClass('d-none');
        }

        function back() {
            $('#guide').addClass('d-none');
            $('#first').removeClass('d-none');
        }


        function end(hex, answer) {

            if (hex !== answer) {
                $('#wrong').removeClass('d-none');
            } else {
                endTime = new Date();
                var timeDiff = endTime - startTime; //in ms
                timeDiff = timeDiff.toLocaleString('en-US');;

                score.push(timeDiff.replace(',', ''));
                $('#wrong').addClass('d-none');
                if (score.length == attempt) {
                    var total = 0;
                    score.forEach(element => {
                        total += parseInt(element);
                    });
                    saveProgress();

                } else {
                    $('#box-color').css('background', answer);
                    $('#result').text(timeDiff + ' ms');
                    $('#box-1').removeAttr('onclick');
                    $('#box-2').removeAttr('onclick');
                    $('#second').removeClass('d-none');
                }
            }
        }

        function next() {
            $('#countdown').text((parseInt($('#countdown').text()) + 1));

            $('#third').addClass('d-none');
            $('#second').addClass('d-none');
            $('#box-1').removeAttr('onclick');
            $('#box-2').removeAttr('onclick');
            start();
        }

        function reload() {
            location.reload();
        }

        function logout() {
            window.location.href = "{{ asset('logout') }}";
        }

        function saveProgress() {
            $.ajax({
                type: "post",
                url: "{{ asset('api/score') }}",
                data: {
                    'score': score,
                    'user_id': $("#user_id").val(),
                },
                success: function(data) {
                    reload();
                },
            });
        }

        var i = 0;
        var a = 1;

        function change() {
            var color = ["{{ $setting->colorOne }}", "{{ $setting->colorTwo }}"];
            for (let num = 0; num < 42; num++) {
                if (num % 2 == 1) {
                    $("#dot-" + (num + 1)).css('background', color[a]);
                } else {
                    $("#dot-" + (num + 1)).css('background', color[i]);
                }
            }
            i = (i + 1) % color.length;
            a = (a + 1) % color.length;
        }
        setInterval(change, 1000);
    </script>

</body>

</html>
