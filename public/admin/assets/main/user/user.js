$('#register-user').click(function() {
    // Récupération des valeurs des champs de formulaire
    var name = $('#name').val();
    var email = $('#email').val();
    var password = $('#password').val();
    var confirm_password = $('#confirm-password').val();
    var agreeterms = $('#agreeterms').prop('checked');

    // Validation du nom (première lettre majuscule et autres lettres minuscules)
    var nameRegex = /^[A-Z][a-z]*(([,.]|[ '-])[A-Za-z][a-z]*)*(\.?)$/;

    // Validation de l'email (simple regex pour vérifier le format)
    var emailRegex = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;

    // Validation du nom
    if(name !== "" && nameRegex.test(name)){
        $('#name').removeClass('is-invalid').addClass('is-valid');
    } else {
        $('#name').removeClass('is-valid').addClass('is-invalid');
    }

    // Validation de l'email
    if(email !== "" && emailRegex.test(email)){
        $('#email').removeClass('is-invalid').addClass('is-valid');
    } else {
        $('#email').removeClass('is-valid').addClass('is-invalid');
    }

    // Validation des autres champs
    if(password === "" || confirm_password === "" || password !== confirm_password){
        $('#password, #confirm-password').addClass('is-invalid');
    } else {
        $('#password, #confirm-password').removeClass('is-invalid').addClass('is-valid');
    }

    // Validation de la case à cocher "accepter les conditions"
    if(agreeterms){
        $('#agreeterms').removeClass('is-invalid').addClass('is-valid');
    } else {
        $('#agreeterms').removeClass('is-valid').addClass('is-invalid');
    }

    // Si toutes les validations sont correctes, vous pouvez soumettre le formulaire
    if($('.is-invalid').length === 0){
        $('#form-register').submit(); // soumet le formulaire si tout est valide
    } else {
        console.log("Veuillez corriger les erreurs dans le formulaire.");
    }
});
