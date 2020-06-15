<!DOCTYPE html>
<html>    
    <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        
    </head>
    <body style="margin: 20px; padding: 30px;">  
        <div class="row">
        <div class="col-md-10"><h3>Personal Information | <?= $this->user->userInfo['f_name']." ".$this->user->userInfo['l_name']?></h3></div>
        <div class="col-md-2"><a href="logout.php" class="btn btn-info">Log Out</a></div>
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
        <form class="form-group" method="post" action="update-profile.php" enctype="multipart/form-data">
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="fileToUpload" id="fileToUpload">
                <label class="custom-file-label">Choose Avatar...</label>
            </div>
            <br></br>
            <button type="submit" name="submit" value="Submit" class="btn btn-primary">Change Avatar</button>
        </form>
    </body>
</html>