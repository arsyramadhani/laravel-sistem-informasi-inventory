@extends('layouts.app')
@section('title', 'Unit / Kemasan')

@section('content')


<div class="card">
    <div class="card-header border-transparent">
        <h6 class="card-title">Data Unit</h6>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table m-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Unit / Kemasan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                        <td> {{$item->id}} </td>
                        <td> {{$item->nama_unit}} </td>
                        <td> <a name="" id="" class="btn btn-primary btn-sm" href="{{route('unit.edit', $item->id)}}" role="button">Edit</a> </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <!-- /.table-responsive -->
    </div>
</div>
@endsection
