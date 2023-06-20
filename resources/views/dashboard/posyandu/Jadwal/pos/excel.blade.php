<table>
                            <thead>
                                <tr >
                                    <th>No</th>
                                    <th>Naman Pos</th>
                                    <th>Bidan</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody >
                                @foreach ($data as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->posyandu_name }}</td>
                                        <td>{{ $item->bidan_name }}</td>
                                        <td>{{ $item->tanggal }}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>