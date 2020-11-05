<main class="content tab-content" id="nav-tabContent">
    <div class="card shadow-sm">
        <div class="card-header border-0 bg-white">
            <a href="#add-news-dialog" class="btn btn-sm btn-outline-secondary" data-toggle="modal"><i class="fas fa-plus mr-2"></i>เพิ่มข่าวสาร</a>
        </div>
        <div class="table-full-width">
            <table id="table-news" class="table table-hover w-100">
                <thead>
                    <tr>
                        <th width="1%">#</th>
                        <th class="text-nowrap bg-white" width="1%"></th>
                        <th class="text-nowrap">หัวข้อ</th>
                        <th class="text-nowrap">วันที่ลง</th>
                        <th class="text-nowrap">สถานะ</th>
                        <th class="text-nowrap"><i class="fas fa-cogs"></i></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</main>

<div id="add-news-dialog" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-fullscreen">
        <form id="add-news-form" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title pl-sm-4 ml-auto">เพิ่มข่าวสาร</h5>
                <button class="btn-close" data-dismiss="modal"></button>
            </div>
            <nav class="pt-2 bg-light">
                <div class="nav nav-tabs justify-content-center" id="nav-tab-add" role="tablist">
                    <a class="nav-item nav-link active" id="nav-add-th-tab" data-toggle="tab" href="#nav-add-th" role="tab" aria-controls="nav-add-th" aria-selected="true">ภาษาไทย</a>
                    <a class="nav-item nav-link" id="nav-add-en-tab" data-toggle="tab" href="#nav-add-en" role="tab" aria-controls="nav-add-en" aria-selected="false">ภาษาอังกฤษ</a>
                    <a class="nav-item nav-link" id="nav-add-cn-tab" data-toggle="tab" href="#nav-add-cn" role="tab" aria-controls="nav-add-cn" aria-selected="false">ภาษาจีน</a>
                </div>
            </nav>
            <div class="modal-body d-flex flex-column" style="overflow-x: hidden;">
                <div class="row">
                    <div class="col-xl-4 col-xxl-3 order-1 order-xl-0 mt-4 mt-xl-0">
                        <h5 class="text-center">รูปภาพ</h5>
                        <div class="add-file mx-auto my-3 row gx-3 border align-items-center bg-white shadow position-relative py-2 mx-0 text-body" style="max-width: 500px;">
                            <div class="col order-1">
                                <label class="form-label">รูปภาพ <small class="text-danger">*</small></label>
                                <div class="form-file form-file-sm">
                                    <input type="file" name="image" class="form-file-input" accept="image/*" onchange="previewImage(this)" required>
                                    <label class="form-file-label" for="slip">
                                        <span class="form-file-text">โปรดเลือกรูปภาพ</span>
                                        <span class="form-file-button">เลือกไฟล์</span>
                                    </label>
                                </div>
                                <small class="text-muted">.JPG, PNG, GIF ขนาดไฟล์ไม่เกิน 500 KB</small>
                            </div>
                            <div class="preview col-auto order-0">
                                <div class="text-center shadow-sm border d-flex justify-content-center align-items-center flex-column" style="height: 114px; width: 114px;">
                                    <div class="example text-center small">ตัวอย่างรูปภาพ</div>
                                    <img class="img-fluid" data-src data-lity data-lity-target title="คลิกเพื่อดูภาพขยาย" style="display: none; height: 114px; width: 114px; object-fit: contain; cursor: pointer; padding: 1px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 col-xxl-9 order-0 order-xl-1">
                        <div class="flex-fill">
                            <div class="tab-content mb-3" id="nav-tabContent">
                                <div class="tab-pane active" id="nav-add-th" role="tabpanel" aria-labelledby="nav-add-th-tab">
                                    <div class="mb-3">
                                        <label for="add-title-th" class="form-label">หัวข้อ <small>(ไทย)</small> <small class="text-danger">*</small></label>
                                        <textarea class="form-control" id="add-title-th" name="th_title" placeholder="ระบุชื่อข่าวสารภาษาไทย" required></textarea>
                                    </div>
                                    <div>
                                        <label for="add-detail-th" class="form-label">รายละเอียดข่าวสาร <small>(ไทย)</small> <small class="text-danger">*</small></label>
                                        <textarea class="form-control ckeditor" id="add-detail-th" name="th_detail" rows="7" placeholder="ระบุรายละเอียดข่าวสารภาษาไทย" required></textarea>
                                    </div>
                                </div>
                                <div class="tab-pane" id="nav-add-en" role="tabpanel" aria-labelledby="nav-add-en-tab">
                                    <div class="mb-3">
                                        <label for="add-title-en" class="form-label">Title <small>(อังกฤษ)</small></label>
                                        <textarea class="form-control" id="add-title-en" name="en_title" placeholder="ระบุชื่อข่าวสารภาษาอังกฤษ"></textarea>
                                    </div>
                                    <div>
                                        <label for="add-title-en" class="form-label">Product detail <small>(อังกฤษ)</small></label>
                                        <textarea class="form-control ckeditor" id="add-detail-en" name="en_detail" rows="7" placeholder="ระบุรายละเอียดข่าวสารภาษาอังกฤษ"></textarea>
                                    </div>
                                </div>
                                <div class="tab-pane" id="nav-add-cn" role="tabpanel" aria-labelledby="nav-add-cn-tab">
                                    <div class="mb-3">
                                        <label for="add-title-cn" class="form-label">标题 <small>(จีน)</small></label>
                                        <textarea class="form-control" id="add-title-cn" name="cn_title" placeholder="ระบุชื่อข่าวสารภาษาจีน"></textarea>
                                    </div>
                                    <div>
                                        <label for="add-title-cn" class="form-label">新闻详情 <small>(จีน)</small></label>
                                        <textarea class="form-control ckeditor" id="add-detail-cn" name="cn_detail" rows="7" placeholder="ระบุรายละเอียดข่าวสารภาษาจีน"></textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <div>
                                <div class="form-label">สถานะ</div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="status" value="0" id="add-status-0">
                                    <label for="add-status-0" class="form-check-label">ไม่แสดง</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="status" value="1" id="add-status-1" checked>
                                    <label for="add-status-1" class="form-check-label">แสดง</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="reset" onclick="bootstrap.Modal.getInstance(this.closest('.modal')).hide()"><i class="fas fa-times mr-2"></i>ยกเลิก</button>
                <button class="btn btn-success" type="submit"><i class="fas fa-save mr-2"></i>บันทึก</button>
            </div>
        </form>
    </div>
</div>

<div id="edit-news-dialog" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-fullscreen">
        <form id="edit-news-form" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title pl-sm-4 ml-auto">แก้ไขข่าวสาร</h5>
                <button class="btn-close" data-dismiss="modal"></button>
            </div>
            <nav class="pt-2 bg-light">
                <div class="nav nav-tabs justify-content-center" id="nav-tab-edit" role="tablist">
                    <a class="nav-item nav-link active" id="nav-edit-th-tab" data-toggle="tab" href="#nav-edit-th" role="tab" aria-controls="nav-edit-th" aria-selected="true">ภาษาไทย</a>
                    <a class="nav-item nav-link" id="nav-edit-en-tab" data-toggle="tab" href="#nav-edit-en" role="tab" aria-controls="nav-edit-en" aria-selected="false">ภาษาอังกฤษ</a>
                    <a class="nav-item nav-link" id="nav-edit-cn-tab" data-toggle="tab" href="#nav-edit-cn" role="tab" aria-controls="nav-edit-cn" aria-selected="false">ภาษาจีน</a>
                </div>
            </nav>
            <div class="modal-body d-flex flex-column" style="overflow-x: hidden;">
                <div class="row">
                    <div class="col-xl-4 col-xxl-3 order-1 order-xl-0 mt-4 mt-xl-0">
                        <h5 class="text-center">รูปภาพ</h5>
                        <div class="add-file mx-auto my-3 row gx-3 border align-items-center bg-white shadow position-relative py-2 mx-0 text-body" style="max-width: 500px;">
                            <div class="col order-1">
                                <label class="form-label">รูปภาพ <small class="text-danger">*</small></label>
                                <div class="form-file form-file-sm">
                                    <input type="file" name="image" class="form-file-input" accept="image/*" onchange="previewImage(this)" required>
                                    <label class="form-file-label" for="slip">
                                        <span class="form-file-text">โปรดเลือกรูปภาพ</span>
                                        <span class="form-file-button">เลือกไฟล์</span>
                                    </label>
                                </div>
                                <small class="text-muted">.JPG, PNG, GIF ขนาดไฟล์ไม่เกิน 500 KB</small>
                            </div>
                            <div class="preview col-auto order-0">
                                <div class="text-center shadow-sm border d-flex justify-content-center align-items-center flex-column" style="height: 114px; width: 114px;">
                                    <div class="example text-center small">ตัวอย่างรูปภาพ</div>
                                    <img class="img-fluid" data-src data-lity data-lity-target title="คลิกเพื่อดูภาพขยาย" style="display: none; height: 114px; width: 114px; object-fit: contain; cursor: pointer; padding: 1px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 col-xxl-9 order-0 order-xl-1">
                        <div class="flex-fill">
                            <div class="tab-content mb-3" id="nav-tabContent">
                                <div class="tab-pane active" id="nav-edit-th" role="tabpanel" aria-labelledby="nav-edit-th-tab">
                                    <div class="mb-3">
                                        <label for="edit-title-th" class="form-label">หัวข้อ <small>(ไทย)</small> <small class="text-danger">*</small></label>
                                        <textarea class="form-control" id="edit-title-th" name="th_title" placeholder="ระบุชื่อข่าวสารภาษาไทย" required></textarea>
                                    </div>
                                    <div>
                                        <label for="edit-detail-th" class="form-label">รายละเอียดข่าวสาร <small>(ไทย)</small> <small class="text-danger">*</small></label>
                                        <textarea class="form-control ckeditor" id="edit-detail-th" name="th_detail" rows="7" placeholder="ระบุรายละเอียดข่าวสารภาษาไทย" required></textarea>
                                    </div>
                                </div>
                                <div class="tab-pane" id="nav-edit-en" role="tabpanel" aria-labelledby="nav-edit-en-tab">
                                    <div class="mb-3">
                                        <label for="edit-title-en" class="form-label">Title <small>(อังกฤษ)</small></label>
                                        <textarea class="form-control" id="edit-title-en" name="en_title" placeholder="ระบุชื่อข่าวสารภาษาอังกฤษ"></textarea>
                                    </div>
                                    <div>
                                        <label for="edit-title-en" class="form-label">Product detail <small>(อังกฤษ)</small></label>
                                        <textarea class="form-control ckeditor" id="edit-detail-en" name="en_detail" rows="7" placeholder="ระบุรายละเอียดข่าวสารภาษาอังกฤษ"></textarea>
                                    </div>
                                </div>
                                <div class="tab-pane" id="nav-edit-cn" role="tabpanel" aria-labelledby="nav-edit-cn-tab">
                                    <div class="mb-3">
                                        <label for="edit-title-cn" class="form-label">标题 <small>(จีน)</small></label>
                                        <textarea class="form-control" id="edit-title-cn" name="cn_title" placeholder="ระบุชื่อข่าวสารภาษาจีน"></textarea>
                                    </div>
                                    <div>
                                        <label for="edit-title-cn" class="form-label">新闻详情 <small>(จีน)</small></label>
                                        <textarea class="form-control ckeditor" id="edit-detail-cn" name="cn_detail" rows="7" placeholder="ระบุรายละเอียดข่าวสารภาษาจีน"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="form-label">สถานะ</div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="status" value="0" id="edit-status-0">
                                    <label for="edit-status-0" class="form-check-label">ไม่แสดง</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="status" value="1" id="edit-status-1">
                                    <label for="edit-status-1" class="form-check-label">แสดง</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="reset" onclick="bootstrap.Modal.getInstance(this.closest('.modal')).hide()"><i class="fas fa-times mr-2"></i>ยกเลิก</button>
                <button class="btn btn-success" type="submit"><i class="fas fa-save mr-2"></i>บันทึก</button>
            </div>
        </form>
    </div>
</div>

<script>
    let dt;
    let test;

    const addForm = document.forms['add-news-form'];
    const editForm = document.forms['edit-news-form'];

    const fetchData = async (id = null) => {
        const url = id ? `/Admin/load/news/${id}` : '/Admin/load/news';
        const result = await fetchJson(url);
        if (!result) return;

        if (id) {
            return result;
        } else {
            drawNewData(dt, result);
        }
    }

    const drawNewData = async (datatable, data) => {
        datatable.clear();
        datatable.rows.add(data);
        datatable.draw();
    }

    window.previewImage = target => {
        const container = target.closest('.add-file');
        const image = container.querySelector('img');
        const exampleDiv = container.querySelector('.example');
        const label = container.querySelector('.form-file-text');

        const file = target.files[0];

        if (!file) {
            label.innerText = 'โปรดเลือกรูปภาพ';
            image.src = image.dataset.src || '';
            image.style.display = image.dataset.src ? 'block' : 'none';
            exampleDiv.style.display = image.dataset.src ? 'none' : 'block';
            return;
        }

        const createdImg = URL.createObjectURL(file);
        image.src = createdImg;
        label.innerText = file.name;
        image.onload = () => {
            // URL.revokeObjectURL(image.src);
            image.style.display = 'block';
            exampleDiv.style.display = 'none';
        }
    }

    document.addEventListener('DOMContentLoaded', async () => {
        const editors = await createEditor();
        test = editors;

        dt = $('table').DataTable({
            order: [
                [0, 'desc']
            ],
            columns: [{
                    name: 'num',
                    className: 'align-middle ',
                    searchable: false
                },
                {
                    name: 'image',
                    className: 'align-middle p-0 bg-light text-center',
                    searchable: false,
                    orderable: false
                },
                {
                    name: 'title',
                    className: 'align-middle ',
                },
                {
                    name: 'timestamp',
                    className: 'align-middle ',
                },
                {
                    name: 'status',
                    className: 'align-middle ',
                },
                {
                    name: 'operation',
                    className: 'align-middle '
                }
            ],
        });

        fetchData();

        document.body.addEventListener('click', async e => {
            /**
             * ปุ่มแก้ไข
             */
            if (e.target.closest('[edit-news]')) {
                const target = e.target.closest('[edit-news]');
                const id = target.dataset.id;
                
                const data = await fetchData(id);
                
                if (data.image) {
                    const img = editForm.querySelector('img');
                    img.src = `/uploads/news/${data.image}`;
                    img.dataset.src = img.src;
                    img.dataset.lityTarget = img.src;
                    img.style.display = 'block';
                    img.previousElementSibling.style.display = 'none';
                }

                editForm.elements['th_title'].value = data.th_title;
                editForm.elements['en_title'].value = data.en_title;
                editForm.elements['cn_title'].value = data.cn_title;
                editForm.elements[`edit-status-${data.status}`].checked = true;
                editForm.elements[`edit-status-${+!+data.status}`].checked = false;

                editors[3].setData(data.th_detail);
                editors[4].setData(data.en_detail);
                editors[5].setData(data.cn_detail);

            }

            /**
             * ปุ่มลบ
             */
            if (e.target.closest('[remove-news]')) {
                const target = e.target.closest('[remove-news]');
                const id = target.dataset.id;
                alert(id);
            }
        })
    });
</script>