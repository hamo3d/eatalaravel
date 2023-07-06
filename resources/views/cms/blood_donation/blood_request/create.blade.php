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
            <form method="POST" action="{{route('blood-request.store')}}">
              @csrf
              <input type="hidden" value="{{$hospitalId}}" name="hospital_id">

              <div class="card-body">
                <div class="form-group">
                  <label for="blood_types">Blood types</label>
                  <input type="text" class="form-control" id="name" placeholder="Enter blood types" name="blood_types">
                </div>


                <div class="form-group">
                  <select name="highest_need" class="form-control">
                    <option value="" disabled selected>الأعلى احتياجا</option>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                </select>
              </div>

                <div class="form-group">
                    <label for="units_required">Units required</label>
                    <input type="number" class="form-control" id="units_required" placeholder="Enter units required" name="units_required">
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