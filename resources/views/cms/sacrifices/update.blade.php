@extends('cms.parent')

@section('title','Update sacrifices')
@section('thePage','Update sacrifices')


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
            <form method="POST" action="{{route('sacrifices.update',$data->id)}}">
              @method('PUT')
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="item">Item</label>
                  <input type="text" class="form-control" id="name" placeholder="Enter item" name="item" value="{{$data->item}}">
                </div>
                <div class="form-group">
                    <label for="details">Details</label>
                    <input type="text" class="form-control" id="details" placeholder="Enter details" name="details" value="{{$data->details}}">
                  </div>
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