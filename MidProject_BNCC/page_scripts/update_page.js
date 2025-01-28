let profile_Pic = document.getElementById("profile_Pic");
let input_File = document.getElementById("photo_Input");

input_File.onchange = function () {
    profile_Pic.src = URL.createObjectURL(input_File.files[0]);
};

document.addEventListener("DOMContentLoaded", function () {
    const inputs = [
        { id: "firstName_Input", max: 255 },
        { id: "lastName_Input", max: 255 },
        { id: "email_Input", max: 255 },
        { id: "bio_Input", max: 255 },
    ];

    inputs.forEach(({ id, max }) => {
        const input = document.getElementById(id);
        const counter = document.getElementById(`${id.split("_")[0]}_Count`);

        const updateCounter = () => {
            const length = input.value.length;
            counter.textContent = `(${length}/${max})`;
        };

        input.addEventListener("input", updateCounter);
        updateCounter();
    });
});