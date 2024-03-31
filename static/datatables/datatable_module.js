//name:輸入table id,
// obj：輸入json data,
// commandlist:datatable option 設定,
// col_def:columnDefs,
// col_table:columns
function data_mat_table(name, obj, commandlist, col_def, col_table) {

    var object1 = {
        data: obj,
        columnDefs: col_def,
        columns: col_table
    };
    var object2 = {
        language: {
            "processing": "處理中...",
            "loadingRecords": "載入中...",
            "lengthMenu": "顯示 _MENU_ 項",
            "zeroRecords": "沒有符合",
            "info": "顯示第 _START_ 至 _END_ 項，共 _TOTAL_ 項",
            "infoEmpty": "顯示第 0 至 0 項，共 0 項",
            "infoFiltered": "(從 _MAX_ 項結果中過濾)",
            "infoPostFix": "",
            "search": "搜尋:",
            "paginate": {
                "first": "第一頁",
                "previous": "上一頁",
                "next": "下一頁",
                "last": "最後一頁"
            },
            "aria": {
                "sortAscending": ": 升冪排列",
                "sortDescending": ": 降冪排列"
            }
        }
    }

    var data_table_obj = {...object1, ...object2, ...commandlist };
    $(name).DataTable(
        data_table_obj
    );

}