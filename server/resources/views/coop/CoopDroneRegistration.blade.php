@extends('coop.app')

@section('title', 'ドローン登録')

@section('style')
<link rel="stylesheet" href="{{ asset('css/common/Register.css') }}">
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
$currentPage = 'coopRegisterDrone'
@endphp

@section('content')
<div class="contents">
    @if ($errors->any())
        <div>
            <strong>入力エラーがあります。</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div>
            <p>{{ session('success') }}</p>
        </div>
    @endif
    <div class="inputs">
        <form action="{{ route('coop.registerDrone') }}" method="POST">
            @csrf
            <h2>ドローン登録フォーム</h2>

            <label for="drone_type_id">ドローン選択</label>
                <select name="drone_type_id" required>
                    @foreach ($Drone as $drone)
                        <option value="{{ $drone["id"] }}">{{ $drone['name'] }}</option>
                    @endforeach
                </select>
            <br>

            <label for="operatingTime">稼働時間</label>
            <input type="text" id="operatingTime" name="operating_time" required><br>

            <label for="purchaseDate">購入時期</label>
            <input type="date" id="purchaseDate" name="purchase_date" required><br>
            <div class="regist"><button type="submit">登録</button></div>
        </form>
    </div>
</div>
@endsection
