<!DOCTYPE html>
<html>    
    <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        
    </head>
    <body style="margin: 20px; padding: 30px;">
        <?php if($this->user->userInfo["user_id"]!==$_SESSION["id"]){?>
            <a href="/profile" class="btn btn-info">Back</a>
        <?php } ?>
        <div class="row">
        <div class="col-md-9"><h3><?php if($this->user->userInfo["user_id"]==$_SESSION["id"]){?>Personal Information | <?php } ?><?= $this->user->userInfo['f_name']." ".$this->user->userInfo['l_name']?></h3></div>
        <div class="col-md-1"><a href="/profile/friends" class="btn btn-info">Friends</a></div>
        <div class="col-md-1"><a href="/chat" class="btn btn-info">Messages</a></div>
        <div class="col-md-1"><a href="/logout" class="btn btn-info">Log Out</a></div>
        </div>
        <br></br>
        <table class="table">
            <thead class="thead-light">
                <tr>
                   
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Avatar</th>
                    <th>Gender</th>
                    <th>Email</th>
                </tr>
                  
                    <td><?= $this->user->userInfo['f_name']; ?></td>
                    <td> <?= $this->user->userInfo['l_name']; ?></td>
                    <td><div style="width: 100px;"><img class="img-thumbnail" src="<?=$this->user->userInfo['avatar']?>"></div></td> 
                    <td> <?= $this->user->userInfo['gender']; ?></td>
                    <td><?= $this->user->userInfo['email']; ?></td>

            </thead>
        </table>
        <?php
            if($this->user->userInfo["user_id"]==$_SESSION["id"]){
        ?>
        <form class="form-group" method="post" action="update-profile.php" enctype="multipart/form-data">
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="fileToUpload" id="fileToUpload">
                <label class="custom-file-label">Choose Avatar...</label>
            </div>
            <br></br>
            <input type="submit" name="submit" value="Change Avatar" class="btn btn-primary">
        </form>
        <?php
            }
        ?>
    </body>
</html>