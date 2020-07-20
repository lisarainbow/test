/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/home.js":
/*!******************************!*\
  !*** ./resources/js/home.js ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var HomeHelper = /*#__PURE__*/function () {
  function HomeHelper() {
    _classCallCheck(this, HomeHelper);

    this._map = {};
    this.init();
  }

  _createClass(HomeHelper, [{
    key: "init",
    value: function init() {
      this.map();
      this.buttonOnClick();
      this.modalOnClose();
    }
  }, {
    key: "map",
    value: function map() {
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
        receiverId: null
      };
    }
  }, {
    key: "buttonOnClick",
    value: function buttonOnClick() {
      var self = this;

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
    }
  }, {
    key: "modalOnClose",
    value: function modalOnClose() {
      var $this = this;

      $this._map.modalWin.on('hidden.bs.modal', function (e) {
        $this.removeUsersMessages();
      });
    }
  }, {
    key: "removeUsersMessages",
    value: function removeUsersMessages() {
      this._map.containerMsg.empty();
    }
  }, {
    key: "handleShowUsersMessages",
    value: function handleShowUsersMessages(e) {
      e.preventDefault();
      e.stopImmediatePropagation();
      var $this = this;
      var element = $(e.target).closest('button');
      $this._map.receiverId = element.attr('data-user');
      var form = $(element).closest('form');
      var data = {
        receiver_id: $this._map.receiverId,
        _token: form.find('input[name="_token"]').val() || null
      };

      $this._map.spinner.css({
        'display': 'flex'
      });

      $.get(element.data('action'), data, function (data) {
        $this._map.containerMsg.html(data.data);

        $this._map.spinner.css({
          'display': 'none'
        });

        if (!$this._map.modalWin.is(':visible')) {
          $this._map.modalWin.modal('show');
        }
      }).fail(function (error) {
        $this.handleMessages(error);

        $this._map.spinner.css({
          'display': 'none'
        });
      });
    }
  }, {
    key: "handleSendUsersMessage",
    value: function handleSendUsersMessage(e) {
      e.preventDefault();
      e.stopImmediatePropagation();
      var $this = this;
      var element = $(e.target).closest('button');

      var message = $this._map.msgBox.val();

      var form = $(element).closest('form');
      var data = {
        message: message,
        receiver_id: $this._map.receiverId,
        _token: form.find('input[name="_token"]').val() || null
      };

      $this._map.msgBox.val('');

      $this._map.spinner.css({
        'display': 'flex'
      });

      $.post(element.data('action'), data, function (data) {
        $this._map.containerMsg.html(data.data);

        $this._map.spinner.css({
          'display': 'none'
        });
      }).fail(function (error) {
        $this.handleMessages(error);

        $this._map.spinner.css({
          'display': 'none'
        });
      });
    }
  }, {
    key: "handleFilterProcess",
    value: function handleFilterProcess(callback, e) {
      if (typeof callback !== "function") {
        e = callback;

        callback = function callback() {};
      }

      e.preventDefault();
      e.stopImmediatePropagation();
      var $this = this;
      var element = $(e.target).closest('button');
      callback();
      $.post(element.data('action'), this.getFiltersData(element.closest('form').find('input[name="_token"]').val()), function (data) {
        $this.removeUserTableItems();
        $this.drawUserTable(data.users);
      }).fail(function (error) {
        $this.handleMessages(error);
      });
    }
  }, {
    key: "getFiltersData",
    value: function getFiltersData() {
      var token = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;
      var data = {
        'sort': this._map.sortButton.attr('data-sort'),
        '_token': token || null
      };

      this._map.filters.each(function () {
        var value = $(this).val();
        var name = $(this).attr('name');

        if (value.trim() !== '') {
          data[name] = value;
        }
      });

      return data;
    }
  }, {
    key: "removeUserTableItems",
    value: function removeUserTableItems() {
      this._map.userTable.find('tbody').empty();
    }
  }, {
    key: "drawUserTable",
    value: function drawUserTable(users) {
      var _this = this;

      if (users === undefined || users === null) {
        return;
      }

      users.forEach(function (user, key) {
        _this._map.userTable.find('tbody').append(_this.getUserRowTemplate(user, key));
      });
    }
  }, {
    key: "getUserRowTemplate",
    value: function getUserRowTemplate(user, key) {
      return "<tr>\n            <td><b>".concat(key + 1, "</b></td>\n            <td>").concat(user.name || '', "</td>\n            <td>").concat(user.last_name || '', "</td>\n            <td>").concat(user.dob || '', "</td>\n            <td>").concat(user.location || '', "</td>\n            <td>").concat(user.phone || '', "</td>\n            <td>").concat(user.last_login_at || '', "</td>\n            <td class=\"text-center\"><input type=\"checkbox\" aria-label=\"Checkbox for 'Eaten'\" data-user=\"").concat(user.id, "\" class=\"check-eaten\" ").concat(user.eaten ? 'checked="true" disabled="true"' : '', " ></td>\n            <td><button type=\"button\" class=\"show-messages btn btn-secondary\" data-user=\"").concat(user.id, "\" data-action=\"").concat(window.getUsersMessagesUrl, "\" data-toggle=\"modal\" data-target=\"#modalMessages\">Send Message</button></td>\n            </tr>");
    }
  }, {
    key: "handleEatButtonClick",
    value: function handleEatButtonClick(e) {
      e.preventDefault();
      e.stopImmediatePropagation();
      var $this = this;
      var element = e.target;
      var form = $(element).closest('form');
      var data = {
        eaten: [],
        _token: form.find('input[name="_token"]').val() || null
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
    }
  }, {
    key: "handleMessages",
    value: function handleMessages(data) {
      this._map.messagesContainer.empty();

      if (data.status && data.statusText) {
        this._map.messagesContainer.append('<span class="alert alert-danger msg-float">' + 'Got error #' + data.status + ': ' + data.statusText + '</span>');

        return;
      }

      this._map.messagesContainer.append('<span class="alert alert-success msg-float">' + data.message + '</span>');
    }
  }]);

  return HomeHelper;
}();

$(function () {
  new HomeHelper().init();
});

/***/ }),

/***/ 1:
/*!************************************!*\
  !*** multi ./resources/js/home.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/user/WEB/www/test/resources/js/home.js */"./resources/js/home.js");


/***/ })

/******/ });