<?php
	
    $dbname = '127.0.0.1';
    $username = 'root';
    $password = '';
    $db = 'tsk';
    $userInThisMoment = 'admin';


    $connection = mysqli_connect($dbname, $username, $password, $db);

    // Права текущего пользователя
    if(isset($_SESSION['userid'])){
        $useridx = $_SESSION['userid'];
        $chk = mysqli_query($connection, "SELECT * FROM `users` WHERE `id`='$useridx'");
        $usernameAuthX;
        while($row = mysqli_fetch_assoc($chk))
        {
          $rulesAuthX = $row['rules'];
          $usernameAuthX = $row['username'];
        }
    }





    // Вывод всех сотрудников
    function showUsername($connections, $rules = 'user'){
    	?>
        <a href="index.php">Главная</a><br>
        <?php
            if(isset($rules)&&$rules != 'guest'){
        ?>
        <a href="archive.php">Архив</a><br>
        <a href="currentTasks.php">Текущие задачи</a><br>

        <?php
            if(isset($rules)&&$rules === 'admin'){
                ?><a href="userAdd.php">Пользователи</a><?php
            }
        }
        ?>

        
        <?php
    	$users = mysqli_query($connections, "SELECT `username` FROM `users`");
    	foreach ($users as $key => $value) {
            $valOfUser = $value['username'];

            $numOfTasks = mysqli_query($connections, "SELECT count(*) FROM tasks WHERE `username` = '$valOfUser'");
            $row = mysqli_fetch_assoc($numOfTasks);
   			//?><?php echo $value['username'] . " -> " . $row['count(*)'];?><br><?php
		}
    }

    // Вывод сотрудника и выполненных задач
    function showTasks($connections){
    	
    	$users = mysqli_query($connections, "SELECT `username` FROM `users`");
    	foreach ($users as $key => $value) {
            echo "<hr>";
    		$valOfUser = $value['username'];
    		$numOfTasks = mysqli_query($connections, "SELECT `posts`, `id` FROM `tasks` WHERE `username` = '$valOfUser'");
   			//?><p class="uname"><?php echo $value['username']?></p><?php
   			foreach ($numOfTasks as $key => $value) {
   				echo $key+1 . ") ". $value['posts'] . "(" . $value['id'] . ")". "<br>";
   			}
   			echo "<br>";
		}
    }

    // Выбор определенного сотрудника
    function caseUser($connections){
    	$users = mysqli_query($connections, "SELECT `username` FROM `users`");
    	$users->fetch_assoc()['username'];
    }

    // Вывод выполненных задач
    function tasks($connections, $username) {
    	$numOfTasks = mysqli_query($connections, "SELECT `posts` FROM `tasks` WHERE `username` = '$username'");
    	foreach ($numOfTasks as $key => $value) {
   			?><?php echo $value['posts']?><br><?php
		}
    }

    // Отправление информации в БД
    function addInfo($connections, $usernameAuth) {
    	?>
    	<form action="functions/addinfo.php" method="POST" class="sendInfo">
            <h3>Добавление задачи</h3>
    		<select value="usernameX" name="usernameX">
    			<?php 
    			$users = mysqli_query($connections, "SELECT `username` FROM `users`");
    			foreach ($users as $key => $value) {
   				?>
                <option value="<?=$value['username']?>" name="<?=$value['username']?>" <?php if($value['username']==$usernameAuth){ echo "selected";}?>>
                    <?=$value['username']?>
                </option><?php
   				}

   				
		?>
    		</select>
    		<br>
    		<input type="text" name="postsForm" placeholder="Выполненные задачи" />
    		<br>
    		<input type="submit" value="Записать" class="sendFormButton">
    	</form>

    	<?php
    	
    }

    // Удаление выполненных задач
    function deleteInfo($connections) {
        ?>
        <form action="functions/delinfo.php" method="POST" class="sendInfo" id="delForm">
            <h3>Удаление</h3><br>
            <input type="text" name="idForm" placeholder="Индекс задачи" />
            <br>
            <input type="submit" value="Удалить" class="sendFormButton">
        </form>

        <?php
        
    }

    // Отправление данных в архив
    function insertInfo($connections) {
        ?>
        <form action="functions/insertinfo.php" method="POST" class="sendInfo" id="insForm">
            <h3>Перенос в архив</h3><br>
            <input type="submit" value="Отправить" class="sendFormButton">
        </form>
        <?php        
    }

    // Форма запроса к архиву
    function showArchiveInfo($connections) {
        ?>
        <form action="functions/sendarchivedata.php" method="POST" class="sendInfo" id="insForm">
            <h3>Выберите дату</h3><br>
            <p>
                <input type="date" id="dateArch" name="dateArch"/>
            </p>
            <input type="submit" value="Отправить" class="showArchiveDataButton sendFormButton">
        </form>
        <?php   
    }

    // Вывод данных из архива
    function showArchiveTasks($connections, $dateArchive){
        
        $users = mysqli_query($connections, "SELECT `username` FROM `archive` WHERE `date` = '$dateArchive'");
        $chkSum = [];
        foreach ($users as $key => $value) {
            if((!in_array($value['username'], $chkSum))||empty($chkSum)){
                $x = $value['username'];

                echo "<hr>";
                $valOfUser = $value['username'];
                $numOfTasks = mysqli_query($connections, "SELECT `posts`, `id` FROM `archive` WHERE `username` = '$valOfUser' AND `date` = '$dateArchive'");
                ?><p class="uname"><?php echo $value['username']?></p><?php
                foreach ($numOfTasks as $key => $value) {
                    echo $key+1 . ") ". $value['posts'] . "<br>";      
                }
                array_push($chkSum, $x);
            } else{

                continue;              
            }
            
            

            }
        }

    // Добавление новой задачи которую требуется выполнить
    function addNewTask($connections){
        ?>
        <form action="functions/addCurrentTask.php" method="POST" class="sendInfo">
            <h3>Добавление задачи</h3>
            <br>

            <select value="usernameX" name="usernameX">
                <?php 
                $users = mysqli_query($connections, "SELECT `username` FROM `users`");
                foreach ($users as $key => $value) {
                ?>
                <option value="<?=$value['username']?>" name="<?=$value['username']?>">
                    <?=$value['username']?>
                </option><?php
                }

                
        ?>
            </select>
            <br>
            <input type="text" name="postsCurrentForm" placeholder="Необходимо выполнить" />
            <br>
            <input type="submit" value="Записать" class="sendFormButton">
        </form>
        <?php
    } 

    // Вывод всех задач которые требуется выполнить
    function showCurrentTasks($connections) {
        $currentPosts = mysqli_query($connections, "SELECT `posts`, `id`, `username` FROM `posts`");
        foreach ($currentPosts as $key => $value) {
            echo "<br>" . $value['username']. " - " . $key . ")" . $value['posts'] . "(". $value['id'].")";
        }
    }

    // Вывод текущих задач, с кнопкой выполнения
    function showMyCurrentTasks($connections, $myUserName) {
        $currentPosts = mysqli_query($connections, "SELECT `posts`, `id` FROM `posts` WHERE `username` = '$myUserName'");
        foreach ($currentPosts as $key => $value) {
            ?> <div class="mytxt"> <?php echo "<br>" . $key . ") " . $value['posts'];
            ?></div>
                <form action="functions/taskComplete.php" method="POST" style="display: inline-block;">
                    <input type="text" value="<?=$value['posts']?>" style="display: none;" name='sendPostComplete'>
                    <input type="text" value="<?=$myUserName?>" style="display: none;" name='sendUsernameComplete'>
                    <input type="submit" class="btns" value="выполнено">
                </form>
            <?php
        }
    }

    // Удаление текущей задачи
    function deleteCurrentInfo($connections) {
        ?>
        <form action="functions/delCurrentInfo.php" method="POST" class="sendInfo" id="delForm">
            <h3>Удаление</h3><br>
            <input type="text" name="idForm" placeholder="Индекс задачи" />
            <br>
            <input type="submit" value="Удалить" class="sendFormButton">
        </form>

        <?php
        
    }

    // Форма добавления пользователя
    function userAddForm($connections) {
        ?>
            <form action="functions/userAddInfo.php" method="POST" class="sendInfo">
                <h3>Регистрация пользователя</h3><br>
                <input type="text" name="usernameReg" placeholder="Логин" />
                <br>
                <input type="text" name="passwordReg" placeholder="Пароль" />
                <br>
                <select name="rulesReg">
                    <option value="admin">admin</option>
                    <option value="user">user</option>
                </select>
                <br>
                <input type="submit" value="Добавить" class="sendFormButton">
            </form>
        <?php
    }

    //Форма удаления пользователя
     function userDelForm($connections) {
        ?>
            <form action="functions/userDelInfo.php" method="POST" class="sendInfo">
                <h3>Удаление пользователя</h3><br>
                <input type="text" name="usernameDel" placeholder="Логин" />
                <br>
                <input type="submit" value="Удалить" class="sendFormButton">
            </form>
        <?php
    }