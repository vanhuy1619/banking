
  $("input[data-type='currency']").on({
    keyup: function () {
      formatCurrency($(this));
    },
    blur: function () {
      formatCurrency($(this), "blur");
    }
  });
  function formatNumber(n) {
    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
  }
  
  function formatCurrency(input, blur) {
    var input_val = input.val();
    if (input_val === "") { return; }
    var original_len = input_val.length;
    var caret_pos = input.prop("selectionStart");
    if (input_val.indexOf(".") >= 0) {
      var decimal_pos = input_val.indexOf(".");
      var left_side = input_val.substring(0, decimal_pos);
      var right_side = input_val.substring(decimal_pos);
      left_side = formatNumber(left_side);
      right_side = formatNumber(right_side);
      if (blur === "blur") {
        right_side += "00";
      }
      right_side = right_side.substring(0, 2);
      input_val = left_side + "." + right_side;
  
    } else {
  
      input_val = formatNumber(input_val);
      input_val = "$" + input_val;
  
  
    }
    input.val(input_val);
    var updated_len = input_val.length;
    caret_pos = updated_len - original_len + caret_pos;
    input[0].setSelectionRange(caret_pos, caret_pos);
  }   

  $('.multiple-items').slick({
    infinite: true,
    autoplay: true,
    slidesToShow: 4,
    slidesToScroll: 3,
    autoplaySpeed: 2000,
    cssEase: 'linear',
    arrows:true
  });


  //RÚT TIỀN
  function checkid() {
    let idcard = document.getElementById('idcard');
    let money = document.getElementById('currency-field');
    if (idcard.value == '111111' || idcard.value == '222222' || idcard.value == '333333')
      money.disabled = false;
    else
      money.disabled = true;
  }

  $("input[data-type='currency']").on({
    keyup: function () {
      formatCurrency($(this));
    },
    blur: function () {
      formatCurrency($(this), "blur");
    }
  });
  function formatNumber(n) {
    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
  }

  function formatCurrency(input, blur) {
    var input_val = input.val();
    if (input_val === "") { return; }
    var original_len = input_val.length;
    var caret_pos = input.prop("selectionStart");
    if (input_val.indexOf(".") >= 0) {
      var decimal_pos = input_val.indexOf(".");
      var left_side = input_val.substring(0, decimal_pos);
      var right_side = input_val.substring(decimal_pos);
      left_side = formatNumber(left_side);
      right_side = formatNumber(right_side);
      if (blur === "blur") {
        right_side += "00";
      }
      right_side = right_side.substring(0, 2);
      input_val = left_side + "." + right_side;

    } else {

      input_val = formatNumber(input_val);
      input_val = "$" + input_val;


    }
    input.val(input_val);
    var updated_len = input_val.length;
    caret_pos = updated_len - original_len + caret_pos;
    input[0].setSelectionRange(caret_pos, caret_pos);
  }   

//UPLOAD ẢNH
$(document).ready(function(){

    $("#imageUpload").change(function(data){
  
      var imageFile = data.target.files[0];
      var reader = new FileReader();
      reader.readAsDataURL(imageFile);
  
      reader.onload = function(evt){
        $('#imagePreview').attr('src', evt.target.result);
        $('#imagePreview').hide();
        $('#imagePreview').fadeIn(650);
      }
      
    });  
  });

  // MUA THE
  function openItem(evt, item) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(item).style.display = "flex";
    evt.currentTarget.className += " active";
}

document.getElementById("defaultOpen").click();

function buycard() {
    let buycardbox = document.getElementById('modalo');
    buycardbox.style.display = 'flex';
}
function clickclose() {
    let buycardbox = document.getElementById('modalo');
    buycardbox.style.display = 'none';
}




//Số lượng + giá
let divTotal = document.getElementById('total')
jQuery(document).ready(function ($) {
    var $value = $('.value');
    $value.on('input', function (e) {
        var total = 1;
        var sum;
        $value.each(function (index, elem) {
            if ($(elem).is("input[type='radio']") && (!$(elem).is(":checked")))
                return;
            if (!Number.isNaN(parseInt(this.value, 10)))
                total = total * parseInt(this.value, 10);
            let dollarUSLocale = Intl.NumberFormat('en-US');
            let totalMoneyFormat = dollarUSLocale.format(total);
            sum = "Tổng cộng: " + totalMoneyFormat + " đồng";
        });

        divTotal.style.display = 'block'
        $('#total').val(sum);

    });
    
});

divNotiResult.innerHTML = document.getElementById('total').innerText;


$.ajax({
    url: "logout.php",
    method: 'POST',
    contentType: false,
    processData: false,
    success: function (data) {
        alert("session destroyed");
    }
});
