import "./bootstrap";

// import Alpine from "alpinejs";

// window.Alpine = Alpine;

// Alpine.start();
let table = new DataTable("#datatable");

$(".submit-button").click(function (e) {
    const url = new URL(window.location.href);
    let tour_id = parseInt(url.searchParams.get("tour_id")) || undefined;
    if (tour_id === undefined) {
        alert("Invalid Tour");
        return false;
    }
    $.ajax({
        type: "post",
        url: "/tours/publish_tour",
        data: { tour_id },
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        dataType: "json",
        success: function (response) {
            alert(response.success);
            window.location.href = "/tours";
        },
    });
    return false;
});

document.querySelectorAll(".save-exit-button ").forEach(function (element) {
    element.addEventListener("click", function () {
        $(".next-button").trigger('click');
        setTimeout(() => {
            window.location.href = '/tours';
        }, 500);
    });
});
document.querySelectorAll(".next-button").forEach(function (element) {
    element.addEventListener("click", function () {
        const url = new URL(window.location.href);
        let currentStep = parseInt(url.searchParams.get("activeStep")) || 0;
        if (currentStep === 0) {
            let tour_id =
                parseInt(url.searchParams.get("tour_id")) || undefined;
            let firstStepData = {};
            firstStepData.title = $("input[name=title]").val();
            firstStepData.riding_style = $(
                "input[name=riding_style]:checked"
            ).val();
            firstStepData.support = $("input[name=support]:checked").val();
            firstStepData.riding_style_info = $(
                "input[name=riding_style_info]"
            ).val();
            firstStepData.rider_capability = $(
                "input[name='rider_capability[]']:checked"
            )
                .map(function () {
                    return $(this).val();
                })
                .get()
                .join(",");
            firstStepData.rider_capability_info = $(
                "input[name=rider_capability_info]"
            ).val();
            firstStepData.duration_days = $("input[name=duration_days]").val();
            firstStepData.rest_days = $("input[name=rest_days]").val();
            firstStepData.max_riders = $("input[name=max_riders]").val();
            firstStepData.guides = $("input[name=guides]").val();
            firstStepData.bike_option = $(
                "input[name=bike_option]:checked"
            ).val();
            firstStepData.rent_gear = $("input[name=rent_gear]:checked").val();
            firstStepData.two_up_riding = $(
                "input[name=two_up_riding]:checked"
            ).val();
            firstStepData.bike_specification = $(
                "input[name=bike_specification]"
            ).val();
            firstStepData.tour_distance = $("input[name=tour_distance]").val();
            firstStepData.countries = $("#countries").val().join(",");
            if (tour_id) {
                firstStepData.tour_id = tour_id;
            }
            console.log("firstStepData", firstStepData);
            $.ajax({
                type: "post",
                url: "/tours/save-tour/firstStep",
                data: { firstStepData },
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                success: function (response) {
                    const nextStep = currentStep + 1;
                    url.searchParams.set("activeStep", nextStep);
                    url.searchParams.set("tour_id", response.tour_id);
                    window.location.href = url.toString();
                },
            });
        }
        console.log(currentStep);

        if (currentStep === 1) {
            let tour_id =
                parseInt(url.searchParams.get("tour_id")) || undefined;
            if (tour_id === undefined) {
                alert("Invalid Tour");
                return false;
            }
            let secondStepData = {};
            secondStepData.description = tinymce
                .get("description")
                .getContent();
            secondStepData.included = tinymce.get("included").getContent();
            secondStepData.tour_meeting_location_notes = tinymce
                .get("tour_meeting_location_notes")
                .getContent();
            secondStepData.not_included = tinymce
                .get("not_included")
                .getContent();
            secondStepData.tour_start_location = $(
                "#tour_start_location"
            ).val();
            secondStepData.tour_id = tour_id;
            $.ajax({
                type: "post",
                url: "/tours/save-tour/secondStep",
                data: { secondStepData },
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                success: function (response) {
                    const nextStep = currentStep + 1;
                    url.searchParams.set("activeStep", nextStep);
                    url.searchParams.set("tour_id", response.tour_id);
                    window.location.href = url.toString();
                },
            });
        }
        if (currentStep === 2) {
            let tour_id =
                parseInt(url.searchParams.get("tour_id")) || undefined;
            if (tour_id === undefined) {
                alert("Invalid Tour");
                return false;
            }
            let thirdStepData = {};
            thirdStepData.video_link_one = $(
                "input[name=video_link_one]"
            ).val();
            thirdStepData.video_link_two = $(
                "input[name=video_link_two]"
            ).val();
            thirdStepData.video_link_three = $(
                "input[name=video_link_three]"
            ).val();
            thirdStepData.tour_id = tour_id;
            $.ajax({
                type: "post",
                url: "/tours/save-tour/thirdStep",
                data: { thirdStepData },
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                success: function (response) {
                    const nextStep = currentStep + 1;
                    url.searchParams.set("activeStep", nextStep);
                    url.searchParams.set("tour_id", response.tour_id);
                    window.location.href = url.toString();
                },
            });
        }
        if (currentStep === 3) {
            let tour_id =
                parseInt(url.searchParams.get("tour_id")) || undefined;
            if (tour_id === undefined) {
                alert("Invalid Tour");
                return false;
            }
            const inputs = document.querySelectorAll('input[name^="date"]');
            const dateValues = [];
            inputs.forEach((input) => {
                const name = input.name; // Get the input's name attribute
                const match = name.match(/date\[(\d+)]\[(\w+)]/); // Match the index and key (date or qty)
                if (match) {
                    const index = match[1];
                    const key = match[2];
                    dateValues[index] = dateValues[index] || {};
                    dateValues[index][key] = input.value;
                }
            });
            $.ajax({
                type: "post",
                url: "/tours/save-tour/fourthStep",
                data: { tour_id, dateValues },
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                success: function (response) {
                    const nextStep = currentStep + 1;
                    url.searchParams.set("activeStep", nextStep);
                    url.searchParams.set("tour_id", response.tour_id);
                    window.location.href = url.toString();
                },
            });
        }
        if (currentStep === 4) {
            let tour_id =
                parseInt(url.searchParams.get("tour_id")) || undefined;
            if (tour_id === undefined) {
                alert("Invalid Tour");
                return false;
            }
            const addonInputs = document.querySelectorAll(
                'input[name^="addon"]'
            );
            const addonValues = [];
            addonInputs.forEach((input) => {
                const name = input.name; // Get the input's name attribute
                const match = name.match(/addon\[(\d+)]\[(\w+)]/); // Match the index and key (date or qty)
                if (match) {
                    const index = match[1];
                    const key = match[2];
                    addonValues[index] = addonValues[index] || {};
                    addonValues[index][key] = input.value;
                }
            });
            $.ajax({
                type: "post",
                url: "/tours/save-tour/fourthStep",
                data: { tour_id, addonValues },
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                success: function (response) {
                    const nextStep = currentStep + 1;
                    url.searchParams.set("activeStep", nextStep);
                    url.searchParams.set("tour_id", response.tour_id);
                    window.location.href = url.toString();
                },
            });
        }
        return false;
    });
});

document.querySelectorAll(".previous-button").forEach(function (element) {
    element.addEventListener("click", function () {
        const url = new URL(window.location.href);
        let currentStep = parseInt(url.searchParams.get("activeStep")) || 1;
        let tour_id = parseInt(url.searchParams.get("tour_id"));
        const previousStep = currentStep - 1;
        url.searchParams.set("activeStep", previousStep);
        url.searchParams.set("tour_id", tour_id);
        window.location.href = url.toString();
    });
});
$(".select2").select2({
    theme: "classic",
});
$(".slider").slick({
    dots: true,
    infinite: true,
    speed: 300,
    slidesToShow: 1,
    centerMode: true,
    variableWidth: true,
});
