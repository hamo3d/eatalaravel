@extends('cms.parent')

@section('title', 'Donations')
@section('thePage','Donations')

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
                          <tr>
                            <th>ID</th>
                            <th>Donation value</th>
                            <th>Donor</th>
                            <th>Email</th>
                            <th>Sacrifice to</th>
                            <th>The number of carcasses</th>
                            <th>To implement</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $donations)
                                <tr>
                                {{-- <td>{{$category->id}}</td> --}}
                                <td>{{$loop->index + 1}}</td>
                                <td>{{$donations->amount}}$</td>
                                <td>{{$donations->user->name}}</td>
                                <td>{{$donations->user->email}}</td>
                                <td>{{$donations->item}}</td>
                                <td>{{$donations->quantity}}</td>
                                <td>
                                  <a  href="{{route('sacrificeFollowupController.create',  ['donations->id' => $donations->id])}}" type="button" class="btn btn-primary">
                                    تم التنفيذ
                                  </a>
                                </td>
                                <td>{{$donations->created_at->diffForHumans()}}</td>
                                <td>{{$donations->updated_at->diffForHumans()}}</td>

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