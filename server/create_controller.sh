#!/bin/bash

# Laravelプロジェクトのベースディレクトリを指定
laravel_project_dir="."

# コントローラーの名前を指定
controller_names=(
    "AdminAllocateCoopDeliveryTask"
    "AdminEditAdminDrone"
    "AdminEditCoopDroneInfo"
    "AdminEditCoopInfo"
    "AdminEditCoopPayInfo"
    "AdminEditUserInfo"
    "AdminEditUserPayInfo"
    "AdminLogin"
    "AdminLogout"
    "AdminRegisterAdminDrone"
    "AdminSendCoopBill"
    "AdminSendUserBill"
    "AdminViewCoopApplyDroneLendList"
    "AdminViewCoopDroneInfo"
    "AdminViewCoopInfo"
    "AdminViewCoopList"
    "AdminViewCoopPayInfo"
    "AdminViewCoopStatisticsInfo"
    "AdminViewUserDeliveryRequestList"
    "AdminViewUserDeliveryRequestList"
    "AdminViewUserInfo"
    "AdminViewUserList"
    "AdminViewUserPayInfo"
    "AdminViewUserStatisticsInfo"
    # "CoopLogin"
    # "CoopLogout"
    # "CoopRegistrationRequest"
    # "CoopEditCoopInfo"
    # "CoopDeliveryRequestList"
    # "CoopDroneList"
    # "CoopDroneRegistration"
    # "CoopChildAccountList"
    # "CoopCreateChildAccount"
    # "CoopDroneLentRequest"
    # "CoopWithdraw"
    # "CoopDroneInfoList"
    # "UserLogin"
    # "UserLogout"
    # "UserRegistration"
    # "UserEditInfo"
    # "UserDeliveryPlaceRequest"
    # "UserDeliveryRequest"
    # "UserDeliveryRequestList"
    # "UserFavoritesList"
    # "UserFavoritesRegistor"
    # "UserReceiveNoticeCompleteDelivery"
    # "UserWithdraw"
)

# LaravelのArtisanコマンドでコントローラーファイルを生成
for controller_name in "${controller_names[@]}"; do
    php artisan make:controller "${controller_name}Controller"
    echo "Created: ${laravel_project_dir}/app/Http/Controllers/Admin/${controller_name}Controller"
done
