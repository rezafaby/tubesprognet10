{{-- https://www.positronx.io/laravel-datatables-example/ --}}

@extends('layouts.app')
@section('action')

@endsection
@section('content')
<div class="nk-fmg-body-head d-none d-lg-flex">
    <div class="nk-fmg-search">
        <!-- <em class="icon ni ni-search"></em> -->
        <!-- <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search files, folders"> -->
        <h4 class="card-title text-primary"><i class='{{$icon}}' data-toggle='tooltip' data-placement='bottom' title='{{$subtitle}}'></i>  {{strtoupper($subtitle)}}</h4>
    </div>
    <div class="nk-fmg-actions">
        <div class="btn-group">
            <!-- <a href="#" target="_blank" class="btn btn-sm btn-success"><em class="icon ti-files"></em> <span>Export Data</span></a> -->
            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalDefault">Modal Default</button> -->
            <!-- <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalDefault"><em class="icon ti-file"></em> <span>Filter Data</span></a> -->
            <!-- <a href="javascript:void(0)" class="btn btn-sm btn-success" onclick="filtershow()"><em class="icon ti-file"></em> <span>Filter Data</span></a> -->
            <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary" onclick="buttondisable(this)"><em class="icon fas fa-arrow-left"></em> <span>Kembali</span></a>
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
    <!-- <div class="card-footer" style="background:#fff" align="right"> -->
    <div class="card-footer" style="background:#f7f9fd; padding-top:0px !important;">
        <div class="btn-group">
            <!-- <a href="javascript:void(0)" class="btn btn-sm btn-dark" onclick="filterclear()"><em class="icon ti-eraser"></em> <span>Clear Filter</span></a> -->
            <a href="javascript:void(0)" class="btn btn-sm btn-primary" onclick="filterdata()"><em class="icon ti-reload"></em> <span>Submit Filter</span></a>
        </div>
    </div>
</div>

<!-- <div class="nk-fmg-body-content"> -->
    <div class="nk-fmg-quick-list nk-block">
        <div class="card">
            <div class="card-body">
                <form id="form" action="{{route('komponengroupdetail.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Komponen Detail</label>
                    <input class="form-control" id="gkomponen_detail" name="gkomponen_detail" placeholder="Masukkan Komponen Detail" required>
                  </div>
                  <div class="mb-3">
                    <label for="sel1"class="form-label">Group Komponen :</label>
                    <select class="form-control" id="gkomponen" name="gkomponen_id">
                        <option value="0" disabled >Pilih Group Komponen</option>
                        @foreach($gkomponen as $gk)
                            <option value="{{$gk->id}}" 
                                @isset($id) 
                                    @if($gk->id == $id) selected @endif 
                                @endisset >
                                {{$gk->group}}
                            </option>
                        @endforeach
                    </select>
                </div>
                  <div class="nk-fmg-actions">
                    <div class="btn-group">
                        <button type="submit" class="btn btn-sm btn-primary"><span>Submit</span></button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
<!-- </div> -->

@endsection
@push('script')
<script>
        $('#form').submit(function(e){
            e.preventDefault();

            CustomSwal.fire({
            text: 'Yakin ingin menambahkan data?',
            icon:'question',
            showCancelButton: true,
            confirmButtonText: 'Submit',
            cancelButtonText: 'Batal',
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                form.submit();
                // CustomSwal.fire('Sukses', 'Berhasil Menambahkan Data!', 'success')
            } else if (result.isDenied) {
                CustomSwal.fire('Batal', 'Batal Menambahkan Data', 'info')
            }
        })
    });

</script>
@endpush
