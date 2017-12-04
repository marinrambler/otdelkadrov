    <div class="col-md-8" id="epmloyees_list">
        <table class="table">
            <thead>
                <tr>
                    <th class="wide_th">Сотрудник</th>
                    <th class="short_th"><a onclick="editInfo(0)" href="#" style="font-weight: bold !important;"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Добавить</a></th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = 'SELECT worker_id, worker_sname, worker_name, worker_tname, on_vacation FROM workers';
                foreach ($dbh->query($sql) as $row) {
                    if ($row[on_vacation] == 1)
                        $addition = ' <span class="vacation">[в отпуске]</span>';
                    else
                        $addition = "";
                    echo <<<EOT
                        <tr id="tr$row[worker_id]">
                            <th scope="row"><a onclick="return getInfo($row[worker_id])" href="#">$row[worker_sname] $row[worker_name] $row[worker_tname]$addition</a></th>
                            <th scope="row"><a href="#" onclick="return editInfo($row[worker_id])"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Редактировать </a><a onclick="return deleteWorker($row[worker_id])" href="#"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Удалить </a></th>
                        </tr>
EOT;
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <div id="edit"></div>
    </div>
    <script>
        
        function getInfo(idParam){
            $.get( "getinfo.php", { id: idParam } )
                .done(function (data) {
                    $("#edit").html(data);
                });
        }
        
        function editInfo(idParam){
            $.get( "edit.php", { id: idParam } )
                .done(function (data) {
                    $("#edit").html(data);
                });
        }

        function deleteWorker(idParam){
            BootstrapDialog.show({
            title: 'Увольнение сотрудника',
            message: 'Уволить этого сотрудника?',
            buttons: [{
                label: 'Да',
                action: function(dialog) {
                    $.get( "delete.php", { id: idParam } )
                        .done(function (data) {
                            $("#tr"+idParam).remove();
                            dialog.close();
                        });
                }
            }, {
                label: 'Нет',
                action: function(dialog) {
                    dialog.close();
                }
            }]
        });
        }
    </script>