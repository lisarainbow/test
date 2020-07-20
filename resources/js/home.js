class HomeHelper {
    constructor() {
        this._map = {};
        this.init();
    };

    init() {
        this.map();
        this.buttonOnClick();
        this.modalOnClose();
    };

    map() {
        this._map = {
            messagesContainer: $('.messages'),
            searchButton: $('#btn-search'),
            eatButton: $('#btn-mark-eaten'),
            sortButton: $('#btn-sorting'),
            userTable: $('.user-table'),
            checkEaten: '.check-eaten',
            filters: $('.form-control'),
            showUsersMsg: '.show-messages',
            containerMsg: $('.container-fluid'),
            modalWin: $('#modalMessages'),
            msgBox: $('#message-box'),
            sendButtonMsg: '#btn-send-new-message',
            spinner: $('.roller-container'),
            receiverId: null,
        };
    };

    buttonOnClick() {
        let self = this;
        this._map.eatButton.click(this.handleEatButtonClick.bind(this));
        this._map.searchButton.click(this.handleFilterProcess.bind(this));
        this._map.sortButton.click(this.handleFilterProcess.bind(this, function () {
            if (self._map.sortButton.attr('data-sort') === 'asc') {
                self._map.sortButton.attr('data-sort', 'desc');
            } else {
                self._map.sortButton.attr('data-sort', 'asc');
            }
        }));
        $(document).on('click', this._map.showUsersMsg, this.handleShowUsersMessages.bind(this));
        $(document).on('click', this._map.sendButtonMsg, this.handleSendUsersMessage.bind(this));
    };

    modalOnClose() {
        let $this = this;
        $this._map.modalWin.on('hidden.bs.modal', function (e) {
            $this.removeUsersMessages();
        })
    };

    removeUsersMessages() {
        this._map.containerMsg.empty();
    };

    handleShowUsersMessages(e) {
        e.preventDefault();
        e.stopImmediatePropagation();

        let $this = this;
        let element = $(e.target).closest('button');
        $this._map.receiverId = element.attr('data-user');
        let form = $(element).closest('form');
        let data = {
            receiver_id: $this._map.receiverId,
            _token: form.find('input[name="_token"]').val() || null,
        };

        $this._map.spinner.css({'display': 'flex'});

        $.get(element.data('action'),data, function (data) {
            $this._map.containerMsg.html(data.data)
            $this._map.spinner.css({'display': 'none'});

            if (!$this._map.modalWin.is(':visible')) {
                $this._map.modalWin.modal('show');
            }
        }).fail(function (error) {
            $this.handleMessages(error);
            $this._map.spinner.css({'display': 'none'});
        });
    };

    handleSendUsersMessage(e) {
        e.preventDefault();
        e.stopImmediatePropagation();

        let $this = this;
        let element = $(e.target).closest('button');
        let message = $this._map.msgBox.val();
        let form = $(element).closest('form');
        let data = {
            message:message,
            receiver_id: $this._map.receiverId,
            _token: form.find('input[name="_token"]').val() || null,
        };

        $this._map.msgBox.val('');
        $this._map.spinner.css({'display': 'flex'});

        $.post(element.data('action'),data, function (data) {
            $this._map.containerMsg.html(data.data)
            $this._map.spinner.css({'display': 'none'});
        }).fail(function (error) {
            $this.handleMessages(error);
            $this._map.spinner.css({'display': 'none'});
        });
    };

    handleFilterProcess(callback, e) {
        if (typeof callback !== "function") {
            e = callback;
            callback = function () {};
        }

        e.preventDefault();
        e.stopImmediatePropagation();

        let $this = this;
        let element = $(e.target).closest('button');

        callback();

        $.post(element.data('action'), this.getFiltersData(element.closest('form').find('input[name="_token"]').val()), function (data) {
            $this.removeUserTableItems();
            $this.drawUserTable(data.users);
        }).fail(function (error) {
            $this.handleMessages(error);
        });
    }

    getFiltersData(token = null) {
        let data = {
            'sort': this._map.sortButton.attr('data-sort'),
            '_token': token || null,
        };

        this._map.filters.each(function () {
            let value = $(this).val();
            let name = $(this).attr('name');

            if (value.trim() !== '') {
                data[name] = value;
            }
        })

        return data;
    }

    removeUserTableItems() {
        this._map.userTable.find('tbody').empty();
    };

    drawUserTable(users) {
        if (users === undefined || users === null) {
            return;
        }

        users.forEach((user, key) => {
            this._map.userTable.find('tbody').append(this.getUserRowTemplate(user, key));
        });
    };

    getUserRowTemplate(user, key) {
        return `<tr>
            <td><b>${(key + 1)}</b></td>
            <td>${user.name || ''}</td>
            <td>${user.last_name || ''}</td>
            <td>${user.dob || ''}</td>
            <td>${user.location || ''}</td>
            <td>${user.phone || ''}</td>
            <td>${user.last_login_at || ''}</td>
            <td class="text-center"><input type="checkbox" aria-label="Checkbox for 'Eaten'" data-user="${user.id}" class="check-eaten" ${user.eaten ? 'checked="true" disabled="true"' : ''} ></td>
            <td><button type="button" class="show-messages btn btn-secondary" data-user="${user.id}" data-action="${window.getUsersMessagesUrl}" data-toggle="modal" data-target="#modalMessages">Send Message</button></td>
            </tr>`;
    };

    handleEatButtonClick(e) {
        e.preventDefault();
        e.stopImmediatePropagation();

        let $this = this;
        let element = e.target;
        let form = $(element).closest('form');
        let data = {
            eaten: [],
            _token: form.find('input[name="_token"]').val() || null,
        };

        $($this._map.checkEaten).each(function () {
            if ($(this).prop('checked')) {
                data.eaten.push($(this).data('user'));
            }
        });

        $.post(form.attr('action'), data, function (data) {
            $($this._map.checkEaten).each(function () {
                if ($(this).prop('checked')) {
                    $(this).attr('disabled', true);
                }
            });
            $this.handleMessages(data);
        }).fail(function (error) {
            $this.handleMessages(error);
        });
    };

    handleMessages(data) {
        this._map.messagesContainer.empty();

        if (data.status && data.statusText) {
            this._map.messagesContainer.append('<span class="alert alert-danger msg-float">' + 'Got error #' + data.status + ': ' + data.statusText + '</span>');

            return;
        }

        this._map.messagesContainer.append('<span class="alert alert-success msg-float">' + data.message + '</span>');
    };
}

$(function () {
    (new HomeHelper()).init();
});
