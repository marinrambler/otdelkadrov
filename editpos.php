<?php
include("config.php");
$dbh = new PDO('mysql:host=localhost;dbname='.$db.';charset=utf8', $user, $pass);
$position_id = 0;
$position_name = "";
$salary = "";
$newUser = "true";
if (isset($_GET['id'])&&($_GET['id']!=0)){
    $stmt = $dbh->prepare("SELECT position_name, salary FROM positions WHERE position_id = :position_id");
    $stmt->bindParam(':position_id', $_GET['id']);
    $stmt->execute();
    $position=$stmt->fetch(PDO::FETCH_OBJ);
    $position_name = $position->position_name;
    $salary = $position->salary;
    $newUser = "false";
    $position_id = $_GET['id'];
}
echo <<<EOT
    <form id="submitForm">
        <div class="form-group">
            <div class="form-group row">
                <label for="positionTitle" class="col-sm-3 col-form-label">Должность:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="positionTitle" placeholder="Должность" required pattern="[A-Za-zА-Яа-яЁё\s]{2,80}" oninvalid="this.setCustomValidity('Должность должна содержать только буквы русского или латинского алфавита.')" value="$position_name">
                </div>
            </div>                                         
            <div class="form-group row">
                <label for="salaryInput" class="col-sm-3 col-form-label">Оклад:</label>
                <div class="col-sm-8">
                    <input placeholder="Заработная плата" type="text" class="form-control" id="salaryInput" required pattern="[0-9\.\,]{1,9}" oninvalid="this.setCustomValidity('Оклад может содержать только цифры и точки с запятыми.')" value="$salary">
                </div>
            </div>

                    </select>
                </div>
            </div>
    <button type="submit" onclick="return submitInfo()" class="btn btn-primary">Сохранить</button>
    </div>
    <script>
            var newUser = $newUser;
            
            function submitInfo(){
                var data = {
                    id: "$position_id",
                    position_name: "",
                    salary: ""
                };
      
            data.position_name = $("#positionTitle").val();
            data.salary = $("#salaryInput").val();
            
            var PHPScript;
            if (newUser)
                PHPScript = "addposition.php";
            else
                PHPScript = "updposition.php";
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