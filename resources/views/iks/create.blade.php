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
            <a href="{{ route('iks.index') }}" class="btn btn-sm btn-primary" onclick="buttondisable(this)"><em class="icon fas fa-arrow-left"></em> <span>Kembali</span></a>
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
                @if($errors->any())
                    @foreach($errors->all() as $err)
                        <p class="alert alert-danger">{{ $err }}</p>
                    @endforeach
                @endif
                <form id="form" action="{{ route('iks.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Kode</label>
                    <input class="form-control" id="group" name="kode" value="{{ old('kode') }}"  placeholder="Masukkan Kode" required>
                  </div>
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nama Provider</label>
                    <input class="form-control" id="group" name="nama" value="{{ old('nama') }}" placeholder="Masukkan Nama Provider" required>
                  </div>
                <div class="mb-3">
                    <label for="sel1" class="form-label">Penjamin :</label>
                    <select class="form-control" id="penjamin" name="penjamin_id" required>
                        <option value="0" disabled >Pilih Penjamin</option>
                            @foreach($penjamin as $pj)
                                @if(old('penjamin_id') == $pj->id)
                                    <option value="{{$pj->id}}" selected>{{$pj->nama}}</option>
                                @else
                                    <option value="{{$pj->id}}">{{$pj->nama}}</option>
                                @endif
                            @endforeach
                        </select>
                </div>

                <div class="mb-3">
                    <label for="sel1" class="form-label">Tipe IKS :</label>
                    <select class="form-control" id="tiks" name="tipe_id" required>
                        <option value="0" disabled >Pilih Tipe IKS</option>
                        @foreach($tiks as $ti)
                            @if(old('tipe_id') == $ti->id)
                                <option value="{{$ti->id}}" selected>{{$ti->nama}}</option>
                            @else
                                <option value="{{$ti->id}}">{{$ti->nama}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <div class="form-group">
                        <label for="">Masa Berlaku Awal</label>
                        <input type="date" name="masa_berlaku_awal" maxlength="10" value="{{ old('masa_berlaku_awal') }}" class="form-control bg-se" id="datepicker" required>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-group">
                        <label for="">Masa Berlaku Akhir</label>
                        <input type="date" name="masa_berlaku_akhir" maxlength="10" value="{{ old('masa_berlaku_akhir') }}" class="form-control bg-se" id="datepicker" required>
                    </div>
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

    //Date range picker
    $('#datepicker').daterangepicker()
    //Date range picker with time picker
    $('#datepicker').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        locale: {
        format: 'MM/DD/YYYY hh:mm A'
        }
    });

</script>
@endpush
