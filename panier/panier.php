<?php session_start();
    require('./function_panier.php');
    $panier=new Panier();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="panier.css">
    <title>Panier</title>
</head>
<body>

     
    
        <?php

                if(isset($_SESSION['panier'])):

                    $ids=array_keys($_SESSION['panier']);
                    $ids=implode(',',$ids);

                    $db=new PDO("mysql:host=localhost;dbname=delice",'root','');
                    $sel="SELECT * FROM produit WHERE id IN($ids)";
                    $req=$db->prepare($sel);
                    $req->execute();
                    $datas=$req->fetchAll();
                    //var_dump($datas)

                ?>

                <table>
                    
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>qte</th>
                            <th>prix U</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach($datas as $data):?>
                                <tr>
                                    <td class='lib'><?= $data['lib_produit'] ?></td>
                                    <td class='qte'><?= $_SESSION['panier'][$data['id']]?></td>
                                    <td class='prix'><?= $data['prix'] ?></td>
                                    <td class='action'><a href="../admin/upload/<?= $data['lien']?>"><button class='btn btn-danger'><i class='fa fa-eye'></i></button></a>&nbsp  <a href="./add.php?action=del&amp;id=<?=$data['id']?>" class='del'><i class='fa fa-remove'></i></a></td>
                                </tr>


                        <?php endforeach ?>

                    </tbody>

                    <tfoot>
                        <tr>
                            <td>Total:</td>
                            <td colspan='3'>
                              <?php  echo $panier->Total(); ?>&nbsp &nbsp<button class='btn btn-danger achat'>Acheter</button> 
                              <a href="../page/index.php"><button class='btn btn-danger achat'><i class="fa fa-sign-out"></i></button> </a>                      
                            </td>
                        </tr>
                    </tfoot>


                </table>


                <?php 

                endif;

        ?>

        <script src='./panier.js'></script>

</body>
</html>