@if ($userRole == 1)
    <small class="text-muted">Admin</small>  
@elseif ($userRole == 2)
    <small class="text-muted">Nhân viên</small>  
@else
    <small class="text-muted">Khách hàng</small>  
@endif

