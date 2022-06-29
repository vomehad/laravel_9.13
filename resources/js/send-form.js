import $ from './jquery-3.6.0.min'

const contentBlock = $('.test-content');

// functions
const showNewCookie = (numbers, form) => {
    for (const [className, value] of Object.entries(numbers)) {
        let period = '';

        if (className === 'cookie_hourly') {
            period = 'by 1 hour';
        }

        if (className === 'cookie_forever') {
            period = 'forever';
        }

        $(`.js-cookies .${className}`).text(`Cookie ${period} is ${value.toString()}`);
    }

    cleanForm(form);
    enableButton(form);
};
const alertErrorMessages = (json, form) => {
    if (!json.hasOwnProperty('errors')) {
        return;
    }

    Object.keys(json.errors).forEach((inputName) => {
        const message = json.errors[inputName].shift();
        let messageClass;

        if (inputName === 'numberHourly') {
            messageClass = 'cookie_hourly';
        }
        if (inputName === 'numberForever') {
            messageClass = 'cookie_forever';
        }
        if (inputName === 'wordSplit') {
            messageClass = 'test-content__split';
        }

        showErrors(message, form, inputName, messageClass);
    });

    enableButton(form);
};
const showErrors = (errorMessage, form, inputName, messageClass) => {
    const message = contentBlock.find(`div.${messageClass}`);
    const input = form.find(`input[name="${inputName}"]`);

    form.find(`input[name="${inputName}"]`).addClass('border-danger');
    message.removeClass('alert-success').addClass('alert-danger');
    message.text(errorMessage);

    input.on('input', () => restore(input, message));
};
const cleanForm = (form) => {
    form[0].reset();

    form.find('.border-danger').removeClass('border-danger');
    $('.test-content__cookie').each(function() {
        $(this).removeClass('alert-danger').addClass('alert-success');
    });
};
const restore = (input, message) => {
    if (message.hasClass('alert-danger')) {
        message.removeClass('alert-danger').addClass('alert-success');
        message.text(' ');
    }

    input.removeClass('border-danger');
};
const disableButton = (form) => form.children('button').prop('disabled', true);
const enableButton = (form) => form.children('button').prop('disabled', false);

// ----------- ----------- cookie form ----------- -----------
const cookieForm = contentBlock.find('form#cookie-form');

cookieForm.on('submit', (event) => {
    event.preventDefault();
    disableButton(cookieForm);

    const getCookieUrl = cookieForm.attr('data-url');

    $.ajax({
        url: cookieForm.attr('action'),
        method: "POST",
        data: cookieForm.serializeArray()
    })
        .done(() => {
            $.ajax(getCookieUrl).done((cookies) => showNewCookie(cookies, cookieForm))
        })
        .fail((error) => alertErrorMessages(error.responseJSON, cookieForm));
});
// ----------- ----------- end cookie form ----------- -----------

// ----------- ----------- split form ---------------- -----------
const splitForm = contentBlock.find('form#split-form');

splitForm.on('submit', (event) => {
    event.preventDefault();
    disableButton(splitForm);

    $.ajax({url: splitForm.attr('action'), method: "POST", data: splitForm.serializeArray()})
        .done((word) => {
            const wordDiv = $('.test-content__split');

            wordDiv.text(word);
            wordDiv.show();
            splitForm.children('button').prop('disabled', false);
        })
        .fail((error) => alertErrorMessages(error.responseJSON, splitForm));
});
// ----------- ----------- end split form ------------ -----------

// ----------- ----------- text form ---------------- ------------
const textForm = contentBlock.find('form#text-form');

textForm.on('submit', (event) => {
    event.preventDefault();
    disableButton(textForm);

    $.ajax({url: textForm.attr('action'), method: "POST", data: textForm.serializeArray()})
        .done((text) => {
            enableButton(textForm);
            const textDiv = $('.test-content__text');

            textDiv.text(text);
            textDiv.show();
        })
        .fail((error) => alertErrorMessages(error.responseJSON, textForm));
});
// ----------- ----------- end text form ------------ ------------
