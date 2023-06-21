<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Harga</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($barangs as $b)
            <tr>
                <td>{{ $b->id }}</td>
                <td>{{ $b->nama }}</td>
                <td><input type="number"></td>
                <td>
                    <a class='btn btn-xs btn-warning' href="{{route('barang.edit', $b->id)}}">+ Edit</a>
                </td>

            </tr>
        @endforeach
    </tbody>
</table>
