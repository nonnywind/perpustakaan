@extends('layouts.master')
 
@section('content')
 
<div class="row">
    <div class="col-md-12">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>
                </p>
            </div>
            <div class="box-body">
               <table class="table table-hover">
                   <thead>
                       <tr>
                           <th>#</th>
                           <th>User</th>
                           <th>Buku</th>
                           <th>Penulis Buku</th>
                           <th>Created At</th>
                           <th>Status Peminjaman</th>
                           <th>Action</th>
                       </tr>
                   </thead>
                   <tbody>
                       @foreach ($data as $i=>$dt)
                       <tr>
                           <td>{{ $i+1 }}</td>
                           <td>{{ $dt->user_r->name }}</td>
                           <td>{{ $dt->buku_r->judul }}</td>
                           <td>{{ $dt->buku_r->penulis }}</td>
                           <td>{{ $dt->created_at }}</td>
                           @if ($dt->status == null)
                               <td><label class="label label-warning">Menunggu Verifikasi</label></td>
                            @elseif ($dt->status == 1)
                               <td><label class="label label-success">Disetujui</label></td>
                            @elseif ($dt->status == 2)
                                <td><label class="label label-danger">Ditolak</label></td>
                           @endif
                           @if ($dt->status == null)
                            <td>
                                <a href="{{url('pinjam-buku/setujui/'.$dt->id)}}" class="btn btn-flat btn-xs btn-primary"><i class="fa fa-check"></i> Setujui</a>
                                <a href="{{url('pinjam-buku/tolak/'.$dt->id)}}" class="btn btn-flat btn-xs btn-danger"><i class="fa"></i> Tolak</a>
                            </td>
                            @elseif($dt->status == 1)
                            <td>
                                <a href="{{url('pinjam-buku/tolak/'.$dt->id)}}" class="btn btn-flat btn-xs btn-danger"><i class="fa"></i> Tolak</a>
                            </td>
                            @elseif($dt->status == 2)
                            <td>
                                <a href="{{url('pinjam-buku/setujui/'.$dt->id)}}" class="btn btn-flat btn-xs btn-primary"><i class="fa fa-check"></i> Setujui</a>
                            </td>
                           @endif
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