@extends('cms.parent')

@section('title', 'Donation opportunities
')

@section('thePage','Admins')

@section('content')
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
              
              <!-- /.row -->
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Responsive Hover Table</h3>
      
                      <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                          <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
      
                          <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                              <i class="fas fa-search"></i>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                      <table class="table table-bordered table-hover">
                        <thead>
                          <tr style="text-align:center">
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $admins)
                            <tr style="text-align:center">
                                {{-- <td>{{$category->id}}</td> --}}
                                <td>{{$loop->index + 1}}</td>
                                <td>{{$admins->name}}</td>
                                <td>{{$admins->email}}</td>
                                {{-- <td><span class="tag tag-success">@if($category->visible) Visible @else Hidden @endif</span></td> --}}

                              </tr>
                            @endforeach
                          
                        </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
              </div>
              <!-- /.row -->
            </div><!-- /.container-fluid -->
          </section>
          <!-- /.content -->      
@endsection