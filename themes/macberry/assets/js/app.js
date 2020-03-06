$(function () {
    // alert('Test');
    // ------------------------------------------------------- //
    // click on the box activates the radio
    // ------------------------------------------------------ //
    // item-qty
    $('.item-qty').on('blur', function (e) {
        var val = $(this).val();

        var data = {
            id: $(this).siblings('.item-rowid').val(),
            qty: val
        };

        $.ajax({
            type: "POST",
            url: BASE_URL + 'order/update',
            data: data, // serializes the form's elements.
            success: function(resp) {
                var resp = JSON.parse(resp);

                if(resp.success == true) {
                    location.reload();
                } else {
                    console.log(resp);
                }
            }, 
            error: function(resp) {
                console.log(resp);
            }
        });
    });

    $('#checkout').on('click', '.box.shipping-method, .box.payment-method', function (e) {
        var radio = $(this).find(':radio');
        radio.prop('checked', true);
    });

    // Automatic get City
    $( "#selectprop" ).change(function() {
        var val = $(this).val();
        // alert(val);
        $.ajax({
            type: 'GET',
            url: BASE_URL + 'order/getcity/' + val,
            success: function(resp) {
                var resp = JSON.parse(resp);
                var html = "";
                html += '<option value=0">';
                html += 'Pilih Kota';
                html += '</option>';
            for(var i = 0; i < resp.length; i++) {
                    // console.log(resp[i]['city_id'], resp[i]['city_name']);
                    html += '<option value="' + resp[i]['city_id'] + '">';
                    html += resp[i]['city_name'];
                    html += '</option>';
                }

                 $('#selectcity').html(html);
            }, 
            error: function(resp) {
                console.log(resp);
            }
        });
    });

     $( "#selectcity" ).change(function() {
        var val = $(this).val();
        // alert(val);
        $.ajax({
            type: 'GET',
            url: BASE_URL + 'order/getongkir/' + val,
            success: function(resp) {
                var res = JSON.parse(resp);
                // console.log(res);
                // var costs = res.rajaongkir.results[0].costs;
                // var costs = res;
                var html = "";
                // console.log(costs);
                for(var j = 0; j < res.length; j++) {
                    if(res[j].costs.length > 0) {
                        let costs = res[j].costs;  
                        for(var i = 0; i < costs.length; i++) {
                            html += '<div class="form-group">';
                            html += '<label style="margin-right: 10px"><input type="radio" name="optradio" value="' + costs[i].cost[0].value + '" data="' + res[j].code.toUpperCase() + ' - ' + costs[i].service + '"/> ';
                            html += '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + res[j].code.toUpperCase() + ' - ' + costs[i].service + ' (' + costs[i].cost[0].etd + ' hari) ' + '<strong style="font-size:18px">IDR. ' + costs[i].cost[0].value.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,") + '</strong>';
                            html += '</label></div>';
                        }
                    }
                //     html += '<div class="form-group">';
                //     html += '<label style="margin-right: 10px"><input type="radio" name="optradio" value="' + costs[i].cost[0].value + '"/> ';
                //     html += '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + costs[i].name + ' - ' + costs[i].service + ' (' + costs[i].cost[0].etd + ' hari) ' + '<strong style="font-size:18px">Rp. ' + costs[i].cost[0].value.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,") + '</strong>';
                //     html += '</label></div>';
                }

                 $('#jnetype').html(html);
            }, 
            error: function(resp) {
                console.log(resp);
            }
        });
    });

     $("#jnetype").on("change", 'input[type="radio"]', function(){
         var subtotal = parseInt($('#subtotal').attr('data'));
         var ongkir = parseInt($(this).val());
         var dataCur = $(this).attr('data');
         var total = parseInt(subtotal) + parseInt(ongkir);

         $('#ongkir').html('IDR ' + ongkir.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,"));
         $('#total-value').html(total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,"));
         $('#curDesc').val(dataCur);
         $('#curPrice').val(ongkir);
     });
});