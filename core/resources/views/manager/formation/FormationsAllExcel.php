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
        <td>Localite</td>
        <td>Campagne</td>
        <td>Type formation</td>
        <td>Lieu</td>
        <td>Date de debut</td> 
        <td>Date de fin</td> 
        <td>Observation</td>
    </tr>
    </thead> 
    <?php
    foreach($formations as $c)
    {
    ?>
        <tbody>
        <tr>
            <td><?php echo $c->id; ?></td>
            <td><?php echo $c->localite->nom; ?></td>
            <td><?php echo $c->campagne->nom; ?></td>
            <td><?php echo $c->formation_type; ?></td>
            <td><?php echo $c->lieu_formation; ?></td> 
            <td><?php echo date('d-m-Y', strtotime($c->date_debut_formation)); ?></td>
            <td><?php echo date('d-m-Y', strtotime($c->date_fin_formation)); ?></td> 
            <td><?php echo $c->observation_formation; ?></td>
        </tr>
        </tbody>
        <?php
    }
    ?>

</table>