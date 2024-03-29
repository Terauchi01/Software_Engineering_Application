<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeliveryRequest;
use App\Models\CoopUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserDeliveryRequestListController extends Controller
{
    public function userDeliveryRequestList (){
        $A = 'users';
        $userId = Auth::guard($A)->id();
        $list = DeliveryRequest::select(
            'delivery_request.id',
            'delivery_request.item',
            'delivery_request.user_id',
            'delivery_request.delivery_destination_id',
            'delivery_request.delivery_status',
            'delivery_request.delivery_date',
        )            
            ->where('delivery_request.deletion_date', '=', null)
            ->where('delivery_request.user_id', "=" , $userId)
            ->orWhere('delivery_request.delivery_destination_id' , "=" , $userId)
            ->orderBy('delivery_request.id', 'asc')
            ->get();
        
        $mergedData = [];
        $sendName = User::pluck('user_last_name', 'id')->toArray();
        $receiveName = User::pluck('user_last_name', 'id')->toArray();
        $deliveryStatus = ['未割り振り', '割り振り済', '配達中', '配達中', '配達完了'];
        foreach ($list as $item) {         
            $mergedData[] = [
                'id' => $item->id,
                'item' => $item->item,
                'user_id' => $sendName[$item->user_id],
                'delivery_destination_id' => $receiveName[$item->delivery_destination_id],
                'delivery_status' => $deliveryStatus[$item->delivery_status],
                'delivery_date' => $item->delivery_date
            ];
        }
        
        return view('user.UserDeliveryRequestList', compact('mergedData'));
    }
    public function delete(Request $request, $id)
    {
        $B = DeliveryRequest::class;
        $currentDateTime = Carbon::now();
        $B::where('id',$id)->update(['deletion_date' => $currentDateTime]);
        return redirect()->route('user.userDeliveryRequestList');
    }
}
