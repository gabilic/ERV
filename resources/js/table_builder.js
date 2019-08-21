var TableBuilder = {
    buildTable: function(header, itemList, id) {
        var table = "<tr>";
        header.forEach(function(value) {
            table += "<th>" + value + "</th>";
        });
        table += "</tr>";
        if (typeof(itemList) !== "undefined" && !!itemList) {
            itemList.forEach(function(item) {
                table += "<tr>";
                for (var value in item) {
                    table += "<td>" + (!!item[value] ? item[value] : "") + "</td>";
                }
                table += "</tr>";
            });
        }
        $("#" + id).html(table);
    },

    buildReport: function(header, itemList, id) {
        TableBuilder.buildTable(header, itemList, id);
        $("#" + id + " tr:first-child").prepend("<th></th>");
        $("#" + id + " tr:nth-child(n + 2)").prepend("<td></td>");
        var lastRow = "<tr><td>" + $("#report-total").text() + "</td>";
        if (typeof(itemList) !== "undefined" && !!itemList) {
            for (var value in itemList[0]) {
                lastRow += "<td></td>";
            }
        }
        $("#" + id).append(lastRow + "</tr>");
        for (i = 5; i <= $("#" + id + " tr:first-child th").length - 1; i++) {
            var total = 0;
            var row_count = $("#" + id + " tr").length;
            $("#" + id + " tr").slice(1, row_count - 1).each(function() {
                var value = $(this).children().eq(i).text();
                  if (value !== "") {
                      total += parseFloat(value.replace(",", "."));
                  }
            });
            total = total.toFixed(2).toString().replace(".", ",");
            total = (total === "0,00" ? "" : total);
            $("#" + id + " tr:last-child").children().eq(i).text(total);
        }
    }
};
