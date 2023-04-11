// Dealing with Textarea Height
function calcHeight(value) {
    // let numberOfLineBreaks = (value.match(/\n/g || [])).length;
    console.log(value);
    // min-height + lines x line-height + padding + border
    let newHeight = 20 + numberOfLineBreaks * 20 + 12 + 2;
    if (newHeight <= 100) {
        return newHeight;
    } else {
        return 100;
    }
}

let textarea = document.querySelector(".resize-ta");
textarea.addEventListener("keyup", () => {
    textarea.style.height = calcHeight(textarea.value) + "px";
});