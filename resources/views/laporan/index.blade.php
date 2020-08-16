@extends('layouts.master')
 
@section('content')
 
<div class="row">
    <div class="col-md-12">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>
                    <a href="{{url('laporan')}}" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-refresh"></i> Get All Data</a>
                </p>
            </div>
            <div class="box-body">
                <form class="form-inline" method="GET" action="{{url('laporan/periode')}}">
                    <div class="form-group">
                      <label for="email">Tanggal awal:</label>
                      <input type="text" name="tanggal_awal" class="form-control datepicker" id="email" autocomplete="off" value="{{date('Y-m-d')}}">
                    </div>
                    <div class="form-group">
                      <label for="pwd">Tanggal akhir:</label>
                      <input type="text" name="tanggal_akhir" class="form-control datepicker" id="pwd" autocomplete="off" value="{{date('Y-m-d')}}">
                    </div>
                    <div class="form-group">
                        <label for="pwd">User:</label>
                        <select name="user" class="form-control select2">
                            <option value="all">All Anggota</option>
                            @foreach ($users as $us)
                                <option value="{{$us->id}}">{{$us->name}}</option>
                            @endforeach
                        </select>
                   </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                  </form>
               <table class="table table-hover myTable">
                   <thead>
                       <tr>
                           <th>#</th>
                           <th>User</th>
                           <th>Buku</th>
                           <th>Status</th>
                           <th>Created At</th>
                       </tr>
                   </thead>
                   <tbody>
                       @foreach ($data as $i=>$dt)
                       <tr>
                           <td>{{ $i+1 }}</td>
                           <td>{{ $dt->user_r->name }}</td>
                           <td>{{ $dt->buku_r->judul }}</td>
                           <td>{{ $dt->status_r->nama }}</td>
                           <td>{{ date('d F Y H:i:s', strtotime($dt->created_at)) }}</td>
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
 
        // btn refresh
        $('.btn-refresh').click(function(e){
            e.preventDefault();
            $('.preloader').fadeIn();
            location.reload();
        })
 
    })
</script>
 
@endsection