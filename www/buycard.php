<div class="modalo" id="modalo" style="width:100%">
    <div class="modalo-container">
        <div class="container">
            <div class="row">
                <div class="col-md-12 border rounded" style="padding: 0">
                    <div style=" background-color:#ee4d2d;color: white; padding: 15px 0px;position:relative"
                        class="header-modal">
                        <h5 class="text-center mb-3" style="font-size: 25px">Mua thẻ điện thoại</h5>
                        <i class="fa fa-times" style="font-size:25px;position:absolute;top:10%;right:2%"
                            id="close" onclick="clickclose()"></i>
                    </div>
                    <form action="" method="POST" style="background-color: #fff;font-size:15px" id="myForm">
                        <div class="px-3">
                            <div class="form-group">
                                <legend class="col-form-label" style="font-size:20px">Mệnh giá</legend>
                                <div class="custom-control custom-radio radioprice" style="margin-bottom: 5px;"
                                    id="pr7">
                                    <input type="radio" class="custom-control-input value" id="pr1" name="pricecard"
                                        onclick="handleClick(this)" data-in="num" value="10000">
                                    <label class="custom-control-label" style="color: #797a7a; " for="pr1"
                                        id="pr1">10,000đ</label>
                                </div>
                                <div class="custom-control custom-radio" style="margin-bottom: 5px;">
                                    <input type="radio" class="custom-control-input value" id="pr2" name="pricecard"
                                        onclick="handleClick(this)" data-in="num" value="20000">
                                    <label class="custom-control-label" style="color: #797a7a; " for="pr2"
                                        id="pr2">20,000đ</label>
                                </div>
                                <div class="custom-control custom-radio" style="margin-bottom: 5px;">
                                    <input type="radio" class="custom-control-input value" id="pr3" name="pricecard"
                                        onclick="handleClick(this)" data-in="num" value="50000">
                                    <label class="custom-control-label" style="color: #797a7a; " for="pr3"
                                        id="pr3">50,000đ</label>
                                </div>
                                <div class="custom-control custom-radio" style="margin-bottom: 5px;">
                                    <input type="radio" class="custom-control-input value" id="pr4" name="pricecard"
                                        onclick="handleClick(this)" data-in="num" value="100000">
                                    <label class="custom-control-label" style="color: #797a7a; " for="pr4"
                                        id="pr4">100,000đ</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <legend class="col-form-label" style="font-size:20px">Nhà mạng</legend>
                                <select name="nhamang" class="custom-select" style="font-size:15px">
                                    <option selected value="viettel">Viettel</option>
                                    <option value="mobifone">Mobifone</option>
                                    <option value="vinaphone">Vinaphone</option>
                                </select>
                            </div>
                            <div class="form-group choosecc">
                                <legend class="col-form-label " style="font-size:20px">Số lượng thẻ</legend>
                                <select name="soluong" class="custom-select value" style="font-size:15px" id="countcard"
                                    onchange="choosecount(this)">
                                    <option selected value="1" selected>1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>
                        <div style="background-color: #fffefb;padding-bottom:15px">
                            <div style=" border-top: 1px dashed rgba(0, 0, 0, 0.09); margin-bottom: 20px;">
                            </div>
                            <div style="text-align:center;width: fit-content;margin: 0 auto;">
                                <input id="total" placeholder="Thanh toán"
                                    style="text-align: center;background-color: #ee4d2d;color: white;border-radius: 3px;margin-bottom: 20px;padding: 10px;font-size: 15px;display:none" />
                            </div>

                            <div style="display: flex;justify-content: center;">
                                <button class="btn btn-success px-5 mr-2" type="submit" style="font-size: 15px;"
                                    name="thanhtoan" id="thanhtoan" onclick="thanhtoan()">Thanh toán</button>
                                <button class="btn btn-outline-primary px-5" type="reset" style="font-size: 15px;"
                                    onclick="clicknew()">Làm mới</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>