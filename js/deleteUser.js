function redirect(a){
    Swal.fire({
        title: 'Ar tikrai norite ištrinti šį darbuotoją?',
        text: "Duomenys bus negrįžtamai pašalinti iš duomenų bazės",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#555555',
        confirmButtonText: 'Ištrinti',
        cancelButtonText: 'Atšaukti'
    }).then((result) => {
        if (result.value) {
            location.replace("users.php?del_user=" + a)
        }
    })
}