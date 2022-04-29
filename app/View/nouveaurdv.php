<div class="container">
    <div class="row mt-2">
        <form action="" method="post">
            <div class="form-group">
                <label for="type">Type d'événement <a href="/nouveautypeevenement">Ajouter un
                        type d'événement</a></label>
                <?php if (!empty($TypeEve)){ ?>
                <select name="type" id="type" class="form-control" required>
                    <option value="">Séléctionnez un type d'événement</option>
                    <?php foreach ($TypeEve as $typerdv) {
                        ?>
                        <option value="<?= $typerdv['Id_TypeEvenement']; ?>"><?= $typerdv['Nom_TypeEvenement']; ?></option>
                        <?php
                    }
                    } else {

                        ?>
                        vous n'avez aucun type d'évenement ajouté <a href="nouveau_typeevenement.php">Ajouter un
                            évenement</a>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="objet">Objet</label>
                <input type="text" id="objet" name="objet" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="contenu">Contenu</label>
                <textarea id="contenu" name="contenu" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="url">Url</label>
                <input type="url" id="url" name="url" class="form-control">
            </div>

            <div class="form-group">
                <label for="debut">Date de début</label>
                <input type="datetime-local" id="debut" name="debut" class="form-control" required
                       value="<?= $dateActuel; ?>">
            </div>

            <div class="form-group">
                <label for="fin">Date de fin</label>
                <input type="datetime-local" id="fin" name="fin" class="form-control" required
                       value="<?= $dateActuel; ?>">
            </div>

            <div class="form-group mt-2">
                <button type="submit" class="btn btn-success">Valider</button>
                <button type="reset" class="btn btn-dark">Annuler</button>
            </div>
        </form>
    </div>
</div>