<?php

use App\Core\Util; ?>

<!-- <nav class="navbar px-xl-0 sticky-top" id="nav">
    <ul class="main-nav nav nav-tabs" id="settingsTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a aria-controls="tab-site" class="nav-link" data-scroll-ignore="" data-toggle="tab" href="#tab-site" role="tab" aria-selected="false">Site</a>
        </li>
        <li class="nav-item" role="presentation">
            <a aria-controls="tab-learning-content" class="nav-link active" data-scroll-ignore="" data-toggle="tab" href="#tab-learning-content" role="tab" aria-selected="true">Learning content</a>
        </li>
        <li class="nav-item" role="presentation">
            <a aria-controls="tab-orders-accounts" class="nav-link" data-scroll-ignore="" data-toggle="tab" href="#tab-orders-accounts" role="tab">Orders &amp; accounts</a>
        </li>
        <li class="nav-item" role="presentation">
            <a aria-controls="tab-code-analytics" class="nav-link" data-scroll-ignore="" data-toggle="tab" href="#tab-code-analytics" role="tab">Code &amp; analytics</a>
        </li>
    </ul>
</nav> -->
<main class="content">
    <div class="card shadow-sm">
        <div class="card-header border-0 bg-white">
            <a href="#Add" class="btn btn-sm btn-outline-secondary" data-toggle="modal">
                <i class="fas fa-plus mr-2"></i>เพิ่มผู้ใช้งาน
            </a>
        </div>
        <div class="table-full-width">
            <table class="table auto-datatable table-hover [nowrap] table-striped w-100 text-nowrap">
                <thead>
                    <tr>
                        <th width=1%>#</th>
                        <th class="text-nowrap">ภาษาไทย</th>
                        <th>ภาษาอังกฤษ</th>
                        <th>ภาษาจีน</th>
                        <th>สถานะ</th>
                        <th class="text-center"><i class="fas fa-cogs"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($category) :
                        foreach ($category as $i => $item) :
                    ?>
                            <tr>
                                <td class="align-middle"><?= ++$i ?></td>
                                <td class="align-middle"><?= $item['th_name'] ?></td>
                                <td class="align-middle"><?= $item['en_name'] ?></td>
                                <td class="align-middle"><?= $item['cn_name'] ?></td>
                                <td class="align-middle">
                                    <a href='#' title="คลิกเพื่อปรับสถานะ" class="badge text-decoration-none link-light bg-<?= (bool) $item['status'] ? 'success' : 'danger' ?>" data-toggle-status data-user-id="" data-status="<?= '' ?>"><?= (bool) $item['status'] ? 'เปิดใช้งาน' : 'ไม่ใช้งาน' ?></a>
                                </td>
                                <td class="align-middle text-center">
                                    <div class="btn-group">
                                        <button data-toggle="modal" onclick="fetchItem(<?= $item['id'] ?>)" data-target="#Edit" class="btn btn-icon-only btn-warning" title="แก้ไข"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-icon-only btn-danger" title="ลบ"><i class="fas fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                    <?php
                        endforeach;
                    endif;
                    ?>
                </tbody>
            </table>

        </div>
    </div>
</main>

<div class="modal fade" id="Add" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <form id="add-user-form" method="post" enctype="multipart/form-data" class="modal-content">
            <div class="modal-header">
                <h4 class="mb-0">เพิ่มสมาชิก</h4>
                <button class="btn-close" data-dismiss="modal" type="button"></button>
            </div>
            <div class="modal-body overflow-hidden">
                <div class="row my-n3 py-3 bg-light">
                    <div class="col-md-6 form-group">
                        <label>ชื่อสมาชิก <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="username" required="required" placeholder="Username">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>รหัสผ่าน <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="password" id="add-password" class="form-control" name="password" required="required" placeholder="Password">
                            <div class="input-group-append">
                                <button class="btn-secondary btn" type="button" onclick="$(this).find('i.fas').toggleClass('fa-eye fa-eye-slash').closest('.input-group').find('input').attr('type', function(index, attr) {return attr == 'password' ? 'text' : 'password'})"><i class="fas fa-eye"></i></button>
                                <button class="btn btn-dark" type="button" onclick="$('#add-password').val(Math.random().toString(36).slice(-8));"><i class="fas fa-sync-alt"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="mx-n4">
                <div class="row">
                    <div class="col-md col-lg-6 form-group">
                        <label>ชื่อจริง</label>
                        <input type="text" class="form-control" name="firstname" placeholder="First name">
                    </div>
                    <div class="col-md col-lg-6 form-group">
                        <label>นามสกุล</label>
                        <input type="text" class="form-control" name="lastname" placeholder="Last name">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Line ID</label>
                        <input type="text" class="form-control" name="line" placeholder="Line ID">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>เบอร์โทรศัพท์</label>
                        <input type="tel" class="form-control" name="phone" placeholder="091XXXXXXX">
                    </div>
                    <div class="col-md-12 form-group">
                        <label class="d-block">สถานะบัญชี</label>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="status_0" name="status" value="0" class="custom-control-input">
                            <label class="custom-control-label" for="status_0">ปิดใช้งาน</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="status_1" name="status" value="1" class="custom-control-input">
                            <label class="custom-control-label" for="status_1">รอโอนเงิน</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="status_2" name="status" value="2" class="custom-control-input">
                            <label class="custom-control-label" for="status_2">รอส่งมอบบัญชี</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="status_3" name="status" value="3" class="custom-control-input" checked>
                            <label class="custom-control-label" for="status_3">เปิดใช้งาน</label>
                        </div>
                    </div>
                    <!-- <div class="col-md-6 form-group">
                            <label class="d-block">ประเภทบัญชี</label>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="position_1" name="position" value="user" class="custom-control-input" checked>
                                <label class="custom-control-label" for="position_1">ลูกค้า</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="position_0" name="position" value="employee" class="custom-control-input">
                                <label class="custom-control-label" for="position_0">พนักงาน</label>
                            </div>
                        </div> -->
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger btn-sm" type="reset"><i class="fas fa-times text-white-50 mr-2"></i> ยกเลิก</button>
                <button class="btn btn-success btn-sm" type="submit"><i class="fas fa-save text-white-50 mr-2"></i> บันทึก</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="Edit" tabindex="-1">
    <div class="modal-dialog modal-lg modal-fullscreen-md-down modal-dialog-centered">
        <form id="edit-form" method="post" enctype="multipart/form-data" class="modal-content">
            <div class="modal-header">
                <h4 class="mb-0">แก้ไขข้อมูลสมาชิก</h4>
                <button class="btn-close" data-dismiss="modal" type="button"></button>
            </div>
            <div class="modal-body overflow-hidden">
                <div class="row">
                    <div class="col-md col-lg-6 form-group">
                        <label>ชื่อจริง</label>
                        <input type="text" class="form-control" id="edit-firstname" name="firstname" placeholder="First name">
                    </div>
                    <div class="col-md col-lg-6 form-group">
                        <label>นามสกุล</label>
                        <input type="text" class="form-control" id="edit-lastname" name="lastname" placeholder="Last name">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Line ID</label>
                        <input type="text" class="form-control" name="line" placeholder="Line ID">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>เบอร์โทรศัพท์</label>
                        <input type="tel" class="form-control" name="phone" placeholder="091XXXXXXX">
                    </div>
                    <div class="col-md-12 form-group">
                        <label class="d-block">สถานะบัญชี</label>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="edit-status-0" name="status" value="0" class="custom-control-input">
                            <label class="custom-control-label" for="edit-status-0">ปิดใช้งาน</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="edit-status-1" name="status" value="1" class="custom-control-input">
                            <label class="custom-control-label" for="edit-status-1">เปิดใช้งาน</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger btn-sm" type="reset"><i class="fas fa-times text-white-50 mr-2"></i> ยกเลิก</button>
                <button class="btn btn-success btn-sm" type="submit"><i class="fas fa-save text-white-50 mr-2"></i> บันทึก</button>
            </div>
        </form>
    </div>
</div>

<script>
    const fetchItem = async id => {
        const editForm = document.forms['edit-form'];

        const formData = new FormData();
        formData.append('id', id);

        const fetched = await fetch(`load/user/${id}`);
        if (!fetched.ok) return swal('ขออภัย', 'พบข้อบกพร่องทางเทคนิค โปรดติดต่อผู้ดูแลระบบ', 'error');

        const data = await fetched.json();
        if (!data.success) return swal('ขออภัย', data.text, 'error') && console.error(data.log);

        const user = data.data;
        for (const el of editForm.elements) {
            if (el.name === 'password') continue;
            el.value = user[el.name] || '';
        }
        editForm.elements[`edit-status-${user['status']}`].checked = true;
    }

    document.body.onclick = async e => {
        const target = e.target;
        if (target.dataset.toggleStatus !== undefined) {
            e.preventDefault();
            const currentStat = +target.dataset.status;
            const userId = target.dataset.userId;
            const select = document.createElement('select');
            const option0 = document.createElement('option');
            const option1 = document.createElement('option');
            const option9 = document.createElement('option');

            select.setAttribute('id', 'status-select');
            select.classList.add('form-select', 'text-center');
            select.style.textAlignLast = 'center';

            option0.innerText = 'ปิดใช้งาน';
            option0.value = 0;
            option0.selected = currentStat === 0 ? true : false;
            option1.innerText = 'เปิดใช้งาน';
            option1.value = 1;
            option1.selected = currentStat === 1 ? true : false; // option1.disabled = currentStat >= 1 ? true : false;
            option9.innerText = 'แบน';
            option9.value = 9;
            option9.selected = currentStat === 9 ? true : false; // option9.disabled = currentStat >= 9 ? true : false;

            select.appendChild(option0);
            select.appendChild(option1);
            // select.appendChild(option9);

            const confirm = await swal({
                title: 'ปรับสถานะ',
                content: select,
                icon: 'info',
                buttons: ['ยกเลิก', 'ยืนยัน']
            });

            if (!confirm) return;

            const formData = new FormData();
            formData.append('status', select.value);
            formData.append('uid', userId)
            const fetched = await fetch('/Admin/action/ToggleStatus', {
                method: 'POST',
                body: formData
            });
            if (!fetched.ok) return swal('ขออภัย', 'พบข้อบกพร่องทางเทคนิค โปรดติดต่อผู้ดูแลระบบ', 'error');

            const data = await fetched.json();
            if (!data.success) return swal('ขออภัย', data.text, 'error') && console.error(data.log);

            return swal('สำเร็จ', 'แก้ไขสถานะเรียบร้อย', 'success');

        }
    }
</script>