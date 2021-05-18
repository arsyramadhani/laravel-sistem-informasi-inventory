@extends('layouts.app')
@section('title', 'Edit Unit / Kemasan')

@section('content')
<div class="mb-3 no-print">
    <a name="" id="" class="btn btn-default" href="/unit" role=" button">Kembali</a>
    <button type="button" id="btnsimpan" class="btn btn-info float-right" style="width: 150px"><i class="fas fa-print"></i> Simpan</button>
</div>
<div class="card">
    <div class="card-body">

        <div class="form-group">
          <label for="">ID Unit</label>
          <input type="text"
            class="form-control" readonly name="idunit" value=" {{$id}} ">
        </div>
        <form action=" {{route('unit.update', $id)}} " id="myform" method="POST">
            @method('PATCH')
            @csrf
            <div class="form-group">
            <label for="">Nama Unit / Kemasan</label>
            <input type="text"
                class="form-control" name="namaunit" value=" {{$nama_unit}} ">
            </div>
        </form>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        $('#btnsimpan').click(function () {
            $('#myform').submit();
        });
    </script>
@endpush