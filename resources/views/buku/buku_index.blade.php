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
                                <th>Action</th>
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
                                <td>
                                    <p>
                                        <a href="{{url('master/buku/'.$dt->id)}}" class="btn btn-flat btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
                                        <a href="{{url('master/buku/'.$dt->id)}}" class="btn btn-flat btn-xs btn-danger btn-hapus"><i class="fa fa-trash"></i></a>
                                    </p>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal hapus --}}
    <div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
        <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
          <div class="modal-content bg-gradient-danger">
   
            <div class="modal-header">
              <h6 class="modal-title" id="modal-title-notification">Your attention is required</h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
   
            <div class="modal-body">
   
              <div class="py-3 text-center">
                <i class="ni ni-bell-55 ni-3x"></i>
                <h4 class="heading mt-4">Apakah kamu yakin ingin menghapus data ini?</h4>
              </div>
   
            </div>
   
            <div class="modal-footer">
              <form action="" method="post">
                {{ csrf_field() }}
                {{ method_field('delete') }}
                <button type="submit" class="btn btn-white">Ok, Got it</button>
              </form>
              <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Close</button>
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
                alert(pesan);
            }

            $('.btn-refresh').click(function(e){
                e.preventDefault();
                location.reload();
            })

            $('body').on('click','.btn-hapus',function(e){
                e.preventDefault();
                var url = $(this).attr('href');
                $('#modal-notification').find('form').attr('action',url);
            
                $('#modal-notification').modal();
            })
        }) 
    </script>
@endsection