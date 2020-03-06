<div class="section-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-body p-0">
                      <div class="table-responsive table-invoice">

                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th width="5%">#</th>
                        <th width="20%">Order</th>
                        <th>Date</th>
                        <th class="text-right">Total</th>
                        <!-- <th class="text-center">Status Bayar</th> -->
                        <th class="text-center">Status Order</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        if (!empty($list)) {
                          $no = 1;
                          foreach ($list as $key => $value) {
                            echo '<tr>';
                            echo '<td>' . $no . '</td>';
                            echo '<td><a class="text-info" href="' . base_url('member/order/detail/' . $value->id) . '">' . $value->vcordercode . '</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                            if($value->intstatusbayar == 0) {
                              echo '<span class="badge badge-warning">' . $value->vcstatusbayar . '</span>';
                            } else if($value->intstatusbayar == 1) {
                                echo '<span class="label label-info">' . $value->vcstatusbayar . '</span> - ';
                                echo ' <a class="label label-danger" href="' . base_url('admin/order/detail/' . $value->id) . '"><i class="fa fa-check"></i> Confirm</a>';
                            } else if($value->intstatusbayar == 2) {
                                echo '<span class="badge badge-success">' . $value->vcstatusbayar . '</span>';
                            } else {
                                echo '<span class="badge badge-info">' . $value->vcstatusbayar . '</span>';
                            }
                            echo '</td>';
                            echo '<td class="small">' . mdate('%d-%m-%Y %H:%i:%s', strtotime($value->dtorderdate)) . '</td>';
                            echo '<td class="text-right">' . number_format($value->dectotal, 2) . '</td>';
                            // echo '<td class="text-center">';
                                
                            //   echo '</td>';
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

                                $no++;
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
                    <div class="card-footer text-right">
                      <nav class="d-inline-block">
                        <ul class="pagination mb-0">
                          <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1"
                              ><i class="fas fa-chevron-left"></i
                            ></a>
                          </li>
                          <li class="page-item active">
                            <a class="page-link" href="#"
                              >1 <span class="sr-only">(current)</span></a
                            >
                          </li>
                          <li class="page-item">
                            <a class="page-link" href="#">2</a>
                          </li>
                          <li class="page-item">
                            <a class="page-link" href="#">3</a>
                          </li>
                          <li class="page-item">
                            <a class="page-link" href="#">4</a>
                          </li>
                          <li class="page-item">
                            <a class="page-link" href="#">5</a>
                          </li>
                          <li class="page-item">
                            <a class="page-link" href="#"
                              ><i class="fas fa-chevron-right"></i
                            ></a>
                          </li>
                        </ul>
                      </nav>
                    </div>
                  </div>
                </div>
              </div>
            </div>