<!DOCTYPE html>
<html>    
    <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        
    </head>
    <body style="margin: 20px; padding: 30px;">
        <a href="/profile" class="btn btn-info">Back</a>
        <h3><?= $this->user->userInfo['f_name']." ".$this->user->userInfo['l_name']?> | Friends</h3>
        <div>
            <?php foreach($this->user->friendList as $friend): ?>
                <div class="row" style="margin: 20px 20px">
                    <div class="col-md-1" style="width: 100px;"><a href="/profile/user/<?=$friend["user_id"]?>"><img class="img-thumbnail" src="../<?=$friend['avatar']?>"></a></div>
                    <div><a href="/profile/user/<?=$friend["user_id"]?>"><?= $friend['f_name']." ".$friend['l_name'];?></a></div>
                </div>
            <?php endforeach; ?>   
        </div>
    </body>
</html>