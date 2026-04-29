$(document).ready(function () {

    function getArray() {
        let input = $("#arrayInput").val();
        if (!input) return [];
        return input.split(",").map(x => Number(x.trim()));
    }

    function display(arr) {
        $("#output").text(arr.join(", "));
    }

    $("#reverseBtn").click(function () {
        let arr = getArray();
        display(arr.reverse());
    });

    $("#sortAscBtn").click(function () {
        let arr = getArray();
        arr.sort((a, b) => a - b);
        display(arr);
    });

    $("#sortDescBtn").click(function () {
        let arr = getArray();
        arr.sort((a, b) => b - a);
        display(arr);
    });

    $("#searchBtn").click(function () {
        let arr = getArray();
        let val = Number($("#searchValue").val());
        let index = arr.indexOf(val);

        if (index !== -1) {
            $("#output").text("Element found at index " + index);
        } else {
            $("#output").text("Element not found");
        }
    });

});