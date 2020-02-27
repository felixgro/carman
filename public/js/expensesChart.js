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
/******/ 	return __webpack_require__(__webpack_require__.s = 8);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/dashboard/expensesChart.js":
/*!*************************************************!*\
  !*** ./resources/js/dashboard/expensesChart.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/*
    Skript für Ajax-Requests bezgl. Daten für ExpensesChart
    dep: Chart.js, JQuery
*/
(function () {
  var options = document.querySelectorAll('.multiple-choice .scope-option');
  var dataContainer = document.querySelector('.scope-data');
  var canvas = document.getElementById('expensesChart');
  var ctx = canvas.getContext('2d');
  var chart;

  var drawChart = function drawChart(data) {
    var ctx = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : undefined;

    if (chart === undefined) {
      chart = new Chart(ctx, {
        type: 'pie',
        data: {
          labels: ['Gas Station', 'Tickets', 'Service', 'Other'],
          datasets: [{
            label: 'All Expenses',
            data: [data.fuel, data.ticket, data.service, data.other],
            borderWidth: 0,
            backgroundColor: ['hsl(240, 30%, 35%)', 'hsla(355, 80%, 58%, 1)', 'hsl(40, 80%, 70%)', 'lightgrey']
          }]
        },
        options: {
          responsive: false,
          cutoutPercentage: 50,
          legend: {
            display: false,
            position: 'bottom'
          },
          tooltips: {
            enabled: true,
            cornerRadius: 2,
            callbacks: {
              label: function label(tooltipItems, data) {
                var value = " " + data.datasets[0].data[tooltipItems.index];
                return value + ' ' + getUserCurrency().symbol;
              }
            }
          }
        }
      });
    } else {
      chart.data.datasets[0].data = [data.fuel, data.ticket, data.service, data.other];
      chart.update();
    }

    updateScopeData(data);
  }; // Sendet AJAX-Request mit Scope und UserID and /expenses/userID/getData


  var getData = function getData(id, scope) {
    var url = "/expenses/" + id + "/getData";
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
      }
    });
    $.ajax({
      url: url,
      method: 'get',
      data: {
        'scope': scope
      },
      success: function success(res) {
        var data = {
          'total': res.sum,
          'fuel': res.fuel_sum,
          'ticket': res.ticket_sum,
          'service': res.service_sum,
          'other': res.other_sum
        }; // Falls im angefragten Scope keine Ausgaben existieren

        if (res.sum === 0) {
          nothingToShow();
        } else {
          somethingToShow();
        }

        drawChart(data, ctx);
      }
    });
  }; // Wenn auf Scope Button geklickt wurde


  var scopeClicked = function scopeClicked(event) {
    var value = parseInt(event.target.dataset.value);

    switch (value) {
      // All Time
      case 1:
        getData(1, 'all');
        break;
      // This Week

      case 2:
        getData(1, 'month');
        break;
      // This Year

      case 3:
        getData(1, 'year');
        break;
      // Error Handling

      default:
    }
  };

  var updateScopeData = function updateScopeData(data) {
    var total = dataContainer.querySelector('h2');
    var totalSum = getConvertedNumber(data.total);
    total.innerHTML = totalSum;
    document.querySelector('small.currency').innerHTML = getUserCurrency()["short"];
    positionScopeData();
    var percent = calculatePercentages(data);
    document.getElementById('gasPercent').innerHTML = percent.fuel + "%";
    document.getElementById('ticketPercent').innerHTML = percent.ticket + "%";
    document.getElementById('servicePercent').innerHTML = percent.service + "%";
    document.getElementById('otherPercent').innerHTML = percent.other + "%";
  };

  var positionScopeData = function positionScopeData() {
    return 0;
  };

  var calculatePercentages = function calculatePercentages(data) {
    var sum = data.total ? data.total : 0;
    var fuel = data.fuel ? data.fuel : 0;
    var ticket = data.ticket ? data.ticket : 0;
    var service = data.service ? data.service : 0;
    var other = data.other ? data.other : 0;
    var onePercent = sum / 100; // Um die Anzeige von NaN im UI zu vermeiden

    if (onePercent === 0) {
      return {
        fuel: 0,
        service: 0,
        ticket: 0,
        other: 0
      };
    } else {
      // Ausgabe der Prozent
      return {
        fuel: Math.round(fuel / onePercent),
        service: Math.round(service / onePercent),
        ticket: Math.round(ticket / onePercent),
        other: Math.round(other / onePercent)
      };
    }
  }; // Wird aufgerufen wenn eine Request die Summe 0 als Response geliefert hat


  var nothingToShow = function nothingToShow() {
    var msg = document.getElementById('noExpenses');
    msg.style.display = 'block';
    msg.style.opacity = 0;
    setTimeout(function () {
      var canvasRect = canvas.getBoundingClientRect();
      var msgRect = msg.getBoundingClientRect(); // Ausrechnen der Position

      var x = canvasRect.left + canvasRect.width / 2 - msgRect.width / 2;
      var y = canvasRect.top + canvasRect.height / 2 - msgRect.height / 2; // Position Text

      msg.style.left = x + "px";
      msg.style.top = y + "px";
      msg.style.opacity = 1;
    }, 100);
  };

  var somethingToShow = function somethingToShow() {
    var msg = document.getElementById('noExpenses');
    msg.style.opacity = 0;
    msg.style.display = 'none';
  };

  var getConvertedNumber = function getConvertedNumber(num) {
    var knum = Math.abs(num) > 999 ? Math.sign(num) * (Math.abs(num) / 1000).toFixed(1) + 'k' : Math.sign(num) * Math.abs(num);
    return knum;
  };

  var getUserCurrency = function getUserCurrency() {
    var symbol = document.getElementById('userCurrency').value;
    var _short = document.getElementById('userCurrencyShort').value;
    return {
      symbol: symbol,
      "short": _short
    };
  };

  getData(1, 'all'); // Event-Listener Zuweisungen

  for (var i = 0; i < options.length; i++) {
    options[i].onclick = scopeClicked;
  }
})();

/***/ }),

/***/ 8:
/*!*******************************************************!*\
  !*** multi ./resources/js/dashboard/expensesChart.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/felixgrohs/Server/rider/resources/js/dashboard/expensesChart.js */"./resources/js/dashboard/expensesChart.js");


/***/ })

/******/ });