@extends('coop.app')

@section('title', '依頼一覧')

@section('style')
<link rel="stylesheet" href="{{ asset('css/coop/CoopList.css') }}">
<style>
 .current {
     background-color: #ffffff;
     height: 20pt;
     text-align: center;
 }
</style>
@endsection

@section('script')
@endsection

@php
$currentPage = 'coopDeliveryRequestList'
@endphp

@section('content')
<div class = "main">
    <div class ="flex-main">                        
        <p><h2><font color ="#408A7E"><u> 依頼一覧 </u></font></h2></p>
        @if(empty($mergedData))
            <p>依頼が存在しません</p>
        @else
        <table class ="coop">
            <thead>
                <tr>
                    <th>依頼番号</th>
                    <th>送り主情報</th>
                    <th>受け取り主情報</th>
                    <th>集荷会社情報</th>
                    <th>中間配達会社情報</th>
                    <th>配送会社情報</th>
                    <th>配達完了</th>
                </tr>
            </thead>                                    
            <tbody>
                @foreach ($mergedData as $index => $deliveryInfo)
                    <tr>
                        <td>{{ $deliveryInfo['id'] }}</td>
                        <td><a href="{{ route('coop.viewUserInfo', ['id' => $deliveryInfo['user_id']]) }}" style="color:blue; text-decoration:none">{{ $deliveryInfo['user_name'] }}</td>
                        <td><a href="{{ route('coop.viewUserInfo', ['id' => $deliveryInfo['delivery_destination_id']]) }}" style="color:blue; text-decoration:none">{{ $deliveryInfo['delivery_destination_name'] }}</td>
                        <td><a href="{{ route('coop.viewCoopInfo', ['id' => $deliveryInfo['collection_company_id']]) }}" style="color:blue; text-decoration:none">{{ $deliveryInfo['collection_company_name'] }}</td>
                        <td><a href="{{ route('coop.viewCoopInfo', ['id' => $deliveryInfo['intermediate_delivery_company_id']]) }}" style="color:blue; text-decoration:none">{{ $deliveryInfo['intermediate_delivery_company_name'] }}</td>
                        <td><a href="{{ route('coop.viewCoopInfo', ['id' => $deliveryInfo['delivery_company_id']]) }}" style="color:blue; text-decoration:none">{{ $deliveryInfo['delivery_company_name'] }}</td>
                        <td><button type="button">
                            <a href="{{ route('coop.coopDeliveryRequestListDelete', ['id' => $deliveryInfo['id']]) }}">
                                <img src="{{ asset('image/img_approval.png') }}" alt="受領" width="20" height="20"></a></button></td>
                    </tr>
                    @endforeach
            </tbody>                           
        </table>
        @endif
    </div>
</div>
@endsection
