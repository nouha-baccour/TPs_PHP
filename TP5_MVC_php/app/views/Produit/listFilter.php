<?php

foreach($produits as $produit){ 
    echo '<tr>';
    echo '<td>'. $produit['code']. '</td>';
    echo '<td>'. $produit['designation'] . '</td>';
    echo '<td>'. $produit['categorie']. '</td>';
    echo '<td>'. $produit['Qte'].'</td>';
    echo '<td>'. $produit['prix']. '</td>';
    echo '<td> <img src="assests/images/'.$produit['image'].'" style="width: 85px;"> </td>';
?>
    <td>
        <a href="index.php?url=products/edit&code=<?=$produit['code']?>" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
        <a href="index.php?url=products/delete&code=<?=$produit['code']?>" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
    </td>
</tr>
<?php } ?>