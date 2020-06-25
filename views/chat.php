<?php
    for($i = 0; $i<count($this->messages); $i++){
        $currentMessage = $this->messages[$i];
?>
<div>
    <div><?= $currentMessage["body"]?></div>
    <br></br>
</div>
<?php
    };
?>

<input id="message" type="textarea">
<input id="submitMsg" type="submit">
<input id="to_id" type="hidden" value="<?= $this->target?>">

<script>
    $("#submitMsg").click(function(e){
        e.preventDefault();
        let message = $("#message").val();
        alert(message);
        let to_id = $("#to_id").val();
        alert(to_id);
        $.post( "/chat/sendMessage", data = {
        "to_id": to_id,
        "message":message
        });
    });
   
</script>