<div class="container">
    <div class="row">
        <div class="col-lg-12">

            <div action="#" class="filter__form custom-form">
                <div class="filter__form__item col-md-3">
                    <p>Ngày đến</p>
                    <div class="filter__form__datepicker">
                        <input type="date" class="" id="checkin_date" min="<?php echo date('Y-m-d'); ?>" value=<?php echo date('Y-m-d'); ?>>
                    </div>
                </div>
                <div class="filter__form__item col-md-3">
                    <p>Ngày đi</p>
                    <div class="filter__form__datepicker">
                        <input type="date" class="" id="checkout_date" min="<?php echo date('Y-m-d'); ?>" value=<?php echo date('Y-m-d'); ?>>
                    </div>
                </div>
                <div class="filter__form__item filter__form__item--select">
                    {{-- <p>Người lớn</p>
                    <div class="filter__form__select">
                        <select name="adult_quantity" id="adult_quantity">
                            <option value="3">3 Người</option>
                            <option value="2">2 Người</option>
                            <option value="1">1 Người</option>
                        </select>
                    </div> --}}
                </div>
                <div class="filter__form__item filter__form__item--select">
                    {{-- <p>Trẻ em</p>
                    <div class="filter__form__select">
                        <select name="children_quantity" id="children_quantity">
                            <option value="3">3 Người</option>
                            <option value="2">2 Người</option>
                            <option value="1">1 Người</option>
                        </select>
                    </div> --}}
                </div>
                <div class="col-md-2">
                    <div id="btn-empty" buttonType="2" onclick="findmyall(this)" class="btn label label-yellow custom-btn-search-room">
                      <i class='bx bx-search-alt-2'></i> Tìm phòng
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>