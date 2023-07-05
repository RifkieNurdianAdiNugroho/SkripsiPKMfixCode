@extends('layouts.dashboard.header')
@section('content')
    <div class="content d-flex flex-column" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                    data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                    class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Dashboard</h1>
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ url('home') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-dark">Dashboard</li>
                    </ul>
                </div>
            </div>
        </div>

        <!--begin::Post-->
        <div class="post d-flex" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Row-->
                
                <p align="center" style="font-size: 20px;font-weight: bold;">Rekaptulasi Data Umum</p>
                    <div class="row gy-5 g-xl-8">
                        <div class="col bg-primary px-6 py-8 rounded-2 me-3 mb-7">
                            <div class="row">
                                <div class="col-6">
                                    <span class="svg-icon svg-icon-3x svg-icon-white d-block mt-5 mb-2">
                                        <i class="fa fa-heartbeat fs-1 text-white"></i>
                                    </span>
                                    <a href="{{ url('/user/ahli_gizi') }}" class="text-white fw-bold fs-6">Ahli Gizi</a>
                                </div>
                                <div class="col-6 d-flex align-items-center">
                                    <h1 class="text-white">
                                        {{$data['ahli_gizi']}}
                                    </h1>
                                </div>
                            </div>
                        </div>
                        <div class="col bg-info px-6 py-8 rounded-2 me-3 mb-7">
                            <div class="row">
                                <div class="col-6">
                                    <span class="svg-icon svg-icon-3x svg-icon-white d-block mt-5 mb-2">
                                        <i class="fa fa-stethoscope fs-1 text-white"></i>
                                    </span>
                                    <a href="/user/bidan" class="text-white fw-bold fs-6">Bidan</a>
                                </div>
                                <div class="col-6 d-flex align-items-center">
                                    <h1 class="text-white">{{$data['bidan']}}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col bg-warning px-6 py-8 rounded-2 me-3 mb-7">
                            <div class="row">
                                <div class="col-6">
                                    <span class="svg-icon svg-icon-3x svg-icon-white d-block mt-5 mb-2">
                                        <i class="fa fa-user-md fs-1 text-white"></i>
                                    </span>
                                    <a href="/user/kapus" class="text-white fw-bold fs-6">Kepala Puskesmas</a>
                                </div>
                                <div class="col-6 d-flex align-items-center">
                                    <h1 class="text-white">
                                        {{$data['kapus']}}
                                    </h1>
                                </div>
                            </div>
                        </div>
                        <div class="col bg-danger px-6 py-8 rounded-2 me-3 mb-7">
                            <div class="row">
                                <div class="col-6">
                                    <span class="svg-icon svg-icon-3x svg-icon-white d-block mt-5 mb-2">
                                        <i class="fas fa-baby fs-1 text-white"></i>
                                    </span>
                                    <a href="/data/balita" class="text-white fw-bold fs-6">Balita</a>
                                </div>
                                <div class="col-6 d-flex align-items-center">
                                    <h1 class="text-white">{{$data['balita']}}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col bg-success px-6 py-8 rounded-2 me-3 mb-7">
                            <div class="row">
                                <div class="col-6">
                                    <span class="svg-icon svg-icon-3x svg-icon-white d-block mt-5 mb-2">
                                        <i class="fa fa-medkit fs-1 text-white"></i>
                                    </span>
                                    <a href="/data/posyandu" class="text-white fw-bold fs-6">Posyandu</a>
                                </div>
                                <div class="col-6 d-flex align-items-center">
                                    <h1 class="text-white">{{$data['pos']}}</h1>
                                </div>
                            </div>
                        </div>

                    </div>
                     <form action="{{url('home')}}">
                    @if(Auth::user()->role == 'bidan')
                                    <select class="form-control form-control-solid" name="bidan_id">
                                        @foreach($data['dataBidan'] as $bidanKey => $bidanIitem)
                                        <option value="{{$bidanIitem->id}}" 
                                                {{$request->bidan_id == $bidanIitem->id ? 'selected':''}}>
                                            {{$bidanIitem->nama}}
                                        </option>
                                        @endforeach
                                    </select>
                                    @else
                                     <select class="form-control form-control-solid" 
                                             name="bidan_id" id="bidan_id" onchange="getPosyandu(this.value)" required>
                                        <option value="" selected disabled>
                                            Pilih Bidan
                                        </option>
                                        @foreach($data['dataBidan'] as $bidanKey => $bidanItem)
                                        <option value="{{$bidanItem->id}}" 
                                                {{$request->bidan_id == $bidanItem->id ? 'selected':''}}>
                                            {{$bidanItem->nama}}
                                        </option>
                                        @endforeach
                                    </select>
                                    @endif
                                    &nbsp;
                                    @if(Auth::user()->role == 'ahli_gizi' || Auth::user()->role == 'kapus')
                                    <select class="form-control form-control-solid" name="pos_id" id="pos_id" required>
                                     @if($request->bidan_id != null)
                                        <option value="" selected disabled>
                                            Pilih Pos
                                        </option>
                                        @foreach($data['posyandu'] as $posyanduKey => $posyanduItem)
                                        <option value="{{$posyanduItem->id}}" 
                                                {{$request->pos_id == $posyanduItem->id ? 'selected':''}}>
                                            {{$posyanduItem->nama_pos}}
                                        </option>
                                        @endforeach
                                        @else
                                         <option value="" selected disabled>
                                            <small>(Pos) Pilih Bidan Terlebih Dahulu</small>
                                        </option>
                                        @endif
                                    </select>
                                    @else
                                     <select class="form-control form-control-solid" name="pos_id" required>
                                        <option value="" selected disabled>
                                            Pilih Pos
                                        </option>
                                        @foreach($data['posyandu'] as $posyanduKey => $posyanduItem)
                                        <option value="{{$posyanduItem->id}}" 
                                                {{$request->pos_id == $posyanduItem->id ? 'selected':''}}>
                                            {{$posyanduItem->nama_pos}}
                                        </option>
                                        @endforeach
                                    </select>
                                    @endif
                                    <br>
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </form>
                @if($data['balita_l'] > 0 || $data['balita_p'] > 0)
                <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                @else
                <p align="center">Data balita kosong</p>
                @endif
                <br>
                <form action="{{url('home')}}">
                    @if(Auth::user()->role == 'bidan')
                                    <select class="form-control form-control-solid" name="gizi_bidan_id">
                                        @foreach($data['dataBidan'] as $bidanKey => $bidanIitem)
                                        <option value="{{$bidanIitem->id}}" 
                                                {{$request->bidan_id == $bidanIitem->id ? 'selected':''}}>
                                            {{$bidanIitem->nama}}
                                        </option>
                                        @endforeach
                                    </select>
                                    @else
                                     <select class="form-control form-control-solid" 
                                             name="gizi_bidan_id" id="gizi_bidan_id" onchange="getPosyandu2(this.value)" required>
                                        <option value="" selected disabled>
                                            Pilih Bidan
                                        </option>
                                        @foreach($data['dataBidan'] as $bidanKey => $bidanItem)
                                        <option value="{{$bidanItem->id}}" 
                                                {{$request->bidan_id == $bidanItem->id ? 'selected':''}}>
                                            {{$bidanItem->nama}}
                                        </option>
                                        @endforeach
                                    </select>
                                    @endif
                                    &nbsp;
                                    @if(Auth::user()->role == 'ahli_gizi' || Auth::user()->role == 'kapus')
                                    <select class="form-control form-control-solid" name="gizi_pos_id" id="gizi_pos_id" required>
                                     @if($request->bidan_id != null)
                                        <option value="" selected disabled>
                                            Pilih Pos
                                        </option>
                                        @foreach($data['posyandu'] as $posyanduKey => $posyanduItem)
                                        <option value="{{$posyanduItem->id}}" 
                                                {{$request->pos_id == $posyanduItem->id ? 'selected':''}}>
                                            {{$posyanduItem->nama_pos}}
                                        </option>
                                        @endforeach
                                        @else
                                         <option value="" selected disabled>
                                            <small>(Pos) Pilih Bidan Terlebih Dahulu</small>
                                        </option>
                                        @endif
                                    </select>
                                    @else
                                     <select class="form-control form-control-solid" name="gizi_pos_id" required>
                                        <option value="" selected disabled>
                                            Pilih Pos
                                        </option>
                                        @foreach($data['posyandu'] as $posyanduKey => $posyanduItem)
                                        <option value="{{$posyanduItem->id}}" 
                                                {{$request->pos_id == $posyanduItem->id ? 'selected':''}}>
                                            {{$posyanduItem->nama_pos}}
                                        </option>
                                        @endforeach
                                    </select>
                                    @endif
                                    <br>
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </form>
                @if($data['gizi_buruk'] > 0 || $data['gizi_kurang'] > 0 || $data['gizi_sedang'] > 0 || $data['gizi_baik'] > 0 || $data['gizi_lebih'] > 0) 
                <div id="chartContainer1" style="height: 300px; width: 100%;"></div>
                @else
                <p align="center">Data status gizi balita kosong</p>
                @endif
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
@endsection
@section('scriptcustom')
    <script src="https://use.fontawesome.com/f2fc9ac3b2.js"></script>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    <script>
window.onload = function() {

var chart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,
    title: {
        text: "Data Balita {{$data['dataFilterBalita']}}"
    },
    data: [{
        type: "pie",
        startAngle: 240,
        //yValueFormatString: "##0.00\"%\"",
        indexLabel: "{label} {y}",
        dataPoints: [
            {y: '{{$data['balita_l']}}', label: "Laki-Laki"},
            {y: '{{$data['balita_p']}}', label: "Perempuan"}
            // {y: 7.06, label: "Baidu"},
            // {y: 4.91, label: "Yahoo"},
            // {y: 1.26, label: "Others"}
        ]
    }]
});
chart.render();


var chart1 = new CanvasJS.Chart("chartContainer1", {
    animationEnabled: true,
    
    title:{
        text:"Data Status Gizi Balita {{$data['dataFilterBalita']}}"
    },
    axisX:{
        interval: 1
    },
    axisY2:{
        interlacedColor: "rgba(1,77,101,.2)",
        gridColor: "rgba(1,77,101,.1)",
        title: "Banyak Status Gizi"
    },
    data: [{
        type: "bar",
        name: "companies",
        axisYType: "secondary",
        color: "#014D65",
        dataPoints: [
            { y: {{$data['gizi_buruk']}}, label: "Gizi Buruk" },
            { y: {{$data['gizi_kurang']}}, label: "Gizi Kurang" },
            { y: {{$data['gizi_sedang']}}, label: "Gizi Sedang" },
            { y: {{$data['gizi_baik']}}, label: "Gizi Baik" },
            { y: {{$data['gizi_lebih']}}, label: "Gizi Lebih" }
        ]
    }]
});
chart1.render();
}

function getPosyandu(val) {
        $.ajax({
                type: 'get',
                url: "{{url('/user/bidan/posyandu')}}"+"/"+ val,
                dataType: 'json',
                success: function (data) {
                    var temp = [];
                    $.each(data, function (key, value) {
                        temp.push({
                            v: value,
                            k: key
                        });
                    });

                    var x = document.getElementById("pos_id");
                    $('#pos_id').empty();
                    var opt_head = document.createElement('option');
                    opt_head.text = 'Pilih Pos';
                    opt_head.value = '';
                    opt_head.disabled = true;
                    opt_head.selected = true;
                    x.appendChild(opt_head);
                    for (var i = 0; i < temp[0].v.length; i++) {
                        var opt = document.createElement('option');
                        opt.value = temp[0].v[i].id;
                        opt.text = temp[0].v[i].nama_pos;
                        x.appendChild(opt);
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
       }
    function getPosyandu2(val) {
        $.ajax({
                type: 'get',
                url: "{{url('/user/bidan/posyandu')}}"+"/"+ val,
                dataType: 'json',
                success: function (data) {
                    var temp = [];
                    $.each(data, function (key, value) {
                        temp.push({
                            v: value,
                            k: key
                        });
                    });

                    var x = document.getElementById("gizi_pos_id");
                    $('#gizi_pos_id').empty();
                    var opt_head = document.createElement('option');
                    opt_head.text = 'Pilih Pos';
                    opt_head.value = '';
                    opt_head.disabled = true;
                    opt_head.selected = true;
                    x.appendChild(opt_head);
                    for (var i = 0; i < temp[0].v.length; i++) {
                        var opt = document.createElement('option');
                        opt.value = temp[0].v[i].id;
                        opt.text = temp[0].v[i].nama_pos;
                        x.appendChild(opt);
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
       }
</script>
@endsection