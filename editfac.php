<?php
include("config.php");
$dbh = new PDO('mysql:host=localhost;dbname='.$db.';charset=utf8', $user, $pass);
$facility_id = 0;
$facility_name = "";
$facility_address = "";
$city_id = 0;
$newUser = "true";
if (isset($_GET['id'])&&($_GET['id']!=0)){
    $stmt = $dbh->prepare("SELECT facility_name, facility_address, city_id FROM facilities WHERE facility_id = :facility_id");
    $stmt->bindParam(':facility_id', $_GET['id']);
    $stmt->execute();
    $facility=$stmt->fetch(PDO::FETCH_OBJ);
    $facility_name = $facility->facility_name;
    $facility_address = $facility->facility_address;
    $city_id = $facility->city_id;
    $newUser = "false";
    $facility_id = $_GET['id'];
}
echo <<<EOT
    <form id="submitForm">
        <div class="form-group">
            <div class="form-group row">
                <label for="facilityTitle" class="col-sm-3 col-form-label">Магазин:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="facilityTitle" placeholder="Назание магазина" required pattern="[A-Za-zА-Яа-яЁё]{2,80}" oninvalid="this.setCustomValidity('Название магазина должно содержать только буквы русского или латинского алфавита.')" value="$facility_name">
                </div>
            </div>                                         
            <div class="form-group row">
                <label for="addressInput" class="col-sm-3 col-form-label">Адрес:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="addressInput" placeholder="Адрес" required pattern="[A-Za-zА-Яа-яЁё0-9\.\,\s]{2,80}" oninvalid="this.setCustomValidity('Адрес должен содержать только буквы русского, латинского алфавита, цифры и точки с запятыми.')" value="$facility_address">
                </div>
            </div>
            <div class="form-group row">
                <label for="citySelect" class="col-sm-3 col-form-label">Город:</label>
                <div class="col-sm-8">
                    <select class="form-control" id = "citySelect">
EOT;
                    $sql = 'SELECT city_id, city_name FROM cities';
                    foreach ($dbh->query($sql) as $row) {
                        if ($row[city_id] == $city_id)
                            echo <<<EOT
                                <option selected="selected">$row[city_name]</option>
EOT;
                        else
                            echo <<<EOT
                                <option>$row[city_name]</option>
EOT;
                }
echo <<<EOT
                    </select>
                </div>
            </div>
    <button type="submit" onclick="return submitInfo()" class="btn btn-primary">Сохранить</button>
    </div>
    <script>
            var newUser = $newUser;
            
            function submitInfo(){
                var data = {
                    id: "$facility_id",
                    facility_name: "",
                    facility_address: "",
                    city_id: ""
                };
      
            data.facility_name = $("#facilityTitle").val();
            data.facility_address = $("#addressInput").val();
            data.city_id= $("#citySelect").val();
            
            var PHPScript;
            if (newUser)
                PHPScript = "addfacility.php";
            else
                PHPScript = "updfacility.php";
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