<section class="content-header">
        <h1>
            Orders
            <small></small>
            </h1>
            <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><i class="fa fa-first-order"></i> Orders</li>
            <li class="active"><i class="fa fa-plus"></i> Update</a></li>
            </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
    
            <!-- Default box -->
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Update</h3>
              </div>
              <div class="box-body">
                    {{ Form::open(array('url' => 'orders/update/'.$order->idorders, 'class' => 'form-horizontal')) }}
                          <div class="form-group">
                  <div class="col-sm-2 control-label">
                    <label class="">Code</label>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" value="{{$order->code}}" class="form-control" readonly>
                  </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-2 control-label">
                        <label class="">Due Date</label>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                        <input type="text" class="form-control datepicker pull-right" name="due_date" id="date" data-date-format='yyyy-mm-dd' value="{{date('Y-m-d',strtotime($order->date_orders))}}" autocomplete="off">
                        </div>
                    </div>
                </div>
    
                <div class="form-group">
                    <div class="col-sm-2 control-label">
                        <label class="">Description</label>
                    </div>
                        <div class="col-sm-6">
                            <textarea name="description" rows="3"  class="form-control" required>{{$order->description}}</textarea>
                            <br>
                            <a class="pull-right btn btn-primary btn-xs" id="addRow"> <i class="fa fa-plus"></i> Add</a>
                        </div>
                </div>
    
                <div class="form-group">
                        <div class="col-sm-7 col-sm-offset-1">
                          <div class="table-responsive">
                            <table class="table table-bordered " style="border: 2px solid #d2d6de !important;" id="table">
                              <tbody>
                              @foreach ($order->order_detail as $index => $titit)                               
                              <tr>
                                  <td style="border: 1px solid #d2d6de !important; text-align:center ">
                                  <label>{{$index+1}}</label><br>
                                  <a class="btn btn-xs del"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                  <input type="hidden" value="{{$titit->idordersdetails}}" name="idordersdetails[]">
                                </td>
                                  <td  style="border: 1px solid #d2d6de !important; ">
                                    <small><strong>Items</strong></small>
                                  <select class="form-control select2" name="iditems[]" id="iditems{{$index+1}}">
                                      <option>- select items -</option>
                                      @foreach ($items as $item)
                                       <option value="{{$item->iditems}}" @if ($item->iditems == $titit->iditems)
                                           selected
                                       @endif >{{$item->nameitems}}</option>
                                      @endforeach
                                       </select>  
                                  </td>
                                  <td  style="border: 1px solid #d2d6de !important; ">
                                    <small><strong>Quantity</strong></small>
                                    <input type="number" name="quantity[]" class="form-control"  id="quantity{{$index+1}}" value={{$titit->quantity}}>
                                  </td>
                                </tr>
                                @endforeach
                            </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                
                    <div class="form-group">
                            <label class="col-sm-1 control-label"></label>
                            <div class="col-sm-2 col-sm-offset-6">
                              <input type="submit" id="btn-save" value="Save" class="btn btn-success" >
                            </div>
                    </div>
                    {{ Form::close() }}
                </div>
            <input type="hidden" id="appendindex" value="{{$order->order_detail->count()+1}}">     
            </section>
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
            <script>
            var iditems = '';
            @foreach ($items as $item)
            iditems += "<option value='{{$item->iditems}}'>{{$item->nameitems}}</option>";
          @endforeach
    
          $('#addRow').on('click', function(){
          var ais = $('#appendindex').val();
          $('#appendindex').val(parseInt(ais)+1);
          //delete row
        $('#table').on('click', '.del' ,function(){
          $(this).closest('tr').remove();
        });
          //add row 
          $('#table').append('<tr>'
              +'<td style="border: 1px solid #d2d6de !important; text-align:center">'
                +'<label>'+ais+'</label><br>'
                +'<input type="hidden" value="new" name="idordersdetails[]">'
                +'<a class="btn btn-xs del"><i class="fa fa-trash" aria-hidden="true"></i></a>'
              +'</td style="border: 1px solid #d2d6de !important; ">'
              +'<td style="border: 1px solid #d2d6de !important; ">'
                +'<small><strong>Items</strong></small>'
                +'<select class="form-control select2" name="iditems[]" id="iditems_'+ais+'"> <option>- select items -</option>'+iditems+
                +'</select>'
              +'</td>'
              +'<td style="border: 1px solid #d2d6de !important; ">'
                +'<small><strong>Quantity</strong></small>'
                +'<input type="number" name="quantity[]" class="form-control"  id="quantity_'+ais+'">'
              +'</td>'
            +'</tr>'
            );
    
        })
        </script>