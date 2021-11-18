const card = document.querySelector(".card__inner");
const yescard = document.querySelector(".yes__card");
const nocard = document.querySelector(".no__card");
const startcard = document.querySelector(".start__card");

const yesbtn = document.querySelector("#yes__card__btn");
const nobtn = document.querySelector("#no__card__btn");

yesbtn.addEventListener("click", function(e) {
    if (!card.classList.contains('__yes') && !card.classList.contains('__no')) {
        nocard.classList.add('hide__me');
        card.classList.add('__yes');
        card.classList.toggle('is-flipped');
    } else if (card.classList.contains('start') && !card.classList.contains('__yes')) {
        card.classList.remove('start');

        startcard.classList.add('hide__me');
        yescard.classList.remove('hide__me');

        yescard.classList.add('card__face--front');
        yescard.classList.remove('card__face--back');
        card.classList.remove('__no')
        card.classList.add('__yes');
        card.classList.toggle('is-flipped');


    } else if (!card.classList.contains('__yes')) {
        card.classList.remove('__no');
        card.classList.add('__yes');
        card.classList.toggle('is-flipped');
    }

});

nobtn.addEventListener("click", function(e) {
    if (!card.classList.contains('__yes') && !card.classList.contains('__no')) {
        yescard.classList.add('hide__me');
        card.classList.add('__no');
        card.classList.toggle('is-flipped');

    } else if (card.classList.contains('start') && !card.classList.contains('__no')) {

        card.classList.remove('start');

        startcard.classList.add('hide__me');
        nocard.classList.remove('hide__me');

        nocard.classList.add('card__face--front');
        nocard.classList.remove('card__face--back');
        card.classList.remove('__yes')
        card.classList.add('__no');
        card.classList.toggle('is-flipped');

    } else if (!card.classList.contains('__no')) {
        card.classList.remove('__yes')
        card.classList.add('__no');
        card.classList.toggle('is-flipped');
    }


});