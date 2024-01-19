<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ドローンタイプ一覧</title>
        <link rel="stylesheet" href="{{ asset('css/admin/AdminList.css') }}">
        <style>
         .current {
             background-color: #ffffff;
             height: 40pt;
             text-align: center;
         }
        </style>
    </head>
    
    <body>      
        <div class="side">
            <p><a href="{{ route('admin.adminViewCoopList') }}">事業者情報管理</a></p>           
            <p><a href="{{ route('admin.adminViewCoopApplyDroneLendList') }}">ドローン貸与申請一覧</a></p>
            <p><a href="{{ route('admin.adminViewUserList') }}">利用者情報管理</a></p>
            <p><a href="{{ route('admin.adminViewCoopStatisticsInfo') }}">事業者情報分析</a></p>
            <p><a href="{{ route('admin.adminViewUserStatisticsInfo') }}">利用者情報分析</a></p>
            <p><a href="{{ route('admin.adminAllocateCoopDeliveryTask') }}">宅配依頼一覧</a></p>
            <div class="current">
                <p><a href="{{ route('admin.adminViewDroneType') }}">ドローンタイプ　一覧</a></p>
            </div>
            <p><a href="{{ route('admin.adminViewCoopDeliveryRequestList') }}">事業者宅配一覧</a></p>
            <p><a href="{{ route('admin.adminViewUserDeliveryRequestList') }}">利用者宅配一覧</a></p>
        </div>           
        <div class = "content">
            <div class = "header">
                <select onChange="location.href=value;">
                    <option>管理者</option>
                    <option value="{{ route('admin.adminLogout') }}">ログアウト</option>
                </select>
                <p>admin</p> <!-- ここをユーザ名とする -->
            </div>
            
            <div class = "main">
                <div class ="flex-main">
                    <div class = "coopList"> <!--#408A7E-->
                        <p><h2><font color ="#408A7E"><u> ドローンタイプ一覧 </u></font></h2></p>
                    </div>                   
                    
                    <p>
                        <input type="checkbox" id="masterCheckbox" name="feature_enabled">
                        <label for="masterCheckbox">Select all</label>
                    </p>
                    
                    
                    <table class ="coop">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ドローン番号</th>
                                <th>ドローン種の名前</th>
                                <th>航続距離</th>                          
                                <th>積載重量</th>
                                <th>飛行可能時間</th>
                                <th>数</th>
                                <th>貸出中ドローン</th>
                                <th>編集</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mergedData as $index => $droneInfo)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="itemCheckbox" id="checkbox{{$droneInfo['id']}}" name="selectedCoops[]" value="{{ $droneInfo['id'] }}">
                                    </td>
                                    <td>{{ $droneInfo['id'] }}</td>
                                    <td>{{ $droneInfo['name'] }}</td>
                                    <td>{{ $droneInfo['range'] }}</td>
                                    <td>{{ $droneInfo['loading_weight'] }}</td>
                                    <td>{{ $droneInfo['max_time'] }}</td>
                                    <td>{{ $droneInfo['number_of_drones'] }}</td>
                                    <td>{{ $droneInfo['lend_drones_sum'] }}</td>
                                    <td><button type="button">
                                        <a href="{{ route('admin.adminEditAdminDrone', ['id' => $droneInfo['id']]) }}">
                                            <img src="{{ asset('image/img_edit.png') }}" alt="編集" width="20" height="20"></a></button></td>
                                </tr>
                            @endforeach
                        </tbody>

                        <script>
                         document.getElementById('masterCheckbox').addEventListener('change', function() {
                             var masterCheckbox = this;
                             var itemCheckboxes = document.querySelectorAll('.itemCheckbox');

                             itemCheckboxes.forEach(function(itemCheckbox) {
                                 itemCheckbox.checked = masterCheckbox.checked;
                             });
                         });

                         // 各行のチェックボックスに対するイベントリスナーも追加する場合
                         document.querySelectorAll('.itemCheckbox').forEach(function(itemCheckbox) {
                             itemCheckbox.addEventListener('change', function() {
                                 var allChecked = true;
                                 document.querySelectorAll('.itemCheckbox').forEach(function(checkbox) {
                                     if (!checkbox.checked) {
                                         allChecked = false;
                                     }
                                 });
                                 document.getElementById('masterCheckbox').checked = allChecked;
                             });
                         });
                         
                         function editCoop(coopId) {
                             var confirmation = confirm('編集しますか？ Coop ID: ' + coopId);
                             
                             if (confirmation) {
                                 alert('編集処理を実行します。Coop ID: ' + coopId);
                             }
                         }
                         
                         function confirmDelete(coopId) {
                             if (confirm('本当に削除しますか？')) {
                                 alert('削除ボタンがクリックされました。Coop ID: ' + coopId);
                             }
                         }
                        </script>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>