    <div class="col-md-8" id="epmloyees_list">
        <table class="table">
            <thead>
                <tr>
                    <th class="wide_th">Магазин</th>
                    <th class="short_th"><a onclick="editInfo(0)" href="#" style="font-weight: bold !important;"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Добавить</a></th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = 'SELECT facility_id, facility_name FROM facilities';
                foreach ($dbh->query($sql) as $row) {
                    echo <<<EOT
                        <tr id="tr$row[facility_id]">
                            <th scope="row"><a onclick="return getInfo($row[facility_id])" href="#">$row[facility_name]</a></th>
                            <th scope="row"><a href="#" onclick="return editInfo($row[facility_id])"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Редактировать </a><a onclick="return deleteWorker($row[facility_id])" href="#"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Удалить </a></th>
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
            $.get( "getinfofac.php", { id: idParam } )
                .done(function (data) {
                    $("#edit").html(data);
                });
        }
        
        function editInfo(idParam){
            $.get( "editfac.php", { id: idParam } )
                .done(function (data) {
                    $("#edit").html(data);
                });
        }

        function deleteWorker(idParam){
            BootstrapDialog.show({
            title: 'Удаление магазина',
            message: 'Удалить этот магазин?',
            buttons: [{
                label: 'Да',
                action: function(dialog) {
                    $.get( "deletefac.php", { id: idParam } )
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