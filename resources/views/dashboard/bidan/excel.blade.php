<table>
                            <thead>
                                <tr >
                                    <th>No</th>
                                    <th >Nama</th>
                                    <th >Email</th>
                                    <th >Jabatan</th>
                                    <th >No Telepon</th>
                                    <th >Rumah</th>
                                    <th >Polindes</th>
                                </tr>
                            </thead>
                            <tbody >
                                @foreach ($data as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{$item->jabatan_fungsional}}</td>
                                        <td>{{$item->no_tlp}}</td>
                                        <td>
                                            <small><b>Rumah</b> : {{$item->alamat}}</small>
                                        </td>
                                        <td>
                                            <small><b>Polindes</b> : {{$item->polindes}}</small>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>