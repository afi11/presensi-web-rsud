@extends('layouts.main')
@section('title','Daftar Record Presensi')
@section('content')
<div class="page-heading">
    <h1 class="page-title">Daftar Record Presensi</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ url()->previous() }}"><i class="la la-home font-20"></i></a>
        </li>
        <li class="breadcrumb-item">Daftar Record Presensi</li>
    </ol>
</div>
<div class="ibox mt-3">
    <div class="ibox-head">
        <div class="ibox-title">Daftar Pegawai Ruangan {{ $divisi->namaDivisi }}</div>
    </div>
    <div class="ibox-body">
        <div class="row justify-content-between">
            <div class="col-6">
                <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#staticBackdrop">
                    Sinkronisasi Presensi
                </button>
            </div>
            <div class="col-6">
                <form method="GET" id="frmAction">
                    <div class="row justify-content-end">
                        <input type="month" name="bulanTahun" class="mr-3" value="{{ $bulanTahun }}" />
                        <button type="submit" class="btn btn-primary mr-1" id="btnFilter">
                            Filter
                        </button>
                        <button type="submit" class="btn btn-primary" id="btnExport">
                            Export Excel
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped" id="datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Pegawai</th>
                        <th>1</th>
                        <th>2</th>
                        <th>3</th>
                        <th>4</th>
                        <th>5</th>
                        <th>6</th>
                        <th>7</th>
                        <th>8</th>
                        <th>9</th>
                        <th>10</th>
                        <th>11</th>
                        <th>12</th>
                        <th>13</th>
                        <th>14</th>
                        <th>15</th>
                        <th>16</th>
                        <th>17</th>
                        <th>18</th>
                        <th>19</th>
                        <th>20</th>
                        <th>21</th>
                        <th>22</th>
                        <th>23</th>
                        <th>24</th>
                        <th>25</th>
                        <th>26</th>
                        <th>27</th>
                        <th>28</th>
                        <th>29</th>
                        <th>30</th>
                        <th>31</th>
                        <th>TL-1</th>
                        <th>TL-2</th>
                        <th>TL-3</th>
                        <th>TL-4</th>
                        <th>PSW-1</th>
                        <th>PSW-2</th>
                        <th>PSW-3</th>
                        <th>PSW-4</th>
                        <th>N TL-1</th>
                        <th>N TL-2</th>
                        <th>N TL-3</th>
                        <th>N TL-4</th>
                        <th>N PSW-1</th>
                        <th>N PSW-2</th>
                        <th>N PSW-3</th>
                        <th>N PSW-4</th>
                        <th>Kehadiran</th>
                        <th>Ketidakhadiran</th>
                        <th>Jumlah Hari Kerja</th>
                        <th>Presentase Kehadiran</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Import Data Jadwal Ruangan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ url('sinkronisasi-presensi-v2') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="idDivisi" value="{{ $divisi->id }}" />
                        <div class="form-group">
                            <label>Bulan</label>
                            <input type="month" name="bulan" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Pilih File Excel</label>
                            <div class="custom-file mb-2">
                                <input type="file" name="file_sinkronisasi" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Ambil File</label>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
const btnExport = document.getElementById("btnExport");
const btnFilter = document.getElementById("btnFilter");

btnFilter.addEventListener("click", function() {
    document.getElementById("frmAction").action = "";
});

btnExport.addEventListener("click", function() {
    document.getElementById("frmAction").action = "{{ url('export_excel_presensi/'.Request::segment(2)) }}";
});

var tabelHistoriPresensi = $("#datatable").DataTable({
    ajax: {
        url: '{{ url("fetch-history-presensi-v2?ruangan=".Request::segment(2)) }}' +
            '&bulanTahun={{ $bulanTahun }}',
    },
    order: [
        [0, "asc"]
    ],
    columns: [{
            data: "id",
            render: function(data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        {
            data: "kode"
        },
        {
            data: "nama"
        },
        {
            data: "tgl_1"
        },
        {
            data: "tgl_2"
        },
        {
            data: "tgl_3"
        },
        {
            data: "tgl_4"
        },
        {
            data: "tgl_5"
        },
        {
            data: "tgl_6"
        },
        {
            data: "tgl_7"
        },
        {
            data: "tgl_8"
        },
        {
            data: "tgl_9"
        },
        {
            data: "tgl_10"
        },
        {
            data: "tgl_11"
        },
        {
            data: "tgl_12"
        },
        {
            data: "tgl_13"
        },
        {
            data: "tgl_14"
        },
        {
            data: "tgl_15"
        },
        {
            data: "tgl_16"
        },
        {
            data: "tgl_17"
        },
        {
            data: "tgl_18"
        },
        {
            data: "tgl_19"
        },
        {
            data: "tgl_20"
        },
        {
            data: "tgl_21"
        },
        {
            data: "tgl_22"
        },
        {
            data: "tgl_23"
        },
        {
            data: "tgl_24"
        },
        {
            data: "tgl_25"
        },
        {
            data: "tgl_26"
        },
        {
            data: "tgl_27"
        },
        {
            data: "tgl_28"
        },
        {
            data: "tgl_29"
        },
        {
            data: "tgl_30"
        },
        {
            data: "tgl_31"
        },
        {
            data: "TL-1"
        },
        {
            data: "TL-2"
        },
        {
            data: "TL-3"
        },
        {
            data: "TL-4"
        },
        {
            data: "PSW-1"
        },
        {
            data: "PSW-2"
        },
        {
            data: "PSW-3"
        },
        {
            data: "PSW-4"
        },
        {
            data: "nTL1"
        },
        {
            data: "nTL2"
        },
        {
            data: "nTL3"
        },
        {
            data: "nTL4"
        },
        {
            data: "nPSW1"
        },
        {
            data: "nPSW2"
        },
        {
            data: "nPSW3"
        },
        {
            data: "nPSW4"
        },
        {
            data: "masuk_kerja"
        },
        {
            data: "tidak_masuk_kerja"
        },
        {
            data: "jumlah_kerja"
        },
        {
            data: "presentase_kehadiran"
        },
        {
            data: "keterangan"
        },
    ]
});
</script>
@endpush