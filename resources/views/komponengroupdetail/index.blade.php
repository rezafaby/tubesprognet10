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
        <div class="btn-group">
            <a href="{{ route('komponengroupdetail.create') }}" class="btn btn-sm btn-primary" onclick="buttondisable(this)"><em class="icon fas fa-plus"></em> <span>Add Data</span></a>
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
                <div class="table-responsive">
                    <table class="small-table table " style="width:100%">
                        <thead style="color:#526484; font-size:11px;" class="thead-light">
                            <th width="1%">No.</th>
                            <th width="10%">Komponen Detail</th>
                            <th width="10%">Komponen Group</th>
                            <th width="10%">Aksi</th>   
                        </thead>
                        <tbody>
                            @foreach($data as $index => $data)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $data->gkomponen_detail }}</td>
                                <td>{{ $data->KomponenGroups->group }}</td>
                                <td>
                                    <a href="{{ route('komponengroupdetail.edit',$data->id) }}" class="btn btn-sm btn-primary">UPDATE</a>
                                    <input onclick="deletePeminjams({{$data->id}})" type="submit" value="DELETE" form="form-delete-{{ $index }}" class="btn btn-sm btn-danger"/>
                                    <form action="{{ route('komponengroupdetail.delete') }}" method="POST" id="form-delete-{{ $index }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{ $data->id }}">
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="nk-fmg-actions">
                        <div class="btn-group">
                            <a href="{{ route('komponengroups.index') }}" class="btn btn-sm btn-primary" onclick="buttondisable(this)"><em class="icon fas fa-arrow-left"></em> <span>Kembali</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- </div> -->

@endsection
@push('script')
<script>
function deletePeminjams(index){
            CustomSwal.fire({
            icon:'question',
            text: 'Hapus Data '+name+' ?',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $('#delete-'+index).submit();
                CustomSwal.fire('Sukses', 'Berhasil Menghapus Data!', 'success')
            } else if (result.isDenied) {
                CustomSwal.fire('Batal', 'Batal Menghapus Data', 'info')
            }
        })
    };
</script>
@endpush