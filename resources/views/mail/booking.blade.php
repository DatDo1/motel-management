<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../admin/assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title></title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../admin/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../admin/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../admin/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../admin/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../admin/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../admin/assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../admin/assets/js/config.js"></script>
  </head>

  <body>

    <div class="container">
      <div class="bg-info mx-auto">
        <div class="card m-3">
          <div class="content-wrapper ">

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><span>Shaga Hotel xin chào,</h4>

              <div class="row">
                <div>
                    Bạn mới tiến hành lựa chọn phòng để booking.
                </div>
                <div>
                    Vui lòng xác nhận lại thông tin những phòng đã đặt và thực hiện tiền thanh toán đặt cọc phòng.
                </div>
              </div>
              <div class="row">
                Thông tin khách hàng
              </div>

              <div class="row">
                <div class="col-md-2">Họ và tên khách hàng</div>
                <div class="col-md-2">{{($data['customer']->first_name)!=null ? $data['customer']->first_name:""}} {{$data['customer']->last_name}}</div>
              </div>
              <div class="row">
                <div class="col-md-2">CMND/CCCD</div>
                <div class="col-md-2">{{$data['customer']->citizen_identification}}</div>
              </div>
              <div class="row">
                <div class="col-md-2">Số điện thoại</div>
                <div class="col-md-2">{{$data['customer']->phone_number}}</div>
              </div>
              <div class="row">
                <div class="col-md-2">Địa chỉ</div>
                <div class="col-md-2">{{$data['customer']->address}}</div>
              </div>


              <table class="table">
                <thead>
                  <tr>
                    <th>Phòng</th>
                    <th>Ngày đến</th>
                    <th>Ngày đi</th>
                    <th>Số tiền</th>
                  </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                  @foreach ($data['roomBookingList'] as $roomBooking)
                    <tr>
                      <td>{{$roomBooking['roomName']}}</td>
                      <td>{{$roomBooking['roomBooking']['checkin_date']}}</td>
                      <td>{{$roomBooking['roomBooking']['checkout_date']}}</td>
                      <td>{{$roomBooking['roomBooking']['pay_price']}}</td>   
                  
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- / Content -->


          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>
    </div>

    <br>    
    <div>
      Xin cảm ơn vì đã lựa chọn và tin tưởng chúng tôi. <br>
      Trân trọng, <br>
      Shaga Hotel
    </div>
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../admin/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../admin/assets/vendor/libs/popper/popper.js"></script>
    <script src="../admin/assets/vendor/js/bootstrap.js"></script>
    <script src="../admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../admin/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="../admin/assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
