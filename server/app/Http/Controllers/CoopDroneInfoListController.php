<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CoopDrones;
use App\Models\DroneType;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CoopDroneInfoListController extends Controller
{
    public function coopDroneInfoList(Request $request) {
        $id = $request->input('id');
        $A = 'coops';
        $userId = Auth::guard($A)->id();
        $query = CoopDrones::select(
            'coop_drones.id',
            'coop_drones.coop_user_id',
            'coop_drones.drone_type_id',
            'coop_drones.drone_status',
            'coop_drones.possession_or_loan'
        )
            ->where('coop_drones.deletion_date', '=', null)
            ->where('coop_drones.coop_user_id', '=', $userId)
            ->orderBy('coop_drones.id', 'asc');
            if ($id != NULL) {
                $query->where('coop_drones.possession_or_loan', '=', $id);
            }
            $list = $query->get();
        
        $mergedData = [];
        $data = DroneType::pluck('name', 'id')->toArray();
        foreach ($list as $item) {
            $droneStatus = ($item->drone_status == 0) ? '待機中' : '稼働中';
            $possessionOrLoan = ($item->possession_or_loan == 0) ? '借用' : '所持';
            $mergedData[] = [
                'id' => $item->id,
                'coop_user_id' => $item->coop_user_id,
                'drone_type_id' => $data[$item->drone_type_id],
                'drone_status' => $droneStatus,
                'possessionOrLoan' => $possessionOrLoan,
                'possession_or_loan' => $item->possession_or_loan,
            ];
        }
        return view('coop.CoopDroneInfoList', compact('mergedData'));
    }

    public function delete(Request $request, $id)
    {
        $B = CoopDrones::class;
        $currentDateTime = Carbon::now();
        $B::where('id',$id)->update(['deletion_date' => $currentDateTime]);
        return redirect()->route('coop.coopDroneInfoList');
    }
}

