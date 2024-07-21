<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Kegiatan</th>
            <th>Instansi</th>
            <th>Tanggal</th>
            <th>Tempat</th>
            <th>Deskripsi</th>
            <th>Created By</th>
            <th>Jenis Kegiatan</th>
        </tr>
    </thead>
    <tbody>
        @foreach (@$kegiatan as $key => $value)
            <tr>
                <td>{{ @$value->id }}</td>
                <td>{{ @$value->name }}</td>
                <td>{{ @$value->Instansi->name }}</td>
                <td>{{ @$value->tanggal }}</td>
                <td>{{ @$value->tempat }}</td>
                <td>{{ @$value->deskripsi }}</td>
                <td>{{ @$value->User->name }}</td>
                <td>{{ @$value->jenis_kegiatan }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
