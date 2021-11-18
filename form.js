console.log('It works!')
$(document).ready(function() {
    $("#submit").click(function(event) {

        console.log('clicked')
        var email = $('#femail').val()
        var name = $('#fname').val()
        var subject = $('#fsubject').val()
        var message = $('#fmessage').val()
        var status = true;

        if (email == "") {
            console.log("Email is not valid.\n - This field is required!")
            status = false;
        } else {
            if (email.length < 5 || !email.includes('@') || !email.includes('.')) {
                var errorM = "";
                if (email.length < 5) {
                    errorM += "\n - Please write at least 5 characters!"
                }
                if (!email.includes('@') || !email.includes('.')) {
                    errorM += '\n - Email address must contains "@" and "." characters!'
                }
                console.log("Email is not valid." + errorM)
                status = false;
            }
        }
        if (name == "") {
            console.log("Name is not valid.\n - This field is required!")
            status = false;
        } else {
            if (name.length < 3) {
                console.log("Name is not valid.\n - Please write at least 3 characters!")
                status = false;
            }
        }
        if (subject == "") {
            console.log("Subject is not valid.\n - This field is required!")
            status = false;
        } else {
            if (subject.length < 3) {
                console.log("Subject is not valid.\n - Please write at least 3 characters!")
                status = false;
            }
        }
        if (message == "") {
            console.log("Message is not valid.\n - This field is required!")
            status = false;
        } else {
            if (message.length < 10) {
                console.log("Message is not valid.\n - Please write at least 10 characters!")
                status = false;
            }
        }

        if (!status) {
            event.preventDefault()
        }
    })
})