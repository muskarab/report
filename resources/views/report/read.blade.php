<table class="table">
<tr>
    <th>No</th>
    @if (Auth::user()->role->name == 'admin')
    <th>Nama</th>
    @endif
    <th>Cair</th>
    <th>Tempat</th>
    <th>Cabang</th>
    <th>Pejabat</th>
    <th>Topik</th>
    <th>Pembahasan</th>
    <th>Action</th>
</tr>
@foreach ($data as $item)
    <tr>
        <td>{{ ++$i }}</td>
        @if (Auth::user()->role->name == 'admin')
        <td>{{ $item->user->name }}</td>
        @endif
        <td>{{ $item->cair }}</td>
        <td>{{ $item->tempat }}</td>
        <td>{{ $item->cabang->nama }}</td>
        <td>@if ($item->rceo)
            {{ $item->rceo }} (RCEO)
            @endif
            @if ($item->am)
            {{ $item->am }} (AM)
            @endif
            @if ($item->acfm)
            {{ $item->acfm }} (ACFM)
            @endif
            @if ($item->bm)
            {{ $item->bm }} (BM)
            @endif
            @if ($item->crbmcbs)
            {{ $item->crbmcbs }} (CRBMCBS)
            @endif
            @if ($item->lain)
            {{ $item->lain }} (Lain)
            @endif
        </td>
        @php
            $topiks = explode((","), $item->topik);
            $pembahasans = explode((","), $item->pembahasan);
            // print_r($pembahasans);
            $j = 0;
            $k = 0;
        @endphp
        <td>
            @foreach ($topiks as $topik)
                <p>{{ ++$j . '. ' }}{{ $topik }}</p>
            @endforeach
        </td>
        <td>
            @foreach ($pembahasans as $pembahasan)
                <p>{{ ++$k . '. ' }}{{ $pembahasan }}</p>
            @endforeach
        </td>
        <td>
            <button class="btn btn-outline-warning btn-sm" onclick="show({{ $item->id }})">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                </svg>
            </button>
            <p></p>
            <button class="btn btn-outline-danger btn-sm" onclick="destroy({{ $item->id }})">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                </svg>
            </button>
        </td>
    </tr>
    @endforeach
</table>