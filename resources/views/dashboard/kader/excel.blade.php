<table>
                            <thead>
                                <tr >
                                    <th>No</th>
                                    <th >Nama</th>
                                    <th >No Telepon</th>
                                    <th >Alamat</th>
                                    <th >Pos</th>
                                </tr>
                            </thead>
                            <tbody >
                                @foreach ($data as $key => $item)
                                    <tr>
                                       <td>{{ $key + 1 }}</td>
                                        <td>{{$item->nama}}</td>
                                        <td>{{$item->no_tlp}}</td>
                                        <td>
                                            <small> {{$item->alamat}}</small>
                                        </td>
                                        <td>
                                            {{$item->nama_pos}}
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>