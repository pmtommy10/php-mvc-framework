<?php

use App\Core\Util; ?>

<style>
    #title-bar {
        display: none !important;
    }
</style>

<div class="header-container">
    <div class="header-image">
        <div class="header-content">
            <h3 class="display-4">ยินดีต้อนรับ</h3>
            <h3 class="font-weight-light mb-4 h2"><?= $_SESSION['admin']['user_id'] ?></h3>
            <p class="font-weight-light mt-2">ระบบบริหารจัดการคำสั่งซื้อเว็บไซต์</p>
        </div>
    </div>
</div>

<main class="content" style="margin-top: -130px;">
    <div class="row g-4 mb-5">
        <div class="col-sm-6 col-xxl-3 d-flex">
            <div class="card rounded-0 shadow-sm w-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <p class="text-right px-3 mb-1 small">รายการชำระเงินที่ยังไม่ดำเนินการ</p>
                    <div class="row align-items-center mx-0 flex-nowrap py-2 flex-fill">
                        <div class="col-auto pr-md-0"><i class="drop-shadow fas fa-2x fa-money-bill-wave text-success"></i></div>
                        <div class="col pl-md-0">
                            <h4 class="text-right mb-0 drop-shadow font-weight-normal"><?= number_format($pendingPaymentCount) ?></h4>
                            <div class="text-muted text-right small">รายการ</div>
                        </div>
                    </div>
                    <div class="small text-right px-3 text-muted mt-2">
                        <!-- <span class="text-<?php echo 0 > 0 ? 'success' : (0 === 0 ? 'secondary' : 'danger'); ?> font-weight-bold mr-1">
                            <i class="fas <?php echo 0 > 0 ? 'fa-arrow-up' : (0 === 0 ? 'fa-grip-lines' : 'fa-arrow-down'); ?> mr-2"></i><?php echo number_format(0, 2); ?><span>%</span>
                        </span>
                        <span>จากเมื่อวาน</span> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xxl-3 d-flex">
            <div class="card rounded-0 shadow-sm w-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <p class="text-right px-3 mb-1 small">รายการส่งสินค้าที่ยังไม่ดำเนินการ</p>
                    <div class="row align-items-center mx-0 flex-nowrap py-2 flex-fill">
                        <div class="col-auto pr-md-0"><i class="drop-shadow fas fa-2x fa-list text-primary"></i></div>
                        <div class="col pl-md-0">
                            <h4 class="text-right mb-0 drop-shadow font-weight-normal"><?php echo number_format($pendingShipmentCount); ?></h4>
                            <div class="text-muted text-right small">ครั้ง</div>
                        </div>
                    </div>
                    <div class="small text-right px-3 text-muted mt-2">
                        <span class="text-<?php echo 0 > 0 ? 'success' : (0 === 0 ? 'secondary' : 'danger'); ?> font-weight-bold mr-1">
                            <i class="fas <?php echo 0 > 0 ? 'fa-arrow-up' : (0 === 0 ? 'fa-grip-lines' : 'fa-arrow-down'); ?> mr-2"></i><?php echo number_format(0, 2); ?><span>%</span>
                        </span>
                        <span>จากสัปดาห์ที่แล้ว</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xxl-3 d-flex">
            <div class="card rounded-0 shadow-sm w-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <p class="text-right px-3 mb-1 small">จำนวนผู้เข้าชมเดือนนี้</p>
                    <div class="row align-items-center mx-0 flex-nowrap py-2 flex-fill">
                        <div class="col-auto pr-md-0"><i class="drop-shadow fas fa-2x fa-list text-danger"></i></div>
                        <div class="col pl-md-0">
                            <h4 class="text-right mb-0 drop-shadow font-weight-normal"><?php echo number_format(0); ?></h4>
                            <div class="text-muted text-right small">ครั้ง</div>
                        </div>
                    </div>
                    <div class="small text-right px-3 text-muted mt-2">
                        <span class="text-<?php echo 0 > 0 ? 'success' : (0 === 0 ? 'secondary' : 'danger'); ?> font-weight-bold mr-1">
                            <i class="fas <?php echo 0 > 0 ? 'fa-arrow-up' : (0 === 0 ? 'fa-grip-lines' : 'fa-arrow-down'); ?> mr-2"></i><?php echo number_format(0, 2); ?><span>%</span>
                        </span>
                        <span>จากเดือนที่แล้ว</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xxl-3 d-flex">
            <div class="card rounded-0 shadow-sm w-100">
                <div class="card-body d-flex flex-column justify-content-start">
                    <p class="text-right px-3 mb-1 small">จำนวนผู้เข้าชมรวมทั้งหมด</p>
                    <div class="row align-items-center mx-0 flex-nowrap py-2 flex-fill">
                        <div class="col-auto pr-md-0"><i class="drop-shadow fas fa-2x fa-history text-success"></i></div>
                        <div class="col pl-md-0">
                            <h4 class="text-right mb-0 drop-shadow font-weight-normal"><?= number_format(0) ?></h4>
                            <div class="text-muted text-right small">ครั้ง</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row g-4 justify-content-center">
        <div class="col-12">
            <div class="card">
                <h5 class="card-header bg-white border-0">รายการชำระเงินที่ยังไม่ดำเนินการ</h5>
                <div class="table-full-width">
                    <table id="table-pending" class="table table-hover text-nowrap">
                        <thead>
                            <tr role="row">
                                <th width="1%" class="align-middle text-center">#</th>
                                <th width="1%" class="align-middle text-center"># คำสั่งซื้อ</th>
                                <th class="align-middle text-center">User ID</th>
                                <th class="align-middle">ชื่อ - สกุล</th>
                                <th class="align-middle">เบอร์โทรศัพท์</th>
                                <th class="align-middle text-center">อีเมล</th>
                                <th class="align-middle text-center">วันที่สั่งซื้อ</th>
                                <th class="align-middle text-center">สถานะ</th>
                                <th class="align-middle text-center">สลิปชำระเงิน</th>
                                <!-- <th class="text-center align-middle text-nowrap" ass="fas fa-cogs"></i></th> -->
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr role="row">
                                <th data-table="pending" width="1%" class="align-middle text-center">#</th>
                                <th data-table="pending" width="1%" class="align-middle text-center"># คำสั่งซื้อ</th>
                                <th data-table="pending" class="align-middle text-center">User ID</th>
                                <th data-table="pending" class="align-middle">ชื่อ - สกุล</th>
                                <th data-table="pending" class="align-middle">เบอร์โทรศัพท์</th>
                                <th data-table="pending" class="align-middle text-center">อีเมล</th>
                                <th data-table="pending" class="align-middle text-center">วันที่สั่งซื้อ</th>
                                <th data-table="pending" class="align-middle text-center">สถานะ</th>
                                <th data-table="pending" class="align-middle text-center">สลิปชำระเงิน</th>
                                <!-- <th data-table="pending" class="text-center align-middle text-nowrap" ass="fas fa-cogs"></i></th> -->
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <h5 class="card-header bg-white border-0">วิธีการจัดส่งสินค้า</h5>
                <div class="table-full-width">
                    <table id="transport-table" class="table table-hover text-nowrap">
                        <thead>
                            <tr role="row">
                                <th>วิธีการจัดส่ง</th>
                                <th>ราคา</th>
                                <th><i class="fas fa-cog"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</main> <!-- .content -->

<script>
    let dt;

    const fetchOrders = async (target = null) => {
        const options = {
            method: 'GET',
            formData: null
        };
        if (target) {
            options.method = 'POST';
            options.formData = new FormData();
            options.formData.append('target', target);
        }
        const result = await fetchJson('/Admin/load/orders', options.method, options.formData);
        if (!result) return;

        dt.clear();
        dt.rows.add(result);
        dt.draw();

    }

    document.addEventListener('DOMContentLoaded', () => {

        fetchOrders('pending');

        $('table tfoot th').each(function(index, el) {
            var title = $(this).text();
            const exceptArr = ['#', 'หมายเหตุ', ''];
            const table = this.dataset.table;
            if (exceptArr.includes(title)) return;
            $(this).html(`<input id="search-${table}-${title.replace(' ','-')}" type="text" class="form-control form-control-sm" placeholder="ค้นหา ${title}" />`);
        });

        dt = $(`#table-pending`).DataTable({
            // responsive: true,
            columns: [
                { name: 'num', className: 'align-middle' },
                { name: 'order_id', className: 'align-middle' },
                { name: 'user_id', className: 'align-middle text-center' },
                { name: 'fullname', className: 'align-middle' },
                { name: 'phone', className: 'align-middle' },
                { name: 'email', className: 'align-middle' },
                { name: 'timestamp', className: 'align-middle text-center' },
                { name: 'payment_status', className: 'align-middle text-center' },
                { name: 'payment_slip', className: 'align-middle text-center py-0' },
            ],
            initComplete: function(table) {
                this.api().columns().every(function() {
                    var that = this;
                    $('input', this.footer()).on('keyup change clear', function() {
                        if (that.search() !== this.value) {
                            that.search(this.value)
                                .draw();
                        }
                    });
                });
            }
        });
    });
</script>