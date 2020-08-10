@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <p>
                <button class="btn btn-flat btn-sm btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>
                <a href="{{url('master/buku/add')}}" class="btn btn-flat btn-sm btn-success"><i class="fa fa-plus"></i> Tambah Buku</a>
            </p>
            <div class="box box-warning">
                <div class="box-header">
                    <h4>{{$title}}</h4>
                </div>
                <div class="box-body">
                    <table class="table table-hover myTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Gambar</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Penulis</th>
                                <th>Stock</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $i=>$dt)
                            <tr>
                                <td>{{$i+1}}</td>
                                <td><img src="{{asset('uploads/'.$dt->gambar)}}" style="width: 50px;"></td>
                                <td>{{$dt->judul}}</td>
                                <td>{{$dt->nama}}</td>
                                <td>{{$dt->penulis}}</td>
                                <td>{{$dt->stock}}</td>
                                <td>{{$dt->created_at}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.btn-refresh').click(function(e){
                e.preventDefault();
                location.reload();
            })
        }) 
    </script>
@endsection