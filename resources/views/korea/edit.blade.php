<div class="p2">
    <div class="row mt-3">
        <div class="col-md-6">
            <label for="" class="col-form-label">Cabang dikunjungi</label>
        </div>
        <div class="col-md-6">
            <select class="form-select" name="cabang" id="cabang">
            {{-- <option id="cabang_select" selected>Pilih KC</option> --}}
            @foreach ($cabangs as $cabang)
                @if ($cabang->nama == $data->cabang)
                <option value="{{ $cabang->nama }}" selected>{{ $cabang->nama }}</option> 
                @endif
                <option value="{{ $cabang->nama }}">{{ $cabang->nama }}</option> 
            @endforeach
            </select>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-6">
            <label for="" class="col-form-label">Bertemu dengan</label>
        </div>
    </div>
    {{-- <div class="d-grid gap-2">
        <button type="button" class="btn btn-outline-dark"  onclick="showfieldRCEO()">RCEO</button>
        <input type="text" class="form-control-dark mt-3 field_rceo" style="display:none;" id="rceo" name="rceo">
    </div> --}}
    <div class="input-group mb-3">
        <button class="btn btn-outline-dark" type="button" id="button-addon1" onclick="showfieldRCEO()">RCEO</button>
        <input type="text" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" style="display:none;" id="rceo" name="rceo" value="{{ $data->rceo }}">
    </div>
    {{-- <div class="d-grid gap-2">
        <button type="button" class="btn btn-outline-dark"  onclick="showfieldAM()">AM</button>
        <input type="text" class="form-control-dark mt-3 field_am" style="display:none;" id="am" name="am">
    </div> --}}
    <div class="input-group mb-3">
        <button class="btn btn-outline-dark" type="button" id="button-addon1" onclick="showfieldAM()">AM</button>
        <input type="text" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" style="display:none;" id="am" name="am" value="{{ $data->am }}">
    </div>
    {{-- <div class="d-grid gap-2">
        <button type="button" class="btn btn-outline-dark"  onclick="showfieldACFM()">ACFM</button>
        <input type="text" class="form-control-dark mt-3 field_am" style="display:none;" id="acfm" name="acfm">
    </div> --}}
    <div class="input-group mb-3">
        <button class="btn btn-outline-dark" type="button" id="button-addon1" onclick="showfieldACFM()">AM</button>
        <input type="text" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" style="display:none;" id="acfm" name="acfm" value="{{ $data->acfm }}">
    </div>
    {{-- <div class="d-grid gap-2">
        <button type="button" class="btn btn-outline-dark"  onclick="showfieldBM()">BM</button>
        <input type="text" class="form-control-dark mt-3 field_am" style="display:none;" id="bm" name="bm">
    </div> --}}
    <div class="input-group mb-3">
        <button class="btn btn-outline-dark" type="button" id="button-addon1" onclick="showfieldBM()">AM</button>
        <input type="text" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" style="display:none;" id="bm" name="bm" value="{{ $data->bm }}">
    </div>
    {{-- <div class="d-grid gap-2">
        <button type="button" class="btn btn-outline-dark"  onclick="showfieldCRBMCBS()">CBRM/CBS</button>
        <input type="text" class="form-control-dark mt-3 field_am" style="display:none;" id="crbmcbs" name="crbmcbs">
    </div> --}}
    <div class="input-group mb-3">
        <button class="btn btn-outline-dark" type="button" id="button-addon1" onclick="showfieldCRBMCBS()">AM</button>
        <input type="text" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" style="display:none;" id="crbmcbs" name="crbmcbs" value="{{ $data->crbmcbs }}">
    </div>
    {{-- <div class="d-grid gap-2">
        <button type="button" class="btn btn-outline-dark"  onclick="showfieldlainlain()">Lain-lain</button>
        <input type="text" class="form-control-dark mt-3 field_am" style="display:none;" id="lainlain" name="lainlain">
    </div> --}}
    <div class="input-group mb-3">
        <button class="btn btn-outline-dark" type="button" id="button-addon1" onclick="showfieldlainlain()">AM</button>
        <input type="text" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" style="display:none;" id="lainlain" name="lainlain" value="{{ $data->lainlain }}">
    </div>
    <div class="row mt-3">
        <div class="col md-6">
            <label for="" class="col-form-label">Topik Pembahasan</label>
        </div>
        <div class="col md-6">
            <button type="button" class="btn btn-outline-dark btn-sm" onclick="new_topik()">Tambah</button>
        </div>
    </div>
    <small id="topik_min" class="text_info form-text text-danger">
        *Harus diisi minimal 2 Topik
    </small>
    <div id="new_topik">
        <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupSelect01">Topik</label>
            <select class="form-select" id="topik" name="topik">
                <option selected>Pilih Topik</option>
                <option value="Pemenuhan SF">Pemenuhan SF</option>
                <option value="Target dan Pipeline bulan ini">Target dan Pipeline bulan ini</option>
                <option value="Proses SLA">Proses SLA</option>
                <option value="Strategy">Strategy</option>
                <option value="Root cause">Root cause</option>
                <option value="Evaluasi Kerja">Evaluasi Kerja</option>
                <option value="Support yang dibutuhkan">Support yang dibutuhkan</option>
                <option value="Activity SF">Activity SF</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Hasil Pembahasan</label>
            <textarea class="form-control" id="pembahasan" name="pembahasan" rows="3">{{ $data->pembahasan }}</textarea>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
        <button class="btn btn-outline-primary" onclick="update({{ $data->id }})">Save changes</button>
    </div>
    {{-- <div class="form-group">
        <label for="name">Product</label>
        <input type="text" name="name" id="name" placeholder="Name" class="form-control">
    </div>
    <div class="form-group mt-2">
        <button class="btn btn-success" onclick="store()">Create</button>
    </div> --}}
</div>