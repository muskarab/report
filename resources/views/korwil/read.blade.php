<table class="table">
<tr>
    <th>No</th>
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
        <td>{{ $item->cair }}</td>
        <td>{{ $item->tempat }}</td>
        <td>{{ $item->cabang->nama }}</td>
        <td>@if ($item->rceo)
            {{ $item->rceo }} (RCEO)
            @endif
            @if ($item->am)
            , {{ $item->am }} (AM)
            @endif
            @if ($item->acfm)
            , {{ $item->acfm }} (ACFM)
            @endif
            @if ($item->bm)
            , {{ $item->bm }} (BM)
            @endif
            @if ($item->crbmcbs)
            , {{ $item->crbmcbs }} (CRBMCBS)
            @endif
            @if ($item->lain)
            , {{ $item->lain }} (Lain)
            @endif
        </td>
        @php
            $topiks = explode((","), $item->topik);
            $pembahasans = explode((","), $item->pembahasan);
            // print_r($pembahasans);
        @endphp
        <td>
            @foreach ($topiks as $topik)
                <p>{{ $topik }}</p>
            @endforeach
        </td>
        <td>
            @foreach ($pembahasans as $pembahasan)
                <p>{{ $pembahasan }}</p>
            @endforeach
        </td>
        <td>
            <button class="btn btn-outline-warning btn-sm" onclick="show({{ $item->id }})">Edit</button>
            <button class="btn btn-outline-danger btn-sm" onclick="destroy({{ $item->id }})">Delete</button>
        </td>
    </tr>
    @endforeach
</table>