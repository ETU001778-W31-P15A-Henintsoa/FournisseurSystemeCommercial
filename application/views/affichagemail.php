<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=<?= site_url("../assets/css/message.css") ?>>
    <title>JUMBO - Messages</title>
</head>

<style>
        #chat-box {
            height: 300px;
            overflow-y: scroll;
            border: 1px solid #ccc;
            padding: 10px;
        }

        #message-input {
            width: 80%;
            padding: 8px;
        }

        #send-button {
            width: 18%;
            padding: 8px;
            cursor: pointer;
        }
    </style>
        <div class="content-wrapper">   
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Interaction mail - </span> <?= $nomClient ?></h4>
                <!-- Merged -->
                <div class="col-md-12">
                <div class="card mb-3" id="conteneur-message">
                    <?php foreach($messages as $message){ 
                        // var_dump($message);
                        if($message['etat']!=1){ ?>
                            <!-- <div class="messaging-container"> -->
                            <div class="mb-3 person person-1">
                            <?php //echo base_url("upload/".$message['piecejointe'] );?>
                                
                                <div id="icone"><i class="fas fa-user"></i></div>
                                <div id="icone" class="bubble2">
                                    <div class="message"><?= explode("//", $message['libelle'])[1] ?></div>
                                    <br>
                                    <?php if($message['p']==1){ ?>
                                        <div><img src="pdf.png" alt=<?= $message['piecejointe'] ?>></div>
                                    <?php } ?>    
                                </div>
                                
                                <div id="date"><?= $message['dateenvoie'] ?></div>
                            </div>
                        <?php }else{ ?>
                    <div class="mb-3 person person-2">
                       <!-- <i class="fas fa-user"></i> -->
                       <div class="bubble1">
                            <div class="message"><?= explode("//", $message['libelle'])[1] ?></div>
                            <br>
                            <?php if($message['p']==1){ ?>
                                <div><img src="pdf.png" alt=<?= $message['piecejointe'] ?>></div>
                            <?php } ?>
                        </div>
                        <div id="date"><?= $message['dateenvoie'] ?></div>
                    </div>
                    <?php }
                    } ?>
                </div>
                <form action="<?php echo site_url("mail/envoieMail"); ?>" method="post" enctype="multipart/form-data" >
                <div class="mb-4">
                    <input type="hidden" value="<?= $id ?>" name="idmailclient">
                    <input type="hidden" value="<?= $idclient ?>" name="idclient">
                    <input
                    type="text"
                    class="form-control"
                    placeholder="Repondre a <?= $nomClient ?>"
                    name="reponse"
                    />
                    <br>
                    <input type="file" id="file-input" name="piecejointe">
                </div>
                <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>
                </div>
            </div>
        </div>
