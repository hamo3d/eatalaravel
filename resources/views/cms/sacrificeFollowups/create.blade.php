@extends('cms.parent')

@section('title','Create Category')
@section('thePage','Create donation opportunities')

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Quick Example</h3>
            </div>
            @if($errors->any())
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{route('sacrificeFollowupController.store')}}">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="is_checked">Slaughtered</label>
                  <input type="checkbox" id="is_checked" name="slaughtered" value="1">
                  <input type="hidden" name="is_checked" value="0">                
                </div>

                <div class="form-group">
                  <input type="hidden" class="form-control" id="title" placeholder="" value="{{$donation_id}}" name="donation_id" readonly>
                </div>


                <div class="form-group">
                  <label for="title">Note</label>
                  <input type="text" class="form-control" id="title" placeholder="note" name="note">
                </div>

              
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.card -->
        </div>
        <!--/.col (left) -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>    
@endsection