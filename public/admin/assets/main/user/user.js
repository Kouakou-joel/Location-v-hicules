$(document).ready(function() {
    $('#register-user').click(function(e) {
        e.preventDefault(); // Empêche la soumission du formulaire par défaut

        var isValid = true; // Variable pour suivre la validité globale

        var name = $('#name').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var confirm_password = $('#confirm-password').val();
        var pieces = $('#pieces_identite_permis').val();
        var phone = $('#phone').val();
        var agreeterms = $('#agreeterms').prop('checked');

        // Vérification du nom utilisateur
        if (name !== "" && /^[ a-zA-ZàèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚÝâêîôûÂÊÎÔÛãñõÃÑÕäëïöüÿÄËÏÖÜŸçÇßØøÅåÆæœ'`'\-]+$/.test(name)) {
            $('#name').removeClass('is-invalid').addClass('is-valid');
        } else {
            $('#name').addClass('is-invalid').removeClass('is-valid');
            isValid = false;
        }

        // Vérification de l'email
        if (email !== "" && /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            $('#email').removeClass('is-invalid').addClass('is-valid');
        } else {
            $('#email').addClass('is-invalid').removeClass('is-valid');
            isValid = false;
        }

        // Vérification du mot de passe
        if (password.length >= 4) {
            $('#password').removeClass('is-invalid').addClass('is-valid');

            // Vérification de la confirmation du mot de passe
            if (confirm_password !== "" && password === confirm_password) {
                $('#confirm-password').removeClass('is-invalid').addClass('is-valid');
            } else {
                $('#confirm-password').addClass('is-invalid').removeClass('is-valid');
                alert('Les mots de passe ne correspondent pas.');
                isValid = false;
            }
        } else {
            $('#password').addClass('is-invalid').removeClass('is-valid');
            alert('Le mot de passe doit comporter au moins 4 caractères.');
            isValid = false;
        }

        // Vérification de la pièce d'identité ou permis
        if (pieces !== "") {
            $('#pieces_identite_permis').removeClass('is-invalid').addClass('is-valid');
        } else {
            $('#pieces_identite_permis').addClass('is-invalid').removeClass('is-valid');
            isValid = false;
        }

        // Vérification du numéro de téléphone
        if (phone !== "") {
            $('#phone').removeClass('is-invalid').addClass('is-valid');
        } else {
            $('#phone').addClass('is-invalid').removeClass('is-valid');
            isValid = false;
        }

        // Vérification des conditions d'utilisation
        if (agreeterms) {
            $('#agreeterms').removeClass('is-invalid');
        } else {
            $('#agreeterms').addClass('is-invalid');
            isValid = false;
        }

        // Si tous les champs sont valides, vérification de l'existence de l'email via AJAX
        if (isValid) {
            emailExistjs(email)
                .then(function(emailExists) {
                    if (!emailExists) {
                        // Si l'email n'existe pas, on vérifie les pièces
                        return piecesExistjs(pieces);
                    } else {
                        $('#email').addClass('is-invalid').removeClass('is-valid');
                        alert('L\'email existe déjà.');
                        throw new Error('Email existe déjà');
                    }
                })
                .then(function(piecesExists) {
                    if (!piecesExists) {
                        // Si les pièces n'existent pas, soumission du formulaire
                        $('#form-register').submit();
                    } else {
                        $('#pieces_identite_permis').addClass('is-invalid').removeClass('is-valid');
                        alert('Les pièces existent déjà.');
                    }
                })
                .catch(function(error) {
                    console.error('Erreur :', error.message);
                });
        }
    });

    // Vérification de la case à cocher lors du changement
    $('#agreeterms').change(function() {
        if ($(this).prop('checked')) {
            $('#agreeterms').removeClass('is-invalid');
        } else {
            $('#agreeterms').addClass('is-invalid');
        }
    });

    // Fonction de vérification de l'existence de numéros de pièces via AJAX
    function piecesExistjs(pieces) {
        var url = $('#pieces_identite_permis').data('url-pieces-exist');
        var token = $('#pieces_identite_permis').data('token');

        if (!url || !token) {
            console.error("URL ou token manquant.");
            return Promise.reject('URL ou token manquant');
        }

        return $.ajax({
            type: 'POST',
            url: url,
            headers: { 'X-CSRF-TOKEN': token },
            data: { pieces: pieces },
            dataType: 'json'
        }).then(function(result) {
            return result.response === 'exist';
        }).catch(function(error) {
            console.error('Erreur AJAX pour les pièces :', error);
            return false;
        });
    };

    // Fonction de vérification de l'existence de l'email via AJAX
    function emailExistjs(email) {
        var url = $('#email').data('url-email-exist');
        var token = $('#email').data('token');

        if (!url || !token) {
            console.error("URL ou token manquant.");
            return Promise.reject('URL ou token manquant');
        }

        return $.ajax({
            type: 'POST',
            url: url,
            headers: { 'X-CSRF-TOKEN': token },
            data: { email: email },
            dataType: 'json'
        }).then(function(result) {
            return result.response === 'exist';
        }).catch(function(error) {
            console.error('Erreur AJAX pour l\'email :', error);
            return false;
        });
    };
});
