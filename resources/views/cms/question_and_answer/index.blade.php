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
                            <th>Question</th>
                            <th>Answer</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Settings</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $data)
                            <tr>
                                <td>{{$loop->index + 1}}</td>
                                <td>{{$data->question}}</td>
                                <td>{{$data->answer}}</td>
                                <td>{{$data->created_at->diffForHumans()}}</td>
                                <td>{{$data->updated_at->diffForHumans()}}</td>
                                <td>
                                  
                                  <div class="btn-group">
                                    <a  href="{{route('questionAndAnswer.edit', $data->id)}}" type="button" class="btn btn-warning">
                                      <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{route('questionAndAnswer.destroy', $data->id)}}" method="POST">
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