@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="card text-black bg-light mb-3">
            <div class="card-body">
                <div class="alert alert-danger" role="alert" id="alert" style="display:none">
                    <li>Proyeksi cair bulan ini harap diisi</li>
                </div>
                <h5 class="card-title text-center">Activity Report {{ Str::upper(Auth::user()->role->name)  }}</h5>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <label for="" class="col-form-label">Proyeksi cair bulan ini</label>
                    </div>
                    <div class="col-md-4">
                        <input type="number" class="form-control" id="cair" name="cair">
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-outline-dark" onclick="create()">Tambah</button>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="" class="col-form-label">Daftar Aktifitas</label>
                    </div>
                </div>
                <div id="read" class="mt-3">
                    
                </div>
            </div>

        </div>

        <!-- Button trigger modal -->
        <!-- Modal -->
        <div class="modal fade" id="addreport" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titlemodal">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mt-3" id="form_cair_id" hidden="true">
                    <div class="col-md-12">
                        <label for="" class="col-form-label">Proyeksi cair bulan ini: Rp. <span id="tampil_cair"></span></label>
                    </div>
                </div>
                <div id="page" class="p-2">
                </div>
            </div>
            </div>
        </div>
        </div>
        
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        read()
        checkInput()
    });
    
    //Read
    function read() {
        document.getElementById("cair").value = "";
        $.get("{{ url('report/read') }}", {}, function(data, status){
            $("#read").html(data);
        });
    }
    
    //Create
    function create() {
        checkInput()
         $('#form_cair_id').removeAttr("hidden");
        var cair = $("#cair").val();
        // console.log(cair);
        $("#tampil_cair").html(cair);
        // console.log(cair);
        if (cair == "") {
            alert("Proyeksi cair bulan ini harus diisi");
            return false;
        }else{
            $.get("{{ url('report/create') }}", {}, function(data, status){
                $("#titlemodal").html('Add Report');
                $("#page").html(data);
                $("#addreport").modal('show');
            });
        }
    }

    //Store
    function store() {
        var cair = $("#cair").val();
        var tempat = $("#tempat").val();
        var cabang = $("#cabang").val();
        var rceo = $("#rceo").val();
        var am = $("#am").val();
        var acfm = $("#acfm").val();
        var bm = $("#bm").val();
        var crbmcbs = $("#crbmcbs").val();
        var lainlain = $("#lainlain").val();
        var pembahasan = [];
        var topik = [];
        var hasil_topik = "";
        var hasil_pembahasan = "";
        for (let i = 0; i <= topik_count; i++) {
            topik[i] = $("#topik" + [i]).val();
            pembahasan[i] = $("#pembahasan" + [i]).val();
            // console.log(pembahasan[i]);
            // hasil_topik += i + '.' + topik[i] + "<br>";
            // hasil_pembahasan += i + '.' + pembahasan[i] + "<br>";
            // return hasilpembahasan;
        }
        // return topik;
        // return pembahasan;
        console.log(topik_count);
        console.log(topik);
        console.log(pembahasan);
        if (tempat == "") {
            alert("Tempat harus diisi");
            return false;
        }else if (rceo == "" && am == "" && acfm == "" && bm == "" && crbmcbs == "" && lainlain == ""){
            alert("Salah satu Pejabatan harus diisi");
            return false;
        }else if (topik_count == 0){
            alert("Topik dan Pembahasan harus diisi minimal 2");
            return false;
        }else if (topik == "" ) {
            alert("Topik harus diisi");
            return false;
        }
        else if (pembahasan == "") {
            alert("Pembahasan harus diisi");
            return false;
        }else{
            $.ajax({
                type: "get",
                url: "{{ url('report/store') }}",
                data: "cair=" + cair +
                "&tempat=" + tempat +
                "&cabang=" + cabang + 
                "&rceo=" + rceo +
                "&am=" + am +
                "&acfm=" + acfm +
                "&bm=" + bm +
                "&crbmcbs=" + crbmcbs +
                "&lainlain=" + lainlain +
                "&topik=" + topik +
                "&pembahasan=" + pembahasan,
                success:function (data) {
                    $(".btn-close").click();
                    read()
                }
            });
        }
        checkInput();
    }

    //Show
    function show(id) {
        $buka_topik = false;
        checkInput();
        $('#form_cair_id').attr("hidden", true);
        $.get("{{ url('report/show') }}/" + id, {}, function(data, status){
            $("#titlemodal").html('Edit Report');
            $("#page").html(data);
            $("#addreport").modal('show');
        });
    }

    //Update
    var $buka_topik = false;
    function update(id) {
        if ($buka_topik == true) {
            // show_topik_pembahasan();
            var cair = $("#cair_modal").val();
            var tempat = $("#tempat").val();
            var cabang = $("#cabang").val();
            var rceo = $("#rceo").val();
            var am = $("#am").val();
            var acfm = $("#acfm").val();
            var bm = $("#bm").val();
            var crbmcbs = $("#crbmcbs").val();
            var lainlain = $("#lainlain").val();
            var pembahasan = [];
            var topik = [];
            for (let i = 0; i < count_new_topik_update; i++) {
                topik[i] = $("#topik_update" + [i]).val();
                pembahasan[i] = $("#pembahasan_update"+ [i]).val();
            }
            console.log(count_new_topik_update);
            console.log(topik);
            console.log(pembahasan);
            if (tempat == "") {
            alert("Tempat harus diisi");
            return false;
            }else if (rceo == "" && am == "" && acfm == "" && bm == "" && crbmcbs == "" && lainlain == ""){
                alert("Salah satu Pejabatan harus diisi");
                return false;
            }else if (count_new_topik_update == 1){
                alert("Topik dan Pembahasan harus diisi minimal 2");
                return false;
            }else if (topik == "" ) {
                alert("Topik harus diisi");
                return false;
            }
            else if (pembahasan == "") {
                alert("Pembahasan harus diisi");
                return false;
            }else{
                $.ajax({
                    type: "get",
                    url: "{{ url('report/update') }}/" + id,
                    data: "cair=" + cair +
                    "&tempat=" + tempat +
                    "&cabang=" + cabang + 
                    "&rceo=" + rceo +
                    "&am=" + am +
                    "&acfm=" + acfm +
                    "&bm=" + bm +
                    "&crbmcbs=" + crbmcbs +
                    "&lain=" + lainlain +
                    "&topik=" + topik +
                    "&pembahasan=" + pembahasan,
                    success:function (data) {
                        $(".btn-close").click();
                        read()
                    }
                });
            }
            $buka_topik = false;
        }else{
            show_topik_pembahasan();
        }
    }

    var count_new_topik_update = 0;
    function show_topik_pembahasan() {
        $buka_topik = true;
        $('#tampil_topik_pembahasan').removeAttr("hidden");
        $('#btn_tampil_topik_pembahasan').attr("hidden", true);
        count_new_topik_update = parseInt($('#count_topiks').val());
    }

    //Delete
    function destroy(id) {
        $.ajax({
            type: "get",
            url: "{{ url('report/destroy') }}/" + id,
            data: "id=" + id,
            success:function (data) {
                if (confirm('Are you sure to delete this record ?')) {
                    $(".btn-close").click();
                    read()
                }
            }
        });
    }

    var topik_count = 0;
    function new_topik() {
        topik_count++;
        // console.log(topik_count);
        var div1 = document.createElement('div');
        div1.id = topik_count;
        var topik = '<div class="input-group mb-3"><label class="input-group-text" for="inputGroupSelect01">Topik</label><select class="form-select" id="topik'+topik_count+'" name="topik'+topik_count+'"><option selected>Pilih Topik</option><option value="Pemenuhan SF">Pemenuhan SF</option><option value="Target dan Pipeline bulan ini">Target dan Pipeline bulan ini</option><option value="Proses SLA">Proses SLA</option><option value="Strategy">Strategy</option><option value="Root cause">Root cause</option><option value="Evaluasi Kerja">Evaluasi Kerja</option><option value="Support yang dibutuhkan">Support yang dibutuhkan</option><option value="Activity SF">Activity SF</option></select></div>';
        var pembahasan = '<div class="mb-3"><label for="exampleFormControlTextarea1" class="form-label">Hasil Pembahasan</label><textarea class="form-control" id="pembahasan'+topik_count+'" name="pembahasan2'+topik_count+'" rows="3"></textarea></div>'
        var delLink = '<div><button class="btn btn-outline-danger btn-sm" type="button" onclick="delet_topik(' + topik_count +')">Hapus</button></div>';
        div1.innerHTML = topik + pembahasan + delLink;
        document.getElementById('new_topik').appendChild(div1);
        if (topik_count >= 1) {
            $('#topik_min').hide();
        }else{
            $('#topik_min').show();
        }
    }

    function add_new_topik_update() {
        console.log(count_new_topik_update);
        var div = document.createElement('div');
        div.id = "update_topik" + count_new_topik_update;
        var topik = '<div class="input-group mb-3"><label class="input-group-text" for="inputGroupSelect01">Topik</label><select class="form-select" id="topik_update'+count_new_topik_update+'" name="topik'+count_new_topik_update+'"><option selected>Pilih Topik</option><option value="Pemenuhan SF">Pemenuhan SF</option><option value="Target dan Pipeline bulan ini">Target dan Pipeline bulan ini</option><option value="Proses SLA">Proses SLA</option><option value="Strategy">Strategy</option><option value="Root cause">Root cause</option><option value="Evaluasi Kerja">Evaluasi Kerja</option><option value="Support yang dibutuhkan">Support yang dibutuhkan</option><option value="Activity SF">Activity SF</option></select></div>';
        var pembahasan = '<div class="mb-3"><label for="exampleFormControlTextarea1" class="form-label">Hasil Pembahasan</label><textarea class="form-control" id="pembahasan_update'+count_new_topik_update+'" name="pembahasan2'+count_new_topik_update+'" rows="3"></textarea></div>'
        var delLink = '<div><button class="btn btn-outline-danger btn-sm" type="button" onclick="delet_topik_update(' + count_new_topik_update +')">Hapus</button></div>';
        div.innerHTML = topik + pembahasan + delLink;
        document.getElementById('update_topik0').appendChild(div);
        count_new_topik_update++;
        // console.log(count_new_topik_update);
    }

    function delet_topik(id) {
        topik_count--;
        if (topik_count >= 1) {
            $('#topik_min').hide();
        }else{
            $('#topik_min').show();
        }
        var del = document.getElementById(id);
        var parent_topik = document.getElementById('new_topik');
        parent_topik.removeChild(del);
        return topik_count;
    }

    function delet_topik_update(id) {
        count_new_topik_update--;
        $('#update_topik' + id).remove();
        return count_new_topik_update;
    }

    function checkInput() {
        count_new_topik_update = 0;
        topik_count = 0;
    }
</script>
@endsection