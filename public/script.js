document.addEventListener('DOMContentLoaded', function() {
    const steps = document.querySelectorAll('.step');
    const nextBtn = document.getElementById('nextBtn');
    let currentStep = 0;

    // Affiche l'étape suivante ou termine si c'est la dernière étape
    function showNextStep() {
        if (currentStep < steps.length - 1) {
            steps[currentStep].classList.remove('active');
            currentStep++;
            steps[currentStep].classList.add('active');
            if (currentStep === steps.length - 1) {
                nextBtn.textContent = 'Terminer';
            }
        } else {
            alert('Terminé');
        }
    }

    // Initialise l'affichage de la première étape
    steps[currentStep].classList.add('active');

    // Écouteur d'événement pour le bouton "Suivant"
    nextBtn.addEventListener('click', showNextStep);
});
