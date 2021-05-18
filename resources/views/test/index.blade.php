@extends('layouts.app')
@section('title', 'Test')

@section('content')
<h1>Saya  sedang sidang</h1>
<div class="card">

    <div class="form-group">
      <label for="">Input 1</label>
      <input type="text"
        class="form-control" name="" id="nilai1" aria-describedby="helpId" placeholder="">
      <small id="helpId" class="form-text text-muted">Help text</small>
    </div>
    <div class="form-group">
      <label for="">Input 2</label>
      <input type="text"
        class="form-control" name="" id="nilai2" aria-describedby="helpId" placeholder="">
      <small id="helpId" class="form-text text-muted">Help text</small>
    </div>
    <button type="button" id="btnsimpan" class="btn btn-primary">Simpan</button>
        <div class="form-group">
      <label for="">Input 2</label>
      <input type="text"
        class="form-control" name="" id="nilai3" aria-describedby="helpId" placeholder="">
      <small id="helpId" class="form-text text-muted">Help text</small>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        $('#btnsimpan').click(function (e) {
            e.preventDefault();
          var $1 =  $('#nilai1').val();
          var $2 =  $('#nilai2').val();
          var $3 = $1-$2;
          $('#nilai3').val($3);


        });
    </script>
@endpush