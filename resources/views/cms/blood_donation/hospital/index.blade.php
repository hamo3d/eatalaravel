@extends('cms.parent')

@section('title', 'Donation opportunities')
@section('thePage','Donation opportunities')


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
                      <table class="table table-hover table-stripped text-nowrap">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>City</th>
                            <th>Blood request</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Settings</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $hosbital)
                            <tr>
                                {{-- <td>{{$category->id}}</td> --}}
                                <td>{{$loop->index + 1}}</td>
                                <td>{{$hosbital->name}}</td>
                                <td>{{$hosbital->city}}</td>
                                <td>
                                  <a  href="{{route('blood-request.create', ['hospital_id' => $hosbital->id])}}" type="button" class="btn btn-primary">
                                    طلب دم
                                  </a>
                                </td>
                                {{-- <td><span class="tag tag-success">@if($category->visible) Visible @else Hidden @endif</span></td> --}}
                                <td>{{$hosbital->created_at->diffForHumans()}}</td>
                                <td>{{$hosbital->updated_at->diffForHumans()}}</td>
                                <td>
                                  <div class="btn-group">
                                    <a  href="{{route('hospital.edit', $hosbital->id)}}" type="button" class="btn btn-warning">
                                      <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{route('hospital.destroy', $hosbital->id)}}" method="POST">
                                      @method('DELETE')
                                      @csrf
                                      <button  type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                      </button>
                                    </form>
                                  </div>
                                </td>
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