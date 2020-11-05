<nav class="navbar px-xl-0 sticky-top" id="nav">
    <ul class="main-nav nav nav-tabs" id="settingsTabs" role="tablist">
        <?php foreach ($tables as $key => $table) : ?>
            <li class="nav-item" role="presentation">
                <a aria-controls="tab-<?= $table ?>" class="nav-link <?= array_key_first($tables) === $key ? 'active' : '' ?>" data-toggle="tab" href="#tab-<?= $table ?>" role="tab" aria-selected="<?= array_key_first($tables) === $key ? 'true' : 'false' ?>"><?= $tableThNames[$key] ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>

<main class="content tab-content">

    <?php foreach ($tables as $key => $table) : ?>
        <div id="tab-<?= $table ?>" class="tab-pane fade <?= array_key_first($tables) === $key ? 'active show' : '' ?>">
            <div class="card shadow-sm">
                <div class="table-full-width">
                    <table id="table-<?= $table ?>" class="table table-hover [table-striped] not-datatable text-nowrap w-100 border-bottom">
                        <thead>
                            <tr role="row">
                                <th width="1%" class="align-middle text-center">#</th>
                                <th width="1%" class="align-middle text-center"># คำสั่งซื้อ</th>
                                <th class="align-middle text-center">User ID</th>
                                <th class="align-middle">ชื่อผู้รับ</th>
                                <th class="align-middle">เบอร์โทรศัพท์ติดต่อ</th>
                                <th class="align-middle text-center">อีเมล</th>
                                <th class="align-middle text-center">วันที่สั่งซื้อ</th>
                                <th class="align-middle text-center">สถานะ</th>
                                <th class="align-middle text-center">สลิปชำระเงิน</th>
                                <th class="text-center align-middle text-nowrap"><i class="fas fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot class="bg-light">
                            <tr role="row">
                                <th data-table="<?= $table ?>" width="1%" class="align-middle text-center">#</th>
                                <th data-table="<?= $table ?>" width="1%" class="align-middle text-center"># คำสั่งซื้อ</th>
                                <th data-table="<?= $table ?>" class="align-middle text-center">User ID</th>
                                <th data-table="<?= $table ?>" class="align-middle">ชื่อผู้รับ</th>
                                <th data-table="<?= $table ?>" class="align-middle">เบอร์โทรศัพท์ติดต่อ</th>
                                <th data-table="<?= $table ?>" class="align-middle text-center">อีเมล</th>
                                <th data-table="<?= $table ?>" class="align-middle text-center">วันที่สั่งซื้อ</th>
                                <th data-table="<?= $table ?>" class="align-middle text-center">สถานะ</th>
                                <th data-table="<?= $table ?>" class="align-middle text-center">สลิปชำระเงิน</th>
                                <th data-table="<?= $table ?>" class="text-center align-middle text-nowrap" ass="fas fa-cogs"></i></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

</main>

<div id="order-detail-dialog" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">รายละเอียดคำสั่งซื้อ</h5>
                <button class="btn-close" data-dismiss="modal"></button>
            </div>
            <div class="modal-body bg-light">
                <div class="d-lg-flex justify-content-between align-items-center mb-4">
                    <h1 class="font-weight-light mb-lg-0 d-lg-flex align-items-center">
                        <span>คำสั่งซื้อ: #<span order="id" function="str_pad"></span></span>
                    </h1>
                    <h5 class="ml-lg-3 mb-3 mb-lg-0"><span order="payment_status_badge"></span></h5>
                    <p class="mb-0 ml-lg-3"><i class="far fa-calendar-alt mr-2 text-black-50"></i>วันที่สั่งซื้อ: <span data-datetime order="timestamp"></span></p>
                </div>

                <div class="row mb-4">
                    <div class="col-lg-7">
                        <header class="section-heading mb-3 heading-line d-flex align-items-center justify-content-between">
                            <h3 class="align-items-center d-flex h5 mb-0 title-section">
                                <span class="icon mr-2"><i class="fas fa-map-marker-alt text-black-50"></i></span>
                                <span>ที่อยู่การจัดส่ง</span>
                            </h3>
                        </header>

                        <p class="mb-2"><span order="firstname"></span> <span order="lastname"></span></p>
                        <p class=""><span order="address"></span></p>
                    </div>
                    <div class="col-lg-5">
                        <header class="section-heading mb-3 heading-line d-flex align-items-center justify-content-between">
                            <h3 class="align-items-center d-flex h5 mb-0 title-section">
                                <span class="icon mr-2"><i class="fas fa-list text-black-50"></i></span>
                                <span>สรุปคำสั่งซื้อ</span>
                            </h3>
                        </header>

                        <div>
                            <div class="dotted-list dotted-white mw-100 mx-auto d-flex justify-content-between mb-2" style="width: 400px;">
                                <div class="pr-2">ยอดรวม (<span order="detail" function="count"></span> ชิ้น)</div>
                                <div class="pl-2 m-0">
                                    <span order="summary" function="number_format"></span> <small>THB</small>
                                </div>
                            </div>

                            <div class="dotted-list dotted-white mw-100 mx-auto d-flex justify-content-between mb-2" style="width: 400px;">
                                <div class="pr-2">ค่าจัดส่ง</div>
                                <div class="pl-2 m-0">
                                    <span order="transport_fee" function="number_format"></span> <small>THB</small>
                                </div>
                            </div>

                            <div class="dotted-list dotted-white mw-100 mx-auto d-flex justify-content-between" style="width: 400px;">
                                <div class="mt-auto pr-2">ยอดรวมทั้งสิ้น</div>
                                <div class="pl-2 h4 m-0">
                                    <span order="total" function="number_format" class="font-weight-bold"></span> <small>THB</small>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <section>
                    <header class="section-heading mb-4 heading-line d-flex align-items-center justify-content-between">
                        <h3 class="align-items-center d-flex h5 mb-0 title-section">
                            <span class="icon mr-2"><i class="fas fa-box text-black-50"></i></span>
                            <span>รายการสินค้า</span>
                        </h3>
                    </header>
                    <div id="product-list" class="product-list"></div>
                </section>

                <section order="payment_status" if='{"code": -1}' data-success="คำสั่งซื้อถูกยกเลิก" class="text-center text-danger mt-4 pb-4" style="display: none;">
                    คำสั่งซื้อถูกยกเลิก
                </section>
                <section order="payment_status" if='{"code": 0}' data-success="รอการชำระเงินจากผู้ซื้อ" class="text-center text-info mt-4 pb-4" style="display: none;">
                    รอการชำระเงินจากผู้ซื้อ
                </section>
            </div>
        </div>
    </div>
</div>

<div id="shipment-info-dialog" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title pl-4 ml-auto">รายละเอียดการส่งสินค้า</h5>
                <button class="btn-close" data-dismiss="modal"></button>
            </div>
            <div class="modal-body bg-light">

            </div>
        </div>
    </div>
</div>

<div id="payment-history-dialog" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-header bg-white rounded-pill mx-auto w-100" style="max-width: 720px;">
                <h5 class="modal-title pl-4 ml-auto">ประวัติการโอนเงิน</h5>
                <button class="btn-close" data-dismiss="modal"></button>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>

<div id="shop-payment-dialog" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 700px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title pl-sm-4 ml-auto">จำแนกหัวหน้าสายร้านค้าที่ต้องการโอนเงินให้</h5>
                <button class="btn-close" data-dismiss="modal"></button>
            </div>
            <div class="table-full-width">
                <table id="shop-payment-table" class="table table-hover">
                    <thead>
                        <tr>
                            <th style="vertical-align: top !important; line-height: 1;">หัวหน้าสาย</th>
                            <th style="vertical-align: top !important; line-height: 1;">จำนวนสินค้า<br><small class="font-weight-normal text-black-50">(รายการ)</small></th>
                            <th style="vertical-align: top !important; line-height: 1;">จำนวนเงิน</th>
                            <th style="vertical-align: top !important; line-height: 1;">สถานะ</th>
                            <th style="vertical-align: top !important; line-height: 1;"></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<template id="product-item">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/color.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
    <div class="item bg-white [border] p-2 mb-5 mx-auto shadow" -style="max-width: 900px;">
        <div class="row">
            <div class="col col-xl position-relative">
                <div class="row">
                    <div class="col-auto">
                        <a product-link target="_blank" rel="noopener noreferrer" class="stretched-link" style="display: none;"></a>
                        <img product-image width="100" height="100" class="border" style="object-fit: contain;" />
                    </div>
                    <div class="col">
                        <div product-name class="text-body overflow-hidden" style="max-height: 45px;"></div>
                        <small class="text-muted">
                            <slot shop-name></slot> หมวดหมู่: <slot category-name></slot>
                        </small>
                        <div><span class="badge bg-dark">SKU: <span product-id class="font-weight-bold"></span></span></div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="row m-0">
                    <div class="col-6 col-sm col-lg text-center">
                        จำนวน <div><span amount></span></div>
                    </div>
                    <div class="col-6 col-sm col-lg text-center">
                        ราคารวม
                        <div>
                            <slot total-price></slot> <small class="font-weight-light">THB</small>
                        </div>
                    </div>
                    <div class="col-12 text-center mt-2" style="display: none;">
                        <span shipment-status></span>
                        <button class="btn btn-small btn-link" title="ดูหลักฐานการส่งสินค้า"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="my-2 small">
            <span class="text-black-50">หมายเหตุจากผู้ซื้อ :</span>
            <span optional></span>
        </div>
        <slot name="optional"></slot>
        <product-progress></product-progress>
    </div>
</template>

<template id="product-progress">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/color.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
    <ul class="horizontal-status pt-5 px-0 overflow-hidden flex-column flex-sm-row mb-4">
        <li status="1" class="px-2 px-md-3 py-3 pb-sm-0 w-md-25">
            <div class="rounded-circle position-absolute d-flex" style="top: -15px; left: 50%; z-index: 2; transform: translateX(-50%);">
                <i class="fa-check-circle fa-2x far bg-white" style="color: rgba(0 0 0 / .25);"></i>
            </div>
            <div class="status-line"></div>
            <span class="d-inline-block my-2 mt-sm-3 mb-sm-0 small">ดำเนินการชำระเงิน</span>
        </li>
        <li status="2" class="px-2 px-md-3 py-3 pb-sm-0 w-md-25">
            <div class="rounded-circle position-absolute d-flex" style="top: -15px; left: 50%; z-index: 2; transform: translateX(-50%);">
                <i class="fa-check-circle fa-2x far bg-white" style="color: rgba(0 0 0 / .25);"></i>
            </div>
            <div class="status-line"></div>
            <span class="d-inline-block my-2 mt-sm-3 mb-sm-0 small">เจ้าของพระส่งสินค้า</span>
        </li>
        <li status="3" class="px-2 px-md-3 py-3 pb-sm-0 w-md-25">
            <div class="rounded-circle position-absolute d-flex" style="top: -15px; left: 50%; z-index: 2; transform: translateX(-50%);">
                <i class="fa-check-circle fa-2x far bg-white" style="color: rgba(0 0 0 / .25);"></i>
            </div>
            <div class="status-line"></div>
            <span class="d-inline-block my-2 mt-sm-3 mb-sm-0 small">เจ้าหน้าที่กำลังดำเนินการ</span>
        </li>
        <li status="4" class="px-2 px-md-3 py-3 pb-sm-0 w-md-25">
            <div class="rounded-circle position-absolute d-flex" style="top: -15px; left: 50%; z-index: 2; transform: translateX(-50%);">
                <i class="fa-check-circle fa-2x far bg-white" style="color: rgba(0 0 0 / .25);"></i>
            </div>
            <div class="status-line"></div>
            <span class="d-inline-block my-2 mt-sm-3 mb-sm-0 small">ดำเนินการส่งสินค้าแล้ว</span>
        </li>
    </ul>

    <div class="card card-body bg-light">
        <ul class="vertical-history-flow pr-4 mb-0">
            <li class="text-center text-black-50">ไม่มีความคืบหน้า</li>
        </ul>
    </div>

    <br>
    <!-- <label class="form-label">หมายเหตุเพิ่มเติม</label> -->
    <!-- <div id="optional-box" class="card card-body bg-light"> -->
    <!-- <span order=""> -->
    <!-- <div class="font-weight-bold mb-1">User ID :</div> -->
    <!-- <p style="text-indent: 20px;">Text</p> -->
    <!-- </span> -->
    <!-- <span> -->
    <!-- <h6 class="text-black-50 text-center mb-0 py-2">ไม่มีหมายเหตุ</h6> -->
    <!-- </span> -->
    <!-- </div> -->
</template>

<script>
    'use strict';
    let test;

    const dt = {
        all: null,
        pending: null,
        proceeded: null,
        cancelled: null,
        problem: null,
    };
    let paymentTable;

    const params = new URLSearchParams(location.search);
    const detailDialog = document.getElementById('order-detail-dialog');
    const shipmentInfoDialog = document.getElementById('shipment-info-dialog')
    const paymentHistoryDialog = document.getElementById('payment-history-dialog')
    const paymentProductDialog = document.getElementById('shop-payment-dialog')
    let detailModal;
    let shipmentInfoModal;
    let paymentHistoryModal;
    let shopPaymentModal;

    let currentDetail;

    const fetchOrders = async (target = null) => {
        const options = {
            method: 'POST',
            formData: new FormData()
        };
        options.formData.append('type', 'shipment');
        if (target) {
            options.formData.append('target', target);
        }
        const result = await fetchJson('/Admin/load/orders', options.method, options.formData);
        if (!result) return;

        if (target) {
            dt[target].clear();
            dt[target].rows.add(result);
            dt[target].draw();
        } else {
            for (const key in result) {
                // console.log(key);
                dt[key].clear();
                dt[key].rows.add(result[key]);
                dt[key].draw();
            }
        }
    }

    const dtNewData = async (datatable, data) => {
        datatable.clear();
        datatable.rows.add(data);
        datatable.draw();
    }

    /**
     * Document on ready
     */
    document.addEventListener('DOMContentLoaded', () => {
        detailModal = new bootstrap.Modal(detailDialog);
        shipmentInfoModal = new bootstrap.Modal(shipmentInfoDialog);
        paymentHistoryModal = new bootstrap.Modal(paymentHistoryDialog);
        shopPaymentModal = new bootstrap.Modal(paymentProductDialog);

        fetchOrders();

        $('table tfoot th').each(function(index, el) {
            var title = $(this).text();
            const exceptArr = ['#', 'หมายเหตุ', ''];
            const table = this.dataset.table;
            if (exceptArr.includes(title)) return;
            $(this).html(`<input id="search-${table}-${title.replace(' ','-')}" type="text" class="form-control form-control-sm" placeholder="ค้นหา ${title}" />`);
        });

        for (const key in dt) {
            dt[key] = $(`#table-${key}`).DataTable({
                columns: [{
                        name: 'num',
                        className: 'align-middle'
                    },
                    {
                        name: 'order_id',
                        className: 'align-middle'
                    },
                    {
                        name: 'user_id',
                        className: 'align-middle text-center'
                    },
                    {
                        name: 'fullname',
                        className: 'align-middle'
                    },
                    {
                        name: 'phone',
                        className: 'align-middle'
                    },
                    {
                        name: 'email',
                        className: 'align-middle'
                    },
                    {
                        name: 'timestamp',
                        className: 'align-middle text-center'
                    },
                    {
                        name: 'payment_status',
                        className: 'align-middle text-center'
                    },
                    {
                        name: 'payment_slip',
                        className: 'align-middle text-center py-0'
                    },
                    {
                        name: 'operation',
                        className: 'align-middle text-nowrap',
                        sortable: false
                    },
                ],
                initComplete: function(table) {
                    this.api().columns().every(function() {
                        var that = this;
                        $('input', this.footer()).on('keyup change clear', function() {
                            if (that.search() !== this.value) {
                                that.search(this.value).draw();
                            }
                        });

                        if (params.get('order-id') !== null) {
                            $('#search-all-#-คำสั่งซื้อ').val(params.get('order-id')).keyup();
                        }
                    });
                }
            });
        }

        paymentTable = $('#shop-payment-table').DataTable({
            columns: [{
                    name: 'agent',
                    className: 'text-center align-middle'
                },
                {
                    name: 'count',
                    className: 'text-center align-middle'
                },
                {
                    name: 'amount',
                    className: 'text-center align-middle'
                },
                {
                    name: 'status',
                    className: 'text-center align-middle'
                },
                {
                    name: 'operation',
                    className: 'text-center align-middle',
                    orderable: false,
                    searchable: false,
                },
            ]
        });

        shipmentInfoDialog.addEventListener('hidden.bs.modal', e => currentDetail.click());

    });

    /**
     * Dynamic on click
     */
    document.body.onclick = async e => {
        const target = e.target;

        /**
         * Order Detail Modal
         */
        if (target.closest('[order-detail]')) {
            const detailBtn = target.closest('[order-detail]');
            const orderId = detailBtn.dataset.orderId;
            const productList = document.getElementById('product-list');
            currentDetail = detailBtn;

            const result = await fetchJson(`/Admin/load/order/${orderId}`);
            if (!result) return false;

            const paymentStatusBadge = detailDialog.querySelector('[order="payment_status_badge"]');
            paymentStatusBadge.innerText = result['payment_status']['text']['th'];
            paymentStatusBadge.className = `badge badge-${result['payment_status']['color']}`;

            productList.innerHTML = '';

            // console.log(result);
            result['detail'].forEach((item, index) => {
                const productItem = document.createElement('product-item');
                productItem.setAttribute(`data-order-id`, result['id']);
                for (const productKey in item) {
                    productItem.setAttribute(`data-${productKey}`, JSON.stringify(item[productKey]));
                }
                productList.appendChild(productItem);
            });

            for (const key in result) {
                const orderTarget = detailDialog.querySelector(`[order="${key}"]`);
                if (!orderTarget) continue;

                let content = result[key];
                const func = orderTarget.getAttribute('function');
                const If = orderTarget.getAttribute('if');

                if (func === 'number_format') {
                    content = Intl.NumberFormat('th-TH').format(+content);
                } else if (func === 'count') {
                    content = content.length;
                } else if (func === 'str_pad') {
                    content = content.padStart(6, 0);
                }

                orderTarget.innerText = content;

                if (!If) continue;

                const conditions = JSON.parse(If);
                for (const i in conditions) {
                    if (conditions[i] == result[key][i]) {
                        const ifSuccess = orderTarget.dataset.success;
                        orderTarget.style.display = 'block';
                        orderTarget.innerText = ifSuccess;
                    } else {
                        orderTarget.style.display = 'none';
                    }
                }
            }
        }

        /**
         * Order Approve
         */
        if (target.closest('[payment-approve]')) {
            const paymentApproveBtn = target.closest('[payment-approve]');
            try {
                const orderId = paymentApproveBtn.dataset.orderId;
                const approve = !!+paymentApproveBtn.dataset.approve;

                if (!approve) {
                    const confirm = await swal({
                        title: 'ไม่อนุมัติ',
                        text: `ดำเนินการไม่อนุมัติการชำระเงินของคำสั่งซื้อ\n#${orderId.padStart(6, 0)}\n\nโปรดกดยืนยันเพื่อดำเนินการต่อ`,
                        icon: 'warning',
                        dangerMode: true,
                        buttons: ['ยกเลิก', 'ยืนยัน'],
                    });
                    if (!confirm) return;

                    const formData = new FormData();
                    formData.append('order_id', orderId);
                    formData.append('status', approve);
                    if (paymentSlip) formData.append('slip', paymentSlip);
                    await fadeIn(loader);
                    const result = await fetchJson(`/Admin/action/agent-payment-disapprove`, 'POST', formData);
                    if (!result) return;

                    fetchOrders();
                    return swal('สำเร็จ', `ดำเนินการ${approve ? '' : 'ไม่'}อนุมัติการชำระเงินเรียบร้อย`, 'success');
                }

                shopPaymentModal.show();

                const transferInfo = await fetchJson(`/Admin/load/agent-bank-info/${orderId}`);
                if (!transferInfo) return false;

                dtNewData(paymentTable, transferInfo);
            } catch (e) {
                console.trace(e);
                if (e.ok !== true) {
                    swal(e.title || 'ขออภัย', e.text || 'พบข้อบกพร่องทางเทคนิค โปรดติดต่อผู้ดูแลระบบเพื่อขอความช่วยเหลือ', e.icon || 'error', {
                        buttons: e.buttons || ['แจ้งปัญหา', 'ปิด']
                    });
                }
            } finally {
                fadeOut(loader);
            }
        }

        /**
         * Agent Payment
         */
        if (target.closest('[agent-payment]')) {
            const agentPaymentBtn = target.closest('[agent-payment]');
            try {
                shopPaymentModal.show();

                const orderId = agentPaymentBtn.dataset.orderId;
                const receiver = agentPaymentBtn.dataset.userId;
                const fullname = agentPaymentBtn.dataset.fullname;
                const bankAccount = agentPaymentBtn.dataset.bankAccount;
                const transferAmount = agentPaymentBtn.dataset.transferAmount;

                // const transferInfo = await fetchJson(`/Admin/load/agent-bank-info/${orderId}`);
                // if (!transferInfo) return false;
                // console.log(transferInfo);

                // dtNewData(paymentTable, transferInfo);

                let paymentSlip;
                const swalSlip = async () => {
                    const container = document.createElement('div');
                    const input = document.createElement('input');
                    input.type = 'file';
                    input.accept = 'image/*';
                    input.id = 'payment_slip';
                    input.required = true;
                    input.className = 'form-control'
                    const textContent = document.createElement('div');
                    textContent.innerHTML = 
                        `<div>โอนเงินไปที่บัญชีของ</div>
                        <span class="text-white font-weight-bold d-inline-block mb-4 bg-dark py-1 px-2 rounded-lg mt-2">${receiver}</span>
                        <div class="text-black alert alert-info mb-4">
                            <div>${fullname}</div>
                            ${bankAccount.replace('\n', '<br>')}
                        </div>
                        <h5 class="text-black mb-4">จำนวน <span class="font-weight-bold text-danger">${Intl.NumberFormat('th-TH').format(transferAmount)}</span> บาท</h5>
                        โปรดอัพโหลดสลิปโอนเงินที่ด้านล่างนี้`;
                    textContent.className = 'mb-4';
                    container.appendChild(textContent);
                    container.appendChild(input);
                    const confirm = await swal({
                        title: 'อัพโหลดสลิปโอนเงิน',
                        content: container,
                        icon: 'info',
                        buttons: ['ยกเลิก', 'ยืนยัน']
                    });
                    if (!confirm) return;
                    if (!input.files[0]) return await swal('ไม่พบไฟล์', 'ไม่พบไฟล์สลิปโอนเงิน โปรดตรวจสอบอีกครั้ง', 'error').then(() => swalSlip());
                    return input;
                }
                const slip = await swalSlip();
                if (!slip) return;

                paymentSlip = slip.files[0];
                const imgObject = URL.createObjectURL(paymentSlip);
                const img = document.createElement('img');
                img.src = imgObject;
                img.onload = () => URL.revokeObjectURL(img.src);
                const confirm = await swal({
                    title: 'ตรวจสอบความถูกต้อง',
                    text: 'โปรดตรวจสอบรูปภาพสลิปการโอนเงินที่คุณเลือก หากถูกต้อง โปรดดำเนินการต่อ',
                    icon: img.src,
                    buttons: ['ยกเลิก', 'ดำเนินการต่อ']
                });
                if (!confirm) return;

                const formData = new FormData();
                formData.append('order_id', orderId);
                formData.append('receiver', receiver);
                if (paymentSlip) formData.append('slip', paymentSlip);
                await fadeIn(loader);
                const result = await fetchJson(`/Admin/action/agent-payment-approve`, 'POST', formData);
                if (!result) return;

                fetchOrders();
                
                swal('สำเร็จ', `ดำเนินการอนุมัติการชำระเงินเรียบร้อย`, 'success');

                const transferInfo = await fetchJson(`/Admin/load/agent-bank-info/${orderId}`);
                if (!transferInfo) return false;
                dtNewData(paymentTable, transferInfo);
                
                return true;
            } catch (e) {
                console.trace(e);
                if (e.ok !== true) {
                    swal(e.title || 'ขออภัย', e.text || 'พบข้อบกพร่องทางเทคนิค โปรดติดต่อผู้ดูแลระบบเพื่อขอความช่วยเหลือ', e.icon || 'error', {
                        buttons: e.buttons || {confirm: 'แจ้งปัญหา', cancel: 'ปิด'}
                    }).then(report => report && window.open('/report'));
                }
            } finally {
                fadeOut(loader);
            }

        }

        /**
         * Payment history
         */
        if (target.closest('[payment-history]')) {
            const paymentHistory = target.closest('[payment-history]');
            const orderId = paymentHistory.dataset.orderId;

            const paymentHistoryBody = paymentHistoryDialog.querySelector('.modal-body');
            try {
                paymentHistoryBody.innerHTML = '';
                const result = await fetchJson(`/Admin/load/payment-history/${orderId}`);
                if (!result) return;

                console.log(result);
                const list = document.createElement('div');
                list.className = 'row justify-content-center no-gutters';
                for (const i in result) {
                    const col = document.createElement('div');
                    const item = document.createElement('div');
                    const img = document.createElement('img');
                    const detail = document.createElement('div');
                    col.className = 'col-md-6 col-lg-4 p-2';
                    detail.innerHTML =
                        `<b>ผู้ดำเนินการ:</b> ${result[i].user_id}<br>
                        <b>ผู้รับโอน:</b> ${result[i].receiver}<br>
                        <b>วันที่ดำเนินการ:</b> ${result[i].timestamp}`
                    img.className = 'img-fluid d-block mx-auto mt-3';
                    img.src = `/uploads/slip/${result[i].slip}`;
                    img.dataset.lity = ''
                    img.dataset.lityTarget = img.src;
                    img.style.cursor = 'pointer';
                    img.title = 'คลิกเพื่อดูเต็มจอ';
                    item.className = 'border p-3 h-100 shadow bg-white rounded-lg';
                    item.appendChild(detail);
                    item.appendChild(img);
                    col.appendChild(item);
                    list.appendChild(col);
                }

                paymentHistoryBody.appendChild(list);
                paymentHistoryModal.show();

            } catch (e) {
                console.trace(e);
                if (e.ok !== true) {
                    swal(e.title || 'ขออภัย', e.text || 'พบข้อบกพร่องทางเทคนิค โปรดติดต่อผู้ดูแลระบบเพื่อขอความช่วยเหลือ', e.icon || 'error', {
                        buttons: e.buttons || {
                            confirm: 'แจ้งปัญหา',
                            cancel: 'ปิด'
                        }
                    }).then(contact => contact && window.open('/report'));
                }
            }
        }
    }

    /**
     * Custom elements
     */
    customElements.define('product-item',
        class extends HTMLElement {
            constructor() {
                super();
                let templateContent = document.getElementById('product-item').content;
                this.attachShadow({
                    mode: 'open'
                });
                this.shadowRoot.appendChild(templateContent.cloneNode(true));
            }
            connectedCallback() {
                const data = this.dataset;

                test = data;

                const orderId = data.orderId;

                const productId = JSON.parse(data['product_id']);
                const productName = JSON.parse(data['product_name'])['th'];
                const shopName = JSON.parse(data['shop_name'])['th'];
                const shopUrl = JSON.parse(data['shop_url']);
                const categoryName = JSON.parse(data['category_name'])['th'];
                const amount = +JSON.parse(data['amount']);
                const totalPrice = +JSON.parse(data['price']) * amount;
                const optional = JSON.parse(data['optional'])
                const productImage = JSON.parse(data['product_image'])
                const shipmentStatus = JSON.parse(data['shipment_status'])

                this.shadowRoot.querySelector('[product-id]').innerText = productId;
                this.shadowRoot.querySelector('[product-name]').innerText = productName;
                this.shadowRoot.querySelector('[shop-name]').innerText = shopName;
                this.shadowRoot.querySelector('[category-name]').innerText = categoryName;
                this.shadowRoot.querySelector('[total-price]').innerText = Intl.NumberFormat('th-TH').format(totalPrice);
                this.shadowRoot.querySelector('[amount]').innerText = amount;
                this.shadowRoot.querySelector('[optional]').innerText = optional;

                if (shopUrl) {
                    const link = this.shadowRoot.querySelector('[product-link]')
                    link.href = `/${shopUrl}/product/${productId}`;
                    link.style.display = 'inline';
                }
                if (productImage) {
                    const img = this.shadowRoot.querySelector('[product-image]');
                    img.src = `/uploads/product/${productImage}`;
                    // img.onload = () => console.log('image loaded!!');
                }
                if (shipmentStatus['code'] > 0) {
                    const shipmentStatusDiv = this.shadowRoot.querySelector('[shipment-status]');
                    shipmentStatusDiv.closest('div').style.display = 'block';
                    shipmentStatusDiv.className = `badge bg-${shipmentStatus['color']}`;
                    shipmentStatusDiv.innerText = shipmentStatus['text']['th'];
                    const shipmentInfoBtn = shipmentStatusDiv.nextElementSibling;
                    shipmentInfoBtn.onclick = async e => {
                        e.preventDefault();
                        detailDialog.addEventListener('hidden.bs.modal', e => shipmentInfoModal.show(), {once: true});
                        detailModal.hide();

                        const shipmentInfoBody = shipmentInfoDialog.querySelector('.modal-body')
                        const formData = new FormData();
                        formData.append('order_id', shipmentInfoBtn.dataset.orderId);
                        formData.append('product_id', shipmentInfoBtn.dataset.productId);
                        const result = await fetchJson('/Admin/load/shipment-action', 'POST', formData);
                        if (!result) return false;
                        console.log(result);
                        shipmentInfoBody.innerHTML = `<img src="/uploads/shipment/${result.slip}" class="img-fluid d-block mx-auto">`;
                    }
                    shipmentInfoBtn.setAttribute('shipment-info', '');
                    shipmentInfoBtn.dataset.orderId = orderId;
                    shipmentInfoBtn.dataset.productId = productId;
                }

                const productProgress = this.shadowRoot.querySelector('product-progress');
                productProgress.dataset.progress = data.progress
            }

            disconnectedCallback() {}

            adoptedCallback() {}

            attributeChangedCallback(name, oldValue, newValue) {}

        }
    );

    customElements.define('product-progress',
        class extends HTMLElement {
            constructor() {
                super();
                const template = document.getElementById('product-progress').content;
                this.attachShadow({
                    mode: 'open'
                });
                this.shadowRoot.appendChild(template.cloneNode(true));
            }

            connectedCallback() {
                const progress = JSON.parse(this.dataset.progress);
                const historyFlow = this.shadowRoot.querySelector('.vertical-history-flow');
                this.shadowRoot.querySelectorAll('[status]').forEach(el => {
                    const index = el.getAttribute('status');
                    if (progress[`status${index}`]) el.classList.add('approved');
                });
                if (progress.history.length) {
                    historyFlow.innerHTML = '';
                }
                for (const i in progress.history) {
                    const $history = progress.history[i];
                    const historyLi = document.createElement('li');
                    historyLi.className = i == 0 && 'font-weight-bold';
                    historyLi.innerHTML =
                        `<i class="fas fa-clock position-absolute bg-light rounded-circle p-1" style="left: -29px; z-index: 1;"></i>
                        <div class="small text-muted font-weight-normal" data-datetime>${$history['timestamp']}</div>
                        <span class="${i == 0 && 'font-weight-bold'}">${$history['th_detail']}</span>`;
                    historyFlow.appendChild(historyLi);
                }
            }
        }
    );
</script>