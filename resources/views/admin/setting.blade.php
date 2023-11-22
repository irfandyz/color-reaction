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
    <style>
        body {
            /* background: url("{{ asset('assets/bg.jpg') }}"); */
            background: {{\App\Models\Setting::first()->background}};
        }

        .min-h {
            min-height: 550px;
            border-radius: 20px;
        }

        input[type='radio']:checked+.check-label {
            background: #00319c
        }
    </style>
</head>

<body id="body">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <div class="container mt-4">
        <a href="{{ asset('admin') }}" class="btn btn-success"><i class="fas fa-star"></i> Scores</a>
        <a href="{{ asset('admin/setting') }}" class="btn btn-success"><i class="fas fa-cogs"></i> Settings</a>
        <a href="{{ asset('logout') }}" class="btn btn-danger"><i class="fas fa-sign-out"></i> Logout</a>
    </div>
    <div class="container bg-white min-h mt-4 p-4 ps-5">
        <form action="{{ asset('admin/saveSetting') }}" enctype="multipart/form-data" method="post">
            @csrf
            <h1>Settings</h1>
            <div class="row">
                <div class="col-sm-6">
                    <div class="mt-4">
                        <h5>Choose Active Attempt</h5>
                        <input name="attempt" type="radio" class="btn-check" id="btn-check-5" value="5"
                            {{ $setting->attempt == '5' ? 'checked' : '' }} autocomplete="off">
                        <label class="check-label btn btn-primary" for="btn-check-5">5 Attempt</label>

                        <input name="attempt" type="radio" class="btn-check" id="btn-check-10" value="10"
                            {{ $setting->attempt == '10' ? 'checked' : '' }} autocomplete="off">
                        <label class="check-label btn btn-primary" for="btn-check-10">10 Attempt</label>

                        <input name="attempt" type="radio" class="btn-check" id="btn-check-15" value="15"
                            {{ $setting->attempt == '15' ? 'checked' : '' }} autocomplete="off">
                        <label class="check-label btn btn-primary" for="btn-check-15">15 Attempt</label>

                        <input name="attempt" type="radio" class="btn-check" id="btn-check-20" value="20"
                            {{ $setting->attempt == '20' ? 'checked' : '' }} autocomplete="off">
                        <label class="check-label btn btn-primary" for="btn-check-20">20 Attempt</label>
                    </div>
                    <div class="mt-4">
                        <h5>Obstacle</h5>
                        <input name="obstacle" type="radio" class="btn-check" id="btn-check-active" value="active"
                            {{ $setting->obstacle == 'active' ? 'checked' : '' }} autocomplete="off">
                        <label class="check-label btn btn-primary" for="btn-check-active">Active</label>

                        <input name="obstacle" type="radio" class="btn-check" id="btn-check-deactive" value="deactive"
                            {{ $setting->obstacle == 'deactive' ? 'checked' : '' }} autocomplete="off">
                        <label class="check-label btn btn-primary" for="btn-check-deactive">Deactive</label>
                    </div>
                    <div class="mt-4">
                        <h5>Circle Color</h5>
                        <div class="row">
                            <div class="col-sm-2">Color 1 </div>
                            <div class="col-sm-9">
                                <input type="color" name="colorOne" value="{{ $setting->colorOne }}" id=""
                                    class="form-control">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-2">Color 2 </div>
                            <div class="col-sm-9">
                                <input type="color" name="colorTwo" value="{{ $setting->colorTwo }}" id=""
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h5>background Color</h5>
                        <div class="row">
                            <div class="col-sm-11">
                                <input type="color" name="background" value="{{ $setting->background }}"
                                    id="" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 border-start">
                    <div class="mt-4">
                        <h5>Audio File</h5>
                        <audio src="{{ asset('assets/' . $setting->audio) }}" id="audioPreview" class="w-100"
                            controls></audio>
                        <input name="audio" type="file" class="form-control"
                            onchange="PreviewAudio(this, $('#audioPreview'))">
                        @if ($errors->has('audio'))
                            <small class="text-danger">{{ $errors->first('audio') }}</small>
                        @endif
                    </div>
                    <div class="mt-4">
                        <h5>Audio Play</h5>
                        <input name="audioPlay" type="radio" class="btn-check" id="audioPlay" value="active"
                            {{ $setting->audioPlay == 'active' ? 'checked' : '' }} autocomplete="off">
                        <label class="check-label btn btn-primary" for="audioPlay">Active</label>

                        <input name="audioPlay" type="radio" class="btn-check" id="audioPlay-deactive"
                            value="deactive" {{ $setting->audioPlay == 'deactive' ? 'checked' : '' }} autocomplete="off">
                        <label class="check-label btn btn-primary" for="audioPlay-deactive">Deactive</label>
                    </div>
                </div>
                <div class="col-sm-12 text-end">
                    <div class="mt-5">
                        <button type="submit" class=" btn btn-success">Save Change</button>
                        <button type="submit" class=" btn btn-danger">Reset Change</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        function PreviewAudio(inputFile, previewElement) {

            if (inputFile.files && inputFile.files[0] && $(previewElement).length > 0) {

                $(previewElement).stop();

                var reader = new FileReader();

                reader.onload = function(e) {

                    $(previewElement).attr('src', e.target.result);
                    var playResult = $(previewElement).get(0).play();

                    if (playResult !== undefined) {
                        playResult.then(_ => {
                                // Automatic playback started!
                                // Show playing UI.

                                $(previewElement).show();
                            })
                            .catch(error => {
                                // Auto-play was prevented
                                // Show paused UI.

                            });
                    }
                };

                reader.readAsDataURL(inputFile.files[0]);
            } else {
                $(previewElement).attr('src', '');
                $(previewElement).hide();
                alert("File Not Selected");
            }
        }
    </script>

</body>

</html>
