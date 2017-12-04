<?php
include("config.php");
$dbh = new PDO('mysql:host=localhost;dbname='.$db.';charset=utf8', $user, $pass);
$sname = "";
$name = "";
$tname = "";
$address = "";
$position = 0;
$facility = 0;
$newUser = "true";
$workerId = 0;
$vacationSelect = "";
if (isset($_GET['id'])&&($_GET['id']!=0)){ //в случае редактирования получаем данные из базы данных
    $stmt = $dbh->prepare("SELECT worker_sname, worker_name, worker_tname, address, position_id, facility_id, on_vacation FROM workers WHERE worker_id = :worker_id");
    $stmt->bindParam(':worker_id', $_GET['id']);
    $stmt->execute();
    $worker=$stmt->fetch(PDO::FETCH_OBJ);
    $sname = $worker->worker_sname;
    $name = $worker->worker_name;
    $tname = $worker->worker_tname;
    $address = $worker->address;
    $position = $worker->position_id;
    $facility = $worker->facility_id;
    if($worker->on_vacation == 1)
        $vacationSelect = ' selected="selected"';
    $newUser = "false";
    $workerId = $_GET['id'];
}
echo <<<EOT
<form id="submitForm">
        <div class="form-group">
            <div class="form-group row">
                <label for="lastNameInput" class="col-sm-3 col-form-label">Фамилия:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="lastNameInput" placeholder="Фамилия" required pattern="^[А-Яа-яЁё]{2,80}" oninvalid="this.setCustomValidity('Фамилия должна содержать только буквы русского алфавита.')" value="$sname">
                </div>
            </div>                                    
            <div class="form-group row">
                <label for="firstNameInput" class="col-sm-3 col-form-label">Имя</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="firstNameInput" placeholder="Имя" required pattern="^[А-Яа-яЁё]{2,80}" oninvalid="this.setCustomValidity('Имя должно содержать только буквы русского алфавита.')" value="$name">
                </div>
            </div>
            <div class="form-group row">
                <label for="middleNameInput" class="col-sm-3 col-form-label">Отчество:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="middleNameInput" placeholder="Отчество" required pattern="^[А-Яа-яЁё]{2,80}" oninvalid="this.setCustomValidity('Отчество должно содержать только буквы русского алфавита.')" value="$tname">
                </div>
            </div>
            <div class="form-group row">
                <label for="addressInput" class="col-sm-3 col-form-label">Адрес:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="addressInput" placeholder="Адрес" required pattern="^[A-Za-zА-Яа-я0-9,\.\(\)\-]{2,80}$" oninvalid="this.setCustomValidity('Адрес должен содержать только буквы русского, латинского алфавита и цифры.')" value="$address">
                </div>
            </div>
            <div class="form-group row">
                <label for="positionSelect" class="col-sm-3 col-form-label">Должность:</label>
                <div class="col-sm-8">
                    <select class="form-control" id = "positionSelect">
EOT;
                    $sql = 'SELECT position_id, position_name FROM positions';
                    foreach ($dbh->query($sql) as $row) {
                        $output = '<option>'.$row[position_name].'</option>';
                        if ($row[position_id] == $position)
                            $output = '<option selected="selected">'.$row[position_name].'</option>';
                        echo $output;
                }
echo <<<EOT
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="facilitySelect" class="col-sm-3 col-form-label">Магазин:</label>
                <div class="col-sm-8">
                    <select class="form-control" id = "facilitySelect">
EOT;
                    $sql = 'SELECT facility_id, facility_name FROM facilities';
                    foreach ($dbh->query($sql) as $row) {
                        $output = '<option>'.$row[facility_name].'</option>';
                        if ($row[facility_id] == $facility)
                            $output = '<option selected="selected">'.$row[facility_name].'</option>';
                        echo $output;
                }
echo <<<EOT
                    </select>
                </div>
                </div>
                <div class="form-group row">
                <label for="positionSelect" class="col-sm-3 col-form-label">В отпуске:</label>
                <div class="col-sm-8">
                    <select class="form-control" id = "onVacation">
                                <option>Нет</option>
                                <option$vacationSelect>Да</option>
                    </select>
                </div>
            </div>
            </div>
    <button type="submit" onclick="return submitInfo()" class="btn btn-primary">Сохранить</button>
    </div>
    <script>
            var newUser = $newUser; //true - если добавляем, false - если редактируем
            
            function submitInfo(){
                var data = {
                    id: "$workerId",
                    firstName: "",
                    lastName: "",
                    middleName: "",
                    address: "",
                    position: "",
                    facility: "",
                    on_vacation: ""
                };
      
            data.firstName = $("#firstNameInput").val();
            data.lastName = $("#lastNameInput").val();
            data.middleName = $("#middleNameInput").val();
            data.address = $("#addressInput").val();
            data.position = $("#positionSelect").val();
            data.facility = $("#facilitySelect").val();
            data.on_vacation = $("#onVacation").val();
                
            //if (!data.firstName || !data.lastName || !data.middleName || !data.address || !data.position || !data.facility) {alert("Введите данные"); return;}
            var PHPScript;
            if (newUser)
                PHPScript = "addworker.php";
            else
                PHPScript = "updworker.php";
            jQuery.ajax({
            url: PHPScript,
            type: "POST",
            data: data,
            success: function(data){
                alert("Успешно сохранено");
                //$( '#submitForm' ).each(function(){ this.reset(); });
                location.reload();
            },
            error: function(msg){
                console.warn(msg);
                }          
            });
                return false;
            }
    </script>
</form>
EOT;
?>