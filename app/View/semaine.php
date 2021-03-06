<div class="container">
    <div class="row">
        <div class="col-md-12 border text-center p-4">
            <div class="btn-group btn-group-toggle">
                <label class="btn btn-dark ">
                    <a class="nav-link text-light fw-bold"
                       href="/jour/<?= (int)date('d', strtotime(date($dateLundi))); ?>/<?= (int)date('m', strtotime($dateLundi)); ?>/<?= $year; ?>">Jour</a>
                </label>
                <label class="btn btn-info active">
                    <a class="nav-link text-light fw-bold"
                       href="#">Semaine</a>
                </label>
                <label class="btn btn-dark">
                    <a class="nav-link text-light fw-bold"
                       href="/mois/<?= (int)date('m', strtotime($dateLundi)); ?>/<?= $year; ?>">Mois</a>
                </label>

            </div>
        </div>
        <div class="col-md-12 border text-center  p-4"><a class="btn btn-dark fw-bold"
                                                          href="/semaine/<?= (int)date('W', strtotime("-1 year", strtotime($dateLundi))); ?>/<?= $year - 1; ?>"><</a>&nbsp;<div
                    class="btn btn-light w-25 fw-bold"><?php echo $year; ?></div>
            &nbsp;&nbsp;
            <a class="btn btn-dark fw-bold"
               href="/semaine/<?= (int)date('W', strtotime("+1 year", strtotime($dateLundi))); ?>/<?php echo $year + 1; ?>">></a>
        </div>
        <div class="col-md-12 border  p-4">
            <div class="text-center p-10">
                <a class="btn btn-dark fw-bold"
                   href="/semaine/<?= (int)date('W', strtotime("-7 day", strtotime($dateLundi))); ?>/<?= (int)date('Y', strtotime("-7 day", strtotime($dateLundi))); ?>"><</a>
                &nbsp;&nbsp;
                <div class="btn btn-light w-25 fw-bold"> Du <?= $dateLundiLettre; ?>
                    au <?= $dateVendrediLettre; ?></div>
                &nbsp;&nbsp;<a class="btn btn-dark fw-bold"
                               href="/semaine/<?= (int)date('W', strtotime("+7 day", strtotime($dateLundi))); ?>/<?= date('Y', strtotime("+7 day", strtotime($dateLundi))); ?>">></a>
            </div>
        </div>
        <div class="col-md-12 border text-center  p-4">

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
        <div class="col-md-1 fw-bold border p-4 text-center" style="width: 10%;height: 70px;">
            Heure
        </div>
        <?php
        foreach ($tabjour as $key => $row) {
            ?>
            <div class="col-md-1 fw-bold border p-4 text-center"
                 style="width: 12.8571%;height: 70px;"><a
                        href="/jour/<?= (int)date('d', strtotime($row)); ?>/<?= (int)date('m', strtotime($row)); ?>/<?= (int)date('Y', strtotime($row)); ?>"
                        class="text-dark"><?= $tabjourLettre[$key]; ?> <?= date('d', strtotime($row)); ?></a>
                <br>
                <a href="/nouveaurdv/<?= (int)date('m', strtotime($row)); ?>/<?= (int)date('Y', strtotime($row)); ?>/<?= (int)date('d', strtotime($row)); ?>">+
                    Ev??nement</a>
            </div>


            <?php
        }
        ?>
        <?php
        for ($heure = 0; $heure < 24; $heure++) {
            $debH = DateTime::createFromFormat('H:i', ($heure < 10) ? '0' . $heure . ':00' : $heure . ':00');
            $finH = DateTime::createFromFormat('H:i', ($heure < 10) ? '0' . $heure . ':59' : $heure . ':59');
            $heuredebutTeste = $debH->format('H:i');
            $heurefinTeste = $finH->format('H:i');
            ?>

            <div class="col-md-1 fw-bold border p-4 text-center" style="width: 10%;height: 74px;">
                <?= ($heure < 10) ? '0' . $heure : $heure; ?>H
            </div>
            <?php foreach ($tabjour as $key => $row) {
                ?>
                <div class="col-md-1 fw-bold border p-0"
                     style="width: 12.8571%;height: 74px;">

                    <?php
                    $NbrEve = 0;
                    foreach ($dateRdv as $rowrdv) {
                        $debut = DateTime::createFromFormat('Y-m-d H:i:s', $rowrdv['Datedebut_Evenement']);
                        $fin = DateTime::createFromFormat('Y-m-d H:i:s', $rowrdv['Datefin_Evenement']);
                        $diff = $debut->diff($fin);
                        $heuredebut = $debut->format('H:i');
                        $heurefin = $fin->format('H:i');
                        if (date('Y-m-d', strtotime($rowrdv['Datedebut_Evenement'])) <= $row and date('Y-m-d', strtotime($rowrdv['Datefin_Evenement'])) >= $row) {

                            if ($heuredebut >= $heuredebutTeste and $heuredebut <= $heurefinTeste) {
                                if ($NbrEve > 0) {
                                    ?>
                                    <div title="<?= $rowrdv['Nom_TypeEvenement']; ?> de <?= $heuredebut; ?> ?? <?= $heurefin; ?> <?= $rowrdv['Nom_TypeEvenement']; ?>"
                                         class="semaine rdv  eve<?= $rowrdv['Id_TypeEvenement']; ?>"
                                         style="background-color: #999999;
                                         <?= ($diff->format('%h') > 0) ? 'height:' . ((int)$diff->format('%h') * 74) . 'px;' : '' ?>
                                         <?= ($debut->format('i') > 0) ? 'margin-top:' . $debut->format('i') . 'px;' : '' ?> min-height: 70px;
                                                 display: block;    z-index: 2;">
                                        Trop d'??v??nement <a target="_blank" class="Linkrdv bg-link"
                                                            style="<?= $rowrdv['Couleur_TypeEvenement']; ?>;"
                                                            href="/voirevenement/<?= (int)date('Y', strtotime($row)); ?>/<?= (int)date('m', strtotime($row)); ?>/<?= (int)date('d', strtotime($row)); ?>">Voir
                                            la journ??e</a></div>

                                    <?php

                                } else {
                                    ?>
                                    <div title="<?= $rowrdv['Nom_TypeEvenement']; ?> de <?= $heuredebut; ?> ?? <?= $heurefin; ?> <?= $rowrdv['Nom_TypeEvenement']; ?>"
                                         class="semaine rdv  eve<?= $rowrdv['Id_TypeEvenement']; ?>"
                                         style="<?= $rowrdv['Couleur_TypeEvenement']; ?>
                                         <?= ($diff->format('%h') > 0) ? 'height:' . ((int)$diff->format('%h') * 74) . 'px;' : '' ?>
                                         <?= ($debut->format('i') > 0) ? 'margin-top:' . $debut->format('i') . 'px;' : '' ?>
                                                 background-color: <?= $rowrdv['Couleur_TypeEvenement']; ?>; display: block;">
                                        <?= $rowrdv['Nom_TypeEvenement']; ?> de <?= $heuredebut; ?>
                                        ?? <?= $heurefin; ?>  <?= (strlen($rowrdv['Objet_Evenement']) > 10) ? mb_substr($rowrdv['Objet_Evenement'], 0, 10, 'UTF-8') . '...' : $rowrdv['Objet_Evenement']; ?>  <?= (strlen($rowrdv['Contenu_Evenement']) > 10) ? mb_substr($rowrdv['Contenu_Evenement'], 0, 10, 'UTF-8') . '...' : $rowrdv['Contenu_Evenement']; ?>
                                        <a target="_blank" class="Linkrdv bg-link"
                                           style="<?= $rowrdv['Couleur_TypeEvenement']; ?>;"
                                           href="/voirevenement/<?= (int)date('Y', strtotime($row)); ?>/<?= (int)date('m', strtotime($row)); ?>/<?= (int)date('d', strtotime($row)); ?>">Voir
                                            la journ??e</a>
                                    </div>
                                    <?php
                                }
                                $NbrEve++;
                            }
                        }
                    }
                    ?>
                </div>

            <?php } ?>


            <?php
        }
        ?>

    </div>
</div>