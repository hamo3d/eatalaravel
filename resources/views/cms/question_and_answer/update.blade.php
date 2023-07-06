@extends('cms.parent')

@section('title','Update category')
@section('thePage','Update donation opportunities')


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
            <form method="POST" action="{{route('questionAndAnswer.update',$data->id)}}">
              @method('PUT')
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="name">Question</label>
                  <input type="text" class="form-control" id="question" placeholder="Enter question" name="question" value="{{$data->question}}">
                </div>

                <div class="form-group">
                  <label for="name">Answer</label>
                  <input type="text" class="form-control" id="answer" placeholder="Enter answer" name="answer" value="{{$data->answer}}">
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