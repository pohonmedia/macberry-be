<?php
echo '<div class="col-lg-9">';
echo '<div class="box border-bottom-0">';
echo '<table class="table">';
echo '<thead>';
echo '<tr>';
echo '<th width="40%">Nama Product</th>';
echo '<th width="20%">Quantity</th>';
echo '<th class="text-right">Unit price</th>';
echo '<th class="text-right">Total</th>';
echo '<th class="text-center">Action</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';
if(!empty($cart)) {
    $total = 0;
    
    foreach ($cart as $items) {
    echo '<tr>';
    echo '<td>' . $items['name']. '</td>';
    echo '<td>'; 
    echo '<input style="padding:5px" width="500" type="number" class="item-qty" value="' . intval($items['qty']) . '">';  
    echo '<input type="hidden" class="item-rowid" name="rowid"' . $items['id'] .'" . value="'. $items['rowid'] . '">';
    echo '</td>';
    echo '<td class="text-right">';
    echo number_format($items['price'], 2); 
    echo '</td>';
    echo '<td class="text-right">'; 
    echo number_format($items['qty']* $items['price'], 2) ; 
    echo '</td>'; 
    echo '<td class="text-center">'; 
    echo '<a href="' . base_url() . 'order/delete/' . $items['rowid'] . '" class="fa fa-trash-o"></a>'; 
    echo '</td>'; 
    echo '</tr>';
    $total += ($items['qty']*$items['price']);
    }
} else {
    $total = 0;
    echo '<tr>';
    echo '<td colspan="5">';
    echo 'Cart Kosong';
    echo '<td>';
    echo '</tr>';
}
echo '</tbody>';
echo '<tfoot>';
echo '<tr>';
echo '<td colspan="4"><b>Order Total:</b></td>';
echo '<td class="text-right"<th><b>Rp.' . number_format ($total, 2) . '</b></th> </td>';
echo '</tr>';
echo '</tfoot>';
echo '</table>';
echo '<div class="box-footer d-flex flex-wrap align-items-center justify-content-between">';
echo '<div class="left-col"><a href="' . base_url() . '"Home" class="btn btn-template-outlined"><i class="fa fa-chevron-left"></i> Continue Shopping</a></div>';
echo '<div class="right-col">';
if(!empty($cart)) {
echo '<a href="' . base_url() . 'order/delete/all" class="btn btn-danger"> Empty Cart </a>  <a href="'. base_url() . 'order/payment"  class="btn btn-template-outlined">Proceed to CheckOut <i class="fa fa-chevron-right"></i></a>';
}
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';

echo '<div class="col-lg-3">';
echo '<div id="order-summary" class="box mt-0 mb-4 p-0">';
echo '<div class="box-header mt-0">';
echo '<h3>Rincian Pesanan</h3>';
echo '</div>';
echo '<p class="text-muted">Pengiriman dan biaya tambahan dihitung berdasarkan nilai yang Anda masukkan.</p>';
echo '<div class="table-responsive">';
echo '<table class="table">';
echo '<tbody>';
echo '<tr>';
echo '<td>Subtotal</td>';
echo '<th><b>Rp.' . number_format ($total, 2) . '</b></th>';
echo '</tr>';
echo '<tr>';
echo '<td>Ongkos Kirim</td>';
echo '<th><b>Rp.' . number_format (0, 2) . '</b></th>';
echo '</tr>';
echo '<tr class="total">';
echo '<td>Total</td>';
echo '<th><b>Rp.' . number_format ($total, 2) . '</b></th>';
echo '</tr>';
echo '</tbody>';
echo '</table>';
echo '</div>';
echo '</div>';
echo '</div>';