<?php $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
include $rootDir . "/view/BaseDeconnecteView.php";
firstBlockBody();
?>

<div class="d-flex align-items-center justify-content-center" style="height: 90vh">
    <div class="w-25 m-auto">
        <h3 class="text-center mt-4">Connexion</h3>
        <form name="login" class="border rounded-3 p-3" method="post"
              action="/VerifierLogin">
            <?php if ($this->loginFailed): ?>
                <div class="text-center">
                    <p class="text-bg-danger">Login ou mot de passe incorrect</p>
                </div>
            <?php endif; ?>
            <div class="form-group my-3">
                <label for="inputLogin" class="mb-2">Login</label>
                <input type="text" class="form-control" id="inputLogin" name="inputLogin" aria-describedby="emailHelp"
                       placeholder="Entrez votre login : user1">
            </div>
            <div class="form-group my-3">
                <label for="inputPassword" class="mb-2">Mot de passe</label>
                <input type="password" class="form-control" id="inputPassword" name="inputPassword"
                       placeholder="Entrez votre mot de passe : password1">
            </div>
            <button type="submit" class="btn btn-primary form-control">Se connecter</button>
        </form>
    </div>
</div>

<?php secondBlockBody(); ?>
