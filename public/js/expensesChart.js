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
/******/ 	return __webpack_require__(__webpack_require__.s = 6);
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
  var canvas = document.getElementById('expensesChart');
  var ctx = canvas.getContext('2d');

  var drawChart = function drawChart(data, ctx) {
    var newChart = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: ['Gas Station', 'Tickets', 'Other'],
        datasets: [{
          label: 'All Expenses',
          data: [data.fuel, data.ticket, data.other],
          borderWidth: 0,
          backgroundColor: ['hsl(240, 30%, 35%)', 'hsla(355, 80%, 58%, 1)', 'hsl(40, 80%, 70%)']
        }]
      },
      options: {
        cutoutPercentage: 50,
        legend: {
          position: 'bottom'
        },
        tooltips: {
          enabled: true,
          cornerRadius: 2
        }
      }
    });
  };

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
          'fuel': res.fuel_sum,
          'ticket': res.ticket_sum,
          'other': res.other_sum
        };
        drawChart(data, ctx);
      }
    });
  };

  getData(1, 'all');
})();

/***/ }),

/***/ 6:
/*!*******************************************************!*\
  !*** multi ./resources/js/dashboard/expensesChart.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/felixgrohs/Server/rider/resources/js/dashboard/expensesChart.js */"./resources/js/dashboard/expensesChart.js");


/***/ })

/******/ });