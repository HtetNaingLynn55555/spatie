@extends('master.master')

@section('content')

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <a href="{{route('roleIndex')}}">
            <svg xmlns="http://www.w3.org/2000/svg" width="45" height="30" fill="currentColor" class="bi bi-arrow-left-square text-primary" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
              </svg></a>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Role</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <div class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Creating Role</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{route('roleUpdate',$role->id)}}">
                    @csrf
                    @method('PUT')
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Name</label>
                      <input type="hidden" name="id" value="{{$role->id}}">
                      <input type="text" name="name" class="form-control" id="exampleInputEmail1" value="{{old('name',$role->name)}}" >
                    </div>
                    <label for="permission" class="form-check-label"> Permission </label>
                    @foreach ($permissions as $permission)


                    <div class="form-check">
                        <input type="checkbox"
                        class="form-check-input"
                        name="permissions[]"
                        value="{{$permission->name}}"
                        {{ ( array_search( $permission->id, $rolePermissions ) === false ) ? '':'checked'}}
                        id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">{{$permission->name}}</label>
                      </div>
                    @endforeach

                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
              <!-- /.card -->
            </div>
        </div>
    </div>
  </div>

@endsection
