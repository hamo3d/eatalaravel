@extends('cms.parent')

@section('title', 'campaign')
@section('thePage','Compaign')

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
                            <th>Title</th>
                            <th>Category</th>
                            <th>image</th>
                            <th>Amount</th>
                            <th>Total donations</th>
                            <th>Progress</th>
                            <th>Rate</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Settings</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $campaign)
                            <tr>
                                {{-- <td>{{$category->id}}</td> --}}
                                <td >{{$loop->index + 1}}</td>
                                <td>{{$campaign->title}}</td>
                                <td>{{$campaign->donation_opportunities_name}}</td>
                                <td><img src="{{asset('storage/'.$campaign->image)}}" width="60" height="60" alt="Image"></td>
                                <td>{{$campaign->required_amount}}</td>
                                <td>$ {{$campaign->total_donations}}</td>
                                  <?php 
                                 $targetAmount = $campaign->required_amount;
                                 $percentage= ($campaign->total_donations / $targetAmount)*100;
                                 $percentageRounded = round($percentage , 2);

                                 $classProgress = '';
                                 if ($percentage >= 90) {
                                  $classProgress = 'success';
                                 }elseif ($percentage >= 50) {
                                  $classProgress = 'warning';

                                 }elseif ($percentage >= 0) {
                                  $classProgress = 'danger';
                                 }
                                  ?>

                                  <td>
                                  <div class="progress progress-xs">
                                  <div  class="progress-bar bg-{{$classProgress}}" style="width: {{$percentage}}%"></div>
                                  </div>
                                  </td>
                                  <td class="large-text"><span class="badge bg-{{$classProgress}}">{{$percentage}}%</span></td>
                                {{-- <td><span class="tag tag-success">@if($category->visible) Visible @else Hidden @endif</span></td> --}}                               
                                 <td>{{$campaign->created_at->diffForHumans()}}</td>
                                <td>{{$campaign->updated_at->diffForHumans()}}</td>
                                <td>
                                  <div class="btn-group">
                                    <a href="{{route('campaigns.edit', $campaign->id)}}" type="button" class="btn btn-warning">
                                      <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{route('campaigns.destroy', $campaign->id)}}" method="POST">
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