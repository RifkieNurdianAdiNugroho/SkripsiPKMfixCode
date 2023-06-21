<table>
                            <thead>
                                <tr >
                                    <th>No</th>
                                    <th>Naman</th>
                                    <th>Desa</th>
                                    <th>Alamat</th>
                                    <th>Bidan</th>
                                </tr>
                            </thead>
                            <tbody >
                                @foreach ($data as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->nama_pos }}</td>
                                        <td>{{ $item->desa }}</td>
                                        <td><small>{{$item->alamat}}</small></td>
                                        <td>
                                            @if(isset($bidanPos[$key]))
                                            <ul>
                                                @foreach($bidanPos[$key] as $bidanKey => $bidanItem)
                                                <li>
                                                    {{$bidanItem['nama']}}
                                                </li>
                                                @endforeach
                                            </ul>
                                            @else
                                            -
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>