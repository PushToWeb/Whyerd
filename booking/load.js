var rawd;
async function getdata() {
    var rawdt;
    await $.post('/booking/calendar.php', { pos: 1 }, function(data) {
        rawdt = jQuery.parseJSON(data);

    });
    return rawdt;
}
async function foo() {
    rawd = await getdata()
    console.log(rawd)
    for (let i = 0; i < rawd[1].length; i++) {
        $("#day" + (i + 1) + " .date_day").text(rawd[1][i][0])
        if (rawd[1][i][1].length !== 0) {
            for (let j = 0; j < rawd[1][i][1].length; j++) {
                $("#day" + (i + 1)).html($("#day" + (i + 1)).html() +
                    "<div id=\"e" + rawd[1][i][1][j][3] +
                    "\" class=\"event\"><p>" +
                    rawd[1][i][1][j][1].substring(0, rawd[1][i][1][j][1].length - 2) + ":" +
                    rawd[1][i][1][j][1].substring(rawd[1][i][1][j][1].length - 2) +
                    " - " +
                    rawd[1][i][1][j][2].substring(0, rawd[1][i][1][j][2].length - 2) + ":" +
                    rawd[1][i][1][j][2].substring(rawd[1][i][1][j][2].length - 2) +
                    "</p><button id=\"" + rawd[1][i][1][j][3] +
                    "\" onclick=\"startbook(" + rawd[1][i][1][j][3] + ")\"" +
                    ">Book</button></div>")
            }
        }
        //$("#day" + (i + 1)).html($("#day" + (i + 1)).html() + "<p>asd</p>")

    }


}
foo();


$(document).ready(function() {
    console.log($("#day2 .date_day").text())

});