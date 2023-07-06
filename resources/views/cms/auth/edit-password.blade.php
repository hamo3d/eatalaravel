@extends('cms.parent')

@section('title','Create Category')
@section('thePage','  Change password')

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
            <form method="POST" action="{{route('cms.update-password')}}">
              @csrf
              @method('PUT')
              <div class="card-body">
                <div class="form-group">
                  <label for="old_password">Old Password</label>
                  <input type="password" class="form-control" id="old_password" placeholder="Enter old password" name="old_password">
                </div>
                <div class="form-group">
                  <label for="new_password">New Password</label>
                  <input type="password" class="form-control" id="new_password" placeholder="Enter new password" name="new_password">
                </div>
                <div class="form-group">
                  <label for="new_password_confirmation">New Password Confirmation</label>
                  <input type="password" class="form-control" id="new_password_confirmation" placeholder="New password confirmation" name="new_password_confirmation">
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