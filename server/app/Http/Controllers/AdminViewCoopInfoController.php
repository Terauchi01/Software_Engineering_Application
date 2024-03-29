<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CoopUser;
use App\Models\CoopLocation;
use App\Models\AccountInformation;
use App\Models\MstPrefecture;
use App\Models\Cities;
use App\Models\LicenseInformation;

class AdminViewCoopInfoController extends Controller
{
    public function adminViewCoopInfo (Request $request){
        $id = $request->input('id');
        $coop = CoopUser::find($id);

        if ($coop && $coop->deletion_date === null) {
            // dd($coop->license_information_id);
            $acc = AccountInformation::find($coop->account_information_id);
            $loc = CoopLocation::where('coop_user_id', $id)->first();
            $license = LicenseInformation::find($coop->license_information_id);
            $prefecture = MstPrefecture::find($loc->prefecture_id)['name'];
            $city = Cities::find($loc->city_id)['name'];
            $coopId = $coop->id;
            $coopName = $coop->coop_name;
            $lor = [
                1 => '陸運',
                2 => '空運'
            ];
            $data = [
                'email' => $coop->email_address,
                'password' => '**********',
                'name' => $coop->representative_last_name . $coop->representative_first_name,
                'kanaName' => $coop->representative_last_name_kana . $coop->representative_first_name_kana,
                'postal_code' => $loc->postal_code,
                'address' => $prefecture . ' ' . $city . ' ' . $loc->town . ' ' . $loc->block,
                'date_of_issue' => \Carbon\Carbon::parse($license->date_of_issue)->toDateString(),
                'date_of_registration' => \Carbon\Carbon::parse($license->date_of_registration)->toDateString(),
                'license_name' => $license->name,
                'license_birth' => \Carbon\Carbon::parse($license->birth)->toDateString(),
                'conditions' => $license->conditions,
                'classification' => $license->classification,
                'ratings_and_limitations' => $license->ratings_and_limitations1 . ' ' . $license->ratings_and_limitations2 . ' ' . $license->ratings_and_limitations3,
                'bank_id' => $acc->bank_id,
                'branch_id' => $acc->branch_id,
                'account' => $acc->account_type . ' ' . $acc->account_number,
                'worker' => $coop->employees . '人',
                'phone' => $coop->phone_number,
                'land_or_air' => $lor[$coop->land_or_air],
            ];
            return view('admin.AdminViewCoopInfo', compact('coopName', 'coopId', 'data'));
        }
        
        $coopName = '存在しないユーザです';
        $coopId = null;
        return view('admin.AdminViewCoopInfo', compact('coopName', 'coopId'));
    }
}
