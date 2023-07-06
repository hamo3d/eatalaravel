@extends('cms.parent')

@section('title','Create category')
@section('thePage',' Create compaign')

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

            <form method="POST" action="{{route('advertisement.store')}}"  enctype="multipart/form-data">
              @csrf
              <div class="card-body">
                <div class="form-group"><br>
                  <label for="exampleInputFile ">File input</label>
                  <div class="input-group">
                  <div class="custom-file">
                  <input type="file" class="custom-file-input" id="exampleInputFile" name="image">
                  <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
                  <div class="input-group-append">
                  <span class="input-group-text">Upload</span>
                  </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="option"></label>
                    <select id="option"  class="form-control" aria-label="Default select example" name="category_id">
                      <option value="" selected = "false">اختر فئة الإعلان</option>
                        @foreach ($data as $category) 
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

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