                        <table >
                            <tr>
                                <th colspan="2" rowspan="2" style="padding-top: 6%">No</th>
                                <th colspan="2" rowspan="2" style="padding-top: 6%">Nama Pos</th>
                                <th colspan="2" rowspan="2" style="padding-top: 6%">Nama Bidan</th>
                                <th colspan="2" rowspan="2" style="padding-top: 6%">Nama Anak</th>
                                <th colspan="2" rowspan="2" style="padding-top: 6%">Jenis Kelamin</th>
                                <th colspan="2" rowspan="2" style="padding-top: 6%">Nama Ortu</th>
                                @if(isset($data['bulan']))
                                @foreach($data['bulan'] as $bulanKey => $bulanItem)
                                <th colspan="6" style="text-align: center;">
                                    {{$bulanItem}} {{$data['tahun'][$bulanKey]}}
                                </th>
                                @endforeach
                                
                                @endif
                               
                            </tr>
                            
                            <tr>
                                @if(isset($data['bulan']))
                                    @foreach($data['bulan'] as $bulanKey => $bulanItem)
                                    <th colspan="2" style="text-align: center;padding-bottom: 2%;">Umur</th>
                                    <th colspan="2" style="text-align: center;padding-bottom: 2%;">TB</th>
                                    <th colspan="2" style="text-align: center;padding-bottom: 2%;">BB</th>
                                    <th colspan="2" style="text-align: center;padding-bottom: 2%;">Status Gizi</th>
                                   
                                    @endforeach
                                @endif
                            </tr>
                                @if(isset($data['balita']))
                                @foreach($data['balita'] as $balitaKey => $balitaItem)
                                <tr>  
                                   <td colspan="2">
                                        {{$balitaKey+1}}
                                    </td>  
                                    <td colspan="2">
                                        {{$balitaItem['pos']}}
                                    </td>
                                    <td colspan="2">
                                        {{$balitaItem['bidan']}}
                                    </td>
                                    <td colspan="2">
                                        {{$balitaItem['nama']}}
                                    </td>
                                    <td colspan="2">
                                        {{$balitaItem['jenis_kelamin']}}
                                    </td>
                                    <td colspan="2">{{$balitaItem['ortu']}}</td>
                                     @foreach($data['bulan'] as $bulanKeyOne => $bulanItemOne)
                                    <td colspan="2">
                                      {{$data['hasil'][$data['jadwal'][$bulanKeyOne]['jadwal_id']][$balitaKey]['umur']}}
                                    </td>
                                    @if($data['hasil'][$data['jadwal'][$bulanKeyOne]['jadwal_id']][$balitaKey]['umur'] >= 60)
                                    <td colspan="2" style="background-color: red;">
                                    {{$data['hasil'][$data['jadwal'][$bulanKeyOne]['jadwal_id']][$balitaKey]['tb']}}
                                    </td>
                                    <td colspan="2" style="background-color: red;">
                                      {{$data['hasil'][$data['jadwal'][$bulanKeyOne]['jadwal_id']][$balitaKey]['bb']}}
                                    </td>
                                    @else
                                     <td colspan="2" style="background-color: ;">
                                    {{$data['hasil'][$data['jadwal'][$bulanKeyOne]['jadwal_id']][$balitaKey]['tb']}}
                                    </td>
                                    <td colspan="2" style="background-color: ;">
                                      {{$data['hasil'][$data['jadwal'][$bulanKeyOne]['jadwal_id']][$balitaKey]['bb']}}
                                    </td>
                                    @endif
                                    <td colspan="2">
                                        {{$data['hasil'][$data['jadwal'][$bulanKeyOne]['jadwal_id']][$balitaKey]['status_gizi']}}
                                    </td>
                                    @endforeach
                                </tr>
                                @endforeach
                                @endif
                        </table>

