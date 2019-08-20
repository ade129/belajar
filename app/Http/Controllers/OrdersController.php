<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Orders;
use App\Models\Items;
use App\Models\OrdersDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('admin');
    }

    public function index()
    {
        $contents = [
            'orders' => Orders::all(),
        ];
        // return $contents;
        $pagecontent = view('orders.list',$contents);

        //masterpage

        $pagemain = array(
            'title' => 'Orders',
            'menu' => 'list_orders',
            'submenu' => '',
            'pagecontent' => $pagecontent
            );

        return view('masterpage', $pagemain);
    }

    public function create_page()
    
    {
        $contents = [
            'items' => Items::where('active', true)->get(),
        ];

        //return $contents;
        $pagecontent = view('orders.create',$contents);
    
        //masterpage

        $pagemain = array(
            'title' => 'Orders-Create',
            'menu' => 'orders',
            'submenu' => '',
            'pagecontent' => $pagecontent
        );
        return view('masterpage', $pagemain);

   }

   public function save_page(Request $request)
   {
     $request->validate([
         'due_date' => 'required',
         'description' => 'required',
     ]);
    // return $request->all();
    $OrdersDetails = $request->idordersdetails;
    $quantity = $request->quantity;
    $items = $request->iditems;
    $itm = count($items);
    //
    for ($i=0; $i < $itm; $i++) {
       if ($items[$i] == 0) {
        return redirect()->back()->with('status_error', 'Items empty');
       }elseif ($quantity[$i] == 0) {
        return redirect()->back()->with('status_error', 'Quantity empty');
       }
    }
    $saveOrders = new Orders;
    $saveOrders->code = $this->get_code();
    $saveOrders->date_orders = date('Y-m-d H:i:s');
    $saveOrders->due_date = $request->due_date;
    $saveOrders->idusers = Auth::user()->idusers;
    $saveOrders->description = $request->description;
    $saveOrders->status = 'p';
    $saveOrders->save();
    //
      for ($i=0; $i < $itm  ; $i++) {
        $saveOrdersDetails = new OrdersDetails;
        $saveOrdersDetails->idorders = $saveOrders->idorders;
        $saveOrdersDetails->iditems = $items[$i];
        $saveOrdersDetails->quantity = $quantity[$i];
        $saveOrdersDetails->save();
        }
        return redirect('orders')->with('status_success','Orders updated'); 
    }
    
    public function update_page(Orders $order)
    {
             $titit = Orders::with([
            'order_detail' => function($auo){ 
               $auo->with('items'); 
            }
        ])->where('idorders', $order->idorders)
        ->first();
        //return $titit;

        $contents = [
            'order' => $order,
            'items' => Items::where('active', true)->get(),
        ];

        //return $contents;
        $pagecontent = view('orders.update',$contents);
    
        //masterpage

        $pagemain = array(
            'title' => 'Orders-Create',
            'menu' => 'orders',
            'submenu' => '',
            'pagecontent' => $pagecontent
        );
        return view('masterpage', $pagemain);

    }

    public function update_save(Request $request, Orders $order)
    {
      $order_details = $request->idordersdetails;
      $quantity = $request->quantity;
      $items = $request->iditems;
      $itm = count($items);
      //
      for ($i=0; $i < $itm; $i++) {
         if ($items[$i] == 0) {
          return redirect()->back()->with('status_error', 'Items empty');
         }elseif ($quantity[$i] == 0) {
          return redirect()->back()->with('status_error', 'Quantity empty');
         }
      }
      $saveOrders = Orders::find($order->idorders);
      $saveOrders->date_orders = date('Y-m-d H:i:s');
      $saveOrders->due_date = $request->due_date;
      $saveOrders->description = $request->description;
      $saveOrders->save();    
      
      for ($i=0; $i < $itm; $i++) {
        if($order_details[$i] == 'new'){
            $saveOrdersDetails = new OrdersDetails;
            $saveOrdersDetails->idorders = $saveOrders->idorders;
        }
        else{
            $saveOrdersDetails = OrdersDetails::find($order_details[$i]);
            }        
        $saveOrdersDetails->iditems = $items[$i];
        $saveOrdersDetails->quantity = $quantity[$i];
        $saveOrdersDetails->save();
        }
        return redirect('orders')->with('status_success', 'Orders updated');

    }
    
    protected function get_code()
    {
        $date_ym = date('ym');
        $date_between = [date('Y-m-01 00:00:00'), date('Y-m-t 23:59:59')];

        $dataOrders = Orders::select('code')
            ->whereBetween('created_at',$date_between)
            ->orderBy('code',   'desc')
            ->first();

        if(is_null($dataOrders)) {
            $nowcode = '00001';
        } else {
            $lastcode = $dataOrders->code;
            $lastcode1 = intval(substr($lastcode, -5))+1;
            $nowcode = str_pad($lastcode1, 5, '0', STR_PAD_LEFT);
        }

        return 'PO-'.$date_ym.'-'.$nowcode;
    }

}

