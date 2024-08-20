<table class="table">
    <thead>
        <tr>
            <th>Mata Kuliah</th>
            <th>Nilai</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($krsList as $krs)
            <tr>
                <td>{{ $krs->mataKuliah->nama_mk }}</td>
                <td>
                    <input type="number" class="form-control" name="nilai[{{ $krs->mataKuliah->id }}]" value="{{ $krs->nilai ?? '' }}" min="0" max="100">
                </td>
            </tr>
        @endforeach
    </tbody>
</table>