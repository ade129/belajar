<section class="content-header">
    <h1>Level</h1>
    <ol class="breadcrumb">
      <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"><i class="fa fa-inbox"></i>Level</li>
    </ol>
</section>

<section class="content">

{{-- default box --}}
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Index</h3>
        <div class="box-tools pull-right">
            <a href="{{url('levels/create-new')}}" class="btn btn-box-tool" title="Create New"><i class="fa fa-plus"></i>Create New</a>
        </div>
    </div>
    <div class="box-body table-responsive">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Created By</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($levels as $ade)
                <tr>
                    <td>{{$ade->idlevels}}</td>
                    <td>{{$ade->code}}</td>
                    <td>{{$ade->name}}</td>
                    <td>{{$ade->description}}</td>
                    <td>{{$ade->created_by}}</td>
                    <td>
                        <center>
                            @if ($ade->active)
                            <span class="label label-success">Active</span>
                            @else
                            <span class="label label-danger">Inactive</span>
                            @endif
                        </center>
                    </td>
                    <td>
                        <center>
                            <a href="{{url('/levels/update/'.$ade->idlevels)}}"><i class="fa fa-pencil-square-o"></i></a>
                        </center>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>

    </div>
    
        
</div>
</section>