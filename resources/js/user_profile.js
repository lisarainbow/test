class UserProfileHelper {
    constructor() {
        this._map = {};
        this.init();
    };

    init() {
        this.map();
        this.saveButtonOnClick();
    };

    map() {
        this._map = {
            messagesContainer: $('.messages'),
            saveButton: $('.save-profile-button'),
        };
    };

    saveButtonOnClick() {
        let $this = this;
        $this._map.saveButton.click(function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();

            let form = $(this).closest('form');
            $.post(form.attr('action'), form.serialize(), function (data) {
                $this.handleMessages(data);
            }).fail(function (error) {
                $this.handleMessages(error);
            });
        });
    };

    handleMessages(data) {
        this._map.messagesContainer.empty();

        if (data.status && data.statusText) {
            this._map.messagesContainer.append('<span class="alert alert-danger">' + 'Got error #' + data.status + ': ' + data.statusText + '</span>');

            return;
        }

        this._map.messagesContainer.append('<span class="alert alert-success">' + data.message + '</span>');
    };
}

$(function () {
    (new UserProfileHelper()).init();
});
