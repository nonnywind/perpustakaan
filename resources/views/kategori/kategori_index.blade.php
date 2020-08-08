@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <p>
                <a href="{{url('master/kategori/add')}}" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah Kategori</a>
            </p>
            <div class="box box-warning">
                <div class="box-header">
                    
                </div>
                <div class="box-body">
                    <table class="table table-hover myTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Kategori</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $i=>$dt)
                                <tr>
                                    <td>{{$i+1}}</td>
                                    <td>{{$dt->nama}}</td>
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
        var flash = "{{ Session::has('sukses') }}";
        if(flash){
            var pesan = "{{ Session::get('sukses') }}"
            swal("Sukses", pesan, "success");
        }
 
        var gagal = "{{ Session::has('gagal') }}";
        if(gagal){
            var pesan = "{{ Session::get('gagal') }}"
            swal("Error", pesan, "error");
        }
    })
</script>
@endsection