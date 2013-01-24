(function($) {

// config
var defaultOptions = {
    url: '/api/zipcode/',
    prefInput: '#form_pref',
    cityInput: '#form_city',
    townInput: '#form_town',
    streetInput: '#form_street',
    zipcodeInput: '#form_zipcode',

    selectContainer: '#zipcode-search-select-container',
    searchBtn: '#zipcode-search-btn',

    selectStyle: {},
    nonOption: '以下から選択して下さい',

    errorMessage: '該当する住所が見つかりませんでした。',
    resultNotFoundMessage: '該当する住所が見つかりませんでした。'
};

var Zipcode = (function() {
    // Define a local copy of Zipcode
    var Zipcode = function(options) {
        return new Zipcode.fn.init(options);
    };

    Zipcode.prototype = {
        constructor: Zipcode,
        addresses: [],
        options: {}
    };
    Zipcode.fn = Zipcode.prototype;

    // class method
    Zipcode.setResult = function(options, pref, city, town, street) {
        $(options.prefInput).val(pref);
        $(options.cityInput).val(city);
        $(options.townInput).val(town);
        $(options.streetInput).val(street);
    };

    Zipcode.clearResult = function(options) {
        Zipcode.setResult(options, '', '', '', '');
        $(options.selectContainer).text('');
    };

    Zipcode.updateResult = function(options, addresses, idx) {
        if (addresses[idx]) {
            obj = addresses[idx].obj;
            Zipcode.setResult(options, obj.pref, obj.city, obj.town, obj.street ? obj.street : '');
        }
    };

    Zipcode.newOptions = function(addresses, options) {
        var $option, $options = [], nonOption = options.nonOption;

        if (nonOption) {
            $option = $('<option></option>')
            .attr('label', nonOption)
            .text(nonOption);

            $options.push($option);
        }

        for (var i = 0, length = addresses.length; i < length; i++) {
            obj = addresses[i];

            $option = $('<option></option>')
            .attr({
                label: obj.str,
                value: i
            })
            .text(obj.str);

            $options.push($option);
        }

        return $options;
    };

    Zipcode.newSelect = function(options, addresses, children) {
        return $('<select></select>')
        .css(options.selectStyle)
        .append(children)
        .on('change', function() {
            Zipcode.updateResult(options, addresses, $(this).val());
            if (options.changeSelected) {
                options.changeSelected(this, options);
            }
        });
    };

    // instance method
    Zipcode.fn.init = function(options) {
        this.addresses = [];
        this.options = $.extend(defaultOptions, options);

        return this;
    };

    Zipcode.fn.collect = function(collection) {
        var obj, address;

        if (!collection.length) {
            return;
        }

        for (var i = 0, length = collection.length; i < length; i++) {
            obj = collection[i];

            if (obj.street) {
                address = obj.pref + obj.city + obj.town + obj.street;
            } else {
                address = obj.pref + obj.city + obj.town;
            }

            this.addresses.push({ str: address, obj: obj });
        }
    };

    Zipcode.fn.setResult = function(pref, city, town, street) {
        Zipcode.setResult(this.options, pref, city, town, street);
    };

    Zipcode.fn.clearResult = function() {
        Zipcode.clearResult(this.options);
    };

    Zipcode.fn.updateResult = function(idx) {
        Zipcode.updateResult(this.options, this.addresses, idx);
    };

    Zipcode.fn.newOptions = function() {
        return Zipcode.newOptions(this.addresses, this.options);
    };

    Zipcode.fn.newSelect = function() {
        return Zipcode.newSelect(this.options, this.addresses, this.newOptions());
    };

    Zipcode.fn.init.prototype = Zipcode.fn;

    return Zipcode;
}());

var Event = (function() {
    // Define a local copy of Zipcode
    var Event = function() {
        return new Event.fn.init();
    };

    Event.prototype = {
        constructor: Event
    };
    Event.fn = Event.prototype;

    Event.success = function(z) {
        return function(data) {
            var length;

            z.addresses = []; // [{str: xxx, obj: xx}, ...]
            z.collect(data.home);
            z.collect(data.office);

            // update addresses
            z.clearResult();

            length = z.addresses.length;

            if (length == 0) {
                Event.resultNotFound(z)();
            } else if (length == 1) {
                Event.updateResult(z)();
            } else {
                Event.updateResults(z)();
            }

            if (z.options.success) {
                z.options.success(z);
            }
        };
    };
    Event.updateResult = function(z) {
        return function() {
            var selectContainer;

            z.updateResult(0);

            if (z.options.updateResult) {
                selectContainer = $(z.options.selectContainer);
                z.options.updateResult(z, selectContainer);
            }
        };
    };
    Event.updateResults = function(z) {
        return function() {
            var selectContainer = $(z.options.selectContainer).append(z.newSelect());

            if (z.options.updateResults) {
                z.options.updateResults(z, selectContainer);
            }
        };
    };
    Event.resultNotFound = function(z) {
        return function() {
            var selectContainer = $(z.options.selectContainer).append(z.options.errorMessage);

            if (z.options.resultNotFound) {
                z.options.resultNotFound(z, selectContainer);
            }
        };
    };
    Event.error = function(z) {
        return function() {
            var selectContainer = $(z.options.selectContainer).append(z.options.errorMessage);

            if (z.options.error) {
                z.options.error(z, selectContainer);
            }
        };
    };
    Event.click = function(options) {
        // vars
        var clicked = false, z = Zipcode(options);

        // on click search button
        $(z.options.searchBtn).on('click', function() {
            var zipcode = $(z.options.zipcodeInput).val();

            if (z.options.condition && !z.options.condition(z, zipcode)) {
                return false;
            }

            if (clicked) {
                return false;
            }

            clicked = true;

            // ajax get to zip search api
            $.getJSON(z.options.url, { zipcode: zipcode }, Event.success(z))
            .error(Event.error(z));

            clicked = false;

            return false;
        });
    };

    Event.fn.init = function() {
        return this;
    };

    return Event;
}());

// expose namespace
Zipcode.Event = Event;
window.Zipcode = Zipcode;

}(jQuery));
