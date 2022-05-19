import $ from './jquery-3.6.0.min';

const deleteButton = $('.js-delete');
const route = deleteButton.attr('data-ref');
const _token = deleteButton.attr('data-csrf');
const redirectUrl = deleteButton.attr('data-redirect');

deleteButton.on('click', (e) => {
    e.preventDefault();
    $.ajax({url: route, method: "delete", data: {"_token": _token}})
        .done(() => location.href = redirectUrl)
        .fail((error) => console.log('error', error.responseJSON));
});
