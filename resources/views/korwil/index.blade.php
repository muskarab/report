@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="card text-black bg-light mb-3">
            <div class="card-body">
                <h5 class="card-title text-center">Activity Report korwil</h5>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <label for="" class="col-form-label">Proyeksi cair bulan ini</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="cair" name="cair">
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
        <div class="modal fade" id="addreportkorwil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titlemodal">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mt-3">
                    <div class="col-md-12">
                        <label for="" class="col-form-label">Proyeksi cair bulan ini: Rp. <span id="tampil_cair"></span></label>
                    </div>
                </div>
                <div id="page" class="p-2">
                </div>
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> --}}
            </div>
        </div>
        </div>
        
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        read()
    });

    //Read
    function read() {
        document.getElementById("cair").value = "";
        $.get("{{ url('korwil/read') }}", {}, function(data, status){
            $("#read").html(data);
        });
    }
    
    //Create
    function create() {
        var cair = $("#cair").val();
        $("#tampil_cair").html(cair);
        $.get("{{ url('korwil/create') }}", {}, function(data, status){
            $("#titlemodal").html('Create Report korwil');
            $("#page").html(data);
            $("#addreportkorwil").modal('show');
        });
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
        for (let i = 1; i <= topik_count; i++) {
            topik[i] = $("#topik" + [i]).val();
            pembahasan[i] = $("#pembahasan" + [i]).val();
            // console.log(pembahasan[i]);
            hasil_topik += i + '.' + topik[i] + "<br>";
            hasil_pembahasan += i + '.' + pembahasan[i] + "<br>";
            // return hasilpembahasan;
        }
        // return pembahasan;
        console.log(topik_count);
        checkInput();
        console.log(hasil_topik);
        console.log(hasil_pembahasan);
        $.ajax({
            type: "get",
            url: "{{ url('korwil/store') }}",
            data: "cair=" + cair +
            "&tempat=" + tempat + 
            "&cabang=" + cabang + 
            "&rceo=" + rceo +
            "&am=" + am +
            "&acfm=" + acfm +
            "&bm=" + bm +
            "&crbmcbs=" + crbmcbs +
            "&lainlain=" + lainlain +
            "&topik=" + hasil_topik +
            "&pembahasan=" + hasil_pembahasan,
            success:function (data) {
                $(".btn-close").click();
                read()
            }
        });
    }

    //Show
    function show(id) {
        $.get("{{ url('korwil/show') }}/" + id, {}, function(data, status){
            $("#titlemodal").html('Edit Product');
            $("#page").html(data);
            $("#addreportkorwil").modal('show');
            if (rceo) {
                showfieldRCEO();
            }if (am) {
                showfieldAM();
            }if (acfm) {
                showfieldACFM();
            }if (bm) {
                showfieldBM();
            }if (crbmcbs) {
                showfieldCRBMCBS();
            }if (lainlain) {
                showfieldlainlain();
            }
        });
    }

    //Update
    function update(id) {
        var cair = $("#cair").val();
        var tempat = $("#tempat").val();
        var cabang = $("#cabang").val();
        var rceo = $("#rceo").val();
        var am = $("#am").val();
        var acfm = $("#acfm").val();
        var bm = $("#bm").val();
        var crbmcbs = $("#crbmcbs").val();
        var lainlain = $("#lainlain").val();
        var topik = $("#topik").val();
        var pembahasan = $("#pembahasan").val();
        $.ajax({
            type: "get",
            url: "{{ url('korwil/update') }}/" + id,
            data: "tempat=" + tempat + 
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

    //Delete
    function destroy(id) {
        $.ajax({
            type: "get",
            url: "{{ url('korwil/destroy') }}/" + id,
            data: "name=" + name,
            success:function (data) {
                if (confirm('Are you sure to delete this record ?')) {
                    $(".btn-close").click();
                    read()
                }
            }
        });
    }
    var topik_count = 1;
    function new_topik() {
        topik_count++;
        var div1 = document.createElement('div');
        div1.id = topik_count;
        var topik = '<div class="input-group mb-3"><label class="input-group-text" for="inputGroupSelect01">Topik</label><select class="form-select" id="topik'+topik_count+'" name="topik'+topik_count+'"><option selected>Pilih Topik</option><option value="Pemenuhan SF">Pemenuhan SF</option><option value="Target dan Pipeline bulan ini">Target dan Pipeline bulan ini</option><option value="Proses SLA">Proses SLA</option><option value="Strategy">Strategy</option><option value="Root cause">Root cause</option><option value="Evaluasi Kerja">Evaluasi Kerja</option><option value="Support yang dibutuhkan">Support yang dibutuhkan</option><option value="Activity SF">Activity SF</option></select></div>';
        var pembahasan = '<div class="mb-3"><label for="exampleFormControlTextarea1" class="form-label">Hasil Pembahasan</label><textarea class="form-control" id="pembahasan'+topik_count+'" name="pembahasan2'+topik_count+'" rows="3"></textarea></div>'
        var delLink = '<div><button class="btn btn-outline-danger btn-sm" type="button" onclick="delet_topik(' + topik_count +')">Hapus</button></div>';
        div1.innerHTML = topik + pembahasan + delLink;
        document.getElementById('new_topik').appendChild(div1);
        if (topik_count >= 2) {
            $('#topik_min').hide();
        }else{
            $('#topik_min').show();
        }
    }
    function delet_topik(id) {
        topik_count--;
        if (topik_count >= 2) {
            $('#topik_min').hide();
        }else{
            $('#topik_min').show();
        }
        var del = document.getElementById(id);
        var parent_topik = document.getElementById('new_topik');
        parent_topik.removeChild(del);
    }
    function checkInput() {
        topik_count = 1;
    }
    function showfieldRCEO() {
    var field_rceo = document.getElementById("rceo");
        if (field_rceo.style.display === "none") {
            field_rceo.style.display = "block";
            $('#rceo_label').show();
        } else {
            document.getElementById("rceo").value = "";
            field_rceo.style.display = "none";
            $('#rceo_label').hide();
        }
    }
    function showfieldAM() {
        var field_am = document.getElementById("am");
        if (field_am.style.display === "none") {
            field_am.style.display = "block";
            $('#am_label').show();
        } else {
            document.getElementById("am").value = "";
            field_am.style.display = "none";
            $('#am_label').hide();
        }
    }
    function showfieldACFM() {
        var field_acfm = document.getElementById("acfm");
        if (field_acfm.style.display === "none") {
            field_acfm.style.display = "block";
            $('#acfm_label').show();
        } else {
            document.getElementById("acfm").value = "";
            field_acfm.style.display = "none";
            $('#acfm_label').hide();
        }
    }
    function showfieldBM() {
        var field_bm = document.getElementById("bm");
        if (field_bm.style.display === "none") {
            field_bm.style.display = "block";
            $('#bm_label').show();
        } else {
            document.getElementById("bm").value = "";
            field_bm.style.display = "none";
            $('#bm_label').hide();
        }
    }
    function showfieldCRBMCBS() {
        var field_crbmcbs = document.getElementById("crbmcbs");
        if (field_crbmcbs.style.display === "none") {
            field_crbmcbs.style.display = "block";
            $('#crbmcbs_label').show();
        } else {
            document.getElementById("crbmcbs").value = "";
            field_crbmcbs.style.display = "none";
            $('#crbmcbs_label').hide();
        }
    }
    function showfieldlainlain() {
        var field_lainlain = document.getElementById("lainlain");
        if (field_lainlain.style.display === "none") {
            field_lainlain.style.display = "block";
            $('#lainlain_label').show();
        } else {
            document.getElementById("lainlain").value = "";
            field_lainlain.style.display = "none";
            $('#lainlain_label').hide();
        }
    }
</script>
@endsection