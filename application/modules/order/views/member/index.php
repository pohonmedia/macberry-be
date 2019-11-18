<!-- Toolbars -->
<div id="content">
        <div class="container">
          <div class="row bar mb-0">
            <div id="customer-orders" class="col-md-9">
              <p class="text-muted lead">If you have any questions, please feel free to <a href="contact.html">contact us</a>, our customer service center is working for you 24/7.</p>
              <div class="box mt-0 mb-lg-12">
                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th width="10%">Order</th>
                        <th>Date</th>
                        <th class="text-right">Total</th>
                        <th class="text-center">Status Bayar</th>
                        <th class="text-center">Status Order</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        if (!empty($list)) {
                          foreach ($list as $key => $value) {
                            echo '<tr>';
                            echo '<td><a class="text-info" href="' . base_url('member/order/detail/' . $value->id) . '">' . $value->vcordercode . '</a></td>';
                            echo '<td class="small">' . mdate('%d-%m-%Y %H:%i:%s', strtotime($value->dtorderdate)) . '</td>';
                            echo '<td class="text-right">' . number_format($value->dectotal, 2) . '</td>';
                            echo '<td class="text-center">';
                              if($value->intstatusbayar == 0) {
                                echo '<span class="badge badge-info">' . $value->vcstatusbayar . '</span>';
                                } else if($value->intstatusbayar == 1) {
                                    echo '<span class="label label-info">' . $value->vcstatusbayar . '</span> - ';
                                    echo ' <a class="label label-danger" href="' . base_url('admin/order/detail/' . $value->id) . '"><i class="fa fa-check"></i> Confirm</a>';
                                } else if($value->intstatusbayar == 2) {
                                    echo '<span class="badge badge-success">' . $value->vcstatusbayar . '</span>';
                                } else {
                                    echo '<span class="badge badge-info">' . $value->vcstatusbayar . '</span>';
                                }
                                echo '</td>';
                                echo '<td class="text-center">';
                              if($value->intstatusorder == 0) {
                                echo '<span class="badge badge-danger">' . $value->vcstatusorder . '</span>';
                                } else if($value->intstatusorder == 1) {
                                echo '<span class="label label-info">' . $value->vcstatusorder . '</span>';
                                echo ' <a class="badge badge-danger" href="' . base_url('admin/order/detail/' . $value->id) . '"><i class="fa fa-truck"></i> Shipping</a>';
                                } else if($value->intstatusorder == 2) {
                                echo '<span class="badge badge-info">' . $value->vcstatusorder . '</span>';
                                } else if($value->intstatusorder == 3) {
                                echo '<span class="badge badge-success">' . $value->vcstatusorder . '</span>';
                                } else {
                                echo '<span class="badge badge-info">' . $value->vcstatusorder . '</span>';
                                }
                                echo '</span></td>';
                                echo '<td><a href="' . base_url('member/order/detail/' . $value->id) .'"  class="btn btn-template-outlined btn-sm">View</a></td>';
                                echo '</tr>';
                          }
                        } else {
                          echo '<tr>';
                          echo '<td colspan="6"><span class="text-danger">Tidak ada data</span></td>';
                          echo '</tr>';
                        }
                        ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="col-md-3 mt-4 mt-md-0">
              <!-- CUSTOMER MENU -->
              <div class="panel panel-default sidebar-menu">
                <div class="panel-heading">
                  <h3 class="h4 panel-title">Customer section</h3>
                </div>
                <div class="panel-body">
                  <ul class="nav nav-pills flex-column text-sm">
                    <li class="nav-item"><a href="<?php echo base_url('member/order');?>" class="nav-link active"><i class="fa fa-list"></i> My Orders</a></li>
                    <li class="nav-item"><a href="<?php echo base_url('member/myaccount');?>" class="nav-link"><i class="fa fa-user"></i> My Account</a></li>
                    <li class="nav-item"><a href="<?php echo base_url('auth/logout');?>" class="nav-link"><i class="fa fa-sign-out"></i> Logout</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>