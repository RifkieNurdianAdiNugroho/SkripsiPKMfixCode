<table c>
                            <thead>
                                <tr >
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Jabatan</th>
                                    <th>No Telepon</th>
                                    <th>Alamat</th>
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
                                        <td><small>{{$item->alamat}}</small></td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>