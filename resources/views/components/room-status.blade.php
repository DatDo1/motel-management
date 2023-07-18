@if ($status == '0')
    <td>
        <i class="fab fa-angular fa-lg text-danger me-3"></i>
        <span class="label label-success">Còn trống</span>
    </td>
@elseif($status == '1')
    <td>
        <i class="fab fa-angular fa-lg text-danger me-3"></i>
        <span class="label label-danger">Đã đặt</span>
    </td>
@elseif($status == '2')
    <td>
        <i class="fab fa-angular fa-lg text-danger me-3"></i>
        <span class="label label-default">Đang chờ xử lý</span>
    </td>
@endif