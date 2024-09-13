$(document).ready(function() {
    $('#register-user').click(function(e) {
        e.preventDefault(); // Empêche la soumission du formulaire par défaut

        var isValid = true; // Variable pour suivre la validité globale

        var name = $('#name').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var confirm_password = $('#confirm-password').val();
        var passwordLength = password.length;
        var pieces = $('#pieces').val();
        var phone = $('#telephone').val();
        var agreeterms = $('#agreeterms').prop('checked');

        // Vérification du nom utilisateur
        if (name != "" && /^[ a-zA-ZàèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚÝâêîôûÂÊÎÔÛãñõÃÑÕäëïöüÿÄËÏÖÜŸçÇßØøÅåÆæœ'`'\-]+$/.test(name)) {
            $('#name').removeClass('is-invalid').addClass('is-valid');
        } else {
            $('#name').addClass('is-invalid').removeClass('is-valid');
            isValid = false;
        }

        // Vérification de l'email
        if (email != "" && /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            $('#email').removeClass('is-invalid').addClass('is-valid');
        } else {
            $('#email').addClass('is-invalid').removeClass('is-valid');
            isValid = false;
        }

        // Vérification du mot de passe
        if (passwordLength >= 8) {
            $('#password').removeClass('is-invalid').addClass('is-valid');

            // Vérification de la confirmation du mot de passe
            if (confirm_password && password === confirm_password) {
                $('#confirm-password').removeClass('is-invalid').addClass('is-valid');
            } else {
                $('#confirm-password').addClass('is-invalid').removeClass('is-valid');
                alert('Les mots de passe ne correspondent pas.');
                isValid = false;
            }
        } else {
            $('#password').addClass('is-invalid').removeClass('is-valid');
            alert('Le mot de passe doit comporter au moins 8 caractères.');
            isValid = false;
        }

        // Vérification de la pièce
        if (pieces) {
            $('#pieces').removeClass('is-invalid').addClass('is-valid');
        } else {
            $('#pieces').addClass('is-invalid').removeClass('is-valid');
            isValid = false;
        }

        // Vérification du numéro de téléphone
        if (phone) {
            $('#telephone').removeClass('is-invalid').addClass('is-valid');
        } else {
            $('#telephone').addClass('is-invalid').removeClass('is-valid');
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
            emailExistjs(email).then(function(res) {
                if (res !== "exist") {
                    // Si l'email n'existe pas, soumission du formulaire
                    $('#form-register').submit();
                } else {
                    $('#email').addClass('is-invalid').removeClass('is-valid');
                    alert('L\'email existe déjà.');
                }
            }).catch(function(error) {
                console.error('Erreur lors de la vérification de l\'email :', error);
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

    // Fonction de vérification de l'existence de l'email via AJAX
    function emailExistjs(email) {
        var url = $('#email').data('url-email-exist'); // Récupérer l'URL correctement via data attribute
        var token = $('#email').data('token'); // Récupérer le token via data attribute

        return $.ajax({
            type: 'POST',
            url: url,
            headers: {
                'X-CSRF-TOKEN': token
            },
            data: { email: email },
            dataType: 'json'
        }).then(function(result) {
            return result.response; // Retourner la réponse sous forme de promesse
        }).catch(function(error) {
            console.error('Erreur AJAX :', error);
            return "error";
        });
    }
});
