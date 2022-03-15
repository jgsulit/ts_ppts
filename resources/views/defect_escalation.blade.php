<!-- @php $layout = 'layouts.super_user_layout'; @endphp -->
@auth
  @php
    if(Auth::user()->user_level_id == 1){
      $layout = 'layouts.super_user_layout';
    }
    else if(Auth::user()->user_level_id == 2){
      $layout = 'layouts.admin_layout';
    }
    else if(Auth::user()->user_level_id == 4){
      $layout = 'layouts.fvi_layout';
    }
    else if(Auth::user()->user_level_id == 5){
      $layout = 'layouts.oqc_layout';
    }
    else if(Auth::user()->user_level_id == 6){
      $layout = 'layouts.packing_layout';
    }
    else if(Auth::user()->user_level_id == 7){
      $layout = 'layouts.clerk_layout';
    }
  @endphp
@endauth

@auth
  @extends($layout)

  @section('title', 'Defect Escalation')

  @section('content_page')
  <style type="text/css">
    .hidden_scanner_input{
      position: fixed;
      /*bottom: 0;
      left: 0;*/
      opacity: 0;
    }
    
    textarea{
      resize: none;
    }

    /*#mdl_edit_material_details>div{*/
      /*width: 2000px!important;*/
      /*min-width: 1400px!important;*/
    /*}*/

    .modal-xl-custom{
      width: 95%!important;
      min-width: 90%!important;
    }
  </style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Defect Escalation</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item">Defect Escalation</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">1. Scan PO Number</h3>
              </div>

              <!-- Start Page Content -->
              <div class="card-body">
                <div class="row">
                  <!-- <div class="col-sm-3"> -->
                    <!-- <label>Scan PO Code</label> -->
                    <!-- <br> -->
                    <!-- <div class="input-group"> -->
                      <!-- <div class="input-group-prepend">
                        <span class="input-group-text btnSearchPoNo" data-toggle="modal"><i class="fa fa-search"></i></span>
                      </div>
                      <input type="text" class="form-control btnSearchPoNo" id="txt_search_po_number" placeholder="Scan PO Code" readonly="true"> -->
                      <!-- <button type="button" class="btn btn-success btnSearchPoNo" title="Scan PO Code"><i class="fa fa-qrcode"></i></button>
                    </div> -->
                  <!-- </div>
                  <div class="col-sm-1">
                  </div> -->

                 <div class="col-sm-3">
                    <label>PO Number</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <button type="button" class="btn btn-primary btnSearchPoNo" title="Scan PO Code"><i class="fa fa-qrcode"></i></button>
                      </div>
                      <input type="text" class="form-control" id="txt_po_number_lbl" readonly="">
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <label>Device Name</label>
                      <input type="text" class="form-control" id="txt_device_name_lbl" readonly="">
                  </div>
                  <div class="col-sm-2">
                    <label>Device Code</label>
                      <input type="text" class="form-control" id="txt_device_code_lbl" readonly="">
                  </div>
                  <div class="col-sm-1">
                    <label>PO Qty</label>
                      <input type="text" class="form-control" id="txt_po_qty_lbl" readonly="">
                  </div>
                </div>
              </div>
                <!-- !-- End Page Content -->

            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">2. Defect Escalation Summary</h3>
                <button class="btn btn-primary btn-sm" style="float: right;" id="btnShowAddProdRuncard"><i class="fa fa-plus"></i> Add Defect Escalation</button>
              </div>

              <!-- Start Page Content -->
              <div class="card-body">
                <div class="row">
                  <div class="col-12">
<!--                     <div class="float-right">
                    </div>
                    <br><br>
 -->                <div class="table-responsive">
                      <table class="table table-sm table-bordered table-hover" id="tbl_prod_runcard" style="min-width: 900px;">
                        <thead>
                          <tr class="bg-light">
                            <th>Action</th>
                            <th>Status</th>
                            <th>Defect Escalation #</th>
                            <th>Pair #</th>
                            <th>Die #</th>
                            <th>Mold #</th>
                            <th>Station</th>
                            <th>Date</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <!-- !-- End Page Content -->

            </div>
            <!-- /.card -->
          </div>

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <!-- Modal -->
    <div class="modal fade" id="modalRuncardDetails" tabindex="-1" role="dialog" aria-labelledby="cnptsmodal" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog modal-xl modal-xl-custom modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"><i class="fa fa-info-circle text-info"></i> Defect Escalation Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- <div style="float: center;">
              <h5>Runcard # <span id="spanRuncardNo">---</span></h5>
            </div> -->
            <div class="row">
              <div class="col-sm-12 border px-4">
                <form id="frm_edit_material_details" method="post">
                  <div class="row">
                    <div class="col pt-12">
                      <!-- <span class="badge badge-secondary">1.</span> Details -->
                      <center>
                        <br>
                        <h3>DEFECT ESCALATION / VERIFICATION & REWORK SLIP</h3>
                      </center>
                      <button type="button" id="btn_edit_material_details_primary" class="btn btn-sm btn-link float-right"><i class="fa fa-edit"></i> Edit</button>
                    </div>
                  </div>
                  <span class="badge badge-secondary">1.</span> Details
                  <div class="row">
                    <div class="col-sm-4">
                        <br>
                        <input type="radio" id="rdo_product_type_automotive" name="product_type" value="1" checked="true"> AUTOMOTIVE <br>
                        <input type="radio" id="rdo_product_type_regular_product" name="product_type" value="2"> REGULAR PRODUCT
                    </div>
                    <div class="col-sm-4">
                        <br>
                        <input type="radio" id="rdo_product_type2_a" name="product_type2" value="1"  checked="true"> A <br>
                        <input type="radio" id="rdo_product_type2_b" name="product_type2" value="2"> B
                    </div>

                    <div class="col-sm-4">
                      <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend w-50">
                          <span class="input-group-text w-100" id="basic-addon1">PAIR #</span>
                        </div>
                        <input type="text" class="form-control form-control-sm" id="txt_pair_no" name="txt_pair_no" readonly>
                      </div>
                      <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend w-50">
                          <span class="input-group-text w-100" id="basic-addon1">Die No.</span>
                        </div>
                        <input type="text" class="form-control form-control-sm" id="txt_die_no" name="txt_die_no" readonly>
                      </div>
                      <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend w-50">
                          <span class="input-group-text w-100" id="basic-addon1">Mold</span>
                        </div>
                        <input type="text" class="form-control form-control-sm" id="txt_mold" name="txt_mold" readonly>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <hr>
                    </div>
                    <div class="col-sm-4">
                      <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend w-50">
                          <span class="input-group-text w-100" id="basic-addon1">Operator</span>
                        </div>
                        <select class="form-control select2 select2bs4 selectUser" id="sel_operator" name="operator" disabled="true">
                          <option value=""> N/A </option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend w-50">
                          <span class="input-group-text w-100" id="basic-addon1">Device Code</span>
                        </div>
                        <input type="text" class="form-control form-control-sm" id="txt_device_code" name="txt_device_code" readonly>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend w-50">
                          <span class="input-group-text w-100" id="basic-addon1">Date</span>
                        </div>
                        <input type="date" class="form-control form-control-sm" id="txt_date" name="date" readonly value="<?php echo date('Y-m-d'); ?>">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend w-50">
                          <span class="input-group-text w-100" id="basic-addon1">Station</span>
                        </div>
                        <select class="form-control select2 select2bs4 selSubStation" id="sel_sub_station" name="sub_station_id" disabled="true">
                          <option value=""> N/A </option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend w-50">
                          <span class="input-group-text w-100" id="basic-addon1">PO #</span>
                        </div>
                        <input type="text" class="form-control form-control-sm" id="txt_po_number" name="txt_po_number" readonly>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend w-50">
                          <span class="input-group-text w-100" id="basic-addon1">Line</span>
                        </div>
                        <select class="form-control select2 select2bs4 selectAssemblyLine" id="sel_assembly_line" name="assembly_line_id" disabled="true">
                          <option value=""> N/A </option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend w-50">
                          <span class="input-group-text w-100" id="basic-addon1">Remarks</span>
                        </div>
                        <textarea class="form-control" name="remarks" id="txt_remarks"></textarea>
                      </div>
                    </div>
                  </div>

                  <div class="row" style="display: none;">
                    <div class="col text-right">
                      @csrf
                      <input type="hidden" name="txt_material_details_emp_num" id="txt_material_details_emp_num">
                      <input type="hidden" name="txt_prod_runcard_id_query" id="txt_prod_runcard_id_query">
                      <input type="hidden" name="txt_prod_runcard_status" id="txt_prod_runcard_status">
                      <!-- <input type="hidden" name="txt_prod_runcard_has_emboss" id="txt_prod_runcard_has_emboss">
                      <input type="hidden" name="require_oqc_before_emboss" id="txt_prod_runcard_require_oqc_before_emboss"> -->
                      <input type="hidden" name="txt_wbs_kit_issuance_id_query" id="txt_wbs_kit_issuance_id_query">
                      <!-- <input type="hidden" name="txt_wbs_sakidashi_issuance_id_query" id="txt_wbs_sakidashi_issuance_id_query"> -->
                      <input type="hidden" name="txt_wbs_kit_issuance_device_code_query" id="txt_wbs_kit_issuance_device_code_query">
                      <button type="button" class="btn btn-sm btn-success" id="btn_save_material_details_primary">Save</button>
                      <button type="button" class="btn btn-sm btn-secondary" id="btn_cancel_material_details_primary">Cancel</button>
                    </div>
                  </div>
                </form>
                <br>
              </div><!-- col -->

              <div class="col-sm-12">
                <div class="row">
                  <div class="col border py-3 px-4 border-left-0 border-bottom-0">
                    <span class="badge badge-secondary">2.</span> Defect Escalation / Verification / Rework
                    <br><br>

                        <div class="table-responsive" style="max-height: 500px;">
                          <br>
                          <div style="float: left;">
                            <div class="input-group input-group-sm">
                              <button type="button" class="btn btn-sm btn-success" id="btnAddRework" style="margin-right: 10px;"><i class="fa fa-plus"></i> Add New</button> 
                              <button type="button" class="btn btn-sm btn-info" id="btnProdVerification" style="margin-right: 10px;"><i class="fa fa-check-circle"></i> Prod'n Verification</button>
                              <button type="button" class="btn btn-sm btn-info" id="btnEngVerification" style="margin-right: 10px;"><i class="fa fa-check-circle"></i> Eng'g Verification</button>
                              <button type="button" class="btn btn-sm btn-info" id="btnQCVerification" style="margin-right: 10px;"><i class="fa fa-check-circle"></i> QC Verification</button>
                            </div>
                          </div>
                          <br><br>
                          <table class="table table-sm table-bordered table-hover small" id="tblRework" style="min-width: 900px;">
                            <thead>
                              <tr class="bg-light">
                                <th rowspan="3">Select</th>
                                <th colspan="7" style="text-align: center;"><b>OPERATOR FILL-IN</b></th>
                                <th colspan="3" style="text-align: center;"><b>STAFF FILL-IN</b></th>
                                <th colspan="10" style="text-align: center;"><b>REWORK OPERATOR FILL-IN</b></th>
                              </tr>
                              <tr class="bg-light">
                                <th rowspan="2">No. of unit</th>
                                <th rowspan="2">Mode of defect</th>
                                <th rowspan="2">Location of NG</th>
                                <th rowspan="2">NG QTY. (PINS)</th>
                                <th rowspan="2">Scrap</th>
                                <th rowspan="2">For RWK</th>
                                <th rowspan="2">For verification</th>
                                <th colspan="3" style="text-align: center;"><b>VERIFICATION RESULT</b></th>
                                <th rowspan="2">RWK QTY (UNIT)</th>
                                <th colspan="2" style="text-align: center;"><b>RESULT QTY. (UNIT)</b></th>
                                <th rowspan="2">RWK CODE</th>
                                <th colspan="3" style="text-align: center;"><b>MPC check using:</b></th>
                                <th rowspan="2">Optr Name</th>
                                <th rowspan="2">Date</th>
                                <th rowspan="2">Action</th>
                              </tr>
                              <tr class="bg-light">
                                <th>PROD</th>
                                <th>ENGG</th>
                                <th>QC</th>
                                <th>OK</th>
                                <th>SCRAP</th>
                                <th>Terminal Gauge</th>
                                <th>Dummy #LO</th>
                                <th>Dummy #MO</th>
                              </tr>
                            </thead>
                            <tbody>
                              <!-- <td colspan="20"> <center>No data available in table</center></td> -->
                              <!-- <td>...</td>
                              <td>...</td>
                              <td>...</td>
                              <td>...</td>
                              <td>...</td>
                              <td>...</td>
                              <td>...</td>
                              <td>...</td>
                              <td>...</td>
                              <td>...</td>
                              <td>...</td>
                              <td>...</td>
                              <td>...</td>
                              <td>...</td>
                              <td>...</td>
                              <td>...</td>
                              <td>...</td>
                              <td>...</td>
                              <td>...</td> -->
                            </tbody>
                          </table>
                        </div>
                  </div>
                </div>
              </div>

              <div class="col-sm-12">
                <div class="row">
                  <div class="col border py-3 px-4 border-left-0 border-bottom-0">
                    <span class="badge badge-secondary">3.</span> Material List
                    <br><br>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Materials</a>
                      </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active my-2" id="home" role="tabpanel" aria-labelledby="home-tab">

                        <div class="table-responsive" style="max-height: 500px;">
                          <br>
                          <div style="float: left;">
                            <div class="input-group input-group-sm">
                              <button type="button" class="btn btn-sm btn-success" id="btnAddMaterial"><i class="fa fa-plus"></i> Add Material</button>
                            </div>
                          </div>
                          <table class="table table-sm table-bordered table-hover small" id="tbl_materials" style="min-width: 900px;">
                            <thead>
                              <tr class="bg-light">
                                <!-- <th>Action</th> -->
                                <!-- <th>Status</th> -->
                                <th>Material</th>
                                <th>Lot No.</th>
                                <th>Type</th>
                                <!-- <th>Material Name</th> -->
                                <!-- <th>Part #</th> -->
                                <!-- <th>Assessment #</th> -->
                                <!-- <th>Transfer Slip #</th> -->
                                <!-- <th>Qty to comp.</th>
                                <th>Runcard Qty Used</th> -->
                              </tr>
                            </thead>
                            <tbody>
                            </tbody>
                          </table>
                        </div>

                      </div>

                      <!-- Sakidashi Tab -->
                      <div class="tab-pane fade my-2" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                        <!-- <br>
                        <div class="row">
                          <div class="col-sm-3">
                            <label>Search Ctrl #</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-search"></i></span>
                              </div>
                              <input type="text" class="form-control" id="txt_search_si_ctrl_no" placeholder="---">
                            </div>
                          </div>
                        </div>
                        <br>
 -->
                        <!-- <div class="row">
                          <div class="col-sm-3">
                            <label>Search Lot #</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-search"></i></span>
                              </div>
                              <input type="text" class="form-control" id="txt_search_sakidashi_lot_no" placeholder="Scan Lot # Code">
                            </div>
                          </div>
                          <div class="col-sm-6">
                          </div>
                          <div class="col-sm-3">
                              <label>Current Lot #</label>
                              <input type="text" class="form-control" id="txt_sakidashi_lot_no_lbl" readonly="">
                          </div>
                        </div>
                        <br> -->

                        <center>
                          <label>Sakidashi Issuance</label>
                        </center>

                        <div class="row">
                          <div class="col-sm-3">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <button type="button" class="btn btn-info btnScanSakidashiLot" title="Scan Lot #"><i class="fa fa-qrcode"></i></button>
                              </div>
                              <input type="text" class="form-control" id="txtScannedSakidashiLot" placeholder="Scan Lot # Code" readonly="true">
                            </div>
                          </div>
                        </div>

                        <br>

                        <div class="row">
                          <div class="col-sm-3">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <button type="button" class="btn btn-success btnSearchSakidashiLotNo" title="Search Mat't Lot #"><i class="fa fa-search"></i></button>
                              </div>
                              <input type="text" class="form-control" id="txtSearchedSakidashiLotNo" placeholder="Search Material Lot # Code" readonly="true">
                            </div>
                          </div>

                          <div class="col-sm-3">
                            <div class="input-group input-group-sm">
                              <button type="button" class="btn btn-sm btn-success btnShowSavedSakidashiLot" title="Show Saved Material"><i class="fa fa-list"></i> Show Saved Material</button>
                            </div>
                          </div>

                        </div>

                        <!-- <br>
                        <div class="row">
                          <div class="col-sm-3">
                            <label>Search Ctrl #</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-search"></i></span>
                              </div>
                              <input type="text" class="form-control" id="txt_search_si_ctrl_no" placeholder="---">
                            </div>
                          </div>
                        </div>
                        <br>
 -->
                        <!-- <div class="row">
                          <div class="col-sm-3">
                            <label>Search Ctrl #</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-search"></i></span>
                              </div>
                              <input type="text" class="form-control" id="txt_search_sakidashi_ctrl_no" placeholder="Scan Ctrl # Code">
                            </div>
                          </div>
                          <div class="col-sm-6">
                          </div>
                          <div class="col-sm-3">
                              <label>Current Ctrl #</label>
                              <input type="text" class="form-control" id="txt_sakidashi_ctrl_no_lbl" readonly="">
                          </div>
                        </div> -->

                        <div class="table-responsive" style="max-height: 500px;">
                          <table class="table table-sm table-bordered table-hover small" id="tbl_sakidashi">
                            <thead>
                              <tr class="bg-light">
                                <th>Action</th>
                                <th>Status</th>
                                <th>Ctrl No.</th>
                                <th>Contact type</th>
                                <th>Lot #/Pair #</th>
                                <th>Device Code</th>
                                <th>Req issuance qty</th>
                                <th>Reel qty</th>
                                <!-- <th>Qty to comp.</th>
                                <th>Runcard Qty Used</th> -->
                              </tr>
                            </thead>
                            <tbody>
                            </tbody>
                          </table>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col border py-3 px-4 border-left-0 border-bottom-0">
                    <!-- <button type="button" class="btn btn-sm btn-info float-right mb-1" id="btn_setup_stations" disabled="disabled" style="display: none;"><i class="fa fa-cog"></i> Set-up stations</button> -->
                    <!-- <div style="float: right;">
                      <select class="form-control form-control-sm" id="sel_runcard_type" name="sel_runcard_type">
                          <option value="0">For Production Runcard</option>
                          <option value="1">For Emboss Sealing</option>
                        </select>
                    </div> -->
                    <!-- <div class="row align-items-center"> -->
                    <div style="float: left;">
                      <span class="badge badge-secondary">4.</span> Process Stations 
                    </div>


                      <!-- <div class="input-group input-group-sm mb-3 col-sm-4" style="float: right;">
                        <div class="input-group-prepend w-50">
                          <span class="input-group-text w-100" id="basic-addon1">Runcard Type</span>
                        </div>
                        <select class="form-control form-control-sm" id="sel_runcard_type" name="sel_runcard_type">
                          <option value="0">For Production Runcard</option>
                          <option value="1">For Emboss Sealing</option>
                        </select>
                      </div> -->

                    <!-- </div> -->
                    <div style="float: right;">
                      <button class="btn btn-primary btn-sm" id="btnDEAddProcess" data-toggle="modal" data-target=
                        "#mdl_edit_prod_runcard_station_details"><i class="fa fa-plus" ></i> Add Process</button>
                    </div>

                    <!-- <div style="float: right;">
                      <label style="text-align: center;">MOD Legends</label><br>
                      <span class="badge badge-pill badge-primary">Material NG</span> 
                      <span class="badge badge-pill badge-danger">Production NG</span>
                    </div> -->

                    <div class="table-responsive">
                      <table class="table table-sm small table-bordered table-hover" id="tbl_prod_runcard_stations" style="width: 100%;">
                        <thead>
                          <tr class="bg-light">
                            <th></th>
                            <th>Step</th>
                            <th>Process</th>
                            <th>Date Time</th>
                            <th>Operator</th>
                            <th>Machine</th>
                            <th>GOOD QTY</th>
                            <th>NG QTY</th>
                            <th>Remarks</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                
              </div><!-- col -->
            </div>
          </div>
          <div class="modal-footer">
            <!-- <button type="button" class="btn btn-sm btn-success" id="btn_approve_prod" disabled><i class="fa fa-check-circle"></i> Prod Approved</button>
            <button type="button" class="btn btn-sm btn-success" id="btn_approve_qc" disabled><i class="fa fa-check-circle"></i> QC Approved</button> -->
            <button type="button" class="btn btn-sm btn-success" id="btnSubmitToOQCLotApp">Submit to OQC Lot App</button>
            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- /.Modal -->

    <!-- Modal -->
    <div class="modal fade" id="mdl_setup_stations" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="mdl_alert_title">Set-up stations</h5>
          </div>
          <div class="modal-body" id="mdl_alert_body">
            <div class="row">
              <div class="col">
                <div class="table-responsive">
                  <table class="table table-sm small table-bordered table-hover w-100" id="tbl_setup_stations" style="min-width: 400px;">
                    <thead>
                      <tr class="bg-light">
                        <th><input type="checkbox" id="chkCheckAllSetupStations"></th>
                        <th>Step</th>
                        <th>Station</th>
                        <th>Sub-station</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success" id="btn_save_setup_stations">Save</button>
          </div>
        </div>
      </div>
    </div>
    <!-- /.Modal -->

    <!-- Modal -->
    <div class="modal fade" id="mdl_edit_prod_runcard_station_details" tabindex="-1" role="dialog" aria-labelledby="cnptsmodal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content modal-lg">
          <div class="modal-header">
            <h5 class="modal-title"><i class="fas fa-object-group text-info"></i> Add Process</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="frm_edit_prod_runcard_station_details">
              @csrf
              <div class="row">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100" id="basic-addon1">Step</span>
                    </div>
                    <input type="text" class="form-control form-control-sm" id="txt_edit_prod_runcard_station_step" name="step_num" placeholder="(Auto Generated)" readonly>
                    <!-- <input type="hidden" class="form-control form-control-sm" id="txt_edit_prod_runcard_station_has_emboss" name="has_emboss" readonly=true> -->
                  </div>
                </div>
              </div>
              <!-- <div class="row">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100" id="basic-addon1">Assembly Line</span>
                    </div>
                    <input type="text" class="form-control form-control-sm" id="txt_edit_prod_runcard_station_station" readonly>
                  </div>
                </div>
              </div> -->
              <div class="row">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100" id="basic-addon1">Process</span>
                    </div>
                    <!-- <input type="text" class="form-control form-control-sm" id="txt_edit_prod_runcard_substation" readonly> -->
                    <select class="form-control select2 select2bs4 selSubStation" id="txt_edit_prod_runcard_substation" name="sub_station_id">
                      <option value=""> N/A </option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100" id="basic-addon1">Date</span>
                    </div>
                    <input type="date" class="form-control form-control-sm" id="txt_edit_prod_runcard_station_date" name="date" readonly value="<?php echo date('Y-m-d'); ?>">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100" id="basic-addon1">Operator</span>
                    </div>
                    <select class="form-control select2 select2bs4 selectUser" id="txt_edit_prod_runcard_operator" name="txt_edit_prod_runcard_operator[]" multiple="multiple">
                      <option value=""> N/A </option>
                    </select>
                    <div class="input-group-append">
                      <button class="btn btn-info" type="button" title="Scan code" id="btn_scan_add_runcard_operator_code"><i class="fa fa-qrcode"></i></button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row" style="display: none;">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100" id="basic-addon1">Certified Operator</span>
                    </div>
                    <select class="form-control select2 select2bs4 selectUser" id="txt_edit_prod_runcard_cert_operator" name="txt_edit_prod_runcard_cert_operator[]" multiple="multiple">
                      <option value=""> N/A </option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row" style="display: none;">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100" id="basic-addon1">Certified Operator</span>
                    </div>
                    <select class="form-control select2 select2bs4 selectUser" id="txt_edit_prod_runcard_cert_operator_visible" name="txt_edit_prod_runcard_cert_operator[]" multiple="multiple" disabled="true">
                      <option value=""> N/A </option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100" id="basic-addon1">Machine</span>
                    </div>
                    <!-- <input type="text" class="form-control form-control-sm" id="txt_edit_prod_runcard_station_machine" name="txt_edit_prod_runcard_station_machine"> -->

                    <!-- <select class="form-control form-control-sm select2bs4 selectMachine" name="txt_edit_prod_runcard_station_machine" id="txt_edit_prod_runcard_station_machine" style="width: 100%;">
                    </select> -->

                    <select class="form-control select2 select2bs4 selectMachine" id="txt_edit_prod_runcard_station_machine" name="txt_edit_prod_runcard_station_machine[]" multiple="multiple">
                      <option value=""> N/A </option>
                    </select>
                    <div class="input-group-append">
                      <button class="btn btn-info" type="button" title="Scan code" id="btn_scan_machine_code"><i class="fa fa-qrcode"></i></button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row" style="display: none;">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100" id="basic-addon1">Assigned Machine</span>
                    </div>

                    <select class="form-control select2 select2bs4 selectMachine" id="txt_edit_prod_runcard_station_assigned_machine" name="txt_edit_prod_runcard_station_assigned_machine" multiple="multiple" readonly="readonly">
                      <option value=""> N/A </option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row" style="display: none;">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100" id="basic-addon1">Assigned Machine</span>
                    </div>

                    <select class="form-control select2 select2bs4 selectMachine" id="txt_edit_prod_runcard_station_assigned_machine_visible" name="txt_edit_prod_runcard_station_assigned_machine_visible" multiple="multiple" disabled="true">
                      <option value=""> N/A </option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100" id="basic-addon1">GOOD QTY</span>
                    </div>
                    <input type="number" class="form-control form-control-sm" id="txt_edit_prod_runcard_station_good" name="qty_good" min="0" value="0">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100" id="basic-addon1">NG QTY</span>
                    </div>
                    <input type="number" class="form-control form-control-sm" id="txt_edit_prod_runcard_station_ng" name="qty_ng" min="0" value="0">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100">Remarks</span>
                    </div>
                    <textarea class="form-control form-control-sm" id="txt_edit_prod_runcard_station_remarks" name="remarks"></textarea>
                  </div>
                </div>
              </div>

            </form>
          </div>
          <div class="modal-footer">
            <input type="hidden" id="txt_prod_runcard_station_id_query" name="txt_prod_runcard_station_id_query" form="frm_edit_prod_runcard_station_details">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-success" form="frm_edit_prod_runcard_station_details" id="btn_save_prod_runcard_station_stations" disabled="true">Save</button>
          </div>
        </div>
      </div>
    </div>
    <!-- /.Modal -->

    <!-- Modal -->
    <div class="modal fade" id="mdlSaveMaterial" tabindex="-1" role="dialog" aria-labelledby="cnptsmodal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content modal-lg">
          <div class="modal-header">
            <h5 class="modal-title"><i class="fas fa-puzzle-piece text-info"></i> Add Material</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="frmSaveMaterial" method="post">
              @csrf
              <div class="row">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100" id="basic-addon1">Material</span>
                    </div>
                    <select class="form-control select2 select2bs4 selMaterial" name="material_id">
                      <option value=""> N/A </option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100" id="basic-addon1">Lot No</span>
                    </div>
                    <input type="text" class="form-control form-control-sm" name="lot_no" readonly="true">
                    <input type="text" class="form-control form-control-sm" name="type" readonly="true" style="display: none;">
                    <div class="input-group-append">
                      <button class="btn btn-info" type="button" title="Scan Mat'l Lot No" id="btnScanMaterialLotNo"><i class="fa fa-qrcode"></i></button>
                    </div>

                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100" id="basic-addon1">Material Type</span>
                    </div>
                    <input type="text" class="form-control form-control-sm" name="text_type" readonly="true">

                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-success" id="btnSaveMaterial">Save</button>
          </div>
        </div>
      </div>
    </div>
    <!-- /.Modal -->

    <!-- Modal -->
    <div class="modal fade" id="mdl_alert" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="mdl_alert_title"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="mdl_alert_body">
          </div>
        </div>
      </div>
    </div>
    <!-- /.Modal -->

     <!-- Modal -->
    <div class="modal fade" id="mdl_qrcode_scanner" data-formid="" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header border-bottom-0 pb-0">
            <!-- <h5 class="modal-title" id="exampleModalLongTitle"></h5> -->
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body pt-0">
            <div class="text-center text-secondary">
              Please scan the code.
              <br>
              <br>
              <h1><i class="fa fa-qrcode fa-lg"></i></h1>
            </div>
            <input type="text" id="txt_qrcode_scanner" class="hidden_scanner_input">
          </div>
        </div>
      </div>
    </div>
    <!-- /.Modal -->

    <!-- Modal Scan PO -->
    <div class="modal fade" id="modalScanPOTransLotCode" data-formid="" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header border-bottom-0 pb-0">
            <!-- <h5 class="modal-title" id="exampleModalLongTitle"></h5> -->
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body pt-0">
            <div class="text-center text-secondary">
              <span id="scanPOTransLotBody">Please scan the PO code.</span>
              <br>
              <br>
              <h1><i id="scanPOTransLotIcon" class="fa fa-qrcode fa-lg"></i></h1>
            </div>
            <input type="text" id="txtSearchPoTransLotNo" class="hidden_scanner_input">
          </div>
        </div>
      </div>
    </div>
    <!-- /.Modal -->

    <div class="modal fade" id="modalNGSummary">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">NG Summary</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <label style="float: left; font-size: 20px; color: green;">PO #: <span id="spanNGSummaryPoNo">--</span></label>
            <br><br>
            <div class="table-responsive">
              <table class="table table-sm table-bordered table-hover dataTable no-footer" id="tblNGSummary" style="width: 100%;">
                <thead>
                  <tr>
                    <th>Production Runcard ID.</th>
                    <th>Defect Escalation No.</th>
                    <th>Mode of Defect</th>
                    <th>Qty</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
            <!-- <button type="submit" id="btnChangeDeviceStat" class="btn btn-primary"><i id="iBtnChangeDeviceStatIcon" class="fa fa-check"></i> Yes</button> -->
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- Modal -->
    <div class="modal fade" id="mdl_setup_stations" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="mdl_alert_title">Set-up stations</h5>
          </div>
          <div class="modal-body" id="mdl_alert_body">
            <div class="row">
              <div class="col">
                <div class="table-responsive">
                  <table class="table table-sm small table-bordered table-hover w-100" id="tbl_setup_stations" style="min-width: 400px;">
                    <thead>
                      <tr class="bg-light">
                        <th></th>
                        <th>Step</th>
                        <th>Station</th>
                        <th>Sub-station</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success" id="btn_save_setup_stations">Save</button>
          </div>
        </div>
      </div>
    </div>
    <!-- /.Modal -->

    <!-- Modal -->
    <div class="modal fade" id="mdlSaveRework" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content modal-lg">
          <div class="modal-header">
            <h5 class="modal-title"><i class="fas fa-info-circle text-info"></i> Rework Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="frmSaveRework">
              @csrf

              <div class="row">
                <div class="col">
                  <center>Operator Fill-in</center>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100">Runcard No.</span>
                    </div>
                    <select class="form-control select2 select2bs4" id="select_runcard_no" name="runcard_no">
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100">No. of unit</span>
                    </div>
                    <input type="text" class="form-control form-control-sm" name="rework_id" style="display: none;">
                    <input type="text" class="form-control form-control-sm" name="defect_escalation_id" id="frmSaveRework_defect_escalation_id" style="display: none;">
                    <input type="text" class="form-control form-control-sm" name="po_no" id="frmSaveRework_po_no" style="display: none;">
                    <input type="text" class="form-control form-control-sm" name="unit_no" id="frmSaveRework_unit_no" >
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100">Mode of Defect</span>
                    </div>
                    <select class="form-control select2 select2bs4 selectMOD" name="mode_of_defect_id">
                      <option value=""> N/A </option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100">Location of NG</span>
                    </div>
                    <input type="text" class="form-control form-control-sm" name="location_of_ng" >
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100">NG QTY. (PINS)</span>
                    </div>
                    <input type="number" class="form-control form-control-sm" name="ng_qty" >
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100">Scrap</span>
                    </div>
                    <select class="form-control form-control-sm" name="scrap">
                      <option value="0" selected="true">NO</option>
                      <option value="1">YES</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100">For Rework</span>
                    </div>
                    <select class="form-control form-control-sm" name="for_rework">
                      <option value="0">NO</option>
                      <option value="1" selected="true">YES</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100">For Verification</span>
                    </div>
                    <select class="form-control form-control-sm" name="for_verification">
                      <option value="0" selected="true">NO</option>
                      <option value="1">YES</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row divForRework">
                <div class="col">
                  <center>Verification Result</center>
                </div>
              </div>

              <div class="row divForRework">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100">PROD</span>
                    </div>
                    <select class="form-control form-control-sm" name="prod">
                      <option value="1" selected="true">OK</option>
                      <option value="0">SCRAP</option>
                      <option value="2">REWORK</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row divForRework">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100">ENGG</span>
                    </div>
                    <select class="form-control form-control-sm" name="engg">
                      <option value="1" selected="true">OK</option>
                      <option value="0">SCRAP</option>
                      <option value="2">REWORK</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row divForRework">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100">QC</span>
                    </div>
                    <select class="form-control form-control-sm" name="qc">
                      <option value="1" selected="true">OK</option>
                      <option value="0">SCRAP</option>
                      <option value="2">REWORK</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row divForRework">
                <div class="col">
                  <br>
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100">Rework Qty (Unit)</span>
                    </div>
                    <input type="number" class="form-control form-control-sm" name="rework_qty" >
                  </div>
                </div>
              </div>

              <div class="row divForRework">
                <div class="col">
                  <center>Result Qty. (Unit)</center>
                </div>
              </div>

              <div class="row divForRework">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100">OK</span>
                    </div>
                    <input type="number" class="form-control form-control-sm" name="result_qty_ok">
                  </div>
                </div>
              </div>

              <div class="row divForRework">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100">Scrap</span>
                    </div>
                    <input type="number" class="form-control form-control-sm" name="result_qty_scrap">
                  </div>
                </div>
              </div>

              <div class="row divForRework">
                <div class="col">
                  <br>
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100">Rework Code</span>
                    </div>
                    <input type="text" class="form-control form-control-sm" name="rework_code" >
                  </div>
                </div>
              </div>

              <div class="row divForRework">
                <div class="col">
                  <center>MPC check using:</center>
                </div>
              </div>

              <div class="row divForRework">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100">Terminal Gauge</span>
                    </div>
                    <select class="form-control form-control-sm" name="terminal_gauge">
                      <option value="0" selected="true">NO</option>
                      <option value="1">YES</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row divForRework">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100">Dummy #LO</span>
                    </div>
                    <select class="form-control form-control-sm" name="dummy_lo">
                      <option value="0" selected="true">NO</option>
                      <option value="1">YES</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row divForRework">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100">Dummy #MO</span>
                    </div>
                    <select class="form-control form-control-sm" name="dummy_mo">
                      <option value="0" selected="true">NO</option>
                      <option value="1">YES</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100">Operator</span>
                    </div>
                    <select class="form-control select2 select2bs4" id="add_def_operators" name="operator">
                      <option value=""> N/A </option>
                    </select>
                    <!-- <div class="input-group-append">
                      <button class="btn btn-info" type="button" title="Scan code"> <i class="fa fa-qrcode"></i></button>
                    </div> -->
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100">Date</span>
                    </div>
                    <input type="date" class="form-control form-control-sm" name="date" readonly value="<?php echo date('Y-m-d'); ?>">
                  </div>
                </div>
              </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success" id="btnSaveRework">Save</button>
          </div>
        </div>
          </form>
      </div>
    </div>
    <!-- /.Modal -->

    <div class="modal fade" id="modalGenRuncardToPrint">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"><i class="fa fa-qrcode"></i> Generate QR Code</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <center>
              <div class="row">
                <div class="col-sm-6">
                    <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')
                              ->size(150)->errorCorrection('H')
                              ->generate('0')) !!}" id="imgGenRuncardPoNoBarcode" style="max-width: 200px; min-width: 200px;">
                    <br>
                    <label id="lblRuncardPoNo">...</label> <br>
                </div>
                <div class="col-sm-6">
                    <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')
                              ->size(150)->errorCorrection('H')
                              ->generate('0')) !!}" id="imgGenRuncardBarcode" style="max-width: 200px; min-width: 200px;">
                    <br>
                    <label id="lblRuncardNo">...</label> <br>
                </div>
              </div>
            </center>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" id="btnPrintRuncardBarcode" class="btn btn-primary"><i id="iBtnPrintRuncardBarcodeIcon" class="fa fa-print"></i> Print</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

    <!-- Modal -->
    <div class="modal fade" id="mdlSaveReworkVerification" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content modal-lg">
          <div class="modal-header">
            <h5 class="modal-title"><i class="fas fa-check-circle text-info"></i> Rework Verification Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="frmSaveReworkVerification">
              @csrf

              <div class="row">
                <div class="col">
                  <center>VERIFICATION RESULT</center>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100">VERIFICATION TYPE</span>
                    </div>
                    <select class="form-control form-control-sm" name="verification_type" disabled="true">
                      <option value="1">PROD</option>
                      <option value="2">ENGG</option>
                      <option value="3">QC</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100">VERIFICATION RESULT</span>
                    </div>
                    <select class="form-control form-control-sm" name="verification_result">
                      <option value="1" selected="true">OK</option>
                      <option value="0">SCRAP</option>
                      <option value="2">REWORK</option>
                    </select>
                  </div>
                </div>
              </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success" id="btnSaveReworkVerification">Save</button>
          </div>
        </div>
          </form>
      </div>
    </div>
    <!-- /.Modal -->

    <!-- Modal -->
    <div class="modal fade" id="mdl_employee_number_scanner" data-formid="" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header border-bottom-0 pb-0">
            <!-- <h5 class="modal-title" id="exampleModalLongTitle"></h5> -->
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body pt-0">
            <div class="text-center text-secondary">
              Please scan your ID.
              <br><br>
              <!-- <h1><i class="fa fa-barcode fa-lg"></i></h1> -->
              <h1><i class="fa fa-qrcode fa-lg"></i></h1>
            </div>
            <input type="text" id="txt_employee_number_scanner" class="hidden_scanner_input">
          </div>
  <!--         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div> -->
        </div>
      </div>
    </div>
    <!-- /.Modal -->

    <textarea id="txt_str" style="opacity: 0.01"></textarea>
  </div>
  <!-- /.content-wrapper -->
  @endsection

  @section('js_content')

  <!-- <script src="{{ URL::asset('public/template/plugins/jquery-ui/jquery-ui.min.js') }}"></script> -->
  <script src="{{ URL::asset('public/template/plugins/qz-print-free_1.8.0_src/qz-print/js/deployJava.js') }}"></script>
  <script type="text/javascript">
    let _token = "{{ csrf_token() }}";
    let dt_materials, dt_setup_stations, dt_prod_runcard_stations, dt_sakidashi, dt_ng_summary;
    let dt_prod_runcard;
    let currentPoNo = "";
    let currentTransSlipNo = "";
    let currentCtrlNo = "";
    // let currentEmbossCtrlNo = "";
    let arrSelectedMaterial = [];
    let arrSelectedSakidashi = [];
    // let arrSelectedEmboss = [];
    let totalNoOfOk = 0;
    let totalNoOfNG = 0;
    let boxing = "";
    let assessment = "";
    let aDrawing = "";
    let aDrawingRev = "";
    let gDrawing = "";
    let gDrawingRev = "";
    let materialKitIssuanceLotNo = "";
    let sakidashiIssuanceLotNo = "";
    // let embossIssuanceLotNo = "";
    let materialKitTransferSlip = "";
    let sakidashiCtrlNo = "";
    // let embossCtrlNo = "";
    let hasProdMatSakList = false;
    let viewMatKitAction = 1;
    let viewMatKitActionLotNo = null;
    let viewSakidashiAction = 1;
    let viewSakidashiActionLotNo = null;
    // let viewEmbossAction = 1;
    // let viewEmbossActionLotNo = null;
    let saveMatKitLotIssuanceId = null;
    let saveMatKitLotItem = null;
    let saveMatKitLotItemDesc = null;

    let saveSakidashiLotIssuanceId = null;
    let saveSakidashiLotItem = null;
    let saveSakidashiLotItemDesc = null;

    let frmSaveRework = $("#frmSaveRework");
    let btnSaveRework = $("#btnSaveRework");
    let mdlSaveRework = $("#mdlSaveRework");
    let dtReworks, arrSelectedRework = [];

    // let saveEmbossLotIssuanceId = null;
    // let saveEmbossLotItem = null;
    // let saveEmbossLotItemDesc = null;

    toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": true,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "3000",
      "timeOut": "3000",
      "extendedTimeOut": "3000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut",
    };

    //-----
    var stickers=new Array();//creates an array to store the sticker ZPL string codes
    var java_enabled = navigator.javaEnabled();
    if(java_enabled){
      deployQZ();//deploys the QZapplet for printing
      $('#txt_str').attr('data-java_enabled',1);
    }else{
      $('#txt_str').attr('data-java_enabled',0);
    }
    function proceed_to_print(){
       var data_str = $('#txt_str').val();
       stickers=data_str.split(":-:");//the data returned by this ajax would be the sticker ZPL codes. If the sticker is more than one, the stickers are separated by the delimeter ":-:"
       findPrinter();//calls the findprinter function passing the string "ZPL" - ppc
    }
    /**
    * Deploys different versions of the applet depending on Java version.
    * Useful for removing warning dialogs for Java 6.  This function is optional
    * however, if used, should replace the <applet> method.  Needed to address 
    * MANIFEST.MF TrustedLibrary=true discrepency between JRE6 and JRE7.
    */
    function deployQZ() {
      var attributes = {id: "qz", code:'qz.PrintApplet.class', 
      archive:"{{ URL::asset('public/template/plugins/qz-print-free_1.8.0_src/qz-print/dist/qz-print.jar') }}", width:1, height:1};
      var parameters = {jnlp_href: "{{ URL::asset('public/template/plugins/qz-print-free_1.8.0_src/qz-print/dist/qz-print_jnlp.jnlp') }}", 
      cache_option:'plugin', disable_logging:'false', 
      initial_focus:'false'};
      if (deployJava.versionCheck("1.7+") == true) {}
        else if (deployJava.versionCheck("1.6+") == true) {
          attributes['archive'] = "{{ URL::asset('public/template/plugins/qz-print-free_1.8.0_src/qz-print/dist/jre6/qz-print.jar') }}";
          parameters['jnlp_href'] = "{{ URL::asset('public/template/plugins/qz-print-free_1.8.0_src/qz-print/dist/jre6/qz-print_jnlp.jnlp') }}";
        }
        deployJava.runApplet(attributes, parameters, '1.5');
      }

    /**
    * Returns whether or not the applet is not ready to print.
    * Displays an alert if not ready.
    */
    function notReady() {
      // If applet is not loaded, display an error
      if (!isLoaded()) {
        return true;
      }
      // If a printer hasn't been selected, display a message.
      else if (!qz.getPrinter()) {
        $("#messenger").html('Please select a printer first by using the "Detect Printer" button.');
        return true;
      }
      return false;
    }
    /**
    * Returns is the applet is not loaded properly
    */
    function isLoaded() {
      if (!qz) {
        $("#messenger").html('Error:\n\n\tPrint plugin is NOT loaded!');
        return false;
      } else {
        try {
          if (!qz.isActive()) {
            $("#messenger").html('Error:\n\n\tPrint plugin is loaded but NOT active!');
            return false;
          }
        } catch (err) {
          $("#messenger").html('Error:\n\n\tPrint plugin is NOT loaded properly!');
          return false;
        }
      }
      return true;
    }
    /***************************************************************************
    * Prototype function for finding the closest match to a printer name.
    * Usage:
    *    qz.findPrinter('zebra');
    *    window['qzDoneFinding'] = function() { alert(qz.getPrinter()); };
    ***************************************************************************/
    function findPrinter() {
      if (isLoaded()) {
         var name = "ZDesigner ZT220-200dpi";//calls the findprinter function passing the string "ZPL" - ppc
         // var name = "ZDesigner ZT230-200dpi ZPL ZT220";//calls the findprinter function passing the string "ZPL" - packing


          // Searches for locally installed printer with specified name
          qz.findPrinter(name);
          
          // Automatically gets called when "qz.findPrinter()" is finished.
          window['qzDoneFinding'] = function() {
          var printer = qz.getPrinter();
          printZPL();//printing ZPL
         // Remove reference to this function
         window['qzDoneFinding'] = null;
        };
      }
    }
    function printZPL() {//function for printing

      if (notReady()) { return; }
      $("#messenger").html("printing...");
      for(var i=0;i<stickers.length;i++)
      {
        qz.append(stickers[i]);//sets which printer to print
        qz.print();//prints the stickers
     }
     $("#messenger").html("Done.");
    }

    //-----

    $(document).ready(function () {
      GetCboStationSubStation($(".selectSubStation"), 1);
      GetAssemblyLines($(".selectAssemblyLine"));
      // GetCboStationSubStation($(".selectAssemblyLine"), 1);
      //-----
      //-----
      //-----
      $('#tbl_prod_runcard').on('click','.btnPrintRuncardC3Label',function(){
        $('#txt_str').val('');
        if( $('#txt_str').attr('data-java_enabled')==1 ){
          var data = {
            'txt_runcard_id'                : $(this).attr('runcard-id'),
          };
          $.ajax({
            'data'      : data,
            'type'      : 'get',
            'dataType'  : 'json',
            'url'       : 'print_c3_label',
            success     : function(data){
              var html = '';
              if($.trim(data)){
                $('#txt_str').val(data['lbl']);
                if( data['result_code']==1 ){
                  proceed_to_print();
                  toastr.success('Sent to printer.');
                 }
                else{
                  toastr.warning('No lot number to print.');
                }
              }
            }
          });
        }
        else{
          toastr.warning('Java is not loaded in Chrome. Please contact ISS local 205.');
        }
      });
      //-----
      //-----
      //-----

      bsCustomFileInput.init();
      //Initialize Select2 Elements
      $('.select2').select2();

      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      });

      GetProductionRuncards($("#sel_comp_under_runcard_no"), 1);
      GetUserList($(".selectUser"));
      GetCboMOD($(".selectMOD"));

      // List of Materials in select2
      GetMaterialKittingList($(".selWBSMatKitItem"));
      GetSakidashiList($(".selWBSSakIssuItem"));
      // GetEmbossList($(".selWBSEmbossIssuItem")); 

      GetCboMachine($(".selectMachine"));
      // $("#txt_search_po_number").focus();

       $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
          var target = $(e.target).attr("href") // activated tab
          // alert(target);
          
          if(target == "#home"){
            $("#txt_search_material_transfer_slip").focus();
            $("#btnSaveSelectedMatSak").css({'display': 'block'});
            // $("#btnSaveSelectedEmboss").css({'display': 'none'});
          }
          else if(target == "#profile"){
            $("#txt_search_sakidashi_lot_no").focus();
            $("#btnSaveSelectedMatSak").css({'display': 'block'});
            // $("#btnSaveSelectedEmboss").css({'display': 'none'});
          }
          // else if(target == "#materialEmbossTab"){
          //   $("#txt_search_emboss_lot_no").focus();
          //   $("#btnSaveSelectedEmboss").css({'display': 'block'});
          //   $("#btnSaveSelectedMatSak").css({'display': 'none'});
          // }
        });

      // $('input').each(function(i, obj) {
      //   if (!this.hasAttribute("placeholder")) {
      //     if( $(this).prop('type') == 'number' ){
      //       $(this).prop('placeholder','0');
      //     }
      //     if( $(this).prop('type') == 'text' ){
      //       $(this).prop('placeholder','---');
      //     }
      //   }
      // });

      $(document).on('click', '.chkSelectRework', function(){
          let reworkId = $(this).val();

          if($(this).prop('checked')){
              // Checked
              if(!arrSelectedRework.includes(reworkId)){
                  arrSelectedRework.push(reworkId);
              }
          }
          else{  
              // Unchecked
              let index = arrSelectedRework.indexOf(reworkId);
              arrSelectedRework.splice(index, 1);
          }

          // console.log(arrSelectedRework);
          // $("#lblIntNoOfSendIntBatch").text(arrIntSendEmail.length);
          // if(arrIntSendEmail.length <= 0){
          //     $("#btnShowModalSendIntBatchEmail").prop('disabled', 'disabled');
          //     $("#btnSendIntBatchEmail").prop('disabled', 'disabled');

          // }
          // else{
          //     $("#btnShowModalSendIntBatchEmail").removeAttr('disabled');
          //     $("#btnSendIntBatchEmail").removeAttr('disabled');

          // }
      });

      // $('select[name="scrap"]', $("#frmSaveRework")).change(function(){
      //   if($(this).val() == 1){
      //     $('select[name="for_rework"]', $("#frmSaveRework")).val(0);
      //     $('select[name="for_verification"]', $("#frmSaveRework")).val(0);
      //   }
      //   else{
      //     $('select[name="for_rework"]', $("#frmSaveRework")).val(1);
      //     $('select[name="for_verification"]', $("#frmSaveRework")).val(0);
      //   }
      // });

      $('select[name="for_rework"]', $("#frmSaveRework")).change(function(){
        if($(this).val() == 1){
          $('.divForRework').show();
        }
        else{
          $('.divForRework').hide();
          // $('input[name="rework_qty"]', $("#frmSaveRework")).val(0);
          // $('input[name="result_qty_ok"]', $("#frmSaveRework")).val(0);
          // $('input[name="result_qty_scrap"]', $("#frmSaveRework")).val(0);
          // $('input[name="rework_code"]', $("#frmSaveRework")).val(0);
          // $('select[name="terminal_gauge"]', $("#frmSaveRework")).val(0);
          // $('select[name="dummy_lo"]', $("#frmSaveRework")).val(0);
          // $('select[name="dummy_mo"]', $("#frmSaveRework")).val(0);
        }
      });

      $('#btnProdVerification').click(function(){
        if(arrSelectedRework.length > 0){
          $('#mdlSaveReworkVerification').modal('show');
          $('select[name="verification_type"]', $("#frmSaveReworkVerification")).val(1);
        }
        else{
          toastr.warning('No selected rework!');
        }
      });

      $('#btnEngVerification').click(function(){
        if(arrSelectedRework.length > 0){
          $('#mdlSaveReworkVerification').modal('show');
          $('select[name="verification_type"]', $("#frmSaveReworkVerification")).val(2);
        }
        else{
          toastr.warning('No selected rework!');
        }
      });

      $('#btnQCVerification').click(function(){
        if(arrSelectedRework.length > 0){
          $('#mdlSaveReworkVerification').modal('show');
          $('select[name="verification_type"]', $("#frmSaveReworkVerification")).val(3);
        }
        else{
          toastr.warning('No selected rework!');
        }
      });

      $('#frmSaveReworkVerification').submit(function(e){
        e.preventDefault();
        // SaveReworkVerification();
        $('#txt_employee_number_scanner').val('');
        $('#mdl_employee_number_scanner').attr('data-formid','save_rework_verification').modal('show');
      });


      $("#tblEditProdRunStaMOD").on('keyup', '.txtEditProdRunStaMODQty', function(){
        // console.log('wew');
        let totalNoOfMOD = 0;

        if($(this).val() > $("#txt_edit_prod_runcard_station_ng").val()){
          // toastr.warning('NG Qty limitation reached!');
          $("#pRCStatTotNoOfNG").css({color: 'red'});
          $("#btn_save_prod_runcard_station_stations").prop('disabled', true);
        }
        else{
          $('#tblEditProdRunStaMOD .txtEditProdRunStaMODQty').each(function(i, obj) {
            if($(this).val() == null || $(this).val() == ""){
            }
            else{
              totalNoOfMOD += parseFloat($(this).val());
            }
          });

          if($("#txt_edit_prod_runcard_station_ng").val() != totalNoOfMOD){
            toastr.warning('MOD NG Qty not Tally!');
            $("#pRCStatTotNoOfNG").css({color: 'red'});
            $("#btn_save_prod_runcard_station_stations").prop('disabled', true);
          }
          else{
            $("#pRCStatTotNoOfNG").css({color: 'green'});
            $("#btn_save_prod_runcard_station_stations").prop('disabled', false);
          }
          $("#pRCStatTotNoOfNG").text(totalNoOfMOD);
        }

      });

      $("#tblEditProdRunStaMOD").on('change', '.txtEditProdRunStaMODQty', function(){
        // console.log('wew');
        let totalNoOfMOD = 0;

        $('#tblEditProdRunStaMOD .txtEditProdRunStaMODQty').each(function(i, obj) {
          if($(this).val() == null || $(this).val() == ""){
          }
          else{
            totalNoOfMOD += parseFloat($(this).val());
          }
        });
        if($("#txt_edit_prod_runcard_station_ng").val() != totalNoOfMOD){
          toastr.warning('MOD NG Qty not Tally!');
          $("#pRCStatTotNoOfNG").css({color: 'red'});
          $("#btn_save_prod_runcard_station_stations").prop('disabled', true);
        }
        else{
          $("#pRCStatTotNoOfNG").css({color: 'green'});
          $("#btn_save_prod_runcard_station_stations").prop('disabled', false);
        }
        $("#pRCStatTotNoOfNG").text(totalNoOfMOD);
      });

      $('textarea').each(function(i, obj) {
        if (!this.hasAttribute("placeholder")) {
          $(this).prop('placeholder','...');
        }
      });

      $(document).on('click', '.btnPrintRuncardNo', function(){
        let runcardId = $(this).attr('runcard-id');
        let runcardNo = $(this).attr('runcard-no');
        GetDefectEscalationNoToPrint(runcardId, runcardNo);
      });

      $("#btnPrintRuncardBarcode").click(function(){
        // PrintWHMatIssu();
          popup = window.open();
          // popup.document.write('<br><br><div style="border: 2px solid black; padding: 1px 1px; max-width: 100px;" class="rotated"><img src="' + imgResultUserQrCode + '" style="max-width: 100px;"><br><center><label style="text-align: center; font-weight: bold; font-family: Arial;">' + qrcode + '</label></center></div>');
          let content = '';
          content += '<html>';
          content += '<head>';
            content += '<title></title>';
            content += '<style type="text/css">';
              content += '.rotated {';
                // content += 'transform: rotate(270deg); /* Equal to rotateZ(45deg) */';
                // content += 'border: 2px solid black;';
                content += 'width: 160px;';
                content += 'position: absolute;';
                content += 'left: 8.5px;';
                content += 'top: 12px;';
              content += '}';

              content += 'td {';
                // content += 'transform: rotate(270deg); /* Equal to rotateZ(45deg) */';
                content += 'padding: 1px 1px;';
                content += 'margin: 1px 1px;';
                content += 'width: 70px;';
              content += '}';

              content += '.vl {';
                content += 'border-right: 1px dashed black;';
                content += 'height: 60px;';
                content += 'float: right;';
              content += '}';

              content += '.vl1 {';
                content += 'border-right: 1px dashed black;';
                content += 'height: 10px;';
                content += 'float: right;';
              content += '}';

              content += '.title {';
                content += 'font-size: 7px;';
                content += 'float: center;';
                content += 'font-weight: bold;';
                content += 'font-family: arial;';
              content += '}';

            content += '</style>';
          content += '</head>';
          content += '<body>';
            content += '<center>';
            content += '<div class="rotated">';
            content += '<table>';
            content += '<tr>';
            content += '<td class="vl">';
            content += '<center>';
            content += '<span class="title">PO #</span>';
            content += '<img src="' + $("#imgGenRuncardPoNoBarcode").attr('src') + '" style="min-width: 60px; max-width: 60px;">';
            content += '</center>';
            content += '</td>';

            content += '<td>';
            content += '<center>';
            content += '<span class="title">DEFECT ESCALATION #</span>';
            content += '<img src="' + $("#imgGenRuncardBarcode").attr('src') + '" style="min-width: 60px; max-width: 60px;">';
            content += '</center>';
            content += '</td>';
            content += '</tr>';

            content += '<tr>';
            content += '<td class="vl1">';
            content += '<center>';
            content += '<label style="text-align: center; font-weight: bold; font-family: Arial; font-size: 8px;">' + $("#lblRuncardPoNo").text() + '</label>';
            content += '</center>';
            content += '</td>';
            content += '<td>';
            content += '<center>';
            content += '<label style="text-align: center; font-weight: bold; font-family: Arial; font-size: 8px;">' + $("#lblRuncardNo").text() + '</label>';
            content += '</center>';
            content += '</td>';
            content += '</tr>';
            content += '</table>';
            content += '</div>';
            content += '</center>';
          content += '</body>';
          content += '</html>';
          popup.document.write(content);
          popup.focus(); //required for IE
          popup.print();
          popup.close();
        });

      //---
      // currentPoNo = '450196479600010'; //remove this after
      dt_prod_runcard      = $('#tbl_prod_runcard').DataTable({
        "processing" : true,  
          "serverSide" : true,
          "ajax" : {
            url: "get_defect_escalation_by_po",
            data: function (param){
                param.po_number = currentPoNo;
                // param.po_number = $('#txt_po_number_lbl').val();
            }
          },
          bAutoWidth: false,
          "columns":[
            { "data" : "raw_action", orderable:false, searchable:false },
            { "data" : "raw_status", orderable:false, searchable:false },
            { "data" : "defect_escalation_no" },
            { "data" : "pair_no" },
            { "data" : "die_no" },
            { "data" : "mold" },
            { "data" : "sub_station_info.name" },
            { "data" : "created_at" },
          ],
          "columnDefs": [
            {
              "targets": [4, 5],
              "data": null,
              "defaultContent": "--"
            },
          ],
          order: [[2, "desc"]],
          "rowCallback": function(row,data,index ){
            // currentPoNo = data['po_no'];
            $('#txt_po_number_lbl').val( data['po_no'] );
            // $('#txt_device_name_lbl').val( data['wbs_kitting']['device_name'] );
            // $('#txt_device_code_lbl').val( data['wbs_kitting']['device_code'] );
            // $('#txt_po_qty_lbl').val( data['wbs_kitting']['po_qty'] );
            // $("#txt_search_po_number").val("");
          },
          "drawCallback": function(row,data,index ){
            // dt_setup_stations.draw();
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last = null;

            // Temporary -> switch comment
            GetMaterialKitting();
            // GetSakidashiIssuance();
            // if(api.rows().count() <= 0){
            //   GetMaterialKitting();
            // }

            if(api.rows().count() > 0){
              totalNoOfOk = 0;
              totalNoOfNG = 0;
              // let data = api.data();
              // let recount_ok = data.recount_ok;
              // let recount_ng = data.recount_ng;

              api.column(0, {page:'current'} ).data().each( function ( group, i ) {
                  let data = api.row(i).data();

                  if(data['last_runcard_po_qty'] != null){
                    totalNoOfOk += parseInt(data['last_runcard_po_qty']);
                  }
                  // let recount_ok = data.recount_ok;
                  // let recount_ng = data.recount_ng;
                  // if(data.prod_runcard_station_details != null){
                  //   console.log(data.prod_runcard_station_details);
                  //   if(){

                  //   }
                  // }
                  // if(data.prod_runcard_station_many_details.length > 0 && data.prod_runcard_station_many_details[0]['qty_ng'] != null){
                  //   totalNoOfNG += parseInt(data.prod_runcard_station_many_details[0]['qty_ng']);
                  // }
                  // console.log(data);

                  // Temp comment
                  // if(data.prod_runcard_station_many_details.length > 0 && data.prod_runcard_station_many_details[0]['qty_output'] != null){
                  //   totalNoOfOk += parseInt(data.prod_runcard_station_many_details[0]['qty_output']);
                  // }

                  // console.log(data['prod_runcard_station_many_details'].length);

                  // if(data['prod_runcard_station_many_details'].length > 0){
                  //   // for(let index = 0; index < data['prod_runcard_station_many_details'].length; index++){
                  //   //   if(data['prod_runcard_station_many_details'][index].qty_output != null){

                  //   //     totalNoOfOk += parseInt(data['prod_runcard_station_many_details'][index].qty_output);
                  //   //   }
                  //   //   // console.log(data['prod_runcard_station_many_details'][index].qty_output);
                  //   // }

                  //   // for(let index = data['prod_runcard_station_many_details'].length - 1; index >= 0; index--){
                  //   //   // Get Not Emboss
                  //   //   if(data['prod_runcard_station_many_details'][index].qty_output != null){
                  //   //     if(data['prod_runcard_station_many_details'][index]['has_emboss'] == 1){
                  //   //       totalNoOfOk += parseInt(data['prod_runcard_station_many_details'][index].qty_output);
                  //   //       break;
                  //   //     }
                  //   //   }
                  //   // }

                  //   for(let index = data['prod_runcard_station_many_details'].length - 1; index >= 0; index--){
                  //       // Get Not Emboss
                  //       if(data['prod_runcard_station_many_details'][index]['has_emboss'] == 0){
                  //         if(data['prod_runcard_station_many_details'][index]['has_emboss'] == 0){
                  //           if(data['prod_runcard_station_many_details'][index]['qty_output'] != null){
                  //             totalNoOfOk += parseInt(data['prod_runcard_station_many_details'][index]['qty_output']);
                  //             // console.log(data['prod_runcard_station_many_details'][index]['qty_output']);
                  //             break;
                  //           }
                  //         }
                  //       }
                  //     }
                  // }

                  // if(data.length > 0){
                  //     console.log(data);
                  //   for(let index = 0; index < data.length; index++){
                  //     if(data[index]['prod_runcard_station_many_details'].length > 0){
                  //       for(let index2 = data[index]['prod_runcard_station_many_details'].length - 1; index2 >= 0; index2--){
                  //         // Get Not Emboss
                  //         if(data[index]['prod_runcard_station_many_details'][index2]['has_emboss'] == 0){
                  //           totalNoOfOk = data[index]['prod_runcard_station_many_details'][index2]['qty_output'];
                  //           console.log(data[index]['prod_runcard_station_many_details'][index2]['qty_output']);
                  //           break;
                  //         }
                  //       }
                  //     }
                  //     else{
                  //       totalNoOfOk = 0;
                  //     }

                  //   }
                  // }
                  // else{
                  //   totalNoOfOk = 0;
                  // }

                  totalNoOfNG += data.total_no_of_ng;
              });

              // console.log(totalNoOfOk);
              // console.log(totalNoOfNG);
              $("#btnShowNGSummary").prop('disabled', false);
              $("#txt_total_no_of_ok").val(totalNoOfOk);
              $("#txt_total_no_of_ng").val(totalNoOfNG);

              // $("#btn_edit_material_details_verification").removeAttr('disabled');
            }
            else{
              // $("#btn_edit_material_details_verification").prop('disabled', 'disabled');
              totalNoOfOk = 0;
              totalNoOfNG = 0;
              $("#txt_total_no_of_ok").val("");
              $("#txt_total_no_of_ng").val("");
              $("#btnShowNGSummary").prop('disabled', true);
            }
          },
          paging: false,
      });//end of DataTable

      dt_materials      = $('#tbl_materials').DataTable({
        "processing" : true,
          "serverSide" : true,
          "ajax" : {
            url: "view_materials_by_defect_escalation_id",
            data: function (param){
                param.runcard_id = $("#txt_prod_runcard_id_query").val();
            }
          },
          bAutoWidth: false,
          "columns":[
            { "data" : "material_info.name", orderable:false, searchable:false },
            { "data" : "lot_no", orderable:false, searchable:false },
            { "data" : "raw_type", orderable:false, searchable:false },
          ],
          paging: false,
          info: false,
          // searching: false,
          pageLength: -1,
          // order: [[2, "asc"]],
          "rowCallback": function(row,data,index ){
            // $('#txt_po_number_lbl').val( data['po'] );
            // // $('#txt_assessment_no').val( data['assessment'] );
            // // console.log(data['kit_issuance']['assessment']);
            // if($("#txt_prod_runcard_status").val() <= 2){
            //   // $("#txt_assessment_no").val(data['kit_issuance']['assessment']);
            //   assessment = data['kit_issuance']['assessment'];

            //   if(assessment != null){
            //     $("#txt_assessment_no").val(assessment);
            //   }
            // }
          },
          "drawCallback": function(row,data,index ){
            // $(".chkSelMatKitIssue").each(function(index){
            //     if(arrSelectedMaterial.includes($(this).attr('material-kit-issue-id'))){
            //       $(this).attr('checked', 'checked');
            //     }
            // });
            // // arrSelectedMaterial
            // arrSelectedMaterial = [];
            // $('#tbl_materials tbody .col_lot_id').each(function(){
            //   // if(!$(this).attr('disabled')){
            //   //   // console.log('disabled');
            //   //   arr_substations[ctr] = {
            //   //       'step' : $(this).closest('td').find('.col_station_step').val(),
            //   //       'station' : $(this).closest('td').find('.col_station_id').val(),
            //   //       'substation' : $(this).closest('td').find('.col_sub_station_id').val(),
            //   //     };
            //   // }
            //   // console.log($(this).val());
            //   arrSelectedMaterial.push($(this).val());
            // });
            // if(arrSelectedMaterial.length > 0 || arrSelectedSakidashi.length > 0){
            //   // $("#btnSaveSelectedMatSak").prop('disabled', false);
            //   $("#spanNoOfSelectedMatSak").text("(" + (parseInt(arrSelectedMaterial.length) + parseInt(arrSelectedSakidashi.length)) + ")");
            // }
            // else{
            //   // $("#btnSaveSelectedMatSak").prop('disabled', true);
            //   $("#spanNoOfSelectedMatSak").text("");
            // }

            // if(hasProdMatSakList){
            //   // $("#btnSaveSelectedMatSak").prop('disabled', true);
            // }
            // else{
            //   // $("#btnSaveSelectedMatSak").prop('disabled', false);
            // }
            // console.log(arrSelectedMaterial);
          },
      });//end of DataTable

      dt_sakidashi      = $('#tbl_sakidashi').DataTable({
          "processing" : true,
          "serverSide" : true,
          "ajax" : {
            url: "view_manual_sakidashi_by_runcard",
            data: function (param){
                param.po_number = currentPoNo;
                // param.po_number = $("#txt_po_number_lbl").val();
                param.runcard_status = $("#txt_prod_runcard_status").val();
                param.sakidashi_list = arrSelectedSakidashi;
                param.material_kit_list = arrSelectedMaterial;
                param.prod_runcard_id_query = $("#txt_prod_runcard_id_query").val();
                param.lot_no = sakidashiIssuanceLotNo;
                // param.control_no = sakidashiCtrlNo;
                param.has_mat_sak_list = hasProdMatSakList;
                param.action = viewSakidashiAction;
                param.lot_no = viewSakidashiActionLotNo;
            }
          },
          bAutoWidth: false,
          paging: true,
          "columns":[
            // { "data" : "action", orderable:false, searchable:false },
            { "data" : "btn_save_material", orderable:false, searchable:false, visible:true },
            { "data" : "status", orderable:false, searchable:false },
            { "data" : "issuance_no", orderable:true, searchable:true },
            { "data" : "tbl_wbs_sakidashi_issuance_item.item_desc", orderable:false, searchable:true },
            { "data" : "tbl_wbs_sakidashi_issuance_item.lot_no", orderable:false, searchable:true },
            { "data" : "device_code", orderable:false, searchable:true },
            { "data" : "tbl_wbs_sakidashi_issuance_item.required_qty", orderable:false, searchable:true },
            { "data" : "tbl_wbs_sakidashi_issuance_item.issued_qty", orderable:false, searchable:true },
            // { "data" : "lot_qty_to_complete" },
            // { "data" : "runcard_used_qty" },
          ],
          order: [[2, "asc"]],
          "rowCallback": function(row,data,index ){
            // Check for production done verification
            // if( $(row).html().toLowerCase().indexOf('parts prep. done verification')>0 ){
            //   $(row).addClass('table-success');
            // }
            // if( $(row).html().toLowerCase().indexOf('returned')>0 ){
            //   $(row).addClass('table-warning');
            // }
          },
          "drawCallback": function(row,data,index ){
            $(".chkSelSakidashiIssue").each(function(index){
                if(arrSelectedSakidashi.includes($(this).attr('sakidashi-issue-id'))){
                  $(this).attr('checked', 'checked');
                }
            });

            // arrSelectedSakidashi = [];
            // $('#tbl_sakidashi tbody .col_lot_id').each(function(){
            //   arrSelectedSakidashi.push($(this).val());
            // });

            // if(arrSelectedSakidashi.length > 0){
            //   // $("#btnSaveSelectedMatSak").prop('disabled', false);
            //   $("#spanNoOfSelectedMatSak").text("(" + (parseInt(arrSelectedMaterial.length) + parseInt(arrSelectedSakidashi.length)) + ")")
            // }
            // else{
            //   // $("#btnSaveSelectedMatSak").prop('disabled', true);
            //   // $("#spanNoOfSelectedMatSak").text("")
            // }
            // console.log(arrSelectedSakidashi);
          },
          // "columnDefs": [
          //   {
          //     "targets": [3, 4, 5, 6, 7],
          //     "data": null,
          //     "defaultContent": "--"
          //   },
          // ],
          paging: false,
          info: false,
          searching: true,
          pageLength: -1,
          order: [[2, "asc"]],
      });//end of DataTable

      // dt_emboss      = $('#tbl_emboss').DataTable({
      //     "processing" : true,
      //     "serverSide" : true,
      //     "ajax" : {
      //       url: "view_manual_emboss_by_runcard",
      //       data: function (param){
      //           // param.po_number = currentPoNo;
      //           // param.runcard_status = $("#txt_prod_runcard_status").val();
      //           // param.emboss_kit_list = arrSelectedEmboss;
      //           // param.prod_runcard_id_query = $("#txt_prod_runcard_id_query").val();
      //           // param.lot_no = embossIssuanceLotNo;
      //           // // param.control_no = sakidashiCtrlNo;
      //           // param.has_mat_sak_list = hasProdMatSakList;
      //           // param.require_oqc_before_emboss = $("#txt_prod_runcard_require_oqc_before_emboss").val();

      //           param.po_number = currentPoNo;
      //           param.runcard_status = $("#txt_prod_runcard_status").val();
      //           param.emboss_kit_list = arrSelectedEmboss;
      //           param.prod_runcard_id_query = $("#txt_prod_runcard_id_query").val();
      //           param.lot_no = embossIssuanceLotNo;
      //           // param.control_no = sakidashiCtrlNo;
      //           param.has_mat_sak_list = hasProdMatSakList;
      //           param.action = viewEmbossAction;
      //           param.lot_no = viewEmbossActionLotNo;
      //       }
      //     },
      //     bAutoWidth: false,
      //     paging: true,
      //     "columns":[
      //       // { "data" : "action", orderable:false, searchable:false },
      //       { "data" : "btn_save_material", orderable:false, searchable:false },
      //       { "data" : "status", orderable:false, searchable:false },
      //       { "data" : "issuance_no", orderable:true, searchable:true },
      //       { "data" : "tbl_wbs_sakidashi_issuance_item.item_desc", orderable:false, searchable:true },
      //       { "data" : "tbl_wbs_sakidashi_issuance_item.lot_no", orderable:false, searchable:true },
      //       { "data" : "device_code", orderable:false, searchable:true },
      //       { "data" : "tbl_wbs_sakidashi_issuance_item.required_qty", orderable:false, searchable:true },
      //       { "data" : "tbl_wbs_sakidashi_issuance_item.issued_qty", orderable:false, searchable:true },
      //       // { "data" : "lot_qty_to_complete" },
      //       // { "data" : "runcard_used_qty" },
      //     ],
      //     order: [[2, "asc"]],
      //     "rowCallback": function(row,data,index ){
      //       // Check for production done verification
      //       // if( $(row).html().toLowerCase().indexOf('parts prep. done verification')>0 ){
      //       //   $(row).addClass('table-success');
      //       // }
      //       // if( $(row).html().toLowerCase().indexOf('returned')>0 ){
      //       //   $(row).addClass('table-warning');
      //       // }
      //     },
      //     "drawCallback": function(row,data,index ){
      //       $(".chkSelEmbossIssue").each(function(index){
      //           if(arrSelectedEmboss.includes($(this).attr('emboss-issue-id'))){
      //             $(this).attr('checked', 'checked');
      //           }
      //       });

      //       if(arrSelectedEmboss.length > 0){
      //         // $("#btnSaveSelectedMatSak").prop('disabled', false);
      //         $("#spanNoOfSelectedEmboss").text("(" + arrSelectedEmboss.length + ")")
      //       }
      //       else{
      //         // $("#btnSaveSelectedMatSak").prop('disabled', true);
      //         $("#spanNoOfSelectedEmboss").text("")
      //       }

      //       // arrSelectedSakidashi = [];
      //       // $('#tbl_sakidashi tbody .col_lot_id').each(function(){
      //       //   arrSelectedSakidashi.push($(this).val());
      //       // });

      //       // if(arrSelectedSakidashi.length > 0){
      //       //   // $("#btnSaveSelectedMatSak").prop('disabled', false);
      //       //   $("#spanNoOfSelectedMatSak").text("(" + (parseInt(arrSelectedMaterial.length) + parseInt(arrSelectedSakidashi.length)) + ")")
      //       // }
      //       // else{
      //       //   // $("#btnSaveSelectedMatSak").prop('disabled', true);
      //       //   // $("#spanNoOfSelectedMatSak").text("")
      //       // }
      //       // console.log(arrSelectedSakidashi);
      //     },
      //     // "columnDefs": [
      //     //   {
      //     //     "targets": [3, 4, 5, 6, 7],
      //     //     "data": null,
      //     //     "defaultContent": "--"
      //     //   },
      //     // ],
      //     paging: false,
      //     info: false,
      //     searching: true,
      //     pageLength: -1,
      //     order: [[2, "asc"]],
      // });//end of DataTable

      let dtOutputStatus = 0;
      let groupStations = 2;
      dt_prod_runcard_stations = $('#tbl_prod_runcard_stations').DataTable({
        "processing" : true,
          "serverSide" : true,
          "ajax" : {
            url: "view_de_stations",
            data: function (param){
                param.prod_runcard_id_query          = $("#txt_prod_runcard_id_query").val();
                param.prod_runcard_status          = $("#txt_prod_runcard_status").val();
                // param.has_emboss          = $("#sel_runcard_type").val();
                param.prod_runcard_no          = $("#txt_runcard_no").val();
                // param.require_oqc_before_emboss          = $("#txt_prod_runcard_require_oqc_before_emboss").val();
            }
          },
          
          "columns":[
            { "data" : "raw_action", orderable:false, searchable:false, visible: false },
            { "data" : "step_num", orderable:false, searchable:true },
            { "data" : "sub_station.name", orderable:false, searchable:true },
            { "data" : "updated_at", orderable:false, searchable:true },
            {
                name: 'defect_escalation_station_operator_details',
                data: 'defect_escalation_station_operator_details',
                sortable: false,
                searchable: false,
                render: function (data) {
                  // console.log(data);
                    var result = '';
                    if(data.length > 0){
                      for(let index = 0; index < data.length; index++){
                        result += '<span class="badge badge-pill badge-secondary">' + data[index]['operator_info']['name'] + '</span>';

                        if(index <= parseInt(data.length) - 2){
                          result += '<br>';
                        }
                      }
                    }
                    else{
                      result = null;
                    }
                    return result;
                }
            },
            {
                name: 'defect_escalation_station_machine_details',
                data: 'defect_escalation_station_machine_details',
                sortable: false,
                searchable: false,
                render: function (data) {
                  // console.log(data);
                    var result = '';
                    if(data.length > 0){
                      for(let index = 0; index < data.length; index++){
                        result += '<span class="badge badge-pill badge-secondary">' + data[index]['machine_info']['name'] + '</span>';

                        if(index <= parseInt(data.length) - 2){
                          result += '<br>';
                        }
                      }
                    }
                    else{
                      result = null;
                    }
                    return result;
                }
            },
            { "data" : "qty_good", orderable:false, searchable:true },
            { "data" : "qty_ng", orderable:false, searchable:true },
            { "data" : "remarks", orderable:false, searchable:true },
          ],
          order: [[1, "asc"]],
          paging: false,
          info: false,
          searching: false,
          pageLength: -1,
          "columnDefs": [ 
                // { "visible": false, "targets": groupStations },
                // { "visible": false, "targets": groupStations + 1 },
                {
                  "targets": [-1],
                  "data": null,
                  "defaultContent": "--"
                },
                // {
                //   "targets": [12],
                //   "data": null,
                //   "defaultContent": "N/A"
                // },
           ],
           "drawCallback": function ( settings ) {
              // var api = this.api();
              // var rows = api.rows( {page:'current'} ).nodes();
              // var last = null;

              // if(api.rows().count() > 0){
              //   // $("#btn_edit_material_details_verification").prop('disabled', false);
              // }
              // else{
              //   // $("#btn_edit_material_details_verification").prop('disabled', true);
              // }

              // OutputDataCounter(api);

              // api.column(groupStations, {page:'current'} ).data().each( function ( group, i ) {
              //     if ( last !== group ) {

              //       let data = api.row(i).data();
              //       let station_name = data.station.name;
              //       let groupRowClass = 'bg-info';

              //       // if($("#sel_runcard_type").val() == 1){
              //       //   groupRowClass = 'bg-warning';                          
              //       // }

              //         $(rows).eq( i ).before(
              //             '<tr class="group ' + groupRowClass + '"><td colspan="11" style="text-align:center;"><b>' + station_name + '</b></td></tr>'
              //         );

              //         last = group;
              //     }
              // });

              // let lastProdStationStat = false;

              // console.log($("#tbl_prod_runcard_stations tr:last").find('.btn_edit_prod_runcard_station').attr('disabled'));
            }
      });//end of DataTable

      //----------
      dt_setup_stations      = $('#tbl_setup_stations').DataTable({
        "processing" : true,
          "serverSide" : true,
          "ajax" : {
            url: "select_prod_runcard_setup_stations",
            data: function (param){
                // param.po_number              = $("#txt_search_po_number").val();
                param.device_code                  = $("#txt_device_code_lbl").val();
                param.prod_runcard_id_query          = $("#txt_prod_runcard_id_query").val();
            }
          },
          
          "columns":[
            { "data" : "raw_action", orderable:false, searchable:false },
            // { "data" : "raw_status", orderable:false, searchable:false },
            { "data" : "step" },
            { "data" : "station_sub_station.station.name" },
            { "data" : "station_sub_station.sub_station.name" },
            // { "data" : "qty_input" },
            // { "data" : "raw_operator" },
            // { "data" : "raw_input" },
            // { "data" : "raw_output" },
            // { "data" : "raw_ng_qty" },
            // { "data" : "raw_mod" },
          ],
          order: [[1, "asc"]],
          paging: false,
          info: false,
          searching: false,
      });//end of DataTable

      // $("#sel_runcard_type").change(function(){
      //   dt_prod_runcard_stations.draw();
        // if($(this).val() == 0){
        //   $('#myTab a[href="#home"]').tab('show');
        //   $('#myTab a[href="#profile"]').tab('show');
        //   $('#myTab a[href="#materialEmbossTab"]').tab('hide'); 
        // }
        // else{
        //   $('#myTab a[href="#home"]').tab('hide');
        //   $('#myTab a[href="#profile"]').tab('hide');
        //   $('#myTab a[href="#materialEmbossTab"]').tab('show'); 
        // }
      // });

      let groupMODRuncardNo = 0;
      dt_ng_summary = $('#tblNGSummary').DataTable({
        "processing" : true,
          "serverSide" : true,
          "ajax" : {
            url: "view_ng_summary",
            data: function (param){
                param.po_no          = currentPoNo;
                // param.po_no          = $('#txt_po_number_lbl').val();
                
            }
          },
          
          "columns":[
            { "data" : "production_runcard_id", orderable:false, searchable:false },
            { "data" : "production_runcard_details.runcard_no", orderable:false, searchable:true },
            { "data" : "mod_details.name" , orderable:true, searchable:false},
            { "data" : "mod_qty" , orderable:true, searchable:false},
          ],
          order: [[groupMODRuncardNo, "desc"]],
          paging: true,
          info: true,
          searching: true,
          // pageLength: -1,
          "columnDefs": [ 
                { "visible": false, "targets": groupMODRuncardNo },
                { "visible": false, "targets": 1 },
                // { "visible": false, "targets": groupMODRuncardNo + 1 },
                {
                  "targets": [0, 1, 2, 3],
                  "data": null,
                  "defaultContent": "--"
                },
           ],
           order: [[0]],
           "drawCallback": function ( settings ) {
              var api = this.api();
              var rows = api.rows( {page:'current'} ).nodes();
              var last = null;

              api.column(groupMODRuncardNo, {page:'current'} ).data().each( function ( group, i ) {
                  if ( last !== group ) {

                    let data = api.row(i).data();
                    let production_runcard_id = '';
                    let production_runcard_no = '';

                    if(data.production_runcard_id != null){
                      production_runcard_id = data.production_runcard_id;
                    }
                    if(data.production_runcard_details != null){
                       production_runcard_no = data.production_runcard_details.runcard_no;
                    }
                    // let station_name = data.station.name;

                      $(rows).eq( i ).before(
                          '<tr class="group bg-info"><td colspan="2" style="text-align:center;" class="trNGSummaryRuncardNo">Defect Escalation # : <b>' + production_runcard_no + '</b></td></tr>'
                      );

                      last = group;
                  }
              });
            }
      });//end of DataTable

      // $(document).on('keyup','#txt_search_po_number',function(e){
      //   if( e.keyCode == 13 ){
      //     currentPoNo = $(this).val();
      //     dt_prod_runcard.draw();
      //     // dt_sakidashi.draw();
      //     // dt_materials.draw();
      //     $('#tbl_materials tbody tr').removeClass('table-active');
      //     $('#txt_po_number_lbl').val('');
      //     $('#txt_device_name_lbl').val('');
      //     $('#txt_device_code_lbl').val('');
      //     $('#txt_po_qty_lbl').val('');
      //     $('#txt_device_name').val('');
      //     $(this).val('');
      //     $(this).focus();
      //   }
      // });

      // $("#tblNGSummary tbody").on('click', '.trNGSummaryRuncardNo', function(){
      //   dt_ng_summary.order([[1, 'desc']]).draw();
      // });

      $(document).on('keyup','#txt_search_material_lot_no',function(e){
        if( e.keyCode == 13 ){
          materialKitIssuanceLotNo = $(this).val();
          $("#txt_material_lot_no_lbl").val(materialKitIssuanceLotNo);
          dt_materials.draw();
          $(this).val('');
          $(this).focus();
        }
      });

      $(document).on('keyup','#txt_search_material_transfer_slip',function(e){
        if( e.keyCode == 13 ){
          materialKitTransferSlip = $(this).val().trim();
          $("#txt_material_transfer_slip_lbl").val(materialKitTransferSlip);
          dt_materials.draw();
          $(this).val('');
          $(this).focus();
        }
      });

      $(document).on('keyup','#txt_search_sakidashi_lot_no',function(e){
        if( e.keyCode == 13 ){
          sakidashiIssuanceLotNo = $(this).val().trim();
          $("#txt_sakidashi_lot_no_lbl").val(sakidashiIssuanceLotNo);
          dt_sakidashi.draw();
          $(this).val('');
          $(this).focus();
        }
      });

      // $(document).on('keyup','#txt_search_emboss_lot_no',function(e){
      //   if( e.keyCode == 13 ){
      //     embossIssuanceLotNo = $(this).val().trim();
      //     $("#txt_emboss_lot_no_lbl").val(embossIssuanceLotNo);
      //     // dt_emboss.draw();
      //     $(this).val('');
      //     $(this).focus();
      //   }
      // });

      $(document).on('keyup','#txt_search_sakidashi_ctrl_no',function(e){
        if( e.keyCode == 13 ){
          sakidashiCtrlNo = $(this).val();
          $("#txt_sakidashi_ctrl_no_lbl").val(sakidashiCtrlNo);
          dt_sakidashi.draw();
          $(this).val('');
          $(this).focus();
        }
      });

      $(document).on('keypress',function(e){
        if( ($("#mdl_employee_number_scanner").data('bs.modal') || {})._isShown ){
          $('#txt_employee_number_scanner').focus();
          if( e.keyCode == 13 && $('#txt_employee_number_scanner').val() !='' && ($('#txt_employee_number_scanner').val().length >= 4) ){
            $('#mdl_employee_number_scanner').modal('hide');
            var formid = $("#mdl_employee_number_scanner").attr('data-formid');

            if ( ( formid ).indexOf('#') > -1){
              $( formid ).submit();
            }
            else{
              switch( formid ){
                case 'save_setup_stations':
                save_setup_stations();
                break;
                case 'save_approve_qc':
                save_approve_qc();
                break;
                case 'save_approve_prod':
                save_approve_prod();
                break;
                case 'save_rework_verification':
                SaveReworkVerification($('#txt_employee_number_scanner').val(), "{{ csrf_token() }}");
                break;
                case 'SaveProdMaterialList':
                  if(arrSelectedMaterial.length > 0 || arrSelectedSakidashi > 0){
                    SaveProductMaterialList(arrSelectedMaterial, arrSelectedSakidashi, "{{ csrf_token() }}", $("#txt_employee_number_scanner").val(), $("#txt_prod_runcard_id_query").val());
                  }
                  else{
                    toastr.warning('No Materials to be saved.');
                  }
                break;
                case 'submit_to_oqc_lot_app':
                submit_to_oqc_lot_app();
                break;
                case 'save_material':
                save_material();
                break;
                // case 'SaveProdEmbossMaterialList':
                //   if(arrSelectedEmboss.length > 0){
                //     SaveProductEmbossMaterialList(arrSelectedEmboss, "{{ csrf_token() }}", $("#txt_employee_number_scanner").val(), $("#txt_prod_runcard_id_query").val());
                //   }
                //   else{
                //     toastr.warning('No Materials to be saved.');
                //   }
                // break;
                default:
                break;
              }
            }
          }
        }
        else if( ($("#mdl_qrcode_scanner").data('bs.modal') || {})._isShown ){
          $('#txt_qrcode_scanner').focus();
          if( e.keyCode == 13 ){
            $('#mdl_qrcode_scanner').modal('hide');
            // alert($("#txt_qrcode_scanner").val());
            var formid = $("#mdl_qrcode_scanner").attr('data-formid');

            if ( ( formid ).indexOf('#') > -1){
              $( formid ).submit();
            }
            else{
              switch( formid ){
                case 'fn_scan_machine_code':
                  var val = $('#txt_qrcode_scanner').val();

                  // let scannedMachineId = $('#txt_edit_prod_runcard_station_machine').find("option[data-code='" + val + "']").val();
                  // let assignedMachine = $("#txt_edit_prod_runcard_station_assigned_machine").val();

                  // if(assignedMachine == scannedMachineId){
                  //   $('#txt_edit_prod_runcard_station_machine option[data-code="'+val+'"]').prop('selected', true).trigger('change');
                  // }
                  // else{
                  //   $('#txt_edit_prod_runcard_station_machine').val("").trigger('change');
                  //   toastr.warning('Invalid Machine!');
                  // }

                  // Replaced
                  // if ($('#txt_edit_prod_runcard_station_machine').find("option[data-code='" + val + "']").length) {
                  //   let scannedMachineId = $('#txt_edit_prod_runcard_station_machine').find("option[data-code='" + val + "']").val();
                  //   let assignedMachine = $("#txt_edit_prod_runcard_station_assigned_machine").val();

                  //   if(assignedMachine == scannedMachineId){
                  //     $('#txt_edit_prod_runcard_station_machine option[data-code="'+val+'"]').prop('selected', true).trigger('change');
                  //   }
                  //   else{
                  //     $('#txt_edit_prod_runcard_station_machine').val("").trigger('change');
                  //     toastr.warning('Wrong Machine!');
                  //   }
                  // }
                  // else{
                  //   $('#txt_edit_prod_runcard_station_machine').val("").trigger('change');
                  //   toastr.warning('Invalid Machine!');
                  // }
                  // $('#txt_qrcode_scanner').val("");

                  // with this
                  var val = $('#txt_qrcode_scanner').val();

                  if ($('#txt_edit_prod_runcard_station_machine').find("option[data-code='" + val + "']").length) {
                    let scannedUserId = $('#txt_edit_prod_runcard_station_machine').find("option[data-code='" + val + "']").val();

                    let assignedMachine = $("#txt_edit_prod_runcard_station_assigned_machine").val();

                    // if(assignedMachine.includes(scannedUserId)){
                      // toastr.warning('Certified!');
                      $('#txt_edit_prod_runcard_station_machine option[data-code="'+val+'"]').prop('selected', true).trigger('change');
                    // }
                    // else{
                    //   toastr.warning('Not Assigned!');
                    // }

                  }
                  else{
                    toastr.warning('Invalid Machine!');
                  }
                  $('#txt_qrcode_scanner').val("");
                break;

                case 'fn_scan_runcard_operator_code':
                  var val = $('#txt_qrcode_scanner').val();

                  if ($('#txt_edit_prod_runcard_operator').find("option[data-code='" + val + "']")) {
                    let scannedUserId = $('#txt_edit_prod_runcard_operator').find("option[data-code='" + val + "']").val();

                    let certifiedOperators = $("#txt_edit_prod_runcard_cert_operator").val();

                    // if(certifiedOperators.includes(scannedUserId)){
                      // toastr.warning('Certified!');
                      $('#txt_edit_prod_runcard_operator option[data-code="'+val+'"]').prop('selected', true).trigger('change');
                    // }
                    // else{
                    //   toastr.warning('Not Certified!');
                    // }

                  }
                  else{
                    toastr.warning('Invalid User!');
                  }
                  $('#txt_qrcode_scanner').val("");
                break;

                case 'fn_scan_material_kitting':
                  var val = $('#txt_qrcode_scanner').val();
                break;

                case 'fn_scan_sakidashi':
                  var val = $('#txt_qrcode_scanner').val();
                break;

                case 'btnScanMaterialLotNo':
                  // var val = $('#txt_qrcode_scanner').val();
                  // $("input[name='lot_no']", $("#frmSaveMaterial")).val(val);
                  var lotNo = $('#txt_qrcode_scanner').val();
                  // $("input[name='lot_no']", $("#frmSaveMaterial")).val(val); 
                  // Material Checking Function Here
                  CheckMaterialLotNo(lotNo);
                break;

                // case 'fn_scan_emboss':
                //   var val = $('#txt_qrcode_scanner').val();
                // break;

                default:
                break;
              }
            }            
          }//key
        }
        // SCAN PO, LOT, TRANSFER SLIP CODE
        if( ($("#modalScanPOTransLotCode").data('bs.modal') || {})._isShown ){
          $('#txtSearchPoTransLotNo').focus();
          if( e.keyCode == 13 && $('#txtSearchPoTransLotNo').val() !='' && ($('#txtSearchPoTransLotNo').val().length >= 4) ){
            // $('#modalScanPOTransLotCode').modal('hide');
            $("#scanPOTransLotIcon").removeClass('fa-spinner fa-pulse');
            $("#scanPOTransLotIcon").addClass('fa-qrcode');

            var formid = $("#modalScanPOTransLotCode").attr('data-formid');

            if ( ( formid ).indexOf('#') > -1){
              $( formid ).submit();
            }
            else{
              let scannedValue = "";
              switch( formid ){
                case 'search_po_number':
                  currentPoNo = $("#txtSearchPoTransLotNo").val().split(' ')[0];
                  dt_prod_runcard.draw();
                  $('#tbl_materials tbody tr').removeClass('table-active');
                  $('#txt_po_number_lbl').val('');
                  $('#txt_device_name_lbl').val('');
                  $('#txt_device_code_lbl').val('');
                  $('#txt_po_qty_lbl').val('');
                  $('#txt_device_name').val('');
                  $(this).val('');
                  $(this).focus();
                  $("#modalScanPOTransLotCode").modal('hide');
                break;

                case 'scan_mat_kit':
                  scannedValue = $("#txtSearchPoTransLotNo").val().split(' ')[0];
                  // alert(scannedValue);
                  $(this).focus();
                  viewMatKitAction = 1;
                  viewMatKitActionLotNo = null;
                  ScanProdRuncardMaterialKiting(scannedValue);
                  $("#txtScannedMatKitLot").val(scannedValue.trim());
                break;

                case 'scan_sakidashi':
                  scannedValue = $("#txtSearchPoTransLotNo").val().split(' ')[0];
                  // alert(scannedValue);
                  $(this).focus();
                  ScanProdRuncardSakidashiIssuance(scannedValue);
                  $("#txtScannedSakidashiLot").val(scannedValue.trim());
                break;

                // case 'scan_emboss':
                //   scannedValue = $("#txtSearchPoTransLotNo").val().split(' ')[0];
                //   // alert(scannedValue);
                //   $(this).focus();
                //   ScanProdRuncardEmboss(scannedValue);
                //   $("#txtScannedEmbossLot").val(scannedValue.trim());
                // break;

                case 'scan_employee_no':
                  scannedValue = $("#txtSearchPoTransLotNo").val().split(' ')[0];
                  // alert(scannedValue);
                  $(this).focus();
                  ScanProdRuncardEmployee(scannedValue);
                  $("#txtScannedEmployeeNo").val(scannedValue.trim());
                break;

                case 'search_mat_kit':
                  scannedValue = $("#txtSearchPoTransLotNo").val().split(' ')[0];
                  // alert(scannedValue);
                  $(this).focus();
                  $("#txtSearchedMatKitLot").val('');
                  viewMatKitAction = 2;
                  viewMatKitActionLotNo = scannedValue;
                  $("#txtSearchedMatKitLot").val(scannedValue.trim());
                  dt_materials.draw();
                  $("#modalScanPOTransLotCode").modal('hide');
                break;

                case 'search_sakidashi':
                  scannedValue = $("#txtSearchPoTransLotNo").val().split(' ')[0];
                  // alert(scannedValue);
                  $(this).focus();
                  $("#txtSearchedSakidashiLotNo").val('');
                  viewSakidashiAction = 2;
                  viewSakidashiActionLotNo = scannedValue;
                  $("#txtSearchedSakidashiLot").val(scannedValue.trim());
                  dt_sakidashi.draw();
                  $("#modalScanPOTransLotCode").modal('hide');
                break;

                // case 'search_emboss':
                //   scannedValue = $("#txtSearchPoTransLotNo").val().split(' ')[0];
                //   // alert(scannedValue);
                //   $(this).focus();
                //   $("#txtSearchedEmbossLotNo").val('');
                //   viewEmbossAction = 2;
                //   viewEmbossActionLotNo = scannedValue;
                //   $("#txtSearchedEmbossLot").val(scannedValue.trim());
                //   // dt_emboss.draw();
                //   $("#modalScanPOTransLotCode").modal('hide');
                // break;

                case 'save_mat_kit':
                  scannedValue = $("#txtSearchPoTransLotNo").val().split(' ')[0];
                  SaveSakidashiLotIssuanceId(saveMatKitLotIssuanceId, saveMatKitLotItem, saveMatKitLotItemDesc, scannedValue);
                  saveMatKitLotIssuanceId = null;
                  saveMatKitLotItem = null;
                  saveMatKitLotItemDesc = null;
                break;

                case 'save_sakidashi_lot_issuance':
                  if($("#txt_prod_runcard_id_query").val() == null || $("#txt_prod_runcard_id_query").val() == ''){
                    toastr.error('No Runcard Details.');
                  }
                  else{
                    scannedValue = $("#txtSearchPoTransLotNo").val().split(' ')[0];
                    SaveSakidashiLotIssuanceId(saveSakidashiLotIssuanceId, saveSakidashiLotItem, saveSakidashiLotItemDesc, scannedValue);
                    saveSakidashiLotIssuanceId = null;
                    saveSakidashiLotItem = null;
                    saveSakidashiLotItemDesc = null;
                  }
                break;

                // case 'save_emboss_lot_issuance':
                //   if($("#txt_prod_runcard_id_query").val() == null || $("#txt_prod_runcard_id_query").val() == ''){
                //     toastr.error('No Runcard Details.');
                //   }
                //   else{
                //     scannedValue = $("#txtSearchPoTransLotNo").val().split(' ')[0];
                //     SaveEmbossLotIssuanceId(saveEmbossLotIssuanceId, saveEmbossLotItem, saveEmbossLotItemDesc, scannedValue);
                //     saveEmbossLotIssuanceId = null;
                //     saveEmbossLotItem = null;
                //     saveEmbossLotItemDesc = null;
                //   }
                // break;

                // case 'scan_whs_slip_no': 
                //   scannedValue = $("#txtSearchPoTransLotNo").val().split(' ')[0];
                //   $("#txtScannedWHSSlipNo").val(scannedValue);
                // break;

                default:
                break;
              }
            }
          }
        }
      });

      $(document).on('click','#tbl_prod_runcard tr',function(e){
        $(this).closest('tbody').find('tr').removeClass('table-active');
        $(this).closest('tr').addClass('table-active');
      });

      $("#tbl_sakidashi").on('click', '.chkSelSakidashiIssue', function(e){
        let sakidashiId = $(this).attr('sakidashi-issue-id');
        if($("#txt_prod_runcard_id_query").val() == "" || $("#txt_prod_runcard_id_query").val() == null){
          toastr.warning('Fill-out Material Details First');
          $(this).prop('checked', false);
        }
        else{
          if($(this).prop('checked')){
              // Checked
              if(!arrSelectedSakidashi.includes(sakidashiId)){
                arrSelectedSakidashi.push(sakidashiId);
              }
          }
          else{  
              // Unchecked
              let index = arrSelectedSakidashi.indexOf(sakidashiId);
              arrSelectedSakidashi.splice(index, 1);
          }

          let noOfSelected = parseInt(arrSelectedSakidashi.length) + parseInt(arrSelectedMaterial.length);
          if(noOfSelected > 0){
            $("#spanNoOfSelectedMatSak").text('(' + noOfSelected + ')');
            if($("#txt_prod_runcard_id_query").val() == "" || $("#txt_prod_runcard_id_query").val() == null){
            
            }
            else{
              $("#btnSaveSelectedMatSak").prop('disabled', false);
            }
          }
          else{
            $("#spanNoOfSelectedMatSak").text(''); 
            $("#btnSaveSelectedMatSak").prop('disabled', true);
          }
        }
        $("#txt_search_sakidashi_lot_no").focus();
      });

      // $("#tbl_emboss").on('click', '.chkSelEmbossIssue', function(e){
      //   let embossId = $(this).attr('emboss-issue-id');
      //   if($("#txt_prod_runcard_id_query").val() == "" || $("#txt_prod_runcard_id_query").val() == null){
      //     toastr.warning('Fill-out Material Details First');
      //     $(this).prop('checked', false);
      //   }
      //   else{
      //     if($(this).prop('checked')){
      //         // Checked
      //         if(!arrSelectedEmboss.includes(embossId)){
      //           arrSelectedEmboss.push(embossId);
      //         }
      //     }
      //     else{  
      //         // Unchecked
      //         let index = arrSelectedEmboss.indexOf(embossId);
      //         arrSelectedEmboss.splice(index, 1);
      //     }

      //     let noOfSelected = parseInt(arrSelectedEmboss.length);
      //     if(noOfSelected > 0){
      //       // For button of adding material 
      //       $("#spanNoOfSelectedEmboss").text('(' + noOfSelected + ')');
      //       if($("#txt_prod_runcard_id_query").val() == "" || $("#txt_prod_runcard_id_query").val() == null){
            
      //       }
      //       else{
      //         $("#btnSaveSelectedEmboss").prop('disabled', false);
      //       }
      //     }
      //     else{
      //       // For button of adding material 
      //       $("#spanNoOfSelectedEmboss").text(''); 
      //       $("#btnSaveSelectedEmboss").prop('disabled', true);
      //     }
      //   }
      //   $("#txt_search_emboss_lot_no").focus();
      // });

      $("#tbl_materials").on('click', '.chkSelMatKitIssue', function(e){
        let matKitIssue = $(this).attr('material-kit-issue-id');
        if($("#txt_prod_runcard_id_query").val() == "" || $("#txt_prod_runcard_id_query").val() == null){
          toastr.warning('Fill-out Material Details First');
          $(this).prop('checked', false);
        }
        else{
          if($(this).prop('checked')){
              // Checked
              if(!arrSelectedMaterial.includes(matKitIssue)){
                arrSelectedMaterial.push(matKitIssue);
              }
          }
          else{
              // Unchecked
              let index = arrSelectedMaterial.indexOf(matKitIssue);
              arrSelectedMaterial.splice(index, 1);
          }

          let noOfSelected = parseInt(arrSelectedSakidashi.length) + parseInt(arrSelectedMaterial.length);
          if(noOfSelected > 0){
            $("#spanNoOfSelectedMatSak").text('(' + noOfSelected + ')');
            if($("#txt_prod_runcard_id_query").val() == "" || $("#txt_prod_runcard_id_query").val() == null){
            
            }
            else{
              // $("#btnSaveSelectedMatSak").prop('disabled', false);
            }
          }
          else{
            $("#spanNoOfSelectedMatSak").text('');
            // $("#btnSaveSelectedMatSak").prop('disabled', true);
          }
        }
      });

      $("#btnShowAddProdRuncard").click(function(){
        if($("#txt_po_number_lbl").val() == "" || $("#txt_po_number_lbl").val() == null){
          toastr.warning('PO not found!');
        }
        else{
          $("#btnAddMaterial").prop('disabled', true);
          $("#btnDEAddProcess").prop('disabled', true);
          $("#btnSubmitToOQCLotApp").prop('disabled', true);
          $("#btn_edit_material_details_primary").prop('disabled', false);
          viewMatKitAction = 1;
          viewMatKitActionLotNo = null;
          viewSakidashiAction = 1;
          viewSakidashiActionLotNo = null;
          // viewEmbossAction = 1;
          // viewEmbossActionLotNo = null;
          $("#txtScannedMatKitLot").val('')
          $("#txtScannedSakidashiLot").val('')
          // $("#txtScannedEmbossLot").val('')
          $("#txtScannedEmployeeNo").val('')
          $("#txtSearchedMatKitLot").val('');
          $("#txtSearchedSakidashiLotNo").val('');
          // $("#txtSearchedEmbossLotNo").val('');
          dt_materials.draw();
          dt_sakidashi.draw();
          // dt_emboss.draw();
          readonly_material_details_primary(true);
          readonly_material_details_secondary(true);
          reset_material_details_primary();
          reset_material_details_secondary();
          HandleButtons(true);
          // $("#btn_edit_material_details_primary").prop('disabled', false);
          // $("#btn_setup_stations").prop('disabled', true);
          $("#txt_lot_qty").val(boxing);
          $("#txt_assessment_no").val(assessment);
          $("#txt_a_drawing_no").val(aDrawing);
          $("#txt_a_drawing_rev").val(aDrawingRev);
          $("#txt_g_drawing_no").val(gDrawing);
          $("#txt_g_drawing_rev").val(gDrawingRev);
          $("#modalRuncardDetails").modal('show');
          arrSelectedMaterial = [];
          arrSelectedSakidashi = [];
          // arrSelectedEmboss = [];
          materialKitIssuanceLotNo = "";
          sakidashiIssuanceLotNo = "";
          // materialKitTransferSlip = $("#txt_material_transfer_slip_lbl").val();
          sakidashiCtrlNo = "";
          $("#txt_material_lot_no_lbl").val("");
          $("#txt_sakidashi_lot_no_lbl").val("");
          // dt_materials.draw();
          GetMaterialKitting();
          // GetSakidashiIssuance();
          dt_materials.draw();
          dt_sakidashi.draw();
          dt_prod_runcard_stations.draw();
          $("#txt_prod_runcard_id_query").val('');

          $("#txt_po_number").val($("#txt_po_number_lbl").val());
          $("#txt_po_qty").val($("#txt_po_qty_lbl").val());
          $("#txt_use_for_device").val($("#txt_device_name_lbl").val());
          $("#txt_device_code").val($("#txt_device_code_lbl").val());
          // $("#txt_use_for_device").val($("#txt_device_name_lbl").val());

          let noOfSelected = parseInt(arrSelectedSakidashi.length) + parseInt(arrSelectedMaterial.length);
          if(noOfSelected > 0){
            $("#spanNoOfSelectedMatSak").text('(' + noOfSelected + ')');
            // $("#btnSaveSelectedMatSak").prop('disabled', false);
          }
          else{
            $("#spanNoOfSelectedMatSak").text(''); 
            // $("#btnSaveSelectedMatSak").prop('disabled', true);
          }

          if(parseInt($("#txt_total_no_of_ok").val()) >= parseInt($("#txt_po_qty_lbl").val())){
            toastr.warning('PO Quantity already reached!');
          }
          // $("#btn_edit_material_details_primary").prop('disabled', false);
        }
      });

      $("#btnAddMODTable").click(function(){
        // $('#txt_edit_prod_runcard_operator').val(25).trigger('change');
        let appendHTML = '<tr>';
        appendHTML += '<td>';
          appendHTML += '<select class="form-control select2 select2bs4 selectMOD" name="mod[]">';
            appendHTML += '<option value="">N/A</option>';
          appendHTML += '</select>';
        appendHTML += '</td>';
        appendHTML += '<td>';
          appendHTML += '<input type="number" class="form-control txtEditProdRunStaMODQty" name="mod_qty[]" value="1" min="1">';
        appendHTML += '</td>';
        appendHTML += '<td>';
        appendHTML += '<select class="form-control" name="type_of_ng[]">';
            appendHTML += '<option value="1">MAT\'L NG.</option>';
            appendHTML += '<option value="2">PROD\'N NG.</option>';
          appendHTML += '</select>';
        appendHTML += '<td>';
          appendHTML += '<center><button class="btn btn-xs btn-danger btnRemoveMOD" title="Remove" type="button"><i class="fa fa-times"></i></button></center>';
        appendHTML += '</td>';
        appendHTML += '</tr>'

        $("#tblEditProdRunStaMOD tbody").append(appendHTML);
        $('.select2bs4').select2({
          theme: 'bootstrap4'
        });

        GetCboMOD($("#tblEditProdRunStaMOD tr:last").find('.selectMOD'));

        let totalNoOfMOD = 0;

        $('#tblEditProdRunStaMOD .txtEditProdRunStaMODQty').each(function(i, obj) {
          if($(this).val() == null || $(this).val() == ""){
          }
          else{
            totalNoOfMOD += parseFloat($(this).val());
          }
        });
        if($("#txt_edit_prod_runcard_station_ng").val() != totalNoOfMOD){
          toastr.warning('MOD NG Qty not Tally!');
          $("#pRCStatTotNoOfNG").css({color: 'red'});
          $("#btn_save_prod_runcard_station_stations").prop('disabled', true);
          $("#pRCStatTotNoOfNG").css({color: 'red'});
        }
        else{
          $("#pRCStatTotNoOfNG").css({color: 'green'});
          $("#btn_save_prod_runcard_station_stations").prop('disabled', false);
          $("#pRCStatTotNoOfNG").css({color: 'green'});
        }
        $("#pRCStatTotNoOfNG").text(totalNoOfMOD);
      });

      $("#tblEditProdRunStaMOD").on('click', '.btnRemoveMOD', function(){
        $(this).closest ('tr').remove();
        let totalNoOfMOD = 0;

        $('#tblEditProdRunStaMOD .txtEditProdRunStaMODQty').each(function(i, obj) {
          if($(this).val() == null || $(this).val() == ""){
          }
          else{
            totalNoOfMOD += parseFloat($(this).val());
          }
        });
        if($("#txt_edit_prod_runcard_station_ng").val() != totalNoOfMOD){
          toastr.warning('MOD NG Qty not Tally!');
          $("#pRCStatTotNoOfNG").css({color: 'red'});
          $("#btn_save_prod_runcard_station_stations").prop('disabled', true);
        }
        else{
          $("#pRCStatTotNoOfNG").css({color: 'green'});
          $("#btn_save_prod_runcard_station_stations").prop('disabled', false);
        }
        $("#pRCStatTotNoOfNG").text(totalNoOfMOD);
      });

      // Insert Production Runcard
      $('#frm_edit_material_details').submit(function(e){
        e.preventDefault();
 
        $.ajax({
          'data'      : $(this).serialize() +'&txt_employee_number_scanner=' + $("#txt_employee_number_scanner").val() + '&device_name=' + $("#txt_device_name_lbl").val(),
          'type'      : 'post',
          'dataType'  : 'json',
          'url'       : 'save_defect_escalation_details',
          success     : function(data){
              $('#mdl_alert #mdl_alert_title').html(data['title']);
              $('#mdl_alert #mdl_alert_body').html(data['body']);
              $('#mdl_alert').modal('show');

              $("#txt_prod_runcard_id_query").val(data['prod_runcard_id']);

              if(data['result']){
                GetProdRuncardById($("#txt_prod_runcard_id_query").val());
                dt_prod_runcard.draw();
                readonly_material_details_primary(true);
              }
              // if($("#txt_prod_runcard_id_query").val()){
              // }
              //---
              // var data_arr = [];
              // data_arr['material_id']     = $('#txt_wbs_kit_issuance_id_query').val();
              // // data_arr['sakidashi_id']     = $('#txt_wbs_sakidashi_issuance_id_query').val();
              // data_arr['material_code']   = $('#txt_part_number').val();
              // fn_select_material_details(data_arr);
              //---
          },
          completed     : function(data){

          },
          error     : function(data){

          },
        });
      });

      $("#tbl_prod_runcard").on('click','.btnOpenRuncardDetails',function(e){
        viewMatKitAction = 1;
        viewMatKitActionLotNo = null;
        viewSakidashiAction = 1;
        viewSakidashiActionLotNo = null;
        // viewEmbossAction = 1;
        // viewEmbossActionLotNo = null;
        $("#txtScannedMatKitLot").val('')
        $("#txtScannedSakidashiLot").val('')
        // $("#txtScannedEmbossLot").val('')
        $("#txtScannedEmployeeNo").val('')
        $("#txtSearchedMatKitLot").val('');
        $("#txtSearchedSakidashiLotNo").val('');
        // $("#txtSearchedEmbossLotNo").val('');
        let prodRuncardId = $(this).attr('runcard-id');
        $("#txt_prod_runcard_id_query").val(prodRuncardId);
        materialKitIssuanceLotNo = "";
        $("#txt_material_lot_no_lbl").val("");
        sakidashiIssuanceLotNo = "";
        $("#txt_sakidashi_lot_no_lbl").val("");

        arrSelectedMaterial = [];
        arrSelectedSakidashi = [];
        // arrSelectedEmboss = [];
        materialKitTransferSlip = "";
        $("#txt_material_transfer_slip_lbl").val("");
        sakidashiCtrlNo = "";
        $("#txt_sakidashi_ctrl_no_lbl").val("");
        GetProdRuncardById(prodRuncardId);
        dt_materials.draw();
        dt_prod_runcard_stations.draw();
      });      

      // $("#txt_edit_prod_runcard_operator").change(function(){
      //   let certifiedOperators = $("#txt_edit_prod_runcard_cert_operator").val();
      //   let selectedOperators = $("#txt_edit_prod_runcard_operator").val();
      //   // console.log(certifiedOperators);

      //   if(selectedOperators.length > 0){
      //     for(let index = 0; index < selectedOperators.length; index++){
      //       if(!certifiedOperators.includes(selectedOperators[index])){
      //         // toastr.warning('Not Certified!');
      //         $('#txt_edit_prod_runcard_operator option[value="'+selectedOperators[index]+'"]').prop('selected', false).trigger('change');
      //       }
      //     }
      //   }
      // });

      // $("#txt_edit_prod_runcard_station_machine").change(function(){
      //   let assignedMachine = $("#txt_edit_prod_runcard_station_assigned_machine").val();
      //   let selectedMachines = $("#txt_edit_prod_runcard_station_machine").val();
      //   // console.log(assignedMachine);
      //   if(selectedMachines.length > 0){
      //     for(let index = 0; index < selectedMachines.length; index++){
      //       if(!assignedMachine.includes(selectedMachines[index])){
      //         // toastr.warning('Not Assigned!');
      //         $('#txt_edit_prod_runcard_station_machine option[value="'+selectedMachines[index]+'"]').prop('selected', false).trigger('change');
      //       }
      //     }
      //   }
      // });

      $(document).on('click','#btn_edit_material_details_primary',function(e){
        readonly_material_details_primary(false);
      });

      $(document).on('click','#btn_cancel_material_details_primary',function(e){
        readonly_material_details_primary(true);
      });

      $(document).on('click','#btn_edit_material_details_verification',function(e){
        readonly_material_details_secondary(false);
      });

      $(document).on('click','#btn_cancel_material_details_secondary',function(e){
        readonly_material_details_secondary(true);
      });

      $(document).on('click','#btn_setup_stations',function(e){
        let noOfSelected = parseInt(arrSelectedMaterial.length) + parseInt(arrSelectedSakidashi.length);
        if(noOfSelected > 0){
          dt_setup_stations.draw();
          $('#mdl_setup_stations').modal('show');
        }
        else{
          toastr.warning('Select Material List First');
          // toastr.warning('Fill-out Material Details First');
        }
      });

      $(".btnSearchPoNo").click(function(){
        $("#txtSearchPoTransLotNo").val('');
        $("#scanPOTransLotBody").text('Please Scan the PO code.');
        $('#modalScanPOTransLotCode').attr('data-formid', 'search_po_number').modal('show');
      });

      $(".btnScanMatKitLot").click(function(){
        $("#txtSearchPoTransLotNo").val('');
        $("#scanPOTransLotBody").text('Please Scan the Material Lot code.');
        $('#modalScanPOTransLotCode').attr('data-formid', 'scan_mat_kit').modal('show');
        $("#txtScannedMatKitLot").val('');
      });

      $(".btnSearchMatKitLot").click(function(){
        $("#txtSearchPoTransLotNo").val('');
        $("#scanPOTransLotBody").text('Please Scan the Material Lot code to search.');
        $('#modalScanPOTransLotCode').attr('data-formid', 'search_mat_kit').modal('show');
        $("#txtSearchedMatKitLot").val('');
      });

      $(".btnShowSavedMatKitLot").click(function(){
        viewMatKitAction = 1;
        viewMatKitActionLotNo = null;
        dt_materials.draw();
        $("#txtSearchedMatKitLot").val('');
      });

      $(".btnScanWhsSlipNo").click(function(){
        $("#txtSearchPoTransLotNo").val('');
        $("#scanPOTransLotBody").text('Please Scan the Material Lot code.');
        $('#modalScanPOTransLotCode').attr('data-formid', 'scan_whs_slip_no').modal('show');
      });

      $(".btnScanSakidashiLot").click(function(){
        $("#txtSearchPoTransLotNo").val('');
        $("#scanPOTransLotBody").text('Please Scan the Sakidashi Lot code.');
        $('#modalScanPOTransLotCode').attr('data-formid', 'scan_sakidashi').modal('show');
        $("#txtScannedSakidashiLot").val('');
      });

      $(".btnSearchSakidashiLotNo").click(function(){
        $("#txtSearchPoTransLotNo").val('');
        $("#scanPOTransLotBody").text('Please Scan the Sakidashi Lot code to search.');
        $('#modalScanPOTransLotCode').attr('data-formid', 'search_sakidashi').modal('show');
        $("#txtScannedSakidashiLot").val('');
      });

      $(".btnShowSavedSakidashiLot").click(function(){
        viewSakidashiAction = 1;
        viewSakidashiActionLotNo = null;
        dt_sakidashi.draw();
        $("#txtSearchedSakidashiLot").val('');
      });

      // $(".btnScanEmbossLot").click(function(){
        // $("#txtSearchPoTransLotNo").val('');
        // $("#scanPOTransLotBody").text('Please Scan the Emboss Lot code.');
        // $('#modalScanPOTransLotCode').attr('data-formid', 'scan_emboss').modal('show');
        // $("#txtScannedEmbossLot").val('');
      // });

      // $(".btnSearchEmbossLotNo").click(function(){
      //   $("#txtSearchPoTransLotNo").val('');
      //   $("#scanPOTransLotBody").text('Please Scan the Emboss Lot code to search.');
      //   $('#modalScanPOTransLotCode').attr('data-formid', 'search_emboss').modal('show');
      //   $("#txtScannedEmbossLot").val('');
      // });

      // $(".btnSearchManualEmbossLot").click(function(){
      //   let lotNo = $("#txtSearchedManualEmbossLot").val();
      //   $(this).focus();
      //   viewEmbossAction = 2;
      //   viewEmbossActionLotNo = lotNo;
      //   $("#txtSearchedEmbossLot").val(lotNo.trim());
      //   // dt_emboss.draw();
      // });

      // $("#txtSearchedManualEmbossLot").keypress(function(e){

      //   if(e.keyCode == 13){
      //     let lotNo = $("#txtSearchedManualEmbossLot").val();
      //     $(this).focus();
      //     viewEmbossAction = 2;
      //     viewEmbossActionLotNo = lotNo;
      //     $("#txtSearchedEmbossLot").val(lotNo.trim());
      //     // dt_emboss.draw();
      //   }

      // });

      // $(".btnShowSavedEmbossLot").click(function(){
      //   viewEmbossAction = 1;
      //   viewEmbossActionLotNo = null;
      //   // dt_emboss.draw();
      //   $("#txtSearchedEmbossLot").val('');
      //   $("#txtSearchedManualEmbossLot").val('');
      // });

      $(".btnScanEmpNo").click(function(){
        $("#txtSearchPoTransLotNo").val('');
        $("#scanPOTransLotBody").text('Please Scan the Operator Code.');
        $('#modalScanPOTransLotCode').attr('data-formid', 'scan_employee_no').modal('show');
        $("#txtScannedEmployeeNo").val('');
      });

      $(document).on('click','#btn_save_prod_runcard_station_stations',function(e){
        $('#txt_employee_number_scanner').val('');
        $('#mdl_employee_number_scanner').attr('data-formid','#frm_edit_prod_runcard_station_details').modal('show');
      });

      $(document).on('click','#btn_save_material_details_secondary',function(e){
        $('#txt_employee_number_scanner').val('');
        $('#mdl_employee_number_scanner').attr('data-formid','#frm_edit_material_details_secondary').modal('show');
      });

      $(document).on('click','#btn_approve_prod',function(e){
        $('#txt_employee_number_scanner').val('');
        $('#mdl_employee_number_scanner').attr('data-formid','save_approve_prod').modal('show');
      });

      $(document).on('click','#btn_approve_qc',function(e){
        $('#txt_employee_number_scanner').val('');
        $('#mdl_employee_number_scanner').attr('data-formid','save_approve_qc').modal('show');
      });

      $(document).on('click','#btnSubmitToOQCLotApp',function(e){
        $('#txt_employee_number_scanner').val('');
        $('#mdl_employee_number_scanner').attr('data-formid','submit_to_oqc_lot_app').modal('show');
      });

      $("#chkCheckAllSetupStations").click(function(){
        if($(this).prop('checked')){
          $("#tbl_setup_stations .ckb_station").prop('checked', true);
        }
        else{
          $("#tbl_setup_stations .ckb_station").prop('checked', false);
        }
      });

      $("#tbl_setup_stations").on('click', '.ckb_station', function(){
        if(!$(this).prop('checked')){
          $("#chkCheckAllSetupStations").prop('checked', false);
        }
      });

      $("#txt_edit_prod_runcard_station_output").keyup(function(){
        $("#txt_edit_prod_runcard_station_ng").val(parseInt($("#txt_edit_prod_runcard_station_input").val()) - parseInt($(this).val()));

        if($("#txt_edit_prod_runcard_station_ng").val() > 0){
          $("#btnAddMODTable").prop('disabled', false);
        }
        else{
          $("#btnAddMODTable").prop('disabled', true);
        }

        if($("#txt_edit_prod_runcard_station_ng").val() != $("#pRCStatTotNoOfNG").text()){
          $("#pRCStatTotNoOfNG").css({color: 'red'});
          $("#btn_save_prod_runcard_station_stations").prop('disabled', true);
        }
        else{
          $("#pRCStatTotNoOfNG").css({color: 'green'});
          $("#btn_save_prod_runcard_station_stations").prop('disabled', false);
        }
      });

      $("#txt_edit_prod_runcard_station_input").keyup(function(){
        $("#txt_edit_prod_runcard_station_ng").val(parseInt($("#txt_edit_prod_runcard_station_input").val()) - parseInt($("#txt_edit_prod_runcard_station_output").val()));

        if($("#txt_edit_prod_runcard_station_ng").val() > 0){
          $("#btnAddMODTable").prop('disabled', false);
        }
        else{
          $("#btnAddMODTable").prop('disabled', true);
        }

        if($("#txt_edit_prod_runcard_station_ng").val() != $("#pRCStatTotNoOfNG").text()){
          $("#pRCStatTotNoOfNG").css({color: 'red'});
          $("#btn_save_prod_runcard_station_stations").prop('disabled', true);
        }
        else{
          $("#pRCStatTotNoOfNG").css({color: 'green'});
          $("#btn_save_prod_runcard_station_stations").prop('disabled', false);
        }
      });

      $("#txt_edit_prod_runcard_station_ng").keyup(function(){
        $("#txt_edit_prod_runcard_station_output").val(parseInt($("#txt_edit_prod_runcard_station_input").val()) - parseInt($("#txt_edit_prod_runcard_station_ng").val()));

        if($(this).val() > 0){
          $("#btnAddMODTable").prop('disabled', false);
        }
        else{
          $("#btnAddMODTable").prop('disabled', true);
        }

        if($(this).val() != $("#pRCStatTotNoOfNG").text()){
          console.log($(this).val() + " = " + $("#pRCStatTotNoOfNG").text());
          // toastr.warning('MOD NG Qty not Tally!');
          $("#pRCStatTotNoOfNG").css({color: 'red'});
          $("#btn_save_prod_runcard_station_stations").prop('disabled', true);
        }
        else{
          $("#pRCStatTotNoOfNG").css({color: 'green'});
          $("#btn_save_prod_runcard_station_stations").prop('disabled', false);
        }

      });

      $("#txt_edit_prod_runcard_station_ng").change(function(){
        $("#txt_edit_prod_runcard_station_output").val(parseInt($("#txt_edit_prod_runcard_station_input").val()) - parseInt($("#txt_edit_prod_runcard_station_ng").val()));

        if($(this).val() > 0){
          $("#btnAddMODTable").prop('disabled', false);
        }
        else{
          $("#btnAddMODTable").prop('disabled', true);
        }

        if($(this).val() != $("#pRCStatTotNoOfNG").text()){
          console.log($(this).val() + " = " + $("#pRCStatTotNoOfNG").text());
          // toastr.warning('MOD NG Qty not Tally!');
          $("#pRCStatTotNoOfNG").css({color: 'red'});
          $("#btn_save_prod_runcard_station_stations").prop('disabled', true);
        }
        else{
          $("#pRCStatTotNoOfNG").css({color: 'green'});
          $("#btn_save_prod_runcard_station_stations").prop('disabled', false);
        }

      });

      $('#frm_edit_material_details_secondary').submit(function(e){
        e.preventDefault();

        $.ajax({
          'data'      : $(this).serialize() + '&txt_employee_number_scanner=' + $("#txt_employee_number_scanner").val(),
          'type'      : 'post',
          'dataType'  : 'json',
          'url'       : 'update_prod_runcard_secondary',
          success     : function(data){
            if(data == '0'){
              toastr.error('User not found!');
            }
            else{
              $('#mdl_alert #mdl_alert_title').html(data['title']);
              $('#mdl_alert #mdl_alert_body').html(data['body']);
              $('#mdl_alert').modal('show');
              readonly_material_details_secondary(true);
              //---
              var data_arr = [];
              data_arr['material_id']     = $('#txt_wbs_kit_issuance_id_query').val();
              data_arr['material_code']   = $('#txt_part_number').val();
              // fn_select_material_details(data_arr);
              //---

              GetProdRuncardById($("#txt_prod_runcard_id_query").val());

              dt_prod_runcard.draw();
              // dt_materials.ajax.reload();
              // dt_sakidashi.ajax.reload();

              $('#mdl_setup_stations').modal('hide');
              $('#mdl_alert #mdl_alert_title').html(data['title']);
              $('#mdl_alert #mdl_alert_body').html(data['body']);
              $('#mdl_alert').modal('show');
              
              if(data['result'] != '0'){
                dt_prod_runcard_stations.ajax.reload();
              }
            }
          },
          completed     : function(data){

          },
          error     : function(data){

          },
        });
      });

      readonly_material_details_primary(true);
      readonly_material_details_secondary(true);

      // function GetProdRuncardById(prodRuncardId){
      //   $.ajax({
      //     url: "get_prod_runcard_by_id",
      //     method: 'get',
      //     dataType: 'json',
      //     data: {
      //       prod_runcard_id: prodRuncardId
      //     },
      //     beforeSend: function(){
      //       arrSelectedMaterial = [];
      //       arrSelectedSakidashi = [];
      //       readonly_material_details_primary(true);
      //       readonly_material_details_secondary(true);
      //       // reset_material_details_primary();
      //       // reset_material_details_secondary();
      //     },
      //     success: function(data){
      //       if(data['prod_runcard'] != null){
      //         $("#modalRuncardDetails").modal('show');
      //         $("#txt_po_number").val($("#txt_po_number_lbl").val());
      //         $("#txt_po_qty").val($("#txt_po_qty_lbl").val());
      //         $("#txt_use_for_device").val($("#txt_device_name_lbl").val());
      //         $("#txt_device_code").val($("#txt_device_code_lbl").val());
      //         $("#txt_prod_runcard_id_query").val(data['prod_runcard']['id']);
      //         $("#txt_prod_runcard_status").val(data['prod_runcard']['status']);
      //         $("#txt_prod_runcard_verification_id_query").val(data['prod_runcard']['id']);
      //         $("#txt_runcard_no").val(data['prod_runcard']['runcard_no']);
      //         $("#txt_lot_qty").val(data['prod_runcard']['lot_qty']);
      //         $("#txt_assessment_no").val(data['prod_runcard']['assessment_no']);
      //         $("#txt_a_drawing_no").val(data['prod_runcard']['a_drawing_no']);
      //         $("#txt_a_drawing_rev").val(data['prod_runcard']['a_drawing_rev']);
      //         $("#txt_g_drawing_no").val(data['prod_runcard']['g_drawing_no']);
      //         $("#txt_g_drawing_rev").val(data['prod_runcard']['g_drawing_rev']);
      //         $("#txt_other_docs_no").val(data['prod_runcard']['other_docs_no']);
      //         $("#txt_other_docs_rev").val(data['prod_runcard']['other_docs_rev']);

      //         if(data['prod_runcard']['discrepant_qty'] != null){
      //           if(data['prod_runcard']['discrepant_qty'] < 0){
      //             $('#txt_discrepant_qty_sign').val("-");
      //             $('#txt_discrepant_qty').val(data['prod_runcard']['discrepant_qty'] * -1);
      //           }
      //           else if(data['prod_runcard']['discrepant_qty'] == 0){
      //             $('#txt_discrepant_qty_sign').val("0");
      //             $('#txt_discrepant_qty').val(data['prod_runcard']['discrepant_qty']);
      //           }
      //           else{
      //             $('#txt_discrepant_qty_sign').val("+");
      //             $('#txt_discrepant_qty').val(data['prod_runcard']['discrepant_qty']);
      //           }
      //         }
      //         else{
      //           $('#txt_discrepant_qty_sign').val("0");
      //           $('#txt_discrepant_qty').val("");
      //         }

      //         $('#txt_analysis').val(data['prod_runcard']['analysis']);
      //         $('#txt_recount_ok').val(data['prod_runcard']['recount_ok']);
      //         $('#txt_recount_ng').val(data['prod_runcard']['recount_ng']);

      //         if(data['prod_runcard']['supervisor_prod_info'] != null){
      //           $('#txt_prod_approval').val(data['prod_runcard']['supervisor_prod_info']['name']);
      //         }
      //         else{
      //           $('#txt_prod_approval').val("");
      //         }

      //         if(data['prod_runcard']['supervisor_qc_info'] != null){
      //           $('#txt_qc_approval').val(data['prod_runcard']['supervisor_qc_info']['name']);
      //         }
      //         else{
      //           $('#txt_qc_approval').val("");
      //         }

      //         if(data['prod_runcard']['prod_runcard_material_list'].length > 0){
      //           // $("#btn_edit_material_details_primary").prop('disabled', true);
      //           // $("#btnSaveSelectedMatSak").prop('disabled', true);

      //           for(let index = 0; index < data['prod_runcard']['prod_runcard_material_list'].length; index++){
      //             if(data['prod_runcard']['prod_runcard_material_list'][index]['tbl_wbs'] == 1){
      //               arrSelectedMaterial.push(data['prod_runcard']['prod_runcard_material_list'][index]['issuance_id']);
      //             }
      //             else{
      //               arrSelectedSakidashi.push(data['prod_runcard']['prod_runcard_material_list'][index]['issuance_id']);
      //             }
      //           }
      //         }
      //         else{
      //           // $("#btn_edit_material_details_primary").prop('disabled', false);
      //           // $("#btnSaveSelectedMatSak").prop('disabled', false);
      //         }

      //         if(data['prod_runcard']['prod_runcard_material_list'].length > 0){
      //           hasProdMatSakList = true;
      //           // $("#btn_setup_stations").prop('disabled', false);
      //             if(data['prod_runcard']['discrepant_qty'] != null) {
      //             // $("#btn_edit_material_details_verification").prop('disabled', true);
      //             // $("#btn_setup_stations").prop('disabled', true);
      //             // $("#btn_approve_prod").prop('disabled', false);
      //             // $("#btn_approve_qc").prop('disabled', false);

      //             if(data['prod_runcard']['supervisor_prod_info'] != null){
      //               // $("#btn_edit_material_details_verification").prop('disabled', true);
      //               // $("#btn_approve_prod").prop('disabled', true);
      //               // $("#btn_approve_prod").prop('disabled', true);
      //               if(data['prod_runcard']['supervisor_qc_info'] != null){
      //                 // $("#btn_approve_qc").prop('disabled', true);
      //               }
      //               else{
      //                 // $("#btn_approve_qc").prop('disabled', false); 
      //               }
      //             }
      //             else{
      //               // $("#btn_edit_material_details_verification").prop('disabled', false);
      //               // $("#btn_approve_prod").prop('disabled', false);
      //               // $("#btn_approve_qc").prop('disabled', true);
      //             }

      //             if(data['prod_runcard']['discrepant_qty'] == 0){
      //               // $("#btn_approve_prod").prop('disabled', true);
      //               // $("#btn_approve_qc").prop('disabled', true);
      //             }
      //           }
      //           else{
      //             // $("#btn_setup_stations").prop('disabled', false);
      //             // $("#btn_approve_prod").prop('disabled', true);
      //             // $("#btn_approve_qc").prop('disabled', true);
      //             // $("#btn_edit_material_details_verification").prop('disabled', false);
      //           }
      //         }
      //         else{
      //           // $("#btn_setup_stations").prop('disabled', true);
      //           hasProdMatSakList = true;
      //         }

      //         // if(data['prod_runcard']['discrepant_qty'] != null) {
      //           // $("#btn_edit_material_details_verification").prop('disabled', true);
      //           // $("#btn_setup_stations").prop('disabled', true);
      //         //   $("#btn_approve_prod").prop('disabled', false);
      //         //   $("#btn_approve_qc").prop('disabled', false);

      //         //   if(data['prod_runcard']['supervisor_prod_info'] != null){
      //             // $("#btn_edit_material_details_verification").prop('disabled', true);
      //         //     $("#btn_approve_prod").prop('disabled', true);
      //         //     $("#btn_approve_prod").prop('disabled', true);
      //         //     if(data['prod_runcard']['supervisor_qc_info'] != null){
      //         //       $("#btn_approve_qc").prop('disabled', true);
      //         //     }
      //         //     else{
      //         //       $("#btn_approve_qc").prop('disabled', false); 
      //         //     }
      //         //   }
      //         //   else{
      //             // $("#btn_edit_material_details_verification").prop('disabled', false);
      //         //     $("#btn_approve_prod").prop('disabled', false);
      //         //     $("#btn_approve_qc").prop('disabled', true);
      //         //   }

      //         //   if(data['prod_runcard']['discrepant_qty'] == 0){
      //         //     $("#btn_approve_prod").prop('disabled', true);
      //         //     $("#btn_approve_qc").prop('disabled', true);
      //         //   }
      //         // }
      //         // else{
      //           // $("#btn_setup_stations").prop('disabled', false);
      //         //   $("#btn_approve_prod").prop('disabled', true);
      //         //   $("#btn_approve_qc").prop('disabled', true);
      //           // $("#btn_edit_material_details_verification").prop('disabled', false);
      //         // }

      //         HandleButtons(true);
      //         let prodRuncardStat = data['prod_runcard']['status'];
      //         if(prodRuncardStat == 1){
      //           $("#btn_edit_material_details_primary").prop('disabled', true);  
      //           $("#btnSaveSelectedMatSak").prop('disabled', false);
      //           $("#btn_setup_stations").prop('disabled', true);
      //           $("#btn_edit_material_details_verification").prop('disabled', true);
      //           $("#btn_approve_prod").prop('disabled', true);
      //           $("#btn_approve_qc").prop('disabled', true);
      //         }
      //         else if(prodRuncardStat == 2){
      //           $("#btn_edit_material_details_primary").prop('disabled', true);  
      //           $("#btnSaveSelectedMatSak").prop('disabled', true);
      //           $("#btn_setup_stations").prop('disabled', false);
      //           $("#btn_edit_material_details_verification").prop('disabled', true);
      //           $("#btn_approve_prod").prop('disabled', true);
      //           $("#btn_approve_qc").prop('disabled', true);
      //         }
      //         else if(prodRuncardStat == 3){
      //           $("#btn_edit_material_details_primary").prop('disabled', true);  
      //           $("#btnSaveSelectedMatSak").prop('disabled', true);
      //           $("#btn_setup_stations").prop('disabled', true);
      //           $("#btn_edit_material_details_verification").prop('disabled', false);
      //           $("#btn_approve_prod").prop('disabled', true);
      //           $("#btn_approve_qc").prop('disabled', true);
      //         }
      //         else if(prodRuncardStat == 4){
      //           $("#btn_edit_material_details_primary").prop('disabled', true);  
      //           $("#btnSaveSelectedMatSak").prop('disabled', true);
      //           $("#btn_setup_stations").prop('disabled', true);
      //           $("#btn_edit_material_details_verification").prop('disabled', true);
      //           $("#btn_approve_prod").prop('disabled', false);
      //           $("#btn_approve_qc").prop('disabled', true);
      //         }
      //         else if(prodRuncardStat == 5){
      //           $("#btn_edit_material_details_primary").prop('disabled', true);  
      //           $("#btnSaveSelectedMatSak").prop('disabled', true);
      //           $("#btn_setup_stations").prop('disabled', true);
      //           $("#btn_edit_material_details_verification").prop('disabled', true);
      //           $("#btn_approve_prod").prop('disabled', true);
      //           $("#btn_approve_qc").prop('disabled', false);
      //         }
      //         else{
      //           HandleButtons(true);
      //         }

      //         // $("#btn_setup_stations").removeAttr('disabled');
      //         // $("#btn_edit_material_details_verification").removeAttr('disabled');
      //         // $("#btnSaveSelectedMatSak").removeAttr('disabled');
      //         // $("#btn_approve_prod").removeAttr('disabled');
      //         // $("#btn_approve_qc").removeAttr('disabled');
      //       }
      //       else{
      //         $("#txt_po_number").val('');
      //         $("#txt_po_qty").val('');
      //         $("#txt_use_for_device").val('');
      //         $("#txt_device_code").val('');
      //         $("#txt_runcard_no").val('');
      //         $("#txt_lot_qty").val('');
      //         $("#txt_assessment_no").val('');
      //         $("#txt_a_drawing_no").val('');
      //         $("#txt_a_drawing_rev").val('');
      //         $("#txt_g_drawing_no").val('');
      //         $("#txt_g_drawing_rev").val('');
      //         $("#txt_other_docs_no").val('');
      //         $("#txt_other_docs_rev").val('');

      //         // $("#btn_setup_stations").prop('disabled', 'disabled');
      //         // $("#btnSaveSelectedMatSak").prop('disabled', true);
      //         // $("#btn_edit_material_details_verification").prop('disabled', true);
      //         // $("#btn_setup_stations").prop('disabled', true);
      //         // $("#btn_approve_prod").prop('disabled', true);
      //         // $("#btn_approve_qc").prop('disabled', true);
      //       }

      //       let noOfSelected = parseInt(arrSelectedMaterial.length) + parseInt(arrSelectedSakidashi.length);
      //       if(noOfSelected > 0 && hasProdMatSakList){
      //         $("#spanNoOfSelectedMatSak").text("(" + noOfSelected + ")");
      //         // $("#btnSaveSelectedMatSak").prop('disabled', true);
      //       }
      //       else{
      //         $("#spanNoOfSelectedMatSak").text("");
      //         // $("#btnSaveSelectedMatSak").prop('disabled', false);
      //       }
      //       dt_materials.draw();
      //       dt_sakidashi.draw();
      //       dt_prod_runcard_stations.draw();
      //       // console.log(arrSelectedMaterial);
      //       // console.log(arrSelectedSakidashi);
      //     }
      //   });
      // }

      // function HandleButtons(status){
      //   $("#btn_edit_material_details_primary").prop('disabled', status);  
      //   $("#btnSaveSelectedMatSak").prop('disabled', status);
      //   $("#btn_setup_stations").prop('disabled', status);
      //   $("#btn_edit_material_details_verification").prop('disabled', status);
      //   $("#btn_approve_prod").prop('disabled', status);
      //   $("#btn_approve_qc").prop('disabled', status);
      // }

      // function save_approve_prod(){
      //   var data = 'txt_prod_runcard_id_query=' + $("#txt_prod_runcard_id_query").val()+'&txt_employee_number_scanner=' + $("#txt_employee_number_scanner").val() + '&_token=' + '{{ csrf_token() }}';

      //   $.ajax({
      //     'data'      : data,
      //     'type'      : 'post',
      //     'dataType'  : 'json',
      //     'url'       : 'update_prod_runcard_approval_prod',
      //     success     : function(data){
      //       $('#mdl_alert #mdl_alert_title').html(data['title']);
      //       $('#mdl_alert #mdl_alert_body').html(data['body']);
      //       $('#mdl_alert').modal('show');

      //       var data_arr = [];
      //       data_arr['material_id']     = $('#txt_wbs_kit_issuance_id_query').val();
      //       data_arr['material_code']   = $('#txt_part_number').val();
      //       // fn_select_material_details(data_arr);
      //       GetProdRuncardById($("#txt_prod_runcard_id_query").val());
      //     },
      //     completed     : function(data){
      //       var data_arr = [];
      //       data_arr['material_id']     = $('#txt_wbs_kit_issuance_id_query').val();
      //       data_arr['material_code']   = $('#txt_part_number').val();
      //       // fn_select_material_details(data_arr);
      //       $('#mdl_alert #mdl_alert_title').html(data['title']);
      //       $('#mdl_alert #mdl_alert_body').html(data['body']);
      //       $('#mdl_alert').modal('show');
      //       GetProdRuncardById($("#txt_prod_runcard_id_query").val());
      //     },
      //     error     : function(data){
      //     },
      //   });
      // }

      // function save_approve_qc(){
      //   var data = 'txt_prod_runcard_id_query=' + $("#txt_prod_runcard_id_query").val()+'&txt_employee_number_scanner=' + $("#txt_employee_number_scanner").val() + '&_token=' + '{{ csrf_token() }}';

      //   $.ajax({
      //     'data'      : data,
      //     'type'      : 'post',
      //     'dataTypesdsd'  : 'json',
      //     'url'       : 'update_prod_runcard_approval_qc',
      //     success     : function(data){
      //       $('#mdl_alert #mdl_alert_title').html(data['title']);
      //       $('#mdl_alert #mdl_alert_body').html(data['body']);
      //       $('#mdl_alert').modal('show');
      //       var data_arr = [];
      //       data_arr['material_id']     = $('#txt_wbs_kit_issuance_id_query').val();
      //       data_arr['material_code']   = $('#txt_part_number').val();
      //       // fn_select_material_details(data_arr);
      //       GetProdRuncardById($("#txt_prod_runcard_id_query").val());
      //     },
      //     completed     : function(data){
      //       var data_arr = [];
      //       data_arr['material_id']     = $('#txt_wbs_kit_issuance_id_query').val();
      //       data_arr['material_code']   = $('#txt_part_number').val();
      //       // fn_select_material_details(data_arr);
      //       $('#mdl_alert #mdl_alert_title').html(data['title']);
      //       $('#mdl_alert #mdl_alert_body').html(data['body']);
      //       $('#mdl_alert').modal('show');
      //       GetProdRuncardById($("#txt_prod_runcard_id_query").val());
      //     },
      //     error     : function(data){

      //     },
      //   });
      // }




      //-------------------------------------------------------

      // function OutputDataCounter(api) {
      //   let counter = 0;

      //   api.column().data(0, {page:'current'}).each( function (group, i) {

      //         let data = api.row(i).data();
      //         let output = data.qty_output;
      //         let status = data.status;
      //         // if(output != null){
      //         //   counter++;
      //         // }

      //         if(status == 1){
      //           counter++;
      //         }
      //   });

      //   if(api.rows().count() > 0 && (counter == api.rows().count())){
      //     dtOutputStatus = true;
      //   }
      //   else{
      //     dtOutputStatus = false;
      //   }

      //   if(api.rows().count() > 0){
      //     // $("#btnSaveSelectedMatSak").prop('disabled', true);
      //   }
      //   // else{
      //    // $("#btnSaveSelectedMatSak").prop('disabled', false);
      //   // }

      //   // alert(dtOutputStatus);
      //   if(dtOutputStatus){
      //     // $("#btn_edit_material_details_verification").prop('disabled', false);
      //     if($("#txt_prod_runcard_status").val() == 1){
      //       // $("#btn_edit_material_details_verification").prop('disabled', true);
      //     }
      //     else{
      //       // $("#btn_edit_material_details_verification").prop('disabled', false);
      //     }
      //   }
      //   else{ 
      //     // $("#btn_edit_material_details_verification").prop('disabled', true);
      //   }
      // }

      $("#btnShowNGSummary").click(function(){
        if($("#txt_po_number_lbl").val() != ""){
          $("#spanNGSummaryPoNo").text(currentPoNo);
          dt_ng_summary.draw();
          $("#modalNGSummary").modal('show');
        }
        else{
          toastr.warning('PO not found!');
          $("#spanNGSummaryPoNo").text('--');
        }
      });

      $(document).on('click','#btn_scan_machine_code',function(e){
        $('#txt_qrcode_scanner').val('');
        $('#mdl_qrcode_scanner').attr('data-formid','fn_scan_machine_code').modal('show');
      });

      $(document).on('click','#btn_scan_add_runcard_material_kitting',function(e){
        $('#txt_qrcode_scanner').val('');
        $('#mdl_qrcode_scanner').attr('data-formid','fn_scan_material_kitting').modal('show');
      });

      $(document).on('click','#btn_scan_add_runcard_sakidashi',function(e){
        $('#txt_qrcode_scanner').val('');
        $('#mdl_qrcode_scanner').attr('data-formid','fn_scan_sakidashi').modal('show');
      });

      $(document).on('click','#btnScanMaterialLotNo',function(e){
        $('#txt_qrcode_scanner').val('');
        $('#mdl_qrcode_scanner').attr('data-formid','btnScanMaterialLotNo').modal('show');
      });

      // $(document).on('click','#btn_scan_add_runcard_emboss',function(e){
      //   $('#txt_qrcode_scanner').val('');
      //   $('#mdl_qrcode_scanner').attr('data-formid','fn_scan_emboss').modal('show');
      // });

      $(document).on('click','#btn_scan_add_runcard_operator_code',function(e){
        $('#txt_qrcode_scanner').val('');
        $('#mdl_qrcode_scanner').attr('data-formid','fn_scan_runcard_operator_code').modal('show');
      });

      $(document).on('click','.btn_edit_prod_runcard_station',function(e){
        var data_arr = [];
        data_arr['col_prod_runcard_station_id']     = $(this).closest('tr').find('.col_prod_runcard_station_id').val();
        // data_arr['has_emboss']     = $(this).attr('has_emboss');
        // data_arr['material_code']   = $(this).closest('tr').find('.col_material_code').val();
        $("#txt_edit_prod_runcard_operator").val("0").trigger('change');
        let matProcId = $(this).attr('mat-proc-id');
        fn_select_prod_runcard_station_details(data_arr, matProcId);

        $("#tblEditProdRunStaMOD tbody").html('');
        $("#pRCStatTotNoOfNG").css({color: 'green'});
        $("#pRCStatTotNoOfNG").text('0');

        // let stepNumOnly = $(this).closest('td').siblings().text();
        let stepNumOnly = $(this).closest('td').siblings().eq(0).text().split('-')[0];
        let sameStepNumCounter = 0;
        // $('#tbl_prod_runcard_stations tbody tr').each(function(i, obj) {
        //   console.log($("#tbl_prod_runcard_stations tbody tr").closest('td').child().eq(0).text().split('-')[0] + 'wew');
        // });

        $('#tbl_prod_runcard_stations tbody').find('tr').each(function (key, val) {
              var this_row = $(this);
              let tdStepNum = $.trim(this_row.find('td:eq(1)').html()).split('-')[0];
              
              if(stepNumOnly == tdStepNum){
                sameStepNumCounter++;
              }

              // console.log(tdStepNum);
        });
        // console.log(sameStepNumCounter);
        $("#txt_edit_prod_runcard_station_input").val(parseInt($(
                "#txt_lot_qty").val() / sameStepNumCounter));
        $("#txt_edit_prod_runcard_station_output").val(parseInt($(
                "#txt_lot_qty").val() / sameStepNumCounter));
        $("#txt_edit_prod_runcard_station_ng").val(0);

        $("#btn_save_prod_runcard_station_stations").prop('disabled', false);
      });

      $('#frm_edit_prod_runcard_station_details').submit(function(e){
        e.preventDefault();

        $.ajax({
          'data'      : $(this).serialize() +'&txt_employee_number_scanner=' + $("#txt_employee_number_scanner").val() +'&txt_prod_runcard_id_query=' + $("#txt_prod_runcard_id_query").val(),
          'type'      : 'post',
          'dataType'  : 'json',
          'url'       : 'edit_de_station',
          success     : function(data){
            $('#mdl_alert #mdl_alert_title').html(data['title']);
            $('#mdl_alert #mdl_alert_body').html(data['body']);
            $('#mdl_alert').modal('show');

            dt_prod_runcard_stations.draw();
            dt_prod_runcard.draw();
            $('#mdl_edit_prod_runcard_station_details').modal('hide');
          },
          completed     : function(data){

          },
          error     : function(data){

          },
        });
      });

      $('#modalScanPOTransLotCode').on('shown.bs.modal', function () {
        $('#txtSearchPoTransLotNo').val('')
        $('#txtSearchPoTransLotNo').trigger('focus');
      })

      $(document).on('click','#btn_save_material_details_primary',function(e){
        $('#txt_employee_number_scanner').val('');
        $('#mdl_employee_number_scanner').attr('data-formid','#frm_edit_material_details').modal('show');
      });

      $(document).on('click','#btnSaveSelectedMatSak',function(e){
        let noOfSelected = parseInt(arrSelectedSakidashi.length) + parseInt(arrSelectedMaterial.length);
        if($("#txt_prod_runcard_id_query").val() == "" || $("#txt_prod_runcard_id_query").val() == null){
          toastr.warning('Fill-out Material Details First!');
        }
        else{
          if($("#txt_prod_runcard_status").val() == 1){
            if(noOfSelected > 0){
              if($("#txt_prod_runcard_id_query").val() == "" || $("#txt_prod_runcard_id_query").val() == null){
                toastr.warning('Fill-out Material Details First');
              }
              else{
                $('#txt_employee_number_scanner').val('');
                $('#mdl_employee_number_scanner').attr('data-formid','SaveProdMaterialList').modal('show');
              }
            }
            else{
              toastr.warning('Please Select Material!');
            }
          }
          else{
            toastr.warning('Materials Already Saved!');
          }
        }

      });

      

      $(document).on('click','#btn_save_setup_stations',function(e){
        $('#txt_employee_number_scanner').val('');
        $('#mdl_employee_number_scanner').attr('data-formid','save_setup_stations').modal('show');
      });

      $("#tbl_sakidashi").on('click','.btnSaveSakidashiLot',function(e){
        let issuanceId = $(this).attr('issuance-id');
        let itemDesc = $(this).attr('item-desc');
        let item = $(this).attr('item');

        saveSakidashiLotIssuanceId = issuanceId;
        saveSakidashiLotItem = item;
        saveSakidashiLotItemDesc = itemDesc;

        // console.log(saveSakidashiLotIssuanceId + "\n" + saveSakidashiLotItem + "\n" + saveSakidashiLotItemDesc);
        // console.log(issuanceId);
        $("#txtSearchPoTransLotNo").val('');
        $("#scanPOTransLotBody").text('Please Scan your ID.');
        $('#modalScanPOTransLotCode').attr('data-formid', 'save_sakidashi_lot_issuance').modal('show');
      });

      // REWORK FUNCTIONS

      dtReworks      = $('#tblRework').DataTable({
        "processing" : true,
          "serverSide" : true,
          "ajax" : {
            url: "view_reworks",
            data: function (param){
                param.defect_escalation_id = $("#txt_prod_runcard_id_query").val();
            }
          },
          bAutoWidth: false,
          "columns":[
            { "data" : "raw_checkbox", orderable:false, searchable:false },
            { "data" : "unit_no", orderable:false, searchable:false },
            { "data" : "mode_of_defect_info.name", orderable:false, searchable:false },
            { "data" : "location_of_ng", orderable:false, searchable:false },
            { "data" : "ng_qty", orderable:false, searchable:false },
            { "data" : "raw_scrap", orderable:false, searchable:false },
            { "data" : "raw_for_rework", orderable:false, searchable:false },
            { "data" : "raw_for_verification", orderable:false, searchable:false },
            { "data" : "raw_prod", orderable:false, searchable:false },
            { "data" : "raw_engg", orderable:false, searchable:false },
            { "data" : "raw_qc", orderable:false, searchable:false },
            { "data" : "rework_qty", orderable:false, searchable:false },
            { "data" : "result_qty_ok", orderable:false, searchable:false },
            { "data" : "result_qty_scrap", orderable:false, searchable:false },
            { "data" : "rework_code", orderable:false, searchable:false },
            { "data" : "raw_terminal_gauge", orderable:false, searchable:false },
            { "data" : "raw_dummy_lo", orderable:false, searchable:false },
            { "data" : "raw_dummy_mo", orderable:false, searchable:false },
            { "data" : "operator_info.name", orderable:false, searchable:false },
            { "data" : "date", orderable:false, searchable:false },
            { "data" : "raw_action", orderable:false, searchable:false },
          ],
          "columnDefs": [
            {
              "targets": [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18],
              "data": null,
              "defaultContent": "--"
            },
          ],
          paging: false,
          info: false,
          searching: false,
          pageLength: -1,
          // order: [[2, "asc"]],
          "rowCallback": function(row,data,index ){
          },
          "drawCallback": function(row,data,index ){
          },
      });//end of DataTable

      $("#btnAddRework").click(function(){
        $("#frmSaveRework")[0].reset();

        $.ajax({
          'data'      : {po_no: $('#txt_po_number_lbl').val()},
          'type'      : 'get',
          'dataType'  : 'json',
          'url'       : 'getListRuncardNo',
          success     : function(JSONDATA){
            let data = JSONDATA['data']
            let html = '<option value="0">...</option>'
            for (var i = 0; i < data.length; i++) 
              html += '<option value="' + data[i]['id'] + '">' + data[i]['lot_no'] + ' - ' + data[i]['runcard_no'] + '</option>'
            $('#select_runcard_no').html(html)
            $('#select_runcard_no').attr('disabled', false)
            $('#frmSaveRework_unit_no').attr('readonly', true)
          },
          error : function(data){
          },
        })

        let result = '<option value="">N/A</option>';
        $.ajax({
            url: 'getAllUserByPosition',
            method: 'get',
            data: { position: 4 },
            dataType: 'json',
            beforeSend: function(){
                result = '<option value=""> -- Loading -- </option>';

                $('#sel_edit_prod_runcard_ct_area').html(result);
                $('#sel_edit_prod_runcard_terminal_area').html(result);
            },
            success: function(JsonObject){
                result = '';
                if(JsonObject['users'].length > 0){
                    result = '<option value="">N/A</option>';
                    for(let index = 0; index < JsonObject['users'].length; index++){
                        let disabled = '';

                        if(JsonObject['users'][index].status == 2){
                          disabled = 'disabled';
                        }
                        else{
                          disabled = '';
                        }
                        result += '<option data-code="' + JsonObject['users'][index].employee_id + '" value="' + JsonObject['users'][index].id + '" ' + disabled + ' user-fullname="' + JsonObject['users'][index].name + '" >' + JsonObject['users'][index].name + '</option>';
                    }
                }
                else{
                    result = '<option value=""> -- No record found -- </option>';
                }

                $('#add_def_operators').html(result);
                // $('#sel_edit_prod_runcard_terminal_area').html(result);

                $('#add_def_operators').select2();
                // $('#sel_edit_prod_runcard_terminal_area').select2();

                $('#add_def_operators').select2({ theme: 'bootstrap4' });
                // $('#sel_edit_prod_runcard_terminal_area').select2({ theme: 'bootstrap4' });

                $('#add_def_operators').val('').trigger('change');
                // $('#sel_edit_prod_runcard_terminal_area').val('').trigger('change');
            },
            error: function(data, xhr, status){
                result = '<option value=""> -- Reload Again -- </option>';
                $('#add_def_operators').html(result);
                // $('#sel_edit_prod_runcard_terminal_area').html(result);
                console.log('Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);

                $('#add_def_operators').select2();
                // $('#sel_edit_prod_runcard_terminal_area').select2();

                $('#add_def_operators').select2({ theme: 'bootstrap4' });
                // $('#sel_edit_prod_runcard_terminal_area').select2({ theme: 'bootstrap4' });

                $('#add_def_operators').val('').trigger('change');
                // $('#sel_edit_prod_runcard_terminal_area').val('').trigger('change');
            }
        });


        $("input[name='defect_escalation_id']", $("#frmSaveRework")).val($("#txt_prod_runcard_id_query").val())
        // alert( $("#txt_prod_runcard_id_query").val() )
        $('select[name="mode_of_defect_id"]', frmSaveRework).val('0').trigger('change');
        $('select[name="operator"]', frmSaveRework).val('0').trigger('change');
        $('.divForRework').show();
        $('#frmSaveRework_po_no').val( $('#txt_po_number_lbl').val() );
        $("#mdlSaveRework").modal('show');
      });

      $("#select_runcard_no").change(function(){
        // alert( $(this).val() )
        $.ajax({
          'data'      : {id: $(this).val()},
          'type'      : 'get',
          'dataType'  : 'json',
          'url'       : 'getDetailsOfRuncard',
          success     : function(JSONDATA){
            let data = JSONDATA['data']
            if(data.length == 0)
              $('#frmSaveRework_unit_no').val('')
            else
              $('#frmSaveRework_unit_no').val(data[0]['qty_ng'])
            $('#frmSaveRework_unit_no').attr('readonly', true)
          },
          error : function(data){
          },
        })
      })

      $("#frmSaveRework").submit(function(e){
        e.preventDefault();
        SaveRework();
      });

      $("#tblRework").on('click', '.btnEditRework', function(e){
        // $("#mdlSaveRework").modal('show');
        let reworkId = $(this).attr('rework-id');
        GetReworkById(reworkId);
      });

    });

// REWORK FUNCTIONS  
    // function SaveRework(){
    //   // alert('Submitted!');
    //   // return 'wew';
    //   var data = $("#frmSaveMaterial").serialize() + '&txt_prod_runcard_id_query=' + $("#txt_prod_runcard_id_query").val() + '&txt_po_number=' + $("#txt_po_number").val() + '&txt_employee_number_scanner=' + $("#txt_employee_number_scanner").val() + '&_token=' + '{{ csrf_token() }}';
    //   $.ajax({
    //     'data'      : data,
    //     'type'      : 'post',
    //     'dataType'  : 'json',
    //     'url'       : 'defect_escalation_save_material',
    //     success     : function(data){
    //       $('#mdl_alert #mdl_alert_title').html(data['title']);
    //       $('#mdl_alert #mdl_alert_body').html(data['body']);
    //       $('#mdl_alert').modal('show');

    //       var data_arr = [];
    //       data_arr['material_id']     = $('#txt_wbs_kit_issuance_id_query').val();
    //       data_arr['material_code']   = $('#txt_part_number').val();
    //       // fn_select_material_details(data_arr);
    //       // GetProdRuncardById($("#txt_prod_runcard_id_query").val());
    //       dt_materials.draw();
    //     },
        
    //     error     : function(data){
    //     },
    //   });
    // }
// REWORK FUNCTIONS

function OutputDataCounter(api) {
        let counter = 0;

        api.column().data(0, {page:'current'}).each( function (group, i) {

              let data = api.row(i).data();
              let output = data.qty_output;
              let status = data.status;
              // if(output != null){
              //   counter++;
              // }

              if(status == 1){
                counter++;
              }
        });

        if(api.rows().count() > 0 && (counter == api.rows().count())){
          dtOutputStatus = true;
        }
        else{
          dtOutputStatus = false;
        }

        if(api.rows().count() > 0){
          // $("#btnSaveSelectedMatSak").prop('disabled', true);
        }
        // else{
         // $("#btnSaveSelectedMatSak").prop('disabled', false);
        // }

        // alert(dtOutputStatus);
        if(dtOutputStatus){
          // $("#btn_edit_material_details_verification").prop('disabled', false);
          if($("#txt_prod_runcard_status").val() == 1){
            // $("#btn_edit_material_details_verification").prop('disabled', true);
          }
          else{
            // $("#btn_edit_material_details_verification").prop('disabled', false);
          }
        }
        else{ 
          // $("#btn_edit_material_details_verification").prop('disabled', true);
        }
      }


      function HandleButtons(status){
        // $("#btn_edit_material_details_primary").prop('disabled', status);  
        $("#btnSaveSelectedMatSak").prop('disabled', status);
        // $("#btnSaveSelectedEmboss").prop('disabled', status);
        $("#btn_setup_stations").prop('disabled', status);
        $("#btn_edit_material_details_verification").prop('disabled', status);
        $("#btn_approve_prod").prop('disabled', status);
        $("#btn_approve_qc").prop('disabled', status);
      }

      function save_approve_prod(){
        var data = 'txt_prod_runcard_id_query=' + $("#txt_prod_runcard_id_query").val()+'&txt_employee_number_scanner=' + $("#txt_employee_number_scanner").val() + '&_token=' + '{{ csrf_token() }}';

        $.ajax({
          'data'      : data,
          'type'      : 'post',
          'dataType'  : 'json',
          'url'       : 'update_prod_runcard_approval_prod',
          success     : function(data){
            $('#mdl_alert #mdl_alert_title').html(data['title']);
            $('#mdl_alert #mdl_alert_body').html(data['body']);
            $('#mdl_alert').modal('show');

            var data_arr = [];
            data_arr['material_id']     = $('#txt_wbs_kit_issuance_id_query').val();
            data_arr['material_code']   = $('#txt_part_number').val();
            // fn_select_material_details(data_arr);
            GetProdRuncardById($("#txt_prod_runcard_id_query").val());
          },
          completed     : function(data){
            var data_arr = [];
            data_arr['material_id']     = $('#txt_wbs_kit_issuance_id_query').val();
            data_arr['material_code']   = $('#txt_part_number').val();
            // fn_select_material_details(data_arr);
            $('#mdl_alert #mdl_alert_title').html(data['title']);
            $('#mdl_alert #mdl_alert_body').html(data['body']);
            $('#mdl_alert').modal('show');
            GetProdRuncardById($("#txt_prod_runcard_id_query").val());
          },
          error     : function(data){
          },
        });
      }

      function submit_to_oqc_lot_app(){
        // alert('Submitted!');
        // return 'wew';
        var data = 'txt_prod_runcard_id_query=' + $("#txt_prod_runcard_id_query").val()+'&txt_employee_number_scanner=' + $("#txt_employee_number_scanner").val() + '&_token=' + '{{ csrf_token() }}';

        $.ajax({
          'data'      : data,
          'type'      : 'post',
          'dataType'  : 'json',
          'url'       : 'submit_de_to_oqc_lot_app',
          success     : function(data){
            $('#mdl_alert #mdl_alert_title').html(data['title']);
            $('#mdl_alert #mdl_alert_body').html(data['body']);
            $('#mdl_alert').modal('show');

            var data_arr = [];
            data_arr['material_id']     = $('#txt_wbs_kit_issuance_id_query').val();
            data_arr['material_code']   = $('#txt_part_number').val();
            // fn_select_material_details(data_arr);
            GetProdRuncardById($("#txt_prod_runcard_id_query").val());
          },
          completed     : function(data){
            var data_arr = [];
            data_arr['material_id']     = $('#txt_wbs_kit_issuance_id_query').val();
            data_arr['material_code']   = $('#txt_part_number').val();
            // fn_select_material_details(data_arr);
            $('#mdl_alert #mdl_alert_title').html(data['title']);
            $('#mdl_alert #mdl_alert_body').html(data['body']);
            $('#mdl_alert').modal('show');
            GetProdRuncardById($("#txt_prod_runcard_id_query").val());
          },
          error     : function(data){
          },
        });
      }

      function save_material(){
        // alert('Submitted!');
        // return 'wew';
        var data = $("#frmSaveMaterial").serialize() + '&txt_prod_runcard_id_query=' + $("#txt_prod_runcard_id_query").val() + '&txt_po_number=' + $("#txt_po_number").val() + '&txt_employee_number_scanner=' + $("#txt_employee_number_scanner").val() + '&_token=' + '{{ csrf_token() }}';

        $.ajax({
          'data'      : data,
          'type'      : 'post',
          'dataType'  : 'json',
          'url'       : 'defect_escalation_save_material',
          success     : function(data){
            $('#mdl_alert #mdl_alert_title').html(data['title']);
            $('#mdl_alert #mdl_alert_body').html(data['body']);
            $('#mdl_alert').modal('show');

            var data_arr = [];
            data_arr['material_id']     = $('#txt_wbs_kit_issuance_id_query').val();
            data_arr['material_code']   = $('#txt_part_number').val();
            // fn_select_material_details(data_arr);
            // GetProdRuncardById($("#txt_prod_runcard_id_query").val());
            dt_materials.draw();
          },
          completed     : function(data){
            var data_arr = [];
            data_arr['material_id']     = $('#txt_wbs_kit_issuance_id_query').val();
            data_arr['material_code']   = $('#txt_part_number').val();
            // fn_select_material_details(data_arr);
            $('#mdl_alert #mdl_alert_title').html(data['title']);
            $('#mdl_alert #mdl_alert_body').html(data['body']);
            $('#mdl_alert').modal('show');
          },
          error     : function(data){
          },
        });
      }

      function save_approve_qc(){
        var data = 'txt_prod_runcard_id_query=' + $("#txt_prod_runcard_id_query").val()+'&txt_employee_number_scanner=' + $("#txt_employee_number_scanner").val() + '&_token=' + '{{ csrf_token() }}';

        $.ajax({
          'data'      : data,
          'type'      : 'post',
          'dataTypesdsd'  : 'json',
          'url'       : 'update_prod_runcard_approval_qc',
          success     : function(data){
            $('#mdl_alert #mdl_alert_title').html(data['title']);
            $('#mdl_alert #mdl_alert_body').html(data['body']);
            $('#mdl_alert').modal('show');
            var data_arr = [];
            data_arr['material_id']     = $('#txt_wbs_kit_issuance_id_query').val();
            data_arr['material_code']   = $('#txt_part_number').val();
            // fn_select_material_details(data_arr);
            GetProdRuncardById($("#txt_prod_runcard_id_query").val());
          },
          completed     : function(data){
            var data_arr = [];
            data_arr['material_id']     = $('#txt_wbs_kit_issuance_id_query').val();
            data_arr['material_code']   = $('#txt_part_number').val();
            // fn_select_material_details(data_arr);
            $('#mdl_alert #mdl_alert_title').html(data['title']);
            $('#mdl_alert #mdl_alert_body').html(data['body']);
            $('#mdl_alert').modal('show');
            GetProdRuncardById($("#txt_prod_runcard_id_query").val());
          },
          error     : function(data){

          },
        });
      }

    function GetMaterialKitting(){
      $.ajax({
        url: "get_wbs_material_kitting",
        method: 'get',
        dataType: 'json',
        data: {
          po_number: currentPoNo
          // po_number: $("#txt_po_number_lbl").val()
        },
        beforeSend: function(){
          boxing = "";
          assessment = "";
          aDrawing = "";
          aDrawingRev = "";
          gDrawing = "";
          gDrawingRev = "";
        },
        success: function(data){
          if(data['material_kitting'] != null){
            $("#txt_po_number_lbl").val(data['material_kitting']['po_no']);
            $("#txt_device_name_lbl").val(data['material_kitting']['device_name']);
            $("#txt_device_code_lbl").val(data['material_kitting']['device_code']);
            $("#txt_po_qty_lbl").val(data['material_kitting']['po_qty']);
            if(data['material_kitting']['device_info'] != null){
              // $("#txt_lot_qty").val(data['material_kitting']['device_info']['boxing']);
              boxing = data['material_kitting']['device_info']['boxing'];
              // alert(boxing);
            }
            else{
              boxing = "";
              // $("#txt_lot_qty").val("");
            }

            if(data['material_kitting']['assessment'] != null){
              assessment = data['material_kitting']['device_info']['assessment'];
            }
            else{
              assessment = "";
            }

            if(data['material_kitting']['material_issuance_details'].length > 0){
                $("#txt_ct_supplier").val(data['material_kitting']['material_issuance_details'][0]['supplier']);
            }
            else{
                $("#txt_ct_supplier").val('');
            }

            // if(data['material_kitting']['documents_details'].length > 0){
            //   for(let index = 0; index < data['material_kitting']['documents_details'].length; index++){
            //     if(data['material_kitting']['documents_details'][index]['doc_no'].charAt(0).toUpperCase() == "A"){
            //       aDrawing = data['material_kitting']['documents_details'][index]['doc_no'];
            //       aDrawingRev = data['material_kitting']['documents_details'][index]['rev_no'];
            //     }
            //     else if(data['material_kitting']['documents_details'][index]['doc_no'].charAt(0).toUpperCase() == "G"){
            //       gDrawing = data['material_kitting']['documents_details'][index]['doc_no'];
            //       gDrawingRev = data['material_kitting']['documents_details'][index]['rev_no'];
            //     }
            //   }

            //   $("#txt_a_drawing_no").val(aDrawing);
            //   $("#txt_a_drawing_rev").val(aDrawingRev);
            //   $("#txt_g_drawing_no").val(gDrawing);
            //   $("#txt_g_drawing_rev").val(gDrawingRev);
            // }
            if(data['doc_a_drawing_query'].length > 0){
              aDrawing = data['doc_a_drawing_query'][0].doc_no;
              aDrawingRev = data['doc_a_drawing_query'][0].rev_no;
            }
            else{
              aDrawing = "";
              aDrawingRev = "";
            }
            $("#txt_a_drawing_no").val(aDrawing);
            $("#txt_a_drawing_rev").val(aDrawingRev);

            if(data['doc_g_drawing_query'].length > 0){
              gDrawing = data['doc_g_drawing_query'][0].doc_no;
              gDrawingRev = data['doc_g_drawing_query'][0].rev_no;
            }
            else{
              gDrawing = "";
              gDrawingRev = "";
            }
            $("#txt_g_drawing_no").val(gDrawing);
            $("#txt_g_drawing_rev").val(gDrawingRev);

            // materialKitTransferSlip = data['material_kitting']['issuance_no'];
            // $("#txt_material_transfer_slip_lbl").val(materialKitTransferSlip);
            // dt_materials.draw();

            // $("#txt_lot_qty").val(boxing);
          }
          else{
            $("#txt_po_number_lbl").val('');
            $("#txt_device_name_lbl").val('');
            $("#txt_device_code_lbl").val('');
            $("#txt_po_qty_lbl").val(''); 
            $("#txt_lot_qty").val("");
          }
        }
      });
    }

    function GetSakidashiIssuance(){
      $.ajax({
        url: "get_wbs_sakidashi_issuance",
        method: 'get',
        dataType: 'json',
        data: {
          po_number: currentPoNo
          // po_number: $("#txt_po_number_lbl").val()

        },
        beforeSend: function(){
          // boxing = "";
        },
        success: function(data){
          if(data['sakidashi_issuance'] != null){
            sakidashiCtrlNo = data['sakidashi_issuance']['issuance_no'];
            $("#txt_sakidashi_ctrl_no_lbl").val(sakidashiCtrlNo);
            dt_sakidashi.draw();
          }
          else{
            sakidashiCtrlNo = "";
            $("#txt_sakidashi_ctrl_no_lbl").val("");
            dt_sakidashi.draw();
          }
        }
      });
    }

    function GetProdRuncardById(prodRuncardId){
      $.ajax({
        url: "get_defect_escalation_by_id",
        method: 'get',
        dataType: 'json',
        data: {
          prod_runcard_id: prodRuncardId
        },
        beforeSend: function(){
          arrSelectedMaterial = [];
          arrSelectedSakidashi = [];
          // arrSelectedEmboss = [];
          readonly_material_details_primary(true);
          readonly_material_details_secondary(true);
          // reset_material_details_primary();
          // reset_material_details_secondary();
        },
        success: function(data){
          if(data['prod_runcard'] != null){
            $("#modalRuncardDetails").modal('show');
            $("#txt_po_number").val($("#txt_po_number_lbl").val());
            $("#txt_po_qty").val($("#txt_po_qty_lbl").val());
            $("#txt_use_for_device").val($("#txt_device_name_lbl").val());
            $("#txt_device_code").val($("#txt_device_code_lbl").val());
            $("#txt_prod_runcard_id_query").val(data['prod_runcard']['id']);
            $("#txt_prod_runcard_status").val(data['prod_runcard']['status']);
            // if(data['prod_runcard']['status'] == 3){
            //   $("#btnSubmitToOQCLotApp")
            // }
            // $("#txt_prod_runcard_has_emboss").val(data['prod_runcard']['has_emboss']);
            // $("#txt_prod_runcard_require_oqc_before_emboss").val(data['prod_runcard']['require_oqc_before_emboss']);
            $("#txt_prod_runcard_verification_id_query").val(data['prod_runcard']['id']);
            $("#txt_runcard_no").val(data['prod_runcard']['runcard_no']);
            $("#txt_reel_lot_no").val(data['prod_runcard']['reel_lot_no']);
            $("#txt_lot_qty").val(data['prod_runcard']['lot_qty']);
            // $("#txt_assessment_no").val(data['prod_runcard']['assessment_no']);
            // $("#txt_a_drawing_no").val(data['prod_runcard']['a_drawing_no']);
            // $("#txt_a_drawing_rev").val(data['prod_runcard']['a_drawing_rev']);
            // $("#txt_g_drawing_no").val(data['prod_runcard']['g_drawing_no']);
            // $("#txt_g_drawing_rev").val(data['prod_runcard']['g_drawing_rev']);
            // $("#txt_other_docs_no").val(data['prod_runcard']['other_docs_no']);
            // $("#txt_other_docs_rev").val(data['prod_runcard']['other_docs_rev']);
            $("#txt_mold").val(data['prod_runcard']['mold']);
            $("#txt_ct_supplier").val(data['prod_runcard']['ct_supplier']);
            $("#txt_die_no").val(data['prod_runcard']['die_no']);
            $("#txt_pair_no").val(data['prod_runcard']['pair_no']);
            $("#sel_operator").val(data['prod_runcard']['operator']).trigger('change');
            $("#sel_sub_station").val(data['prod_runcard']['sub_station_id']).trigger('change');
            $("#sel_assembly_line").val(data['prod_runcard']['assembly_line_id']).trigger('change');

            $("#txt_remarks").val(data['prod_runcard']['remarks']);

            $("#txt_created_at").val(data['prod_runcard']['created_at']);

            // alert(data['prod_runcard']['require_oqc_before_emboss']);

            if(data['prod_runcard']['discrepant_qty'] != null){
              if(data['prod_runcard']['discrepant_qty'] < 0){
                $('#txt_discrepant_qty_sign').val("-");
                $('#txt_discrepant_qty').val(data['prod_runcard']['discrepant_qty'] * -1);
              }
              else if(data['prod_runcard']['discrepant_qty'] == 0){
                $('#txt_discrepant_qty_sign').val("0");
                $('#txt_discrepant_qty').val(data['prod_runcard']['discrepant_qty']);
              }
              else{
                $('#txt_discrepant_qty_sign').val("+");
                $('#txt_discrepant_qty').val(data['prod_runcard']['discrepant_qty']);
              }
            }
            else{
              $('#txt_discrepant_qty_sign').val("0");
              $('#txt_discrepant_qty').val("");
            }

            $('#txt_analysis').val(data['prod_runcard']['analysis']);
            $('#txt_recount_ok').val(data['prod_runcard']['recount_ok']);
            $('#txt_recount_ng').val(data['prod_runcard']['recount_ng']);

            if(data['prod_runcard']['supervisor_prod_info'] != null){
              $('#txt_prod_approval').val(data['prod_runcard']['supervisor_prod_info']['name']);
            }
            else{
              $('#txt_prod_approval').val("");
            }

            if(data['prod_runcard']['supervisor_qc_info'] != null){
              $('#txt_qc_approval').val(data['prod_runcard']['supervisor_qc_info']['name']);
            }
            else{
              $('#txt_qc_approval').val("");
            }

            HandleButtons(true);
            let prodRuncardStat = data['prod_runcard']['status'];
            if(prodRuncardStat == 1){
              $("#btn_edit_material_details_primary").prop('disabled', false);  
              $("#btnSaveSelectedMatSak").prop('disabled', false);
              // $("#btnSaveSelectedEmboss").prop('disabled', true);
              $("#btn_setup_stations").prop('disabled', true);
              $("#btn_edit_material_details_verification").prop('disabled', true);
              $("#btn_approve_prod").prop('disabled', true);
              $("#btn_approve_qc").prop('disabled', true);
            }
            else if(prodRuncardStat == 2){
              $("#btn_edit_material_details_primary").prop('disabled', false);  
              // $("#btnSaveSelectedMatSak").prop('disabled', true);
              $("#btnSaveSelectedMatSak").prop('disabled', false);
              // $("#btnSaveSelectedEmboss").prop('disabled', true);
              $("#btn_setup_stations").prop('disabled', true);
              $("#btn_edit_material_details_verification").prop('disabled', false);
              $("#btn_approve_prod").prop('disabled', true);
              $("#btn_approve_qc").prop('disabled', true);
            }
            else if(prodRuncardStat == 3){
              $("#btn_edit_material_details_primary").prop('disabled', false);  
              $("#btnSaveSelectedMatSak").prop('disabled', false);
              // $("#btnSaveSelectedEmboss").prop('disabled', true);
              $("#btn_setup_stations").prop('disabled', true);
              $("#btn_edit_material_details_verification").prop('disabled', false);
              $("#btn_approve_prod").prop('disabled', true);
              $("#btn_approve_qc").prop('disabled', true);
            }
            else if(prodRuncardStat == 4){
              $("#btn_edit_material_details_primary").prop('disabled', false);  
              $("#btnSaveSelectedMatSak").prop('disabled', true);
              // $("#btnSaveSelectedEmboss").prop('disabled', true);
              $("#btn_setup_stations").prop('disabled', true);
              $("#btn_edit_material_details_verification").prop('disabled', true);
              $("#btn_approve_prod").prop('disabled', false);
              $("#btn_approve_qc").prop('disabled', true);
            }
            else if(prodRuncardStat == 5){
              $("#btn_edit_material_details_primary").prop('disabled', false);  
              $("#btnSaveSelectedMatSak").prop('disabled', true);
              // $("#btnSaveSelectedEmboss").prop('disabled', true);
              $("#btn_setup_stations").prop('disabled', true);
              $("#btn_edit_material_details_verification").prop('disabled', true);
              $("#btn_approve_prod").prop('disabled', true);
              $("#btn_approve_qc").prop('disabled', false);
            }
            else if(prodRuncardStat == 7){
              $("#btn_edit_material_details_primary").prop('disabled', true);  
              // $("#btnSaveSelectedEmboss").prop('disabled', false);
            }
            else if(prodRuncardStat == 8){
              $("#btn_edit_material_details_primary").prop('disabled', true);  
              // $("#btnSaveSelectedEmboss").prop('disabled', true); 
            }
            else{
              HandleButtons(true);
            }

            if(data['prod_runcard']['product_type'] == 1){
              $("#rdo_product_type_automotive").prop('checked', true);
              $("#rdo_product_type_regular_product").prop('checked', false);
            }
            else{
              $("#rdo_product_type_automotive").prop('checked', false);
              $("#rdo_product_type_regular_product").prop('checked', true);
            }

            if(data['prod_runcard']['product_type2'] == 1){
              $("#rdo_product_type2_a").prop('checked', true);
              $("#rdo_product_type2_b").prop('checked', false);
            }
            else{
              $("#rdo_product_type2_a").prop('checked', false);
              $("#rdo_product_type2_b").prop('checked', true);
            }

            // alert(data['prod_runcard']['status']);
            if(data['prod_runcard']['status'] == 3){
              $("#btn_edit_material_details_primary").prop('disabled', true);
              $("#btnAddMaterial").prop('disabled', true);
              $("#btnDEAddProcess").prop('disabled', true);
              $("#btnSubmitToOQCLotApp").prop('disabled', true);
            }
            else{
              $("#btn_edit_material_details_primary").prop('disabled', false);
              $("#btnAddMaterial").prop('disabled', false);
              $("#btnDEAddProcess").prop('disabled', false);
              $("#btnSubmitToOQCLotApp").prop('disabled', false);
            }

            // $("#btn_setup_stations").removeAttr('disabled');
            // $("#btn_edit_material_details_verification").removeAttr('disabled');
            // $("#btnSaveSelectedMatSak").removeAttr('disabled');
            // $("#btn_approve_prod").removeAttr('disabled');
            // $("#btn_approve_qc").removeAttr('disabled');
          }
          else{
            $("#txt_po_number").val('');
            $("#txt_po_qty").val('');
            $("#txt_use_for_device").val('');
            $("#txt_device_code").val('');
            $("#txt_runcard_no").val('');
            $("#txt_reel_lot_no").val('');
            $("#txt_lot_qty").val('');
            $("#txt_assessment_no").val('');
            $("#txt_a_drawing_no").val('');
            $("#txt_a_drawing_rev").val('');
            $("#txt_g_drawing_no").val('');
            $("#txt_g_drawing_rev").val('');
            $("#txt_other_docs_no").val('');
            $("#txt_other_docs_rev").val('');
            $("#txt_mold").val('');
            $("#txt_ct_supplier").val('');
            $("#txt_die_no").val('');
            $("#txt_pair_no").val('');
            $("#sel_operator").val(null).trigger('change');
            $("#sel_sub_station").val(null).trigger('change');
            $("#sel_assembly_line").val(null).trigger('change');
            $("#txt_remarks").val('');

            $("#txt_created_at").val('');

            // $("#btn_setup_stations").prop('disabled', 'disabled');
            // $("#btnSaveSelectedMatSak").prop('disabled', true);
            // $("#btn_edit_material_details_verification").prop('disabled', true);
            // $("#btn_setup_stations").prop('disabled', true);
            // $("#btn_approve_prod").prop('disabled', true);
            // $("#btn_approve_qc").prop('disabled', true);
          }

          let noOfSelected = parseInt(arrSelectedMaterial.length) + parseInt(arrSelectedSakidashi.length);
          if(noOfSelected > 0 && hasProdMatSakList){
            $("#spanNoOfSelectedMatSak").text("(" + noOfSelected + ")");
            // $("#btnSaveSelectedMatSak").prop('disabled', true);
          }
          else{
            $("#spanNoOfSelectedMatSak").text("");
            // $("#btnSaveSelectedMatSak").prop('disabled', false);
          }
          dt_materials.draw();
          dt_sakidashi.draw();
          // dt_emboss.draw();
          dt_prod_runcard_stations.draw();
          // console.log(arrSelectedMaterial);
          // console.log(arrSelectedSakidashi);
          dtReworks.draw();
        }
      });
    }

    function SaveProductMaterialList(arrSelectedMaterials, arrSelectedSakidashis, _token, employeeId, prodRuncardId){
      // alert(prodRuncardId);
      // return 'wew';
      $.ajax({
        url : 'save_prod_material_list',
        method : 'post',
        data: {
          _token: _token,
          material_issuance: arrSelectedMaterials,
          sakidashi_issuance: arrSelectedSakidashis,
          employee_id: employeeId,
          prod_runcard_id: prodRuncardId
        },
        dataType : 'json',
        before: function(){
          alert("Loading...");
        },
        success     : function(data){
          $('#mdl_alert #mdl_alert_title').html(data['title']);
          $('#mdl_alert #mdl_alert_body').html(data['body']);
          $('#mdl_alert').modal('show');

          // $("#btnSaveSelectedMatSak").prop('disabled', true);
          // arrSelectedMaterial = arrSelectedMaterials;
          // arrSelectedSakidashi = arrSelectedSakidashis;
          // dt_prod_runcard.draw();
          // dt_materials.draw();
          // dt_sakidashi.draw();

          // alert('Saved!');
          GetProdRuncardById($("#txt_prod_runcard_id_query").val());
        },
        completed     : function(data){
          // alert('Saved!');
          GetProdRuncardById($("#txt_prod_runcard_id_query").val()); 
        },
        error     : function(data){

        },
      });
    }

    // function SaveProductEmbossMaterialList(arrSelectedEmbosses, _token, employeeId, prodRuncardId){
    //   // alert(prodRuncardId);
    //   // return 'wew';
    //   $.ajax({
    //     url : 'save_prod_emboss_material_list',
    //     method : 'post',
    //     data: {
    //       _token: _token,
    //       emboss_issuance: arrSelectedEmbosses,
    //       employee_id: employeeId,
    //       prod_runcard_id: prodRuncardId
    //     },
    //     dataType : 'json',
    //     before: function(){
    //       alert("Loading...");
    //     },
    //     success     : function(data){
    //       $('#mdl_alert #mdl_alert_title').html(data['title']);
    //       $('#mdl_alert #mdl_alert_body').html(data['body']);
    //       $('#mdl_alert').modal('show');

    //       // $("#btnSaveSelectedMatSak").prop('disabled', true);
    //       // arrSelectedMaterial = arrSelectedMaterials;
    //       // arrSelectedSakidashi = arrSelectedSakidashis;
    //       // dt_prod_runcard.draw();
    //       // dt_materials.draw();
    //       // dt_sakidashi.draw();

    //       // alert('Saved!');
    //       GetProdRuncardById($("#txt_prod_runcard_id_query").val());
    //     },
    //     completed     : function(data){
    //       // alert('Saved!');
    //       GetProdRuncardById($("#txt_prod_runcard_id_query").val()); 
    //     },
    //     error     : function(data){

    //     },
    //   });
    // }

    function SaveSakidashiLotIssuanceId(issuanceId, item, itemDesc, operator){

      // console.log("item : " + item + '\n' + 'item desc: ' + itemDesc);
      $.ajax({
        url : 'save_sakidashi_lot_issuance',
        method : 'post',
        data: {
          _token: _token,
          issuance_id: issuanceId,
          item: item,
          item_desc: itemDesc,
          operator: operator,
          prod_runcard_id: $("#txt_prod_runcard_id_query").val(),
          device_name: $("#txt_device_name_lbl").val(),
        },
        dataType : 'json',
        before: function(){
          
        },
        success: function(data){
          
          $("#modalScanPOTransLotCode").modal('hide');

          if(data['final_result'] == 1){
            toastr.success('Material Saved!');
            if(data['runcard_id'] != null){
              viewSakidashiAction = 1;
              viewSakidashiActionLotNo = null;
              $("#txtSearchedSakidashiLot").val('');
              GetProdRuncardById(data['runcard_id']);
            }
          }
          else{
           toastr.error(data['remarks']); 
          }
        },
        completed: function(data){
          GetProdRuncardById($("#txt_prod_runcard_id_query").val()); 
        },
        error: function(data){

        },
      });
    }

    // function SaveEmbossLotIssuanceId(issuanceId, item, itemDesc, operator){

    //   // console.log("item : " + item + '\n' + 'item desc: ' + itemDesc);
    //   $.ajax({
    //     url : 'save_emboss_lot_issuance',
    //     method : 'post',
    //     data: {
    //       _token: _token,
    //       issuance_id: issuanceId,
    //       item: item,
    //       item_desc: itemDesc,
    //       operator: operator,
    //       prod_runcard_id: $("#txt_prod_runcard_id_query").val(),
    //       device_name: $("#txt_device_name_lbl").val(),
    //     },
    //     dataType : 'json',
    //     before: function(){
          
    //     },
    //     success: function(data){
          
    //       $("#modalScanPOTransLotCode").modal('hide');

    //       if(data['final_result'] == 1){
    //         toastr.success('Material Saved!');
    //         if(data['runcard_id'] != null){
    //           viewEmbossAction = 1;
    //           viewEmbossActionLotNo = null;
    //           $("#txtSearchedEmbossLot").val('');
    //           GetProdRuncardById(data['runcard_id']);
    //         }
    //       }
    //       else{
    //        toastr.error(data['remarks']); 
    //       }
    //     },
    //     completed: function(data){
    //       GetProdRuncardById($("#txt_prod_runcard_id_query").val()); 
    //     },
    //     error: function(data){

    //     },
    //   });
    // }

    function save_setup_stations(){
      var arr_substations = [];
      var ctr = 0;
      $('#tbl_setup_stations tbody .ckb_station:checked').each(function(){
        if(!$(this).attr('disabled')){
          // console.log('disabled');
          arr_substations[ctr] = {
              'step' : $(this).closest('td').find('.col_station_step').val(),
              'station' : $(this).closest('td').find('.col_station_id').val(),
              'substation' : $(this).closest('td').find('.col_sub_station_id').val(),
            };
          ctr++;
        }
        // else{
        //   console.log('enabled');
        // }
      });
      if( !jQuery.isEmptyObject(arr_substations) ){
        // console.log(arr_substations);

        if($("#txt_prod_runcard_id_query").val() != ""){
          var data = {
            'txt_prod_runcard_id_query'      : $("#txt_prod_runcard_id_query").val(),
            'txt_employee_number_scanner'   : $("#txt_employee_number_scanner").val(),
            '_token'                        : '{{ csrf_token() }}',
            'arr_substations'               : arr_substations,
          }
          $.ajax({
            'data'      : data,
            'type'      : 'post',
            'dataType'  : 'json',
            'url'       : 'insert_prod_runcard_setup_stations',
            success     : function(data){
                $('#mdl_setup_stations').modal('hide');
                $('#mdl_alert #mdl_alert_title').html(data['title']);
                $('#mdl_alert #mdl_alert_body').html(data['body']);
                $('#mdl_alert').modal('show');
                
                if(data['result'] != '0'){
                  dt_prod_runcard_stations.draw();
                }
                GetProdRuncardById($("#txt_prod_runcard_id_query").val());
            },
            completed     : function(data){

            },
            error     : function(data){

            },
          });
        }
        else{
          toastr.error('Defect Escalation No not found!', 'Set-up Stations');
        }
      }
      else{
        $('#mdl_alert #mdl_alert_title').html('<i class="fa fa-exclamation-triangle text-warning"></i> Message');
        $('#mdl_alert #mdl_alert_body').html('Nothing to save.');
        $('#mdl_alert').modal('show');
      }
    }

    function fn_select_prod_runcard_station_details(data_arr, matProcId){
      // reset_material_details_primary();
      // reset_material_details_secondary();
      var data = {
        'col_prod_runcard_station_id' : data_arr['col_prod_runcard_station_id'],
        // 'has_emboss' : data_arr['has_emboss'],
        '_token'                   : '{{ csrf_token() }}',
        'device_code': $("#txt_device_code").val(),
        'material_process_id': matProcId
      }
      $.ajax({
        'data'      : data,
        'type'      : 'get',
        'dataType'  : 'json',
        'url'       : 'select_prod_runcard_station_details',
        beforeSend: function(){
          $("#txt_edit_prod_runcard_cert_operator").val(0).trigger('change');
          $("#txt_edit_prod_runcard_cert_operator_visible").val(0).trigger('change');
          $("#txt_edit_prod_runcard_station_assigned_machine").val(0).trigger('change');
          $("#txt_edit_prod_runcard_station_assigned_machine_visible").val(0).trigger('change');
          $("#txt_edit_prod_runcard_station_materials").val("");
        },
        success     : function(jsonObject){
          // alert(data[0]['station']['name'])
          let data = jsonObject['prod_runcard_stations'];
          if ($.trim(data)){
            $('#txt_prod_runcard_station_id_query').val(data[0]['id']);
            $('#txt_edit_prod_runcard_station_step').val(data[0]['step_num']);
            // $('#txt_edit_prod_runcard_station_has_emboss').val(data[0]['has_emboss']);
            $('#txt_edit_prod_runcard_station_station').val(data[0]['station']['name']);
            $('#txt_edit_prod_runcard_substation').val(data[0]['sub_station']['name']);
            $('#txt_edit_prod_runcard_station_date').val( getdate( data[0]['created_at']?data[0]['created_at']:getcurrentdate() ) );

            if(data[0]['qty_input'] != null){
              $('#txt_edit_prod_runcard_station_input').val(data[0]['qty_input']);
            }
            else{
              // $('#txt_edit_prod_runcard_station_input').val($("#txt_lot_qty").val());
            }

            if(data[0]['machine_id'] != null){
              $('#txt_edit_prod_runcard_station_machine').val(data[0]['machine_id']).trigger('change');
            }
            else{
              $('#txt_edit_prod_runcard_station_machine').val("-1").trigger('change');
            }
            if(data[0]['qty_output'] != null){
              $('#txt_edit_prod_runcard_station_output').val(data[0]['qty_output']);
            }
            if(data[0]['qty_ng'] != null){
              $('#txt_edit_prod_runcard_station_ng').val(data[0]['qty_ng']);
            }
            // $('#txt_edit_prod_runcard_station_output').val(data[0]['qty_output']);
            // $('#txt_edit_prod_runcard_station_ng').val(data[0]['qty_ng']);
            // $('#txt_edit_prod_runcard_station_mod').val(data[0]['mod']);

            if(data[0]['operator'] != null){
              let operators = data[0]['operator'].split(',');
              $('#txt_edit_prod_runcard_operator').val(operators).trigger('change');
              // console.log(operators);
            }
            else{
              $('#txt_edit_prod_runcard_operator').val("0").trigger('change');
            }

            let operatorsId = [];
            if(jsonObject['material_process'] != null){
              for(let index = 0; index < jsonObject['material_process']['manpowers_details'].length; index++){
                operatorsId.push(jsonObject['material_process']['manpowers_details'][index].manpower_id);
              }
              $("#txt_edit_prod_runcard_cert_operator").val(operatorsId).trigger('change');
              $("#txt_edit_prod_runcard_cert_operator_visible").val(operatorsId).trigger('change');
            }

            let machineId = [];
            if(jsonObject['material_process'] != null){
              for(let index = 0; index < jsonObject['material_process']['machine_details'].length; index++){
                machineId.push(jsonObject['material_process']['machine_details'][index].machine_id);
              }
              $("#txt_edit_prod_runcard_station_assigned_machine").val(machineId).trigger('change');
              $("#txt_edit_prod_runcard_station_assigned_machine_visible").val(machineId).trigger('change');
            }

            $("#txt_edit_prod_runcard_station_materials").val(jsonObject['material_process']['material']);

            if($("#txt_edit_prod_runcard_station_ng").val() == 0 || $("#txt_edit_prod_runcard_station_ng").val() == ""){
              $("#btnAddMODTable").prop('disabled', true);
            }
            else{
              $("#btnAddMODTable").prop('disabled', false);
            }

            // Get assigned materials (kitting, sakidashi, emboss)

            let arrMaterialKittingData = [];
            let arrSakidashiIssuanceData = [];
            // let arrEmbossData = [];

            if(jsonObject['material_process'] != null){
              for(let index = 0; index < jsonObject['material_process']['material_details'].length; index++){
                if(jsonObject['material_process']['material_details'][index].tbl_wbs == 1){
                  arrMaterialKittingData.push(jsonObject['material_process']['material_details'][index].item + '--' + jsonObject['material_process']['material_details'][index].item_desc);
                }
                else if(jsonObject['material_process']['material_details'][index].tbl_wbs == 2){
                  arrSakidashiIssuanceData.push(jsonObject['material_process']['material_details'][index].item + '--' + jsonObject['material_process']['material_details'][index].item_desc); 
                }
                // else if(jsonObject['material_process']['material_details'][index].tbl_wbs == 2 && jsonObject['material_process']['material_details'][index].has_emboss == 1){
                //   arrEmbossData.push(jsonObject['material_process']['material_details'][index].item + '--' + jsonObject['material_process']['material_details'][index].item_desc);  
                // }
              }
            }

            $("#txt_edit_prod_runcard_station_material_kitting").val(0).trigger('change');
            $("#txt_edit_prod_runcard_station_sakidashi").val(0).trigger('change');
            // $("#txt_edit_prod_runcard_station_emboss").val(0).trigger('change');

            $("#txt_edit_prod_runcard_station_assigned_material_kitting").val(arrMaterialKittingData).trigger('change');
            $("#txt_edit_prod_runcard_station_assigned_material_kitting_visible").val(arrMaterialKittingData).trigger('change');
            $("#txt_edit_prod_runcard_station_assigned_sakidashi").val(arrSakidashiIssuanceData).trigger('change');
            $("#txt_edit_prod_runcard_station_assigned_sakidashi_visible").val(arrSakidashiIssuanceData).trigger('change');
            // $("#txt_edit_prod_runcard_station_assigned_emboss").val(arrEmbossData).trigger('change');
            // $("#txt_edit_prod_runcard_station_assigned_emboss_visible").val(arrEmbossData).trigger('change');

            // List the MOD Here

            // $("#txt_edit_prod_runcard_station_assigned_machine").val(jsonObject['material_process']['machine_id']).trigger('change');
          }

          // if($('#txt_prod_runcard_station_id_query').val() == ""){
          //   $('#txt_edit_prod_runcard_station_input').val($("#txt_lot_qty").val());
          // }

          $('#mdl_edit_prod_runcard_station_details').modal('show');
        },
        completed     : function(data){

        },
        error     : function(data){

        },
      });

    }

    // SCAN MATERIAL LOT # CODE
    function ScanProdRuncardMaterialKiting(materialLotNo){
      $.ajax({
        url: 'scan_material_kitting_lot_no',
        method: 'get',
        dataType: 'json',
        data: {
          _token: "{{ csrf_token() }}",
          po_number: currentPoNo,
          // po_number: $("#txt_po_number_lbl").val(),

          lot_no: materialLotNo,
          runcard_id: $("#txt_prod_runcard_id_query").val(),
          device_name: $("#txt_device_name_lbl").val(),
          lot_qty: $("#txt_lot_qty").val(),
          a_drawing: $("#txt_a_drawing_no").val(),
          a_drawing_rev: $("#txt_a_drawing_rev").val(),
          g_drawing: $("#txt_g_drawing_no").val(),
          g_drawing_rev: $("#txt_g_drawing_rev").val(),
          other_docs_no: $("#txt_other_docs_no").val(),
          other_docs_rev: $("#txt_other_docs_rev").val(),
          mold: $("#txt_mold").val(),
          ct_supplier: $("#txt_ct_supplier").val(),
          die_no: $("#txt_die_no").val(),
          pair_no: $("#txt_pair_no").val(),
          remarks: $("#txt_remarks").val(),
          employee_number_scanner: $("#txt_employee_number_scanner").val(),
          // has_emboss: $("#txt_prod_runcard_has_emboss").val(),
          // whs_slip_no: $("#txtScannedWHSSlipNo").val(),
        },
        beforeSend: function(){
          $("#scanPOTransLotIcon").removeClass('fa-qrcode');
          $("#scanPOTransLotIcon").addClass('fa-spinner fa-pulse');
        },
        success: function(data){
          // $("#modal")

          $("#scanPOTransLotIcon").addClass('fa-qrcode');
          $("#scanPOTransLotIcon").removeClass('fa-spinner fa-pulse');
          $("#txtSearchPoTransLotNo").val('');
          $("#txtSearchPoTransLotNo").focus();

          if(data['final_result'] == 1){
            if(data['prep_status']){
              if(data['runcard_material_status']){
                if(data['material_certified']){
                    dt_prod_runcard.draw();
                    toastr.success('Material Saved!');
                    if(data['runcard_id'] != null){
                      GetProdRuncardById(data['runcard_id']);
                    }
                }
                else{
                  toastr.error(data['material_certified_label']);
                }
              }
              else{
                toastr.error(data['runcard_material_status_label']);
              }
            }
            else{
              toastr.error(data['prep_status_label']);
            }
          }
          else{
            // toastr.error('Saving Failed!');
            if(!data['prep_status']){
              toastr.error(data['prep_status_label']);
            }
            else{
              if(!data['runcard_material_status']){
                toastr.error(data['runcard_material_status_label']);
              }
              else{
                if(!data['material_certified']){
                  toastr.error(data['material_certified_label']);
                }
              }
            }
          }
        },
        error: function(data, xhr, status){
          $("#scanPOTransLotIcon").addClass('fa-qrcode');
          $("#scanPOTransLotIcon").removeClass('fa-spinner fa-pulse');
          $("#txtSearchPoTransLotNo").val('');
          $("#txtSearchPoTransLotNo").focus();
        }
      });
    }

    // SCAN SAKIDASHI ISSUANCE LOT # CODE
    function ScanProdRuncardSakidashiIssuance(sakidashiLotNo){
      $.ajax({
        url: 'scan_sakidashi_issuance_lot_no',
        method: 'get',
        dataType: 'json',
        data: {
          _token: "{{ csrf_token() }}",
          po_number: currentPoNo,
          // po_number:  $("#txt_po_number_lbl").val(),

          lot_no: sakidashiLotNo,
          runcard_id: $("#txt_prod_runcard_id_query").val(),
          device_name: $("#txt_device_name_lbl").val(),
        },
        beforeSend: function(){
          $("#scanPOTransLotIcon").removeClass('fa-qrcode');
          $("#scanPOTransLotIcon").addClass('fa-spinner fa-pulse');
        },
        success: function(data){
          $("#scanPOTransLotIcon").addClass('fa-qrcode');
          $("#scanPOTransLotIcon").removeClass('fa-spinner fa-pulse');
          $("#txtSearchPoTransLotNo").val('');
          $("#txtSearchPoTransLotNo").focus();
          // if(data['final_result'] == 1){
          //   dt_prod_runcard.draw();
          //   toastr.success('Material Saved!');
          //   if(data['runcard_id'] != null){
          //     GetProdRuncardById(data['runcard_id']);
          //   }
          // }
          // else{
          //   toastr.error('Saving Failed!');
          // }

          if(data['final_result'] == 2){
            toastr.error(data['remarks']);
          }
          else if(data['final_result'] == 1){
            if(data['prep_status']){
              if(data['runcard_material_status']){
                if(data['material_certified']){
                    dt_prod_runcard.draw();
                    toastr.success('Material Saved!');
                    if(data['runcard_id'] != null){
                      GetProdRuncardById(data['runcard_id']);
                    }
                }
                else{
                  toastr.error(data['material_certified_label']);
                }
              }
              else{
                toastr.error(data['runcard_material_status_label']);
              }
            }
            else{
              toastr.error(data['prep_status_label']);
            }
          }
          else{
            // toastr.error('Saving Failed!');
            if(!data['prep_status']){
              toastr.error(data['prep_status_label']);
            }
            else{
              if(!data['runcard_material_status']){
                toastr.error(data['runcard_material_status_label']);
              }
              else{
                if(!data['material_certified']){
                  toastr.error(data['material_certified_label']);
                }
              }
            }
          }
        },
        error: function(data, xhr, status){
          $("#scanPOTransLotIcon").addClass('fa-qrcode');
          $("#scanPOTransLotIcon").removeClass('fa-spinner fa-pulse');
          $("#txtSearchPoTransLotNo").val('');
          $("#txtSearchPoTransLotNo").focus();
        }
      });
    }

    // SCAN EMBOSS LOT # CODE
    // function ScanProdRuncardEmboss(embossLotNo){
    //   $.ajax({
    //     url: 'scan_emboss_lot_no',
    //     method: 'get',
    //     dataType: 'json',
    //     data: {
    //       _token: "{{ csrf_token() }}",
    //       po_number: currentPoNo,
    //       lot_no: embossLotNo,
    //       runcard_id: $("#txt_prod_runcard_id_query").val(),
    //       device_name: $("#txt_device_name_lbl").val(),
    //     },
    //     beforeSend: function(){
    //       $("#scanPOTransLotIcon").removeClass('fa-qrcode');
    //       $("#scanPOTransLotIcon").addClass('fa-spinner fa-pulse');
    //     },
    //     success: function(data){
    //       // if(data['final_result'] == 1){
    //       //   dt_prod_runcard.draw();
    //       //   toastr.success('Material Saved!');
    //       //   if(data['runcard_id'] != null){
    //       //     GetProdRuncardById(data['runcard_id']);
    //       //   }
    //       // }
    //       // else{
    //       //   toastr.error('Saving Failed!');
    //       // }

    //       $("#scanPOTransLotIcon").addClass('fa-qrcode');
    //       $("#scanPOTransLotIcon").removeClass('fa-spinner fa-pulse');
    //       $("#txtSearchPoTransLotNo").val('');
    //       $("#txtSearchPoTransLotNo").focus();

    //       if(data['final_result'] == 2){
    //         toastr.error(data['remarks']);
    //       }
    //       else if(data['final_result'] == 1){
    //         if(data['prep_status']){
    //           if(data['runcard_material_status']){
    //             if(data['material_certified']){
    //                 dt_prod_runcard.draw();
    //                 toastr.success('Material Saved!');
    //                 if(data['runcard_id'] != null){
    //                   GetProdRuncardById(data['runcard_id']);
    //                 }
    //             }
    //             else{
    //               toastr.warning(data['material_certified_label']);
    //             }
    //           }
    //           else{
    //             toastr.warning(data['runcard_material_status_label']);
    //           }
    //         }
    //         else{
    //           toastr.warning(data['prep_status_label']);
    //         }
    //       }
    //       else{
    //         // toastr.error('Saving Failed!');
    //         if(!data['prep_status']){
    //           toastr.error(data['prep_status_label']);
    //         }
    //         else{
    //           if(!data['runcard_material_status']){
    //             toastr.error(data['runcard_material_status_label']);
    //           }
    //           else{
    //             if(!data['material_certified']){
    //               toastr.error(data['material_certified_label']);
    //             }
    //           }
    //         }
    //       }
    //     },
    //     error: function(data, xhr, status){
    //       $("#scanPOTransLotIcon").addClass('fa-qrcode');
    //       $("#scanPOTransLotIcon").removeClass('fa-spinner fa-pulse');
    //       $("#txtSearchPoTransLotNo").val('');
    //       $("#txtSearchPoTransLotNo").focus();
    //     }
    //   });
    // }

    // SCAN EMPLOYEE # CODE
    function ScanProdRuncardEmployee(employeeNo){
      $.ajax({
        url: 'scan_employee_no',
        method: 'get',
        dataType: 'json',
        data: {
          _token: "{{ csrf_token() }}",
          po_number: currentPoNo,
          // po_number:  $("#txt_po_number_lbl").val(),

          employee_no: employeeNo,
          runcard_id: $("#txt_prod_runcard_id_query").val(),
          device_name: $("#txt_device_name_lbl").val(),
        },
        beforeSend: function(){
          $("#scanPOTransLotIcon").removeClass('fa-qrcode');
          $("#scanPOTransLotIcon").addClass('fa-spinner fa-pulse');
        },
        success: function(data){
          $("#scanPOTransLotIcon").addClass('fa-qrcode');
          $("#scanPOTransLotIcon").removeClass('fa-spinner fa-pulse');
          $("#txtSearchPoTransLotNo").val('');
          $("#txtSearchPoTransLotNo").focus();
          
          if(data['final_result'] == 1){
            if(data['user_status']){
              if(data['certified_status']){
                dt_prod_runcard.draw();
                toastr.success('Operator Saved!');
                if(data['runcard_id'] != null){
                  GetProdRuncardById(data['runcard_id']);
                }
              }
              else{
                toastr.warning(data['certified_status_label']);
              }
            }
            else{
              toastr.warning(data['user_status_label']);
            }
          }
          else{
            // toastr.error('Saving Failed!');
            if(!data['user_status']){
              toastr.error(data['user_status_label']);
            }
            else{
              if(!data['certified_status']){
                toastr.error(data['certified_status_label']);
              }
              else{
                toastr.success('Operator Saved!');
              }
            }
          }
        },
      });
    }

    function reset_material_details_primary(){
      $('#txt_lot_qty').val('');
      $('#txt_assessment_no').val('');
      $('#txt_runcard_no').val('');
      $('#txt_reel_lot_no').val('');
      $('#txt_a_drawing_no').val('');
      $('#txt_a_drawing_rev').val('');
      $('#txt_g_drawing_no').val('');
      $('#txt_g_drawing_rev').val('');
      $('#txt_other_docs_no').val('');
      $('#txt_other_docs_rev').val('');
      $('#txt_mold').val('');
      $('#txt_ct_supplier').val('');
      $('#txt_die_no').val('');
      $('#sel_operator').val('').trigger('change');
      $('#sel_sub_station').val('').trigger('change');
      $('#sel_assembly_line').val('').trigger('change');
      $('#txt_pair_no').val('');
      $('#txt_remarks').val('');
      $('#txt_created_at').val('');

      $('#txt_material_details_emp_num').val('');
      $('#txt_prod_runcard_id_query').val('');
      $('#txt_prod_runcard_status').val('');
      // $('#txt_prod_runcard_require_oqc_before_emboss').val('');
      $('#txt_prod_runcard_verification_id_query').val('');
      $('#txt_prod_runcard_verification_id_query').val('');
      $('#txt_wbs_kit_issuance_id_query').val('');
      $('#txt_wbs_kit_issuance_device_code_query').val('');

      readonly_material_details_primary(true);
    }

    function readonly_material_details_primary(v){
      $('#txt_assessment_no').prop('readonly',v);
      // $('#txt_lot_qty').prop('readonly',v);
      // $('#txt_runcard_no').prop('readonly',v);
      // $('#txt_assessed_qty').prop('readonly',v);
     
      // $('#txt_a_drawing_no').prop('readonly',v);
      // $('#txt_a_drawing_rev').prop('readonly',v);
      // $('#txt_g_drawing_no').prop('readonly',v);
      // $('#txt_g_drawing_rev').prop('readonly',v);
      $('#txt_other_docs_no').prop('readonly',v);
      $('#txt_other_docs_rev').prop('readonly',v);
      $('#txt_mold').prop('readonly',v);
      $('#txt_ct_supplier').prop('readonly',v);
      $('#txt_die_no').prop('readonly',v);
      $('#sel_operator').prop('disabled',v);
      $('#sel_sub_station').prop('disabled',v);
      $('#sel_assembly_line').prop('disabled',v);
      $('#txt_pair_no').prop('readonly',v);
      $('#txt_remarks').prop('readonly',v);

      $('#btn_save_material_details_primary').closest('.row').hide();
      if(!v){
        $('#btn_save_material_details_primary').closest('.row').show();
      }
    }

    function reset_material_details_secondary(){
      $('#txt_discrepant_qty_sign').val('0');
      $('#txt_discrepant_qty').val('');
      $('#txt_analysis').val('');
      $('#txt_recount_ok').val('');
      $('#txt_recount_ng').val('');
      $('#txt_prod_approval').val('');
      $('#txt_qc_approval').val('');
      $("#sel_comp_under_runcard_no").val("").trigger('change');
    }

    function readonly_material_details_secondary(v){
      $('#txt_discrepant_qty_sign').prop('disabled',v);
      $('#txt_discrepant_qty').prop('readonly',v);
      $('#txt_analysis').prop('readonly',v);
      $('#txt_recount_ok').prop('readonly',v);
      $('#txt_recount_ng').prop('readonly',v);
      $('#sel_comp_under_runcard_no').prop('disabled',v);

      $('#btn_save_material_details_secondary').closest('.row').hide();
      if(!v){
        $('#btn_save_material_details_secondary').closest('.row').show();
      }
    }

    function getdate(datetime){
      if(!datetime){
        return '';
      }
      var d = new Date(datetime);
      // var d = new Date();

      var month = d.getMonth()+1;
      var day = d.getDate();

      var output = d.getFullYear() + '-' +
          (month<10 ? '0' : '') + month + '-' +
          (day<10 ? '0' : '') + day;

      // alert(d+'xxxxxx'+output);
      return output;
    }

    function getcurrentdate(){
      var d = new Date();
      return d;

      // var month = d.getMonth()+1;
      // var day = d.getDate();

      // var output = d.getFullYear() + '-' +
      //     (month<10 ? '0' : '') + month + '-' +
      //     (day<10 ? '0' : '') + day;
      // return output;
    }

    function CheckMaterialLotNo(lotNo){
      $.ajax({
        url: 'check_material_no',
        method: 'get',
        dataType: 'json',
        data: {
          _token: "{{ csrf_token() }}",
          po_number: currentPoNo,
          // po_number: $("#txt_po_number_lbl").val(),

          lot_no: lotNo,
          runcard_id: $("#txt_prod_runcard_id_query").val(),
          device_name: $("#txt_device_name_lbl").val(),
        },
        beforeSend: function(){
          // $("#scanPOTransLotIcon").removeClass('fa-qrcode');
          // $("#scanPOTransLotIcon").addClass('fa-spinner fa-pulse');
        },
        success: function(data){
          // $("#scanPOTransLotIcon").addClass('fa-qrcode');
          // $("#scanPOTransLotIcon").removeClass('fa-spinner fa-pulse');
          // $("#txtSearchPoTransLotNo").focus();
          
          if(data['data'].length > 0){
            // toastr.success('Valid Lot No.!');
            // if(data['result'] == 2){
              toastr.success('Valid Material');
              $("input[name='lot_no']", $("#frmSaveMaterial")).val(data['data'][0]['lot_no']);
              $("input[name='type']", $("#frmSaveMaterial")).val(data['type']);
              if(data['type'] == 1){
                $("input[name='text_type']", $("#frmSaveMaterial")).val('Material Issuance');
              }
              else{
                $("input[name='text_type']", $("#frmSaveMaterial")).val('Sakidashi');
              }
              
            // }
            // else if(data['result'] == 4){
            //   toastr.warning('Material not yet received!');
            // }
          }
          else{
            $("input[name='lot_no']", $("#frmSaveMaterial")).val('');
            toastr.error('Invalid Material!');
          }
        },
      });

    }
    //---------------------

  </script>

  @include('prod_runcard.new_script')
  @endsection
@endauth