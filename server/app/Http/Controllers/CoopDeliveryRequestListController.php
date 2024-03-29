<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MstPrefecture;
use App\Models\Cities;
use App\Models\CoopLocation;
use App\Models\CoopUser;
use App\Models\User;
use App\Models\DeliveryRequest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CoopDeliveryRequestListController extends Controller
{
    public function CoopDeliveryRequestList (){
        $A = 'coops';
        $userId = Auth::guard($A)->id();
        $list = DeliveryRequest::select(
            'delivery_request.id',
            'delivery_request.user_id',
            'delivery_request.delivery_destination_id',
            'delivery_request.collection_company_id',
            'delivery_request.intermediate_delivery_company_id',
            'delivery_request.delivery_company_id',
        )
            ->where('delivery_request.deletion_date', '=', null)
            ->where('delivery_request.delivery_status', '!=', 4)
            ->where(function($query) use ($userId) {
                $query->where('delivery_request.collection_company_id', '=', $userId)
                    ->orWhere('delivery_request.intermediate_delivery_company_id', '=', $userId)
                    ->orWhere('delivery_request.delivery_company_id', '=', $userId);
            })
            ->orderBy('delivery_request.id', 'asc')
            ->get();
        $mergedData = [];
        $sendName = User::pluck('user_last_name', 'id')->toArray();
        $receiveName = User::pluck('user_last_name', 'id')->toArray();
        $joinedData = CoopUser::join('coop_location', 'coop_user.id', '=', 'coop_location.coop_user_id')->get();
        $coop = CoopUser::all();
        $collection = $joinedData->pluck('coop_name', 'id')->toArray();
        $intermediate = $joinedData->pluck('coop_name', 'id')->toArray();
        $delivery = $joinedData->pluck('coop_name', 'id')->toArray();
        foreach ($list as $item) {         
            $mergedData[] = [
                'id' => $item->id,
                'user_name' => $sendName[$item->user_id],
                'user_id' => $item->user_id,
                'delivery_destination_name' => $receiveName[$item->delivery_destination_id],
                'delivery_destination_id' => $item->delivery_destination_id,
                'collection_company_name' => $collection[$item->collection_company_id],
                'intermediate_delivery_company_name' => $intermediate[$item->intermediate_delivery_company_id],
                'delivery_company_name' => $delivery[$item->delivery_company_id],
                'collection_company_id' => $item->collection_company_id,
                'intermediate_delivery_company_id' => $item->intermediate_delivery_company_id,
                'delivery_company_id' => $item->delivery_company_id,
            ];
        }
        return view('coop.CoopDeliveryRequestList', compact('mergedData'));
    }
    public function update(Request $request, $id)
    {
        $B = DeliveryRequest::class;
        $del = $B::where('id',$id)->first();
        $del->update(['delivery_status' => $del->delivery_status+1]);
        if($del->delivery_status == 4){
            $del->update(['delivery_date' => now()->timezone('Asia/Tokyo')]);
        }
        return redirect()->route('coop.coopDeliveryRequestList');
    }
}
