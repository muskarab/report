<div class="p2">
        <div class="row mt-3">
            <div class="input-group md-6">
                <span class="input-group-text" id="basic-addon2">Tempat Pertemuan</span>
                <input type="text" class="form-control" placeholder="Tempat Pertemuan" aria-label="Recipient's username" aria-describedby="basic-addon2" id="tempat" name="tempat">
            </div>
        </div>
        <div class="row mt-3">
            <div class="input-group mb-3">
                <label class="input-group-text" for="cabang">Cabang dikunjungi</label>
                <select class="form-select" id="cabang" name="cabang">
                    @foreach ($cabangs as $cabang)
                    <option value="{{ $cabang->id }}">{{ $cabang->nama }}</option> 
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <label for="" class="col-form-label">Bertemu dengan</label>
        </div>
        <div class="row">
            <div class="col-md-6">
                <small id="rceo_label" class="text_info form-text">
                    Nama Pejabat
                </small>
                <div class="input-group mb-3">
                    <button class="btn btn-outline-dark" type="button" id="button-rceo">RCEO</button>
                    <input type="text" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" id="rceo" name="rceo">
                </div>
            </div>
            <div class="col-md-6">
                <small id="am_label" class="text_info form-text">
                    Nama Pejabat
                </small>
                <div class="input-group mb-3">
                    <button class="btn btn-outline-dark" type="button" id="button-addon1">AM</button>
                    <input type="text" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" id="am" name="am">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <small id="acfm_label" class="text_info form-text">
                    Nama Pejabat
                </small>
                <div class="input-group mb-3">
                    <button class="btn btn-outline-dark" type="button" id="button-addon1">ACFM</button>
                    <input type="text" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" id="acfm" name="acfm">
                </div>
            </div>
            <div class="col-md-6">
                <small id="bm_label" class="text_info form-text">
                    Nama Pejabat
                </small>
                <div class="input-group mb-3">
                    <button class="btn btn-outline-dark" type="button" id="button-addon1">BM</button>
                    <input type="text" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" id="bm" name="bm">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <small id="crbmcbs_label" class="text_info form-text">
                    Nama Pejabat
                </small>
                <div class="input-group mb-3">
                    <button class="btn btn-outline-dark" type="button" id="button-addon1">CBRM/CBS</button>
                    <input type="text" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" id="crbmcbs" name="crbmcbs">
                </div>
            </div>
            <div class="col-md-6">
                <small id="lainlain_label" class="text_info form-text">
                    Jabatan lain yang ditemui
                </small>
                <div class="input-group mb-3">
                    <button class="btn btn-outline-dark" type="button" id="button-addon1">Lain</button>
                    <input type="text" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" id="lainlain" name="lainlain">
                </div>
            </div>
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
                <select class="form-select" id="topik0" name="topik0" required>
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
                <textarea class="form-control" id="pembahasan0" name="pembahasan0" rows="3"></textarea>
            </div>
        </div>
    <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="row mt-3">
            <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupFile01">Upload Gambar</label>
                <input type="file" class="form-control" id="image" name="image" required onkeyup="cek_image()" accept="image/png, image/gif, image/jpeg">
            </div>
        </div>
        <button class="btn btn-outline-primary btn_image_store"  type="submit" hidden>Simpan</button>
    </form>
        <hr>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" onclick="clear_input()">Kembali</button>
            <button class="btn btn-outline-primary" id="btn_simpan" onclick="store()">Simpan</button>
        </div>
</div>