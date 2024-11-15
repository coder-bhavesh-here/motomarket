import "./bootstrap";

// import Alpine from "alpinejs";

// window.Alpine = Alpine;

// Alpine.start();
import {
    ClassicEditor,
    Essentials,
    Bold,
    Italic,
    Font,
    Paragraph,
} from "ckeditor5";

import "ckeditor5/ckeditor5.css";

ClassicEditor.create(document.querySelector("#editor"), {
    plugins: [Essentials, Bold, Italic, Font, Paragraph],
    toolbar: [
        "undo",
        "redo",
        "|",
        "bold",
        "italic",
        "|",
        "fontSize",
        "fontFamily",
        "fontColor",
        "fontBackgroundColor",
    ],
})
    .then(/* ... */)
    .catch(/* ... */);

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
