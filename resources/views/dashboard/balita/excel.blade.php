<table >
                            <thead>
                                <tr >
                                    <th >No</th>
                                    <th >Nama</th>
                                    <th >Ortu</th>
                                    <th >Jenis Kelamin</th>
                                    <th >Tgl Lahir</th>
                                    <th >BB Lahir</th>
                                    <th >Panjang Lahir</th>
                                    <th >Gakin</th>
                                    <th >Anak Ke</th>
                                    <th >Alamat</th>
                                </tr>
                            </thead>
                            <tbody >
                                @foreach ($data as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{$item->nama}}</td>
                                        <td>{{$item->nama_ortu}}</td>
                                        <td>{{$item->jenis_kelamin}}</td>
                                        <td>{{$item->tgl_lahir}}</td>
                                        <td>{{$item->bb_lahir}}</td>
                                        <td>{{$item->pjg_lahir}}</td>
                                        <td>{{$item->gakin}}</td>
                                        <td>{{$item->anak_ke}}</td>
                                        <td>
                                            <small> {{$item->alamat}}</small>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>