var TimeCalculator = {
    subtractTime: function(first, second) {
        first = first.split(":");
        second = second.split(":");

        min = first[1] - second[1];
        hour_carry = 0;
        if (min < 0) {
            min += 60;
            hour_carry += 1;
        }
        hour = first[0] - second[0] - hour_carry;
        return (hour.toString().length === 1 ? "0" + hour : hour) + ":" + (min.toString().length === 1 ? "0" + min : min);
    },

    convertTimeToDecimal: function(time) {
        time = time.split(":");
        return (parseInt(time[0]) + time[1] / 60).toFixed(3).replace(".", ",");
    }
};
