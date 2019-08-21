var Index = {
    init: function() {
        $("#persons tr:has(td)").on("click", Index.retrieveRecords);
        $("#btn-new").click(Index.newRecordClick);
        $("#btn-edit").click(Index.editRecordClick);
        $("#btn-delete").click(Index.deleteRecordClick);
        $("#btn-report").click(Index.reportClick);
        Index.handleClicks();
        Index.changeButtonState();
    },

    changeButtonState: function() {
        $("#btn-new").prop("disabled", $("table#persons tr.selected").length === 0);
        $("#btn-edit").prop("disabled", $("table#records tr.selected").length === 0);
        $("#btn-delete").prop("disabled", $("table#records tr.selected").length === 0);
    },

    handleClicks: function() {
        $("tr:has(td)").on("click", Index.markRowAsSelected);
    },

    markRowAsSelected: function() {
        $(this).parent().children().removeClass("selected");
        $(this).toggleClass("selected").focus();
        Index.changeButtonState();
    },

    handleRetrieveRequest: function(id) {
        var header = $("#records tr:first-child th").toArray().map((key) => key.innerText.trim());

        $.ajax({ url: "index.php",
                 data: { action: "retrieveRecords", id: id },
                 type: "get",
                 success: function(output) {
                     TableBuilder.buildTable(header, JSON.parse(output), "records");
                     Index.handleClicks();
                 }
        });
    },

    retrieveRecords: function() {
        Index.handleRetrieveRequest(parseInt($(this).children(":first").text()));
    },

    getPersonId: function() {
        return $("#persons .selected td:first-child").text();
    },

    getRecordId: function() {
        return $("#records .selected td:first-child").text();
    },

    newRecordClick: function() {
        window.location.href = "edit.php?person=" + Index.getPersonId();
    },

    editRecordClick: function() {
        window.location.href = "edit.php?person=" + Index.getPersonId() + "&record=" + Index.getRecordId();
    },

    deleteRecordClick: function() {
        if (confirm($("#delete-confirm").text())) {
            $.ajax({ url: "index.php",
                     data: { action: "deleteRecord", id: Index.getRecordId() },
                     type: "get",
                     success: function(output) {
                         Index.handleRetrieveRequest(Index.getPersonId());
                     }
            });
        }
    },

    reportClick: function() {
        window.location.href = "report.php";
    }
};

$(window).on("load", Index.init);
