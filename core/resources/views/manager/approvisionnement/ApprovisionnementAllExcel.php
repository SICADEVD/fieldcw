<style>
    #categories {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #categories td, #categories th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #categories tr:nth-child(even){background-color: #f2f2f2;}

    #categories tr:hover {background-color: #ddd;}

    #categories th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
    }
</style>

<table id="categories" width="100%">
    <thead>
    <tr>
        <td>ID</td>
        <td>Campagne</td>
        <td>Cooperative</td>
        <td>Espèce d'arbre</td>
        <td>Total</td> 
        <td>Date enreg</td> 
    </tr>
    </thead> 
    <?php
    foreach($approvisionnements as $c)
    {
    ?>
        <tbody>
        <tr>
            <td><?php echo $c->id; ?></td>
            <td><?php echo $c->agroapprovisionnement->campagne->nom; ?></td>
            <td><?php echo $c->agroapprovisionnement->cooperative->name; ?></td>
            <td><?php echo $c->agroespecesarbre->nom; ?></td>
            <td><?php echo $c->total; ?></td>  
            <td><?php echo date('d-m-Y', strtotime($c->agroapprovisionnement->created_at)); ?></td>
        </tr>
        </tbody>
        <?php
    }
    ?>

</table>