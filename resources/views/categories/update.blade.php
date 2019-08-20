<section class="content-header">
    <h1>
        Categories
        <small>Master</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i>Home</a>
        <li class="active"><i class="fa fa-database"></i>Master</a>
        <li><a href="{{url('/categories')}}"><i class="fa fa-cubes"></i>Categories</a>
        <li class="active"><i class="fa fa-pencil"></i>Update</a>
    </ol>
</section>

{{-- main content --}}
<section>

    {{-- default box --}}
    <section class="content">

            <!-- Default box -->
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Update</h3> 
                <button type="button" class="btn btn-info btn-xs pull-right" data-toggle="modal" data-target="#myModal">Delete</button>

              </div>
              <div class="box-body">
                {{ Form::open(array('url' => 'categories/update/'.$categories->idcategories, 'class' => 'form-horizontal')) }}
                <div class="form-group">
                  <label class="col-sm-2 control-label">Name</label>
                  <div class="col-sm-10">
                    {{-- name="name" untuk melempar controller ke database --}}
                    <input type="text" class="form-control" value="{{$categories->name}}"  name="name" required>
                  </div>
                </div>
                <hr>
                <div class="form-group">
                  <label class="col-sm-2 control-label"></label>
                  <div class="col-sm-10">
                    <a href="{{url('categories')}}" class="btn btn-warning pull-right">Back</a>
                    <input type="submit" value="Save" class="btn btn-primary">
                  </div>
                </div>
                {{ Form::close() }}
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          
          </section>
            {{-- <script type="text/javascript">
            $(document).ready(function() {
             $('.datepicker').datepicker();
            });
          </script> --}}
          
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Warning</h4>
        </div>
        <div class="modal-body">
          <p>Sure To Delete This Categories?</p>
        </div>
        <div class="modal-footer">
         {{ Form::open(array('url' => 'categories/delete/'.$categories->idcategories, 'method'=>'delete','class' => 'form-horizontal')) }}
         <input type="submit" class="btn btn-danger" value="Yes"> 
         <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
         {{ Form::close() }}
        </div>
      </div>
      
    </div>
  </div>
  



