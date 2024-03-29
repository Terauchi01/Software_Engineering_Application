@extends('admin.app')

@section('title', '事業者情報詳細')

@section('style')
<link rel="stylesheet" href="{{ asset('/css/admin/AdminInfo.css') }}">
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    var bankId = {{ intval($data['bank_id'], 10) }};
    var branchId = {{ intval($data['branch_id'], 10) }};
</script>
<script src="{{ asset('js/common/view_bank.js') }}"></script>
@endsection

@php
$currentPage = 'adminViewCoopList'
@endphp

@section('content')
<div class="info">
    <p class="information"><h2><font color ="#408A7E"><u>事業者情報詳細</u></font></h2></p>
    <p class="name">{{ $coopName }}</p>
    @if($coopId !== null)
    <p class="id">ID : {{ $coopId }}</p>
    <form action="{{ route('admin.adminEditCoopInfo',["id"=>$coopId]) }}" method="get">
        <input type="hidden" name="id" value="{{ $coopId }}">
        <button type="submit" class="edit">編集する</button>
    </form>
    <table>
        <tr>
            <th>メールアドレス</th>
            <th>{{ $data['email'] }}</th>
        </tr>
        <tr>
            <th>パスワード</th>
            <th>{{ $data['password'] }}</th>
        </tr>
        <tr>
            <th>事業者代表名</th>
            <th>{{ $data['name'] }}</th>
        </tr>
        <tr>
            <th>事業者代表名カナ</th>
            <th>{{ $data['kanaName'] }}</th>
        </tr>
        <tr>
            <th>事業拠点情報</th>
            <th>
                〒{{ $data['postal_code'] }}<br>
                {{ $data['address'] }}
            </th>
        </tr>
        <tr>
            <th>営業形態</th>
            <th>{{ $data['land_or_air'] }}</th>
        </tr>
        <tr>
            <th>免許情報</th>
            <th>
                交付日 {{ $data['date_of_issue'] }}<br>
                登録日 {{ $data['date_of_registration'] }}<br>
                交付者 {{ $data['license_name'] }}<br>
                交付者生年月日 {{ $data['license_birth'] }}<br>
                条件 {{ $data['conditions'] }}<br>
                区分 {{ $data['classification'] }}<br>
                限定事項 {{ $data['ratings_and_limitations'] }}
            </th>
        </tr>
        <tr>
            <th>口座情報</th>
            <th><div id="bankInfo"></div><div id="branchInfo"></div>{{ $data['account'] }}</th>
        </tr>
        <tr>
            <th>従業員人数</th>
            <th>{{ $data['worker'] }}</th>
        </tr>
        <tr>
            <th>電話番号</th>
            <th>{{ $data['phone'] }}</th>
        </tr>
    </table>
    @endif
</div>
@endsection