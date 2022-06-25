<div class="container">
    <div class="row">
<!-- bouton jour, semaine, mois-->
        <div class="col-md-12 border text-center p-4">
            <div class="btn-group btn-group-toggle">
                <label class="btn btn-info active">
                    <a class="nav-link text-light fw-bold" href="#">Jour</a>
                </label>
                <label class="btn btn-dark ">
                    <a class="nav-link text-light fw-bold"
                       href="/semaine/<?= date('W', strtotime($year . '-' . $month . '-' . $day)); ?>/<?= $year; ?>">Semaine</a>
                </label>
                <label class="btn btn-dark">
                    <a class="nav-link text-light fw-bold"
                       href="/mois/<?= (int)$month; ?>/<?= $year; ?>">Mois</a>
                </label>

            </div>
        </div>
        <!-- fin bouton jour, semaine, mois-->

        <!--début navigation sûr l'année-->
        <div class="col-md-12 border text-center  p-4"><a class="btn btn-dark fw-bold"
                                                          href="/jour/<?= (int)$day; ?>/<?= (int)$month; ?>/<?= $year - 1; ?>"><</a>&nbsp;<div
                class="btn btn-light w-25 fw-bold"><?php echo $year; ?></div>
            &nbsp;&nbsp;
            <a class="btn btn-dark fw-bold"
               href="/jour/<?= (int)$day; ?>/<?= (int)$month; ?>/<?php echo $year + 1; ?>">></a>
        </div>
        <!--fin navigation sur l'année-->

        <!--début case à cocher sur les types d'événement-->
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
        <!--fin case à cocher sur les types d'événement-->

        <div class="col-md-2 border text-center fw-bold  p-4" style="height: 80px;">Heures</div>
        <div class="col-md-10 border  p-4" style="height: 80px;">
            <div class="text-center p-10">
                <a class="btn btn-dark fw-bold"
                   href="/jour/<?= (int)date('d', strtotime("-1 day", strtotime(date($year . '-' . $month . '-' . $day)))); ?>/<?= (int)date('m', strtotime("-1 day", strtotime(date($year . '-' . $month . '-' . $day)))); ?>/<?= (int)date('Y', strtotime("-1 day", strtotime(date($year . '-' . $month . '-' . $day)))); ?>"><</a>

                <div class="btn btn-light w-25 fw-bold"> <?= $jourLettre; ?> <?= date('d', strtotime(date($year . '-' . $month . '-' . $day))); ?>
                    <?= $tabMois; ?> <?= $year; ?></div>
               <a class="btn btn-dark fw-bold"
                               href="/jour/<?= (int)date('d', strtotime("+1 day", strtotime(date($year . '-' . $month . '-' . $day)))); ?>/<?= (int)date('m', strtotime("+1 day", strtotime(date($year . '-' . $month . '-' . $day)))); ?>/<?= (int)date('Y', strtotime("+1 day", strtotime(date($year . '-' . $month . '-' . $day)))); ?>">></a>
            </div>
        </div>

        <?php
        $marginLeft = 0;

        for ($heure = 00; $heure < 24; $heure++) {
            ?>
            <div class="col-md-2 border text-center fw-bold p-4"
                 style="height: 74px;"> <?= ($heure < 10) ? '0' . $heure : $heure; ?>H<br>
                <a href="/nouveaurdv/<?= (int)date('m', strtotime(date($year . '-' . $month . '-' . $day))); ?>/<?= (int)date('Y', strtotime(date($year . '-' . $month . '-' . $day))); ?>/<?= (int)date('d', strtotime(date($year . '-' . $month . '-' . $day))); ?>/<?= $heure; ?>">+
                    Evénement</a>
            </div>
            <div class="col-md-10 border p-0" style="height: 74px;">
                <?php
                $debH = DateTime::createFromFormat('H:i', ($heure < 10) ? '0' . $heure . ':00' : $heure . ':00');
                $finH = DateTime::createFromFormat('H:i', ($heure < 10) ? '0' . $heure . ':59' : $heure . ':59');
                $dateactuel = DateTime::createFromFormat('Y-m-d H:i:s', $year . '-' . $month . '-' . $day . ' ' . (($heure < 10) ? '0' . $heure : $heure) . ':00:00');
                $heuredebutTeste = $debH->format('H:i');
                $heurefinTeste = $finH->format('H:i');
                $iteration = 0;
                $NbrEve = 0;

                foreach ($dateRdv as $rowrdv) {
                    $debut = DateTime::createFromFormat('Y-m-d H:i:s', $rowrdv['Datedebut_Evenement']);
                    $fin = DateTime::createFromFormat('Y-m-d H:i:s', $rowrdv['Datefin_Evenement']);
                    $diff = $debut->diff($fin);
                    $heuredebut = $debut->format('H:i');
                    $heurefin = $fin->format('H:i');

                    ?>

                    <?php

                    if (date('Y-m-d', strtotime($rowrdv['Datedebut_Evenement'])) <= $dateactuel->format('Y-m-d') and
                        date('Y-m-d', strtotime($rowrdv['Datefin_Evenement'])) >= $dateactuel->format('Y-m-d')) {
                        if ($heuredebut >= $heuredebutTeste and $heuredebut <= $heurefinTeste) {

                            ?>
                            <?php if ($marginLeft <= 5) {

                                ?>

                                <div title="<?= $rowrdv['Nom_TypeEvenement']; ?> de <?= $heuredebut; ?> à <?= $heurefin; ?> <?= $rowrdv['Nom_TypeEvenement']; ?>"
                                     class="jour rdv  eve<?= $rowrdv['Id_TypeEvenement']; ?>"
                                     style="<?= $rowrdv['Couleur_TypeEvenement']; ?> <?= ($diff->format('%h') > 0) ? 'height:' . ((int)$diff->format('%h') * 74) . 'px;' : '' ?>
                                     <?= ($debut->format('i') > 0) ? 'margin-top:' . $debut->format('i') . 'px;' : '' ?> left: <?= ($marginLeft > 0) ? ($marginLeft * 13) : $marginLeft; ?>%; background-color: <?= $rowrdv['Couleur_TypeEvenement']; ?>;">
                                    <?= $rowrdv['Nom_TypeEvenement']; ?> de <?= $heuredebut; ?>
                                    à <?= $heurefin; ?>  <?= (strlen($rowrdv['Objet_Evenement']) > 10) ? mb_substr($rowrdv['Objet_Evenement'], 0, 10, 'UTF-8') . '...' : $rowrdv['Objet_Evenement']; ?>  <?= (strlen($rowrdv['Contenu_Evenement']) > 10) ? mb_substr($rowrdv['Contenu_Evenement'], 0, 10, 'UTF-8') . '...' : $rowrdv['Contenu_Evenement']; ?>
                                    <a target="_blank" class="Linkrdv bg-link"
                                       style="<?= $rowrdv['Couleur_TypeEvenement']; ?>;"
                                       href="/voirevenement/<?= (int)$year; ?>/<?= (int)$month; ?>/<?= (int)$day; ?>">Voir
                                        la journée</a>
                                </div>
                                <?php
                                $NbrEve++;

                            } else {
                                if ($NbrEve <= 0) {
                                    ?>

                                    <div class="jour rdv fw-normal eve"
                                         style="background-color: #999999;z-index: 2; height: 100px;left: 79%;">
                                        Trop d'événement <a target="_blank" class="Linkrdv bg-link"
                                                            style="<?= $rowrdv['Couleur_TypeEvenement']; ?>;"
                                                            href="/voirevenement/<?= (int)date('Y', strtotime($year)); ?>/<?= (int)date('m', strtotime($month)); ?>/<?= (int)date('d', strtotime($day)); ?>">Voir
                                            la journée</a>
                                    </div>
                                    <?php

                                }

                            }
                            $marginLeft++;

                        }

                    }
                    ?>

                    <?php
                }
                ?>
            </div>

            <?php
        }
        ?>
    </div>
</div>