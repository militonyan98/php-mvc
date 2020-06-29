<?php
    $this->renderStylesheet("/css/chat.css");
    $this->renderStylesheet("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css");
?>
<div class="container">
<h3 class=" text-center">Messaging</h3>
<div class="messaging">
      <div class="inbox_msg">
        <div class="inbox_people">
          <div class="headind_srch">
            <div class="recent_heading">
              <h4>Recent</h4>
            </div>
          </div>
          <div class="inbox_chat">
              <?php foreach ($this->history as $historyItem) { ?>
                <div class="chat_list<?= $historyItem['id'] == $this->target?" active_chat":"";?>">
              <div class="chat_people">
                <div class="chat_img"> <img src="/<?= $historyItem['avatar']?>" alt="sunil"> </div>
                <div class="chat_ib">
                  <h5><?= $historyItem['f_name']?></h5>
                  <p></p>
                </div>
              </div>
            </div>
              <?php } ?>
          </div>
        </div>
        <div class="mesgs">
          <div class="msg_history">
           
          <?php
          $lastId = -1; 
          foreach($this->messages as $msg){
              if($msg["id"]>$lastId)
              {
                  $lastId = $msg["id"];
              }
                $isIncoming =  $msg["from_id"]== $this->target;
                if($isIncoming){
                
                ?>

                    <div class="incoming_msg">
                        <div class="incoming_msg_img"><img src="/<?=$msg["avatar"];?>" alt="<?=$msg["f_name"];?>"></div>
                        <div class="received_msg">
                            <div class="received_withd_msg">
                                <p><?=$msg['body'];?></p>
                                <span class="time_date"> <?=$msg['date'];?></span>
                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="outgoing_msg">
                        <div class="sent_msg">
                            <p><?=$msg['body'];?></p>
                            <span class="time_date"><?=$msg['date'];?></span>
                        </div>
                    </div>
                <?php }
                }?>
            </div>
          <div class="type_msg">
            <div class="input_msg_write">
            <input id="to_id" type="hidden" value="<?= $this->target?>">
              <input type="text" class="write_msg" placeholder="Type a message" />
              <button class="msg_send_btn" type="button"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>


<script>
    let last =  <?=$lastId?>;
    $(".msg_send_btn").click(function(){
        let message = $(".write_msg").val();
        if(message=='')
            return;
        let to_id = $("#to_id").val();
        $(".write_msg").val('');
        $.ajax({
            type: "POST",
            url: "/chat/sendMessage",
            data:   {
                        "to_id": to_id,
                        "message":message
                    }
        });
        refreshMessages();
    });

    function refreshMessages(){
        let to_id = $("#to_id").val();
        $.ajax({
            type: "POST",
            url: "/chat/refreshMessages",
            data:   {
                        "to_id": to_id,
                        "last_id":last
                    },
            success: function(d){
                renderMessages(JSON.parse(d));
            }
        });

    }

    function renderMessages(d){
        let to_id = $("#to_id").val();
        let parent = $(".msg_history")[0];
        d.forEach(element => {
            if(element.to_id==to_id)
                renderOutgoing(parent,element);
            else
                renderIncoming(parent,element);

            if(element.id>last)
                last = element.id;
        });
    }

    function renderOutgoing(parent,element){
        var msg = document.createElement('div');
        msg.className = "outgoing_msg";
        
        var msgInner = document.createElement('div');
        msgInner.className = "sent_msg";
        
        var p = document.createElement('p');
        p.innerText = element.body;
        
        var time = document.createElement('span');
        time.className = "time_date";
        time.innerText = element.date;

        msgInner.appendChild(p);
        msgInner.appendChild(time);
        msg.appendChild(msgInner);
        parent.appendChild(msg);

    }
    
    function renderIncoming(parent,element){
        var msg = document.createElement('div');
        msg.className = "incoming_msg";

        var imgDiv = document.createElement('div');
        imgDiv.className = incoming_msg_img;

        var img = document.createElement('img');
        img.src = "/"+element.avatar;
        img.alt = element.f_name;

        imgDiv.appendChild(img);
        
        var msgInner = document.createElement('div');
        msgInner.className = "received_msg";

        var msgInner2 = document.createElement('div');
        msgInner2.className = "received_withd_msg";
        
        var p = document.createElement('p');
        p.innerText = element.body;
        
        var time = document.createElement('span');
        time.className = "time_date";
        time.innerText = element.date;

        msgInner2.appendChild(p);
        msgInner2.appendChild(time);
        msgInner.appendChild(msgInner);
        msg.appendChild(imgDiv);
        msg.appendChild(msgInner);
        parent.appendChild(msg);
    }


    setInterval(()=>{
        refreshMessages();
    },5000);

   
</script>