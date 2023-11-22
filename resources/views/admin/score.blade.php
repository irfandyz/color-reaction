@extends('admin.template')
@section('style')
<style>
    
    .box-score {
        height: 480px;
    }
    
</style>
@endsection
@section('content')
<div class="container">
  <div class="d-flex justify-content-between">
    <div>
      <h3>{{ $userSelect->name }}</h3>
    </div>
    <div>
       <a class="btn btn-primary" href="{{ asset('admin/export'.'/'.$userSelect->id) }}"><i class="fas fa-file-export"></i> Export</a>
    </div>
  </div>
    <div class="row">
        <div class="col-sm-8 mt-4">
            <table class="fw-bold" style="font-size:14px">
                <tr>
                    <td>Username</td>
                    <td>: {{ $userSelect->username }}</td>
                </tr>
                <tr>
                    <td>Rata - rata</td>
                    <td>: {{$averageFinal['average']}}ms ({{ $averageFinal['index'] }})</td>
                </tr>
                <tr>
                    <td>Total Permainan</td>
                    <td>: {{ count($result) }} permainan</td>
                </tr>
                <tr>
                    <td>Total Permainan (Keseluruhan)</td>
                    <td>: {{ $count }} permainan</td>
                </tr>
            </table>
            <div>
                <canvas class="mt-5" id="myChart"></canvas>
              </div>
              <script>
                var data = [];
              </script>
              @foreach ($average as $item)
                  <script>
                    data.push("{{$item}}");
                  </script>
              @endforeach
              <script>
                const ctx = document.getElementById('myChart');
                var count = [];
                for (let i = 0; i < data.length; i++) {
                    count.push("Game "+(i+1));                    
                }
                new Chart(ctx, {
                  type: 'line',
                  data: {
                    labels: count,
                    datasets: [{
                      label: 'Score',
                      data: data,
                      borderWidth: 1
                    }]
                  },
                  options: {
                    scales: {
                      y: {
                        beginAtZero: true
                      }
                    }
                  }
                });
              </script>
        </div>
        <div class="col-sm-4">
            <ul class="list-group box-score">
                @foreach ($result as $data)
                <li class="list-group-item">
                    <p>{{ $loop->iteration }}. Average : {{ $data->average }}ms <br>({{ $data->indexAverage }}) <br><span class="text-success">{{ date('d-m-Y H:i',strtotime($data->created_at)) }}</span></p>
                    <ul class="mb-3">
                        @foreach ($data->score as $key)
                        <li>Attempt {{ $loop->iteration }} : {{ intval($key) }}ms </li>
                        @endforeach
                    </ul>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection