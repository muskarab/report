<table class="table">
<tr>
    <th>Cair</th>
    <th>Tempat</th>
    <th>Cabang</th>
    <th>Pejabat</th>
    {{-- <th>RCEO</th>
    <th>AM</th>
    <th>ACFM</th>
    <th>BM</th>
    <th>CBRM/CBS</th>
    <th>Lain-lain</th> --}}
    <th>Topik</th>
    <th>Pembahasan</th>
    <th>Action</th>
</tr>
@foreach ($data as $item)
    <tr>
        <td>{{ $item->cair }}</td>
        <td>{{ $item->tempat }}</td>
        <td>{{ $item->cabang->nama }}</td>
        <td>{{ $item->rceo }}
            {{ $item->am }}
            {{ $item->acfm }}
            {{ $item->bm }}
            {{ $item->crbmcbs }}
            {{ $item->lain }}
        </td>
        @php
            $topiks = explode((","), $item->topik);
            $pembahasans = explode((","), $item->pembahasan);
            // print_r($pembahasans);
        @endphp
        <td>
            @foreach ($topiks as $topik)
                {{-- @php
                    echo ($topik);
                @endphp --}}
                <p>{{ $topik }}</p>
            @endforeach
        </td>
        {{-- <td>{{ $item->topik }}</td> --}}
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