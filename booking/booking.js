// (A) GET THE PARAMETERS
var params = new URLSearchParams(window.location.search);

id = params.get("id");
if (id === null) {
    location.href = "/#booking";
}
console.log(id)

getPreviewInfo();



$(document).ready(function() {
    $("#changeDate").click(function() {
        location.href = "/#booking";
    });
    $("#book").click(async function() {
        try {
            //validation
            const dataPost = [id, "Bencze Levente", "bencze.levente011@gmail.com", ["m11@gmail.com", "m2@gmail.com"], "Any Custom Details / Questions"]
            console.log(dataPost)
            await $.post('/booking/book.php', { data: JSON.stringify(dataPost) }, function(data) {
                console.log(data)
            });

            /*
            INSERT INTO booked (b,n0,m0,t,m1,m2) VALUES (1,"bencze Levente", "bencze.levente011@gmail.com", 2109271234124,"m11@gmail.com","m2@gmail.com" );
            */
        } catch (error) {
            console.log(error)
        }
    });

});



function addMember() {
    console.log("asd")
    if (parseInt($("#memberCount").text()) < parseInt($("#maxcount").text())) {

        var tid = parseInt($("#memberCount").text()) + 1;
        $("#addMember").before('<label id="member' + tid + '" class="memberInfo"><h3>Member #' + tid + '</h3>Email<input type="email" name="email" id="email' + tid + '" placeholder="yourmail@mail.com"><button id="removem' + tid + '" onclick=\"removeMember(' + tid + ')\">Remove</button> </label>');
        $("#memberCount").text(tid);
        if (tid > 2) {
            $("#removem" + (tid - 1)).remove();
        }
        if (parseInt($("#memberCount").text()) === parseInt($("#maxcount").text())) {
            $("#addMember").remove();
        }
    }


};

function removeMember(id) {
    $("#member" + id).remove();
    if (parseInt($("#memberCount").text()) === parseInt($("#maxcount").text())) {
        $("#member" + (id - 1)).after('<button id="addMember" onclick="addMember()">Add new</button>');
    }
    $("#email" + (id - 1)).after('<button id="removem' + (id - 1) + '" onclick=\"removeMember(' + (id - 1) + ')\">Remove</button>');
    $("#memberCount").text(id - 1);
}

async function getPreviewInfo() {
    try {

        var rawdt;
        await $.post('/booking/previewinfo.php', { id: id }, function(data) {
            rawd = jQuery.parseJSON(data);
        });
        console.log(rawd);
        $("#booking_info #date").text("20" + rawd[0].substring(0, 2) + "." + rawd[0].substring(2, 4) + "." + rawd[0].substring(4, 6))
        $("#booking_info #startTime").text(rawd[1].substring(0, rawd[1].length - 2) + ":" + rawd[1].substring(rawd[1].length - 2))
        $("#booking_info #endTime").text(rawd[2].substring(0, rawd[2].length - 2) + ":" + rawd[2].substring(rawd[2].length - 2))
    } catch (error) {
        location.href = "/#booking";
    }
}