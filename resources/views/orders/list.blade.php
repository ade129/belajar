<section class="content-header">
        <h1>Order</h1>
        <ol class="breadcrumb">
          <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active"><i class="fa fa-cubes"></i> Order</li>
        </ol>
    </section>
    
    <section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Index</h3>
            <div class="box-tools pull-right">
         </div>
    </div>
    <div class="box-body table-responsive">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Code</th>
                    <th>due_date</th>
                    <th>date_orders</th>
                    <th>Received By</th>
                    <th>Accepted By</th>
                    <th>Status</th>
                    <th>Action</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $number => $order)
                <tr>
                        <td><center>{{$number++}}</center></td>
                        <td>{{$order->code}}</td>
                        <td>{{date('d M Y', strtotime($order->due_date))}}</td>
                        <td>{{date('d M Y', strtotime($order->date_orders))}}</td>
                        <td>
                          {{-- <center>{{$user->name}}</center> --}}
                        </td>
                        <td>
                          <center>
                            @if (isset($order->received))
                              {{$order->received->users->name}}
                            @else
                              -  
                            @endif
                          </center>
                        </td>
                        <td>
                          <center>
                            @if (isset($order->accepted))
                              {{$order->accepted->users->name}}
                            @else
                              - 
                            @endif
                          </center>
                        </td>
        
                        <td>
                          <center>
                            @if ($order->status == 'p')
                              <span class="label label-default">Pending</span>
                            @elseif($order->status == 'w')
                              <span class="label label-warning">Wait</span>
                            @elseif($order->status == 'a')
                              <span class="label label-success">Accepted</span>
                            @elseif($order->status == 'f')
                              <span class="label label-danger">Failed</span>
                            @endif
                          </center>
                        </td>
                        <td>
                          <a href="{{url('/orders/update/'.$order->idorders)}}" ><i class="fa fa-pencil-square-o"></i></a>
                        </td>
                      </tr>
                      @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        
        </section>
        