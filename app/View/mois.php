<div class="container">
    <div class="row">
        <div class="col-md-12 border text-center p-4">
            <div class="btn-group btn-group-toggle">
                <label class="btn btn-dark ">
                    <a class="nav-link text-light fw-bold" href="/jour/1/<?= $month; ?>/<?= $year; ?>">Jour</a>
                </label>
                <label class="btn btn-dark ">
                    <a class="nav-link text-light fw-bold"
                       href="/semaine/<?= date('W', strtotime($year . '-' . $month . '-01')); ?>/<?= $year; ?>">Semaine</a>
                </label>
                <label class="btn btn-info active">
                    <a class="nav-link text-light fw-bold"
                       href="#">Mois</a>
                </label>

            </div>
        </div>
        <div class="col-md-12 border text-center  p-4"><a class="btn btn-dark fw-bold"
                                                          href="/mois/<?= (int)$month; ?>/<?= (int)$year - 1; ?>"><</a>

            <div class="btn btn-light w-25 fw-bold"><?php echo $year; ?></div>

            <a class="btn btn-dark fw-bold" href="/mois/<?= $month; ?>/<?php echo $year + 1; ?>">></a>
        </div>
        <div class="col-md-12 border text-center  p-4"><a class="btn btn-dark fw-bold"
                                                          href="/mois/<?= ($month - 1 == 0) ? 12 : $month - 1; ?>
/<?= ($month - 1 == 0) ? $year - 1 : $year; ?>"><</a>
            <div class="btn btn-light w-25 fw-bold"><?=$tabMois[$month]; ?></div>
            <a class="btn btn-dark fw-bold"
                           href="/mois/<?= ($month + 1 >= 12) ? 1 : $month + 1; ?>/<?= ($month + 1 >= 12) ? $year + 1 : $year; ?>">></a>

        </div>
        <div class="col-md-12 border text-center  p-4">
            <div class="btn-group">
                <?php foreach ($TypeEve as $key => $rowcheck) { ?>
                    <input class="form-check-input" type="checkbox" id="check<?= $rowcheck['Id_TypeEvenement']; ?>"
                           checked value="yes">
                    <label class="form-check-label"
                           for="check<?= $rowcheck['Id_TypeEvenement']; ?>"><?= $rowcheck['Nom_TypeEvenement']; ?></label>
                    <?php
                }

                ?></div>
        </div>


        <div class="col-md-1 fw-bold border p-4 text-center" style="width: 10%;">
            Semaines
        </div>

        <?php
        foreach ($tab_jours as $row) {
            ?>
            <div class="col-md-1 fw-bold border p-4 text-center"
                 style="width: 12.8571%;"><?= $row; ?></div>


            <?php
        }
        ?>
        <?php foreach ($tabsemaine as $rowMois) { ?>

            <?php foreach ($rowMois as $key => $rowSemaine) {
                ?>
                <div class="col-md-1 fw-bold border p-4 text-center" style="width: 10%;height: 150px;">
                    <?= $key; ?>
                </div>
                <?php foreach ($rowSemaine as $rowJour) { ?>
                    <div class="col-md-1 fw-bold border <?= ($rowJour == date('Y-m-d')) ? 'currentDay' : ''; ?> p-1"
                         style="width: 12.8571%;height: 150px; ">
                        <div class="date">
                            <a href="/jour/<?= (int)date('d', strtotime($rowJour)); ?>/<?= (int)date('m', strtotime($rowJour)); ?>/<?= (int)date('Y', strtotime($rowJour)); ?>"
                               class="text-dark"><small><?= (int)date('d', strtotime($rowJour)); ?> <?= (date('m', strtotime($rowJour)) != $month) ? $tabMois[(int)date('m', strtotime($rowJour))] : ''; ?>
                            </a>
                            <a href="/nouveaurdv/<?= (int)date('m', strtotime($rowJour)); ?>/<?= (int)date('Y', strtotime($rowJour)); ?>/<?= (int)date('d', strtotime($rowJour)); ?>">+Evénement</a></small>
                        </div>
                        <?php
                        $marginTop = 0;
                        $NbrEve = 0;
                        foreach ($dateRdv as $rowrdv) {

                            if (date('Y-m-d', strtotime($rowrdv['Datedebut_Evenement'])) <= $rowJour and date('Y-m-d', strtotime($rowrdv['Datefin_Evenement'])) >= $rowJour) { ?>
                                <?php

                                if ($marginTop >= 1) {
                                    ?>
                                    <?php if ($NbrEve <= 0) { ?>
                                        <div class="mois rdv fw-normal eve"
                                             style="background-color: #999999;z-index: 2">
                                            Trop d'événement <a target="_blank" class="Linkrdv bg-link"
                                                                href="/voirevenement/<?= (int)date('Y', strtotime($rowJour)); ?>/<?= (int)date('m', strtotime($rowJour)); ?>/<?= (int)date('d', strtotime($rowJour)); ?>">Voir
                                                la journée</a>
                                        </div>
                                        <?php
                                        $NbrEve++;
                                    }
                                } else {
                                    ?>
                                    <div class="mois rdv fw-normal eve<?= $rowrdv['Id_TypeEvenement']; ?> "
                                         id="<?= $key; ?>"
                                         style="<?= $rowrdv['Couleur_TypeEvenement']; ?>;">
                                        <?= $rowrdv['Nom_TypeEvenement']; ?>
                                        à <?= date('H:i', strtotime($rowrdv['Datedebut_Evenement'])); ?> <a
                                                target="_blank" style="<?= $rowrdv['Couleur_TypeEvenement']; ?>"
                                                class="Linkrdv bg-link"
                                                href="/voirevenement/<?= (int)date('Y', strtotime($rowJour)); ?>/<?= (int)date('m', strtotime($rowJour)); ?>/<?= (int)date('d', strtotime($rowJour)); ?>">Voir
                                            la journée</a>
                                    </div>


                                    <?php
                                } ?>
                                <?php
                                $marginTop++;
                            }
                        } ?>
                    </div>
                <?php } ?>
            <?php } ?>
            <?php
        }
        ?>
    </div>
</div>