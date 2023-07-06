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
                          <tr style="text-align:center">
                            <th>Donations total</th>
                            <th>Campaign donations total</th>
                            <th>Zka donations total</th>
                            <th>Sacrifice donations total</th>
                            <th>General donations total</th>
                          </tr>
                        </thead>
                        <tbody>
                            <tr style="text-align:center">
                              @if($totalDonations != null)
                                <td>{{$totalDonations}}$</td>
                                <td>{{$campaignDonations}}$</td>
                                <td>{{$zakatDonations}}$</td>
                                <td>{{$sacrificeDonations}}$</td>
                                <td>{{$generalDonations}}$</td>
                                @endif
                            </tr>
                              </tr>
                          
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