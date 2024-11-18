import "./bootstrap";

// import Alpine from "alpinejs";

// window.Alpine = Alpine;

// Alpine.start();
let table = new DataTable("#datatable");

document.querySelectorAll(".next-button").forEach(function (element) {
    element.addEventListener("click", function () {
        const url = new URL(window.location.href);
        let currentStep = parseInt(url.searchParams.get("activeStep")) || 0;
        const nextStep = currentStep + 1;
        url.searchParams.set("activeStep", nextStep);
        window.location.href = url.toString();
    });
});

document.querySelectorAll(".previous-button").forEach(function (element) {
    element.addEventListener("click", function () {
        const url = new URL(window.location.href);
        let currentStep = parseInt(url.searchParams.get("activeStep")) || 1;
        const previousStep = currentStep - 1;
        url.searchParams.set("activeStep", previousStep);
        window.location.href = url.toString();
    });
});
