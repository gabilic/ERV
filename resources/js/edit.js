var Edit = {
    init: function() {
        $("#start").change(Edit.handleTimeInputFields);
        $("#end").change(Edit.handleTimeInputFields);
        Edit.calculateTotalHours();
    },

    handleTimeInputFields: function() {
        if (!$("#start").val() && !$("#end").val() || $("#start").val() && $("#end").val()) {
            $("#start").prop("required", false);
            $("#end").prop("required", false);
        } else if ($("#start").val() && !$("#end").val()) {
            $("#end").prop("required", true);
        } else {
            $("#start").prop("required", true);
        }
        Edit.calculateTotalHours();
    },

    calculateTotalHours: function() {
        if (!$("#start").val() && !$("#end").val()) {
            $("#total_hours").text("00:00 (0,000)");
        } else if (!$("#start").val() || !$("#end").val()) {
            $("#total_hours").text($("#total_hours_error").text());
        } else {
            var diff = TimeCalculator.subtractTime($("#end").val(), $("#start").val());
            $("#total_hours").text(diff + " (" + TimeCalculator.convertTimeToDecimal(diff) + ")");
        }
    }
};

$(window).on("load", Edit.init);
