<?php 
    include_once '../../../includes/bot.php';
    $bot=new Bot();
    
    if(!$bot->existSessionUser() || !$bot->userIsAdmin())
        die("Session Error");
    if(isset($_GET['filter_username']))
        $filter_username=ltrim($_GET['filter_username'],"@");
?>
<div class="row mt-4 p-2 justify-content-center">
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Usuario</th>
                <th scope="col">Contacto</th>
                <th scope="col">Telegram</th>
                <th scope="col">Role</th>
                <th scope="col"></th>
            </tr>
        </thead>  
        <tbody>
        <?php 
        if(isset($filter_username))
            $users=$bot->getFilteredtUsers($bot->getDataSession('id'),$filter_username);
        else
            $users=$bot->getLastUsers($bot->getDataSession('id'));
        foreach($users as $user):?>
        
            <tr>
                <th scope="row "><?php echo $user['id']?></th>
                <td>@<?php echo $user['username']?></td>
                <td><strong data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo $user['data']?>"><?php echo $user['type']=="email"?"correo":"teléfono"?></strong></td>
                    
                <td><?php
                $uer_telegram=$user['telegram_username'];
                if($uer_telegram!==null)
                    echo "@".$uer_telegram;
                else
                    echo "-"
                ?></td>
                <td><?php echo $user['role']?></td>
                <td>


                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</div>  