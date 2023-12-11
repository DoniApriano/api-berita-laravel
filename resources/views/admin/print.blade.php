<h3>
    <center>Laporan Data User</center>
</h3>
<table border="1" cellspacing="0" cellpadding="5">
    <tr>
        <th>Nama Satri</th>
    </tr>
    @foreach ($users as $s)
        <tr>
            <td>{{ $s->email }}</td>
        </tr>
    @endforeach
</table>
