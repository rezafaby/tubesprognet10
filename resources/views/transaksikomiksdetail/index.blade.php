{{-- https://www.positronx.io/laravel-datatables-example/ --}}

@extends('layouts.app')
@section('action')

@endsection
@section('content')
<div class="nk-fmg-body-head d-none d-lg-flex">
    <div class="nk-fmg-search">
        <h4 class="card-title text-primary"><i class='{{$icon}}' data-toggle='tooltip' data-placement='bottom' title='Data {{$subtitle}}'></i>  {{strtoupper("Data ".$subtitle)}}</h4>
    </div>
    <div class="nk-fmg-actions">
        {{-- <div class="btn-group"><a href="{{ url()->previous() }}" class="btn btn-sm btn-danger" onclick="buttondisable(this)"><em class="icon fas fa-arrow-left"></em> <span>Kembali</span></a> --}}
            
            @if($id != 0)
                <a href="{{ route('transaksikomiksdetail.createSpesific', ['id' => $id]) }}" class="btn btn-sm btn-primary" onclick="buttondisable(this)"><em class="icon fas fa-plus"></em> <span>Add Data</span></a>
            @else
                <a href="{{ route('transaksikomiks.create') }}" class="btn btn-sm btn-primary" onclick="buttondisable(this)"><em class="icon fas fa-plus"></em> <span>Add Data</span></a>
            @endif
        </div>
    </div>
</div>
<div class="row gy-3 d-none" id="loaderspin">
    <div class="col-md-12">
        <div class="col-md-12" align="center">
            &nbsp;
        </div>
        <div class="d-flex align-items-center">
          <div class="col-md-12" align="center">
            <div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>
          </div>
        </div>
        <div class="col-md-12" align="center">
            <strong>Loading...</strong>
        </div>
    </div>
</div>
<div class="card d-none" id="filterrow">
    <div class="card-body" style="background:#f7f9fd">
        <div class="row gy-3" >
            
        </div>
    </div>
</div>

<!-- <div class="nk-fmg-body-content"> -->
    <div class="nk-fmg-quick-list nk-block">
        <div class="card">
            <div class="card-body">
                @if(session()->exists('message'))
                <div class="alert alert-success" role="alert">
                    {{ session('message') }}
                  </div>
                  @endif
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item" aria-current="page">
                        {{ $dataProvider->nama_iks }}
                      </li>
                      <li class="breadcrumb-item" aria-current="page">
                        {{ $dataProvider->tanggal_awal }}
                      </li>
                      <li class="breadcrumb-item" aria-current="page">
                        {{ $dataProvider->tanggal_akhir }}
                      </li>
                    </ol>
                  </nav>
                {{-- <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item" aria-current="page">
                        @foreach($tikspro as $tip)
                        <p class="fs-1" value="{{$tip->id}}" 
                            @isset($id)
                                @if($tip->id==$tkomiksdetail->TransaksiKomIKS->TransaksiIKSPro->id)@endif
                                @endisset >
                                {{$tip->nama_iks}}</p>
                        @endforeach
                      </li>

                      @foreach($provinces as $index => $province)
                                    <option value="{{ $province->id }}" @if($province->id == $subdistrict->District->Province->id) selected @endif>{{ $province->province_name }}</option>
                                @endforeach

                      <li class="breadcrumb-item" aria-current="page">
                        @foreach($tikspro as $tip)
                        <p class="fs-1" value="{{$tip->id}}" 
                            @isset($id)
                                @if($tip->id==$id)@endif
                            @endisset >
                                {{$tip->tanggal_awal}}</p>
                        @endforeach
                      </li>

                      <li class="breadcrumb-item" aria-current="page">
                        @foreach($tikspro as $tip)
                        <p class="fs-1" value="{{$tip->id}}" 
                            @isset($id)
                                @if($tip->id==$id)@endif
                            @endisset >
                          {{$tip->tanggal_akhir}}</p>
                        @endforeach
                      </li>
                    </ol>
                  </nav> --}}

                <div class="table-responsive">
                    <table id="{{$table_id}}" class="small-table table " style="width:100%">
                        <thead style="color:#526484; font-size:11px;" class="thead-light">
                            <th width="1%">No.</th>
                            <th width="10%">Komponen Group Detail</th>
                            <th width="10%">Group</th>
                            <th width="10%">Aksi</th>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<!-- </div> -->

@endsection
@push('script')
<script>
var table;
$(document).ready(function() {
    table = $('#{{$table_id}}').DataTable({
        processing:true,
        autoWidth: true,
        ordering: true,
        serverSide: true,
        dom: '<"row justify-between g-2 "<"col-7 col-sm-4 text-left"f><"col-5 col-sm-8 text-right"<"datatable-filter"<"d-flex justify-content-end g-2" l>>>><" my-3"t><"row align-items-center"<"col-5 col-sm-12 col-md-6 text-left text-md-left"i><"col-5 col-sm-12 col-md-6 text-md-right"<"d-flex justify-content-end "p>>>',
        ajax: {
            url: '{{ route("transaksikomiksdetail.listData", ["id" => $id]) }}',
            type:"POST",
            data: function(params) {
                params._token = "{{ csrf_token() }}";
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },         
            {
                data: 'komponen_iks_detail',
                name: 'komponen_iks_detail',
                orderable: true,
                searchable: true,
                class: 'text-left'
            },
            {
                data: 'TransaksiKomIKS.group',
                name: 'TransaksiKomIKS.group',
                orderable: true,
                searchable: true,
                class: 'text-left'
            },
            {
                data: 'aksi',
                name: 'aksi',
                orderable: false,
                searchable: false,
                class: 'text-center'
            },
        ],
    });
    
    $('.dataTables_filter').html('<div><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><em class="ti ti-search"></em></span></div><input type="search" class="form-control form-control-sm" placeholder="Type in to Search" aria-controls="tbtariflayanan"></div></div>');
});


function deleteData(id,name,elm){
    buttonsmdisable(elm);
    CustomSwal.fire({
        icon:'question',
        text: 'Hapus Data '+name+' ?',
        showCancelButton: true,
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal',
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            $.ajax({
                url:"{{url('transaksikomiksdetail')}}/"+id,
                data:{
                    _method:"DELETE",
                    _token:"{{csrf_token()}}"
                },
                type:"POST",
                dataType:"JSON",
                beforeSend:function(){
                    block("#{{$table_id}}");
                },
                success:function(data){
                    if(data.success == 1){
                        CustomSwal.fire('Sukses', data.msg, 'success');
                    }else{
                        CustomSwal.fire('Gagal', data.msg, 'error');
                    }
                    unblock("#{{$table_id}}");
                    RefreshTable('{{$table_id}}',0);
                },
                error:function(error){
                    CustomSwal.fire('Gagal', 'terjadi kesalahan sistem', 'error');
                    console.log(error.XMLHttpRequest);
                    unblock("#{{$table_id}}");
                    RefreshTable('{{$table_id}}',0);
                }
            });
        }else{
            RefreshTable('{{$table_id}}',0);
        }
    });
}

</script>
@endpush