<div class="container">
    <div class="row m-2">
        <div class="col-md-12  text-center  p-4">

            <?php foreach ($TypeEve as $key => $rowcheck) { ?>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="check<?= $rowcheck['Id_TypeEvenement']; ?>"
                           checked value="yes">
                    <label class="form-check-label"
                           for="check<?= $rowcheck['Id_TypeEvenement']; ?>"><?= $rowcheck['Nom_TypeEvenement']; ?></label>

                </div>

                <?php
            }

            ?>
        </div>
    </div>
    <div class="row m-2">
        <?php foreach ($dateRdv as $rdv) { ?>
            <div class="alert rdv eve<?= $rdv['Id_TypeEvenement']; ?>"
                 style="<?= $rdv['Couleur_TypeEvenement']; ?>">
                <?= $rdv['Nom_TypeEvenement']; ?> de <?= date('H:i', strtotime($rdv['Datedebut_Evenement'])); ?>
                à <?= date('H:i', strtotime($rdv['Datefin_Evenement'])); ?>
                <?= $rdv['Objet_Evenement']; ?> <?= $rdv['Contenu_Evenement']; ?> <?php
                if (!empty($rdv['Url_Evenement'])) {
                    ?>
                    <a class="Linkrdv bg-link"
                       style="<?= $rdv['Couleur_TypeEvenement']; ?> "
                       href="<?= $rdv['Url_Evenement']; ?>" target="_blank"><?= $rdv['Url_Evenement']; ?></a>
                <?php } ?>
            </div>
            <?php
        }
        ?>
    </div>
</div>