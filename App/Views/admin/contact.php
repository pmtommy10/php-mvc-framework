<style>
    table.dataTable tbody td.select-checkbox,
    table.dataTable tbody th.select-checkbox {
        cursor: pointer;
    }

    table.dataTable tbody td.select-checkbox:before,
    table.dataTable tbody th.select-checkbox:before {
        margin-left: 0;
    }

    table.dataTable tr.selected td.select-checkbox:after,
    table.dataTable tr.selected th.select-checkbox:after {
        top: auto;
        margin-top: 0;
    }
</style>
<nav class="navbar px-xl-0 sticky-top" id="nav">
    <ul class="main-nav nav nav-tabs scrollbar-macosx" id="settingsTabs" role="tablist">
        <?php foreach ($tables as $key => $table) : ?>
            <li class="nav-item" role="presentation">
                <a aria-controls="tab-<?= $table['id'] ?>" class="nav-link <?= array_key_first($tables) === $key ? 'active' : '' ?>" data-toggle="tab" href="#tab-<?= $table['id'] ?>" role="tab" aria-selected="true"><?= $table['text'] ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>
<main class="content tab-content" id="nav-tabContent">
    <?php foreach ($tables as $key => $table) : ?>
        <div class="tab-pane <?= array_key_first($tables) === $key ? 'active show' : '' ?>" id="tab-<?= $table['id'] ?>">
            <div class="card shadow-sm">
                <div class="card-header border-0 bg-white">
                    <h5 class="mb-0"><i class="fas fa-mail-bulk mr-2" style="color: rgba(0,0,0,0.35);"></i>ข้อความทั้งหมด</h5>
                </div>
                <div class="table-full-width">
                    <table id="table-<?= $table['id'] ?>" class="table table-hover w-100">
                        <thead>
                            <tr>
                                <th width="1%" class="no-sort" data-orderable="false"><i class="fas fa-search"></i></th>
                                <th width="1%" class="text-nowrap no-sort" data-orderable="false"><i class="fas fa-check-square"></th>
                                <th width="1%">#</th>
                                <th class="text-nowrap">ชื่อ - สกุล</th>
                                <th class="text-nowrap">เบอร์โทร</th>
                                <th class="text-nowrap">อีเมล</th>
                                <th class="text-nowrap">ติดต่อเรื่อง</th>
                                <th class="text-nowrap">วัน/เวลา</th>
                                <th class="none">ข้อความ</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</main>

<div class="modal fade" id="contact-detail" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="mb-0">ข้อมูลติดต่อ</h4>
                <button class="close" data-dismiss="modal" type="button">&times;</button>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>

<script>
    'use strict';

    const dt = {
        all: null,
        unread: null,
        read: null,
    };

    const fetchData = async (target = null) => {
        const options = {
            method: 'GET',
            formData: null
        };
        if (target) {
            options.method = 'POST';
            options.formData = new FormData();
            options.formData.append('target', target);
        }
        const result = await fetchJson('/Admin/load/contacts', options.method, options.formData);
        if (!result) return;

        if (target) {
            drawNewData(dt[target], result[target]);
        } else {
            for (const key in result) {
                drawNewData(dt[key], result[key]);
            }
        }
    }

    const drawNewData = async (datatable, data) => {
        datatable.clear();
        datatable.rows.add(data);
        datatable.draw();
    }

    document.addEventListener('DOMContentLoaded', () => {

        for (const key in dt) {
            const table = dt[key];

            dt[key] = $(`#table-${key}`).DataTable({
                responsive: true,
                columns: [{
                        name: 'detail',
                        orderable: false,
                        searchable: false,
                        className: 'text-center w-0 details-control',
                    },
                    {
                        name: 'select',
                        orderable: false, 
                        searchable: false,
                        className: 'text-center w-0 select-checkbox',
                    },
                    {
                        name: 'number',
                        orderable: false,
                        searchable: false,
                        className: 'text-center w-0',
                        render: (data, type, rowData, config) => config.row + 1
                    },
                    { name: 'fullname', className: '', },
                    { name: 'phone', className: 'text-center', },
                    { name: 'email', className: '', },
                    { name: 'subject-type', className: 'text-center', },
                    { name: 'timestamp', className: 'text-center', },
                    { name: 'message', className: '', },
                ],
                createdRow: (row, data, dataIndex) => {
                    row.dataset.id = data[10];
                    row.dataset.status = data[9];
                    row.dataset.table = key
                    if (+data[9] === 0) {
                        row.classList.add('font-weight-bold');
                    }
                },
                order: [
                    [2, 'asc']
                ],
                select: {
                    style: 'multi',
                    selector: 'td:nth-child(2)'
                },
                dom: "<'row'<'col-md-auto'B><'col-sm-12 col-md'l><'col-sm-12 col-md'f>>" +
                    "<'row'<'col-sm-12 table-responsive'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                // initComplete: (dt) => fetchData(key),
                buttons: [{
                        text: 'เลือกทั้งหมด',
                        action: (e, dt, node, config) => dt.rows().select()
                    },
                    {
                        text: 'ไม่เลือก',
                        action: (e, dt, node, config) => dt.rows().deselect()
                    },
                    {
                        text: 'ลบที่เลือก',
                        className: 'btn-danger',
                        action: async function(e, dt, node, config) {
                            try {
                                // console.log(e, dt, node, config);
                                var selected = dt.rows({
                                    selected: true
                                });
                                var count = selected.count();
                                if (count === 0) {
                                    return swal('โปรดเลือก', 'โปรดเลือกข้อมูลอย่างน้อย 1 รายการเพื่อดำเนินการต่อ', 'info');
                                }

                                const dataT = selected.nodes();
                                var ids = [];
                                for (let index = 0; index < dataT.length; index++) {
                                    const element = dataT[index];
                                    const id = element.dataset.id;
                                    ids.push(id);
                                }

                                const confirm = await swal('ลบข้อมูล', `คุณยืนยันที่จะลบข้อมูลทั้ง ${count} รายการหรือไม่`, 'warning', {
                                    dangerMode: true,
                                    buttons: ['ยกเลิก', 'ยืนยันลบ']
                                });
                                if (!confirm) return;

                                await fadeIn(loader);

                                const formData = new FormData();
                                formData.append('ids', ids);
                                const fetchResult = await fetchJson('/Admin/action/remove-contact-message', 'POST', formData);
                                if (!fetchResult) return;

                                selected.remove().draw();
                                swal('สำเร็จ', `ลบข้อมูลทั้ง ${count} รายการเรียบร้อย`, 'success');
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
                    }
                ]
            });
        }

        fetchData();

        document.body.addEventListener('click', async e => {
            /**
             * Read message event
             */
            if (e.target.closest('td.details-control')) {
                const target = e.target.closest('td.details-control');
                const tr = target.closest('tr');
                const id = tr.dataset.id;
                const status = +tr.dataset.status;
                const table = tr.dataset.table;

                if (status !== 0) return;

                const formData = new FormData();
                formData.append('id', id);
                const result = await fetchJson(`/Admin/action/read-contact-message`, 'POST', formData);
                if (!result) return;

                tr.classList.remove('font-weight-bold');
                tr.dataset.status = 1;
                
                const event = new CustomEvent('read-contact-msg', { detail: 'test'})
                document.body.dispatchEvent(event);

                for (const key in dt) {
                    if (key === table) continue;
                    fetchData(key)
                }
            }
        });
    });

</script>