@extends('layouts.admin')
@section('content')
        <div class="row">
            <div class="col-lg-12">
                <div class="map-container">
                    <div id="customTip" class="jvectormap-tip"></div>
                    <div id="vmap" style="width: 800px; height: 600px"></div>
                </div>
                <div id="dboard" class="dash">
                    <div id="chart"></div>
                </div>

            </div>

        </div>

        <script>
            var chart = c3.generate({
                data: {
                    x: 'x',
                    columns: [
                        ['x', {!! $barras['columns'] !!}],
                        ['Anotados', {!! $barras['anotados'] !!}],
                        ['Confirmados', {!! $barras['confirmados'] !!}],
                        ['Presentes', {!! $barras['presentes'] !!}]
                    ],
                    type: 'bar'
                },
                axis: {
                    x: {
                        type: 'category' // this needed to load string x value
                    },
                    y: {
                        min: 0,
                        max: {!! $barras['meta'] !!},
                        label: {
                            text: 'Voluntarios'
                        }
                    }
                },
                grid: {
                    y: {
                        lines: [{value: {!! $barras['meta'] !!}, text: 'Meta'}]
                    }
                }
            });


            var data = {
                "AR-A": {!! $mapa ["Salta"]!!},
                "AR-N": {!! $mapa ["Misiones"]!!},
                "AR-X": {!! $mapa ["CordobaRio4"]!!},
                "AR-C": {!! $mapa ["BA"]!!},
                "AR-S": {!! $mapa ["SantaFeRosario"]!!},
                "AR-Q": {!! $mapa ["NeuquenRN"]!!},
                "AR-R": {!! $mapa ["NeuquenRN"]!!},
                "AR-H": {!! $mapa ["ChacoRrientes"]!!},
                "AR-W": {!! $mapa ["ChacoRrientes"]!!},
                "AR-T": {!! $mapa ["Tucuman"]!!}


            } // busco los voluntarios anotados por sede y las pongo aca. en el archivo del mapa estan los nombres de las provincias

            var sedesHabilitadas = Array('AR-S', 'AR-A', 'AR-N', 'AR-X', 'AR-C', 'AR-Q', 'AR-R', 'AR-H', 'AR-W', 'AR-T');
            jQuery('#vmap').vectorMap({
                map: 'argentina_en',
                backgroundColor: '#95CAE4',
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#CC3333',
                enableZoom: true,
                showTooltip: true,
                values: data,
                scaleColors: ['#60FDFD', '#00B6B6'],
                normalizeFunction: 'polynomial',
                onLabelShow: function (element, label, code) {
                    if (jQuery.inArray(code, sedesHabilitadas) != -1) {
                        label.text(label.text() + ' - ' + data[code]);
                    }
                },
                onRegionClick: function (event, code, region) {
                    var customTip = $('#customTip');
                    customTip.show();
                    if (jQuery.inArray(code, sedesHabilitadas) != -1) {
                        customTip.html(region + ' - ' + data[code]);
                    } else {
                        customTip.html('');
                    }
                }
            });
        </script>
@stop